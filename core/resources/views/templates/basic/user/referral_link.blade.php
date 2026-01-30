@extends('layouts.users')



@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/themify-icons@1.0.1-alpha.3/themify-icons.min.css">

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
                                <h5 class="mb-0">Invitation Center</h5>
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

                .header .header-content .mid-content {
                    flex: 1;
                    text-align: center;
                }

                h5,
                .h5 {
                    font-size: 1.3rem;
                }

                .xqzkvc {
                    display: flex;
                    background: white;
                    border-radius: 12px;
                    padding: 16px;
                    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                    position: relative;
                    zoom: 77%;
                    margin-top: -75px;
                }

                .fb {
                    padding-bottom: 80px;
                    background: #ffffff;
                    margin: 15px;
                    width: 92%;
                    border-radius: 15px;
                    margin-top: -38px;
                    box-shadow: 0px 2px 10px rgb(0 0 0 / 6%);
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

                .menubar-area {
                    display: none;
                }

                .container {
                    padding-top: 70px;
                }

                .form-control {
                    height: 48px;
                    border: 1px solid #ddd;
                    padding: 10px 25px;
                    font-size: 14px;
                    font-weight: 400;
                    color: #7e7e7e;
                    transition: all 0.3s ease-in-out;
                    background: #fff;
                    border-radius: 10px ! important;
                }

                .input-group {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    width: 100%;
                    justify-content: flex-end;
                }

                .btn {
                    background: #c7cd49;

                }

                .btn-primary {
                    border-color: #c7cd49;
                }

                .input-group .btn {
                    position: absolute;
                    z-index: 2;
                }

                .btn-outline-primary {
                    color: #ffffff;
                    border-color: #e9ecef;
                    background: #c7cd49;
                    border: 2px #dddddd solid;
                }

                .input-group> :not(:first-child) {
                    padding: 16px;
                }

                .btn-primary:active,
                .btn-primary:focus,
                .btn-primary:hover {
                    border-color: #fff;
                    background-color: #c7cd49;
                    box-shadow: 0px 4px 10px rgba(158, 210, 48, 0.5) !important;
                }
            </style>

            <div class="page-content">

                <div class="content-inner pt-0">
                    <div class="container fb">

                        <h2 class="mb-4">Invite Your Friends!</h2>
                        <p class="mb-4">
                            Share your unique referral code or use the direct link below to invite your friends and earn
                            {{ $general->lv1 }}%
                            rewards!
                        </p>
                        <div class="mb-4">
                            <p class="mb-1">Your Referral Code:</p>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ auth()->user()->ref_code }}"
                                    id="referalCode" readonly="">
                                <button class="btn btn-outline-primary"
                                    onclick="copyToClipboard('referalCode')">Copy</button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p class="mb-1">Your Invite Link:</p>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value='{{ route('home') }}?shareCode={{ auth()->user()->ref_code }}' id="inviteLink"
                                    readonly="">
                                <button class="btn btn-outline-primary"
                                    onclick="copyToClipboard('inviteLink')">Copy</button>
                            </div>
                        </div>
                        <button class="btn btn-primary share-btn w-100 mb-2 mt-3" onclick="copyToClipboard('inviteLink')">
                            <i class="ti ti-share"></i> &nbsp;&nbsp;Share
                        </button>


                    </div>
                </div>
            </div>

            <div class="title-bar mt-3">
                <p class="backbutton" onclick="navigate('/home/')">
                    <i class="fa-solid fa-chevron-left" style="color: white;"></i>
                </p>

                <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
            </div>


            <script>
                function copyToClipboard(elementId) {
                    const input = document.getElementById(elementId);
                    input.select();
                    input.setSelectionRange(0, 99999); // For mobile devices

                    try {
                        document.execCommand("copy");
                        alert("Copied Successfully!");
                    } catch (err) {
                        alert("Failed to copy text.");
                    }

                    // Optional: Unselect text after copy
                    window.getSelection().removeAllRanges();
                }
            </script>

            <script>
                function shareLink() {
                    const url = '{{ route('home') }}?shareCode={{ auth()->user()->ref_code }}';
                    if (navigator.share) {
                        navigator.share({
                            title: "Join {{ $general->sitename }}  Family",
                            text: "Use my referral code and join the app to earn rewards.",
                            url: url,
                        }).catch(console.error);
                    } else {
                        notify("error", "error while sharing");
                    }
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


@push('script')
    <script type="text/javascript">
        var text = '{{ route('home') }}?shareCode={{ auth()->user()->ref_code }}';
        $('.btncopy').click(function() {
            copy(text)
        });
    </script>
@endpush
