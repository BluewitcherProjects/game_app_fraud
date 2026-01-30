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
                                <h5 class="mb-0">Income Record</h5>
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
                    background: linear-gradient(180deg, #EBF6EC 0%, #F6FDF6 100%);

                }

                .page-wraper {
                    height: 937px;
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

                .header .header-content .mid-content {
                    flex: 1;
                    text-align: center;
                }

                .header {
                    background: #058c43 !important;
                    min-height: 40px;
                    margin-bottom: 70px;
                    border-bottom: 0px solid #dddddd;
                    border-bottom-left-radius: 0%;
                    border-bottom-right-radius: 0%;
                }

                h5.mb-0 {
                    color: white;
                    margin-top: 2px;
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
                    top: 10px;
                    left: 15px;
                    color: white;
                }

                .fb {
                    padding-bottom: 80px;
                    margin-top: -70px;
                }

                .py-2 {
                    padding-top: 1rem !important;
                    padding-bottom: 1rem !important;
                }

                .card {
                    border-radius: 12px;
                    margin-bottom: 0.8rem;
                    border: 0px solid #058c43;
                    background: #fff;
                    box-shadow: 0px 4px 10px rgb(5 140 67 / 9%) !important;
                }

                .badge {
                    display: none;
                }

                .text-success {
                    --bs-text-opacity: 1;
                    color: rgb(5 140 67) !important;
                }

                .text-muted {
                    --bs-text-opacity: 1;
                    color: #494949 !important;
                }
            </style>
            <div class="page-content">

                <div class="content-inner pt-0">
                    <div class="container fb mb-4">

                        @forelse ($logs as $k => $data)
                            <div class="card transaction-card success shadow-sm">
                                <div class="card-body position-relative p-3 py-2">

                                    <div class="position-absolute badge bg-success"
                                        style="font-size: 9px; right:0; top:0; border-radius: 0px 8px 0px 8px;">
                                        Success </div>


                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <span class="card-title mb-1"
                                                style="font-size: 16px;font-weight:bold;">{{ $data->details }}</span>
                                            <p class="text-muted mb-0" style="font-size: 10px;">Date:
                                                {{ $data->created_at }}</p>
                                        </div>
                                        <div>

                                            <h6 class="mt-0 mb-0 text-success" style="font-size: 22px; font-weight: bold;">
                                                {{ $data->trx_type }}{{ $general->cur_sym }}{{ number_format($data->amount, 2) }}
                                            </h6>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        @empty

                            <center>
                                <p class="mt-5">No Withdrawal Found</p>
                            </center>
                        @endforelse


                    </div>
                </div>
            </div>






            <div id="topupModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm m-0 position-absolute w-100 bottom-0">
                    <div class="modal-content" style="border-radius: 0.75rem 0.75rem 0rem 0rem !important;">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">Top Up</h5>
                            <button class="btn-close" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-0">
                            <form action="/home/create_topup_order" method="POST">
                                <div class="form-group">
                                    <label class="mb-2">Amount</label>
                                    <input oninput="checkAmount(this.value)" id="topupAmount" type="number" min="100"
                                        class="form-control rounded border border-2 border-primary" name="amount"
                                        placeholder="Enter Amount" value="0">
                                </div>

                                <div class="mt-3 d-flex flex-wrap gap-2">
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 100
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 200
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 500
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 1000
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 2000
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 5000
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 10000
                                    </div>
                                    <div class="amount-btn btn-primary rounded p-2 text-primary text-center light">
                                        ₹ 15000
                                    </div>
                                </div>

                                <div class="w-100 gap-1 mt-3 d-flex flex-wrap justify-content-between align-items-center"
                                    style="font-size: 85%;">

                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-1">



                                        <div
                                            class="border border-primary border-1 p-2 rounded d-flex justify-content-start align-items-center gap-1 gateway-box">
                                            <input onchange="updateGateway(this);" id="gateway1" class="gateway"
                                                type="radio" name="gateway" value="1" checked=""><label
                                                for="gateway1">Channel A</label>
                                        </div>


                                        <div
                                            class="border border-muted border-1 p-2 rounded d-flex justify-content-start align-items-center gap-1 gateway-box">
                                            <input onchange="updateGateway(this);" id="gateway2" class="gateway"
                                                type="radio" name="gateway" value="2"><label for="gateway2">Channel
                                                B</label>
                                        </div>

                                    </div>

                                    <button disabled="" id="rechargeBtn" type="submit"
                                        class="btn rounded btn-primary p-2"
                                        style="padding: 11px !important; font-size: 85% !important;">Recharge</button>


                                </div>



                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="title-bar mt-3">
                <p class="backbutton" onclick="navigate('/home/profile');">
                    <i class="fa-solid fa-chevron-left"></i>
                </p>
                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
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






            <!-- Swiper -->
            <!-- Swiper -->


        </div>
    </body>
@endsection
