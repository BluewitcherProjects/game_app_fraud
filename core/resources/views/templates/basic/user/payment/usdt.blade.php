@extends('layouts.users')


@section('content')

    <div class="dashboard-section pt-120 bg--section">
        <div class="container">
            <div class="pb-120 mb-05">



                <h3>USDT Deposit</h3>

                <br>

                <form action="" method="post" role="form">

                    <div class="card">
                        <div class="card-body">





                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label for="amount" class="label cmn--label text--white w-100">@lang('How much are you depositing in naira?')</label>
                                    <input type="text" class="form-control cmn--form--control" name="amount"
                                           value="{{old('amount')}}" id="amount" placeholder="@lang('Enter deposit amount in naira')"
                                           required="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>





                            <div class="form-group basic">
                                <button class="btn btn-success btn-block">Proceed</button>
                            </div>
                        </div>
                    </div>


                </form>

            </div>

        </div>
    </div>

@endsection


@push('style')
    <style type="text/css">
        .custom-amount{
            cursor: pointer;
            margin: 4px;
        }
    </style>
@endpush


@push('script')
    <script>
        (function ($) {
            "use strict";

            $("#qty").on("keyup", function () {
                let v = $(this).val();
                let amt = v * 550;
                let amt2 = v * 750;

                $("#amount").val(amt);
                $("#amount2").val(amt2);
            });


            $(".custom-amount").on("click", function () {
                $("#amount").val($(this).text());
            });

            $('.deposit').on('click', function () {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{$general->cur_text}}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' + percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });

            $('.prevent-double-click').on('click', function () {
                $(this).addClass('button-none');
                $(this).html('<i class="fas fa-spinner fa-spin"></i> @lang('Processing')...');
            });
        })(jQuery);
    </script>
@endpush

