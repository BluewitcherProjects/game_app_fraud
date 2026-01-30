@extends('layouts.users')

@section('content')

    <style>
        .indexdiv {
            background: #000000;
            position: fixed;
            left: 0px;
            top: 0px;
            bottom: 0px;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 101;
            filter: alpha(opacity=85);
            opacity: 0.85 !important;
        }

        .layui-layer-btn .layui-layer-btn0 {
            border-color: #0C2467 !important;
            background-color: #0C2467 !important;
            color: #fff;
        }

        .topname {
            line-height: 46px;
            font-weight: 700;
            font-size: 14px;
            width: 80%;
            text-align: center;
            color: #fff;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
        }

        .carditem {
            width: 100%;
            font: 12px/1.2em '\5b8b\4f53', tahoma, arial, 'Hiragino Sans GB', sans-serif;
            height: auto;
            margin: 0 auto;
            border-width: 0px;
            border-color: #666;
            border-style: solid;
            border-radius: 5px;
            box-shadow: 0px 0px 0px 0px rgba(34, 34, 34, 0.20);
            background-color: #191A1F;
            color: #808080;
            background: #191A1F;
            overflow: hidden;
        }

        .cmbtn {
            margin: 0 auto;
            width: 30%;
            margin-left: 20%;
            float: left;
            background: #C0857E;
            cursor: pointer;
            font-size: 14px;
            height: 30px;
            line-height: 30px;
            margin-top: 20px;
            border-radius: 20px !important;
            color: #fff;
            border-width: 1px;
            border-color: #C0857E;
            border-style: solid;
            box-shadow: 0 2px 3px 0 #C0857E;
        }

        .cmbtn1 {
            margin: 0 auto;
            width: 30%;
            margin-left: 10%;
            float: left;
            background: linear-gradient(to right, gray, #aaa);
            cursor: pointer;
            font-size: 14px;
            height: 30px;
            line-height: 30px;
            margin-top: 20px;
            border-radius: 20px !important;
            color: #fff;
            border-width: 1px;
            border-color: #aaa;
            border-style: solid;
            box-shadow: 0 2px 3px 0 #aaa;
        }
    </style>

    <body style="background-size: 100% auto; background: #000;">
        <div style="width: 100%; height: 100%; background: rgb(255, 255, 255); position: fixed; top: 0px; left: 0px; z-index: 99999; display: none;"
            id="loader">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div class="loader">
                    <img src="{{ asset('images/loader.gif') }}" style="width: 40px;">
                </div>
            </div>
        </div>
        <style>
            .colored {
                filter: invert(75%) sepia(30%) saturate(350%) hue-rotate(336deg) brightness(180%) contrast(90%);
            }


            /* .loader {
         --R: 20px;
         --g1: #514b82 96%, #0000;
         --g2: #ffffff 96%, #0000;
         width: calc(2*var(--R));
         aspect-ratio: 1;
         border-radius: 50%;
         display: grid;
         -webkit-mask: linear-gradient(#000 0 0);
         animation: l30 2s infinite linear;
        }
        .loader::before,
        .loader::after{
         content:"";
         grid-area: 1/1;
         width: 50%;
         background:
           radial-gradient(farthest-side,var(--g1)) calc(var(--R) + 0.866*var(--R) - var(--R)) calc(var(--R) - 0.5*var(--R)   - var(--R)),
           radial-gradient(farthest-side,var(--g1)) calc(var(--R) + 0.866*var(--R) - var(--R)) calc(var(--R) - 0.5*var(--R)   - var(--R)),
           radial-gradient(farthest-side,var(--g2)) calc(var(--R) + 0.5*var(--R)   - var(--R)) calc(var(--R) - 0.866*var(--R) - var(--R)),
           radial-gradient(farthest-side,var(--g1)) 0 calc(-1*var(--R)),
           radial-gradient(farthest-side,var(--g2)) calc(var(--R) - 0.5*var(--R)   - var(--R)) calc(var(--R) - 0.866*var(--R) - var(--R)),
           radial-gradient(farthest-side,var(--g1)) calc(var(--R) - 0.866*var(--R) - var(--R)) calc(var(--R) - 0.5*var(--R)   - var(--R)),
           radial-gradient(farthest-side,var(--g2)) calc(-1*var(--R))  0,
           radial-gradient(farthest-side,var(--g1)) calc(var(--R) - 0.866*var(--R) - var(--R)) calc(var(--R) + 0.5*var(--R)   - var(--R));
          background-size: calc(2*var(--R)) calc(2*var(--R));
          background-repeat :no-repeat;
        }
        .loader::after {
        transform: rotate(180deg);
        transform-origin: right;
        }

        @keyframes l30 {
         100% {transform: rotate(-1turn)}
        }

        .image-filter {
            filter: hue-rotate(180deg) saturate(300%) brightness(120%);
        } */
        </style>
        <script>
            // Function to show the loader for 6 seconds
            function showLoaderFor2Seconds() {
                const loader = document.getElementById('loader');
                loader.style.display = 'block';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 400);
            }

            function showLoader() {
                const form = document.querySelector('form');
                form.addEventListener('submit', function(event) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = true;
                    submitButton.style.backgroundColor = '#ccc';
                });
            }

            document.addEventListener('DOMContentLoaded', showLoader);
            document.addEventListener('DOMContentLoaded', function() {
                // Get all <a> tags
                const links = document.querySelectorAll('aaaa');

                // Add click event listener to each <a> tag
                links.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        showLoaderFor2Seconds(); // Call the function to show the loader
                    });
                });
            });

            showLoaderFor2Seconds()
        </script>
        <div class="indexdiv"></div>
        <div style="width: 100%; margin: 0 auto; background: #191A1F; border-bottom: 0px solid #000; " class="top">
            <div onclick="window.history.go(-1); return false;"
                style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
                <i class="layui-icon" style=" color:#fff; margin-left:12px; font-size:18px;  font-weight:bold;"></i>
            </div>
            <font class="topname" style="color: #fff;">
                Bank Account Management
            </font>
            @if (!auth()->user()->bankAccount)

            <div onclick="window.location.href='{{ route('user.account-setup') }}'"
                style="float:right; text-align:right; line-height:46px;width:50%;" id="Addbank">
                <i class="layui-icon" style=" color: #fff; margin-right: 12px; font-size: 18px; font-weight: bold;"></i>
            </div>

            @endif
        </div>
        <div style=" max-width:450px; margin:0 auto;  ">
            @if (!auth()->user()->bankAccount)
            <div class="layui-form layui-tab-content" style="padding:5px 10px; margin-top:46px;">
                <div id="card" style="width:100%;">
                    <div style="padding:2px; width:100%; margin:0 auto; margin-top:50px;">
                        <div style="border-radius: 5px; color:#fff; text-align:center; margin-top:35px;position:relative;">
                            <img src="{{ asset('customv2/wi_account/imgss/no.png') }}" style="width:100%;">
                            <br>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" style="margin-top:25px;">
                    <a href="{{ route('user.account-setup') }}" style="width:60%; margin:0 auto;">
                        <input class="layui-btn" id="add" value="Add"
                            style="width: 100%; border-radius: 25px; color: #fff; font-weight: bold; background: #008000; font-size: 16px; border: 0px; height: 45px; line-height: 45px; border-radius: 10px; "
                            type="button">
                    </a>
                </div>
            </div>
            @else
            <div id="card" style="width:100%;margin-top:60px;">
                <div class="carditem" style="margin-top:10px;">
                    <div style="width:25%; float:left;" class="items" value="12345" bankcard="9876543210">
                        <img src="{{ asset('customv2/wi_account/ui5/bank.png') }}"
                            style="height:40px; margin:15px; margin-left:10px;margin-top:25px;">
                    </div>
                    <div style="width:67%;float:left; line-height:22px;" class="items" value="12345"
                        bankcard="9876543210">
                        <div style="margin-top:15px; font-size:14px;">{{ auth()->user()->bankAccount->bank_name }}</div>
                        <div style="margin-top:0px;">{{ auth()->user()->bankAccount->account_name }}</div>
                        <div style="margin-top:0px;">{{ auth()->user()->bankAccount->account_number }}</div>
                    </div>
                    <div style="width:8%; float:left; line-height:28px;" id="pop7796">
                        <div style="margin-top:28px;">&nbsp;</div>
                        <div onclick="window.location.href='{{ url('user/bank/delete') }}'">
                            <i class="layui-icon" style="font-size:24px;"></i>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div>
        <script>
            // Function to show/hide modal
            function toggleModal(methodId) {
                var modalId = methodId; // Set modal ID to the same as method ID
                // Hide all modals
                var modals = document.querySelectorAll('[id^=""]');
                for (var i = 0; i < modals.length; i++) {
                    modals[i].style.display = 'none';
                }
                // Show modal with corresponding ID
                document.getElementById(modalId).style.display = 'block';
            }

            function hideModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'none';
                }
            }

            // Add click event listener to all elements with IDs starting with 'pop'
            var popElements = document.querySelectorAll('[id^="pop"]');
            for (var i = 0; i < popElements.length; i++) {
                popElements[i].addEventListener('click', function() {
                    // Extract the numeric part from the 'pop' ID
                    var methodId = this.id.replace('pop', '');
                    // Call toggleModal function with the extracted ID
                    toggleModal(methodId);
                });
            }

            // Add click event listener to all elements with IDs starting with 'pop'
            var popElements = document.querySelectorAll('[id^="pop"]');
            for (var i = 0; i < popElements.length; i++) {
                popElements[i].addEventListener('click', function() {
                    // Extract the numeric part from the 'pop' ID
                    var methodId = this.id.replace('pop', '');
                    // Call toggleModal function with the extracted ID
                    toggleModal(methodId);
                });
            }
        </script>

    </body>

    @extends('layouts.users')

@section('content')
