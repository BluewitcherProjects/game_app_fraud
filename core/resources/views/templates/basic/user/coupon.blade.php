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
                                <h5 class="mb-0">Redeem Code</h5>
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

            <form action="" method="post">
                @csrf
                <div class="page-content">



                    <div class="content-inner pt-0">
                        <div class="container fb">
                            <a href="{{ $general->telegram_api_token }}" target="_blank"
                                style="
                                    position: absolute;
                                    right: 22px;
                                    top: 69px;
                                    text-decoration: none;
                                ">
                                <img src="https://i.postimg.cc/jdQF3yNW/icon-big-gift.webp"
                                    style="
                                        width: 50px;
                                    ">
                                <p
                                    style="
                                    font-size: 11px;
                                    font-weight: bold;
                                    color: #ffffffb8;
                                    text-align: center;
                                    margin-top:35px;
                                    margin-left:-5px
                                ">
                                    Code Here</p>
                            </a>

                            <div class="redeem-card text-center">



                                <div class="mb-4">
                                    <input type="text" class="form-control input-code text-center"
                                        placeholder="Enter Gift Code" name="code" id="giftCode">
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill w-100">Claim
                                    Reward</button>


                                <p class="mt-3 text-danger" id="errorMessage" style="display: none;">Invalid code. Please
                                    try
                                    again!</p>
                                <p class="mt-3 text-success" id="successMessage" style="display: none;">Code redeemed
                                    successfully!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>




            <div class="title-bar mt-3">
                <p class="backbutton" onclick="navigate('/home/profile')">
                    <i class="fa-solid fa-chevron-left" style="color: white;"></i>
                </p>
                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
            </div>




            <style>
                b,
               strong,
               .strong {
                   font-weight: revert-layer;
               }
              body {
            background:url({{ asset('assets/app/img/bg-exchange.png') }});
            background-repeat: no-repeat;
            background-size:100%;
            background-color: #0e1027;
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
                   background: #2196f300 !important;
                   min-height: 150px;
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
               .redeem-card {
                   background: #ffffff00;
                   border-radius: 12px;
                   padding: 28px;
                   color: #333;
                   max-width: 400px;
                   margin: auto;
               }
               .redeem-card h3 {
                   color: #007bff;
               }
               .mt-3 {
        margin-top: -19rem !important;
        font-weight: bold;
    }
               .btn-redeem {
                   background: #007bff;
                   color: #fff;
                   border-radius: 50px;
                   font-weight: bold;
               }
               .btn-redeem:hover {
                   background: #0056b3;
               }
               .input-code {
                   border-radius: 10px;
                   z-index: 1000;
                position: relative;
               }
               .menubar-area {
                   display: none;
               }
               .fb {
                   padding-bottom: 80px;
                   margin-top: 20px;
               }
               .common_card {
                   background: rgba(255, 255, 255, 1);
                   border-radius: 8px 8px 8px 8px;
                   padding: 15px;
                   margin-bottom: 20px;
               }
               .common_card .common_card_content {
                   background: #FFFFFF;
                   border-radius: 8px;
               }
               .common_explain {
                   border-left: 4px solid #EBD8A3;
                   padding-left: 10px;
                   font-family: Arial, Arial;
                   font-weight: 700;
                   font-size: 18px;
                   color: #3D3D3D;
                   line-height: 21px;
               }
               .common_content {
                   margin-top: 15px;
                   font-family: Arial, Arial;
                   font-weight: 400;
                   font-size: 14px;
                   color: #2A415C;
                   line-height: 22px;
               }
               .common_content p {
                   margin-bottom: 15px;
               }
               
               .rounded-pill {
                border-radius: 12px ! important;
            }
            
            .btn-primary {
        height: 78px;
        background: url(https://i.postimg.cc/2yLWP2bQ/bg-exchange-btn.png);
        border: 0px #ffffff55 solid;
        background-size: cover;
    }
    
    .btn {
        font-size: 21px;
        font-weight: bold;
        padding: 13px 22px;
        line-height: 116px;}
            
            .form-control {
        height: 60px;
        border: 3px solid #ff0025;
        padding: 10px 25px;
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
        transition: all 0.3sease -in-out;
        background: #ffffffd4;
        border-radius: 10px;
    }
    
    .form-control:focus, .form-control:active, .form-control.active {
        border-color: red;
        background: #fff;
    }
    
    .btn-primary:active, .btn-primary:focus, .btn-primary:hover {
        border-color: #2196f300;
        background-color: #0c7cd500;
        box-shadow: none;
    }
    
    .mb-4 {
        margin-bottom: 15.5rem !important;
    }
            
            img {
                margin-bottom: -43px;
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




    </body>
@endsection
