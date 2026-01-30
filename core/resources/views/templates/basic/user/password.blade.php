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
                                <h5 class="mb-0">Security Center</h5>
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
                    background: #058C43 !important;
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

                .header .header-content .mid-content {
                    flex: 1;
                    text-align: center;
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

                .common_card {
                    background: rgb(255 255 255);
                    border-radius: 8px 8px 8px 8px;
                    padding: 17px;
                    margin-bottom: 20px;
                    margin-top: -73px;
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

                a:hover,
                a:focus,
                .fa-solid,
                a.active,
                .fa-solid.active {
                    text-decoration: none;
                    outline: none;
                    color: #ffffff !important;
                }


                .form-control {
                    height: 55px;
                    border: 1px solid #058c43;
                    padding: 15px 25px;
                    font-size: 18px;
                    font-weight: 700;
                    color: #000 !important;
                    background: #058c4314;
                }

                .form-control::placeholder {
                    font-weight: 400;
                    font-size: 11px;
                }

                .form-control:focus,
                .form-control:active,
                .form-control.active {
                    border-color: #dddddd5e;
                    background: #fff;
                }

                .container {
                    max-width: 1024px;
                    margin-left: auto;
                    margin-right: auto;
                    padding-left: 20px;
                    padding-right: 20px;
                }

                .form-container h4 {
                    text-align: left;
                    font-weight: bold;
                    color: var(--primary);
                    margin-bottom: 20px;
                }

                .form-label {
                    font-weight: bold;
                    color: #058C43;
                    font-size: 16px;
                }

                .btn-submit {
                    background: #058C43;
                    color: #fff;
                    border: none;
                    border-radius: 10px;
                    padding: 15px;
                    width: 100%;
                    transition: background 0.3s;
                    font-weight: 700;
                    height: 55px;
                    margin-top: 12px;
                }

                .btn-submit:hover {
                    background: #2c3e50;
                }

                hr:not([size]) {
                    height: 0px;
                }

                hr {
                    margin: 0rem 0;
                    color: inherit;
                    background-color: currentColor;
                    border: 0;
                    opacity: 0.25;
                }

                .common_card {
                    background: rgba(255, 255, 255, 1);
                    border-radius: 15px;
                    padding: 15px;
                    margin: 16px;
                    margin-top: -117px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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


                i.fa-solid.fa-headset.fa-2x {
                    font-size: 25px;
                }

                .popup-icon:hover {
                    background-color: #0056b3;
                }

                .menubar-area {
                    display: none;
                }

                .content-inner {
                    background: #ffffff;
                    margin-left: 15px;
                    margin-right: 15px;
                    border-radius: 20px;
                    border: 2px #ffffff82 solid;
                }

                .page-content {
                    margin-top: -35px;
                    margin-bottom: 190px;
                }

                .fb {
                    padding-bottom: 90px;
                }
            </style>

            <div class="page-content">
                <div class="content-inner pt-0">

                    <div class="container fb mb-4">

                        <div class="form-container">
                            <!--<h4>Change Password</h4>-->


                            <form id="changePasswordForm" action="" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="old_pass" class="form-label">Old Password</label>
                                    <input type="text" class="form-control rounded" ame="current_password"
                                        placeholder="Enter old password" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control rounded" name="password"
                                        placeholder="Enter new password" required="">
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control rounded" name="password_confirmation"
                                        placeholder="Confirm new password" required="">
                                </div>

                                <!-- Submit Button -->

                                <button type="submit" class="btn-submit"
                                    style="margin-top:42px;background: #058C43;padding: 16px !important;font-size: 131% !important;width: 100%;margin-left: 0px;border-color: #ffffff40;font-weight: 700;border-radius: 15px ! important;box-shadow: rgba(255, 255, 255, 0.1) -3px -3px 9px inset, rgba(255, 255, 255, 0.15) 0 3px 9px inset, rgba(255, 255, 255, 0.6) 0 1px 1px inset, rgba(0, 0, 0, 0.12) 0 -8px 36px inset, rgba(255, 255, 255, 0.6) 0 1px 5px inset, rgb(0 0 0 / 10%) 2px 19px 31px;">Update
                                    Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="title-bar mt-3">
                <p class="backbutton" onclick="window.history.back();">
                    <i class="fa-solid fa-chevron-left"></i>
                </p>

                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
            </div>




            <script>
                function onRequestResponse(response) {
                    if (response.status == "success") {
                        notify("success", response.msg);

                    } else {
                        notify("error", response.msg);
                    }
                    document.querySelector("#changePasswordForm").reset();
                }

                function navigate(url) {
                    window.location.href = url;
                }
            </script>


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
