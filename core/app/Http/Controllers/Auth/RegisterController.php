<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Wallet;
use CryptAPI\CryptAPI;
use App\Models\UserLogin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('regStatus')->except('registrationNotAllowed');

        $this->activeTemplate = activeTemplate();
    }


    function registerForm(){
        $pageTitle = "Register";

        //return view(activeTemplate().'user.auth.login',compact('pageTitle'));

        return view('auth.register', compact('pageTitle'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $general = GeneralSetting::first();
        $password_validation = Password::min(6);

        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }

        \Session::flash('modal', '#registerModal');

        $countryData = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes = implode(',',array_column($countryData, 'dial_code'));
        $countries = implode(',',array_column($countryData, 'country'));
        $validate = Validator::make($data, [
            //'firstname' => 'sometimes|required|string|max:50',
            //'lastname' => 'sometimes|required|string|max:50',
            //'email' => 'required|string|email|max:90|unique:users',
            //'mobile' => 'required|string|max:50|unique:users',
            'password' => ['required',$password_validation],
            //'username' => 'required|alpha_num|unique:users|min:6',
            'captcha' => 'sometimes|required',
            //'mobile_code' => 'required|in:'.$mobileCodes,
            //'country_code' => 'required|in:'.$countryCodes,
            //'country' => 'required|in:'.$countries,
            'referBy' => 'nullable|string|max:10',
            'agree' => $agree
        ]);
        return $validate;
    }

    public function register(Request $request)
    {

        if ($request->captcha != $_COOKIE['captcha_code']) {
            $notify[] = ['error', 'Incorrect Captcha'];
            return back()->withNotify($notify)->withInput();
        }

        $this->validator($request->all())->validate();
        $exist = User::where('mobile',$request->mobile_code.$request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }



        $ip = $_SERVER["REMOTE_ADDR"];
        //dd($ip);
        $exist = UserLogin::where('user_ip',$ip)->first();
        // if($exist){
        //     $notify[] = ['error', 'Sorry you have an account on this device please login'];
        //     return back()->withNotify($notify);
        // }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $general = GeneralSetting::first();
        $randomString = Str::random(12);



        if (isset($data['referBy']) == true) {
            $referBy = $data['referBy'];//session()->get('reference');
            $referUser = User::where('ref_code', $referBy)->first();
            if(User::where('ref_code', $referBy)->count() > 0){
                $referUser->spin = 1;
                $referUser->save();
            }
        } else {
            $referUser = null;
        }

        //User Create
        $user = new User();
        $user->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        $user->lastname = isset($data['lastname']) ? $data['lastname'] : null;
        $user->email =  $data['mobile'].'@gmail';
        $user->password = Hash::make($data['password']);
        $user->username = $data['mobile']; //trim($data['username']);
        $user->ref_by = $referUser ? $referUser->id : 0;
        $user->ref_code = getTrx(5);
        $user->country_code = '';//$data['country_code'];
        $user->mobile = $data['mobile'];
        $user->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => null,
            'city' => ''
        ];
        $user->status = 1;
        $user->ev = $general->ev ? 0 : 1;
        $user->sv = $general->sv ? 0 : 1;
        $user->ts = 0;
        $user->tv = 1;
        $user->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath('admin.users.detail',$user->id);
        $adminNotification->save();


        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
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


        return $user;
    }

    public function registered(Request $request)
    {

        $user = auth()->user();
        $general = GeneralSetting::first();

        give_bonus($user->id,$general->welcome_bonus,'Welcome Bonus');
        $user->spin += 1;
        $user->save();


        if ($request->ajax()) {
            return response()->json([
                'user' => auth()->user()->id,
                'code' => 1,
                'intended' => route('user.home')
            ]);
        } else {
            return redirect()->route('user.home');
            //return redirect()->route('user.home');
            //return redirect()->intended(URL::route('dashboard'));
        }


    }

}