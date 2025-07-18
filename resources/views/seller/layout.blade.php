<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Authentication</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Wishlist Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">-->

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 
    <!-- {{-- <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">  --}} -->
    
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <!--<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>-->
    
    <!-- Bootstrap's JS and CSS (you can use a CDN link) -->
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>-->
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
    
    <!--Bootstrap Carausel-->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: sans-serif;
        }
        .container-custom {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .auth-section {
            display: flex;
            height: calc(100vh - 0px); /* Adjusting height excluding navbar */
            align-items: center;
            justify-content: center;
        }
        .left-side {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .left-side img {
            max-width: 100%;
            height: auto;
        }
        .right-side {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .footer {
            text-align: center;
            padding: 15px;
            background: #fff;
            border-top: 1px solid #ddd;
        }
        .navbar {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }
        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <style>
    /* Full-page background image */
    .bg-image {
        background-image: url('https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/sellerloginpage.jpg');

        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

        background-size: cover; /* Ensures section is fully covered */
        background-position: center;
        background-repeat: no-repeat;
    }

    /* Authentication Box */
    .auth-box {
        background: rgba(255, 255, 255, 0.9); /* Light transparent background */
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        width: 490px;
        text-align: center;
        height:360px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .auth-box {
            width: 90%;
            padding: 30px;
        }
    }
</style>
</head>
<body>

    <!-- Navbar -->
           <nav class="navbar navbar-expand-lg" style="position:fixed;">
        <!-- Back Button -->
        <a href="javascript:history.back();" style="font-size: 17px; margin-right: 0px; color: black;">
           <i class="fa-solid fa-arrow-left"></i>
        </a>
        <!--<img src="{{asset('public/assets/images/banners/nb.jpg')}}">-->


        <!-- Logo -->
        <a class="navbar-brand" href="#" style="padding: 15px 11px;">
            <img src="{{ asset('public/assets/images/logo/logo_showloom.png') }}" class="logoimg" alt="Shoes">
        </a>
    
        <!-- Icons -->
        <div class="d-flex ml-auto align-items-center">
            <a href="#" class="text-light" style="font-size: 24px; font-weight: normal; margin-right: 20px;">
                <i class="fas fa-search"></i>
            </a>
            <a href="#" class="text-light" style="font-size: 24px; font-weight: normal; margin-right: 20px;">
                <i class="far fa-heart"></i>
            </a>
            <a href="#" class="text-light" style="font-size: 24px; font-weight: normal;">
                <i class="fa fa-shopping-bag"></i>
            </a>
        </div>
    </nav>

    <!-- Main Body -->
    <div class="container-fluid auth-container">
        <div class="row auth-section">
            <!-- Left Side (Full-Page Background Image) -->
            <div class="col-md-12 bg-image">
                <!-- Content Box in Center -->
                <div class="auth-box">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!--<div class="footer">-->
    <!--    <p>&copy; 2025 Your Company. All Rights Reserved.</p>-->
    <!--</div>-->

</body>
</html>
