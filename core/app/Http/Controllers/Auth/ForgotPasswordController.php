<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\GeneralSetting;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    function showLinkRequestForm(){
        $pageTitle = "Forgot Password";
        return view(activeTemplate() . 'user.auth.passwords.email', compact('pageTitle'));
    }

    public function sendResetCodeEmail(Request $request)
    {
        

        if (isset($_POST['otp'])) {
            $request->validate([
                'phone_number' => 'required|string|max:10'
            ]);

            $general = GeneralSetting::first();
            $user = User::where('mobile', $request->phone_number)->first();
            $otp = rand(1000, 99999);

            if (!$user) {
                return redirect()->back()->with('error', "Phone Number does not exist");
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v2/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "body": "Your one time pass is '.$otp.'. Please, don\'t disclose this to anyone.",
            "from": "'.$general->sitename.'",
            "to": "'.$request->phone_number.'",
            "api_token": "fNtEGb7JAmmVNfvjfeyoTzSZI2bLnCGlPXe28CUDWJtAxVHZaEsiZblFzTVZ",
            "gateway": "otp"
            }',
            CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            //dd($response);
            $result = json_decode($response);

            if ($result->data->status == "success") {
                $user->ver_code = $otp;
                $user->save();
                $notify[] = ['success', $result->data->message];
                return redirect()->back()->withNotify($notify);
            }
            else{
                $notify[] = ['error', 'something went wrong!'];
                return redirect()->back()->withNotify($notify);
            }






        }
        else{
            $request->validate([
                'phone_number' => 'required|string|max:10',
                'password' => 'required|min:6',
                'code' => 'required|max:10'
            ]);

            $user = User::where('mobile', $request->phone_number)->first();

            if (!$user) {
                $notify[] = ['error', "Phone Number does not exist"];
                return redirect()->back()->withNotify($notify);
            }

            if ($user->ver_code == $request->code) {
                $user->password = Hash::make($request->password);
                $user->save();
                $notify[] = ['success', "Password Reset Successfully"];
                return redirect('login.html')->withNotify($notify);
            }
            else{
                $notify[] = ['error', 'Incorrect OTP'];
                return redirect()->back()->withNotify($notify);

            }


        }

        

    
    }

    public function codeVerify(){
        $pageTitle = 'Account Recovery';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error', 'Invalid Request'];
            \Session::flash('modalType', '#resetModal');
            \Session::flash('modal', '#resetModal');
            return redirect()->route('home')->withNotify($notify);
        }
        return view(activeTemplate().'user.auth.passwords.code_verify',compact('pageTitle','email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required'
        ]);
        $code =  str_replace(' ', '', $request->code);

        if (PasswordReset::where('token', $code)->where('email', $request->email)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_email', $request->email);
        return redirect()->route('user.password.reset', $code)->withNotify($notify);
    }

}