@extends('layouts.users')


@section('content')

    <body data-theme-color="color-blue">
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
                    background: #ed7016;
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
                                <h5 class="mb-0">Level {{ $level }} Team</h5>
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
            <meta name="theme-color" content="#ed7016">

            <style>
                body {
                    background: linear-gradient(183deg, #c7cd49, #f9ff6b 34%, #fdffda);


                }

                .content-inner {
                    padding-top: 40px;
                    padding-bottom: 582px;
                }

                .profile-header {
                    color: #363636;
                    padding: 20px;
                    text-align: center;
                    border-radius: 10px;
                    background: white ! important;
                    margin-top: -80px;
                }

                .w-32 {
                    width: 32%;
                }

                .header {
                    background: #c5ce00 !important;
                    min-height: 120px;
                    z-index: 2;
                    border-bottom: 0px solid #dddddd;
                    border-bottom-left-radius: 20%;
                    border-bottom-right-radius: 20%;
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

                .text-white {
                    --bs-text-opacity: 1;
                    color: #008cff !important;
                    font-weight: bold;
                    font-family: 'Poppins';
                    font-size: 27px;
                }

                .record-date {
                    color: var(--primary) !important;
                    color: #9237e3;
                    border: none;
                    border-radius: 10px;
                    padding: 7px 9px;
                    font-size: 9px;
                    text-transform: capitalize;
                    font-weight: bold;
                    margin-top: -3px;
                    margin-left: auto;
                    background: #ff000000;
                    position: absolute;
                    right: -14px;
                    top: 1%;
                }

                .info-item {
                    display: flex;
                    justify-content: space-between;
                    margin: 0px 0;
                }

                .text-white {
                    --bs-text-opacity: 1;
                    color: #008cff !important;
                }
            </style>

            <div class="page-content">

                <div class="title-bar mt-3">
                    <p class="backbutton" onclick="navigate('/home/team');">
                        <i class="fa-solid fa-chevron-left" style="color: white;"></i>
                    </p>
                    <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
                </div>

                <div class="content-inner pt-0">
                    <div class="container fb">

                        <div class="profile-header bg-primary">
                            <div class="row">
                                <div class="col-6">
                                    <center>
                                        <h4 class="text-white">{{ $referrals->count() }}</h4>
                                        <span>Total People</span>
                                    </center>
                                </div>
                                <div class="col-6">
                                    <center>
                                        <h4 class="text-white">{{ $general->cur_sym }} {{ teamDeposit($user->id, $level) }}
                                        </h4>
                                        <span>Total Invest</span>
                                    </center>
                                </div>
                            </div>
                        </div>


                        <div class="alert alert-light light alert-dismissible fade show mt-3">
                            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            @forelse ($referrals as $user)
                                <li class="flex_be">
                                    <div class="recordleft">
                                        <span class="info-item">
                                            <div>ID:</div>
                                            <span class="info-item">{{ $user->mobile }}</span>
                                        </span>
                                        <span class="info-item">
                                            <span>Total Invest</span>
                                            <span>{{ $general->cur_sym }}{{ number_format($user->total_investment) }}</span>
                                        </span>
                                    </div>
                                    <span class="info-item">
                                        <div class="record-date">{{ $user->created_at }}</div>
                                    </span>
                                </li>


                            @empty

                                <strong>No!</strong> You have 0 level {{ $level }} team memebers..
                            @endforelse

                        </div>
                    </div>
                </div>


            </div>





            <!-- Swiper -->
            <!-- Swiper -->



        </div>

    </body>
@endsection
