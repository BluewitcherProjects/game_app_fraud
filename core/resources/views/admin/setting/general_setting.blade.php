@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Site Title') </label>
                                    <input class="form-control form-control-lg" type="text" name="sitename" value="{{$general->sitename}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Currency')</label>
                                    <input class="form-control form-control-lg" type="text" name="cur_text" value="{{$general->cur_text}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Currency Symbol') </label>
                                    <input class="form-control form-control-lg" type="text" name="cur_sym" value="{{$general->cur_sym}}">
                                </div>
                            </div>





                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Account Name') </label>
                                    <input class="form-control form-control-lg" type="text" name="account_name" value="{{$general->account_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Account Number')</label>
                                    <input class="form-control form-control-lg" type="text" name="account_number" value="{{$general->account_number}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Bank Name') </label>
                                    <input class="form-control form-control-lg" type="text" name="bank_name" value="{{$general->bank_name}}">
                                </div>
                            </div>





                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold"> @lang('Timezone')</label>
                                <select class="select2-basic" name="timezone">
                                    @foreach($timezones as $timezone)
                                    <option value="'{{ @$timezone}}'" @if(config('app.timezone') == $timezone) selected @endif>{{ __($timezone) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold"> @lang('Site Base Color')</label>
                                <div class="input-group">
                                <span class="input-group-addon ">
                                    <input type='text' class="form-control form-control-lg colorPicker" value="{{$general->base_color}}"/>
                                </span>
                                    <input type="text" class="form-control form-control-lg colorCode" name="base_color" value="{{ $general->base_color }}"/>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold"> @lang('Site Secondary Color')</label>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <input type='text' class="form-control form-control-lg colorPicker" value="{{$general->secondary_color}}"/>
                                </span>
                                    <input type="text" class="form-control form-control-lg colorCode" name="secondary_color" value="{{ $general->secondary_color }}"/>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold">@lang('Agree policy')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="agree" @if($general->agree) checked @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="form-control-label font-weight-bold">@lang('User Registration')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="registration" @if($general->registration) checked @endif>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="form-control-label font-weight-bold">@lang('Force SSL')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="force_ssl" @if($general->force_ssl) checked @endif>
                            </div>
                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold"> @lang('Email Verification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="ev" @if($general->ev) checked @endif>
                            </div>
                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">@lang('Email Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="en" @if($general->en) checked @endif>
                            </div>
                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold"> @lang('SMS Verification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="sv" @if($general->sv) checked @endif>
                            </div>
                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">@lang('SMS Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="sn" @if($general->sn) checked @endif>
                            </div>
                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">User Withdrawal</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="withdrawal" @if($general->withdrawal) checked @endif>
                            </div>
                            
                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">Auto Withdrawal</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="auto" @if($general->auto) checked @endif>
                            </div>

                            <div class="form-group col-lg-2 col-sm-6 col-md-4">
                                <label class="form-control-label font-weight-bold">User Must Invest to Withdraw</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="investtowithdraw" @if($general->investtowithdraw) checked @endif>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-control-label font-weight-bold">@lang('Telegram Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="enable_telegram" @if($general->enable_telegram) checked @endif>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Telegram Group') </label>
                                    <input class="form-control form-control-lg" type="text" name="telegram_chat_id" value="{{$general->telegram_group}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Customer service')</label>
                                    <input class="form-control form-control-lg" type="text" name="telegram_api_token" value="{{$general->cs}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Welcome Bonus') </label>
                                    <input class="form-control form-control-lg" type="number" name="welcome_bonus" value="{{$general->welcome_bonus}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Daily CheckIn') </label>
                                    <input class="form-control form-control-lg" type="number" name="dailysignin" value="{{$general->dailysignin}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"> @lang('Level 1 Referral bonus') </label>
                                    <input class="form-control form-control-lg" type="number" name="lv1" value="{{$general->lv1}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Level 2 Referral bonus')</label>
                                    <input class="form-control form-control-lg" type="number" name="lv2" value="{{$general->lv2}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Level 3 Referral bonus')</label>
                                    <input class="form-control form-control-lg" type="number" name="lv3" value="{{$general->lv3}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Country Code')</label>
                                    <input class="form-control form-control-lg" placeholder="+234" type="text" max="4" maxlength="4" name="country_code" value="{{$general->country_code}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Withdraw limit a day')</label>
                                    <input class="form-control form-control-lg" placeholder="withdraw limit" type="number" name="wit_limit" value="{{$general->wit_limit}}">
                                </div>
                            </div>

                        </div>


                        <div class="form-group">


                                <label for="">Flutterwave Payment Secrete Key</label>
                                <input type="text" name="flutterwave_key" value="{{ $general->flutterwave_key }}" class="form-control form-control-lg">
                        </div>



                        <div class="form-group">
                            <label for="">PopUp Message</label>
                            <textarea name="home_message" class="form-control niceEdit nicEdit-main">{{ $general->home_message }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush


@push('style')
    <style>
        .sp-replacer {
            padding: 0;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px 0 0 5px;
            border-right: none;
        }

        .sp-preview {
            width: 100px;
            height: 46px;
            border: 0;
        }

        .sp-preview-inner {
            width: 110px;
        }

        .sp-dd {
            display: none;
        }
        .select2-container .select2-selection--single {
            height: 44px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 43px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }
    </style>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function (color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function () {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('.select2-basic').select2({
                dropdownParent: $('.card-body')
            });

            $('select[name=timezone]').val();
        })(jQuery);

    </script>
@endpush

