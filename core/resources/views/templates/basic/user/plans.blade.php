{{-- @extends($activeTemplate.'layouts.master') --}}
@extends('layouts.users')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <body data-theme-color="color-red">
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
                                <h5 class="mb-0">Products List</h5>
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
                    background: linear-gradient(183deg, #d8e01e, #d8e01e 34%, #d8e01e);

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
                    background: #d8e01e !important;
                    min-height: 40px;
                    border-bottom: 0px solid #dddddd;
                    border-bottom-left-radius: 0%;
                    border-bottom-right-radius: 0%;
                }

                .container {
                    padding-top: 0px;
                }

                h5.mb-0 {
                    color: white;
                    margin-top: 3px;
                }

                .header .header-content .mid-content {
                    flex: 1;
                    text-align: center;
                }

                h5,
                .h5 {
                    font-size: 1.3rem;
                }

                .col-4 {
                    flex: 0 0 auto;
                    width: 63.33333%;
                }


                .ptgld.active::after {

                    display: none;
                }

                .card {
                    margin-bottom: 1rem;
                    border-radius: 15px;
                    background-color: hsl(0deg 0% 100% / 0%);
                }

                .vip-card-container {
                    width: auto;
                    background: hsl(0deg 0% 100%);
                    border-radius: 15px;
                    box-shadow: 0 4px 8px rgb(0 0 0 / 3%);
                    padding: 5px 15px 10px 15px;
                    border: 0px solid #ddd;
                    zoom: 80%;
                }

                .vip-card-header {
                    background: #2196f300 !important;
                    color: #ffffff;
                    padding: 10px;
                    border-radius: 8px;
                    font-size: 18px;
                    font-weight: bold;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .vip-card-header span {
                    display: flex;
                    align-items: center;
                }

                .vip-card-header span .vip-icon {
                    font-style: italic;
                    opacity: 0.5;
                    margin-right: 2px;
                }

                .vip-card-button {
                    background: #c9d200;
                    color: #ffffff;
                    border: none;
                    padding: 15px 161px;
                    font-size: 21px;
                    border-radius: 17px;
                    font-weight: bold;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                    box-shadow: rgba(255, 255, 255, 0.1) -3px -3px 9px inset, rgba(255, 255, 255, 0.15) 0 3px 9px inset,
                        rgba(255, 255, 255, 0.6) 0 1px 1px inset, rgba(0, 0, 0, 0.12) 0 -8px 36px inset, rgba(255, 255, 255, 0.6) 0 1px 5px inset, rgb(0 0 0 / 10%) 2px 19px 31px;
                }

                .vip-card-content {
                    display: flex;
                    margin-top: 14px;
                    flex-direction: column;
                }

                .vip-card-image {
                    width: 120px;
                    height: 100px;
                    border-radius: 8px;
                    margin-right: 10px;
                }

                .vip-card-details div {
                    display: flex;
                    justify-content: space-between;
                    padding: 5px 0;
                    flex-direction: column;
                    align-items: center;
                }

                .vip-card-details {
                    text-align: left;
                    font-size: 12px;
                    flex: 1;
                    display: flex;
                    flex-wrap: wrap;
                    font-weight: 800;
                    justify-content: space-around;
                    margin-top: 15px;
                    margin-left: -13px;
                    margin-bottom: 10px;
                }

                .vip-price-highlight {
                    color: var(--primary) !important;
                    font-weight: bold;
                    font-size: 20px;
                }

                .vip-green-text {
                    color: #484848 !important;
                    font-weight: bolder;
                    font-size: 20px;
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
                    right: 15px;
                    color: white;
                }

                .title-bar {
                    display: flex;
                    align-items: center;
                    margin-bottom: 0px;
                    justify-content: space-between;
                }

                .w-75 {
                    width: 58% !important;
                    border-radius: 12px;
                    margin-top: -5px;
                    margin-left: -15px;
                }

                .top-info {
                    background: url("{{ asset('assets/app/img/vip-top-bg-Wg-Mjb-Cy-P.png') }}") no-repeat;
                    background-size: 100% 100%;
                    border-radius: 6px;
                    margin-bottom: 16px;
                    padding: 20px 12px;
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    margin: 15px;
                }

                .num {
                    font-size: 21px;
                    font-weight: 700;
                    color: #fff;
                    margin-bottom: 0px;
                    text-align: center;
                }

                .label {
                    text-align: center;
                    font-size: 10px;
                    color: #ffffff96;
                }

                .col-4 {
                    flex: 0 0 auto;
                    width: 77.33333%;
                    margin-left: -28px;
                }

                .xqzkvc {
                    display: flex;
                    background: #fff;
                    border: 8px solid #ffffff;
                    border-radius: 12px;
                    padding: 2px;
                    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
                    position: relative;
                    justify-content: space-evenly;
                    color: black;
                    max-width: 420px;
                    margin: auto;
                    margin-bottom: 20px;
                }

                /* 🔹 Tab Buttons */
                .ptgld {
                    padding: 12px 20px;
                    border-radius: 10px;
                    font-size: 18px;
                    font-weight: bold;
                    text-align: center;
                    cursor: pointer;
                    transition: all 0.3s ease-in-out;
                    flex: 1;
                }

                /* 🔹 Active Tab Effect */
                .ptgld.active {
                    background: #c9d200;
                    color: white !important;
                    transform: scale(1.1);
                    margin-left: 8px;
                    box-shadow: 0px 4px 10px rgb(255 255 255 / 0%);
                }

                span {
                    display: flex;
                }

                .bg-primary {
                    background-color: #008cff !important;
                }

                .btn {
                    padding: 10px 10px;
                    line-height: 1.1;
                    font-size: 12px;
                    border-radius: 10px;
                    background: #c7cd49;
                    border: 1px #d4d4d4 solid;
                }

                .text-primary {
                    color: #7db800 !important;
                    font-weight: bold;
                }
            </style>

            {{-- <style>
                .yhwop {
                    display: none;
                }

                .yhwop.active {
                    display: block;
                }
            </style> --}}
            <!-- Page Content -->
            <div class="page-content">
                <div class="title-bar mt-3">
                    <p class="backbutton" onclick="window.location.href='{{ route('user.investment.log') }}'">
                        <i class="fa-solid fa-bag-shopping" style="color: white;"></i>
                    </p>
                    <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
                </div>
                <div class="content-inner pt-0">
                    <div class="container fb">

                        <div class="xqzkvc">
                            <div class="ptgld active" data-tab="welfare">Daily Plan</div>
                            <div class="ptgld" data-tab="fixed">Benefits Plan</div>
                        </div>
      

                        <div id="welfare" class="yhwop active">
                            @foreach ($plans->where('type', '0') as $plan)
                                <div class="card shadow">
                                    <div class="vip-card-container">
                                        <div class="vip-card-content">
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <!-- Image -->
                                                <img class="w-75" src="{{ asset('assets/app/img/car.png') }}">
                                                <!-- Plan Details -->
                                                <div>
                                                    <span
                                                        style="font-weight: bold; font-size: 16px;">{{ $plan->name }}</span><br>
                                                    <span style="font-size: 14px; color: gray;">Product Price:</span>
                                                    <span
                                                        style="color: #EBA937;font-weight: bold;font-size: 21px;">{{ $general->cur_sym }}
                                                        {{ number_format($plan->min_amount) }}</span>
                                                </div>
                                            </div>
                                            <div class="vip-card-details">
                                                <div><span>Daily Income</span> <span
                                                        class="vip-green-text">{{ $general->cur_sym }}
                                                        {{ $plan->interest_amount }}</span></div>
                                                <div><span>Total Income</span> <span
                                                        class="vip-green-text">{{ $general->cur_sym }}
                                                        {{ number_format($plan->total_return * $plan->interest_amount) }}</span>
                                                </div>
                                                <div><span>Total Days</span> <span
                                                        class="vip-green-text">{{ $plan->total_return }} Days</span></div>
                                            </div>
                                        </div>
                                        <div class="vip-card-header">
                                            <button class="vip-card-button" id="countdown-btn"
                                                onclick="openModal({
                              id: '{{ $plan->id }}',
                              price: '{{ $plan->min_amount }}',
                              days: '{{ $plan->total_return }}',
                              name: '{{ $plan->name }}',
                              description: 'Quick Return {{ $plan->total_return }} Days Plan',
                              daily_income: '{{ $plan->interest_amount }}'
                              });">
                                                Invest
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="fixed" class="yhwop">
                            @foreach ($plans->where('type', '1') as $plan)
                                <div class="card shadow">
                                    <div class="vip-card-container">
                                        <div class="vip-card-content">
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <!-- Image -->
                                                <img class="w-75" src="{{ asset('assets/app/img/car.png') }}">
                                                <!-- Plan Details -->
                                                <div>
                                                    <span
                                                        style="font-weight: bold; font-size: 16px;">{{ $plan->name }}</span><br>
                                                    <span style="font-size: 14px; color: gray;">Product Price:</span>
                                                    <span
                                                        style="color: #EBA937;font-weight: bold;font-size: 21px;">{{ $general->cur_sym }}
                                                        {{ number_format($plan->min_amount) }}</span>
                                                </div>
                                            </div>
                                            <div class="vip-card-details">
                                                <div><span>Daily Income</span> <span
                                                        class="vip-green-text">{{ $general->cur_sym }}
                                                        {{ $plan->interest_amount }}</span></div>
                                                <div><span>Total Income</span> <span
                                                        class="vip-green-text">{{ $general->cur_sym }}
                                                        {{ number_format($plan->total_return * $plan->interest_amount) }}</span>
                                                </div>
                                                <div><span>Total Days</span> <span
                                                        class="vip-green-text">{{ $plan->total_return }} Days</span></div>
                                            </div>
                                        </div>
                                        <div class="vip-card-header">
                                            <button class="vip-card-button" id="countdown-btn"
                                                onclick="openModal({
                                                    id: '{{ $plan->id }}',
                                                    price: '{{ $plan->min_amount }}',
                                                    days: '{{ $plan->total_return }}',
                                                    name: '{{ $plan->name }}',
                                                    description: 'Quick Return {{ $plan->total_return }} Days Plan',
                                                    daily_income: '{{ $plan->interest_amount }}'
                                                    });">
                                                Invest
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.investment') }}" method="post">
                @csrf
                <div class="offcanvas offcanvas-bottom">
                    <div class="container">
                        <div class="offcanvas-body small">
                            <div class="position-absolute badge bg-primary"
                                style="font-size: 12px; left:0; top:0; border-radius: 8px 0px 8px 0px;" id="product_price">
                                Price : {{ $general->cur_sym }} 1200
                            </div>
                            <div class="position-absolute badge bg-primary"
                                style="font-size: 12px; right:0; top:0; border-radius: 0px 8px 0px 8px;" id="product_days">
                                Days: 4
                            </div>
                            <img class="logo" src="{{ asset('assets/app/img/car.png') }}" alt="">
                            <h5 class="title" id="product_name">Happy New Year</h5>
                            <p class="pwa-text" id="product_description">Project Details
                                will be here
                                jvjbjabfjhsbfvjsfjjs jsg fgs fgs fusy hsi
                            </p>
                            <div class="row my-3">
                                <div class="col-6">
                                    <center>
                                        <strong class="text-primary w-100 text-center d-block fs-2"
                                            id="daily_income">{{ $general->cur_sym }}
                                            1099</strong>
                                        <span style="white-space: nowrap; font-size: 14px;">Daily
                                            Income</span>
                                    </center>
                                </div>
                                <div class="col-6">
                                    <center>
                                        <strong class="text-primary w-100 text-center d-block fs-2"
                                            id="total_income">{{ $general->cur_sym }}
                                            4396</strong>
                                        <span style="white-space: nowrap; font-size: 14px;">Total
                                            Income</span>
                                    </center>
                                </div>
                            </div>
                            <a onclick="closePlan()" class="btn btn-sm pwa-close light btn-danger ms-2 mx-1">Maybe
                                later</a>
                            <input id="id" name="id" type="hidden">
                            <button type="submit" class="btn btn-sm btn-secondary pwa-btn mx-1">Yes, Buy
                                Now</button>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-backdrop pwa-backdrop fade"></div>
            </form>
            <!-- Menubar -->



            <div class="menubar-area">
                <div class="toolbar-inner menubar-nav">
                    <a href="{{ route('user.home') }}" class="nav-link ">
                        <img src="{{ asset('assets/app/img/home.png') }}" style="width: 40px;">
                        <label style="font-size:12px; font-weight: 600; margin-top:-5px;">Home</label>
                    </a>
                    <a href="{{ route('user.investment') }}" class="nav-link ">
                        <img src="{{ asset('assets/app/img/plan_a.png') }}" style="width: 40px;">

                        <label style="font-size: 12px; font-weight: 600; margin-top:-5px;color: #d8e01e;">Plans</label>
                    </a>
                    <a href="{{ route('user.referrals') }}" class="nav-link ">
                        <img src="{{ asset('assets/app/img/team.png') }}" style="width: 40px;">
                        <label style="font-size: 12px; font-weight: 600; margin-top:-5px;">Team</label>
                    </a>
                    <a href="{{ route('user.profile.setting') }}" class="nav-link ">
                        <img src="{{ asset('assets/app/img/profile.png') }}" style="width: 40px;">

                        <label style="font-size: 12px; font-weight: 600; margin-top:-5px;">Profile</label>
                    </a>
                </div>
            </div>

            <!-- Menubar -->
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tabs = document.querySelectorAll(".ptgld");
                const contents = document.querySelectorAll(".yhwop");

                tabs.forEach(tab => {
                    tab.addEventListener("click", () => {
                        // Remove active classes
                        tabs.forEach(t => t.classList.remove("active"));
                        contents.forEach(c => c.classList.remove("active"));

                        // Add active to clicked tab and corresponding content
                        tab.classList.add("active");
                        const target = tab.getAttribute("data-tab");
                        const content = document.getElementById(target);
                        if (content) {
                            content.classList.add("active");
                        }
                    });
                });
            });
        </script>


    </body>
@endsection
@push('style')
    <style type="text/css">
        #copyBoard {
            cursor: pointer;
            height: 100%;
        }

        .input-group-text {
            background-color: #0a1227;
            border: 1px solid #373768;
            color: #fff;
        }

        #referralURL {
            background: #20204e;
            border-color: #20204e;
            color: #fff;
        }

        #social-links ul li {
            list-style: none !important;
            display: inline-block;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.ptgld');
            const contents = document.querySelectorAll('.yhwop');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));

                    // Add active to the clicked tab
                    this.classList.add('active');

                    // Hide all content sections
                    contents.forEach(content => content.classList.remove('active'));

                    // Show the selected content
                    const targetId = this.getAttribute('data-tab');
                    const target = document.getElementById(targetId);
                    if (target) {
                        target.classList.add('active');
                    }
                });
            });
        });
    </script>
@endpush
