<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="google" content="notranslate">
    <title>{{ $general->sitename }} - @stack('page_title')</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/swiper/swiper-bundle.min.css') }}">

    <link href="https://fonts.googleapis.com/" rel="stylesheet">
    <link href="https://fonts.gstatic.com/" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Quicksand", sans-serif !important;
            font-weight: 400;
        }
    </style>

</head>


<body>

    @yield('content')

</body>

<script src="{{ asset('assets/app/js/jquery.js') }}"></script>

<script src="{{ asset('assets/app/js/settings.js?v=7448') }}"></script>
<script src="{{ asset('assets/app/js/custom.js?v=45') }}"></script>
<script src="{{ asset('assets/app/js/dz.carousel.js') }}"></script><!-- Swiper -->
<script src="{{ asset('assets/app/vendor/swiper/swiper-bundle.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/vant/lib/vant.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    function showModal() {
        document.getElementById("newsModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("newsModal").style.display = "none";
    }

    window.onload = showModal;

    window.onclick = function(event) {
        var modal = document.getElementById("newsModal");
        if (event.target == modal) {
            closeModal();
        }
    };


    function togglePopup() {
        var popup = document.getElementById("popup-box");
        popup.classList.toggle("show");
    }

    function openModal(data) {
        $("#product_price").html("Price : {{ $general->cur_sym }} " + data.price);
        $("#product_days").html("Days: " + data.days);
        $("#product_name").html(data.name);
        $("#id").val(data.id);
        $("#product_description").html(data.description);
        $("#daily_income").html("{{ $general->cur_sym }} " + data.daily_income);
        $("#total_income").html("{{ $general->cur_sym }} " + (data.daily_income * data.days));
        $("#yesBtn").attr("onclick", "purchaseProduct('" + data.id + "')");
        $(".offcanvas").addClass("pwa-offcanvas show");
        $(".offcanvas").attr("style", "");
        $(".offcanvas-backdrop").addClass("show");
    }

    window.first = false;

    function navigate(path, complete = true) {
        history.go(-1);
    }
</script>

<script>
    function closePlan() {
        // Hide the offcanvas
        $(".offcanvas").removeClass("show");
        $(".offcanvas").attr("style", "display: none;");
        // Hide the backdrop
        $(".offcanvas-backdrop").removeClass("show");
    }
</script>


@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('partials.notify')


</html>
