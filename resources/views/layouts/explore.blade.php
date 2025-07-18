<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FabHub</title>
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- Bootstrap's JS and CSS (you can use a CDN link) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Bootstrap Carausel-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        .product-img {
            height: 150px;
            object-fit: fill;
        }

        .price-wishlist {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .wishlist-icon {
            font-size: 1.2rem;
            color: gray;
            cursor: pointer;
        }

        .wishlist-icon.selected {
            color: #dc3545;
        }


        

        /* Styles for the Bottom Navbar */
        .bottom-navbar {
            display: none;
            position: fixed;
            bottom: 20;
            left: 0;
            width: 100%;
            background-color: black;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .bottom-navbar ul {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0;
            padding: 5px 0;
            list-style: none;
        }

        .bottom-navbar ul li {
            text-align: center;
        }

        .bottom-navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .bottom-navbar ul li a i {
            font-size: 20px;
            display: block;
        }

        /* Show navbar on small screens */
        @media (max-width: 768px) {
            .bottom-navbar {
                display: block;
            }
        }

        .circle-icon {
            display: inline-flex;
            flex-direction: column;
            /* Stack the icon and text vertically */
            align-items: center;
            /* Center both the icon and text */
            justify-content: center;
            /* Center the content inside the circle */
            text-align: center;
            position: relative;
            width: 60px;
            /* Adjust the size of the circle */
            height: 60px;
            /* Adjust the size of the circle */
            border-radius: 50%;
            /* Make it a circle */
            /*background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(150, 19, 17, 1) 35%, rgba(150, 19, 17, 1) 100%);*/
            background: radial-gradient(at right center, #D7CCB7, #EFC475);

            margin-right: -5px;
            overflow: hidden;
        }

        .circle-icon i {
            font-size: 30px;
            /* Icon size */
            color: black;
            /* Icon color */
            animation: blink 1s infinite;
            /* Blinking animation */
        }

        .circle-icon span {
            font-size: 12px;
            /* Adjust text size */
            color: black;
            /* Text color */
        }

        /* Blinking animation */
        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .circle-icon:hover {
            background: linear-gradient(45deg, #ffcc00, #ff6f61, #66ff66, #66ccff);
            /* Hover effect */
        }

        .slideimg {
            height: 600px;
        }

        .rating {
            color: #ffc107;
        }

        .rating .fa-star {
            margin-right: 0px;
        }
    </style>
           <style>
            body {
                visibility: hidden; /* Initially hide body content */
            }
            
            #content {
                display: none; /* Initially hide main content */
            }
            
            /* Preloader styles */
            #preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.7);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999; /* Ensure it stays on top */
            }
            
            #preloader img {
                width: 150px; /* Adjust size as needed */
                height: auto;
            }
          </style>
  
        @stack('style')

        <script>
            const AIZ = window.AIZ || {};
            AIZ.local = {
                nothing_selected: 'Nothing selected',
                nothing_found: 'Nothing found',
                choose_file: 'Choose File',
                file_selected: 'File selected',
                files_selected: 'Files selected',
                add_more_files: 'Add more files',
                adding_more_files: 'Adding more files',
                drop_files_here_paste_or: 'Drop files here, paste or',
                browse: 'Browse',
                upload_complete: 'Upload complete',
                upload_paused: 'Upload paused',
                resume_upload: 'Resume upload',
                pause_upload: 'Pause upload',
                retry_upload: 'Retry upload',
                cancel_upload: 'Cancel upload',
                uploading: 'Uploading',
                processing: 'Processing',
                complete: 'Complete',
                file: 'File',
                files: 'Files',
            }
        </script>

</head>

<body>
    <div id="preloader">
        <img src="https://media.showloom.com/uploads/all/for-web-2-unscreen.gif" alt="Loading...">
    </div>
  
    <nav class="navbar navbar-expand-lg navbar-light" style="position:fixed;">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('public/assets/images/logo/logo_showloom.png') }}" class="logoimg" alt="OhhBuddie">
        </a>

        <!-- Icons -->
        <div class="d-flex ml-auto align-items-center">
            <!--<button onclick="myFunction()">Switch Mode</button>-->
          <a href="#" class="text-light" style="font-size: 24px; font-weight: normal; margin-right: 5px;">
            <!--<i class="fas fa-search"></i>-->
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
              <circle cx="20" cy="20" r="9" stroke="white" stroke-width="2"/>
              <line x1="26" y1="26" x2="34" y2="34" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </a>
          <a href="#" class="text-light" style="font-size: 24px; font-weight: normal; margin-right: 20px;">
            <i class="far fa-heart"></i>
          </a>
          <a href="#" class="text-light" style="font-size: 24px; font-weight: normal;">
            <i class="fa fa-shopping-bag"></i>
          </a>
        </div>
    </nav>



    <div class="main-body">
         @yield('content')
    </div>
    
    
    <!--Bottom Nav Bar -->

    <div class="bottom-navbar">
        <ul>
            &nbsp;
            <li>
                <a href="/">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#search">
                    <i class="fa fa-shopping-cart"></i>
                    Shop
                </a>
            </li>
            <li>
                <a href="/order" class="circle-icon">
                    <i class="fas fa-shirt"></i>
                    <span>Tryout</span>
                </a>
            </li>
            <li>
                <a href="/explore">
                    <i class="fas fa-search"></i>
                    Explore
                </a>
            </li>
            <li>
                <a href="{{url('/account')}}">
                    <i class="fas fa-user"></i>
                    Account
                </a>
            </li>
            &nbsp;
        </ul>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
      <script>
        window.addEventListener('load', function () {
            // Hide the preloader after page load
            document.getElementById('preloader').style.display = 'none';
            
            // Show the main content after page load
            document.body.style.visibility = 'visible'; // Show body content
            document.getElementById('content').style.display = 'block'; // Show main content
        });
      </script>
  

    <script>
        let slideIndex = 0;
        showSlides();
    
        // Auto-scroll functionality
        function showSlides() {
            let slides = document.getElementsByClassName("mySlides");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5000); // Change slide every 5 seconds
        }
    
        // Manual slide control
        function plusSlides(n) {
            showManualSlides(slideIndex += n);
        }
    
        function showManualSlides(n) {
            let slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>

</html>