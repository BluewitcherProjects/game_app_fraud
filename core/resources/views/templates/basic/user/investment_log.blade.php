@extends('layouts.users')

@push('style')
@endpush



@section('content')
    <script>
        "use strict"

        function createCountDown(elementId, sec) {
            var tms = sec;
            var x = setInterval(function() {
                var distance = tms * 1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById(elementId).innerHTML = days + "d: " + hours + "h " + minutes + "m " +
                    seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                tms--;
            }, 1000);
        }
    </script>


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
                                <h5 class="mb-0">My Orders</h5>
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



            <style>
                body {
                    background: #058C43;

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
                    background: #ffffff00 !important;
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

                /* Page Header */
                .page-header {
                    background: var(--gradient);
                    color: #fff;
                    text-align: center;
                    padding: 20px;
                    border-radius: 0 0 20px 20px;
                }

                /* Subscription Card */
                .subscription-card {
                    background: #fff;
                    border-radius: 15px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    margin-bottom: 20px;
                    transition: transform 0.3s ease-in-out;
                    box-shadow: 0px 4px 10px #ffffff00 !important;
                }

                .subscription-card:hover {
                    transform: translateY(-5px);
                }

                .subscription-card h5 {
                    color: #058c43;
                    font-weight: bold;
                }

                .subscription-details {
                    margin-top: 10px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 15px;
                    zoom: 85%;
                }

                .detail-item {
                    flex: 1;
                    min-width: 150px;
                }

                .detail-item span {
                    display: block;
                    font-size: 14px;
                    color: #888;
                }

                .detail-item h6 {
                    margin: 0;
                    font-weight: bold;
                    color: #058c43;
                }

                /* Progress Bar */
                .progress-container {
                    margin-top: 15px;
                }

                .progress-labels {
                    display: flex;
                    justify-content: space-between;
                    font-size: 12px;
                    color: #666;
                }

                .progress {
                    height: 10px;
                    background: #e9ecef;
                    border-radius: 5px;
                    overflow: hidden;
                }

                .progress-bar {
                    background: var(--primary);
                    height: 100%;
                    transition: width 0.4s ease-in-out;
                }

                .last-credit {
                    font-size: 12px;
                    color: #888;
                    text-align: right;
                }

                /* Add Button */
                .add-btn {
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    background: #4e73df;
                    color: #fff;
                    border: none;
                    border-radius: 50%;
                    width: 60px;
                    height: 60px;
                    font-size: 24px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                    transition: background 0.3s ease-in-out;
                }

                .add-btn:hover {
                    background: #2c3e50;
                }

                .menubar-area {
                    display: none;
                }

                .container_plans {
                    display: flex;
                    background: white;
                    border-radius: 12px;
                    padding: 16px;
                    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                    position: relative;
                    zoom: 75%;
                    margin-top: -75px;
                    justify-content: center;
                }

                .ptgld.active {
                    color: var(--primary) !important;
                }

                .ptgld {
                    font-family: Arial, sans-serif;
                    font-size: 16px;
                    font-weight: bold;
                    padding: 10px 20px;
                    color: gray;
                    cursor: pointer;
                    transition: color 0.3s ease;
                    position: relative;
                    white-space: nowrap;
                }


                .fb {
                    padding-bottom: 80px;
                    margin-top: -80px;
                }

                .content-inner {
                    padding-top: 40px;
                    padding-bottom: 582px;
                }
            </style>

            <div class="page-content">
                <div class="content-inner pt-0">

                    <div class="container fb mb-4">

                        <div class="title-bar mt-3">
                            <p class="backbutton" onclick="navigate('/home/profile');">
                                <i class="fa-solid fa-chevron-left"></i>
                            </p>

                            <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
                        </div>


                        <div id="activity" class="yhwop active">

                            @forelse ($logs as $plan)
                                <div class="subscription-card">
                                    <h5>{{ $plan->plan->name }}</h5>
                                    <hr>
                                    <div class="subscription-details">
                                        <div class="detail-item">
                                            <span>Date of Purchase</span>
                                            <h6>{{ $plan->created_at }}</h6>
                                        </div>
                                        <div class="detail-item">
                                            <span>Invested Amount</span>
                                            <h6>{{ $general->cur_sym }}{{ number_format($plan->amount) }}</h6>
                                        </div>
                                        <div class="detail-item">
                                            <span>Daily Income</span>
                                            <h6>{{ $general->cur_sym }}{{ number_format($plan->interest_amount) }}</h6>
                                        </div>
                                        <div class="detail-item">
                                            <span>Income Credited</span>
                                            <h6>{{ $general->cur_sym }}{{ $plan->total_paid * $plan->interest_amount }}</h6>
                                        </div>
                                        <div class="detail-item">
                                            <span>Remaining Income</span>
                                            <h6>{{ $general->cur_sym }}{{ $plan->interest_amount * $plan->total_return - $plan->total_paid * $plan->interest_amount }}
                                            </h6>
                                        </div>
                                        <div class="detail-item">
                                            <span>Last Credit Date</span>
                                            <h6>{{ $plan->updated_at }}</h6>
                                        </div>
                                        <div class="detail-item">
                                            <span>Total Income days</span>
                                            <h6>{{ $plan->total_return }} Days</h6>
                                        </div>
                                    </div>
                                    @php
                                        $total_days = $plan->total_return;
                                        $paid_days = $plan->total_paid;

                                        // Prevent divide by zero
                                        $percent = $total_days > 0 ? round(($paid_days / $total_days) * 100) : 0;

                                        // Ensure percent never exceeds 100
                                        $percent = min($percent, 100);
                                    @endphp
                                    <div class="progress-container">
                                        <div class="progress-labels">
                                            <span class="mb-1">Progress</span>
                                            <span class="mb-1">{{ $percent }}%</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $percent }}%" aria-valuenow="90" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                </div>

                            @empty

                                <div class="alert alert-light light alert-dismissible fade show mt-3">
                                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polygon
                                            points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                        </polygon>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                    <strong>No!</strong> You have no active subscriptions.
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>

                <script>
                    document.querySelectorAll('.ptgld').forEach(tab => {
                        tab.addEventListener('click', function() {
                            document.querySelectorAll('.ptgld').forEach(t => t.classList.remove('active'));

                            document.querySelectorAll('.yhwop').forEach(content => {
                                content.classList.add('d-none');
                                content.classList.remove('active');
                            });

                            this.classList.add('active');

                            const content = document.getElementById(this.getAttribute('data-tab'));
                            if (content) {
                                content.classList.remove('d-none');
                                content.classList.add('active');
                            }
                        });
                    });
                </script>
            @endsection
