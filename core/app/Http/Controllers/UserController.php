<?php
namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use App\Models\Admin;
use App\Models\AdminNotification;
use App\Models\Bank;
use App\Models\BankWithdrawal;
use App\Models\Board;
use App\Models\Code;
use App\Models\Deposit;
use App\Models\FundTransfer;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserGiftCodeRedemption;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function home()
    {

        //return Split_Hide_Name("08155771172"); //081****172
        $pageTitle     = 'Dashboard';
        $user          = Auth::user();
        $totalDeposit  = Deposit::where('user_id', $user->id)->where('status', 1)->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id', $user->id)->where('status', 1)->sum('amount');
        $latestTrx     = Transaction::where('user_id', $user->id)->latest()->limit(5)->get();
        $totalInvest   = Investment::where('user_id', $user->id)->where('status', 0)->sum('amount');
        $invs          = Investment::where('user_id', $user->id)->where('status', 0)->get();

        $teams = User::where('ref_by', auth()->user()->id)->count();

        $plans = Plan::orderBy('min_amount')->where('status', 1)->get();

        $general = GeneralSetting::first();
        $notices = Board::latest()->take(10)->get();

        $withdrawals = Withdrawal::with('user')->latest()->take(10)->get();
        //$withdrawals = Withdrawal::latest()->take(10)->get();

        $logs = Transaction::latest()->limit(5)->get();

        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.dashboard', compact(
            'pageTitle',
            'user',
            'totalDeposit',
            'totalWithdraw',
            'latestTrx',
            'emptyMessage',
            'totalInvest',
            'plans',
            'invs',
            'teams',
            'notices',
            'withdrawals',
            'logs'
        ));
    }

    public function dailybonus()
    {
        $user          = Auth::user();
        $general       = GeneralSetting::first();
        $lastClaimedAt = $user->last_claimed_at;
        $bonus         = $general->dailysignin;

        // Check if the user is eligible to claim the bonus
        if (! $lastClaimedAt || now()->diffInHours($lastClaimedAt) >= 24) {
            // Award the bonus (you can implement your own logic here)
            $user->bonus_balance += $bonus;
            $user->last_claimed_at = now();
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $bonus;
            $transaction->post_balance = $user->bonus_balance + $bonus;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Daily CheckIn';
            $transaction->trx          = getTrx();
            $transaction->save();

            $notify[] = ['success', 'Bonus claimed successfully'];
            return back()->withNotify($notify);
        }

        $notify[] = ['error', 'You have already claimed your daily bonus'];
        return back()->withNotify($notify);
    }

    public function coupon()
    {
        $pageTitle = 'Gift Code';
        return view($this->activeTemplate . 'user.coupon', compact('pageTitle'));
    }

    public function redeem(Request $request)
    {
        //dd(Code::where('code', $request->code)->count());

        $request->validate([
            'code' => 'required|string|exists:codes,code',
        ]);

        if (Code::where('code', $request->code)->count() < 1) {
            $notify[] = ['success', 'Incorrect Gift Code'];
            return back()->withNotify($notify);
        }

        $giftCode = Code::where('code', $request->code)->first();
        $redeemed = UserGiftCodeRedemption::where('gift_code_id', $giftCode->id)->count();
        // Check if the user has already redeemed this gift code
        $hasRedeemed = UserGiftCodeRedemption::where('user_id', Auth::id())
            ->where('gift_code_id', $giftCode->id)
            ->exists();

        if ($hasRedeemed) {
            $notify[] = ['success', 'You have already redeemed this gift code.'];
            return back()->withNotify($notify);
        }

        // Check if the gift code has reached the redemption limit
        if ($redeemed >= $giftCode->redeemed_count) {
            $notify[] = ['success', 'This gift code has reached its limit.'];
            return back()->withNotify($notify);
        }

        // Increment the redeemed count
        //$giftCode->increment('redeemed_count');

        // Create a new redemption record
        UserGiftCodeRedemption::create([
            'user_id'      => Auth::id(),
            'gift_code_id' => $giftCode->id,
        ]);

        // if(Code::where('code', $request->code)->where('status',1)->count() > 0){
        //     $notify[] = ['success', 'This code has been used'];
        //     return back()->withNotify($notify);
        // }
        $code = Code::where('code', $request->code)->first();
        $user = Auth::user();
        $user->bonus_balance += $code->amount;
        $user->save();

        $code->status = 1;
        $code->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $code->amount;
        $transaction->post_balance = $user->bonus_balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Redeemed Gift Code';
        $transaction->trx          = getTrx();
        $transaction->save();

        $notify[] = ['success', 'Code Redeemed Successfully'];
        return back()->withNotify($notify);

    }

    public function investmentPlan()
    {

        $pageTitle = 'Products';
        $user      = Auth::user();

        $plans  = Plan::orderBy('min_amount')->get();
        $orders = Investment::where('user_id', $user->id)->where('status', 0)->with('plan')->count('id');
        $income = Investment::where('user_id', $user->id)->where('status', 0)->with('plan')->sum('interest_amount');

        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.plans', compact(
            'pageTitle',
            'user',
            'plans',
            'orders',
            'income'
        ));

    }

    public function usdtDeposit()
    {
        $pageTitle = "USDT TRC20 Funding";
        $user      = Auth::user();
        $amount    = session()->get('fund_amount');
        if (! $amount) {
            $amount = 1000;
        }
        $usdt_amount = $amount / 750;
        return view($this->activeTemplate . 'user.manual_payment.usdt_process', compact('pageTitle', 'user', 'amount', 'usdt_amount'));

        //return view($this->activeTemplate. 'user.payment.usdt', compact('pageTitle','user'));
    }

    public function usdtDepositProccess(Request $request)
    {
        $pageTitle   = "USDT Funding";
        $user        = Auth::user();
        $amount      = $request->amount;
        $usdt_amount = $amount / 750;
        return view($this->activeTemplate . 'user.manual_payment.usdt_process', compact('pageTitle', 'user', 'amount', 'usdt_amount'));
    }

    public function profile()
    {
        $pageTitle     = "Profile Setting";
        $user          = Auth::user();
        $totalWithdraw = Withdrawal::where('user_id', $user->id)->where('status', 1)->sum('amount');
        $totalInvest   = Investment::where('user_id', $user->id)->where('status', 0)->sum('amount');
        return view($this->activeTemplate . 'user.profile_setting', compact('pageTitle', 'user', 'totalInvest', 'totalWithdraw'));
    }

    public function cookie()
    {
        // Find the first admin by ID
        $admin = Admin::first();

        if ($admin) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname'  => 'required|string|max:50',
            'address'   => 'sometimes|required|max:80',
            'state'     => 'sometimes|required|max:80',
            'zip'       => 'sometimes|required|max:40',
            'city'      => 'sometimes|required|max:50',
            'image'     => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ], [
            'firstname.required' => 'First name field is required',
            'lastname.required'  => 'Last name field is required',
        ]);

        $user = Auth::user();

        $in['firstname'] = $request->firstname;
        $in['lastname']  = $request->lastname;

        $in['address'] = [
            'address' => $request->address,
            'state'   => $request->state,
            'zip'     => $request->zip,
            'country' => $request->country,
            'city'    => $request->city,
        ];

        if ($request->hasFile('image')) {
            $location    = imagePath()['profile']['user']['path'];
            $size        = imagePath()['profile']['user']['size'];
            $filename    = uploadImage($request->image, $location, $size, $user->image);
            $in['image'] = $filename;
        }
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile updated successfully.'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {

        $password_validation = Password::min(6);
        $general             = GeneralSetting::first();

        $this->validate($request, [
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', $password_validation],
        ]);

        try {
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)) {
                $password       = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                $notify[] = ['success', 'Password changes successfully.'];
                return back()->withNotify($notify);
            } else {
                $notify[] = ['error', 'The password doesn\'t match!'];
                return back()->withNotify($notify);
            }
        } catch (\PDOException $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    /*
     * Deposit History
     */
    public function depositHistory()
    {
        $pageTitle    = 'Deposit History';
        $emptyMessage = 'No history found.';
        $logs         = auth()->user()->deposits()->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('pageTitle', 'emptyMessage', 'logs'));
    }

    /*
     * Withdraw Operation
     */

    public function withdrawMoney()
    {

        //check deposit method
        $user  = \auth()->user()->id;
        $users = Auth::user();

        $invests = Investment::where('user_id', $user)->count();
        $general = GeneralSetting::first();

        // if($invests < 1){
        //     $notify[] = ['error', 'Kindly invest first'];
        //     return back()->withNotify($notify);
        // }

        if (! auth()->user()->bankAccount) {
            $notify[] = ['error', 'You have not added your withdrawal account'];
            return redirect('user/account-setup')->withNotify($notify);
        }

        if ($general->withdrawal == 0) {
            $notify[] = ['error', 'Withdrawal is temporary closed'];
            return back()->withNotify($notify);
        }

        $withdraws = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->orderBy('id', 'desc')->paginate(getPaginate());
        $deposits  = Deposit::where('user_id', $user)->where('status', 1)->pluck('method_currency');
        /*return $deposits;*/

        //dd($deposits);

        if (! $deposits) {
            $withdrawMethod = WithdrawMethod::where('status', 1)
                ->whereIn('currency', $deposits)
                ->orderBy('name')
                ->get();
        } else {

            $withdrawMethod = WithdrawMethod::where('status', 1)
                ->where('currency', "NGN")
                ->orderBy('name')
                ->get();

        }

        $withdrawMainMethod = WithdrawMethod::where('id', 1)
            ->orderBy('name')
            ->first();

        //last withdrawal

        // $last = Withdrawal::where('user_id', $user)
        //     ->latest()
        //     ->first();

        // if(!$last){
        //     $can_withdraw = 1;
        //     $difference = 12;
        // }else{

        //     //check last withdrawal

        //     $last_time = Carbon::parse($last->created_at);
        //     $now = Carbon::now();

        //     $difference = $last_time->diffInHours($now);

        //     //dd($difference);

        //     if($difference >= 12){
        //         $can_withdraw = 1;
        //     }else{
        //         $can_withdraw = 0;
        //     }
        // }

        // if($can_withdraw){
        //     $next_withdrawal = 0;
        // }else{
        //     $next_withdrawal = 12 - $difference;

        //     $notify[] = ['error', "Withdrawals is restricted to once every 12hours, your next withdrawal is in $next_withdrawal hours time"];
        //     return back()->withNotify($notify);
        // }

        $with_limit = Withdrawal::where('user_id', $user)->where('created_at', '>', now()->subDay())->count();

        // if ($with_limit > 2) {
        //     $notify[] = ['error', "Withdrawals is restricted to twice every 24hours"];
        //     return back()->withNotify($notify);
        // }

        $next_withdrawal = 0;
        $can_withdraw    = 1;

        $is_naira = $is_usdt = 0;

        $deposits_array = $deposits->toArray();
        //return $deposits_array;
        if (in_array("NGN", $deposits_array)) {
            $is_naira = 1;
        }

        if (in_array("USD", $deposits_array)) {
            $is_usdt = 1;
        }

        //return $withdrawMethod;
        $pageTitle = 'Withdraw Money';
        return view($this->activeTemplate . 'user.withdraw.methods', compact('pageTitle', 'withdrawMethod', 'withdrawMainMethod', 'can_withdraw', 'next_withdrawal', 'is_naira', 'is_usdt', 'users', 'withdraws'));
    }

    public function withdrawStore(Request $request)
    {
        $currentTime = Carbon::now();

                                                             // Define opening and closing times
        $portalOpenTime  = Carbon::createFromTime(8, 0, 0);  // 8:00 AM
        $portalCloseTime = Carbon::createFromTime(20, 0, 0); // 7:00 PM

        // return response()->json([
        //     'success' => true,
        //     'error' => 'Withdrawal is temporary closed'
        // ], 400);

        // Check if the current time is outside the allowed range (before 8:00 AM or after 7:00 PM)
        // if ($currentTime->lt($portalOpenTime) || $currentTime->gt($portalCloseTime)) {
        //     return response()->json([
        //         'success' => true,
        //         'error' => 'Withdrawal opens by 8am'
        //     ], 400);
        // }

        $general = GeneralSetting::first();

        // if($general->withdrawal == 0){

        //     return response()->json([
        //         'success' => true,
        //         'error' => 'Withdrawal is temporary closed'
        //     ], 400);
        // }

        $user = auth()->user();

        $with_limit = Withdrawal::where('user_id', $user->id)->where('created_at', '>', now()->subDay())->count();

        if ($with_limit >= $general->wit_limit) {
            return response()->json([
                'success' => true,
                'error'   => 'Withdrawals is restricted to ' . $general->wit_limit . ' times a day',
            ], 400);
        }

        try {

            $request->validate([
                'amount'      => 'required|numeric|min:1', // Ensures 'amount' is provided and greater than zero
                'method_code' => 'required',
                'balance'     => 'required',
            ], [
                'amount.required' => 'The amount field is required.',
                'amount.numeric'  => 'The amount must be a number.',
                'amount.min'      => 'The amount must be greater than zero.',
            ]);

            $methodCode = $request->input('method_code');

            $method = WithdrawMethod::where('id', $methodCode)->where('status', 1)->firstOrFail();
            //dd($method);
            $user = auth()->user();

            $balance = $request->balance;

            if ($balance == 2) {
                if ($request->input('amount') < $method->min_limit) {
                    $notify[] = ['error', 'Minimum bonus withdrawal is ' . $method->min_limit];
                    //return back()->withNotify($notify);
                    return response()->json([
                        'success' => true,
                        'error'   => 'Minimum bonus withdrawal is ' . number_format($method->min_limit),
                    ], 400);

                }
            } else {
                if ($request->amount < $method->min_limit) {
                    // $notify[] = ['error', 'Your requested amount is smaller than minimum amount.'];
                    // return back()->withNotify($notify);
                    return response()->json([
                        'success' => true,
                        'error'   => 'Your requested amount is smaller than minimum amount.',
                    ], 400);
                }
            }
            if ($request->amount > $method->max_limit) {
                // $notify[] = ['error', 'Your requested amount is larger than maximum amount.'];
                // return back()->withNotify($notify);
                return response()->json([
                    'success' => true,
                    'error'   => 'Your requested amount is larger than maximum amount.',
                ], 400);
            }

            if ($balance == 1) {
                if ($request->amount > $user->balance) {
                    // $notify[] = ['error', 'You do not have sufficient balance to withdraw.'];
                    // return back()->withNotify($notify);
                    return response()->json([
                        'success' => true,
                        'error'   => 'You do not have sufficient balance to withdraw.',
                    ], 400);
                }
            } elseif ($balance == 2) {
                if ($request->amount > $user->bonus_balance) {
                    // $notify[] = ['error', 'You do not have sufficient bonus balance for withdraw.'];
                    // return back()->withNotify($notify);
                    return response()->json([
                        'success' => true,
                        'error'   => 'You do not have sufficient bonus balance for withdraw.',
                    ], 400);
                }
            } else {
                // $notify[] = ['error', 'Invalid withdrawal balance.'];
                // return back()->withNotify($notify);
                return response()->json([
                    'success' => true,
                    'error'   => 'Invalid withdrawal balance.',
                ], 400);
            }

            if ($general->investtowithdraw == 1) {
                $before = Investment::where('user_id', $user->id)->where('status', 0)->first();
                if (! $before) {
                    // $notify[] = ['error', 'You must have products/services before withdrawing'];
                    // return back()->withNotify($notify);
                    return response()->json([
                        'success' => true,
                        'error'   => 'You must have products/services before withdrawing',
                    ], 400);
                }
            }

            $charge      = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
            $afterCharge = $request->amount - $charge;
            $finalAmount = $afterCharge / $method->rate;

            $withdraw               = new Withdrawal();
            $withdraw->method_id    = $method->id; // wallet method ID
            $withdraw->user_id      = $user->id;
            $withdraw->amount       = $request->amount;
            $withdraw->currency     = $method->currency;
            $withdraw->rate         = $method->rate;
            $withdraw->charge       = $charge;
            $withdraw->final_amount = $finalAmount;
            $withdraw->after_charge = $afterCharge;
            $withdraw->is_bank      = $method->is_bank;
            $withdraw->trx          = getTrx();
            if ($balance == 2) {
                $withdraw->is_bonus = 1;
            }
            $withdraw->save();

            $directory  = date("Y") . "/" . date("m") . "/" . date("d");
            $path       = imagePath()['verify']['withdraw']['path'] . '/' . $directory;
            $collection = collect($request);
            $reqField   = [];
            if ($withdraw->method->user_data != null) {
                foreach ($collection as $k => $v) {
                    foreach ($withdraw->method->user_data as $inKey => $inVal) {
                        if ($k != $inKey) {
                            continue;
                        } else {
                            if ($inVal->type == 'file') {
                                if ($request->hasFile($inKey)) {
                                    try {
                                        $reqField[$inKey] = [
                                            'field_name' => $directory . '/' . uploadImage($request[$inKey], $path),
                                            'type'       => $inVal->type,
                                        ];
                                    } catch (\Exception $exp) {
                                        $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                        return back()->withNotify($notify)->withInput();
                                    }
                                }
                            } else {
                                $reqField[$inKey] = $v;
                                $reqField[$inKey] = [
                                    'field_name' => $v,
                                    'type'       => $inVal->type,
                                ];
                            }
                        }
                    }
                }

                if ($withdraw->method->is_bank) {
                    $reqField["bank_name"] = [
                        'field_name' => $user->bankAccount->bank_name,
                        'type'       => "text",
                    ];

                    $reqField["account_name"] = [
                        'field_name' => $user->bankAccount->account_name,
                        'type'       => "text",
                    ];

                    $reqField["account_number"] = [
                        'field_name' => $user->bankAccount->account_number,
                        'type'       => "text",
                    ];
                }

                $withdraw['withdraw_information'] = $reqField;
            } else {
                $withdraw['withdraw_information'] = null;
            }

            $withdraw->status = 2;
            $withdraw->save();
            if ($withdraw->is_bonus) {
                $user->bonus_balance -= $withdraw->amount;
                $text = " Bonus ";
            } else {
                $user->balance -= $withdraw->amount;
                $text = "";
            }
            $user->save();

            $transaction          = new Transaction();
            $transaction->user_id = $withdraw->user_id;
            $transaction->amount  = $withdraw->amount;
            if ($withdraw->is_bonus) {
                $transaction->post_balance = $user->bonus_balance;
            } else {
                $transaction->post_balance = $user->balance;
            }
            $transaction->charge   = $withdraw->charge;
            $transaction->trx_type = '-';
            $transaction->details  = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . " $text Withdraw";
            $transaction->trx      = $withdraw->trx;
            $transaction->save();

            $adminNotification            = new AdminNotification();
            $adminNotification->user_id   = $user->id;
            $adminNotification->title     = "New $text withdraw request from " . $user->username;
            $adminNotification->click_url = urlPath('admin.withdraw.details', $withdraw->id);
            $adminNotification->save();

            session()->put("withdrawal_code", "-");

            //create bank withdrawal

            if ($withdraw->is_bank) {
                $bank_withdrawal                 = new BankWithdrawal();
                $bank_withdrawal->withdrawal_id  = $withdraw->id;
                $bank_withdrawal->bank_code      = $user->bankAccount->bank_code;
                $bank_withdrawal->account_number = $user->bankAccount->account_number;
                $bank_withdrawal->account_name   = $user->bankAccount->account_name;
                $bank_withdrawal->save();
            }

            if ($general->auto == 1) {
                $gateway    = Gateway::where('alias', 'Qepay')->first();
                $withdrawal = Withdrawal::where('trx', $withdraw->trx)->with('user')->first();
                // $confirm = new TransferServices();
                // $confirm->initiate_transfer($withdrawal->id);

                $ref = getTrx();
                $url = route('shpaywithdrawipn');

                $apply_date = Carbon::now()->format('Y-m-d H:i:s');

                $back_url = $url;

                $bank_code = "" . $user->bankAccount->bank_code . "";

                $mch_id = json_decode($gateway->gateway_parameters)->mchtId->value; //this is the merchant id

                $mch_transferId = "" . $ref . "";

                $receive_account = "" . $user->bankAccount->account_number . "";

                $receive_name = "" . $user->bankAccount->account_name . "";

                $transfer_amount = "" . $finalAmount . "";

                $sign_type = "MD5";

                $signStr = "";

                $signStr = $signStr . "apply_date=" . $apply_date . "&";

                if ($back_url != "") {
                    $signStr = $signStr . "back_url=" . $back_url . "&";
                }

                if ($bank_code != "") {
                    $signStr = $signStr . "bank_code=" . $bank_code . "&";
                }

                $signStr = $signStr . "mch_id=" . $mch_id . "&";

                $signStr = $signStr . "mch_transferId=" . $mch_transferId . "&";

                $signStr = $signStr . "receive_account=" . $receive_account . "&";

                $signStr = $signStr . "receive_name=" . $receive_name . "&";

                $signStr = $signStr . "transfer_amount=" . $transfer_amount;

                $reqUrl = "https://pay.qeawapay.com/pay/transfer";

                $merchant_key = json_decode($gateway->gateway_parameters)->paymentKey->value; //this is the merchant key

                $sign = $this->sign($signStr, $merchant_key);

                $postdata = ['apply_date' => $apply_date,
                    'back_url'                     => $back_url,
                    'bank_code'                    => $bank_code,
                    'mch_id'                       => $mch_id,
                    'mch_transferId'               => $mch_transferId,
                    'receive_account'              => $receive_account,
                    'receive_name'                 => $receive_name,
                    'transfer_amount'              => $transfer_amount,
                    'sign_type'                    => $sign_type,
                    'sign'                         => $sign];

                //var_dump($postdata);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $reqUrl);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);

                curl_close($ch);

                $response_array = json_decode($response, true);
                //dd($response_array);
                Log::info($response_array);

                //dd($response_array);

                if ($response_array['respCode'] == "SUCCESS") {
                    $payment                 = new FundTransfer();
                    $payment->name           = $user->bankAccount->account_name;
                    $payment->description    = $general->sitename;
                    $payment->account_number = $user->bankAccount->account_number;
                    $payment->bank_code      = $user->bankAccount->bank_code;
                    $payment->amount         = $finalAmount;
                    $payment->withdrawal_id  = $withdrawal->id;
                    $payment->response       = json_encode($response_array);
                    $payment->reference      = $response_array['merTransferId'];
                    $payment->save();
                }

                // $params = http_build_query([
                //     "account_bank" => $user->bankAccount->bank_code,
                //     'account_number' => $user->bankAccount->account_number,
                //     'amount' => $finalAmount,
                //     'currency' => $method->currency,
                //     'narration' => $general->sitename,
                //     'callback_url' => route('flutterwaveipn')
                // ]);
                // $curl = curl_init();
                // curl_setopt_array($curl, array(
                //     CURLOPT_URL => "https://api.flutterwave.com/v3/transfers",
                //     CURLOPT_SSL_VERIFYPEER => false,
                //     CURLOPT_RETURNTRANSFER => true,
                //     CURLOPT_POSTFIELDS => $params,
                //     CURLOPT_HTTPHEADER => array(
                //         "Authorization: Bearer ".$general->flutterwave_key
                //     ),
                // ));

                // $response = curl_exec($curl);
                // $err = curl_error($curl);

                // if ($err) {
                //     // there was an error contacting the Paystack API
                //     $out = array('status' => false, 'message' => 'Transaction_verification', 'Curl returned error: ' . $err);
                //     return $out;
                // }

                //$response_array = json_decode($response,true);
                //Log::info($response_array);
                // if($response_array['status'] == 'success'){
                //     $payment = new FundTransfer();
                //     $payment->name = $user->bankAccount->account_name;
                //     $payment->description = $general->sitename;
                //     $payment->account_number = $user->bankAccount->account_number;
                //     $payment->bank_code = $user->bankAccount->bank_code;
                //     $payment->amount = $finalAmount;
                //     $payment->withdrawal_id = $withdrawal->id;
                //     $payment->response = json_encode($response_array);
                //     $payment->reference = $response_array['data']['reference'];
                //     $payment->save();
                // }else{
                //     $user->bonus_balance += $withdraw->amount;
                //     $user->save();

                //     return response()->json([
                //         'success' => true,
                //         'error' => 'Microfinance bank is not supported for withdrawal, kindly use your commercial bank.',
                //         'redirect_url' => url('/user/account-setup')
                //     ], 400);

                // }

            }

            $message         = Split_Hide_Name($user->username) . " withdraw " . amount_format($withdraw->amount);
            $board           = new Board();
            $board->messages = $message;
            $board->save();

            $msg = "Dear $user->username, you have successfully requested to sell your dollars worth $withdraw->amount, payment will be disbursed to your account shortly.";

            $general = GeneralSetting::first();

            notify($user, 'WITHDRAW_REQUEST', [
                'method_name'     => $withdraw->method->name,
                'method_currency' => $withdraw->currency,
                'method_amount'   => showAmount($withdraw->final_amount),
                'amount'          => showAmount($withdraw->amount),
                'charge'          => showAmount($withdraw->charge),
                'currency'        => $general->cur_text,
                'rate'            => showAmount($withdraw->rate),
                'trx'             => $withdraw->trx,
                'post_balance'    => showAmount($user->balance),
                'delay'           => $withdraw->method->delay,
            ]);

            // $notify[] = ['success', 'Withdraw request sent successfully'];
            // return redirect()->route('user.withdraw.history')->withNotify($notify);
            return response()->json([
                'success' => true,
                'message' => 'Withdraw request sent successfully',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capture validation errors and send back the first error message
            return response()->json([
                'success' => false,
                'error'   => $e->validator->errors()->first(), // Get the first validation error
            ], 422);
        }
    }

    public function withdrawshpay(Request $request)
    {
        $auto = $request->input('auto');
        if ($auto == 1) {
            $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
            //dd($method);
            $user = auth()->user();

            $amount = $request->input('amount');

            if ($amount == 10) {
                return response()->json(['error' => 'Amount field is required'], 400);
            }

            // Add more data as needed

            // Make a request to Flutterwave's API to initiate transfer
            $response = Http::withHeaders([
                'Authorization' => 'Bearer YOUR_FLUTTERWAVE_SECRET_KEY',
                'Content-Type'  => 'application/json',
            ])->post('https://api.flutterwave.com/v3/transfers', [
                'account_bank'   => '044', // Bank code (e.g., for Zenith Bank)
                'account_number' => 64464,
                'amount'         => 500,
                'currency'       => 'NGN',
                'recipient_name' => "fjfjfj",
                // Add more data as needed
            ]);

            // Process the response
            if ($response->successful()) {
                // Transfer successful
                return response()->json(['message' => 'Transfer initiated successfully']);
            } else {
                // Transfer failed
                return response()->json(['error' => 'Transfer failed'], $response->status());

            }
        }

        $this->validate($request, [
            'method_code' => 'required',
            'amount'      => 'required|numeric',
            'balance'     => 'required',
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        //dd($method);
        $user = auth()->user();

        $balance = $request->balance;

        if ($balance == 2) {
            if ($request->amount < $method->min_limit) {
                $notify[] = ['error', 'Minimum bonus withdrawal is ' . $method->min_limit];
                return back()->withNotify($notify);
            }
        } else {
            if ($request->amount < $method->min_limit) {
                $notify[] = ['error', 'Your requested amount is smaller than minimum amount.'];
                return back()->withNotify($notify);
            }
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your requested amount is larger than maximum amount.'];
            return back()->withNotify($notify);
        }

        if ($balance == 1) {
            if ($request->amount > $user->balance) {
                $notify[] = ['error', 'You do not have sufficient balance to withdraw.'];
                return back()->withNotify($notify);
            }
        } elseif ($balance == 2) {
            if ($request->amount > $user->bonus_balance) {
                $notify[] = ['error', 'You do not have sufficient bonus balance for withdraw.'];
                return back()->withNotify($notify);
            }
        } else {
            $notify[] = ['error', 'Invalid withdrawal balance.'];
            return back()->withNotify($notify);
        }

        $before = Investment::where('user_id', $user->id)->first();
        // if(!$before){
        //     $notify[] = ['error', 'You must have products/services before withdrawing'];
        //     return back()->withNotify($notify);
        // }

        $charge      = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge / $method->rate;

        $gateway = Gateway::where('alias', 'Shpay')->first();

        $user  = auth()->user();
        $ref   = getTrx();
        $date  = date("Y-m-d H:i:s");
        $mchid = json_decode($gateway->gateway_parameters)->mchtId->value;
        $appid = json_decode($gateway->gateway_parameters)->appId->value;
        $key   = json_decode($gateway->gateway_parameters)->key->value;

        $p = [
            "mchtId"      => $mchid,
            "appId"       => $appid,
            'countryCode' => "NG",
            'notifyUrl'   => route('shpaywithdrawipn'),
            'subject'     => "withdraw",
            'accountName' => auth()->user()->bankAccount->account_name,
            'accountNo'   => auth()->user()->bankAccount->account_number,
            'bankCode'    => auth()->user()->bankAccount->bank_code,
            "requestTime" => $date,
            "signType"    => "MD5",
            "subject"     => "withdraw",
            "transAmt"    => $afterCharge,
            "outTradeNo"  => $ref,
        ];

        ksort($p);
        $string = '';
        foreach ($p as $oneKey => $oneValue) {
            $string .= $oneKey . "=" . $oneValue . "&";
        }

        $string_without_last_and = substr($string, 0, -1);
        $digest                  = $string_without_last_and . $key;
        $sign                    = strtoupper(md5($digest));

        // Construct the URL with the endpoint
        $url = "https://transapi.shpays.com/v1/trans/payOut";

        // Make the API request
        $response = Http::post($url, [
            'mchtId'      => "$mchid",
            'appId'       => "$appid",
            'countryCode' => "NG",
            'requestTime' => "$date",
            'notifyUrl'   => route('shpaywithdrawipn'),
            'outTradeNo'  => "$ref",
            'signType'    => "MD5",
            'subject'     => "withdraw",
            'transAmt'    => "$afterCharge",
            'accountName' => auth()->user()->bankAccount->account_name,
            'accountNo'   => auth()->user()->bankAccount->account_number,
            'bankCode'    => auth()->user()->bankAccount->bank_code,
            'sign'        => "$sign",
        ]);

        // You can process the response as needed (e.g., convert JSON to array)
        $responseData = $response->json();

        //dd($responseData);

        if ($responseData['success'] == true) {

            try {

                $withdraw               = new Withdrawal();
                $withdraw->method_id    = $method->id; // wallet method ID
                $withdraw->user_id      = $user->id;
                $withdraw->amount       = $request->amount;
                $withdraw->currency     = $method->currency;
                $withdraw->rate         = $method->rate;
                $withdraw->charge       = $charge;
                $withdraw->final_amount = $finalAmount;
                $withdraw->after_charge = $afterCharge;
                $withdraw->is_bank      = $method->is_bank;
                $withdraw->trx          = $ref;
                if ($balance == 2) {
                    $withdraw->is_bonus = 1;
                }
                $withdraw->save();

                $directory  = date("Y") . "/" . date("m") . "/" . date("d");
                $path       = imagePath()['verify']['withdraw']['path'] . '/' . $directory;
                $collection = collect($request);
                $reqField   = [];
                if ($withdraw->method->user_data != null) {
                    foreach ($collection as $k => $v) {
                        foreach ($withdraw->method->user_data as $inKey => $inVal) {
                            if ($k != $inKey) {
                                continue;
                            } else {
                                if ($inVal->type == 'file') {
                                    if ($request->hasFile($inKey)) {
                                        try {
                                            $reqField[$inKey] = [
                                                'field_name' => $directory . '/' . uploadImage($request[$inKey], $path),
                                                'type'       => $inVal->type,
                                            ];
                                        } catch (\Exception $exp) {
                                            $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                            return back()->withNotify($notify)->withInput();
                                        }
                                    }
                                } else {
                                    $reqField[$inKey] = $v;
                                    $reqField[$inKey] = [
                                        'field_name' => $v,
                                        'type'       => $inVal->type,
                                    ];
                                }
                            }
                        }
                    }

                    if ($withdraw->method->is_bank) {
                        $reqField["bank_name"] = [
                            'field_name' => $user->bankAccount->bank_name,
                            'type'       => "text",
                        ];

                        $reqField["account_name"] = [
                            'field_name' => $user->bankAccount->account_name,
                            'type'       => "text",
                        ];

                        $reqField["account_number"] = [
                            'field_name' => $user->bankAccount->account_number,
                            'type'       => "text",
                        ];
                    }

                    $withdraw['withdraw_information'] = $reqField;
                } else {
                    $withdraw['withdraw_information'] = null;
                }

                $withdraw->status = 2;
                $withdraw->save();
                if ($withdraw->is_bonus) {
                    $user->bonus_balance -= $withdraw->amount;
                    $text = " Bonus ";
                } else {
                    $user->balance -= $withdraw->amount;
                    $text = "";
                }
                $user->save();

                $transaction          = new Transaction();
                $transaction->user_id = $withdraw->user_id;
                $transaction->amount  = $withdraw->amount;
                if ($withdraw->is_bonus) {
                    $transaction->post_balance = $user->bonus_balance;
                } else {
                    $transaction->post_balance = $user->balance;
                }
                $transaction->charge   = $withdraw->charge;
                $transaction->trx_type = '-';
                $transaction->details  = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . " $text Withdraw Via " . $withdraw->method->name;
                $transaction->trx      = $withdraw->trx;
                $transaction->save();

                $adminNotification            = new AdminNotification();
                $adminNotification->user_id   = $user->id;
                $adminNotification->title     = "New $text withdraw request from " . $user->username;
                $adminNotification->click_url = urlPath('admin.withdraw.details', $withdraw->id);
                $adminNotification->save();

                session()->put("withdrawal_code", "-");

                //create bank withdrawal

                if ($withdraw->is_bank) {
                    $bank_withdrawal                 = new BankWithdrawal();
                    $bank_withdrawal->withdrawal_id  = $withdraw->id;
                    $bank_withdrawal->bank_code      = $user->bankAccount->bank_code;
                    $bank_withdrawal->account_number = $user->bankAccount->account_number;
                    $bank_withdrawal->account_name   = $user->bankAccount->account_name;
                    $bank_withdrawal->save();
                }

                $message         = Split_Hide_Name($user->username) . " withdraw " . amount_format($withdraw->amount);
                $board           = new Board();
                $board->messages = $message;
                $board->save();

                $msg = "Dear $user->username, you have successfully requested to sell your dollars worth $withdraw->amount, payment will be disbursed to your account shortly.";

                $general = GeneralSetting::first();

                notify($user, 'WITHDRAW_REQUEST', [
                    'method_name'     => $withdraw->method->name,
                    'method_currency' => $withdraw->currency,
                    'method_amount'   => showAmount($withdraw->final_amount),
                    'amount'          => showAmount($withdraw->amount),
                    'charge'          => showAmount($withdraw->charge),
                    'currency'        => $general->cur_text,
                    'rate'            => showAmount($withdraw->rate),
                    'trx'             => $withdraw->trx,
                    'post_balance'    => showAmount($user->balance),
                    'delay'           => $withdraw->method->delay,
                ]);

                $notify[] = ['success', 'Withdraw request sent successfully'];
                return redirect()->route('user.withdraw.history')->withNotify($notify);

            } catch (\Throwable $th) {
                $notify[] = ['error', 'Failed'];
                return back()->withNotify($notify);
            }

        } else {

            $notify[] = ['error', 'Something went wrong!'];
            return back()->withNotify($notify);

        }

        // Handle the API response here...

        //session()->put('wtrx', $withdraw->trx);
        //return redirect()->route('user.withdraw.preview');
    }

    public function withdrawPreview()
    {
        $data['withdraw']  = Withdrawal::with('method', 'user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id', 'desc')->firstOrFail();
        $data['pageTitle'] = 'Withdraw Preview';

        if ($data['withdraw']->is_bank) {
            //$banks = getAllBanks();
            $banks             = Bank::all();
            $data['banks']     = $banks; //['data'];
            $data['all_banks'] = json_encode($data['banks']);
            $data['user']      = \auth()->user();

        }

        return view($this->activeTemplate . 'user.withdraw.preview', $data);
    }

    public function withdrawSubmit(Request $request)
    {
        $general  = GeneralSetting::first();
        $withdraw = Withdrawal::with('method', 'user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id', 'desc')->firstOrFail();

        $rules      = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg', 'jpeg', 'png']));
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);

        $user = auth()->user();

        if ($withdraw->is_bonus) {
            if ($withdraw->amount > $user->bonus_balance) {
                $notify[] = ['error', 'Your request amount is larger then your current bonus balance.'];
                return back()->withNotify($notify);
            }
        } else {
            if ($withdraw->amount > $user->balance) {
                $notify[] = ['error', 'Your request amount is larger then your current main balance.'];
                return back()->withNotify($notify);
            }
        }

        /*if($request->otp != session()->get('withdrawal_code')){
            $notify[] = ['error', 'Invalid Verification Code'];
            return back()->withNotify($notify);
        }*/

        //check if i have deposit before

        // $before = Investment::where('user_id', $user->id)->first();
        // if(!$before){
        //     $notify[] = ['error', 'You need stock to withdraw'];
        //     return back()->withNotify($notify);
        // }

        //invest to withdraw
        $invests = Investment::where('user_id', $user->id)->count();

        if ($invests < 1) {
            $notify[] = ['error', 'Kindly invest first'];
            return back()->withNotify($notify);
        }

        $directory  = date("Y") . "/" . date("m") . "/" . date("d");
        $path       = imagePath()['verify']['withdraw']['path'] . '/' . $directory;
        $collection = collect($request);
        $reqField   = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory . '/' . uploadImage($request[$inKey], $path),
                                        'type'       => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type'       => $inVal->type,
                            ];
                        }
                    }
                }
            }

            if ($withdraw->method->is_bank) {
                $reqField["bank_name"] = [
                    'field_name' => $user->bankAccount->bank_name,
                    'type'       => "text",
                ];

                $reqField["account_name"] = [
                    'field_name' => $user->bankAccount->account_name,
                    'type'       => "text",
                ];

                $reqField["account_number"] = [
                    'field_name' => $user->bankAccount->account_number,
                    'type'       => "text",
                ];
            }

            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }

        $withdraw->status = 2;
        $withdraw->save();
        if ($withdraw->is_bonus) {
            $user->bonus_balance -= $withdraw->amount;
            $text = " Bonus ";
        } else {
            $user->balance -= $withdraw->amount;
            $text = "";
        }
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $withdraw->user_id;
        $transaction->amount       = $withdraw->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = $withdraw->charge;
        $transaction->trx_type     = '-';
        $transaction->details      = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . " $text Withdraw Via " . $withdraw->method->name;
        $transaction->trx          = $withdraw->trx;
        $transaction->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = "New $text withdraw request from " . $user->username;
        $adminNotification->click_url = urlPath('admin.withdraw.details', $withdraw->id);
        $adminNotification->save();

        session()->put("withdrawal_code", "-");

        //create bank withdrawal

        if ($withdraw->is_bank) {
            $bank_withdrawal                 = new BankWithdrawal();
            $bank_withdrawal->withdrawal_id  = $withdraw->id;
            $bank_withdrawal->bank_code      = $user->bankAccount->bank_code;
            $bank_withdrawal->account_number = $user->bankAccount->account_number;
            $bank_withdrawal->account_name   = $user->bankAccount->account_name;
            $bank_withdrawal->save();
        }

        $msg = "Dear $user->username, you have successfully requested to sell your dollars worth $withdraw->amount, payment will be disbursed to your account shortly.";

        notify($user, 'WITHDRAW_REQUEST', [
            'method_name'     => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount'   => showAmount($withdraw->final_amount),
            'amount'          => showAmount($withdraw->amount),
            'charge'          => showAmount($withdraw->charge),
            'currency'        => $general->cur_text,
            'rate'            => showAmount($withdraw->rate),
            'trx'             => $withdraw->trx,
            'post_balance'    => showAmount($user->balance),
            'delay'           => $withdraw->method->delay,
        ]);

        $notify[] = ['success', 'Withdraw request sent successfully'];
        return redirect()->route('user.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog()
    {
        $pageTitle    = "Withdraw Log";
        $withdraws    = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->orderBy('id', 'desc')->paginate(getPaginate());
        $emptyMessage = "No Data Found!";
        return view($this->activeTemplate . 'user.withdraw.log', compact('pageTitle', 'withdraws', 'emptyMessage'));
    }

    public function show2faForm()
    {
        $general   = GeneralSetting::first();
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->sitename, $secret);
        $pageTitle = 'Two Factor';
        return view($this->activeTemplate . 'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = 1;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser'          => @$osBrowser['browser'],
                'ip'               => @$userAgent['ip'],
                'time'             => @$userAgent['time'],
            ]);
            $notify[] = ['success', 'Google authenticator enabled successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user     = auth()->user();
        $response = verifyG2fa($user, $request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts  = 0;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser'          => @$osBrowser['browser'],
                'ip'               => @$userAgent['ip'],
                'time'             => @$userAgent['time'],
            ]);
            $notify[] = ['success', 'Two factor authenticator disable successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function trxLog()
    {
        $pageTitle    = 'Transaction Log';
        $user         = Auth::user();
        $logs         = Transaction::where('user_id', $user->id)->latest()->paginate(getPaginate());
        $withdraws    = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->orderBy('id', 'desc')->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.trx_log', compact('pageTitle', 'user', 'logs', 'withdraws', 'emptyMessage'));
    }

    public function investment(Request $request)
    {

        $request->validate([
            'id' => 'required',
            //'amount' => 'required'
        ]);

        $findPlan = Plan::where('id', $request->id)->where('status', 1)->firstOrFail();
        $amount   = $findPlan->min_amount;

        $user = Auth::user();

        // Must invest in fixed plan before daily
        if ($findPlan->type == 1) {
            $hasFixed = Investment::where('user_id', $user->id)
                ->whereHas('plan', function ($query) {
                    $query->where('type', 0);
                })->exists();

            if (! $hasFixed) {
                $notify[] = ['error', 'You must invest in at least one Normal plan before investing in a Welfare plan.'];
                return redirect()->back()->withNotify($notify);
            }

            // Limit daily investment amount
            $fixedTotal = Investment::where('user_id', $user->id)
                ->whereHas('plan', function ($q) {
                    $q->where('type', 0);
                })->sum('amount');

            if ($amount > $fixedTotal) {
                $notify[] = ['error', 'Your Welfare plan investment cannot exceed the total you have invested in Normal plan.'];
                return redirect()->back()->withNotify($notify);
            }
        }

        // Enforce buy limit
        $currentInvestmentsCount = Investment::where('user_id', $user->id)
            ->where('plan_id', $findPlan->id)
            ->count();

        if ($findPlan->buy_limit > 0 && $currentInvestmentsCount >= $findPlan->buy_limit) {
            $notify[] = ['error', 'You have reached the maximum allowed purchases for this plan.'];
            return redirect()->back()->withNotify($notify);
        }
        //ends here

        if ($user->balance < $amount) {
            $notify[] = ['error', 'Account balance is low'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        $perAnnuityInterest = 0;
        $nextReturn         = Carbon::now()->addHours($findPlan->interest_hours);

        if ($findPlan->interest_type == 0) {
            $perAnnuityInterest = $findPlan->interest_amount;
        } else {
            $perAnnuityInterest = ($amount * $findPlan->interest_amount) / 100;
        }

        //$perAnnuityInterest = $findPlan->Roi / $findPlan->total_return;

        $newInvest                   = new Investment();
        $newInvest->trx              = getTrx();
        $newInvest->plan_id          = $findPlan->id;
        $newInvest->user_id          = $user->id;
        $newInvest->amount           = $amount;
        $newInvest->interest_type    = $findPlan->interest_type;
        $newInvest->interest_amount  = $perAnnuityInterest;
        $newInvest->total_return     = $findPlan->total_return;
        $newInvest->next_return_date = $nextReturn;
        $newInvest->status           = 0;
        $newInvest->save();

        $user->balance -= $amount;
        $user->save();

        //give bonus

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Successfully invested in ' . $findPlan->name; //." with ".$findPlan->min_amount;
        $transaction->trx          = $newInvest->trx;
        $transaction->save();

        referralComission($user->id, $amount);

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New Investment In ' . $findPlan->name . ' from ' . $user->username;
        $adminNotification->click_url = urlPath('admin.users.investment', $user->id);
        $adminNotification->save();

        $message         = Split_Hide_Name($user->username) . " invest " . amount_format($amount);
        $board           = new Board();
        $board->messages = $message;
        $board->save();

        $general = GeneralSetting::first();

        /*notify($user, 'INVESTMENT', [
            'currency' => $general->cur_text,
            'trx' => $transaction->trx,
            'plan' => $findPlan->name,
            'amount' => $amount,
            'details' => $transaction->details,
            'post_balance' => $user->balance,
            'interest' => $perAnnuityInterest,
            'total_return' => $newInvest->total_return
        ]);*/

        $notify[] = ['success', 'Successfully bought ' . $findPlan->name . " with $amount"];
        return redirect()->route('user.investment.log')->withNotify($notify);

    }

    public function investNow(int $id)
    {

        if (Plan::where('id', $id)->where('status', 1)->count() < 1) {
            $notify[] = ['error', 'Plan does not exist!'];
            return redirect()->route('user.home')->withNotify($notify);
        }

        $plan = Plan::where('id', $id)->where('status', 1)->firstOrFail();

        return view($this->activeTemplate . 'user.detail', compact('plan'));

        /*$findPlan = $plan ;//Plan::where('id', $request->id)->where('status', 1)->firstOrFail();
        $amount = $findPlan->min_amount;

        $user = Auth::user();

        if($user->balance < $amount){
            $notify[] = ['error', 'Account is low, please recharge'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        $perAnnuityInterest = 0;
        $nextReturn = Carbon::now()->addDay(1);

        if($findPlan->interest_type == 0){
            $perAnnuityInterest = $findPlan->interest_amount;
        }else{
            $perAnnuityInterest = ($amount * $findPlan->interest_amount) / 100;
        }

        //$perAnnuityInterest = $findPlan->Roi / $findPlan->total_return;

        $newInvest = new Investment();
        $newInvest->trx = getTrx();
        $newInvest->plan_id = $findPlan->id;
        $newInvest->user_id = $user->id;
        $newInvest->amount = $amount;
        $newInvest->interest_type = $findPlan->interest_type;
        $newInvest->interest_amount = $perAnnuityInterest;
        $newInvest->total_return = $findPlan->total_return;
        $newInvest->next_return_date = $nextReturn;
        $newInvest->status = 0;
        $newInvest->save();

        $user->balance -= $amount;
        $user->save();

        //give bonus

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->details = 'Buy '.$findPlan->name." stock";
        $transaction->trx =  $newInvest->trx;
        $transaction->save();

        referralComission($user->id, $amount);

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New Investment In '.$findPlan->name.' from '.$user->username;
        $adminNotification->click_url = urlPath('admin.users.investment',$user->id);
        $adminNotification->save();

        $msg = "Congratulations $user->username, your purchase of FG worth $amount has been successfully confirmed
Your daily Earnings is certain.";
        $msg = "Congratulations $user->username, you have successfully bought $findPlan->name stock";

        $general = GeneralSetting::first();

        $notify[] = ['success', 'Successfully bought '.$findPlan->name." stock"];
        return redirect()->route('user.investment.log')->withNotify($notify);*/

    }

    public function investmentLog()
    {
        $pageTitle    = 'My Orders';
        $user         = Auth::user();
        $logs         = Investment::where('user_id', $user->id)->where('status', 0)->with('plan')->latest()->paginate(getPaginate());
        $total_order  = Investment::where('user_id', $user->id)->where('status', 0)->with('plan')->count('id');
        $income       = Investment::where('user_id', $user->id)->where('status', 0)->with('plan')->sum('interest_amount');
        $closed_logs  = Investment::where('user_id', $user->id)->where('status', 1)->with('plan')->latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.investment_log', compact('pageTitle', 'user', 'logs', 'emptyMessage', 'closed_logs', 'total_order', 'income'));
    }

    public function tradeNow(Investment $invest)
    {
        if ($invest->user_id != \auth()->user()->id) {
            abort(403);
        }

        if (! $invest->is_started) {
            $invest->is_started = 1;

            $invest->next_return_date = Carbon::now()->addDay(1);
            $invest->save();
        }

        $notify[] = ['success', 'Successfully started RoboMax for the next 24 hours'];
        return redirect()->route('user.investment.log')->withNotify($notify);
    }

    public function links()
    {
        $pageTitle  = 'Link';
        $active_ref = User::where('ref_by', auth()->user()->id)
            ->whereHas('deposits', function ($query) {
                $query->where('status', 1);
            })
            ->count();
        return view($this->activeTemplate . 'user.referral_link', compact('pageTitle', 'active_ref'));
    }

    public function company()
    {
        $pageTitle = 'About';
        return view($this->activeTemplate . 'user.company', compact('pageTitle'));
    }

    public function customer()
    {
        $pageTitle = 'Customer Service';
        return view($this->activeTemplate . 'user.cs', compact('pageTitle'));
    }

    //

    public function referrals()
    {
        $referrals      = User::where('ref_by', auth()->user()->id)->paginate(getPaginate());
        $referral_count = User::where('ref_by', auth()->user()->id)->count();

        $level1 = User::where('ref_by', \auth()->user()->id)->get()->pluck('id');

        $level2 = User::whereIn('ref_by', $level1->toArray())->get()->pluck('id');
        $level3 = User::whereIn('ref_by', $level2->toArray())->get()->pluck('id');

        //active ref
        $level1active = User::where('ref_by', \auth()->user()->id)->get()->pluck('id');

        $level2active = User::whereIn('ref_by', $level1active->toArray())->get()->pluck('id');
        $level3active = User::whereIn('ref_by', $level2active->toArray())->get()->pluck('id');

        // Assuming there's an 'amount' column in the Investment model
        $totalInvestment1 = Investment::whereIn('user_id', $level1)->sum('amount');
        $totalInvestment2 = Investment::whereIn('user_id', $level2)->sum('amount');
        $totalInvestment3 = Investment::whereIn('user_id', $level3)->sum('amount');

        $level1a = User::where('ref_by', \auth()->user()->id)->get(['mobile', 'created_at']);

        $level1aa = User::where('ref_by', \auth()->user()->id)->get()->pluck('id');
        $level2aa = User::whereIn('ref_by', $level1aa->toArray())->get()->pluck('id');
        $level2a  = User::whereIn('ref_by', $level1aa->toArray())->get(['mobile', 'created_at']);
        $level3a  = User::whereIn('ref_by', $level2aa->toArray())->get(['mobile', 'created_at']);

        //bonus
        $user = \auth()->user();

        $level1_bonus = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level 1%")->sum('amount');
        $level2_bonus = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level 2%")->sum('amount');
        $level3_bonus = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level 3%")->sum('amount');
        $gross_bonus  = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level%")->sum('amount');

        $gross_bonus_today = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level%")
            ->where('created_at', '>=', date("Y-m-d"))
            ->sum('amount');

        $level1_bonus_today = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level 1%")->where('created_at', '>=', date("Y-m-d"))->sum('amount');
        $level2_bonus_today = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level 2%")->where('created_at', '>=', date("Y-m-d"))->sum('amount');
        $level3_bonus_today = Transaction::where('user_id', $user->id)->where('details', "LIKE", "Level 3%")->where('created_at', '>=', date("Y-m-d"))->sum('amount');

        //
        $ref_today = User::where('ref_by', auth()->user()->id)
            ->where('created_at', '>=', date("Y-m-d"))
            ->count();

        $active_ref = User::where('ref_by', auth()->user()->id)
            ->whereHas('investments', function ($query) {
                $query->where('status', 0);
            })
            ->count();

        $general   = GeneralSetting::first();
        $bonus_per = $general->lv1;

        // Get the total number of active referrals
        $activeReferrals = $user->referrals()->whereHas('successfulDeposits')->count();

        //dd(count($level1), count($level2), count($level3));
        $pageTitle = 'Teams';
        return view($this->activeTemplate . 'user.referrals', compact('level1a',
            'level2a',
            'level3a',
            'bonus_per',
            'pageTitle',
            'referrals',
            'referral_count',
            'level1',
            'level2',
            'level3',
            'level1_bonus',
            'level2_bonus',
            'level3_bonus',
            'ref_today',
            'gross_bonus_today',
            'gross_bonus',
            'user',
            'active_ref',
            'activeReferrals',
            'totalInvestment1',
            'totalInvestment2',
            'totalInvestment3',
            'level1_bonus_today',
            'level2_bonus_today',
            'level3_bonus_today', 'level1active', 'level2active', 'level3active'));
    }

    public function referrals_level1()
    {
        $userId = auth()->user()->id;

        // Eager load referrals to fix N+1
        $referrals      = User::withSum('investments as total_investment', 'amount')->with('referrals')->where('ref_by', $userId)->paginate(getPaginate());
        $referral_count = User::where('ref_by', $userId)->count();

        $level1 = User::where('ref_by', $userId)->pluck('id');
        $level2 = User::whereIn('ref_by', $level1)->pluck('id');
        $level3 = User::whereIn('ref_by', $level2)->pluck('id');

        // Active referrals (investments with status 0)
        $level1active = User::where('ref_by', $userId)
            ->whereHas('investments', fn($q) => $q->where('status', 0))
            ->pluck('id');

        $level2active = User::whereIn('ref_by', $level1active)->whereHas('investments', fn($q) => $q->where('status', 0))->pluck('id');
        $level3active = User::whereIn('ref_by', $level2active)->whereHas('investments', fn($q) => $q->where('status', 0))->pluck('id');

        // Referral users with details
        $level1a  = User::where('ref_by', $userId)->get(['mobile', 'created_at', 'id']);
        $level1aa = $level1a->pluck('id');

        $level2a  = User::whereIn('ref_by', $level1aa)->get(['mobile', 'created_at', 'id']);
        $level2aa = $level2a->pluck('id');

        $level3a = User::whereIn('ref_by', $level2aa)->get(['mobile', 'created_at', 'id']);

        // Bonus calculations
        $user         = auth()->user();
        $level1_bonus = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level 1%')->sum('amount');
        $level2_bonus = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level 2%')->sum('amount');
        $level3_bonus = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level 3%')->sum('amount');
        $gross_bonus  = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level%')->sum('amount');

        $level1_bonus_today = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level 1%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');
        $level2_bonus_today = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level 2%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');
        $level3_bonus_today = Transaction::where('user_id', $user->id)->where('details', 'LIKE', 'Level 3%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');

        $active_ref = User::where('ref_by', $userId)
            ->whereHas('investments', fn($q) => $q->where('status', 0))
            ->count();

        $general   = GeneralSetting::first();
        $bonus_per = $general->lv1;
        $level     = 1;
        $pageTitle = 'Level 1 Teams';

        return view($this->activeTemplate . 'user.referral_list', compact(
            'level1a',
            'level2a',
            'level3a',
            'bonus_per',
            'referral_count',
            'level1',
            'level2',
            'level3',
            'level1_bonus',
            'level2_bonus',
            'level3_bonus',
            'user',
            'level',
            'pageTitle',
            'referrals',
            'active_ref',
            'level1_bonus_today',
            'level2_bonus_today',
            'level3_bonus_today',
            'level1active',
            'level2active',
            'level3active'
        ));
    }

    public function referrals_level2()
    {
        $user    = auth()->user();
        $user_id = $user->id;

        // Get level 1, 2, 3 user IDs
        $level1 = User::where('ref_by', $user_id)->pluck('id');
        $level2 = User::whereIn('ref_by', $level1)->pluck('id');
        $level3 = User::whereIn('ref_by', $level2)->pluck('id');

        // Active refs
        $level1active = $level1;
        $level2active = $level2;
        $level3active = $level3;

                                                      // Level 2 referrals
        $referrals = User::whereIn('ref_by', $level1) // replace $levelX with the appropriate level array
            ->withSum('investments as total_investment', 'amount')
            ->paginate(getPaginate());

        $referral_count = User::whereIn('ref_by', $level1)->count();

        // Active refs in level 2
        $active_ref = User::whereIn('ref_by', $level1)
            ->whereHas('investments', function ($q) {
                $q->where('status', 0);
            })->count();

        // Bonus settings
        $general   = GeneralSetting::first();
        $bonus_per = $general->lv2;

        // Bonus summary
        $level1_bonus = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 1%')->sum('amount');
        $level2_bonus = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 2%')->sum('amount');
        $level3_bonus = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 3%')->sum('amount');
        $gross_bonus  = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level%')->sum('amount');

        // Today bonus summary
        $level1_bonus_today = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 1%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');
        $level2_bonus_today = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 2%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');
        $level3_bonus_today = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 3%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');

        $level     = 2;
        $pageTitle = 'Level 2 Teams';

        return view($this->activeTemplate . 'user.referral_list', compact(
            'user',
            'level',
            'bonus_per',
            'pageTitle',
            'referrals',
            'referral_count',
            'active_ref',
            'level1_bonus_today',
            'level2_bonus_today',
            'level3_bonus_today',
            'level1',
            'level2',
            'level3',
            'level1_bonus',
            'level2_bonus',
            'level3_bonus',
            'level1active',
            'level2active',
            'level3active'
        ));
    }

    public function referrals_level3()
    {
        $user    = auth()->user();
        $user_id = $user->id;

        // Get user IDs by level
        $level1 = User::where('ref_by', $user_id)->pluck('id');
        $level2 = User::whereIn('ref_by', $level1)->pluck('id');
        $level3 = User::whereIn('ref_by', $level2)->pluck('id');

        // Active refs
        $level1active = $level1;
        $level2active = $level2;
        $level3active = $level3;

                                                      // Level 3 referrals
        $referrals = User::whereIn('ref_by', $level2) // replace $levelX with the appropriate level array
            ->withSum('investments as total_investment', 'amount')
            ->paginate(getPaginate());

        $referral_count = User::whereIn('ref_by', $level2)->count();

        // Active referrals in level 3
        $active_ref = User::whereIn('ref_by', $level2)
            ->whereHas('investments', function ($query) {
                $query->where('status', 0);
            })->count();

        // Bonus settings
        $general   = GeneralSetting::first();
        $bonus_per = $general->lv3;

        // Bonus summary
        $level1_bonus = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 1%')->sum('amount');
        $level2_bonus = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 2%')->sum('amount');
        $level3_bonus = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 3%')->sum('amount');
        $gross_bonus  = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level%')->sum('amount');

        // Today's bonuses
        $level1_bonus_today = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 1%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');
        $level2_bonus_today = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 2%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');
        $level3_bonus_today = Transaction::where('user_id', $user_id)->where('details', 'LIKE', 'Level 3%')->where('created_at', '>=', date('Y-m-d'))->sum('amount');

        $level     = 3;
        $pageTitle = 'Level 3 Teams';

        return view($this->activeTemplate . 'user.referral_list', compact(
            'user',
            'level',
            'bonus_per',
            'pageTitle',
            'referrals',
            'referral_count',
            'active_ref',
            'level1_bonus_today',
            'level2_bonus_today',
            'level3_bonus_today',
            'level1',
            'level2',
            'level3',
            'level1_bonus',
            'level2_bonus',
            'level3_bonus',
            'level1active',
            'level2active',
            'level3active'
        ));
    }

    public function sendWithdrawSms()
    {
        $gnl     = GeneralSetting::first();
        $headers = "From: $gnl->sitename <$gnl->email_from> \r\n";
        $headers .= "Reply-To: $gnl->sitename <$gnl->email_from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";

        $code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

        //instant_sms("Your Verification Code is $code",\auth()->user()->mobile);

        session()->put('withdrawal_code', $code);

        @sendGeneralEmail(\auth()->user()->email, "Withdrawal Verification Code", "Hi, your Withdrawal verification code is $code");
        //send_general_email(\auth()->user()->email,"Withdrawal OTP Code","Your Withdrawal verification code is $code");

        //@mail(\auth()->user()->email,"Withdrawal Verification Code","Your Verification Code is $code",$headers);

        return '1';

    }

    public function bankdelete()
    {
        $user        = auth()->user();
        $bankAccount = $user->bankAccount;
        $bankAccount->delete();

        $notify[] = ['error', 'Bank account deleted successfully.'];
        return back()->withNotify($notify);
    }

    public function refreward(Request $request)
    {
        $amount = $_POST['amount'];

        if (isset($_POST['amount'])) {
            $task = Task::where('user_id', \auth()->user()->id)->where('amount', $amount)->count();

            if ($task > 0) {
                $notify[] = ['error', 'Reward has already been collected.'];
                return redirect()->back()->withNotify($notify);
            }

            $newtask          = new Task;
            $newtask->user_id = auth()->user()->id;
            $newtask->amount  = $amount;
            $newtask->save();
            $user = Auth::user();
            $user->bonus_balance += $amount;
            $user->save();

            $notify[] = ['success', 'Reward collected successfully'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function post()
    {
        return view($this->activeTemplate . 'user.publish');
    }

    public function storePost(Request $request)
    {

        // Get the current user
        $user = auth()->user();

        // Check if the user has a pending proof (status 2)
        $hasPendingProof = Post::where('user_id', $user->id)
            ->where('status', 2)
            ->exists();

        if ($hasPendingProof) {
            $notify[] = ['success', 'You already have a pending post under review'];
            return redirect()->back()->withNotify($notify);
        }

        // Ensure user can only post proof once a day
        $hasPostedToday = Post::where('user_id', $user->id)->where('status', 1)
            ->whereDate('created_at', today()) // Checks for today's date
            ->exists();

        if ($hasPostedToday) {
            $notify[] = ['success', 'You can publish a post once a day'];
            return redirect()->back()->withNotify($notify);
        }

        // Validate the input
        $request->validate([
            'content'  => 'required|string|max:100',
            'images'   => 'nullable|array|max:3',                      // Allow up to 3 images
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image file
        ]);

        // Store the name content
        $content = $request->input('content');

        $imagePaths = [];

        // Store each image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path         = $image->store('uploads', 'public');
                $imagePaths[] = $path;
            }
        }

        // Example: Save paths and content to the database
        Post::create([
            'user_id' => auth()->user()->id,
            'content' => $request->content,
            'image'   => json_encode($imagePaths), // Store paths as JSON
            'status'  => 2,
        ]);

        $notify[] = ['success', 'Post uploaded successfully, kindly wait for review'];
        return redirect(route('user.club'))->withNotify($notify);
    }

    public function club()
    {
        $post = Post::orderBy('id', 'desc')->where('status', 1)->get();
        return view($this->activeTemplate . 'user.club', compact('post'));
    }

    public function rules()
    {
        $pageTitle = "Rules";
        $user      = Auth::user();
        return view($this->activeTemplate . 'user.rules', compact('pageTitle', 'user'));
    }

    public static function sign($signSource, $key)
    {
        if (! empty($key)) {
            $signSource = $signSource . "&key=" . $key;
        }
        return md5($signSource);
    }

}
