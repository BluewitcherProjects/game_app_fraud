@extends('layouts.auth')


@push('page_title')
    Register
@endpush
@section('content')

    <body data-theme-color="color-orange">
        <div class="page-wraper">


            <style>
                body {
                    background: linear-gradient(137deg, #F9FFF7 0%, #FCFFFC 100%);
                    margin-left: 12px;
                    margin-right: 12px;
                }

                .banner-wrapper {
                    height: 232px;
                    border-bottom-left-radius: 0px;
                    border-bottom-right-radius: 0px;
                    background: url();
                    background-size: cover;
                    margin-top: 5px;
                    margin-bottom: -52px;
                }

                .form-control {
                    border-radius: 8px;
                    border: 1px solid #00000000;
                    background: #47474700;
                    height: 52px;
                    font-weight: 600;
                    color: #000 ! important;
                    font-size: 16px;
                }

                .form-control::placeholder {
                    color: #00000088;
                    font-weight: normal;
                    font-size: 14px;
                }

                .input-group .input-group-text {
                    border-radius: 12px;
                    border: 1px solid #00000036;
                    background: #ffffffe3;
                }

                .btn-rounded {
                    border-radius: 10px;
                }

                .btn {
                    font-size: 15px;
                    font-weight: bold;
                    padding: 17px 25px;
                    font-family: 'Poppins', sans-serif;
                }

                .account-area form {
                    display: flex;
                    flex-direction: column;
                    background: #c9e4ff00;
                    padding: 0px;
                    border-radius: 0px;
                }

                .image-container {
                    width: 106%;
                    margin: -15px 0px 0px -10px;
                }

                .form-control {
                    transition: none;
                }

                .container {
                    padding-top: 1px;
                    padding-left: 8px;
                    padding-right: 8px;
                    background: #ffe4e400;
                    border-radius: 20px;
                    padding-bottom: 0px;
                }

                .form-control[readonly] {
                    background-color: #e9ecef00;
                    opacity: 1;
                }

                .light.btn-primary {
                    background-color: rgb(255 59 48 / 0%);
                    color: #08bf5d ! important;
                    font-size: 11px;
                    margin-top: -10px;
                    font-weight: bold;
                }

                .input-group .input-group-text {
                    background: #edf1ec00;
                    color: #151917;
                    border-radius: 8px;
                    border: 0px solid #fa6d6d;
                }

                .input-group .btn {
                    position: relative;
                    z-index: 2;
                    height: 50px;
                    border: 0px #ffffff73 solid;
                    background: linear-gradient(270deg, #06B556 0%, #0BD065 100%);
                    Border-radius: 10px;
                    box-shadow: 0px 4px 10px rgb(0 255 117 / 42%);
                }

                .light.btn-primary:hover {
                    background-color: #2196f300;
                    color: #2194f0 !important;
                    border: 0px #ffffff00 solid;
                }

                .form-control[readonly] {
                    background-color: #f9fcff;
                    opacity: 1;
                }

                .top-tools {
                    height: 42px;
                    box-sizing: border-box;
                    display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    width: 100%;
                    padding: 11px 14px;
                    column-gap: 5px;
                }

                .w-20px {
                    width: 20px;
                }

                .h-20px {
                    height: 20px;
                }

                .py-30px {
                    padding-top: 10px;
                    padding-bottom: 0px;
                    margin-left: -12px;
                }

                .a-t-1 .base-logo {
                    width: 70px;
                    height: 70px;
                }

                .w-100\%,
                .w-full {
                    width: 70%;
                    position: absolute;
                    margin-top: -205px;
                    background: #ffffff;
                    margin-left: -10px;
                    z-index: -1;
                }

                h4 {
                    font-size: 15px;
                    margin-top: -5px;
                    margin-bottom: 4px;
                    font-weight: 400;
                }

                .text-24px {
                    font-size: 24px;
                    font-weight: 600;
                    color: white;
                }

                .flex,
                [flex=""] {
                    display: flex;
                    justify-content: center;
                }

                .form-control:focus,
                .form-control:active,
                .form-control.active {
                    border: 1px #fa6d6d00 solid ! important;
                }

                .form-control:focus,
                .form-control:active,
                .form-control.active {
                    border-color: #f0ad7a;
                    background: #edf1ec00;
                }

                .account-area {
                    min-height: calc(80vh - 190px);
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    flex: 1;
                    margin-top: 10px;
                }

                .banner-wrapper.shape-1:after {
                    border: 40px solid #ffffff00;
                }

                .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
                    margin-left: -20px;
                }

                .input-group:focus-within .form-control {
                    border-color: #565878;
                }

                .input-group:focus-within .input-group-text,
                .input-group:focus-within .form-control {
                    border-color: #ee434300 !important;
                }

                .toast.style-1.toast-danger {
                    background-color: #1e1e1e5e;
                    color: #fff;
                    border: 0px white solid;
                    backdrop-filter: blur(5px);
                }

                .toast.style-1 .toast-body {
                    display: flex;
                    align-items: center;
                    padding: 14px;
                }

                .toast.style-1.toast-danger .toast-content strong {
                    color: #fff;
                    font-weight: 600;
                }

                .form-control[readonly] {
                    background-color: #23262b00;
                    opacity: 1;
                }

                .input-group {
                    margin-bottom: 15px;
                    background: #f4f4f4;
                    border-radius: 12px;
                }
            </style>

            <!-- Page Content -->
            <div class="page-content">

                <!-- Banner -->
                <div class="banner-wrapper shape-1">
                    <div class="top-tools">
                        <div class="base-help-btn cursor-pointer"><img src="{{ asset('assets/app/img/earphone.png') }}"
                                class="w-20px h-20px"></div>
                        <div class="ml-10px"><img src="{{ asset('assets/app/img/globe.png') }}" class="w-20px h-20px"></div>
                    </div>
                </div>
                <!-- Banner End -->



                <div class="container" style="margin-bottom: 30px;">
                    <div class="py-30px">
                        <div class=":uno: base-logo flex items-center w-50px h-50px mx-auto">
                            <img class="site-img h-full w-full" src="{{ asset('assets/app/img/logo.png') }}"
                                draggable="false" alt="logo" style="border-radius: 10px;">
                        </div>
                    </div>
                    <div class="account-area">
                        <form id="register-form" action="" method="POST">
                            {{-- <h4>NickName</h4>
                            <div class="input-group">
                                <span class="input-group-text" style="border-right: #ff000000;width: 52px;"><img
                                        src="https://i.postimg.cc/xjLySXnL/nickname.png"></span>
                                <input type="text" placeholder="Enter Your Full Name" class="form-control" name="name"
                                    required="">
                            </div> --}}
                            <h4>Phone Number</h4>
                            <div class="input-group">
                                <span class="input-group-text" style="border-right: #ff000000;width: 52px;"><img
                                        src="{{ asset('assets/app/img/phone.png') }}"></span>
                                <input type="tel" id="phone" placeholder="Enter Your Mobile Number" maxlength="10"
                                    class="form-control" name="mobile" required="" pattern="[0-9]{10}"
                                    style="border-left: #ffff0000;" oninput="validateMobile(this)">
                            </div>
                            <h4>Captcha</h4>
                            <div style="position: relative;margin-bottom: 14px;">
                                <input type="text" id="otp" placeholder="Enter the Captcha" class="form-control"
                                    name="captcha" required="" style="padding-right: 82px; background: #f4f4f4;">
                                <img src="{{ url('captcha.php') }}" onclick="{{ url('captcha.php') }}"
                                    style="position: absolute;right: 14px;top: 50%;transform: translateY(-50%); border: 0px #ffffff73 solid;">
                            </div>


                            <h4>Password</h4>
                            <div class="input-group">

                                <span class="input-group-text" style="border-right: #ff000000;width: 52px;"><img
                                        src="{{ asset('assets/app/img/passw-ord-3.png') }}"></span>
                                <input type="password" placeholder="Enter Your Password" id="dz-password" required=""
                                    name="password" class="form-control be-0">
                                <span class="input-group-text show-pass" style="border-left: #ffff0000;">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>


                            <h4>invitation Code</h4>
                            <div class="input-group" id="code-group">
                                <span class="input-group-text" style="border-right: #ff000000;width: 52px;"><i
                                        class="layui-icon layui-icon-vercode layui-font-22"></i></span>
                                <input type="text" placeholder="Enter Your Referral Code" class="form-control"
                                    name="referBy" @if (session()->get('reference') != null)  @endif
                                    value="{{ session()->get('reference') }}">
                            </div>

                            <label>
                                <input type="checkbox" required/>
                                <span>I agree to the <a href="{{ route('user.agree') }}" class="highlight">User Agreement</a>.</span>
                            </label>

                            <div class="input-group" style="background: #f4f4f400;">
                                <button type="submit" id="create-account-btn"
                                    class="btn mt-2 btn-primary w-100 btn-rounded">REGISTER</button>
                            </div>
                        </form>
                        <a href="{{ route('user.login') }}"
                            class="btn btn-primary light btn-rounded text-primary d-block">Already have an account?
                            Login</a>

                    </div>
                </div>

            </div>
            <!-- Page Content End -->

            <style>
                label {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    /* border: 1.5px solid #becb0a;
                    border-radius: 12px; */
                    padding: 16px 0px;
                    max-width: 400px;
                    width: 100%;
                    cursor: pointer;
                    background-color: #fff;
                }

                input[type="checkbox"] {
                    width: 24px;
                    height: 24px;
                    border: 2px solid #888888;
                    border-radius: 8px;
                    appearance: none;
                    -webkit-appearance: none;
                    outline: none;
                    cursor: pointer;
                    position: relative;
                    background-color: #fff;
                    transition: background-color 0.2s, border-color 0.2s;
                }

                input[type="checkbox"]:checked {
                    background-color: #08bf5d;
                    border-color: #08bf5d;
                }

                input[type="checkbox"]:checked::after {
                    content: '';
                    position: absolute;
                    top: 4px;
                    left: 8px;
                    width: 5px;
                    height: 12px;
                    border: solid white;
                    border-width: 0 3px 3px 0;
                    transform: rotate(45deg);
                }

                span {
                    font-size: 15px;
                    line-height: 1.3;
                    color: #333333;
                }

                .highlight {
                    font-weight: 600;
                    color: #08bf5d;
                }
            </style>


            <!-- Footer -->
            <footer class="footer fixed">
                <div class="w-100 bg-danger text-white p-3 d-none" id="error-div">

                </div>

                <!--<div class="container">-->
                <!--    <a onclick="navigate('/home/login',true);" class="btn btn-primary light btn-rounded text-primary d-block">Login</a>-->
                <!--</div>-->
            </footer>
            <!-- Footer End -->


        </div>






        <!-- Swiper -->
        <!-- Swiper -->





    </body>
@endsection
