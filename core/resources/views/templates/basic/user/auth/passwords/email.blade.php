@extends('layouts.auth')

@push('page_title')
    Reset Password
@endpush


@section('content')
<body class="bgColor">
    <div class="top">
        <a href="{{ url('login.html') }}" class="topLeft">
            <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #fff;"></i>
        </a>
        <div class="topTit">Forgot Password</div>
    </div>
    <div class="warp">
        <div class="login-head">
            <img src="{{ asset('users/static/home/images/logon_top_bg.png') }}" alt>
        </div>
        <div class="login">
            {{--  <div class="login-log">
                <img src="{{ asset('users/static/home/images/Autel.png') }}" alt>
            </div>  --}}
            <form action="{{ url('password/email') }}" method="post">
                @csrf
                <div class="loginCon">
                    <div class="info">
                        <div class="circlebg">
                            <img src="{{ asset('users/static/home/images/icon_1.png') }}" alt>
                            <i class="areaCode">+234</i>
                            <input type="text" maxlength="10" oninput="if(value.length&gt;10)value=value.slice(0,10)" name="phone_number" value="{{ old('phone_number') }}" placeholder="please enter phone number"/>
                        </div>
                        <div class="circlebg">
                            <img src="{{ asset('users/static/home/images/icon_2.png') }}" alt>
                            <input type="password" name="password" placeholder="please enter your new password" />
                        </div>
                        <div class="circlebg">
                            <img src="{{ asset('users/static/home/images/icon_3.png') }}" alt>
                            <input type="text" name="code" placeholder="please enter the otp" />
                            <button name="otp" type="submit" class="otpBtn login-main-otp-btn">send</button>
                        </div>
                    </div>

                    <div class="continue">
                        <button class="add-btn login-btn">Save</button>
                    </div>
                    <div class="continuelink">
                        <a href="{{ url('login.html') }}" class="sign_link">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

@endsection
@push('script')
    <script src="{{asset('assets/admin/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script>

    function onSub() {
        $("#login_form").submit();
    }
    (function($){
        "use strict";

        myVal();
        $('select[name=type]').on('change',function(){
            myVal();
        });
        function myVal(){
            $('.my_value').text($('select[name=type] :selected').text());
        }
    })(jQuery)
</script>
@endpush
