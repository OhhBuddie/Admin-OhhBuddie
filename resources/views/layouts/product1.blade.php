<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Page</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Wishlist Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



    
</head>

<body>
        <nav class="navbar navbar-expand-lg" style="position:fixed;">
        <!-- Back Button -->
        <a href="javascript:history.back();" style="font-size: 17px; margin-right: 0px; color: white;">
           <i class="fa-solid fa-arrow-left"></i>
        </a>
    
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

   
        @yield('content')
   






         


    <!-- Bootstrap JS Bundle -->
    <!-- Font Awesome JS -->
    <script>
        // Toggle wishlist icon color
        function toggleWishlist(icon) {
            icon.classList.toggle('selected');
        }
    </script>
    
  
</body>

</html>