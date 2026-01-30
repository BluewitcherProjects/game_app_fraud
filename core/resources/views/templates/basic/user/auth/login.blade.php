{{--@extends($activeTemplate.'layouts.frontend')--}}
@extends('layouts.auth')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-1 col-md-6 ">

                <form class="account-form" action="{{ route('user.login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>@lang('Username or Email') <sup class="text-danger">*</sup></label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form--control" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Password') <sup class="text-danger">*</sup></label>
                        <input id="password" type="password" class="form--control" name="password" required required>
                    </div>
                    <div class="form-group text-end">
                        <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#resetModal" data-bs-dismiss="modal">@lang('Forget Password')?</a>
                    </div>
                    <button type="submit" class="btn btn--base w-100">@lang('Login Now')</button>
                    <p class="text-center mt-3"><span class="text-white">@lang('New to') {{ __($general->sitename) }}?</span> <a href="#0" class="text--base" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">@lang('Signup here')</a></p>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
