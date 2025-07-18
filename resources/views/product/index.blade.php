@extends('layouts.product')
@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
     <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
     
    <style>
    
    
        .product-image {
            max-width: 100%;
            height: 435px;
        }
        .badge {
            font-size: 1rem;
        }
        .btn {
            font-size: 1rem;
        }
   
        .offer-section {
           
            padding: 15px 0;
        }
        .offer-section h6 {
            font-weight: bold;
            font-size: small;
        }
        .offer-section p {
            font-size: smaller;
        }

        .size-section, .details-section {
            margin-top: 20px;
        }
    
         .fixed-bottom-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            padding: 10px;
            z-index: 1030;
        }
        
        
        .fixed-bottom-navbar.unfixed {
          position: static;
          transform: translateY(0);
        }
        
        .row, .accordion-header, .accordion-content{
            background: #1f1f1f;
        }
        
        .wishlist-icon {
            color: white;
            cursor: pointer;
        }

        .wishlist-icon.selected {
            color: #dc3545;
        }
    </style>
    
    
    


    <div class="container">
        <div class="row align-items-center mb-3" style="margin-top:63px;">
            
            <!-- Product Image -->
        <div class="col-12 col-md-6 text-center mb-md-0 position-relative p-0">
         <!--Carousel -->
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
             
                    <div class="carousel-item active">
                        <img src="https://sslimages.shoppersstop.com/B8AC9759D45547D9AEF177F0DE13B7C8/img/03AB1657C5054B4C8B596E3DD81778CC/205412527_9100_03AB1657C5054B4C8B596E3DD81778CC.jpg" 
                             class="d-block w-100 product-image" alt="Product Image 1">
                    </div>
                   
                    <div class="carousel-item">
                        <img src="https://sslimages.shoppersstop.com/sys-master/images/hae/hc1/32373926985758/S24329070411GRE_GREEN.jpg_2000Wx3000H" 
                             class="d-block w-100 product-image" alt="Product Image 2">
                    </div>
                     
                    <div class="carousel-item">
                        <img src="https://sslimages.shoppersstop.com/sys-master/images/h4d/h8e/33774170013726/A24329070454GRE_GREEN.jpg_2000Wx3000H" 
                             class="d-block w-100 product-image" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="https://sslimages.shoppersstop.com/B8AC9759D45547D9AEF177F0DE13B7C8/img/03AB1657C5054B4C8B596E3DD81778CC/205412527_9100_03AB1657C5054B4C8B596E3DD81778CC.jpg" 
                             class="d-block w-100 product-image" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="https://sslimages.shoppersstop.com/B8AC9759D45547D9AEF177F0DE13B7C8/img/03AB1657C5054B4C8B596E3DD81778CC/205412527_9100_03AB1657C5054B4C8B596E3DD81778CC.jpg" 
                             class="d-block w-100 product-image" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="https://sslimages.shoppersstop.com/B8AC9759D45547D9AEF177F0DE13B7C8/img/03AB1657C5054B4C8B596E3DD81778CC/205412527_9100_03AB1657C5054B4C8B596E3DD81778CC.jpg" 
                             class="d-block w-100 product-image" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="https://sslimages.shoppersstop.com/B8AC9759D45547D9AEF177F0DE13B7C8/img/03AB1657C5054B4C8B596E3DD81778CC/205412527_9100_03AB1657C5054B4C8B596E3DD81778CC.jpg" 
                             class="d-block w-100 product-image" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQ0Wx_4ViOZ_RsdUPkPAnx4MBqjgSUojeWtNbVSR4ssn8F9u7MoTpomr-mVYOq6w2M7KsV4Ly3FgiWoH_b1iOqBEkSuBbiEWVNK97OtGI20JVO52ygpvMXUEH2-JyWtUaB3MlcaVw&usqp=CAc" 
                             class="d-block w-100 product-image" alt="Product Image 3">
                    </div>
                </div>
                 
            </div>
        
        
       <!-- Carousel Indicators (Dots) -->
                <div class="carousel-indicators" style="color:grey;">
                    <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

            <!-- Rating Badge -->
            <span class="badge bg-success me-2 position-absolute" 
                  style="bottom: 18px; right: 10px; background-color:#04AA6D; color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                4.1 <i class="bi bi-star-fill" style="font-size: 11px;"></i> | 55
            </span>
        
            <!-- GET IT IN 48 HOURS Tag -->
            <div class="position-absolute" 
                 style="bottom: 10px; left: 0px; background: var(--primary-color); color: black; padding: 4px 10px;  border-top-right-radius: 12px; border-bottom-right-radius: 12px; font-size: 14px; font-weight: bold; text-align: center; opacity: 0.8;">
                GET IT IN 48 HOURS
            </div>
            
          
    </div>
         
            <!-- Product Details -->
            <div class="col-12 col-md-6 text-light p-4 ">
                <h9 class="text-uppercase font-weight-bold">LEVIS</h9>
                <h6 class="fw-bold" style="margin-top: 3px;">Mens Round Neck Graphic Print T-Shirt</h6>
                
                <div >
                    <span class="h4 fw-bold">Rs. 319</span>
                    <span class="text-muted text-decoration-line-through">Rs. 799</span>
                    <span class="text-danger fw-bold">(60% OFF)</span><br>
                    <span>(Inclusive of all taxes)</span>
                </div>
            </div>
            
            </div>
            
                <div class="row text-light">
                    <div class="mb-4">
                        <h6>Check Delivery & Services :</h6>
                          <div class="input-group d-flex">
                              
                                    <input type="number" id="pincode" class="form-control mr-2" placeholder="Enter Your Pin Code"
                                    style="width:60%;" oninput="enforceLength(this)" required>
                                    <button class="btn" style="background-color: var(--primary-color); color: black;" onclick="validatePincode()">Check</button>
                                
                            </div>
                                <span id="error-message" class="p-2" style="color: red; display: none;">Enter Valid Pincode</span>
                    </div>
                    <br>
                    <img class="d-block w-100 mb-3" src="{{ $product }}" alt="First slide" style="height:90px;">
                    
                   
          
                </div>
             <!-- Size Section -->
        <div class="row mt-4 mb-4 size-section pt-4 pb-4 text-light" >
            
            <h5>Select Size</h5>
            <div class="d-flex mb-4" style="gap:1.5rem;">
                <button class="btn btn-outline-secondary  text-light border-light fs-2 m-1" style="font-weight: bold;">S</button>
                <button class="btn btn-outline-secondary  text-light border-light fs-2 m-1" style="font-weight: bold;">M</button>
                <button class="btn btn-outline-secondary  text-light border-light fs-2 m-1" style="font-weight: bold;">L</button>
                <button class="btn btn-outline-secondary  text-light border-light fs-2 m-1" style="font-weight: bold;">XL</button>
            </div>
            
            
            
            
            <h5>Select Color</h5>
            <div class="d-flex mb-2" style="gap: 1.5rem;">
                <!-- Color Buttons -->
                <button class="btn btn-outline-secondary border-black m-1" style="width: 40px; height: 40px; border-radius: 50%; background-color: red;" title="Red"></button>
                <button class="btn btn-outline-secondary border-black m-1" style="width: 40px; height: 40px; border-radius: 50%; background-color: blue;" title="Blue"></button>
                <button class="btn btn-outline-secondary border-black m-1" style="width: 40px; height: 40px; border-radius: 50%; background-color: green;" title="Green"></button>
                <button class="btn btn-outline-secondary border-black m-1" style="width: 40px; height: 40px; border-radius: 50%; background-color: yellow;" title="Yellow"></button>
            </div>
        </div>
  
        <!-- Offer Section -->
        <div class="row offer-section mt-4  text-light" >
            <div class="offer">
                <h6>Flat 300 Off</h6>
                <p>Applicable on your first order. Use code: MYNTRA300</p>
            </div>
            <div class="offer">
                <h6>Best Price: <span class="text-danger">₹239</span> <a href="#" style="color:var(--secondary-color);">VIEW PRODUCTS</a></h6>
                <p>Applicable on orders above Rs. 499 (only on first purchase)<br>
                Coupon code: SAVINGSPLUS<br>
                Coupon Discount: 25% off (Your total saving: Rs. 560)</p>
            </div>
            <div class="offer">
                <h6>10% Discount on Kotak Credit and Debit Cards <a href="#" style="color:var(--secondary-color);">T&C</a></h6>
                <p>Min Spend ₹3500, Max Discount ₹1000.</p>
            </div>
            <div class="offer">
                <h6>10% Discount on BOBCARD Credit Cards and Credit Card EMI <a href="#" style="color:var(--secondary-color);">T&C</a></h6>
                <p>Min Spend ₹3500, Max Discount ₹1000.</p>
            </div>
            <div class="offer">
                <h6>10% Discount on ICICI Bank Netbanking <a href="#" style="color:var(--secondary-color);">T&C</a></h6>
                <p>Min Spend ₹3000, Max Discount ₹1000.</p>
            </div>
        </div>

       

        
        
        <h4 class=" text-light mt-4 mb-0 row p-3">Product Information</h4>
        <div class="row mb-2">
            
          <div class="accordion" style="padding:0px; border: none;">
              
            <div class="accordion-item" style="background-color: #1f1f1f; border:none;">
                
              <button class="accordion-header d-flex justify-content-between">
                Section 1 
                <i class="fa-solid fa-angles-right fs-1"></i>
              </button>
              <div class="accordion-content px-4 text-light">
                <p>This is the content of section 1.</p>
              </div>
              
            </div>
            <div class="accordion-item" style="background-color: #1f1f1f; border:none;">
                
              <button class="accordion-header d-flex justify-content-between">
                Section 2 
                <i class="fa-solid fa-angles-right fs-1"></i>
              </button>
              <div class="accordion-content px-4 text-light">
                <p>This is the content of section 1.</p>
              </div>
              
            </div>
            <div class="accordion-item" style="background-color: #1f1f1f; border:none;">
                
              <button class="accordion-header d-flex justify-content-between">
                Section 3
                <i class="fa-solid fa-angles-right fs-1"></i>
              </button>
              <div class="accordion-content px-4 text-light">
                <p>This is the content of section 1.</p>
              </div>
              
            </div>
            
            
          </div>
        </div>


        
        
        
        
        
        
        </div>
    
         <!-- Bottom Navbar -->
        <div class=" fixed-bottom-navbar d-flex flex-row flex-md-row gap-3 " id="bottomNavbar" style="background-color:black; color:white; border:none;">
            
         <div class="btn btn-lg fs-5 text-light" style="flex: 0 0 40%; max-width: 40%; border: 1px solid white;">
        
                <i class="far fa-heart wishlist-icon" style="margin-right: 5px; font-size: 17px;" onclick="toggleWishlist(this)"></i>
                Wishlist

        </div>
         <a class="btn btn-lg fs-5 addtobag" 
               style="flex: 0 0 57%; max-width: 57%; background-color: var(--primary-color); color: black;" 
               onclick="toggleText(this)">
               Add to Bag
         </a>
        </div>

    
    <div class="container pr-0" style="background-color: #1f1f1f;">
    
        <!--Product -->
         <h4 class=" text-light">Similar Product's</h4>
          <div id="contentDiv"></div>
         <div style="padding-right: 0px; padding-left: 0px;">
            <div class="product-category-container">
                <!-- Category Product 1 -->
                <div class="product-item-card">
                    <img src="https://wittee.in/wp-content/uploads/2024/05/front-6645eb2a32f12-Black_S_Oversized_T-shirt.jpg"
                        class="category-image" alt="Item 1">
                    <div class="card-body product-item-card-body">
                        <h8 class="card-title">Product 1</h8>
                        <p class="card-text">Rs. 25.99</p>
                    </div>
                </div>
                <!-- Category Product 2 -->
                <div class="product-item-card">
                    <img src="https://styleunion.in/cdn/shop/products/LGT00074BLACK_1_c690fd76-88c3-4c38-846b-152fe002d4cc.jpg?v=1695053360&width=1200"
                        class="category-image" alt="Item 2">
                    <div class="card-body product-item-card-body">
                        <h8 class="card-title">Product 2</h8>
                        <p class="card-text">Rs. 25.99</p>
                    </div>
                </div>
                <!-- Category Product 3 -->
                <div class="product-item-card">
                    <img src="https://www.jiomart.com/images/product/original/rvl9cvytva/bruton-trendy-sports-shoes-for-men-blue-product-images-rvl9cvytva-0-202209021254.jpg?im=Resize=(600,750)"
                        class="category-image" alt="Item 3">
                    <div class="card-body product-item-card-body">
                        <h8 class="card-title">Product 3</h8>
                        <p class="card-text">Rs. 25.99</p>
                    </div>
                </div>
                <!-- Category Product 4 -->
                <div class="product-item-card">
                    <img src="https://img.faballey.com/images/Product/ILK00003Z/3.jpg" class="category-image"
                        alt="Item 4">
                    <div class="card-body product-item-card-body">
                        <h8 class="card-title">Product 4</h8>
                        <p class="card-text">Rs. 25.99</p>
                    </div>
                </div>
                <!-- Category Product 5 -->
                <div class="product-item-card">
                    <img src="https://m.media-amazon.com/images/I/81ysjTMD4BL._SY741_.jpg" class="category-image"
                        alt="Item 5">
                    <div class="card-body product-item-card-body">
                        <h8 class="card-title">Product 5</h8>
                        <p class="card-text">Rs. 25.99</p>
                    </div>
                </div>
                <!-- Category Product 6 -->
                <div class="product-item-card">
                    <img src="https://www.madish.in/cdn/shop/products/the-classic-skinny-high-waist-jeans-jeans-madish-light-blue-24-983958.jpg?v=1677730176&width=700"
                        class="category-image" alt="Item 6">
                    <div class="card-body product-item-card-body">
                        <h8 class="card-title">Product 6</h8>
                        <p class="card-text">Rs. 25.99</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    
   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         function toggleText(element) {
            if (element.textContent === "Go To Bag") {
                // Redirect to /addtocart
                window.location.href = "/addtocart";
            } else {
                // Change text to "Go To Bag"
                element.textContent = "Go To Bag";
                localStorage.setItem("bagButtonText", "Go To Bag"); // Store state in localStorage
            }
        }
        
        // Reset text when the page reloads
        window.onload = function() {
            let button = document.querySelector(".addtobag");
            if (button) {
                button.textContent = "Add to Bag"; // Reset text on reload
            }
        };
    </script>
    <script>

         document.addEventListener("scroll", () => {
          const contentDiv = document.getElementById("contentDiv");
          const navbar = document.getElementById("bottomNavbar");
        
          // Get the position of the content div relative to the viewport
          const contentRect = contentDiv.getBoundingClientRect();
          const contentBottom = contentRect.bottom;
        
          // Check if the bottom of the content div is above the viewport bottom
          if (contentBottom <= window.innerHeight) {
            // If the content is scrolled past, make the navbar static
            navbar.classList.add("unfixed");
          } else {
            // If the content is visible, keep the navbar fixed
            navbar.classList.remove("unfixed");
          }
        });


        // Accordian 
        
        document.addEventListener("DOMContentLoaded", () => {
          const accordionHeaders = document.querySelectorAll(".accordion-header");
        
          accordionHeaders.forEach(header => {
            header.addEventListener("click", () => {
              const content = header.nextElementSibling;
              const icon = header.querySelector("i");
        
              // Toggle content visibility
              const isVisible = content.style.display === "block";
              content.style.display = isVisible ? "none" : "block";
        
              // Toggle icon rotation
              icon.classList.toggle("rotate", !isVisible);
            });
          });
        });
        
        
    </script>

    
        <script>
        // Toggle wishlist icon color
        function toggleWishlist(icon) {
            icon.classList.toggle('selected');
        }
    </script>
    
    
        <script>
            function enforceLength(input) {
                let value = input.value;
            
                // Remove non-numeric characters (for safety)
                value = value.replace(/\D/g, '');
            
                // Enforce max length of 6
                if (value.length > 6) {
                    value = value.slice(0, 6);
                }
            
                input.value = value;
            }
            
            function validatePincode() {
                let pincode = document.getElementById("pincode").value;
                let errorMessage = document.getElementById("error-message");
            
                // Check if pincode length is exactly 6
                if (pincode.length !== 6) {
                    errorMessage.style.display = "flex";
                } else {
                    errorMessage.style.display = "none";
                    // alert("Pincode is valid!"); // Replace with your logic
                }
            }
        </script>
@endsection