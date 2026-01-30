@extends('layouts.users')


@section('content')

  <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .post {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .post-header img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
            
        }
        .post-header .user-info {
            font-size: 14px;
        }
        .post-header .user-info .username {
            font-weight: bold;
        }
        .post-header .user-info .timestamp {
            color: #888;
        }
        .post-content {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .post-content>div{
            display:flex;
            flex-wrap: wrap;
            /*justify-content: space-between;*/
        }
        .post-content>div>img{
            width:70px;
            margin-right:10px;
        }
        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .post-footer .amount {
            color: #ff9900;
            font-weight: bold;
        }
        .post-footer .date {
            color: #888;
            font-size: 12px;
        }
        .nav-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #0056b3;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
        .nav-bar a {
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
        }
        .nav-bar a i {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .side-buttons {
            position: fixed;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .side-buttons button {
            background-color: transparent;
            border: none;
            /*border-radius: 50%;*/
            /*width: 50px;*/
            /*height: 50px;*/
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
            cursor: pointer;
        }
        .side-buttons button img {
            width: 70px;
            height: 70px;
            
        }
        .spin-wheel{
            display:none !important;
        }
  </style>

 <body>
  <div class="container">
   
   @foreach($post as $item)
   <div class="post">
    <div class="post-header">
     <img alt="User profile picture" height="50" src="{{ asset('images/user/3.png') }}" width="50"/>
     <div class="user-info">
      <div class="username">
       New User
      </div>
      <div class="timestamp">
       {{ Split_Hide_Name($item->user->mobile) }}
      </div>
     </div>
    </div>
    <div class="post-content">
     {{ $item->content }}
     <br/>
     <br/>
     
     
         @php
            $images = json_decode($item->image, true); // Decode the JSON
        @endphp
        <div>
            @foreach ($images as $image)
         
             <img onclick="window.location.href='{{ url('core/storage/app/public/' . $image) }}'" alt="Screenshot of a payment notification" src="{{ asset('core/storage/app/public/' . $image) }}"/>
             @endforeach
        </div>
    </div>
    <div class="post-footer">
     <div class="amount">
      R35.00
     </div>
     <div class="date">
      {{ $item->created_at->format('m-d H:i:s') }}
     </div>
    </div>
   </div>
   @endforeach
  </div>
  
  <!-- Overlay -->
    <div class="van-overlay" role="button" tabindex="0" data-v-6178753a=""
        style="z-index: 2001; display: none;" id="overlay"></div>

    <!-- Popup -->
    <div role="dialog" tabindex="0" class="van-popup van-popup--top custom_TopPopup"
        data-v-6178753a="" style="z-index: 2001; display: none;" id="popup">
        <div data-v-6178753a="" class="statement p20">
            <div data-v-6178753a="" class="title m_tb10">
                <h4 data-v-6178753a="">Instruction</h4>
            </div>
            <div data-v-6178753a="" class="explain">
                <ul data-v-6178753a="">
                    <li data-v-6178753a="" class="display alignStart"><b data-v-6178753a="">1. </b>
                        <p data-v-6178753a="" class="flex1">Upload your latest withdrawal proof and get R35 reward.
                        </p>
                    </li>
                    <li data-v-6178753a="" class="display alignStart"><b data-v-6178753a="">2. </b>
                        <p data-v-6178753a="" class="flex1">Upload old and fake proof will result in your account being banned. 
</p>
                    </li>
                    <li data-v-6178753a="" class="display alignStart"><b data-v-6178753a="">3. </b>
                        <p data-v-6178753a="" class="flex1">Comment with words not more than 100.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  
  
  
  
  @include('templates.basic.partials.footer')
  
  <div class="side-buttons">
   <button class="publish">
    <img alt="Rule icon" height="30" src="{{ asset('images/Reward-DhcSNS4m.png') }}" width="30"/>
   </button>
   <button onclick="window.location.href='{{ route('user.post') }}';">
    <img alt="Publish icon" height="30" src="{{ asset('images/publishArticle-DJnYsKlE.png') }}" width="30"/>
   </button>
  </div>
 </body>







<script>
    // Get elements
    const ruleButton = document.querySelector('.publish');
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');

    // Function to show the popup
    ruleButton.addEventListener('click', function() {
        overlay.style.display = 'block'; // Show the overlay
        popup.style.display = 'block'; // Show the popup
    });

    // Function to hide the popup
    function hidePopup() {
        overlay.style.display = 'none'; // Hide the overlay
        popup.style.display = 'none'; // Hide the popup
    }

    // Event listener for the overlay to close the popup
    overlay.addEventListener('click', hidePopup);
</script>


<script>
  // Wait until the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', function () {
    // Find the close button and the image
    const closeButton = document.querySelector('.icon-ErrorClose');
    const popup = document.querySelector('.u-popup');
    const image = document.querySelector('.iconright'); // The image that triggers the popup
    
    // Ensure the popup and close button exist
    if (closeButton && popup) {
      // Hide the popup by default
      popup.style.display = 'none';

      // Add a click event listener to the close button
      closeButton.addEventListener('click', function () {
        // Hide the popup when the close button is clicked
        popup.style.display = 'none';
      });
      
      // Add a click event listener to the image
      image.addEventListener('click', function () {
        // Show the popup when the image is clicked
        popup.style.display = 'flex'; // Or 'block', depending on the popup's default display style
      });
    }
  });
</script>
@endsection