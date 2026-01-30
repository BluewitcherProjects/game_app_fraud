<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="nfty" />
    <meta name="keywords" content="nfty" />
    <meta name="author" content="nfty" />
    <link rel="manifest" href="manifest.json" />
    <link rel="icon" href="{{ asset("users") }}/assets/images/logo/logo.png" type="image/x-icon" />
    <title>{{ $pageTitle }} - {{ $general->sitename }}</title>
    <link rel="icon" href="{{ asset("users") }}/assets/images/logo/logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset("users") }}/assets/images/logo/logo.png" />
    <meta name="theme-color" content="#205dee" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="nfty" />
    <meta name="msapplication-TileImage" content="{{ asset("users") }}/assets/images/logo/logo.png" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet" />

    <link
            href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
            rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset("users/") }}/assets/css/vendors/bootstrap.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="{{ asset("users") }}/assets/css/vendors/bootstrap.css" />
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset("users") }}/assets/css/vendors/swiper-bundle.min.css" />

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("users") }}/assets/css/vendors/remixicon.css" />

    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="{{ asset("users") }}/assets/css/style.css?v=1.2" />

    <style type="text/css">
        .card{
            background-color: transparent !important;
            color: #fff !important;
        }

        .table{
            color: #fff !important;
        }
    </style>
    @stack('style')
    @stack('style-lib')
</head>

<body>

<!-- loader start-->
<div class="loader-wrapper" id="loader">
    <div class="loader">
        <span>T</span>
        <span>I</span>
        <span>N</span>
        <span>Y</span>
        <span>S</span>
        <span>E</span>
        <span>E</span>
        <span>D</span>
    </div>
</div>
<!-- loader end -->

<!-- side bar start -->
<div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
    <div class="offcanvas-header">

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

    </div>
</div>
<!-- side bar end -->

<!-- header start -->
<header class="section-t-space">
    <div class="custom-container">
        <div class="head-content justify-content-between">
            {{--<img class="img-fluid logo" src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="logo" />--}}
            <img class="img-fluid logo" src="{{ asset("tiny-logo.jpg") }}" alt="logo" />

            <ul class="menu">
                <li class="">
                    <a href="https://t.me/GMG_Official_Channel"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#fff" class="bi bi-telegram" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"></path>
                        </svg></a>
                </li>

                <li>
                    <a href="{{ route('user.profile.setting') }}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#fff" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
                        </svg></a>
                </li>

                <li>
                    <a href="{{ route('user.logout') }}" class="btn btn-sm btn-secondary">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- header end -->

<!--category  section starts -->
<section class="section-t-space">
    <div class="custom-container">
        <div class="title">
            <h4>{{ $pageTitle }}</h4>
        </div>


        @stack('menu')
    </div>
</section>
<!-- category section end -->

<!-- Explore section start -->

<!-- Explore section end -->

<section class="section-t-space">
    <div class="custom-container">
        @yield('content')
    </div>
</section>

<!-- panel-space start -->
<section class="panel-space"></section>
<!-- panel-space end -->

<!-- bottom navbar start -->
<div class="navbar-menu">
    <ul>
        <li class="{{ menuActive('user.home') }}">
            <a href="{{ route('user.home') }}">
                <div class="icon">
                    <i class="ri-home-5-line unactive"></i>
                    <i class="ri-home-5-fill active"></i>
                </div>
                <span class="active">Dashboard</span>
            </a>
        </li>
        <li class="{{ menuActive('user.trx.log') }}">
            <a href="{{ route('user.trx.log') }}">
                <div class="icon">
                    <i class="ri-line-chart-line unactive"></i>
                    <i class="ri-line-chart-fill active"></i>
                </div>
                <span>Transactions</span>
            </a>
        </li>
        <li class="{{ menuActive('user.investment') }}">
            <a href="{{ route('user.investment') }}" class="plus" title="Buy Dollar">
                <i class="ri-add-line plus-icon"></i>
            </a>
        </li>
        <li class="{{ menuActive('user.withdraw') }}">
            <a href="{{ route('user.withdraw') }}">
                <div class="icon">
                    <i class="ri-search-line unactive"></i>
                    <i class="ri-search-fill active"></i>
                </div>
                <span>Withdraw</span>
            </a>
        </li>
        <li class="{{ menuActive('user.profile.setting') }}">
            <a href="{{ route('user.profile.setting') }}">
                <div class="icon">
                    <i class="ri-user-3-line unactive"></i>
                    <i class="ri-user-3-fill active"></i>
                </div>
                <span>Profile</span>
            </a>
        </li>
    </ul>
</div>
<!-- bottom navbar end -->

<!-- bootstrap js -->
<script src="{{asset('assets/admin/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset("users") }}/assets/js/bootstrap.bundle.min.js"></script>

<!-- swiper js -->
<script src="{{ asset("users") }}/assets/js/swiper-bundle.min.js"></script>
<script src="{{ asset("users") }}/assets/js/custom-swiper.js"></script>

<!-- script js -->
<script src="{{ asset("users") }}/assets/js/script.js"></script>

@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('partials.notify')
</body>

</html>