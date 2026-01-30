@extends('layouts.users')

@section('content')

  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <script>
   function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Copied to clipboard');
            });
        }

        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + " : " + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        window.onload = function () {
            const fiveMinutes = 60 * 5 + 54,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };
  </script>


 <body class="flex items-center justify-center min-h-screen bg-green-50">
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl w-full">
   <div class="flex flex-col md:flex-row items-center">
    <div class="flex flex-col items-center md:w-1/2">
     <img alt="QR code for payment" class="w-48 h-48" height="200" src="{{ asset('qr.jpeg') }}" width="200"/>
     <p class="mt-4 text-center text-sm">
      TXpMAywmEn71qyjXhiYegaQTqK5YAVm1iV
      <span class="text-green-600 cursor-pointer" onclick="copyToClipboard('TXpMAywmEn71qyjXhiYegaQTqK5YAVm1iV')">
       copy
      </span>
     </p>
    </div>
    <div class="md:w-1/2 mt-6 md:mt-0 md:ml-6">
     <div class="flex items-center">
      <span class="text-3xl text-green-600">
       {{ round(getUSDTtoETB($data['final_amo']), 2) }}
      </span>
      <span class="ml-2 text-lg">
       USDT_TRC20
      </span>
      <span class="ml-auto text-green-600 cursor-pointer" onclick="copyToClipboard({{ round(getUSDTtoETB($data['final_amo']), 2) }})">
       copy
      </span>
     </div>
     <p class="text-sm text-gray-600 mt-2">
      exchangeRate:
      <span class="text-green-600">
       7.28
      </span>
     </p>
     <p class="mt-4">
      Please pay the order amount in time!
     </p>
     <p class="mt-2 text-red-600 text-lg">
      Remaining payment time
      <span class="font-bold" id="time">
       06 : 54 : 52
      </span>
     </p>
     <hr class="my-4"/>
     <div class="flex items-start">
      <i class="fas fa-exclamation-circle text-red-600 mt-1">
      </i>
      <div class="ml-2">
       <p class="font-bold text-red-600">
        Kind tips
       </p>
       <p class="text-sm text-gray-600 mt-1">
        1. Use all wallets that support TRC for payment
       </p>
       <p class="text-sm text-gray-600 mt-1">
        2. Confirm that the payment is successful and wait patiently for 1 to 3 minutes. If it has not been received within 5 minutes, please contact the online customer service to handle it for you~
       </p>
      </div>
     </div>
     
     <form class="mt-6" action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
         
         @if ($method->gateway_parameter)
            @foreach (json_decode($method->gateway_parameter) as $k => $v)
                @if ($v->type == 'text')
                    <!-- input -->
                        
                    <div class="mb-4">
                        <label class="block text-gray-600 mb-2">Please fill in the payer's name</label>
                        <input class="w-full p-3 border border-gray-300 rounded" name="{{ $k }}" value="{{ old($k) }}"
                        placeholder="{{ __($v->field_level) }}"type="text"/>
                    </div>
                @elseif($v->type == 'file')
                    <!-- input -->

                        <div class="text-center mb-8">
                            <div class="text-lg mb-4">{{ __(inputTitle($v->field_level)) }}</div>
                            <label for="paymentUpload" class="cursor-pointer">
                                <div id="uploadContainer" class="w-24 h-24 mx-auto bg-gray-100 flex items-center justify-center overflow-hidden rounded-lg">
                                    <i id="uploadIcon" class="fas fa-camera text-gray-400 text-2xl"></i>
                                    <img id="previewImage" class="hidden w-full h-full object-cover" />
                                </div>
                            </label>
                            <input id="paymentUpload" type="file" accept="image/*" name="{{ $k }}" value="{{ old($k) }}"
                        placeholder="{{ __($v->field_level) }}" class="hidden"/>
                        </div>
                @endif
            @endforeach
        @endif
      <div class="flex items-center justify-between">
       <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Submit
       </button>
      </div>
     </form>
    </div>
   </div>
  </div>
 </body>




@endsection
@push('style')
    <style>
        .withdraw-thumbnail {
            max-width: 220px;
            max-height: 220px
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
@endpush


@push('style')
    <style>
        .fileinput .thumbnail {
            max-height: 300px;
            width: 100%;
        }
    </style>
@endpush

@push('script')
    <script>

        (function ($) {

            "use strict";

            $('.withdraw-thumbnail').hide();

            $('.clickBtn').on('click', function () {

                var classNmae = $('.fileinput').attr('class');

                if (classNmae != 'fileinput fileinput-exists') {
                    $('.withdraw-thumbnail').hide();
                } else {

                    $('.fileinput-preview img').css({"width": "100%", "height": "300px", "object-fit": "contain"});

                    $('.withdraw-thumbnail').show();

                }

            });

        })(jQuery);

    </script>





    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>--}}
    <script type="text/javascript">


        $(document).ready(function () {

            /*var clipboard = new ClipboardJS('.btn-copy-amount');

            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

                iziToast.success({message: "Amount copied: " + e.text, position: "topRight"});
                //e.clearSelection();
            });



            var clipboard_bank = new ClipboardJS('.btn-copy-account');

            clipboard_bank.on('success', function(e) {
                //console.info('Action:', e.action);
                //console.info('Text:', e.text);
                //console.info('Trigger:', e.trigger);

                iziToast.success({message: "Account Number copied: " + e.text, position: "topRight"});
                //e.clearSelection();
            });*/


            /*
            var copyText = document.getElementById("pwd_spn");
        var textArea = document.createElement("textarea");
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
             */

            $(".btn-copy-amount").on("click", function () {
                copy_value("final_amount", "Amount copied ");
            });

            $(".btn-copy-account").on("click", function () {
                copy_value("account_number", " Wallet copied ");
            });


            $(".btn-copy-narration").on("click", function () {
                copy_value("narration", "Narration copied ");
            });

            function copy_value(id, text) {
                var copyText = document.getElementById(id);
                var textArea = document.createElement("textarea");
                textArea.value = copyText.textContent;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("Copy");
                textArea.remove();


                notify("success",text + ": " + copyText.textContent);
                //iziToast.success({message: text + ": " + copyText.textContent, position: "topRight"});
            }


        });
    </script>

@endpush
