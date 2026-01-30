@extends('layouts.auth')


@push('page_title')
    Login
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
                    margin-top: 55px;
                    margin-bottom: -52px;
                }

                .btn-link {
                    color: #0bc760;
                    text-decoration: none;
                }

                .form-control {
                    border-radius: 8px;
                    border: 1px solid #00000000;
                    background: #47474700;
                    height: 60px;
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
                    font-size: 21px;
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
                    height: 55px;
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
                    padding-bottom: 20px;
                    margin-left: -12px;
                }

                .a-t-1 .base-logo {
                    width: 70px;
                    height: 70px;
                }

                .w-100\%,
                .w-full {
                    width: 80%;
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
                        <div class="base-help-btn cursor-pointer"><img
                                src="{{ asset('assets/app/img/earphone.png') }}"
                                class="w-20px h-20px"></div>
                        <div class="ml-10px"><img
                                src="{{ asset('assets/app/img/globe.png') }}"
                                class="w-20px h-20px"></div>
                    </div>
                </div>
                <!-- Banner End -->

                <div class="container">
                    <div class="account-area">
                        <form action="" method="POST">
                            <div class="py-30px">
                                <div class=":uno: base-logo flex items-center w-70px h-70px mx-auto">
                                    <img class="site-img h-full w-full"
                                        src="{{ asset('assets/app/img/logo.png') }}"
                                        draggable="false" alt="logo" style="border-radius: 10px;">
                                </div>
                            </div>
                            <h4>Phone Number</h4>
                            <div class="input-group">
                                
                                <input name="mobile" type="number" placeholder="Enter your phone number" class="form-control"
                                    name="phone" oninput="validateMobile(this)" required="">
                            </div>
                            <h4>Password</h4>
                            <div class="input-group">
                                <input name="password" type="password" placeholder="Enter your password" id="dz-password" required=""
                                    name="password" class="form-control be-0">
                                <span class="input-group-text show-pass">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>

                            <div class="input-group" style="background: #f4f4f400;">
                                <button type="submit" class="btn mt-2 btn-primary w-100 btn-rounded">LOGIN</button>
                            </div>
                            <a href="{{ route('user.register') }}" class="btn-link d-block text-center">Don't have
                                account,register</a>

                        </form>

                    </div>
                </div>
            </div>
            <!-- Page Content End -->


            <!-- Footer -->
            <footer class="footer fixed">
                <div class="w-100 bg-danger text-white p-3 d-none" id="error-div">

                </div>


            </footer>
            <!-- Footer End -->


        </div>

       


    </body>
@endsection
