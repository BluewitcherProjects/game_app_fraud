@extends('layouts.auth')
@push('page_title')
    Verify Code
@endpush

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
        <h2 class="title">Verify Code</h2>
        <div class="text">
            <p>Please check including your Junk/Spam Folder. if not found, you can</p>
            <form action="{{ route('user.password.verify.code') }}" method="POST" id="login_form">
                <ul>

                    <li class="form-title">Email</li>
                    <li class="li">
                        <input id='code' type="text" name="code" placeholder="Enter Code" maxlength="200" required>
                        <p></p>
                        <b class="close right90"></b>
                        <input type="hidden" name="email" value="{{ $email }}">
                    </li>
                </ul>


            </form>


        </div>
        <input type='hidden' value="{{ csrf_token() }}" id='TOKEN'>
        <div class="btn" onclick="onSub()">
            Verify Code
        </div>
        {{--<p class="retrieve"  onclick="onJump('{{ route("user.password.request") }}')">Retrieve Password </p>--}}
        <br>
        <br>
        <br>
    </div>
@endsection
@section('contents')

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <form action="{{ route('user.password.verify.code') }}" method="POST" class="cmn-form mt-30">
                                @csrf

                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="form-group">
                                    <label>@lang('Verification Code')</label>
                                    <input type="text" name="code" id="code" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">@lang('Verify Code')</button>
                                </div>

                                <div class="">
                                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#resetModal" class="text--base">@lang('Try to send again')</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
<script>

    function onSub() {
        $("#login_form").submit();
    }

    (function($){
        "use strict";
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          $(this).val(function (index, value) {
             value = value.substr(0,7);
              return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
          });
      });
    })(jQuery)
</script>
@endpush
