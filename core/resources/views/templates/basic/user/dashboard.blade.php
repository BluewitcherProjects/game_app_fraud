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


            <header class="header">
                <div class="main-bar sticky-header">
                    <div class="container">
                        <div class="header-content">
                            <!-- <div class="left-content">-->
                            <!--                  <a href="javascript:void(0);" class="menu-toggler">-->
                            <!--	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                            <!--		<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"/>-->
                            <!--		<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"/>-->
                            <!--	</svg>-->
                            <!--</a>-->
                            <!--              </div>-->
                            <!--<div class="mid-content">-->
                            <!--    <img src="https://i.postimg.cc/L6L11wnf/525e6b33-ac46-495b-aa52-ba642e7aa69f.png" style="height: 38px; margin-top: 5px; margin-left: 0px; border-radius:8px">-->
                            <!--</div>-->
                            <!--             <div class="right-content">-->
                            <!--                 <a onclick="navigate('/home/notifications');">-->
                            <!--                     <i class="fa-solid fa-globe"></i>-->
                            <!--<i class="fa-solid fa-bell"></i>-->
                            <!-- </a>-->
                        </div>
                    </div>
                </div>
            </header>
        </div>



        <!-- Sidebar -->
        <div class="sidebar">
            <div class="author-box mb-2">
                <div class="dz-media">
                    <img src="/assets/profile.png" class="rounded-circle" alt="author-image">
                </div>
                <div class="dz-info">
                    <span>Good Evening</span>
                    <h5 class="name">Ashish Shergill</h5>
                </div>
            </div>
            <ul class="nav navbar-nav">


                <li><a class="nav-link" onclick="navigate('/');">
                        <span class="dz-icon bg-pink light">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V20.7732C14.8562 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z"
                                    fill="#130F26"></path>
                            </svg>
                        </span>
                        <span>Home</span>
                    </a></li>


                <li><a class="nav-link" onclick="navigate('/home/team');">
                        <span class="dz-icon bg-orange light">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="20" height="20" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                        fill="#fff" fill-rule="nonzero"></path>
                                    <path
                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                        fill="#fff" opacity="0.5"></path>
                                </g>
                            </svg>
                        </span>
                        <span>Team</span>
                    </a></li>
                <li><a class="nav-link" onclick="navigate('/home/products');">
                        <span class="dz-icon bg-skyblue light">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="18" height="18" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#00aeff" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path
                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                        fill="#fff" opacity="0.5"></path>
                                </g>
                            </svg>
                        </span>
                        <span>Products</span>
                    </a></li>
                <li><a class="nav-link" onclick="navigate('/home/notifications');">
                        <span class="dz-icon bg-green light">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="18" height="18" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path
                                        d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z"
                                        fill="#fff"></path>
                                    <rect fill="#fff" opacity="0.3" x="10" y="16" width="4" height="4"
                                        rx="2"></rect>
                                </g>
                            </svg>
                        </span>
                        <span>Notification</span>

                    </a></li>
                <li><a class="nav-link" onclick="navigate('/home/profile');">
                        <span class="dz-icon bg-yellow light">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="18" height="18" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                        fill="#fff" fill-rule="nonzero" opacity="0.3"></path>
                                    <path
                                        d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                        fill="#fff" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                        </span>
                        <span>Profile</span>
                    </a></li>
                <li><a class="nav-link" onclick="navigate('/home/help');">
                        <span class="dz-icon bg-skyblue light">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="18" height="18" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L6,18 C4.34314575,18 3,16.6568542 3,15 L3,6 C3,4.34314575 4.34314575,3 6,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z"
                                        fill="#fff" opacity="0.3"></path>
                                    <path
                                        d="M7.5,12 C6.67157288,12 6,11.3284271 6,10.5 C6,9.67157288 6.67157288,9 7.5,9 C8.32842712,9 9,9.67157288 9,10.5 C9,11.3284271 8.32842712,12 7.5,12 Z M12.5,12 C11.6715729,12 11,11.3284271 11,10.5 C11,9.67157288 11.6715729,9 12.5,9 C13.3284271,9 14,9.67157288 14,10.5 C14,11.3284271 13.3284271,12 12.5,12 Z M17.5,12 C16.6715729,12 16,11.3284271 16,10.5 C16,9.67157288 16.6715729,9 17.5,9 C18.3284271,9 19,9.67157288 19,10.5 C19,11.3284271 18.3284271,12 17.5,12 Z"
                                        fill="#fff" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span>Help &amp; Support</span>

                    </a></li>
                <li>
                    <a class="nav-link" href="/home/logout">
                        <span class="dz-icon bg-red light">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="18" height="18" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z"
                                        fill="#fff" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) ">
                                    </path>
                                    <rect fill="#ff4db8" opacity="0.3"
                                        transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) "
                                        x="13" y="6" width="2" height="12" rx="1"></rect>
                                    <path
                                        d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z"
                                        fill="#fff" fill-rule="nonzero"
                                        transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) ">
                                    </path>
                                </g>
                            </svg>
                        </span>
                        <span>Logout</span>
                    </a>
                </li>

                <li class="nav-label">Settings</li>

                <li>
                    <div class="mode">
                        <span class="dz-icon bg-green light">
                            <i class="fa-solid fa-moon"></i>
                        </span>
                        <span>Dark Mode</span>
                        <div class="custom-switch">
                            <input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
                            <label class="custom-switch-label" for="toggle-dark-menu"></label>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="sidebar-bottom">
                <h6 class="name">Xsus App</h6>
                <p>App Version 1.0</p>
            </div>
        </div>
        <!-- Sidebar End -->



        <!--   <div id="preloader">-->
        <!--	<div class="spinner"></div>-->
        <!--</div>-->
        <meta name="theme-color" content="#fff">

        <style>
            body {
                background: #058C43;

            }

            .bg-primary {
                background-color: #007435 !important;
            }

            .text-primary {
                color: #024621 !important;
                font-weight: bold;
            }

            .header {
                background: #ffffff00 !important;
                min-height: 0px;
                border-bottom: 0px solid #dddddd;
                border-bottom-left-radius: 0%;
                border-bottom-right-radius: 0%;
            }

            .header .header-content {
                display: flex;
                height: 100%;
                min-height: 10px;
                align-items: center;
            }

            .swiper-container {
                width: 100%;
                max-width: 800px;
                margin: auto;
                position: relative;
            }

            .swiper-slide {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-slide img {
                width: 100%;
                height: auto;
                border-radius: 10px;
            }

            .swiper-pagination {
                position: absolute;
                bottom: 15px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                justify-content: center;
            }

            .swiper-pagination-bullet {
                width: 10px;
                height: 10px;
                background: white;
                opacity: 0.6;
                border-radius: 50%;
                margin: 0 5px;
                transition: 0.3s;
            }

            .swiper-pagination-bullet-active {
                background: #4CAF50;
                opacity: 1;
                transform: scale(1.2);
            }

            .header .header-content .mid-content {
                flex: 1;
                text-align: left !important;
            }

            .main-bar {
                transition: all 0.3s cubic-bezier(0.39, 0.575, 0.565, 1) 0s;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1001;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgb(0 0 0 / 38%);
                display: flex;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(4px);
            }

            .modal-content {
                border-radius: 15px;
                width: 100%;
                max-width: 318px;
                text-align: center;
                padding: 21px;
                position: relative;
                border: 1px solid #a7ffb8;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.0);
                backdrop-filter: blur(29px);
                background: #06B556;
                transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
                animation: zoomIn 0.3s ease-in-out;
            }

            li {
                list-style: ;
                color: #fff;
                font-weight: 600;
            }

            @keyframes zoomIn {
                from {
                    transform: scale(0.8);
                    opacity: 0;
                }

                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @keyframes zoomOut {
                from {
                    transform: scale(1);
                    opacity: 1;
                }

                to {
                    transform: scale(0.8);
                    opacity: 0;
                }
            }

            .close-btn {
                position: absolute;
                right: 139px;
                bottom: -26px;
                background: white;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                font-size: 18px;
            }

            .modal-header {
                font-size: 22px;
                font-weight: 900;
                color: #ffffff;
                margin-bottom: 15px;
                padding: 7px ! important;
            }

            .modal-header {
                font-size: 22px;
                font-weight: 900;
                color: #ffffff;
                margin-bottom: 15px;
                padding: 10px ! important;
                background: #f10000;
                margin-top: -22px;
                margin-left: -22px;
                margin-right: -22px;
                border-radius: 12px 12px 0px 0px;
                padding-left: 55px ! important;
                display: none;
            }

            .modal-list {
                text-align: left;
                font-size: 16px;
                line-height: 2;
                color: #ffffff;
                font-weight: bold;
                margin-top: 18px;
                margin-bottom: 12px;
            }

            .modal-list i {
                margin-right: 10px;
            }

            .telegram-btn {
                display: inline-block;
                background: #f10000;
                color: white;
                text-decoration: none;
                padding: 12px 20px;
                border-radius: 30px;
                font-size: 15px;
                font-weight: bold;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                margin-top: 10px;
                width: 90%;
                max-width: 300px;
                margin-left: auto;
                margin-right: auto;
                box-shadow: rgba(255, 255, 255, 0.1) -3px -3px 9px inset, rgb(255 255 255 / 7%) 0 3px 9px inset,
                    rgba(255, 255, 255, 0.6) 0 1px 1px inset, rgb(0 0 0 / 5%) 0 -8px 36px inset, rgba(255, 255,
                        255, 0.6) 0 1px 5px inset, rgb(0 0 0 / 10%) 2px 19px 31px;
            }

            .d-flex {
                display: flex !important;
                justify-content: space-between;
            }

            .top {
                background: url() no-repeat center;
                height: 144px;
                width: 100%;
                background-size: cover;
            }

            .indexbox {
                text-align: center;
                background: #1b1c32;
                padding: 4px;
            }

            .indexbox>uni-view {
                border-bottom: 1px solid #353861;
            }

            .indexbox>uni-view:nth-child(-n+3) {
                border-right: 1px solid #353861;
            }

            .boxbtn {
                width: 80%;
                height: 33px;
                line-height: 33px;
                color: #fff;
                background: #161730;
                border: 1px solid #a9abfc;
            }

            .bigbox {
                border-radius: 4px;
                overflow: hidden;
                background: #1b1c32;
            }

            .setting {
                background: url({{ asset('assets/app/img/settingbg-1-11zon.png') }}) top/100% 100%;
            }

            .tabtitle div {
                width: 45%;
                text-align: center;
                background: rgba(255, 255, 255, 0.5);
                color: #fff;
                font-weight: 600;
                padding: 2px 0;
                border-radius: 0 0 4px 4px;
            }

            .balancebox {
                border-radius: 4px;
                background: #fff;
                padding: 40px;
                padding-top: 3px;
                padding-bottom: 3px;
                margin-top: 7px;
                margin-bottom: 7px;
                padding-left: 11px;
            }

            .balancebox .txt {
                font-weight: 400;
                font-size: 12px;
                color: #666;
            }

            .balancebox .price {
                font-weight: 600;
                font-size: 16px;
                margin-top: -5px;
                color: black;
            }

            .tabright img {
                margin-bottom: 2px;
                width: 40.3px;
                height: 40.3px;
            }

            .tabright {
                display: flex;
                flex-direction: column;
                justify-content: center;
                font-weight: 400;
                font-size: 10px;
                color: #fff;
                text-align: center;
            }

            .signbtn {
                padding: 7px 19px;
                color: #fff;
                font-size: 16px;
                background: linear-gradient(180deg, #ffa900, #ff5b00);
                border-radius: 24px;
            }

            .taskbox {
                display: flex;
                justify-content: space-between;
                text-align: center;
            }

            .inviteboxlist {
                color: #000;
                background: #fff;
                border-radius: 9px !important;
                padding: 10px;
            }

            .inviteboxlist div {
                border-bottom: 1px solid rgba(0, 0, 0, 0.31);
            }

            .inviteboxlist img {
                width: 76px;
                height: 76px;
                border-radius: 4px;
            }

            .text-glod {
                color: #ff7600;
            }

            .flex,
            [flex=""] {
                display: flex;
                justify-content: space-evenly;
            }

            .container {
                max-width: 1024px;
                margin-left: auto;
                margin-right: auto;
                padding-left: 15px;
                padding-right: 15px;
                box-sizing: border-box;
                padding-top: 0px;
                padding-bottom: 0px;
            }

            .container {
                padding-top: 0px;
            }

            h5.mb-0 {
                color: white;
                margin-top: 22px;
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

            .popups {
                width: 60px;
                height: 60px;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                position: fixed;
                bottom: 105px;
                right: 12px;
                z-index: 1000;
                border-radius: 50%;
                cursor: pointer;
                font-size: 14px;
                font-weight: bold;
                background: #ff1d1d;
                border: 2px white solid;
            }

            .popupss {
                width: 60px;
                height: 60px;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                position: fixed;
                bottom: 170px;
                right: 12px;
                z-index: 1000;
                border-radius: 50%;
                cursor: pointer;
                font-size: 14px;
                font-weight: bold;
                background: #ff1d1d;
                border: 2px white solid;
            }

            /*----------------------------------------------------------------------------------------------------------------------------------------------------*/

            .yhwop.active {
                margin-left: -15px;
                margin-right: -15px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 14px;
                border: 2px solid #5BCD71;
                display: block;
                margin-bottom: 15px;
                padding: 10px;
            }

            .nav-container {
                display: flex;
                align-items: center;
                border-radius: 10px;
                position: relative;
                z-index: 999;
                justify-content: space-evenly;
                margin-top: -30px;
                margin-bottom: 12px;
            }

            .nav-item {
                color: #ffffff;
                text-decoration: none;
                text-align: center;
                margin: 0 10px;
                margin-top: 35px;
                font-weight: bold;
            }

            .nav-item i {
                display: block;
                color: #000;
                font-size: 28px;
                margin-bottom: 5px;
            }

            .nav-item span {
                display: block;
                font-size: 11px;
                font-weight: 500;
                margin-top: 0px;
                margin-bottom: 3px;
                pointer-events: none;
            }

            .nav-item:hover {
                color: #6a6a6a;
                text-decoration: none;
            }

            /*----------------------------------------------------------------------------------------------------------------------------------------------------*/

            .index_header {
                position: relative;
                padding: 15px;
                padding-bottom: 0px;
            }

            .index_banner {
                height: auto;
                border-radius: 25px;
                margin-top: 20px;
            }

            .flex_left {
                display: flex;
                justify-content: left;
            }

            .user_avatar {
                height: 62px;
                width: 62px;
                margin-right: 10px;
                border-radius: 16%;
                border: 2px solid #9BD1B4;
                background: white;
            }

            .index_banner .label {
                font-family: Arial, Arial;
                font-weight: bold;
                font-size: 15px;
                color: #ffffff;
                line-height: 17px;
                margin-bottom: 6px;
                text-align: justify;
            }

            .index_banner .title {
                font-family: Arial, Arial;
                font-weight: 700;
                font-size: 18px;
                color: #FFFFFF;
                line-height: 21px;
            }

            .flex_space {
                display: flex;
                justify-content: space-between;
            }

            .index_header .index_menu .menu_title {
                margin-top: 6px;
                font-family: Arial, Arial;
                font-weight: 400;
                font-size: 13px;
                color: #C3F9DC;
                line-height: 16px;
                text-align: center;
                font-style: normal;
                text-transform: none;
            }

            .index_header .index_menu .menu img {
                height: 48px;
                width: 48px;
            }

            .index_menu .menu {
                width: 25%;
                display: block;
                text-align: center;
            }

            .index_header .index_menu {
                margin-top: 15px;
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                height: auto;
                margin-left: -12px;
                margin-right: -12px;
            }

            .product_nav {
                margin: 0 15px;
                margin-top: 20px;
            }

            .product_nav .product_nav_type_active {
                margin-top: 0px;
                background: #06B556;
                border-radius: 12px 12px 0px 0px;
                text-align: center;
                font-size: 16px;
                font-weight: 700;
                color: #FFFFFF;
                height: 50px;
            }

            .product_nav .product_nav_type_active .product_nav_title {
                height: 40px;
                line-height: 40px;
                text-align: center;
                font-size: 16px;
                font-weight: 700;
                color: #FFFFFF;
            }

            .product_nav .product_nav_type_active .product_nav_order {
                margin: auto;
                text-align: center;
                width: 40px;
                height: 4px;
                background: #0DE46F;
                border-radius: 100px 100px 100px 100px;
                display: block;
            }

            .layui-row:after,
            .layui-row:before {
                content: "";
                display: block;
                clear: both;
            }

            /*-----------------------------------------------------------------------------------------------------*/

            .vip-card-box {
                display: flex;
                background: linear-gradient(180deg, #EBF6EC 0%, #FFFFFF 100%);
                border-radius: 15px;
                padding: 15px;
                margin-bottom: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
                align-items: center;
                position: relative;
            }

            .vip-left {

                flex: 0 0 35%;
                margin-right: 10px;
            }

            .vip-left img {
                width: 100%;
                border-radius: 10px;
            }

            .vip-badge {
                position: absolute;
                top: 0;
                left: 0;
                background: #ffc107;
                color: #000;
                font-weight: bold;
                padding: 6px 15px;
                border-radius: 10px 0 10px 0;
                font-size: 12px;
            }

            .vip-right {
                flex: 1;
            }

            .vip-right h4 {
                font-size: 16px;
                margin-bottom: 10px;
                color: #002f2f;
            }

            .vip-right p {
                margin: 4px 0;
                font-size: 14px;
                color: #333;
            }

            .vip-right p span {
                float: right;
                font-weight: bold;
            }

            .vip-invest-btn {
                margin-top: 10px;
                width: 100%;
                padding: 10px;
                background: #00c853;
                color: #fff;
                border: none;
                border-radius: 20px;
                font-weight: bold;
                font-size: 14px;
                cursor: pointer;
            }

            .vip-invest-btn:hover {
                background: #009624;
            }

            .telegram_content {
                display: block;
                position: relative;
                border-radius: 15px;
                padding: 15px;
                /* height: 180px; */
                background: #06B556;
                border: 1px solid #5BCD71;
            }

            .telegram_title {
                font-weight: 700;
                color: #FFFFFF;
                font-size: 22px;
                line-height: 25px;
                text-align: left;
                font-style: normal;
                text-transform: none;
                margin-bottom: 12px
            }

            .telegram_text {
                font-weight: 400;
                font-size: 15px;
                color: #FFFFFF;
                line-height: 25px;
                text-align: left;
                font-style: normal;
                text-transform: none;
                margin-bottom: 12px
            }

            .telegram_btn_content {
                height: 60px;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 8px;
                padding: 12px 9px;
                margin-bottom: 10px;
            }

            .telegram_btn_title {
                font-weight: 700;
                font-size: 16px;
                color: #07262C;
                line-height: 18px;
                text-align: left;

            }

            .telegram_btn_text {
                font-weight: 400;
                font-size: 14px;
                color: #636872;
                line-height: 18px;
                text-align: left;
            }

            .telegram_follow_text {
                font-weight: 400;
                font-size: 14px;
                color: #999999;
                line-height: 32px;
                text-align: left;
            }

            .telegram_btn_content img {
                height: 56px;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 8px 8px 8px 8px;
            }

            .modal-list {
                text-align: left;
                font-size: 16px;
                line-height: 2;
                color: #ffffff;
                font-weight: bold;
                margin-top: 18px;
                margin-bottom: 12px;
            }
        </style>

        <div id="newsModal" class="modal">
            <div class="modal-content">
                <div class="close-btn" onclick="closeModal()">✖</div>

                <div class="modal-header">Important Notice</div>

                <ul class="modal-list">

                    Follow our official channel to receive the latest updates, news, and announcements in real-time, and be
                    the first to know about new benefit products!

                </ul>

                <a href="{{ $general->telegram_group }}" class="telegram_btn_content flex_space">
                    <div class="flex_left" bis_skin_checked="1">
                        <img src="{{ asset('assets/app/img/telegram-icon.png') }}"
                            style="height: 32px;width: 32px;margin-right: 10px;">
                        <div bis_skin_checked="1">
                            <div class="telegram_btn_title" bis_skin_checked="1">Telegram</div>
                            <div class="telegram_btn_text" bis_skin_checked="1">Future Fund Service</div>
                        </div>
                    </div>
                    <div class="telegram_follow_text" bis_skin_checked="1">
                        Follow <i class="layui-icon layui-icon-right" style=""></i>
                    </div>
                </a>
            </div>
        </div>


        <div class="page-content">
            <div class="content-inner pt-0">
                <div class="container fb">

                    <div class="index_header" bis_skin_checked="1">
                        <div class="index_banner" bis_skin_checked="1">
                            <div class="flex_left" bis_skin_checked="1">
                                <img src="{{ asset('assets/app/img/logo.png') }}" class="user_avatar" style="">
                                <div bis_skin_checked="1">
                                    <div class="label user_nickname" bis_skin_checked="1">{{ $user->ref_code }}</div>
                                    <div class="title user_username" style="margin-top: 10px" bis_skin_checked="1">
                                        {{ Split_Hide_Name($user->mobile) }}</div>
                                </div>

                            </div>
                            <!--<img src="/public/v1/img/index/logo.png" style="height:50px;width:auto;">-->
                            <!--<div class="lang">English</div>-->
                        </div>
                        <div class="index_banner flex_space" bis_skin_checked="1">
                            <div bis_skin_checked="1">
                                <div class="label" bis_skin_checked="1">Your Balance</div>
                                <div class="title user_balance" style="margin-top: 10px" bis_skin_checked="1">
                                    {{ $general->cur_sym }}{{ number_format($user->balance + $user->bonus_balance) }}</div>
                            </div>
                            <div class="flex_space" bis_skin_checked="1">
                                <div style="margin-right:20px;" bis_skin_checked="1">
                                    <div class="label" bis_skin_checked="1">Total Income</div>
                                    <div class="title product_income" style="margin-top: 10px" bis_skin_checked="1">
                                        {{ $general->cur_sym }}{{ number_format($user->total_earnings) }}</div>
                                </div>
                                <a href="{{ $general->cs }}">
                                    <img src="{{ asset('assets/app/img/service-2.png') }}"
                                        style="height: 30px;width: 30px;margin-right: 10px;">
                                </a>
                                <!--<div id="vip" bis_skin_checked="1">-->
                                <!--    <img src="/public/v1/img/vip/lv1.png" style="height: 30px;width: 30px">-->
                                <!--</div>-->
                            </div>


                        </div>
                        <div class="flex_space index_menu" bis_skin_checked="1">
                            <a class="menu" href="{{ route('user.deposit') }}">
                                <img src="{{ asset('assets/app/img/recharge-3.png') }}">
                                <p class="menu_title">Recharge</p>
                            </a>
                            <a class="menu" href="{{ route('user.withdraw') }}">
                                <img src="{{ asset('assets/app/img/withdraw-4.png') }}">
                                <p class="menu_title">Withdraw</p>
                            </a>
                            <a class="menu" href="{{ route('user.referrals') }}">
                                <img src="{{ asset('assets/app/img/team-4.png') }}">
                                <p class="menu_title">Team</p>
                            </a>
                            <a class="menu" href="{{ route('user.investment.log') }}">
                                <img src="{{ asset('assets/app/img/blog.png') }}">
                                <p class="menu_title">Orders</p>
                            </a>
                            <a class="menu" href="{{ $general->telegram_group }}" target="_blank">
                                <img src="{{ asset('assets/app/img/telegram-4.png') }}">
                                <p class="menu_title">Telegram</p>
                            </a>
                        </div>
                    </div>



                    <!--<h3>Special Plan</h3>-->

                    <div class="page-content">

                        <style>
                            .tab-container {
                                display: flex;
                                background: #059347;
                                padding-top: 10px;
                                border-radius: 12px 12px 0 0;
                                overflow: hidden;
                                position: relative;
                                justify-content: space-between;
                            }

                            .tab {
                                flex: 1;
                                text-align: center;
                                padding: 10px 0;
                                font-weight: bold;
                                font-size: 16px;
                                position: relative;
                                background: rgba(255, 255, 255, 0.95);
                                color: #666;
                                border-radius: 12px 12px 0 0;
                                margin: 0 6px;
                                transition: background 0.3s, color 0.3s;
                                cursor: pointer;
                            }

                            .tab.active {
                                background: #06B556;
                                color: #fff;
                            }

                            .indicator {
                                width: 40px;
                                height: 4px;
                                background: #0DE46F;
                                border-radius: 100px;
                                margin: 6px auto 0;
                                display: none;
                            }

                            .tab.active .indicator {
                                display: block;
                            }

                            .badge {
                                position: absolute;
                                top: -5px;
                                right: 10px;
                                background: #FF5722;
                                color: #fff;
                                font-size: 12px;
                                padding: 2px 6px;
                                border-radius: 4px;
                                font-weight: bold;
                            }

                            .tab-content {
                                display: none;
                                padding: 10px;
                                background: #06b556;
                                border-radius: 0 0 12px 12px;
                                margin-bottom: 50px;
                            }

                            .tab-content.active {
                                display: block;
                            }

                            .page-content {
                                margin-left: -4px;
                                margin-right: -4px;
                            }
                        </style>

                        <div class="tab-container">
                            <div class="tab active" data-tab="fixed">Normal<div class="indicator"></div>
                            </div>
                            <div class="tab" data-tab="welfare">Welfare<div class="indicator"></div>
                            </div>
                            <div class="tab" data-tab="activity">Offers<div class="indicator"></div>
                                <div class="badge">HOT</div>
                            </div>
                        </div>

                        <div class="content-inner pt-0">

                            <div class="container fb" style="padding-left: 6px;padding-right: 6px;">

                                <div class="tab-content active" id="fixed">

                                    @foreach ($plans->where('type', '0') as $plan)
                                        <div class="vip-card-box">
                                            <div class="vip-left">
                                                {{-- <div class="vip-badge">VIP1</div> --}}
                                                <img src="{{ asset('assets/app/img/logo.png') }}" alt="VIP Product">
                                            </div>
                                            <div class="vip-right">
                                                <h4>{{ $plan->name }}</h4>
                                                <p>Each Price <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->min_amount, 2) }}</span></p>
                                                <p>Revenue <span>{{ $plan->total_return }} Days</span></p>
                                                <p>Daily Earnings <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->interest_amount, 2) }}</span></p>
                                                <p>Total Gain <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->total_return * $plan->interest_amount, 2) }}</span>
                                                </p>
                                                <button class="vip-invest-btn"
                                                    onclick="openModal({&quot;id&quot;:&quot;{{ $plan->id }}&quot;,&quot;sub_01&quot;:&quot;0&quot;,&quot;sub_02&quot;:&quot;0&quot;,&quot;image&quot;:&quot;{{ asset('assets/app/img/logo.png') }}&quot,&quot;name&quot;:&quot;{{ $plan->name }}&quot;,&quot;description&quot;:&quot;Daily Income Daily Withdrawal&quot;,&quot;price&quot;:&quot;{{ $plan->min_amount }}&quot;,&quot;daily_income&quot;:&quot;{{ $plan->interest_amount }}&quot;,&quot;days&quot;:&quot;{{ $plan->total_return }}&quot;,&quot;type&quot;:&quot;welfare&quot;,&quot;vip&quot;:&quot;0&quot;,&quot;limit&quot;:&quot;15&quot;,&quot;active&quot;:&quot;1&quot;})">Invest
                                                    Now</button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="tab-content" id="welfare">
                                    @foreach ($plans->where('type', '1') as $plan)
                                        <div class="vip-card-box">
                                            <div class="vip-left">
                                                {{-- <div class="vip-badge">VIP1</div> --}}
                                                <img src="{{ asset('assets/app/img/logo.png') }}" alt="VIP Product">
                                            </div>
                                            <div class="vip-right">
                                                <h4>{{ $plan->name }}</h4>
                                                <p>Each Price <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->min_amount, 2) }}</span></p>
                                                <p>Revenue <span>{{ $plan->total_return }} Days</span></p>
                                                <p>Daily Earnings <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->interest_amount, 2) }}</span></p>
                                                <p>Total Gain <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->total_return * $plan->interest_amount, 2) }}</span>
                                                </p>
                                                <button class="vip-invest-btn"
                                                    onclick="openModal({&quot;id&quot;:&quot;{{ $plan->id }}&quot;,&quot;sub_01&quot;:&quot;0&quot;,&quot;sub_02&quot;:&quot;0&quot;,&quot;image&quot;:&quot;{{ asset('assets/app/img/logo.png') }}&quot,&quot;name&quot;:&quot;{{ $plan->name }}&quot;,&quot;description&quot;:&quot;Daily Income Daily Withdrawal&quot;,&quot;price&quot;:&quot;{{ $plan->min_amount }}&quot;,&quot;daily_income&quot;:&quot;{{ $plan->interest_amount }}&quot;,&quot;days&quot;:&quot;{{ $plan->total_return }}&quot;,&quot;type&quot;:&quot;welfare&quot;,&quot;vip&quot;:&quot;0&quot;,&quot;limit&quot;:&quot;15&quot;,&quot;active&quot;:&quot;1&quot;})">Invest
                                                    Now</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-content" id="activity">
                                    @foreach ($plans->where('type', '2') as $plan)
                                        <div class="vip-card-box">
                                            <div class="vip-left">
                                                {{-- <div class="vip-badge">VIP1</div> --}}
                                                <img src="{{ asset('assets/app/img/logo.png') }}" alt="VIP Product">
                                            </div>
                                            <div class="vip-right">
                                                <h4>{{ $plan->name }}</h4>
                                                <p>Each Price <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->min_amount, 2) }}</span></p>
                                                <p>Revenue <span>{{ $plan->total_return }} Days</span></p>
                                                <p>Daily Earnings <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->interest_amount, 2) }}</span></p>
                                                <p>Total Gain <span>{{ $general->cur_sym }}
                                                        {{ number_format($plan->total_return * $plan->interest_amount, 2) }}</span>
                                                </p>
                                                <button class="vip-invest-btn"
                                                    onclick="openModal({&quot;id&quot;:&quot;{{ $plan->id }}&quot;,&quot;sub_01&quot;:&quot;0&quot;,&quot;sub_02&quot;:&quot;0&quot;,&quot;image&quot;:&quot;{{ asset('assets/app/img/logo.png') }}&quot,&quot;name&quot;:&quot;{{ $plan->name }}&quot;,&quot;description&quot;:&quot;Daily Income Daily Withdrawal&quot;,&quot;price&quot;:&quot;{{ $plan->min_amount }}&quot;,&quot;daily_income&quot;:&quot;{{ $plan->interest_amount }}&quot;,&quot;days&quot;:&quot;{{ $plan->total_return }}&quot;,&quot;type&quot;:&quot;welfare&quot;,&quot;vip&quot;:&quot;0&quot;,&quot;limit&quot;:&quot;15&quot;,&quot;active&quot;:&quot;1&quot;})">Invest
                                                    Now</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <form action="{{ route('user.investment') }}" method="post">
                            @csrf
                            <div class="offcanvas offcanvas-bottom">
                                <div class="container">
                                    <div class="offcanvas-body small">


                                        <div class="position-absolute badge bg-primary"
                                            style="font-size: 12px; left:0; top:0; border-radius: 8px 0px 8px 0px;"
                                            id="product_price">
                                            Price : ₹ 1200
                                        </div>


                                        <div class="position-absolute badge bg-primary"
                                            style="font-size: 12px; right:0; top:0; border-radius: 0px 8px 0px 8px;"
                                            id="product_days">
                                            Days: 4
                                        </div>


                                        <img class="logo"
                                            src="{{ asset('assets/app/img/logo.png') }}"
                                            alt="">
                                        <h5 class="title" id="product_name">Happy New Year</h5>
                                        <p class="pwa-text" id="product_description">Project Details will be here
                                            jvjbjabfjhsbfvjsfjjs jsg fgs fgs fusy hsi</p>

                                        <div class="row my-3">
                                            <div class="col-6">
                                                <center>
                                                    <strong class="text-primary w-100 text-center d-block fs-2"
                                                        id="daily_income">₹ 1099</strong>
                                                    <span style="white-space: nowrap; font-size: 14px;">Daily Income</span>
                                                </center>
                                            </div>
                                            <div class="col-6">
                                                <center>
                                                    <strong class="text-primary w-100 text-center d-block fs-2"
                                                        id="total_income">₹ 4396</strong>
                                                    <span style="white-space: nowrap; font-size: 14px;">Total Income</span>
                                                </center>
                                            </div>
                                        </div>

                                        <a onclick="closePlan()"
                                            class="btn btn-sm pwa-close light btn-danger ms-2 mx-1">Maybe
                                            later</a>
                                            <input id="id" name="id" type="hidden">
                                        <button type="submit" class="btn btn-sm btn-secondary pwa-btn mx-1">Yes, Buy
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                            <div class="offcanvas-backdrop pwa-backdrop fade"></div>


                    </div>
                    </form>


                    <script>
                        const tabs = document.querySelectorAll('.tab');
                        const contents = document.querySelectorAll('.tab-content');

                        tabs.forEach(tab => {
                            tab.addEventListener('click', () => {
                                tabs.forEach(t => t.classList.remove('active'));
                                contents.forEach(c => c.classList.remove('active'));

                                tab.classList.add('active');
                                document.getElementById(tab.getAttribute('data-tab')).classList.add('active');
                            });
                        });
                    </script>


                    <!-- Menubar -->
                    @include('templates.basic.partials.footer')




                </div>




            </div>
        </div>
    </body>

    <script>
        function closePlan() {
            // Hide the offcanvas
            $(".offcanvas").removeClass("show");
            $(".offcanvas").attr("style", "display: none;");
            // Hide the backdrop
            $(".offcanvas-backdrop").removeClass("show");
        }
    </script>
@endsection
