@extends('layouts.order')
@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Page</title>
    
   
    <style>
    body{
        background-color: black;
    }
    .search-container {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 5px;
      margin-top: 64px;
      background: #1f1f1f;
   
    }
  
    .input-group-text {
      /*border: none;*/
      color:white;
      background-color: #1f1f1f;
    }
    .input-group{
        display:flex;
        flex-wrap: nowrap;
    }
    .input-group-text i {
      color: white;
    }
    .filter-button {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 8px 15px;
      font-size: 12px;
     
      border-radius: none;
      background: var(--primary-color);
    }
    .filter-button i {
      font-size: 12px;
    }
  </style>

  <style>
    .refund-section {
      padding: 15px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
      background: #1f1f1f;
      color:white;
      margin: 6px 0px 0px 0px;
    }
    .refund-header {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .refund-header i {
      font-size: 19px;
      color: white;
    }
    .refund-header .status-text {
      font-weight: bold;
      
    }
    .refund-header .amount {
      font-weight: bold;

    }
    .refund-details a {
      color: var(--secondary-color);
      font-weight: bold;
      text-decoration: none;
    }
    .product-section {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-top: 15px;
   
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
      padding: 0px 10px 0px 10px;
    }
    .product-image img {
      width: 55px;
      height: 100%;
      border-radius: 4px;
    }
    .product-info {
      flex-grow: 1;
    }
    .product-info .brand {
      font-weight: bold;
      
    }
    .product-info .name {
      font-size: 14px;
      
      margin: 5px 0;
    }
    .product-info .size {
      font-size: 14px;
      
    }
    .rating-section {
      margin-top: 15px;
      text-align: center;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }
    .rating-section .fa-star {
      font-size: 13px;
     
      cursor: pointer;
    }
    .rating-section .fa-star:hover,
    .rating-section .fa-star.selected {
      color: #ffc107;
    }
    .rating-text {
      font-size: 14px;
      margin-top: 5px;
    }
  </style>


    <div class="search-container">
      <!-- Search Bar -->
      <div class="input-group">
        <span class="input-group-text">
          <i class="fas fa-search"></i>
        </span>
        <input type="text" class="form-control" placeholder="Search here..." aria-label="Search" style=" color:white; background-color: #1f1f1f;">
        <button class="btn btn-search" style="background-color:var(--primary-color); color: black; border-radius: unset;">
          Search
        </button>
      </div>

      <!-- Filter Button -->
      <button class="filter-button">
        <i class="fas fa-filter"></i>
        FILTER
      </button>
    </div>
  

    <!--Refund Section 1 -->
    <div class="refund-section">
      <!-- Refund Header -->
      <div class="refund-header">
        <i class="fas fa-undo"></i>
        <div>
          <div class="status-text">Refund Credited</div>
          <div>Your refund of <span class="amount">₹174.00</span> for the return has been processed successfully on Fri, 7 Apr.</div>
          <div class="refund-details"><a href="#">View Refund details</a></div>
        </div>
      </div>

      <!-- Product Section -->
      <div class="product-section">
        <div class="product-image">
          <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQEon8MjmwRYyciqn-YGSmqPhCXt8raXtjsLwk_ivp6sfSV6t8m6rH9RFrw9q3G1n-R7bu0qT698REyAZ2UxrZkMwkE1gNTggxdH0S2EoValP4qN1Gw4dTyXA1HWnkI50AiIOJLE10&usqp=CAc" alt="Product">
        </div>
        <div class="product-info">
          <div class="brand">HERE&NOW</div>
          <div class="name">Men White & Red Printed Round Neck T-shirt</div>
          <div class="size">Size: S</div>
        </div>
        <i class="fas fa-chevron-right"></i>
      </div>

      <!-- Rating Section -->
      <div class="rating-section">
        <i class="fas fa-star" onclick="selectRating(1)"></i>
        <i class="fas fa-star" onclick="selectRating(2)"></i>
        <i class="fas fa-star" onclick="selectRating(3)"></i>
        <i class="fas fa-star" onclick="selectRating(4)"></i>
        <i class="fas fa-star" onclick="selectRating(5)"></i>
        <div class="rating-text">Rate & Review to <b>earn ShowLoom Credit</b></div>
      </div>
    </div>
    
    <!--Refund Section 2 -->
    <div class="refund-section">
      <!-- Refund Header -->
      <div class="refund-header">
    <!--    <img src="https://img.icons8.com/?size=100&id=ml9xx09fqQjH&format=png&color=000000" style="width: 25px;-->
    <!--height: 24px;">-->
    <i class='fas fa-shipping-fast' style='font-size:18px;color:white'></i>
        <div>
          <div class="status-text" style="color:#04AA6D;">Delivered</div>
          <div style="font-size: 13px;">On Mon, January 14</div>
        </div>
      </div>

      <!-- Product Section -->
      <div class="product-section">
        <div class="product-image">
          <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQEon8MjmwRYyciqn-YGSmqPhCXt8raXtjsLwk_ivp6sfSV6t8m6rH9RFrw9q3G1n-R7bu0qT698REyAZ2UxrZkMwkE1gNTggxdH0S2EoValP4qN1Gw4dTyXA1HWnkI50AiIOJLE10&usqp=CAc" alt="Product">
        </div>
        <div class="product-info">
          <div class="brand">HERE&NOW</div>
          <div class="name">Men White & Red Printed Round Neck T-shirt</div>
          <div class="size">Size: S</div>
        </div>
        <i class="fas fa-chevron-right"></i>
      </div>

      <!-- Rating Section -->
      <div class="rating-section">
        <i class="fas fa-star" onclick="selectRating(1)"></i>
        <i class="fas fa-star" onclick="selectRating(2)"></i>
        <i class="fas fa-star" onclick="selectRating(3)"></i>
        <i class="fas fa-star" onclick="selectRating(4)"></i>
        <i class="fas fa-star" onclick="selectRating(5)"></i>
        <div class="rating-text">Rate & Review to <b>earn ShowLoom Credit</b></div>
      </div>
    </div>
 

  <script>
    const stars = document.querySelectorAll('.fa-star');
    function selectRating(rating) {
      stars.forEach((star, index) => {
        star.classList.toggle('selected', index < rating);
      });
    }
  </script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->

@endsection