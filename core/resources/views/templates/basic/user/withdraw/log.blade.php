@extends('layouts.users')


@section('content')

    <body data-theme-color="color-orange">
        <div class="page-wraper">


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

                .content-inner {
                    padding-top: 40px;
                    padding-bottom: 20px;
                    margin-top: -60px;
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

                .transaction-record-box {
                    width: 92%;
                    margin: 10px auto;
                    background: #ffffff;
                    box-shadow: 0px 4px 10px rgb(5 140 67 / 5%) !important;
                    border-radius: 10px;
                    padding: 20px;
                    border: 1px solid #058c4326;
                    zoom: 90%;
                    margin-top: 0px;
                }

                .withdraw-amount-button,
                .pending-status-button,
                .success-status-button,
                .reject-status-button,
                .processing-status-button {
                    padding: 10px 21px;
                    cursor: pointer;
                    font-size: 10px;
                    font-weight: 700;
                }

                .transaction-record {
                    margin-bottom: 0px;
                }

                .transaction-record span {
                    font-weight: 800;
                    font-size: 12px;
                    color: #4d4d4d;
                }

                .menubar-area {
                    display: none;
                }

                .popup-icon {
                    position: fixed;
                    right: -15px;
                    bottom: 210px;
                    background-color: #ff3b30;
                    color: white;
                    padding: 5px 10px;
                    border-radius: 20px 0px 0px 20px;
                    cursor: pointer;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    font-size: 24px;
                    width: 67px;
                    height: 45px;
                }

                .fa-2x {
                    font-size: 1em;
                }

                a:hover,
                a:focus,
                .fa-solid,
                a.active,
                .fa-solid.active {
                    text-decoration: none;
                    outline: none;
                    color: #ffffff !important;
                }

                .processing-status-button {
                    background: #ff9393;
                    box-shadow: none;
                    color: #ffffff;
                    padding: 8px 12px;
                    font-size: 13px;
                }

                .success-status-button {
                    background: #058c43;
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                    font-size: 14px;
                    padding: 8px 12px;
                }

                .pending-status-button {
                    background: #3b3b3b;
                    box-shadow: none;
                    font-size: 13px;
                    margin-bottom: -5px;
                    padding: 8px 17px;
                    color: #ffffff;
                }
            </style>


            <style>
                body {
                    background: linear-gradient(180deg, #EBF6EC 0%, #F6FDF6 100%);

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

                .mb-4 {
                    padding-bottom: 60px !important;
                }

                .transaction-record-box {
                    width: 92%;
                    margin: 10px auto;
                    background: linear-gradient(145deg, #f3f4ff, #e5e7fb);
                    border-radius: 20px;
                    padding: 20px;
                    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1), 0px 2px 4px rgba(0, 0, 0, 0.05);
                    border: 1px solid #d1d5db;
                    zoom: 90%;
                }

                .transaction-record {
                    margin-bottom: 15px;
                }

                .transaction-record-row {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .withdraw-amount-button,
                .pending-status-button,
                .success-status-button,
                .reject-status-button,
                .processing-status-button,
                .failed-status-button {
                    color: #fff;
                    border: none;
                    border-radius: 12px;
                    padding: 10px 20px;
                    cursor: pointer;
                    font-size: 12px;
                    text-transform: capitalize;
                    font-weight: 600;
                    background: #058c43;
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                    transition: all 200ms ease-in-out;
                }

                .withdraw-amount-button:hover,
                .pending-status-button:hover {
                    background: linear-gradient(145deg, #3158ff, #1c46d1);
                    transform: scale(1.05);
                }

                .transaction-record span {
                    font-weight: 600;
                    font-size: 13px;
                    color: #4b5563;
                }

                .received-amount-label,
                .transaction-fee-label,
                .transaction-status-label {
                    color: #374151;
                    font-size: 14px;
                    font-weight: 500;
                }

                .pending-status-button {
                    background: linear-gradient(145deg, #f59e0b, #d97706);
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                }

                .pending-status-button:hover {
                    background: linear-gradient(145deg, #d97706, #b45309);
                }

                .success-status-button {
                    background: linear-gradient(145deg, #34d399, #059669);
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                }

                .success-status-button:hover {
                    background: linear-gradient(145deg, #059669, #047857);
                }

                .reject-status-button {
                    background: linear-gradient(145deg, #f87171, #ef4444);
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                }

                .reject-status-button:hover {
                    background: linear-gradient(145deg, #ef4444, #dc2626);
                }

                .processing-status-button {
                    background: linear-gradient(145deg, #60a5fa, #3b82f6);
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                }

                .processing-status-button:hover {
                    background: linear-gradient(145deg, #3b82f6, #2563eb);
                }

                .failed-status-button {
                    background: linear-gradient(145deg, #a855f7, #9333ea);
                    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
                }

                .failed-status-button:hover {
                    background: linear-gradient(145deg, #9333ea, #7e22ce);
                }

                .transaction-timestamp {
                    font-size: 12px;
                    color: #9ca3af;
                    padding-right: 10px;
                }
            </style>

            <!-- Header -->
            <header class="header">
                <div class="main-bar">
                    <div class="container">
                        <div class="header-content">

                            <div class="mid-content">
                                <h5 class="mb-0">Withdrawal Records</h5>
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



            <div class="page-content">

                <div class="content-inner pt-0">
                    <div class="mb-4">

                        @php

                            function getStatusClass($status)
                            {
                                $status = strtolower($status);

                                switch ($status) {
                                    case '2':
                                        return 'pending-status-button';
                                    case '1':
                                        return 'success-status-button';
                                    case '3':
                                        return 'reject-status-button';
                                    case 'processing':
                                        return 'processing-status-button';
                                    case 'failed':
                                        return 'failed-status-button';
                                    default:
                                        return 'unknown-status-button';
                                }
                            }

                        @endphp


                        @forelse ($withdraws as $k => $data)
                            <div class="transaction-record-box">
                                <div class="transaction-record">
                                    <div class="transaction-record-row">
                                        @if ($data->status == 1)
                                            <button class="withdraw-amount-button">Withdrawal Amount:
                                                {{ $general->cur_sym }}
                                                {{ number_format($data->amount) }}</button>
                                            <span
                                                class="transaction-timestamp">{{ $data->created_at->format('d-m-Y H:i') }}</span>
                                        @elseif ($data->status == 2)
                                            <button
                                                class="withdraw-amount-button">{{ $data->created_at->format('d-m-Y H:i') }}</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="transaction-record">
                                    <div class="transaction-record-row">
                                        <span class="received-amount-label">Amount
                                            {{ $data->status == 1 ? 'Received' : '' }}</span>
                                        <span class="received-amount"
                                            style="font-size: 17px;">{{ $general->cur_sym }}{{ number_format($data->amount) }}</span>
                                    </div>
                                </div>

                                @if ($data->status == 1)
                                    <div class="transaction-record">
                                        <div class="transaction-record-row">
                                            <span class="transaction-fee-label">Fee</span>
                                            <span
                                                class="transaction-fee">{{ $general->cur_sym }}{{ number_format($data->charge) }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="transaction-record">
                                    <div class="transaction-record-row status-row">
                                        <span class="transaction-status-label">Status</span>
                                        <button class="{{ getStatusClass($data->status) }}">
                                            @if ($data->status == 1)
                                                Success
                                            @elseif ($data->status == 2)
                                                Processing
                                            @elseif ($data->status == 3)
                                                Failed
                                            @endif
                                        </button>
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


            <div class="title-bar mt-3">
                <p class="backbutton" onclick="navigate('/home/profile');">
                    <i class="fa-solid fa-chevron-left"></i>
                </p>
                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
            </div>

            

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


    </body>
@endsection
