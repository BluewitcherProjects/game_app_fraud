@extends('layouts.users')

@section('content')
    <div class="containers">
        <div class="rows justify-content-center mt-2">
            <div class="col-lg-10s">
                <div class="card mb-5">
                    @if($withdraw->is_bonus)
                        <h5 class="text-center mt-3">@lang('Bonus Balance') :
                            <strong>{{ showAmount(auth()->user()->bonus_balance)}}  {{ __($general->cur_text) }}</strong>
                        </h5>
                    @else
                        <h5 class="text-center mt-3">@lang('Current Balance') :
                            <strong>{{ showAmount(auth()->user()->balance)}}  {{ __($general->cur_text) }}</strong></h5>
                    @endif

                    <div class="card-body mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('user.withdraw.submit')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf


                                    <div class="withdraw-details">
                                        <span class="font-weight-bold">@lang('Amount') :</span>
                                        <span class="font-weight-bold pull-right">{{showAmount($withdraw->amount)  }} {{__($general->cur_text)}}</span>
                                    </div>
                                    <div class="withdraw-details text-danger">
                                        <span class="font-weight-bold">@lang('Charges') :</span>
                                        <span class="font-weight-bold pull-right">{{showAmount($withdraw->charge) }} {{__($general->cur_text)}}</span>
                                    </div>
                                    <div class="withdraw-details text-info">
                                        <span class="font-weight-bold text-base">@lang('Amount After Charge') :</span>
                                        <span class="font-weight-bold pull-right text-base">{{showAmount($withdraw->after_charge) }} {{__($general->cur_text)}}</span>
                                    </div>

                                    @if($withdraw->is_bonus)

                                        <div class="withdraw-details text-info">
                                            <span class="font-weight-bold text-success">@lang('Balance After withdrawal') :</span>
                                            <span class="font-weight-bold pull-right text-success">{{__($general->cur_sym)}} {{showAmount($withdraw->user->bonus_balance - ($withdraw->amount))}} </span>
                                        </div>

                                    @else
                                        <div class="withdraw-details text-info">
                                            <span class="font-weight-bold text-success">@lang('Balance After withdrawal') :</span>
                                            <span class="font-weight-bold pull-right text-success">{{__($general->cur_sym)}} {{showAmount($withdraw->user->balance - ($withdraw->amount))}} </span>
                                        </div>
                                    @endif


                                    @if($withdraw->is_bank)

                                        <div>

                                            <h5 style="color: #fff">Account Details</h5>

                                            <p>
                                                Account Name: {{ auth()->user()->bankAccount->account_name }}
                                            </p>

                                            <p>
                                                Account Number: {{ auth()->user()->bankAccount->account_number }}
                                            </p>

                                            <p>
                                                Bank Name: {{ auth()->user()->bankAccount->bank_name }}
                                            </p>

                                        </div>

                                    @endif



                                    @if(auth()->user()->bankAccount)


                                    @endif

                                    <span class="text-danger text-error block"></span>


                                    @if($withdraw->method->user_data)
                                        @foreach($withdraw->method->user_data as $k => $v)
                                            @if($v->type == "text")
                                                <div class="form-group mb-2">
                                                    <label><strong>{{__($v->field_level)}} @if($v->validation == 'required')
                                                                <span class="text-danger">*</span>  @endif
                                                        </strong></label>
                                                    <input type="text" id="{{ $k }}" @if($withdraw->is_bank) readonly
                                                           @endif name="{{$k}}" class="form-control" value="{{old($k)}}"
                                                           placeholder="{{__($v->field_level)}}"
                                                           @if($v->validation == "required") required @endif>
                                                    @if ($errors->has($k))
                                                        <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                    @endif
                                                </div>
                                            @elseif($v->type == "textarea")
                                                <div class="form-group mb-2">
                                                    <label><strong>{{__($v->field_level)}} @if($v->validation == 'required')
                                                                <span class="text-danger">*</span>  @endif
                                                        </strong></label>
                                                    <textarea name="{{$k}}" class="form-control"
                                                              placeholder="{{__($v->field_level)}}" rows="3"
                                                              @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                                                    @if ($errors->has($k))
                                                        <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                    @endif
                                                </div>
                                            @elseif($v->type == "file")
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required')
                                                            <span class="text-danger">*</span>  @endif</strong></label>
                                                <div class="form-group mb-2">
                                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                             data-trigger="fileinput">
                                                            <img class="w-100" src="{{ getImage('/')}}"
                                                                 alt="@lang('Image')">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>
                                                        <div class="img-input-div">
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new "> @lang('Select') {{__($v->field_level)}}</span>
                                                            <span class="fileinput-exists"> @lang('Change')</span>
                                                            <input type="file" name="{{$k}}" accept="image/*"
                                                                   @if($v->validation == "required") required @endif>
                                                        </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists"
                                                               data-dismiss="fileinput"> @lang('Remove')</a>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has($k))
                                                        <br>
                                                        <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif


                                    {{--<div class="form-group">
                                        <label><strong>Verification Code <span
                                                        class="text-danger">*</span></strong></label>
                                        <div class="input-group">
                                            <input type="text" name="otp" class="form-control"
                                                   placeholder="Verification Code" required>
                                        </div>
                                        <br>
                                        <div class="ajax-result"></div>
                                        <br>
                                        <span class="input-group-addon">
                                    <a href="#get-code" class="btn btn-primary" id="get-code" onclick="getCode()">Get Verification Code</a>
                                </span>
                                    </div>--}}


                                    <div class="form-group mb-2">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg mt-4 text-center">@lang('Withdraw Now')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
    @if($withdraw->is_bank)
        <textarea style="display: none;" id="all_banks">{!! $all_banks !!}</textarea>
    @endif
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
@endpush

@push('script')


    @if($withdraw->is_bank)
        <script>
            let all_banks = JSON.parse($("#all_banks").val());
            //console.info(all_banks);
            (function ($) {
                "use strict";


                function getByValue(value) {

                    let arr = all_banks;
                    for (var i = 0, iLen = arr.length; i < iLen; i++) {
                        //console.log(arr[i]);
                        if (arr[i].id == value) return arr[i];
                    }
                }


                $("#bank_name").change(function (e) {
                    //alert($(this).val());
                    let code = $("#bank_name").val(); //getByValue().bank_code;
                    let account = $("#account").val();
                    if (account != "" && code != "") {
                        get_account_info(code, account);

                        //console.log(account, code);
                    }

                });

                $("#account").change(function () {

                    let code = $("#bank_name").val();// getByValue($("#bank_name").val()).bank_code;
                    let account = $("#account").val();
                    if (account == "" || code == "") {
                        $("#reg").prop('disabled', true);
                        $("#account_name").val("");
                        $(".text-error").text("Your bank name and account number are required, please try again");
                        return;
                    }

                    get_account_info(code, account);

                    //console.log(account, code);


                });


                function get_account_info(code, account) {

                    $(".preloader").show();
                    $(".text-error").text("Fetching account details");

                    $.ajax({
                        url: "{{ route('account.fetch') }}",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            'bank-verification': '',
                            'code': code,
                            'account': account
                        },
                        success: function (response) {
                            if (response.status == "error") {
                                $("#account_name").val("");
                                $(".preloader").hide();
                                $(".text-error").text("Could not resolve account name, please check your account number or bank name and try again");
                                $("#reg").prop('disabled', true);
                                return;
                            }

                            $(".text-error").text("");
                            $("#reg").removeAttr('disabled');
                            $(".preloader").hide();
                            console.log(response.data);
                            $("#account_name").val(response.data.account_name);

                            //console.log(response);
                        },

                        error: function (err) {
                            console.log(err.responseText);
                            $(".preloader").hide();
                        }
                    });
                }

                $('.withdraw-thumbnail').hide();
                $('.clickBtn').on('click', function () {
                    var classNmae = $('.fileinput').attr('class');
                    if (classNmae != 'fileinput fileinput-exists') {
                        $('.withdraw-thumbnail').hide();
                    } else {
                        $('.fileinput-preview img').css({"width": "100%", "height": "300px", "object-fit": "contain"});

                        $('.withdraw-thumbnail').show();
                    }

                });

            })(jQuery);
        </script>
    @endif

    <script type="text/javascript">
        function getCode() {
            $(".ajax-result").html("<div class='alert alert-info'>Sending Code, please wait</div>");
            $.ajax({
                url: '{{ route('user.withdraw-otp') }}',
                success: function (f) {
                    //console.info(f);
                    if (f == '1') {
                        //alert("");
                        $(".ajax-result").html("<div class='alert alert-success'>Kindly check your email inbox/spam/junk for withdrawal verification code</div>");
                    } else {
                        //alert("An error occurred, please try again later");
                        $(".ajax-result").html("<div class='alert alert-danger'>An error occurred, please try again later</div>");
                    }
                },
                error: function (er) {
                    //console.error(er);
                    alert("Unable to receive OTP code, please contact administrator!");
                }
            });
        }
    </script>

    <script>

        (function ($) {

            "use strict";

            $('.withdraw-thumbnail').hide();

            $('.clickBtn').on('click', function () {

                var classNmae = $('.fileinput').attr('class');

                if (classNmae != 'fileinput fileinput-exists') {
                    $('.withdraw-thumbnail').hide();
                } else {

                    $('.fileinput-preview img').css({"width": "100%", "height": "300px", "object-fit": "contain"});

                    $('.withdraw-thumbnail').show();

                }

            });

        })(jQuery);


    </script>
@endpush

@push('style')
    <style>
        .fileinput .thumbnail {
            max-height: 300px;
            width: 100%;
        }
    </style>
@endpush
