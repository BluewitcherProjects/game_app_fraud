<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 06/08/2022
 * Time: 21:46
 */

namespace App\Http\Services;


use App\Models\BankWithdrawal;
use App\Models\FundTransfer;
use App\Models\GeneralSetting;
use App\Models\Withdrawal;

class TransferServices
{
    private $setting;
    public function __construct()
    {
        $this->setting = GeneralSetting::first();
    }


    function fetchBalance(){
        //https://api.flutterwave.com/v3/balances/:currency


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/balances/NGN",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->setting->flutterwave_key
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            $out = array('status' => false, 'message' => 'Transaction_verification', 'Curl returned error: ' . $err);
            return $out;
        }

        $response_array = json_decode($response,true);

        return $response_array;
    }

    function initiate_transfer($id){
        $withdrawal = Withdrawal::where('id',$id)->first();
        if($withdrawal){
            $amount = $withdrawal->final_amount;

            //check if there is bank_withdrawal

            $bank_withdrawal = BankWithdrawal::where('withdrawal_id', $withdrawal->id)->first();

            if($bank_withdrawal){
                $ref = getTrx();
                $log = $this->make_payment($bank_withdrawal->bank_code, $bank_withdrawal->account_number,$bank_withdrawal->account_name,$amount,"NGN",$ref);

                if($log){

                    //dd($log);

                    $payment = new FundTransfer();
                    $payment->name = $bank_withdrawal->account_name;
                    $payment->description = $this->setting->sitename;
                    $payment->account_number = $bank_withdrawal->account_number;
                    $payment->bank_code = $bank_withdrawal->bank_code;
                    $payment->amount = $amount;
                    $payment->withdrawal_id = $id;
                    $payment->response = json_encode($log);
                    $payment->reference = $log['data']['orderNo'];
                    $payment->save();
                    $withdrawal->status = 1;
                    $withdrawal->save();
                }

            }
        }
    }
    
    function make_payment($account_bank, $account_number, $account_name, $amount, $currency, $ref){

        $secret_key = 'a84ecce3ee664f5e96bcb7a4272b9a56';
        $mch_id = '5j471763';
        
        //dd((int)$amount);
        
        $body = array(
            "mchId" => "$mch_id",
            "passageId" => 26511, // Channel ID
            "orderAmount" => "$amount", // Amount eg. 100 or 100.00 not in kobo but in Naira
            "orderNo" => "". $ref."", // Your Transaction ID. In example i put timestamp but you can put anything you like
            "account" => "$account_number", // Account Number
            "userName" => "$account_name", // Account Name
            "remark" => "$account_bank", // Bank Code
            "notifyUrl" => route('shpaywithdrawipn') // Webhook URL not Redirec URL, with that link callback should be set to that when transaction processed in GTR
          );
        
          // Build Sign
          $sign = $this->buildSignDigest($body, $secret_key);
          $body['sign'] = $sign;
        
          // Convert request data to JSON
          $jsonData = json_encode($body);
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://wg.gtrpay001.com/pay/create',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $jsonData,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        $response_array = json_decode($response,true);

        //dd($response);
        //create a payment log

        return $response_array;

    }
    
    

    // function make_payment($account_bank, $account_number, $amount, $currency){

    //     $params = http_build_query([
    //         "account_bank" => $account_bank,
    //         'account_number' => $account_number,
    //         'amount' => $amount,
    //         'currency' => $currency,
    //         'narration' => $this->setting->sitename
    //     ]);
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.flutterwave.com/v3/transfers",
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POSTFIELDS => $params,
    //         CURLOPT_HTTPHEADER => array(
    //             "Authorization: Bearer ".$this->setting->flutterwave_key
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     if ($err) {
    //         // there was an error contacting the Paystack API
    //         $out = array('status' => false, 'message' => 'Transaction_verification', 'Curl returned error: ' . $err);
    //         return $out;
    //     }

    //     $response_array = json_decode($response,true);

    //     //create a payment log

    //     return $response_array;

    // }
    
    
    
    function buildSignDigest($data, $md5_key) {
      // Remove the 'sign' field from the data
      unset($data['sign']);
      
      // Sort the array by key in ascending order according to ASCII values
      ksort($data);
    
      // Concatenate the string in the format key=value&key=value
      $signString = '';
      foreach ($data as $key => $value) {
          if (!empty($value)) {
              $signString .= $key . '=' . $value . '&';
          }
      }
    
      // Append the private key to the string
      $signString .= 'key=' . $md5_key;
    
      // Perform MD5 signature on the generated string
      $sign = md5($signString);
    
      return $sign;
    }
    
}