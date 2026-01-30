<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{

    public function pending()
    {
        $pageTitle = 'Pending Deposits';
        $emptyMessage = 'No pending deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', 2)->with(['user', 'gateway'])->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits'));
    }


    public function approved()
    {
        $pageTitle = 'Approved Deposits';
        $emptyMessage = 'No approved deposits.';
        $deposits = Deposit::where('method_code','>=',1000)->where('status', 1)->with(['user', 'gateway'])->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits'));
    }

    public function successful()
    {
        $pageTitle = 'Successful Deposits';
        $emptyMessage = 'No successful deposits.';
        $deposits = Deposit::where('status', 1)->with(['user', 'gateway'])->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits'));
    }

    public function rejected()
    {
        $pageTitle = 'Rejected Deposits';
        $emptyMessage = 'No rejected deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', 3)->with(['user', 'gateway'])->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits'));
    }

    public function deposit()
    {
        $gateway = Gateway::where('alias','Shpay')->first();

        try {
                //shpay balance
                $ref = getTrx();
                $date = date("Y-m-d H:i:s");
                $mchid = json_decode($gateway->gateway_parameters)->mchtId->value;
                $appid = json_decode($gateway->gateway_parameters)->appId->value;
                $key = json_decode($gateway->gateway_parameters)->key->value;

                $p = array(
                    "mchtId" => $mchid,
                    "appId" => $appid,
                    "requestTime" => "$date",
                    "signType" => "MD5",
                );

                ksort($p);
                $string = '';
                foreach($p as $oneKey=>$oneValue)
                $string .= $oneKey ."=". $oneValue."&";
                $string_without_last_and = substr($string, 0, -1);
                $digest = $string_without_last_and .$key;
                $sign = strtoupper(md5($digest));

                $url = "https://transapi.shpays.com/v1/trans/appAvailableAmt?appId={$appid}&mchtId={$mchid}&requestTime={$date}&signType=MD5&sign={$sign}";
                // Make the API request
                $response = Http::get($url);

                // You can process the response as needed (e.g., convert JSON to array)
                $responseData = json_decode($response, true);
                try {
                    if (!$responseData) {
                        $shpay = 0;
                    }else{
                        $shpay = $responseData['result']['availableAmt'];
                    }
                } catch (\Throwable $th) {
                    $shpay = 0;
                }
                //shpay end
        } catch (\Throwable $th) {
                $shpay = 0;
        }


        $pageTitle = 'Deposit History';
        $emptyMessage = 'No deposit history available.';
        $deposits = Deposit::with(['user', 'gateway'])->where('status','!=',0)->orderBy('id','desc')->paginate(getPaginate());
        $successful = Deposit::where('status',1)->sum('amount');
        $pending = Deposit::where('status',2)->sum('amount');
        $rejected = Deposit::where('status',3)->sum('amount');
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits','successful','pending','rejected','shpay'));
    }

    public function depositViaMethod($method,$type = null){
        $method = Gateway::where('alias',$method)->firstOrFail();
        if ($type == 'approved') {
            $pageTitle = 'Approved Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('method_code',$method->code)->where('status', 1)->orderBy('id','desc')->with(['user', 'gateway']);
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('method_code',$method->code)->where('status', 3)->orderBy('id','desc')->with(['user', 'gateway']);

        }elseif($type == 'successful'){
            $pageTitle = 'Successful Payment Via '.$method->name;
            $deposits = Deposit::where('status', 1)->where('method_code',$method->code)->orderBy('id','desc')->with(['user', 'gateway']);
        }elseif($type == 'pending'){
            $pageTitle = 'Pending Payment Via '.$method->name;
            $deposits = Deposit::where('method_code','>=',1000)->where('method_code',$method->code)->where('status', 2)->orderBy('id','desc')->with(['user', 'gateway']);
        }else{
            $pageTitle = 'Payment Via '.$method->name;
            $deposits = Deposit::where('status','!=',0)->where('method_code',$method->code)->orderBy('id','desc')->with(['user', 'gateway']);
        }
        $deposits = $deposits->paginate(getPaginate());
        $successful = $deposits->where('status',1)->sum('amount');
        $pending = $deposits->where('status',2)->sum('amount');
        $rejected = $deposits->where('status',3)->sum('amount');
        $methodAlias = $method->alias;
        $emptyMessage = 'No Deposit Found';
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits','methodAlias','successful','pending','rejected'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $emptyMessage = 'No search result was found.';
        $deposits = Deposit::with(['user', 'gateway'])->where('status','!=',0)->where(function ($q) use ($search) {
            $q->where('trx', 'like', "%$search%")->orWhereHas('user', function ($user) use ($search) {
                $user->where('username', 'like', "%$search%");
            });
        });
        if ($scope == 'pending') {
            $pageTitle = 'Pending Deposits Search';
            $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 2);
        }elseif($scope == 'approved'){
            $pageTitle = 'Approved Deposits Search';
            $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 1);
        }elseif($scope == 'rejected'){
            $pageTitle = 'Rejected Deposits Search';
            $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 3);
        }else{
            $pageTitle = 'Deposits History Search';
        }

        $deposits = $deposits->paginate(getPaginate());
        $pageTitle .= '-' . $search;

        return view('admin.deposit.log', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'deposits'));
    }

    public function dateSearch(Request $request,$scope = null){
        $search = $request->date;
        if (!$search) {
            return back();
        }
        $date = explode('-',$search);
        $start = @$date[0];
        $end = @$date[1];
        // date validation
        $pattern = "/\d{2}\/\d{2}\/\d{4}/";
        if ($start && !preg_match($pattern,$start)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.deposit.list')->withNotify($notify);
        }
        if ($end && !preg_match($pattern,$end)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.deposit.list')->withNotify($notify);
        }


        if ($start) {
            $deposits = Deposit::where('status','!=',0)->whereDate('created_at',Carbon::parse($start));
        }
        if($end){
            $deposits = Deposit::where('status','!=',0)->whereDate('created_at','>=',Carbon::parse($start))->whereDate('created_at','<=',Carbon::parse($end));
        }
        if ($request->method) {
            $method = Gateway::where('alias',$request->method)->firstOrFail();
            $deposits = $deposits->where('method_code',$method->code);
        }
        if ($scope == 'pending') {
            $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 2);
        }elseif($scope == 'approved'){
            $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 1);
        }elseif($scope == 'rejected'){
            $deposits = $deposits->where('method_code', '>=', 1000)->where('status', 3);
        }
        $deposits = $deposits->with(['user', 'gateway'])->orderBy('id','desc')->paginate(getPaginate());
        $pageTitle = ' Deposits Log';
        $emptyMessage = 'No Deposit Found';
        $dateSearch = $search;
        return view('admin.deposit.log', compact('pageTitle', 'emptyMessage', 'deposits','dateSearch','scope'));
    }

    public function details($id)
    {
        $general = GeneralSetting::first();
        $deposit = Deposit::where('id', $id)->with(['user', 'gateway'])->firstOrFail();
        $pageTitle = $deposit->user->username.' requested ' . showAmount($deposit->amount) . ' '.$general->cur_text;
        $details = ($deposit->detail != null) ? json_encode($deposit->detail) : null;

        //return $deposit;
        return view('admin.deposit.detail', compact('pageTitle', 'deposit','details'));
    }


    public function approve(Request $request)
    {

        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();
        $deposit->status = 1;
        $deposit->save();

        $user = User::find($deposit->user_id);
        $user->balance = $user->balance + $deposit->amount;
        $user->save();

        $general = GeneralSetting::first();

        $referral = User::where('id',$user->ref_by)->first();


        $transaction = new Transaction();
        $transaction->user_id = $deposit->user_id;
        $transaction->amount = $deposit->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $deposit->charge;
        $transaction->trx_type = '+';
        $transaction->details = 'Deposit Via ' . $deposit->gatewayCurrency()->name;
        $transaction->trx =  $deposit->trx;
        $transaction->save();





        $msg = "Congratulations $user->username, your deposit of $deposit->amount has been successfully confirmed, kindly proceed to hire your robot";

        $msg = "Congratulations $user->username, your deposit of ".amount_format($deposit->amount)." NGN has been confirmed";
        send_to_telegram($msg);





        notify($user, 'DEPOSIT_APPROVE', [
            'method_name' => $deposit->gatewayCurrency()->name,
            'method_currency' => $deposit->method_currency,
            'method_amount' => showAmount($deposit->final_amo),
            'amount' => showAmount($deposit->amount),
            'charge' => showAmount($deposit->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($deposit->rate),
            'trx' => $deposit->trx,
            'post_balance' => showAmount($user->balance)
        ]);
        $notify[] = ['success', 'Deposit request has been approved.'];

        return redirect()->route('admin.deposit.pending')->withNotify($notify);
    }

    public function reject(Request $request)
    {

        $request->validate([
            'id' => 'required|integer'
        ]);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();

        $deposit->admin_feedback = "FAKE";
        $deposit->status = 3;
        $deposit->save();

        $general = GeneralSetting::first();
        notify($deposit->user, 'DEPOSIT_REJECT', [
            'method_name' => $deposit->gatewayCurrency()->name,
            'method_currency' => $deposit->method_currency,
            'method_amount' => showAmount($deposit->final_amo),
            'amount' => showAmount($deposit->amount),
            'charge' => showAmount($deposit->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($deposit->rate),
            'trx' => $deposit->trx,
            'rejection_message' => $request->message
        ]);


        if($request->block && $request->block == 1){
            $user = User::find($deposit->user_id);
            $user->status = 0;
            $user->save();
        }

        $notify[] = ['success', 'Deposit request has been rejected.'];
        return  redirect()->route('admin.deposit.pending')->withNotify($notify);

    }
}