<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AuthorizationController extends Controller
{
    public function __construct()
    {
        return $this->activeTemplate = activeTemplate();
    }
    public function checkValidCode($user, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$user->ver_code_send_at) return false;
        if ($user->ver_code_send_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($user->ver_code !== $code) return false;
        return true;
    }


    public function authorizeForm()
    {

        if (auth()->check()) {
            $user = auth()->user();
            if (!$user->status) {
                Auth::logout();
            }elseif (!$user->ev) {
                if (!$this->checkValidCode($user, $user->ver_code)) {
                    $user->ver_code = verificationCode(6);
                    $user->ver_code_send_at = Carbon::now();
                    $user->save();
                    sendEmail($user, 'EVER_CODE', [
                        'code' => $user->ver_code
                    ]);
                }
                $pageTitle = 'Email verification form';
                return view($this->activeTemplate.'user.auth.authorization.email', compact('user', 'pageTitle'));
            }elseif (!$user->sv) {
                if (!$this->checkValidCode($user, $user->ver_code)) {
                    $user->ver_code = verificationCode(6);
                    $user->ver_code_send_at = Carbon::now();
                    $user->save();
                    sendSms($user, 'SVER_CODE', [
                        'code' => $user->ver_code
                    ]);
                }
                $pageTitle = 'SMS verification form';
                return view($this->activeTemplate.'user.auth.authorization.sms', compact('user', 'pageTitle'));
            }elseif (!$user->tv) {
                $pageTitle = 'Google Authenticator';
                return view($this->activeTemplate.'user.auth.authorization.2fa', compact('user', 'pageTitle'));
            }else{
                return redirect()->route('user.home');
            }

        }

        return redirect()->route('user.login');
    }

    public function sendVerifyCode(Request $request)
    {
        $user = Auth::user();


        if ($this->checkValidCode($user, $user->ver_code, 2)) {
            $target_time = $user->ver_code_send_at->addMinutes(2)->timestamp;
            $delay = $target_time - time();
            throw ValidationException::withMessages(['resend' => 'Please Try after ' . $delay . ' Seconds']);
        }
        if (!$this->checkValidCode($user, $user->ver_code)) {
            $user->ver_code = verificationCode(6);
            $user->ver_code_send_at = Carbon::now();
            $user->save();
        } else {
            $user->ver_code = $user->ver_code;
            $user->ver_code_send_at = Carbon::now();
            $user->save();
        }



        if ($request->type === 'email') {
            sendEmail($user, 'EVER_CODE',[
                'code' => $user->ver_code
            ]);

            $notify[] = ['success', 'Email verification code sent successfully'];
            return back()->withNotify($notify);
        } elseif ($request->type === 'phone') {
            sendSms($user, 'SVER_CODE', [
                'code' => $user->ver_code
            ]);
            $notify[] = ['success', 'SMS verification code sent successfully'];
            return back()->withNotify($notify);
        } else {
            throw ValidationException::withMessages(['resend' => 'Sending Failed']);
        }
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'email_verified_code'=>'required'
        ]);


        $email_verified_code = str_replace(' ','',$request->email_verified_code);
        $user = Auth::user();

        if ($this->checkValidCode($user, $email_verified_code)) {
            $user->ev = 1;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return redirect()->route('user.home');
        }
        throw ValidationException::withMessages(['email_verified_code' => 'Verification code didn\'t match!']);
    }

    public function smsVerification(Request $request)
    {
        $request->validate([
            'sms_verified_code' => 'required',
        ]);


        $sms_verified_code =  str_replace(' ','',$request->sms_verified_code);

        $user = Auth::user();
        if ($this->checkValidCode($user, $sms_verified_code)) {
            $user->sv = 1;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return redirect()->route('user.home');
        }
        throw ValidationException::withMessages(['sms_verified_code' => 'Verification code didn\'t match!']);
    }
    public function g2faVerification(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'code' => 'required',
        ]);
        $code = str_replace(' ','',$request->code);
        $response = verifyG2fa($user,$code);
        if ($response) {
            $notify[] = ['success','Verification successful'];
        }else{
            $notify[] = ['error','Wrong verification code'];
        }
        return back()->withNotify($notify);
    }


    function setupAccount(){


        /*$banks = getAllBanks();
        $data['banks'] = $banks['data'];
        $data['all_banks'] = json_encode($data['banks']);*/

        //$banks = Bank::orderBy('name', 'ASC')->get();


        $secret_key = 'c4e1c2f284a14e23b619d687f5482974';
        $mch_id = '64957831';

        $body = array(
            "mchId" => "$mch_id",
            "passageId" => 26511 // Channel ID
          );

          // Build Sign
          $sign = $this->buildSignDigest($body, $secret_key);
          $body['sign'] = $sign;

          // Convert request data to JSON
          $jsonData = json_encode($body);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://wg.gtrpay001.com/pay/bank_code',
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

        curl_close($curl);

        $result = json_decode($response, true);
        //dd($result);

        $data['banks'] = $result;//['data'];
        $data['all_banks'] = json_encode($data['banks']);

        $data['user'] = auth()->user();
        $data['pageTitle'] = "Bind Account";

        //return $data;


        return view($this->activeTemplate.'user.bank-setup', $data);
    }


    function processAccountSetup(Request $request){
        if(auth()->user()->bankAccount){
            return redirect()->intended(route('user.home'));
        }

        $bank = new BankAccount();
        $bank->user_id = auth()->user()->id;
        $bank->bank_name = $request->bank_name;
        $bank->account_name = $request->account_name;
        $bank->account_number = $request->account_number;
        $bank->bank_code = $request->bank_code;
        $bank->save();


        $notify[] = ['success', 'Account setup successfully'];
        return redirect()->intended(route('user.withdraw'))->withNotify($notify);

    }


    function processUsdtAccountSetup(Request $request){
        if(auth()->user()->wallet_address != ""){
            return redirect()->intended(route('user.home'));
        }

        auth()->user()->wallet_address = $request->wallet_address;
        auth()->user()->save();


        $notify[] = ['success', 'USDT Wallet address binded successfully'];
        return redirect()->intended(route('user.account-setup'))->withNotify($notify);

    }

    public function account(){


        $pageTitle = 'Bank Account';


        return view($this->activeTemplate.'user.bank-account', compact('pageTitle'));
    }

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