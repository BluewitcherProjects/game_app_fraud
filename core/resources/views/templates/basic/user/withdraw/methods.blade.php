@extends('layouts.users')

@section('content')

    <body data-theme-color="color-orange">
        <div class="page-wraper">


            <style>
                .header .header-content .mid-content {
                    flex: 1;
                    text-align: left;
                }

                .header {
                    background-color: #ed7016;
                    min-height: 55px;
                    z-index: 2;
                    border-bottom: 0px solid #dddddd;
                }

                #preloader {
                    top: 0;
                }

                i.fa-solid.fa-bell {
                    font-size: 22px;
                    color: white;
                    margin-top: 12px;
                    padding-right: 7px;
                }

                i.fa-solid.fa-globe {
                    font-size: 22px;
                    color: white;
                    margin-top: 12px;
                    padding-right: 7px;
                }

                .header .sticky-header {
                    top: 0px;
                    background: #00000000;
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
            </style>


            <!-- Header -->
            <header class="header">
                <div class="main-bar">
                    <div class="container">
                        <div class="header-content">

                            <div class="mid-content">
                                <h5 class="mb-0">Withdraw</h5>
                            </div>
                            <!--              <div class="right-content">-->
                            <!--                  <a href="javascript:void(0);" class="menu-toggler">-->
                            <!--	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                            <!--		<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"/>-->
                            <!--		<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"/>-->
                            <!--	</svg>-->
                            <!--</a>-->
                            <!--              </div>-->
                        </div>
                    </div>
                </div>
            </header>



            <!--   <div id="preloader">-->
            <!--	<div class="spinner"></div>-->
            <!--</div>-->
            <meta name="theme-color" content="#fff">
            <style>
                body {
                    background: #fff;

                }

                .profile-header {
                    color: white;
                    padding: 20px;
                    text-align: center;
                    border-radius: 10px;
                    background: var(--gradient);
                }

                .w-32 {
                    width: 32%;
                }

                .header {
                    background: linear-gradient(270deg, #06B556 0%, #02ad50 100%);
                    min-height: 300px;
                    background-size: cover;
                    z-index: 2;
                    border-bottom: 0px solid #dddddd;
                    border-bottom-left-radius: 20%;
                    border-bottom-right-radius: 20%;
                }

                .modal-body {
                    padding: 1.3rem;
                    background: #ffffff;
                    margin: 5px;
                    margin-top: 10px;
                    border-radius: 12px;
                    height: 300px;
                }

                .header .header-content .mid-content {
                    flex: 1;
                    text-align: center;
                }

                h5.mb-0 {
                    color: white;
                    margin-top: 22px;
                }

                .backbutton {
                    width: 36px;
                    height: 36px;
                    background: #ffffff1c;
                    border-radius: 12px 12px 12px 12px;
                    border: 1px solid #ffffff80;
                    line-height: 36px;
                    text-align: center;
                    position: absolute;
                    top: 20px;
                    left: 15px;
                    color: white;
                }

                .RecordButton {
                    width: 36px;
                    height: 36px;
                    background: #ffffff1c;
                    border-radius: 12px 12px 12px 12px;
                    border: 1px solid #ffffff26;
                    line-height: 36px;
                    text-align: center;
                    position: absolute;
                    top: 178px;
                    right: 22px;
                    color: white;
                }

                .common_card {
                    background: rgb(255 255 255 / 0%);
                    border-radius: 8px 8px 8px 8px;
                    padding: 15px;
                    margin-bottom: 20px;
                    justify-items: center;
                    margin-top: -232px;
                }

                .common_card .common_card_content {
                    border-radius: 8px;
                }

                p {
                    margin-top: 0;
                    margin-bottom: 0rem;
                }

                .card {
                    display: none;
                }

                .modal-content {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    width: 91%;
                    pointer-events: auto;
                    border: 0px solid rgba(0, 0, 0, 0.2);
                    outline: 0;
                }

                .common_card {
                    background: rgb(255 255 255 / 0%);
                    border-radius: 8px 8px 8px 8px;
                    padding: 40px;
                    margin-bottom: 20px;
                }

                .common_card .common_card_content {
                    background: #ffffff00;
                    border-radius: 8px;
                }

                .common_explain {
                    border-left: 4px solid #EBD8A3;
                    padding-left: 10px;
                    font-family: Arial, Arial;
                    font-weight: 700;
                    font-size: 18px;
                    color: #02ac52;
                    line-height: 21px;
                }

                .common_content {
                    margin-top: 15px;
                    font-family: system-ui;
                    font-weight: 600;
                    font-size: 13px;
                    color: #01b152;
                    line-height: 20px;
                }

                .common_content p {
                    margin-bottom: 15px;
                }

                .border-2 {
                    border-width: 1px !important;
                }

                .border-primary {
                    border-color: #05b353 !important;
                }

                .mt-3 {
                    margin-top: 1.8rem !important;
                }

                .float-end {
                    float: left !important;
                }

                .menubar-area {
                    display: none;
                }

                .mb-1 {
                    margin-bottom: 0.25rem !important;
                    color: #04b256;
                    font-family: 'Poppins';
                    font-size: 15px;
                    font-weight: bold;
                }

                .modal-body {
                    padding: 1.3rem;
                    background: #ffffff;
                    margin: 5px;
                    margin-top: 10px;
                    border-radius: 12px;
                    height: 300px;
                }

                .form-control {
                    height: 55px;
                    padding: 10px 25px;
                    font-size: 18px;
                    font-weight: 800;
                    color: #04b256;
                    transition: all 0.3sease-in-out;
                    background: #ffffff29;
                    border-radius: 45px;
                }

                .form-control::placeholder {
                    font-weight: bold;
                    font-size: 12px;
                }

                .form-control:disabled,
                .form-control[readonly] {
                    background-color: #e9ecef00;
                    opacity: 1;
                    height: 47px;
                }

                .form-control:focus,
                .form-control:active,
                .form-control.active {
                    border-color: var(--primary);
                    background: #fff;
                    color: #000;
                }

                .btn.btn-sm,
                .btn-group-sm>.btn {
                    padding: 8px 8px;
                    line-height: 1.1;
                    font-size: 12px;
                    border-radius: var(--border-radius-base);
                    background: #04b256;
                    border: none;
                }

                .ms-2 {
                    margin-left: -2rem !important;
                }
            </style>

            <div class="page-content">

                <div class="content-inner pt-0">
                    <div class="container fb">

                        <div class="common_card" style="padding: 20px;">
                            <div class="common_card_content" style="background: #FFFFFF00;">

                                <p class="value"
                                    style="font-family: Arial, Arial;font-weight: 700;font-size: 32px;color: #ffffff;line-height: 21px;">
                                    {{ $general->cur_sym }}{{ number_format(auth()->user()->bonus_balance) }}</p>
                            </div>
                        </div>

                        <div class="modal-body pt-0">
                            <form action="{{ route('user.withdraw') }}" method="POST">
                                @csrf
                                <input type="hidden" id="withdrawBalance" name="balance" value="2">
                                <input type="hidden" id="withdrawMethodCode" name="method_code" value="1">

                                <div class="form-group">
                                    <label class="mb-1" style="margin-top: 44px;">Enter Amount</label>
                                    <input id="withdrawAmount" type="number" min="1"
                                        class="form-control rounded border border-2 border-primary" name="amount"
                                        placeholder="Enter Amount" value="" required="">
                                </div>

                                <div class="form-group mt-2">
                                    <label class="mb-1">Bank Information</label>
                                    <div class="d-flex align-items-center border border-2 border-primary rounded p-1"
                                        style="background: #9ed23000;">
                                        <input class="form-control border-0 shadow-none" name="account_number"
                                            value="{{ Split_Hide_Name(auth()->user()->bankAccount->account_number) }}"
                                            placeholder="Account Number" readonly="" required="">
                                        <button type="button" class="btn btn-primary btn-sm ms-2"
                                            onclick="window.location.href='{{ url('user/bank/delete') }}'">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>


                                <button onclick="submitWithdraw()" id="withdrawButton"
                                    class="mt-3 btn rounded btn-primary p-2 float-end"
                                    style="padding: 21px !important;font-size: 125% !important;width: 104%;margin-left: -7px;font-weight: 700;border-radius: 35px ! important;margin-top: 45px;background:linear-gradient(270deg, #06B556 0%, #02ad50 100%);border:none; ">Withdraw</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="title-bar mt-3">
                <p class="backbutton" onclick="navigate('/home/');">
                    <i class="fa-solid fa-chevron-left" style="color: white;"></i>
                </p>
                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
            </div>
            <div class="title-bar mt-3">
                <p class="RecordButton" onclick="window.location.href='{{ route('user.withdraw.history') }}'">
                    <i class="fa-solid fa-receipt" style="color: white;"></i>
                </p>
                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
            </div>

            <div class="common_card position" style="margin-top: -136px;width: 95%;margin-left: 8px;">
                <div class="common_card_content">
                    <div class="demo-login-container" style="">
                        <p class="common_explain">Explain</p>
                        <div class="common_content">
                            <p>
                                1. The daily market promotion time is from 09:00:00&nbsp;to&nbsp;16:30:00
                            </p>
                            <p>
                                2. Single withdrawal amount between
                                {{ $general->cur_sym }}{{ number_format($withdrawMainMethod->min_limit) }}
                                and&nbsp;{{ $general->cur_sym }}{{ number_format($withdrawMainMethod->max_limit) }}
                            </p>
                            <p>
                                4. Withdrawal tax
                                rate:&nbsp;{{ round($withdrawMainMethod->percent_charge) == 0 ? 'none' : round($withdrawMainMethod->percent_charge) . '%' }}
                            </p>
                        </div>
                    </div>
                </div>







            </div>
        </div>


        <div id="withdrawModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true"
            style="width: 110%;">
            <div class="modal-dialog modal-sm m-0 position-absolute w-100 bottom-0">
                <div class="modal-content" style="border-radius: 0.75rem 0.75rem 0rem 0rem !important;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Withdraw Funds</h5>
                        <button class="btn-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>


                    <style>
                        .amount-btn {
                            width: 23% !important;
                            white-space: nowrap;
                            overflow-x: hidden;
                        }

                        .gateway:checked+label {
                            color: var(--primary);
                        }

                        input[type="radio"] {
                            width: 15px;
                            height: 15px;
                            accent-color: var(--primary);
                        }

                        input[type="radio"]:hover {
                            filter: brightness(1.1);
                        }
                    </style>




                    <style>
                        .menubar-area .toolbar-inner .nav-link.active:after,
                        .menubar-area .toolbar-inner .menu-toggler.active:after {
                            content: "";
                            position: absolute;
                            bottom: -11px;
                            height: 5px;
                            background: #340166;
                        }

                        .menubar-area {
                            position: fixed;
                            bottom: 0;
                            left: 0;
                            width: 100%;
                            background: #fff;
                            padding: 20px;
                            z-index: 999;
                            padding-top: 12px !important;
                            padding-bottom: 10px !important;
                            border-radius: 8px 8px 0px 0px;
                            box-shadow: 0 12px 26px 0 rgba(0, 0, 0, 0.3);
                        }

                        a:hover,
                        a:focus,
                        .fa-solid,
                        a.active,
                        .fa-solid.active {
                            text-decoration: none;
                            outline: none;
                            color: var(--primary-hover);
                        }
                    </style>




                </div>
                <!--**********************************
                                            Scripts
                                        ***********************************-->






                <!-- Swiper -->
                <!-- Swiper -->




                <!--<script src="index.js" defer></script>-->
                <!--<script src="/assets/app/js/jquery.js"></script>-->
                <!--<script src="/assets/app/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
                <!--<script src="/assets/app/js/settings.js"></script>-->
                <!--<script src="/assets/app/js/custom.js"></script>-->
                <!--<script src="/assets/app/js/dz.carousel.js"></script><!-- Swiper -->
                <!--<script src="/assets/app/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->

            </div>
        </div>

    </body>


    <script>
        function submitWithdraw() {
            const button = $("#withdrawButton");
            button.prop("disabled", true);

            const methodCode = $("#withdrawMethodCode").val();
            const amount = $("#withdrawAmount").val();
            const balance = $("#withdrawBalance").val();



            $.ajax({
                url: "{{ route('user.withdraw.money') }}",
                method: "POST",
                data: {
                    method_code: methodCode,
                    amount: amount,
                    balance: balance,
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        window.location.href = "{{ route('user.withdraw') }}";
                    } else {
                        alert(response.error);
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                        button.prop("disabled", false);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation error from the controller
                        alert(xhr.responseJSON.error);
                    } else {
                        // General error

                        alert(xhr.responseJSON.error);
                        if (xhr.responseJSON.redirect_url) {
                            window.location.href = xhr.responseJSON.redirect_url;
                        }
                    }
                    button.prop("disabled", false);
                }
            });
        }
    </script>
@endsection
