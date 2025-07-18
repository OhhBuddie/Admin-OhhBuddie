<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupon Input</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 
    <style>
         .navbar-fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: black;
        }

        .header {
              padding: 16px;
              font-size: 14px;
              font-weight: bold;
            }
        .coupon-box {
            display: flex;
            align-items: center;
            background: black;
            padding: 15px;
                margin-top: 50px;
            
        }
        .coupon-box input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 14px;
            color: white;
            background: black;
            border-left: 1px solid white;
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            padding: 7px;
        }
        .coupon-box button {
            border: none;
            background: none;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            border-right: 1px solid white;
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            padding: 7px;
        }
        



        .coupon-details {
          
            color:white;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        }


        .coupon-title {
            color: var(--primary-color);
            font-weight: bold;
            display: flex;
            align-items: center;
            margin-left: 8px;
        }

        .coupon-title input {
            margin-right: 5px;
        }

        /* Fixed Bottom Navbar */
        .bottom-navbar {
            position: fixed;
            /*bottom: 0;*/
            left: 0;
            width: 100%;
            background: black;
         
            display: flex;
            justify-content: space-between;
            padding: 15px;
            align-items: center;
        }

        .bottom-navbar span {
            font-size: 16px;
            font-weight: bold;
            color: white;
        }

        .bottom-navbar button {
            background: var(--primary-color);
            color: black;
            border: none;
            padding: 10px 70px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        

    </style>
</head>
<body>
        <div class="d-flex justify-content-between align-items-center px-3 navbar-fixed-top text-light">
            <div class="d-flex align-items-center">
                <!-- Back Button -->
                <a href="javascript:history.back();" style="font-size: 22px; margin-right: 0px; color: black;">
                   <i class="fa-solid fa-arrow-left text-light"></i>
                </a>    
                <div class="header">COUPONS</div>
            </div>
          
        </div>
    
    <div class="coupon-box">
        
        <input type="text" placeholder="Enter coupon code">
        <button>CHECK</button>
    </div>
    
    
        <div class="coupon-details">
        <div class="coupon-title mb-2">
            <input type="checkbox" checked>
            <span  class="mx-2 py-2 px-3" style="border: 1px solid var(--primary-color);">SUPERSAVER</span>
        </div>
        <span class="mx-4 px-2"><strong>Save ₹182</strong></span>
        <span class="mx-4 px-2">10% off on minimum purchase of Rs. 1199.</span>
        <span class="mx-4 px-2">Expires on: 31st January 2025</span>
    </div>
    
    
    <!-- Fixed Bottom Navbar -->
        <div class="bottom-navbar">
            <span>Maximum savings: ₹182</span>
            <button>APPLY</button>
        </div>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
