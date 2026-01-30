<html lang="en"
    style="font-size: 21.5467px; --status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --tab-bar-height: 50px; --window-top: calc(0px + env(safe-area-inset-top)); --window-bottom: calc(0px + env(safe-area-inset-bottom));">

<head>
    <meta charset="utf-8">

    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <title> {{ $general->sitename }} - @stack('page_title')</title>
    {{--  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  --}}
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/style.css') }}">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Quicksand", sans-serif !important;
            font-weight: bold !important;
        }
    </style>
</head>



@yield('content')



<script src="{{ asset('assets/app/js/jquery.js') }}"></script>
<script src="{{ asset('assets/app/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/app/js/settings.js?v=7448') }}"></script>
<script src="{{ asset('assets/app/js/custom.js?v=45') }}"></script>
<script src="{{ asset('assets/app/js/dz.carousel.js') }}"></script><!-- Swiper -->
<script src="{{ asset('assets/app/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- Swiper -->


@stack('script-lib')
@stack('script')

@include('partials.plugins')

@include('partials.notify')

</body>

</html>
