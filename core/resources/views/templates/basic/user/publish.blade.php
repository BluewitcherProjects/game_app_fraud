@extends('layouts.users')


@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .section textarea {
            width: 93%;
            max-width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f8ff;
            resize: none;
        }
        .section .upload-box {
            border: 2px dashed #ccc;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom:20px;
        }
        .section .upload-box i {
            font-size: 50px;
            color:green;
        }
        .publish-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }
        .publish-btn:hover {
            background-color: #0056b3;
        }
  </style>


    <body>
        <div id="app" data-v-app="">
            <div data-v-bed97466="" class="rcordCommissionPage bg_00">
                <div data-v-bed97466="">
                    <div class="van-sticky">
                        <div data-v-bed97466="" class="van-nav-bar van-hairline--bottom">
                            <div class="van-nav-bar__content">
                                <div onclick="window.history.go(-1); return false;" class="van-nav-bar__left van-haptics-feedback"><i
                                        class="van-badge__wrapper van-icon van-icon-arrow-left van-nav-bar__arrow"><!----><!----><!----></i>
                                </div>
                                <div class="van-nav-bar__title van-ellipsis">Post Blog</div><!---->
                            </div>
                        </div>
                    </div>
                </div>
                <div data-v-bed97466="" class="main">
                    
                    
                    
                <form action="{{ route('user.post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="container">
                       <div class="section">
                        <label for="content">
                         Comment
                        </label>
                        <textarea name="content" maxlength="100" enterkeyhint="return" id="content" placeholder="Please enter your comment here"></textarea>
                       </div>
                       <div class="section">
                        <label for="upload">
                         Upload withdrawal proof
                        </label>
                        <div class="upload-box" id="upload">
                         <i class="ri-image-add-fill"></i>
                       </div>
                       <input type="file" id="fileInput" style="display: none;" name="images[]" accept="image/*" multiple />
                       <button type="submit" class="publish-btn">
                        Publish
                       </button>
                      </div>
    
                        
                        
                    </div>
                </form>
            </div>
        </div>


    <script>
            document.getElementById('upload').addEventListener('click', function() {
                document.getElementById('fileInput').click();
            });
    
            document.getElementById('fileInput').addEventListener('change', function(event) {
                const files = event.target.files;
                const uploadBox = document.getElementById('upload');
                uploadBox.innerHTML = ''; // Clear the upload box
    
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
    
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.style.width = '50px';
                        img.style.height = '50px';
                        img.style.margin = '5px';
                        uploadBox.appendChild(img);
                    };
    
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </body>
@endsection