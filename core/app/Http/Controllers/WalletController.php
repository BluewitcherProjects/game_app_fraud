<?php

namespace App\Http\Controllers;

use App\Models\CryptPayment;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    function payment_callback(Request $request){

        $body = @file_get_contents("php://input");
        $signature = (isset($_SERVER['HTTP_X_PAYSTACK_SIGNATURE']) ? $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] : '');


        //return $request->uuid;

        //Log::debug(json_encode($request));
        //Log::emergency(json_encode($body));
        //return;

        $wallet = $request->address_in;

        if($wallet == ""){
            return;
        }

        Log::debug($wallet);

        //check wallet owner

        $check_wallet = Wallet::where("wallet_address", $wallet)->with('user')->first();

        if(!$check_wallet){
            return;
        }

        $payment_ref = $request->uuid;

        //check existing payment with same ID

        $exisitng_pay = CryptPayment::where("uuid", $payment_ref)->first();

        if($exisitng_pay){
            Log::debug($payment_ref);
            return;
        }

        //update user's balance

        $gate = GatewayCurrency::find(2);
        $rate = $gate->rate;

        $credited = $request->value_coin * 750 ;/// $rate;// - 1; //$request->value_forwarded_coin;// (98.5/100) * $request->value_coin;// // $request->value_forwarded_coin;
        $check_wallet->user->balance += $credited;
        $check_wallet->user->save();


        $payment = new CryptPayment();
        $payment->user_id = $check_wallet->user_id;
        $payment->wallet_address = $wallet;
        $payment->uuid = $payment_ref;
        $payment->address_out = $request->address_out;
        $payment->value_coin = $request->value_coin;
        $payment->value_forwarded_coin = $request->value_forwarded_coin;
        $payment->coin = $request->coin;
        $payment->response_log = json_encode($request);
        $payment->save();

        $transaction = new Transaction();
        $transaction->user_id = $check_wallet->user_id;
        $transaction->amount = getAmount($credited);
        $transaction->post_balance = getAmount($check_wallet->user->balance);
        $transaction->charge = 0;// getAmount($request->value_coin - $credited);
        $transaction->trx_type = '+';
        $transaction->details = 'Deposit using usdt Wallet';
        $transaction->trx =  getTrx();
        $transaction->save();

        //create demo deposit and notify user



        $data = new Deposit();
        $data->user_id = $check_wallet->user_id;
        $data->method_code = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount = (750 * $request->value_coin);// - $transaction->charge;
        $data->charge = $transaction->charge;
        $data->rate = $rate;
        $data->final_amo = getAmount($credited);
        $data->btc_amo = 0;
        $data->btc_wallet = "";
        $data->trx = getTrx();
        $data->try = 0;
        $data->status = 1;
        $data->save();






        $gnl = GeneralSetting::first();
        notify($check_wallet->user, 'DEPOSIT_APPROVE', [
            'method_name' => $data->gatewayCurrency()->name, //$deposit->gatewayCurrency()->name
            'method_currency' => $data->method_currency,
            'method_amount' => getAmount($data->final_amo),
            'amount' => getAmount($data->amount),
            'charge' => getAmount($data->charge),
            'currency' => $gnl->cur_text,
            'rate' => getAmount($data->rate),
            'trx' => $data->trx,
            'post_balance' => $check_wallet->user->balance
        ]);

        $msg = "Congratulations ".$check_wallet->user->username.", your deposit of $request->value_coin USDT has been confirmed";
        send_to_telegram($msg);
        //$transaction->user->notify((new DepositNote($transaction, 'manual-deposit-admin-approved')));

        //create new payment records




        return "*ok*";


    }



}
