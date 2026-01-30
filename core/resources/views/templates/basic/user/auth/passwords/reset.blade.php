@extends('layouts.auth')
@push("page_title") Reset Password @endpush

@section('content')
    <div class="signin-wrap" id='app'>
        <div class="navbar">
				<span onclick="onBack()">
					<i></i>
				</span>
            <span></span>
            <span onclick="onJump('{{ route('user.login') }}')">
					Login
				</span>
        </div>
        <h2 class="title">Reset Password</h2>

        <div class="text">
            <p>Please check including your Junk/Spam Folder. if not found, you can</p>
            <form action="{{ route('user.password.update') }}" method="POST" id="login_form">
                <ul>

                    <li class="form-title">Password</li>
                    <li class="li">
                        <input id='pwd' type="password" name="password" placeholder="Login password" maxlength="20">
                        <p></p>
                        <b class="close right90"></b>
                        <b class="eye"></b>
                    </li>


                    <li class="form-title">Confirm password</li>
                    <li class="li">
                        <input id='pwd' type="password" name="password_confirmation" placeholder="Confirm password"
                               maxlength="20">
                        <p></p>
                        <b class="close right90"></b>
                        <b class="eye"></b>
                    </li>
                </ul>
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">


            </form>


        </div>

        <div class="btn" onclick="onSub()">
            Reset Password
        </div>
        {{--<p class="retrieve"  onclick="onJump('{{ route("user.password.request") }}')">Retrieve Password </p>--}}
        <br>
        <br>
        <br>
    </div>
@endsection

@section('contents')
    <h3 class="card-header text-center">@lang('Reset Password')</h3>
    <div class="card-body">
        <form method="POST" action="{{ route('user.password.update') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label for="password" class="">@lang('Password')</label>
                <div class="col-lg-12 hover-input-popup">
                    <input id="password" type="password" class="form--control @error('password') is-invalid @enderror"
                           name="password" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="">@lang('Confirm Password')</label>
                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form--control" name="password_confirmation"
                           required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn--base w-100">
                        @lang('Reset Password')
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('script')

    <script>
        function onSub() {
            $("#login_form").submit();
        }

    </script>

@endpush
