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
                                <h5 class="mb-0"></h5>
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


            <!-- Sidebar -->
            <div class="sidebar">
                <div class="author-box mb-2">
                    <div class="dz-media">
                        <img src="/assets/profile.png" class="rounded-circle" alt="author-image">
                    </div>
                    <div class="dz-info">
                        <span>Good Morning</span>
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
                                        <rect fill="#00aeff" x="4" y="4" width="7" height="7" rx="1.5">
                                        </rect>
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
                                    width="18" height="18" viewBox="0 0 24 24" version="1.1"
                                    class="svg-main-icon">
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
                                    width="18" height="18" viewBox="0 0 24 24" version="1.1"
                                    class="svg-main-icon">
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
                                    width="18" height="18" viewBox="0 0 24 24" version="1.1"
                                    class="svg-main-icon">
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
                    background: linear-gradient(180deg, #EBF6EC 0%, #F6FDF6 100%);

                }

                .header {
                    background: #058c43;
                    min-height: 160px;
                    border-bottom: 0px solid #dddddd;
                    border-bottom-left-radius: 10%;
                    border-bottom-right-radius: 10%;
                    background-size: cover ! important;
                }

                p {
                    margin-top: 0;
                    margin-bottom: 0rem;
                }

                .header .sticky-header {
                    position: fixed;
                    box-shadow: none;
                    background: #ffffff00;
                    transition: all 0.5s;
                    width: 100%;
                }

                .user_main .user_card .item {
                    display: flex;
                    justify-content: space-between;
                }

                .user_main .user_card .item .title {
                    display: inline-block;
                    padding-left: 10px;
                    font-family: sans-serif;
                    font-weight: 400;
                    font-size: 14px;
                    color: #ffffff;
                    line-height: 18px;
                }

                .user_main .user_card .item img {
                    width: 32px;
                    height: 32px;
                }

                .user_main .user_card .item .right_icon {
                    color: #D6D6D6;
                    line-height: 32px;
                    font-weight: bold;
                }

                .logout {
                    padding: 10px;
                    background: #FFFFFF;
                    box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.01);
                    border-radius: 10px 10px 10px 10px;
                }

                .logout a {
                    font-family: Arial, Arial;
                    font-weight: 700;
                    font-size: 16px;
                    color: #FF6F47;
                    line-height: 30px;
                }

                .logout img {
                    height: 24px;
                    width: 24px;
                }

                a:hover,
                a:focus,
                a.active {
                    text-decoration: none;
                    outline: none;
                    color: #ffffff;
                }

                .logout a {
                    font-family: 'Poppins';
                    font-weight: 600;
                    font-size: 16px;
                    color: #ffffff;
                    line-height: 30px;
                }

                .content-inner {
                    padding-top: 40px;
                    padding-bottom: 0px;
                }

                .btn {
                    color: white;
                    font-size: 14px;
                    font-weight: 500;
                    padding: 11px;
                }

                .align-items-center {
                    align-items: center !important;
                    margin-top: -15px;
                }

                .fb {
                    padding-bottom: 0px;
                }

                .user_main .user_card .item .title {
                    display: inline-block;
                    padding-left: 10px;
                    font-family: sans-serif;
                    font-weight: 600;
                    font-size: 14px;
                    color: #058c43 !important;
                    line-height: 18px;
                }

                svg {
                    width: 30px;
                    height: 23px;
                    color: white;
                }

                span {
                    position: absolute;

                    top: 26%;
                    color: #fff;
                    font-size: 12px;
                }

                .layui-row {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 12px;
                }

                .container {
                    padding-top: 3px;
                }

                .mb-0 {
                    margin-bottom: 0 !important;
                    text-align: center;
                    color: red;
                    font-size: 21px;
                }

                a:hover,
                a:focus,
                .fa-solid,
                a.active,
                .fa-solid.active {
                    text-decoration: none;
                    outline: none;
                    color: #ffffff;
                }

                .user-wrap {
                    max-width: 384px;
                    height: 188px;
                    background: url() no-repeat;
                    background-size: 100% 100%;
                    border-radius: 8px;
                    margin-top: 16px;
                    padding: 10px;
                    box-sizing: border-box;
                }

                .d-b-c {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .user-finance.d-b-c {
                    width: 100%;
                    height: 109px;
                    background: #fff;
                    border-radius: 8px;
                    margin-top: 10px;
                    flex-wrap: wrap;
                    padding: 5px 10px;
                    box-sizing: border-box;
                }

                .user-info.d-b-c {
                    width: 100%;
                }

                .avatar {
                    width: 72px;
                    height: 72px;
                    border-radius: 50px;
                    background: url({{ asset('assets/app/img/logo2.png') }});
                    background-size: cover;
                    margin-top: -60px;
                }

                .flex-1.ml20 {
                    background: #ff424200;
                    padding-left: -3px;
                    border-radius: 6px;
                    padding-top: 0px;
                }

                .ml20 {
                    margin-left: 94px;
                    margin-top: -100px;
                }

                .flex-1 {
                    flex: 1;
                }

                .grade {
                    width: 82px;
                    height: 21px;
                    margin-left: 10px;
                }

                .mt10 {
                    margin-top: -2px;
                    font-weight: bold;
                    color: #353535;
                }

                .copy {
                    width: 17px;
                    height: 17px;
                    margin-left: 10px;
                }

                .finance-item {
                    width: 45%;
                }

                .f26 {
                    font-size: 14px;
                }

                .gray6 {
                    color: #666;
                }

                .price {
                    color: #87b922;
                    font-weight: bold;
                }

                .d-s-c {
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                }
                }

                .d-b-c {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .menu-item {
                    width: 180px;
                    height: 65px;
                    background: url({{ asset('assets/app/img/download-46.png') }}) no-repeat;
                    background-size: 100%;
                    padding: 10px;
                    box-sizing: border-box;
                    font-size: 16px;
                }

                .menu-items {
                    width: 180px;
                    height: 65px;
                    background: url({{ asset('assets/app/img/download-47.png') }}) no-repeat;
                    background-size: 100%;
                    padding: 10px;
                    box-sizing: border-box;
                    font-size: 16px;
                }

                .menu.d-b-c {
                    max-width: 382px;
                    height: 65px;
                    margin-top: 16px;
                    column-gap: 5px;
                }

                .user_main .user_list {
                    margin: 0;
                    margin-bottom: 15px;
                    background: ;
                    box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.01);
                    border-radius: 7px;
                    border: none;
                }

                .user_main .user_card {
                    margin: 0 15px;
                    padding: 7px 0;
                    border-bottom: .02rem solid hsl(0deg 81.4% 57.84%);
                }

                .user_main {
                    padding: 10px;
                    position: unset;
                    border-radius: 23px;
                    margin: -18px;
                    margin-top: 15px;
                }

                .logout {
                    border-radius: 8px !important;
                    padding: 15px;
                    background: #058c43 !important;
                    box-shadow: 0px 4px 10px #14c56500;
                }

                .user_main .user_card .item .title {
                    display: inline-block;
                    padding-left: 10px;
                    font-family: sans-serif;
                    font-weight: 600;
                    font-size: 14px;
                    color: #ff1717;
                    line-height: 18px;
                }

                .nav-container {
                    display: flex;
                    align-items: center;
                    border-radius: 10px;
                    position: relative;
                    z-index: 999;
                    justify-content: space-evenly;
                    margin-top: -56px;
                    margin-bottom: 12px;
                }

                .nav-item {
                    color: #00000087;
                    text-decoration: none;
                    text-align: center;
                    margin: 0 12px;
                    margin-top: 5px;
                }

                .nav-item i {
                    display: block;
                    color: #000;
                    font-size: 24px;
                    margin-bottom: 5px;
                }

                .nav-item span {
                    display: block;
                    font-size: 11px;
                    font-weight: 500;
                    margin-top: 50px;
                    margin-bottom: 3px;
                    pointer-events: none;
                    margin-left: 8px;
                }

                .nav-item:hover {
                    color: #6a6a6a;
                    text-decoration: none;
                }

                p.value {
                    font-family: monospace;
                    font-weight: 700;
                    font-size: 19px;
                    color: #ffffff;
                    line-height: 20px;
                    text-align: center;
                }

                p.label {
                    font-family: monospace;
                    font-weight: 700;
                    font-size: 13px;
                    color: #d2d2d2;
                    line-height: 20px;
                    text-align: center;
                }

                .layui-row {
                    display: flex;
                    justify-content: space-between;
                    margin-top: -110px;
                    padding: 21px;
                    background-color: #058c43;
                    border-radius: 12px;
                }

                .page-content {
                    margin-top: -35px;
                }

                .user_balance_card {
                    height: 87px;
                    background: #FFFFFF;
                    border-radius: 12px 12px 12px 12px;
                    margin: 15px -12px;
                    padding: 15px;
                }

                .flex_space {
                    display: flex;
                    justify-content: space-between;
                }

                .user_balance_card_right {
                    width: 145px;
                    height: 52px;
                    background: #058c43;
                    border-radius: 12px 12px 12px 12px;
                    font-weight: 700;
                    font-size: 15px;
                    color: #FFFFFF;
                    line-height: 51px;
                    text-align: center;
                }

                .user_balance_card .balance_title {
                    font-family: Arial, Arial;
                    font-weight: 400;
                    font-size: 13px;
                    color: #07262C;
                    line-height: 15px;
                    text-align: left;
                }

                .user_balance_card .balance_value {
                    font-family: 'Poppins';
                    font-weight: bolder;
                    font-size: 23px;
                    color: #058c43;
                    line-height: 15px;
                    text-align: left;
                    margin-top: 10px;
                }

                .user_main .user_card {
                    margin: 0 15px;
                    padding: 7px 0;
                    border-bottom: 0.02rem solid hsl(147.56deg 93.1% 28.43%) !important;
                }
            </style>


            <div class="page-content">

                <div class="content-inner pt-0">
                    <div class="container fb">



                        <div class="user-wrap">

                            <div class="flex-1 ml20">
                                <div class="d-s-c f26 mt10">
                                    <div style="font-weight: bold;color: white;">{{ $user->ref_code }}</div>

                                </div>
                                <div class="d-s-c">
                                    <div style="font-weight: bold;color: white;">{{ Split_Hide_Name($user->mobile) }}</div>

                                </div>

                            </div>
                            <div class="user-info d-b-c">


                                <div class="avatar">
                                    <div
                                        style="background-image: url(''); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                </div>

                            </div>

                            <div class="user_balance_card" bis_skin_checked="1">
                                <a href="{{ route('user.deposit') }}" class="flex_space">
                                    <div class="user_balance_card_left" bis_skin_checked="1">
                                        <p class="balance_title">Account Balance</p>
                                        <p class="balance_value recharge_balance">{{ $general->cur_sym }}{{ number_format($user->balance + $user->bonus_balance) }}</p>
                                    </div>
                                    <div class="user_balance_card_right" bis_skin_checked="1">Recharge <i
                                            class="fas fa-charging-station"></i><i
                                            class="layui-icon layui-icon-right"></i></div>
                                </a>
                            </div>
                            


                        </div>

                        <div class="layui-row">
                            <div class="layui-col-xs3">
                                <div style="text-align: left">
                                    <p class="value">{{ $general->cur_sym }}{{ number_format($user->balance + $user->bonus_balance) }}</p>
                                    <p class="label">Balance</p>
                                </div>
                            </div>
                            <div class="layui-col-xs3">
                                <div style="text-align: left">
                                    <p class="value">{{ $general->cur_sym }}{{ number_format($user->balance) }}</p>
                                    <p class="label">Recharge</p>
                                </div>
                            </div>
                            <div class="layui-col-xs3">
                                <div style="text-align: left">
                                    <p class="value">{{ $general->cur_sym }}{{ number_format($user->bonus_balance) }}</p>
                                    <p class="label">Withdraw</p>
                                </div>
                            </div>

                        </div>



                        <div class="user_main" style="background: #ffffffe8">


                            <div class="user_list">
                                <div class="user_card">
                                    <div class="item">
                                        <a href="{{ route('user.company') }}" style="width: 100%">
                                            <img src="{{ asset('assets/app/img/vip.png') }}" style="display: inline">
                                            <p class="title">About Company</p>
                                        </a>
                                        <p class="right_icon"><i class="fa-solid fa-chevron-right"
                                                style="color: rgb(171, 171, 179);"></i></p>
                                    </div>
                                </div>
                                <div class="user_card">
                                    <div class="item">
                                        <a href="{{ route('user.trx.log') }}" style="width: 100%">
                                            <img src="{{ asset('assets/app/img/withdraw-record.png') }}"
                                                style="display: inline">
                                            <p class="title">Income Record</p>
                                        </a>
                                        <p class="right_icon"><i class="fa-solid fa-chevron-right"
                                                style="color: rgb(171, 171, 179);"></i></p>
                                    </div>
                                </div>

                                <div class="user_card">
                                    <div class="item">
                                        <a href="{{ route('user.deposit.history') }}" style="width: 100%">
                                            <img src="{{ asset('assets/app/img/sign-in.png') }}" style="display: inline">
                                            <p class="title">Recharge Record</p>
                                        </a>
                                        <p class="right_icon"><i class="fa-solid fa-chevron-right"
                                                style="color: rgb(171, 171, 179);"></i></p>
                                    </div>
                                </div>

                                <div class="user_card">
                                    <div class="item">
                                        <a href="{{ route('user.withdraw.history') }}" style="width: 100%">
                                            <img src="{{ asset('assets/app/img/sign-in.png') }}" style="display: inline">
                                            <p class="title">Withdraw Record</p>
                                        </a>
                                        <p class="right_icon"><i class="fa-solid fa-chevron-right"
                                                style="color: rgb(171, 171, 179);"></i></p>
                                    </div>
                                </div>

                                <div class="user_card">
                                    <div class="item">
                                        <a href="{{ route('user.change.password') }}" style="width: 100%">
                                            <img src="{{ asset('assets/app/img/rewards.png') }}" style="display: inline">
                                            <p class="title">Security Manager</p>
                                        </a>
                                        <p class="right_icon"><i class="fa-solid fa-chevron-right"
                                                style="color: rgb(171, 171, 179);"></i></p>
                                    </div>
                                </div>
                                <div class="user_card">
                                    <div class="item">
                                        <a href="#" style="width: 100%">
                                            <img src="{{ asset('assets/app/img/rewards.png') }}" style="display: inline">
                                            <p class="title">App Download</p>
                                        </a>
                                        <p class="right_icon"><i class="fa-solid fa-chevron-right"
                                                style="color: rgb(171, 171, 179);"></i></p>
                                    </div>
                                </div>

                            </div>

                            <div class="logout"
                                style="border-radius: 5px;text-align: center;margin-bottom: 80px;width: 95%;margin-left: 9px;">
                                <a href="{{ route('user.logout') }}"
                                    style="display: block; text-decoration: none; line-height: 20px; font-size: 18px;">

                                    LOGOUT
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Menubar -->
            @include('templates.basic.partials.footer')
            <!-- Menubar -->




            <style>
                .menubar-area {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    background: #ffffff;
                    padding: 12px 0 10px 0;
                    z-index: 999;
                    border-radius: 0;
                    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.15);
                }

                .toolbar-inner {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    position: relative;
                    padding: 0 25px;
                }

                .nav-link {
                    flex: 1;
                    text-align: center;
                    position: relative;
                }

                .nav-link img {
                    width: 30px;
                    height: 30px;
                }

                .nav-link label {
                    display: block;
                    font-size: 11px;
                    font-weight: 600;
                    margin-top: 1px;
                    color: #888888;
                }

                .nav-link.active label {
                    color: #058c43;
                }

                .nav-link.active:after {
                    content: "";
                    position: absolute;
                    bottom: -11px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 24px;
                    height: 5px;
                    background: #340166;
                    border-radius: 3px;
                }

                .center-button {
                    position: sticky;
                    top: -32px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: #ffffff;
                    border-radius: 50%;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    padding: 8px;
                    z-index: 10;
                    margin-top: -55px;
                }

                .menubar-area .toolbar-inner {
                    padding-left: 7px;
                    padding-right: 7px;
                    display: flex;
                    max-width: 1000px;
                    margin-right: auto;
                    margin-left: auto;
                    align-items: center;
                }

                .center-button img {
                    width: 55px;
                    height: 55px;
                }

                a {
                    text-decoration: none;
                }

                a:hover,
                a:focus,
                a.active {
                    text-decoration: none;
                    outline: none;
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


        
    </body>
@endsection
