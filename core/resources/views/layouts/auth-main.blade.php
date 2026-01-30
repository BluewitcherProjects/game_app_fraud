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
    <link rel="icon" href="{{ asset('users') }}/assets/images/logo/logo.png" type="image/x-icon" />
    <title>{{ $general->sitename }}</title>
    <link rel="icon" href="{{ asset('users') }}/assets/images/logo/logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('users') }}/assets/images/logo/logo.png" />
    <meta name="theme-color" content="#205dee" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="nfty" />
    <meta name="msapplication-TileImage" content="{{ asset('users') }}/assets/images/logo/logo.png" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{ asset('users/sog/1NhpxQY4ct4e418d51.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/vmTxVha1xQcf1599ad.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/aWbdT6eFzo7c82d0c6.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/RMfmA3ct6Ac449726b.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/bZKTK6s8QG2b84cc2f.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/oKktsg3GWk90136bca.css') }}">

    <link rel="stylesheet" href="{{ asset('users/sog/dMj5fBktfQc94c4541.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/sqqjJoPq6D73134c2c.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/bGXJHzcOeW0d1c9dd6.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/HsT3vUbevLd9010059.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/LREqDFhSINcfd6d785.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/dMXtxXkbxWaa514b1e.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/64nTlwUNuT780d7650.css') }}">
    <link rel="stylesheet" href="{{ asset('users/sog/wtnQ1Pfsbj90dac5d7.css') }}">
    <!--<link rel="stylesheet" href="sog/Q7lP3WVqhH6eff274d.css">-->
    <!--<link rel="stylesheet" href="sog/RMfmA3ct6Ac449726b.css">-->
    <link rel="stylesheet" href="{{ asset('users/sog/qLzlgziy5z4d4a51b0.css') }}">

    <style>
        :root {
            --vh: 6.67px;
            --primary: #011145 !important;
            --border-color: #fff !important;
            --bg-nav: rgba(255, 255, 255, 0.01) !important;
            --bg-notice: #0f2360 !important;
            --text-nav: #fff !important;
            --bg-card: #E4E7F2 !important;
            --bg-tab: #011145 !important;
            --bg-input: #f2f4f9 !important;
            --bg-login: #E4E7F2 !important;
            --btn-text: #011145 !important;
            --line-color: #265fee !important;
            --btn-bg: #26232F !important;
            --btn-light: linear-gradient(180deg, #fff, #0f2360) !important;
        }

        .none {
            display: none !important;
        }
    </style>

</head>

<body>

    <!-- loader start-->
    {{-- <div class="loader-wrapper" id="loader">
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
</div> --}}
    <!-- loader end -->

    <!-- header start -->
    <header>
        <div class="custom-container">
            <div class="auth-title">
                <h1>{{ $pageTitle }}</h1>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Sign section start -->
    <div class="custom-container">
        @yield('content')
    </div>
    <!-- Sign section end-->

    <script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('users') }}/assets/js/bootstrap.bundle.min.js"></script>

    <!-- script js -->
    <script src="{{ asset('users') }}/assets/js/script.js"></script>

    @stack('script-lib')
    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

</body>

</html>
