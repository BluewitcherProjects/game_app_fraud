@extends('layouts.users')


@section('content')
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/me.css') }}">

    <body>
        </script>
        <div class="headerbg flex_be">
            <div class="flex_sta">
                <img class="back" src="{{ asset('uploads/material/back.png') }}" alt="">
                <p class="pagetitle">FAQ</p>
            </div>
            <div class="flex_sta icons">
                <a href="{{ route('user.referrals') }}"><img src="{{ asset('uploads/material/toteamicon.png') }}"
                        alt=""></a>
                <a class="sharebutton"><img src="{{ asset('uploads/material/toshareicon.png') }}" alt=""></a>
            </div>
        </div>


        


        <a href="{{ $general->telegram_chat_id }}" class="kfimg" style="z-index: 999">
            <img src="{{ asset('uploads/material/kf.png') }}" alt="">
        </a>

        <div class="centeritem">
            <div class="hibox">
                <h4>Hi, how can we help?</h4>
                <p>Didn’t find the answer you were looking for? Contact our support center!</p>
                <div class="flex_be">
                    <div class="flex_be subcus click_href" data-href="{{ $general->telegram_chat_id }}">
                        <img src="{{ asset('uploads/material/faq1.png') }}" alt="">
                        <div>Subscribe To Our <br> Channel</div>
                    </div>
                    <div class="flex_be subcus click_href" data-href="{{ $general->telegram_api_token }}">
                        <img src="{{ asset('uploads/material/faq2.png') }}" alt="">
                        <div>Customer Service</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detaillist">
            <p class="modaltitle">FAQ</p>
            <ul class="questionlist marigntop2">


                <li class="trans">
                    <div class="question">
                        <div class="flex_be">
                            <p>Q1:I deposited, why didn't I get my order?</p>
                            <img class="questionimg" src="{{ asset('uploads/material/up.png') }}" alt="">
                        </div>
                    </div>
                    <div class="answer" style="display: block;">
                        <p>Enter "Payment Record" to upload a screenshot of this payment and enter other info in that page
                            if required and submit.
                            Your application will be under review and you'll get your order recovered within 24h.</p>
                    </div>
                </li>

                <li class="">
                    <div class="question">
                        <div class="flex_be">
                            <p>Q2:Why my withdrawl is still processing?</p>
                            <img class="questionimg" src="{{ asset('uploads/material/up.png') }}" alt="">
                        </div>
                    </div>
                    <div class="answer" style="display: none;">
                        <p>The withdrawal is usually transferred automatically within minutes. At times, it might be delayed
                            for a little while but no more than 24h. If you still haven't received your withdrawal after
                            24h, you shall check your bank info carefully and correct it if anything wrong, or reach out to
                            our support for assistance.
                        </p>
                    </div>
                </li>

                <li class="">
                    <div class="question">
                        <div class="flex_be">
                            <p>Q3:Why my withdrawal got failed?</p>
                            <img class="questionimg" src="{{ asset('uploads/material/up.png') }}" alt="">
                        </div>
                    </div>
                    <div class="answer" style="">
                        <p>Normally this won't happen as long as your bank info is entered correctly. We suggest you
                            carefully re-check your bank info and correct it if anything wrong. Swifing to another bank card
                            to withdraw is also recommeneded if it still fails. If none of these above make it, please
                            contact support for assistance.</p>
                    </div>
                </li>

            </ul>
        </div>
        <div class="footer flex_be">
            <a href="{{ route('user.home') }}">
                <img src="{{ asset('uploads\material\20250411\f009397ad7700e00d7a6d8189fefe4d3.png') }}" alt="">
                <p>Home</p>
            </a>
            <a href="{{ route('user.investment.log') }}">
                <img src="{{ asset('uploads\material\20250411\d6c4a41a832f1a3372d4d80ecfbd0ce3.png') }}" alt="">
                <p>Order</p>
            </a>
            <a href="{{ route('user.profile.setting') }}">
                <img src="{{ asset('uploads\material\20250411\fa0eed652edb4df4c344aa74ef9328ac.png') }}" alt="">
                <p>Me</p>
            </a>

        </div>
        <script type="text/javascript">

        </script>
        <script>
            $('li .question').click(function() {
                $(this).siblings().slideToggle(300)
                $(this).parent().toggleClass('trans')
            })
        </script>

    </body>
@endsection
