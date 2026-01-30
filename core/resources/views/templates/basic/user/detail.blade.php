@extends('layouts.users')


@section('content')
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/details.css') }}">

    <body>
        <div class="headerbg flex_be">
            <div class="flex_sta">
                <img class="back" src="{{ asset('uploads/material/back.png') }}" alt="">
                <p class="pagetitle">Product Detail</p>
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
        <form action="{{ route('user.investment') }}" method="post">
            @csrf
            <div class="centeritem">
                <div class="goodsimgbox">
                    <img src="{{ asset('uploads/20250412/035d0dd3548df2a6bf292e6324c4886d.png') }}" class="detailbanner"
                        alt="">
                    <div class="name_r">
                        <p>{{ $plan->name }}</p>
                    </div>
                </div>
            </div>
            <div class="detailcontentbox">
                <p class="price_til">Price</p>
                <h4>{{ $general->cur_sym }}{{ number_format($plan->min_amount) }}</h4>
                <p class="days">Duration <span>{{ $plan->total_return }}</span> days</p>
                <div class="outdaily">
                    <div class="dailyroi flex_be">
                        <p>Daily ROI</p>
                        <span>{{ round(($plan->interest_amount / $plan->min_amount) * 100) }}%</span>
                    </div>
                    <div class="dailyroi flex_be">
                        <p>Daily Return</p>
                        <span>{{ $general->cur_sym }}{{ number_format($plan->interest_amount) }}</span>
                    </div>
                    <div class="dailyroi flex_be">
                        <p>Total Return</p>
                        <span>{{ $general->cur_sym }}{{ number_format($plan->total_return * $plan->interest_amount) }}</span>
                    </div>
                </div>
                <div class="paymentbox flex_sta">
                    <img class="withdrawimg" src="{{ asset('uploads/material/withdrawicon.png') }}" alt="">
                    <div style="flex: 1;">
                        <h6>Please select payment method</h6>
                        <div class="paylist">
                            <div class="flex_be ismypay" data-platform="1703" onclick="selectGateway(this)">
                                <p>GCash</p>
                                <div class="noselect"></div>
                            </div>
                            <div class="flex_be ismypay" data-platform="1704" onclick="selectGateway(this)">
                                <p>PayMaya</p>
                                <div class="noselect"></div>
                            </div>
                        </div>

                        <!-- Hidden input -->
                        <input type="hidden" name="payment_type" id="payment_gateway" value="">
                    </div>
                </div>
                <div class="paymentbox flex_sta">
                    <img class="withdrawimg" src="{{ asset('uploads/material/detail.png') }}" alt="">
                    <div style="flex: 1;" class="DetailP">
                        <h6>Detail</h6>
                        <p><span style="white-space:pre-wrap;">2000 low carbon PV modules being installed at the roof of the
                                Centre Aquatique in Saint-Denis, which will host the 2024 Olympic Games in Paris.</span></p>
                    </div>
                </div>
            </div>

            
            <input name="id" type="hidden" value="{{ $plan->id }}">
            <div class="buybottom">
                <button type="submit" style="border:none;" class="buybtn buyBtn">Buy</button>
            </div>
        </form>


    </body>

    <script>
        function selectGateway(el) {
            // Remove previous selection and icon
            document.querySelectorAll('.ismypay').forEach(item => {
                item.classList.remove('selected');
    
                const icon = item.querySelector('.selecticon');
                if (icon) {
                    icon.remove();
                }
            });
    
            // Add selection class
            el.classList.add('selected');
    
            // Add select icon to this one
            const icon = document.createElement('img');
            icon.src = "{{ asset('uploads/material/select.png') }}";
            icon.alt = "Selected";
            icon.className = "selecticon";
            el.appendChild(icon);
    
            // Set value to hidden input
            document.getElementById('payment_gateway').value = el.getAttribute('data-platform');
        }
    </script>
    
@endsection
