<?php
 
namespace App\Http\Controllers\Gateway;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Board;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\Gateway;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use App\Models\AdminNotification;
use App\Models\FundTransfer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        return $this->activeTemplate = activeTemplate();
    }

    public function deposit()
    {
        $user = auth()->user();
        $plans = Plan::orderBy('min_amount')->get();
        $pend = Deposit::where('user_id', $user->id)->where('status','2')->first();
        // if($pend){
        //     $notify[] = ['error', 'You currently have a pending deposit, please wait for confirmation or cancellation and try again'];
        //     return back()->withNotify($notify);
        // }
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('name')->get();
        $pageTitle = 'Recharge';
        return view($this->activeTemplate . 'user.payment.deposit', compact('gatewayCurrency', 'pageTitle','plans'));
    }

    public function depositInsert(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|gt:0',
            //'method_code' => 'required',
            //'currency' => 'required',
        ]);

        if($request->deposit_method == 1) {

            $user = auth()->user();


            $gate = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', 1);
            })->first();
            if (!$gate) {
                $notify[] = ['error', 'Invalid gateway'];
                return back()->withNotify($notify);
            }

            if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
                $notify[] = ['error', 'Please follow deposit limit'];
                return back()->withNotify($notify);
            }


            //check pending
            /*$pend = Deposit::where('user_id', $user->id)->where('status','0')->first();
            if($pend){
                $notify[] = ['error', 'You currently have a pending deposit, please wait for confirmation or cancellation and try again'];
                return back()->withNotify($notify);
            }*/


            /*$pend = Deposit::where('user_id', $user->id)->where('status', '2')->first();
            if ($pend) {
                $notify[] = ['error', 'You currently have a pending deposit, please wait for confirmation or cancellation and try again'];
                return back()->withNotify($notify);
            }*/

            $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
            $payable = $request->amount + $charge;
            $final_amo = $payable * $gate->rate;

            $data = new Deposit();
            $data->user_id = $user->id;
            $data->method_code = $gate->method_code;
            $data->method_currency = strtoupper($gate->currency);
            $data->amount = $request->amount;
            $data->charge = $charge;
            $data->rate = $gate->rate;
            $data->final_amo = $final_amo;
            $data->btc_amo = 0;
            $data->btc_wallet = "";
            $data->trx = getTrx();
            $data->try = 0;
            $data->status = 0;
            $data->save();
            session()->put('Track', $data->trx);

            if (1000 > $data->method_code) {
                //route('user.deposit.confirm')
                return redirect()->route('user.deposit.confirm');

            } else {
                return redirect()->route('user.deposit.manual.confirm');

            }

        }else{
            $user = auth()->user();


            $gate = GatewayCurrency::where('gateway_alias','usdt')->first();
            if (!$gate) {
                $notify[] = ['error', 'Invalid gateway'];
                return back()->withNotify($notify);
            }

            if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
                $notify[] = ['error', 'Please follow deposit limit'];
                return back()->withNotify($notify);
            }


            //check pending
            /*$pend = Deposit::where('user_id', $user->id)->where('status','0')->first();
            if($pend){
                $notify[] = ['error', 'You currently have a pending deposit, please wait for confirmation or cancellation and try again'];
                return back()->withNotify($notify);
            }*/


            /*$pend = Deposit::where('user_id', $user->id)->where('status', '2')->first();
            if ($pend) {
                $notify[] = ['error', 'You currently have a pending deposit, please wait for confirmation or cancellation and try again'];
                return back()->withNotify($notify);
            }*/

            $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
            $payable = $request->amount + $charge;
            $final_amo = $payable * $gate->rate;

            $data = new Deposit();
            $data->user_id = $user->id;
            $data->method_code = $gate->method_code;
            $data->method_currency = strtoupper($gate->currency);
            $data->amount = $request->amount;
            $data->charge = $charge;
            $data->rate = $gate->rate;
            $data->final_amo = $final_amo;
            $data->btc_amo = 0;
            $data->btc_wallet = "";
            $data->trx = getTrx();
            $data->try = 0;
            $data->status = 0;
            $data->save();
            session()->put('Track', $data->trx);
            
            return redirect()->route('user.usdt-funding');
        }

        //return redirect()->route('user.deposit.preview');
    }


    public function depositPreview()
    {

        $track = session()->get('Track');
        $data = Deposit::where('trx', $track)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $pageTitle = 'Payment Preview';
        return view($this->activeTemplate . 'user.payment.preview', compact('data', 'pageTitle'));
    }


    public function depositConfirm()
    {
        $track = session()->get('Track');
        //dd($track);


        $deposit = Deposit::where('trx', $track)->where('status', 0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();


        if ($deposit->method_code >= 1000) {
            $this->userDataUpdate($deposit);
            $notify[] = ['success', 'Your deposit request is queued for approval.'];
            return back()->withNotify($notify);
        }


        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($trx)
    {
        $general = GeneralSetting::first();
        $data = Deposit::where('trx', $trx)->first();
        if ($data->status == 0) {
            $data->status = 1;
            $data->save();

            $user = User::find($data->user_id);
            $user->balance += $data->amount;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $data->user_id;
            $transaction->amount = $data->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = $data->charge;
            $transaction->trx_type = '+';
            $transaction->details = 'Deposit Via ' . $data->gatewayCurrency()->name;
            $transaction->trx = $data->trx;
            $transaction->save();


            $referral = User::where('id', $user->ref_by)->first();
            if ($referral) {
                $refAmo = ($data->amount * $general->depo_com) / 100;
                $referral->balance += $refAmo;
                $referral->save();

                $transaction = new Transaction();
                $transaction->user_id = $referral->id;
                $transaction->amount = $refAmo;
                $transaction->post_balance = getAmount($referral->balance);
                $transaction->charge = 0;
                $transaction->trx_type = '+';
                $transaction->details = 'Deposit Commission from ' . $user->username;
                $transaction->trx = $data->trx;
                $transaction->save();

            }

            $adminNotification = new AdminNotification();
            $adminNotification->user_id = $user->id;
            $adminNotification->title = 'Deposit successful via ' . $data->gatewayCurrency()->name;
            $adminNotification->click_url = urlPath('admin.deposit.successful');
            $adminNotification->save();

            notify($user, 'DEPOSIT_COMPLETE', [
                'method_name' => $data->gatewayCurrency()->name,
                'method_currency' => $data->method_currency,
                'method_amount' => showAmount($data->final_amo),
                'amount' => showAmount($data->amount),
                'charge' => showAmount($data->charge),
                'currency' => $general->cur_text,
                'rate' => showAmount($data->rate),
                'trx' => $data->trx,
                'post_balance' => showAmount($user->balance)
            ]);


        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route(gatewayRedirectUrl());
        }
        if ($data->method_code > 999) {

            $pageTitle = 'Manual Deposit Step Confirm';
            $method = $data->gatewayCurrency();
            return view($this->activeTemplate . 'user.manual_payment.manual_confirm', compact('data', 'pageTitle', 'method'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route(gatewayRedirectUrl());
        }

        $params = json_decode($data->gatewayCurrency()->gateway_parameter);

        $rules = [];
        $inputField = [];
        $verifyImages = [];

        if ($params != null) {
            foreach ($params as $key => $custom) {
                $rules[$key] = [$custom->validation];
                if ($custom->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg', 'jpeg', 'png']));
                    array_push($rules[$key], 'max:2048');

                    array_push($verifyImages, $key);
                }
                if ($custom->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($custom->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }
        $this->validate($request, $rules);


        $directory = date("Y") . "/" . date("m") . "/" . date("d");
        $path = imagePath()['verify']['deposit']['path'] . '/' . $directory;
        $collection = collect($request);
        $reqField = [];
        if ($params != null) {
            foreach ($collection as $k => $v) {
                foreach ($params as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory . '/' . uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $inKey];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $data->detail = $reqField;
        } else {
            $data->detail = null;
        }


        $data->status = 2; // pending
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user->id;
        $adminNotification->title = 'Deposit request from ' . $data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();

        $message = Split_Hide_Name($data->user->username)." deposited ".amount_format($data->final_amo);
        $board = new Board();
        $board->messages = $message;
        $board->save();
        $general = GeneralSetting::first();
        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amo),
            'amount' => showAmount($data->amount),
            'charge' => showAmount($data->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($data->rate),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'You have deposit request has been taken.'];
        return redirect()->route('user.deposit.history')->withNotify($notify);
    }


    // public function shpay(Request $request)
    // {
    //     $request->validate([
    //         'amount' => 'required|numeric|gt:0',
    //         //'method_code' => 'required',
    //         //'currency' => 'required',
    //     ]);

    //     $gateway = Gateway::where('alias','Shpay')->first();

    //     $user = auth()->user();
    //     $ref = getTrx();
    //     $url = route('shpay');


    //     $gate = GatewayCurrency::whereHas('method', function ($gate) {
    //         $gate->where('status', 1);
    //     })->first();

    //     if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
    //         $notify[] = ['error', 'Please follow deposit limit'];
    //         return back()->withNotify($notify);
    //     }

    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'https://cashier.ptpay001.com/v1/trans/payIn',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'POST',
    //     CURLOPT_POSTFIELDS =>'{
    //         "mchtNo": "1010583301481141",
    //         "orderNo": "'.$ref.'",
    //         "amount": "'.$request->amount.'",
    //         "callBackUrl": "'.$url.'",
    //         "returnUrl": "https://forge-ng.com"
    //     }',
    //     CURLOPT_HTTPHEADER => array(
    //         'Content-Type: text/json'
    //     ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     //dd($response);

    //     $result = json_decode($response, true);

    //     //dd($result);


    //     //echo $result['message'];
    //     if ($result['msg'] == 'success') {

    //         $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
    //         $payable = $request->amount + $charge;
    //         $final_amo = $payable * $gate->rate;

    //         $data = new Deposit();
    //         $data->user_id = $user->id;
    //         $data->method_code = $gate->method_code;
    //         $data->method_currency = strtoupper($gate->currency);
    //         $data->amount = $request->amount;
    //         $data->charge = $charge;
    //         $data->rate = $gate->rate;
    //         $data->final_amo = $final_amo;
    //         $data->btc_amo = 0;
    //         $data->btc_wallet = "";
    //         $data->trx = $ref;
    //         $data->try = 0;
    //         $data->status = 2;
    //         $data->save();

    //         $link = $result['data']['payUrl'];
    //         return redirect($link);

    //     }else{

    //         //dd($response);

    //         $notify[] = ['error', $result['msg']];
    //         return back()->withNotify($notify);
    //     }
    // }
    
    
    public function shpay(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            //'method_code' => 'required',
            //'currency' => 'required',
        ]);

        $user = auth()->user();


        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $gateway = Gateway::where('alias','Qepay')->first();

        $ref = getTrx();
        $url = route('shpay');
        $time = Carbon::now()->format('Y-m-d H:i:s');
        
        
        
        $merchant_key = json_decode($gateway->gateway_parameters)->depositKey->value; //this is the merchant key

        $version = "1.0";
    
        $mch_id = json_decode($gateway->gateway_parameters)->mchtId->value; //this is the merchant id
    
        $notify_url = "".$url."";
    
        $page_url = "";
    
        $mch_order_no = "". $ref."";
    
        $pay_type = "".$request->gateway."";
        
    
        $trade_amount = "". $request->amount ."";
    
        $order_date = "". $time."";
    
        $bank_code = "";
    
        $goods_name = "plan";
    
        $sign_type = "MD5";
    
        $mch_return_msg = "";
    
        $signStr = "";
    
        if($bank_code != ""){
            $signStr = $signStr."bank_code=".$bank_code."&";
        }
    
        $signStr = $signStr."goods_name=".$goods_name."&";
        $signStr = $signStr."mch_id=".$mch_id."&";    
        $signStr = $signStr."mch_order_no=".$mch_order_no."&";
        if($mch_return_msg != ""){
            $signStr = $signStr."mch_return_msg=".$mch_return_msg."&";
        }
        $signStr = $signStr."notify_url=".$notify_url."&";    
        $signStr = $signStr."order_date=".$order_date."&";
        if($page_url != ""){
            $signStr = $signStr."page_url=".$page_url."&";
        }
        $signStr = $signStr."pay_type=".$pay_type."&";
        $signStr = $signStr."trade_amount=".$trade_amount."&";
        $signStr = $signStr."version=".$version;
        
        $sign = $this->sign($signStr,$merchant_key);
    
        $postdata=array(
        'goods_name'=>$goods_name,
        'mch_id'=>$mch_id,
        'mch_order_no'=>$mch_order_no,
        'notify_url'=>$notify_url,
        'order_date'=>$order_date,
        'pay_type'=>$pay_type,
        'trade_amount'=>$trade_amount,
        'version'=>$version,
        /** 下面这些参数有填写才需要提交，不填写的不需要提交也不需要参与签名 */
        /**'bank_code'=>$bank_code,
        'mch_return_msg'=>$mch_return_msg,
        'page_url'=>$page_url,*/
        'sign_type'=>$sign_type,
        'sign'=>$sign);
    
        $ch = curl_init();    
        curl_setopt($ch,CURLOPT_URL,"https://api.watchglb.com/pay/web"); //支付请求地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response=curl_exec($ch);
    
        //$res=simplexml_load_string($response);
    
        curl_close($ch);

        
        $result = json_decode($response, true);

        //dd($result);



        //echo $result['message'];
        if ($result['tradeResult'] == 1) {

            $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
            $payable = $request->amount + $charge;
            $final_amo = $payable * $gate->rate;

            $data = new Deposit();
            $data->user_id = $user->id;
            $data->method_code = $gate->method_code;
            $data->method_currency = strtoupper($gate->currency);
            $data->amount = $request->amount;
            $data->charge = $charge;
            $data->rate = $gate->rate;
            $data->final_amo = $final_amo;
            $data->btc_amo = 0;
            $data->btc_wallet = "";
            $data->trx = $ref;
            $data->try = 0;
            $data->status = 2;
            $data->save();

            $link = $result['payInfo'];
            return redirect($link);

        }else{

            //dd($response);

            $notify[] = ['error', $result['msg']];
            return back()->withNotify($notify);
        }
    }
    
    
    public function shpayipn(Request $request)
    {
            $jsonData = $request->getContent();
            parse_str($jsonData, $params);

            $amount = $params['amount'] ?? null;
            $mchId = $params['mchId'] ?? null;
            $mchOrderNo = $params['mchOrderNo'] ?? null;
            $merRetMsg = $params['merRetMsg'] ?? '';
            $orderDate = $params['orderDate'] ?? null;
            $orderNo = $params['orderNo'] ?? null;
            $oriAmount = $params['oriAmount'] ?? null;
            $tradeResult = $params['tradeResult'] ?? null;
            $sign = $params['sign'] ?? null;

            // Build signature string for verification
            $signStr = "";
            $signStr = $signStr."amount=".$amount."&";
            $signStr = $signStr."mchId=".$mchId."&";
            $signStr = $signStr."mchOrderNo=".$mchOrderNo."&";
            $signStr = $signStr."merRetMsg=".$merRetMsg."&";
            $signStr = $signStr."orderDate=".$orderDate."&";
            $signStr = $signStr."orderNo=".$orderNo."&";
            $signStr = $signStr."oriAmount=".$oriAmount."&";
            $signStr = $signStr."tradeResult=".$tradeResult;

            // Get merchant key for verification
            $gateway = Gateway::where('alias','Qepay')->first();
            $merchant_key = json_decode($gateway->gateway_parameters)->depositKey->value;

            // Verify signature
            $expectedSign = $this->sign($signStr, $merchant_key);
            if($sign !== $expectedSign){
                echo "Signature error";
                return;
            }

            if($tradeResult == '1')
            {
                $deposit = Deposit::where('trx',$mchOrderNo)->where('status',2)->first();
                if(!$deposit){
                    echo "success";
                    return;
                }
                $deposit->status = 1;
                $deposit->save();

                $user = User::find($deposit->user_id);
                $user->balance = $user->balance + $deposit->amount;
                $user->save();

                $transaction = new Transaction();
                $transaction->user_id = $deposit->user_id;
                $transaction->amount = $deposit->amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge = $deposit->charge;
                $transaction->trx_type = '+';
                $transaction->details = 'Deposit Via Auto';
                $transaction->trx =  $deposit->trx;
                $transaction->save();
            }
            else{
                $deposit = Deposit::where('trx',$mchOrderNo)->where('status',2)->first();
                if($deposit){
                    $deposit->status = 3;
                    $deposit->save();
                }
            }

            echo "success";
    }

    // public function shpayipn(Request $request)
    // {

    //         $traderesult = $request->payStatus;
    //         $ref = $request->orderNo;

    //         if($traderesult == '1')
    //         {
    //             $deposit = Deposit::where('trx',$ref)->where('status',2)->firstOrFail();
    //             $deposit->status = 1;
    //             $deposit->save();

    //             $user = User::find($deposit->user_id);
    //             $user->balance = $user->balance + $deposit->amount;
    //             $user->save();

    //             //$general = GeneralSetting::first();

    //             //$referral = User::where('id',$user->ref_by)->first();


    //             $transaction = new Transaction();
    //             $transaction->user_id = $deposit->user_id;
    //             $transaction->amount = $deposit->amount;
    //             $transaction->post_balance = $user->balance;
    //             $transaction->charge = $deposit->charge;
    //             $transaction->trx_type = '+';
    //             $transaction->details = 'Deposit Via PTPAY';
    //             $transaction->trx =  $deposit->trx;
    //             $transaction->save();
    //         }
    //         else{
    //             $deposit = Deposit::where('trx',$ref)->where('status',2)->firstOrFail();
    //             $deposit->status = 3;
    //             $deposit->save();
    //         }

    // }

    public function shpaywithdraw(Request $request)
    {
        $gateway = Gateway::where('alias','Qepay')->first();

        $ref = getTrx();
        $date = date("Y-m-d H:i:s");
        $mch_id = json_decode($gateway->gateway_parameters)->mchtId->value;
        $merchant_key = json_decode($gateway->gateway_parameters)->depositKey->value;

        $apply_date = $date;
        $bank_code = $request->bank_code;
        $mch_transferId = $ref;
        $receive_account = $request->account_number;
        $receive_name = $request->account_name;
        $transfer_amount = $request->amount;
        $sign_type = "MD5";

        $signStr = "";
        $signStr = $signStr."apply_date=".$apply_date."&";
        if($bank_code != ""){
            $signStr = $signStr."bank_code=".$bank_code."&";
        }
        $signStr = $signStr."mch_id=".$mch_id."&";
        $signStr = $signStr."mch_transferId=".$mch_transferId."&";
        $signStr = $signStr."receive_account=".$receive_account."&";
        $signStr = $signStr."receive_name=".$receive_name."&";
        $signStr = $signStr."transfer_amount=".$transfer_amount;

        $sign = $this->sign($signStr, $merchant_key);

        $url = "https://api.watchglb.com/pay/transfer";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'apply_date' => $apply_date,
            'bank_code' => $bank_code,
            'mch_id' => $mch_id,
            'mch_transferId' => $mch_transferId,
            'receive_account' => $receive_account,
            'receive_name' => $receive_name,
            'transfer_amount' => $transfer_amount,
            'sign_type' => $sign_type,
            'sign' => $sign,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        try {
            $notify[] = ['success', $responseData['result']['message'] ?? 'Transfer submitted'];
            return back()->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Failed'];
            return back()->withNotify($notify);
        }
    }

    public function flutterwaveipn(Request $request){


        $general = GeneralSetting::first();
        $ref = $request['data']['reference'];
        if($request->event=="transfer.completed"){

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.flutterwave.com/v3/transfers/'.$request['data']['id'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$general->flutterwave_key
              ),
            ));

            $responses = curl_exec($curl);

            curl_close($curl);
            $res=json_decode($responses);
            if($res->data->status=="SUCCESSFUL"){
                //true
                $fund = FundTransfer::where('reference', $ref)->first();

                $withdrawal = Withdrawal::where('id', $fund->withdrawal_id)->first();

                $withdrawal->status = 1;
                $withdrawal->save();

            }elseif ($res->data->status=="FAILED") {

                $fund = FundTransfer::where('reference', $ref)->first();

                $withdrawal = Withdrawal::where('id', $fund->withdrawal_id)->first();

                $withdrawal->status = 3;
                $q = $withdrawal->save();
                if ($q) {
                    $user = User::where('id', $withdrawal->user_id)->first();
                    $user->bonus_balance += $withdrawal->amount;
                    $user->save();
                }
            }else{
                $withdrawal = Withdrawal::where('trx', $ref)->first();
                $withdrawal->status = 3;
                $q = $withdrawal->save();
                if ($q) {
                    $user = User::where('id', $withdrawal->user_id)->first();
                    $user->bonus_balance += $withdrawal->amount;
                    $user->save();
                }
            }



        }

    }
    
    
    public function shpaywithdrawipn(Request $request)
    {

        $jsonData = $request->getContent(); // Get the raw JSON input
           
        //Log::info($jsonData);
        
        // Parse the query string into an array
        parse_str($jsonData, $params);
    
        // Retrieve the tradeResult and mchOrderNo values
        $traderesult = $params['tradeResult'] ?? null;
        $ref = $params['merTransferId'] ?? null; // Extracting mchOrderNo value
        
        //Log::info($traderesult);

        if($traderesult == '1'){
            $fund = FundTransfer::where('reference', $ref)->first();

            $withdrawal = Withdrawal::where('id', $fund->withdrawal_id)->first();

            $withdrawal->status = 1;
            $withdrawal->save();
        }
        elseif($traderesult == '2'){
            $fund = FundTransfer::where('reference', $ref)->first();

            $withdrawal = Withdrawal::where('id', $fund->withdrawal_id)->first();
            if($withdrawal->ipn_limit == 0){
                $withdrawal->ipn_limit = 1;
                $withdrawal->status = 3;
                $q = $withdrawal->save();
                if ($q) {
                    $user = User::where('id', $withdrawal->user_id)->first();
                    $user->bonus_balance += $withdrawal->amount;
                    $user->save();
                }
            }
            
        }


    }
    

    // public function shpaywithdrawipn(Request $request)
    // {

    //     try {
    //         $ipnData = $request->json()->all();
    //          $status = $ipnData['transStatus'];
    //         $ref = $ipnData['outTradeNo'];

    //         //Log::info($ipnData);

    //         if($status == 'SUCCESS'){
    //             $withdrawal = Withdrawal::where('trx', $ref)->first();
    //             $withdrawal->status = 1;
    //             $withdrawal->save();
    //         }
    //         elseif($status == 'FAIL'){
    //             $withdrawal = Withdrawal::where('trx', $ref)->first();
    //             $withdrawal->status = 3;
    //             $q = $withdrawal->save();
    //             if ($q) {
    //                 $user = User::where('id', $withdrawal->user_id)->first();
    //                 $user->bonus_balance += $withdrawal->amount;
    //                 $user->save();
    //             }
    //         }
    //     } catch (\Throwable $th) {
    //         // Log the error
    //         Log::error('Error occurred: ' . $th->getMessage());

    //         // You can also include additional context in the log if needed
    //         Log::error('Error occurred', ['exception' => $th]);

    //         // Handle the error response
    //         return response()->json(['error' => 'An error occurred'], 500);
    //     }


    // }
    
    public function queryTransfer(Request $request)
    {
        $gateway = Gateway::where('alias','Qepay')->first();
        $mch_id = json_decode($gateway->gateway_parameters)->mchtId->value;
        $merchant_key = json_decode($gateway->gateway_parameters)->depositKey->value;

        $mch_transferId = $request->mch_transferId;
        $sign_type = "MD5";

        $signStr = "mch_id=".$mch_id."&"."mch_transferId=".$mch_transferId;
        $sign = $this->sign($signStr, $merchant_key);

        $postdata = array(
            'mch_id' => $mch_id,
            'mch_transferId' => $mch_transferId,
            'sign_type' => $sign_type,
            'sign' => $sign,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.watchglb.com/query/transfer");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json(json_decode($response, true));
    }

    public function queryBalance()
    {
        $gateway = Gateway::where('alias','Qepay')->first();
        $mch_id = json_decode($gateway->gateway_parameters)->mchtId->value;
        $merchant_key = json_decode($gateway->gateway_parameters)->depositKey->value;

        $signStr = "mch_id=".$mch_id;
        $sign = $this->sign($signStr, $merchant_key);

        $postdata = array(
            'mch_id' => $mch_id,
            'sign_type' => 'MD5',
            'sign' => $sign,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.watchglb.com/query/balance");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json(json_decode($response, true));
    }

    public function shpayReturn()
    {
        return response('<html><head><script>window.top.location.href="'.route('user.deposit.history').'";</script></head><body>Redirecting...</body></html>')->header('X-Frame-Options', 'ALLOWALL');
    }

    public static function sign($signSource,$key) {
        if (!empty($key)) {
             $signSource = $signSource."&key=".$key;
        }
        return     md5($signSource);
    }






}