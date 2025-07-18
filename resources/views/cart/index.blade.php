<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Shopping Bag</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f8f8f8;
      /*padding: 20px;*/
    }

    .shopping-bag {
    
      /*max-width: 400px;*/
      /*margin: 0 auto;*/
      background-color: black;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    
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

    .delivery-section {
      padding: 8px 16px 8px 16px;
      /*border-bottom: 1px solid #ddd;*/
      /*margin-top: 42px;*/
    }

    .delivery-section p {
      margin: 8px 0;
      font-size: 14px;
      color: white;
    }

    /*Cart Product */

    .cart-items {
      padding: 0px 16px;
      display: none;
    }
    .cart-items.active {
      display: flex;
      flex-direction: column;
    }

    .cart-item {
      display: flex;
      border-bottom: 1px solid #ddd;
      padding: 16px 0;
    }

    .cart-item img {
      width: 95px;
      height: 114px;
      border-radius: 4px;
      margin-right: 16px;
    }

    .item-details {
      flex: 1;
    }

    .item-details h4 {
      font-size: 14px;
      color:white;
      margin-bottom: 8px;
    }

    .item-details p {
      font-size: 12px;
      color: white;
      margin-bottom: 4px;
    }

    .price {
      font-size: 14px;
      font-weight: bold;
      color: white;
    }

    .discount {
      font-size: 12px;
      
    }

    .delivery-info {
      font-size: 12px;
      color: white;
      margin-top: 8px;
    }
    

    .cart-item-img {
         position: relative; /* Make this the reference for the checkbox */
    }

    .coupon{
        margin-top: 17px;
    margin-bottom: 17px;
    }



    

    .footer {
      /*padding: 16px;*/
      display: flex;
      justify-content: space-between;
      align-items: center;
      /*border-top: 1px solid #ddd;*/
      
      
      position: fixed;
      bottom: -2px;
      left: 0;
      right: 0;
      z-index: 1030;
      background: black;
      padding: 8px;
      /*box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);*/
    }

    .footer .total {
      font-size: 14px;
      font-weight: bold;
      color: white;
      margin-left: 10px;
    }

    .footer button {
      padding: 10px 16px;
      background-color: #efc475;
      color: black;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }

    .footer button:hover {
      background-color: #08ADC5;
    }
    
    
    .suggested-section {
      padding: 16px 0px 16px 16px;
    }

    .suggested-section h3 {
      font-size: 16px;
      color: white;
      margin-bottom: 16px;
      
    }

    .suggested-products {
      display: flex;
      overflow-x: auto;
      scrollbar-width: none;
      gap: 16px;
    }

    .product-card {
      min-width: 120px;
      background-color: black;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 8px;
      text-align: center;
    }

    .product-card img {
      width: 100%;
      height: auto;
      border-radius: 4px;
    }

    .product-card h4 {
      font-size: 14px;
      color: white;
      margin: 8px 0;
    }

    .product-card p {
      font-size: 12px;
      color: white;
    }

    .product-card .price {
      font-size: 14px;
      color: white;
      font-weight: bold;
    }

    .product-card .discount {
      font-size: 12px;
      color: white;
    }

  </style>
  
  
    <style>
        .modal.bottom-modal .modal-dialog {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0;
            
        }
        .modal.bottom-modal .modal-content {
            border-radius: 0.5rem 0.5rem 0 0;
        }
    </style>
    
     <style>
    .offers-section {
      padding: 15px;
      color:white;
        
    }

    .offers-section h4 {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .offer-item {
      font-size: 13px;
      /*color: #555;*/
      margin-top: 7px;
    }

    .offer-item.hidden {
      display: none;
    }

    .show-more-btn {
      color: #08ADC5;
      font-size: 14px;
      cursor: pointer;
      text-decoration: none;
    }

    .icon {
      width: 20px;
      height: 20px;
      display: inline-block;
      background-color: #000;
      border-radius: 50%;
      color: #fff;
      font-size: 17px;
      text-align: center;
      line-height: 20px;
      /*margin-right: 8px;*/
    }
  </style>
    <style>
 .tabs {
  display: flex;
  /*border-bottom: 2px solid #ddd;*/
  margin-top: 59px;
  font-family: Arial, sans-serif;
}

.tab {
  
  cursor: pointer;
  flex: 1;
  font-weight: bold;
  font-size: 15px;
  text-transform: uppercase;
  color: #333;
  position: relative;
  transition: all 0.3s ease;
  /*border-radius: 4px 4px 0 0;*/
  background-color: #f9f9f9;
  /*margin-right: 5px;*/
}

.tab:hover {
  background-color: #f0f0f0;
}

.tab.active {
  background-color: #efc475;
  color: black;
  border-bottom: 2px solid #efc475;
  box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
}

/*.badge {*/
/*  background-color: #08ADC5;*/
/*    color: white;*/
/*    border-radius: 50%;*/
/*    padding: 2px 6px;*/
/*    font-size: 12px;*/
/*    margin-left: 10px;*/
    /*position: absolute;*/
    /*top: 6px;*/
    /*right: 63px;;*/
/*}*/


        .price-details {
            background: black;
            /*border: 1px solid #ddd;*/
            border-radius: 5px;
            padding: 15px 20px;
            /*max-width: 400px;*/
            margin: 4px 0px 60px 0px;
        }
        .price-details .title {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
            color: white;
        }
        .price-details .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .price-details .row span {
            font-size: 14px;
        }
        .price-details .row span.text-success {
            color: #34a853;
            font-weight: 500;
        }

        .price-details .row:last-child {
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
        }
        .price-details .terms {
            margin-top: 15px;
            font-size: 12px;
            color: white;
        }
        .price-details .terms a {
            color: #08ADC5;
            text-decoration: none;
            font-weight: 600;
        }
        
        .card-text{
            font-size: 13px;
        }
    </style>


<style>
  /* Container styling */
  .dropdown-container {
    position: relative;
    display: inline-block;
  }

  /* Toggle button */
  .dropdown-toggle {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
  }

  .dropdown-toggle::after {
    display: none;
  }

  /* Dropdown menu styling */
  .dropdown-menu {
    display: none;
    position: absolute;
    top: 30px;
    right: 0;
    background-color: black;
    color: white;
    border: 1px solid lightgray;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    min-width: 120px;
    overflow: hidden;
  }

  /* Dropdown item */
  .dropdown-item {
    width: 100%;
    padding: 6px 12px;
    text-align: left;
    background: none;
    border: none;
    font-size: 14px;
    color: white;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }

  /* Hover effect */
  .dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }

  /* Specific styles for different actions */
  .dropdown-item.edit {
    color: #007bff;
  }

  .dropdown-item.delete {
    color: #dc3545;
  }

  .dropdown-item.default {
    color: #28a745;
  }
</style>


    <!--Size and Qty Dropdown -->
     <style>
         select {
            background: black;
            color: white;
            border: none;
            /*padding: 5px;*/
            font-size: 12px;
            outline: none;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    
    
    

    <div class="shopping-bag">
        
    <div class="d-flex justify-content-between align-items-center px-3 navbar-fixed-top text-light">
            <div class="d-flex align-items-center">
                <!-- Back Button -->
                <a href="javascript:history.back();" style="font-size: 22px; margin-right: 0px; color: black;">
                   <i class="fa-solid fa-arrow-left text-light"></i>
                </a>    
                <div class="header">SHOPPING BAG</div>
            </div>
            <div>Step 1/3</div>
    
    </div>
    
    
    <div class="tabs">
        <div class="tab active d-flex align-items-center justify-content-center py-2" onclick="switchTab('buy-it-now')">
           <span style="font-size: 12px;"> Buy It Now </span> 
            <span id="buy-it-now-count"  style="color:black; font-size: 12px;  margin-left: 5px;">(2)</span>
        </div>
        <div class="tab d-flex align-items-center justify-content-center  py-2" onclick="switchTab('try-it-now')">
           <span style="font-size: 12px;"> Try It Now </span> 
            <span id="try-it-now-count" style="color:black;font-size: 12px; margin-left: 5px;">(2)</span>
        </div>
    </div>
    
    
    
    <div class="delivery-section d-flex justify-content-between align-items-center">
            <div id="selected-address">
                <p>Deliver to: <strong>{{ $address[0]->name }}, {{ $address[0]->pincode }}</strong></p>
                <p style="font-size:12px;">{{ $address[0]->address_line_1 }}, {{ $address[0]->address_line_2 }}, {{ $address[0]->pincode }}</p>
            </div>
            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addressModal" style="color:#08ADC5;">Change</a>
    </div>
    
     
     
    <!--Modal For Change Adress Button -->

    <div class="modal fade bottom-modal" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content text-light"  style="background-color:black;">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Select Delivery Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:#efc475; opacity: 1;"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode">
                            <button class="btn" style="background-color:#efc475;">Check</button>
                        </div> 
                    </div>    
                    <div style="max-height: 275px; overflow-y: auto; scrollbar-width:none;">
                        
        <!-- Address 1 -->
               @foreach($address as $index => $addr)
                <div class="card mt-3" style="background-color: black; color:white; border: 1px solid white;">
                    <div class="card-body d-flex align-items-start">
                        <!-- Radio Button -->
                        <div class="form-check me-3">
                            <input class="form-check-input address-radio" type="radio" name="address" 
                                id="address{{$index}}" 
                                data-name="{{ $addr->name }}"
                                data-pincode="{{ $addr->pincode }}"
                                data-address1="{{ $addr->address_line_1 }}"
                                data-address2="{{ $addr->address_line_2 }}"
                                {{ $loop->first ? 'checked' : '' }}
                                onchange="updateSelectedAddress(this)">
                        </div>
                
                        <!-- Address Details -->
                        <div style="width: 100%;">
                            <div class="card-title d-flex justify-content-between" style="font-size:12px;">
                                {{$addr->name}} 
                                    @if($addr->is_default == 1)
                                         (Default)
                                    @endif
                              
                                <span class="btn btn-outline-light btn-sm" style="font-size:10px; width: 70px; margin-right: 28px;">
                                    @if($addr->type == 'work')
                                        <i class="fa fa-briefcase"></i>
                                    @else
                                        <i class="fa fa-home"></i>
                                    @endif
                                    {{$addr->type}} 
                                </span>
                            </div>
                            <p class="card-text">
                                {{$addr->address_line_1}}<br>
                                {{$addr->address_line_2}} - {{$addr->pincode}}<br>
                                Mobile: {{$addr->phone}}
                            </p>
                            <div class="d-flex justify-content-between">
                                <!-- Delivering Here Button -->
                                <button class="btn btn-sm delivering-here-btn" 
                                        style="display: {{ $loop->first ? 'inline-block' : 'none' }}; background-color:#efc475;">
                                    Delivering Here
                                </button>
                            </div>
                        </div>
                
                        <!-- Three-Dot Menu -->
                <div class="dropdown-container">
                    <button type="button" class="dropdown-toggle" onclick="toggleDropdown(event, this)">⋮</button>
                    <div class="dropdown-menu" style="display: none;">
                        <button class="dropdown-item edit">Edit</button>
                        <button class="dropdown-item delete">Delete</button>
                        <button class="dropdown-item default" onclick="makeDefault('address{{$index}}')">Make Default</button>
                    </div>
                </div>

                    </div>
                </div>
                @endforeach



                
                <!-- Address 2 -->
                <!--<div class="card mt-3" style="background-color: black; color:white; border: 1px solid white; position: relative;">-->
                <!--  <div class="card-body d-flex align-items-start">-->
                <!--     Radio Button -->
                <!--    <div class="form-check me-3">-->
                <!--      <input class="form-check-input address-radio" type="radio" name="address" id="address2">-->
                <!--    </div>-->
                
                <!--     Address Details -->
                <!--    <div style="width: 100%;">-->
                <!--      <div class="card-title d-flex justify-content-between" style="font-size:12px;">-->
                <!--        Aakash Das-->
                <!--        <span class="btn btn-outline-light btn-sm" style="font-size:10px; width: 70px; margin-right: 28px;">-->
                <!--          <i class="fa fa-briefcase"></i> Work-->
                <!--        </span>-->
                <!--      </div>-->
                <!--      <p class="card-text">-->
                <!--        123, Park Street<br>-->
                <!--        Kolkata, West Bengal - 700001<br>-->
                <!--        Mobile: 9876543210-->
                <!--      </p>-->
                <!--       Delivering Here Button -->
                <!--      <button class="btn btn-sm delivering-here-btn" style="display: none; background-color:#efc475;">Delivering Here</button>-->
                <!--    </div>-->
                
                <!--     Three-Dot Menu -->
                <!--    <div class="dropdown-container">-->
                <!--      <button class="dropdown-toggle" onclick="toggleDropdown(this)">⋮</button>-->
                <!--      <div class="dropdown-menu" style="display: none;">-->
                <!--        <button class="dropdown-item edit">Edit</button>-->
                <!--        <button class="dropdown-item delete">Delete</button>-->
                <!--        <button class="dropdown-item default" onclick="makeDefault('address2')">Make Default</button>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
        </div>
                    
                    <!--Add More Address Button -->
                    <div class="modal-footer row pb-0" style="border-top:0px;">
                    <a href="/address" type="button" class="btn"  style="background-color:#efc475;">Add New Address</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div id="buy-it-now" class="cart-items active">
          <div class="cart-item">
            <div class="cart-item-img">
              <img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcS9wf3LfpAlgmd1Etd1loe8eB_Op0N9iM5c2GCy5qkUdvqcI7K-R3RhZCjbQF3DzTpzphd6D4k0KCvz10LyTv_Zsrdpxrt9NkDmsX-GOl3uIH9koXQLxyru" alt="Product Image">
              <input class="form-check-input" type="checkbox" id="defaultAddress" style="position: absolute; left: 0;">
            </div>
            <div class="item-details">
              <h4>Mens Jeans</h4>
              <!--<p>Size: Onesize | Qty: 1</p>-->
              
                <div class="d-flex">
                   <p style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Size: 
                        <select>
                            <option value="onesize" style="font-size:10px;">Onesize</option>
                            <option value="small" style="font-size:10px;">Small</option>
                            <option value="medium" style="font-size:10px;">Medium</option>
                            <option value="large" style="font-size:10px;">Large</option>
                        </select> 
                    </p>
                    
                   <p  style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Quantity: 
                        <select>
                            <option value="onesize" style="font-size:10px;">1</option>
                            <option value="small" style="font-size:10px;">2</option>
                            <option value="medium" style="font-size:10px;">3</option>
                            <option value="large" style="font-size:10px;">4</option>
                        </select> 
                    </p>
                </div>

                
              <p class="price">Rs. 949 <span class="discount"><strike style="color:grey;">Rs. 1000</strike> 20000 OFF</span></p>
              <p>Coupon Discount: Rs. 150</p>
              <p class="delivery-info">Delivery between 25 Jan - 26 Jan</p>
            </div>
             <!--<button class="remove-product" onclick="removeProduct(this)">×</button>-->
          </div>
        
          <div class="cart-item">
            <div class="cart-item-img">
              <img src="https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/311850/01/sv01/fnd/IND/fmt/png/Softride-Premier-one8-Res-Unisex-Running-Shoes" alt="Product Image">
              <input class="form-check-input" type="checkbox" id="defaultAddress" style="position: absolute; left: 0;">
            </div>
            <div class="item-details">
              <h4>Puma</h4>
              <!--<p>Size: 9 | Qty: 1</p>-->
              
               <div class="d-flex">
                   <p style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Size: 
                        <select>
                            <option value="onesize" style="font-size:10px;">Onesize</option>
                            <option value="small" style="font-size:10px;">Small</option>
                            <option value="medium" style="font-size:10px;">Medium</option>
                            <option value="large" style="font-size:10px;">Large</option>
                        </select> 
                    </p>
                    
                   <p  style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Quantity: 
                        <select>
                            <option value="onesize" style="font-size:10px;">1</option>
                            <option value="small" style="font-size:10px;">2</option>
                            <option value="medium" style="font-size:10px;">3</option>
                            <option value="large" style="font-size:10px;">4</option>
                        </select> 
                    </p>
                </div>
                
              <p class="price">Rs. 1,999 <span class="discount"><strike style="color:grey;">Rs. 4,999</strike> 60% OFF</span></p>
              <p>Coupon Discount: Rs. 150</p>
              <p class="delivery-info">Delivery between 26 Jan - 28 Jan</p>
            </div>
            <!--<button class="remove-productt" onclick="removeProduct(this)">×</button>-->
          </div>
    </div>
    
    <div id="try-it-now" class="cart-items">
          <div class="cart-item">
            <div class="cart-item-img">
              <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA" alt="Product Image">
              <input class="form-check-input" type="checkbox" id="defaultAddress" style="position: absolute; left: 0;">
            </div>
            <div class="item-details">
              <h4>Mens Jeans</h4>
              <!--<p>Size: Onesize | Qty: 1</p>-->
              
               <div class="d-flex">
                   <p style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Size: 
                        <select>
                            <option value="onesize" style="font-size:10px;">Onesize</option>
                            <option value="small" style="font-size:10px;">Small</option>
                            <option value="medium" style="font-size:10px;">Medium</option>
                            <option value="large" style="font-size:10px;">Large</option>
                        </select> 
                    </p>
                    
                   <p  style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Quantity: 
                        <select >
                            <option value="onesize" style="font-size:10px;">1</option>
                            <option value="small" style="font-size:10px;">2</option>
                            <option value="medium" style="font-size:10px;">3</option>
                            <option value="large" style="font-size:10px;">4</option>
                        </select> 
                    </p>
                </div>
              <p class="price">Rs. 949 <span class="discount"><strike style="color:grey;">Rs. 2,625</strike> 1,676 OFF</span></p>
              <p>Coupon Discount: Rs. 150</p>
              <p class="delivery-info">Delivery between 25 Jan - 26 Jan</p>
            </div>
             <!--<button class="remove-product" onclick="removeProduct(this)">×</button>-->
          </div>
        
          <div class="cart-item">
            <div class="cart-item-img">
              <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA" alt="Product Image">
              <input class="form-check-input" type="checkbox" id="defaultAddress" style="position: absolute; left: 0;">
            </div>
            <div class="item-details">
              <h4>Puma</h4>
              <!--<p>Size: 9 | Qty: 1</p>-->
              
               <div class="d-flex">
                   <p style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Size: 
                        <select>
                            <option value="onesize" style="font-size:10px;">Onesize</option>
                            <option value="small" style="font-size:10px;">Small</option>
                            <option value="medium" style="font-size:10px;">Medium</option>
                            <option value="large" style="font-size:10px;">Large</option>
                        </select> 
                    </p>
                    
                   <p  style="border: 1px solid white; padding-left: 5px;  border-radius: 13px; margin-right: 10px;">Quantity: 
                        <select>
                            <option value="onesize" style="font-size:10px;">1</option>
                            <option value="small" style="font-size:10px;">2</option>
                            <option value="medium" style="font-size:10px;">3</option>
                            <option value="large" style="font-size:10px;">4</option>
                        </select> 
                    </p>
                </div>
                
              <p class="price">Rs. 1,999 <span class="discount"><strike style="color:grey;">Rs. 4,999</strike> 60% OFF</span></p>
              <p>Coupon Discount: Rs. 150</p>
              <p class="delivery-info">Delivery between 26 Jan - 28 Jan</p>
            </div>
            <!--<button class="remove-productt" onclick="removeProduct(this)">×</button>-->
          </div>
    </div>
    
    <div class="offers-section">
        <h4>
            <span class="icon">%</span> Available Offers
        </h4>
        <!-- Default visible offer -->
        <div class="offer-item">10% Instant Discount on BOBCARD Credit Card and Credit Card EMI on a min spend of Rs. 3,500. TCA</div>
        <!-- Hidden offers -->
        <div class="offer-item hidden">5% Cashback on all purchases above Rs. 2,000 using XYZ Bank Debit Card.</div>
        <div class="offer-item hidden">Flat Rs. 500 off on your first purchase above Rs. 10,000 with ABC Card.</div>
        <div class="offer-item hidden">Flat Rs. 500 off on your first purchase above Rs. 10,000 with ABC Card.</div>
        <div class="offer-item hidden">Flat Rs. 500 off on your first purchase above Rs. 10,000 with ABC Card.</div>
        <div class="offer-item hidden">Flat Rs. 500 off on your first purchase above Rs. 10,000 with ABC Card.</div>
        <div class="offer-item hidden">Flat Rs. 500 off on your first purchase above Rs. 10,000 with ABC Card.</div>
        <div class="offer-item hidden">Flat Rs. 500 off on your first purchase above Rs. 10,000 with ABC Card.</div>
        <!-- Show More/Less button -->
        <div class="show-more-btn mt-2" onclick="toggleOffers()">Show More</div>
    </div>

 


   <div class="suggested-section">
    <h3>You May Also Like:</h3>
    <div class="suggested-products">
      <div class="product-card">
        <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA" alt="Product 1">
        <br>
        <span class="price">Rs. 499</span><br>
        <span class="discount"><strike style="color:grey;">Rs. 999</strike> 50% OFF</span>
        </div>
      <div class="product-card">
        <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA" alt="Product 1">
        <br>
        <span class="price">Rs. 499</span><br>
        <span class="discount"><strike style="color:grey;">Rs. 999</strike> 50% OFF</span>
        </div>
      <div class="product-card">
        <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA" alt="Product 1">
        <br>
        <span class="price">Rs. 499</span><br>
        <span class="discount"><strike style="color:grey;">Rs. 999</strike> 50% OFF</span>
        </div>
    </div>
  </div>
  
   
  
  <div class="coupon" >
  
    <div class="d-flex align-items-center">
        
     <img style="width: 20px;
    transform: rotate(45deg); margin-left:17px;" src="https://w7.pngwing.com/pngs/62/407/png-transparent-coupon-computer-icons-discounts-and-allowances-voucher-clear-choice-cannabis-term-thumbnail.png" alt="Product 1">
    <div class="py-2 px-3" style="font-size: 13px; color:white;">Apply Coupons </div>
   
    <i class="fa-solid fa-angles-right" style="font-size: 22px;
    position: absolute;
    right: 18px;  color:white;"></i>
    </div>
      

  </div>
  
  
   
  
  
  
  <div class="price-details  text-light">
            <div class="title">PRICE DETAILS (2 Items)</div>
            <div class="d-flex justify-content-between" style="font-size: 13px;">
                <span>Total MRP</span>
                <span>Rs. 5,000</span>
            </div>
            <div class="d-flex justify-content-between" style="font-size: 13px;">
                <span>Discount on MRP</span>
                <span class="text-success">- Rs. 1,666</span>
            </div>
            <div class="d-flex justify-content-between" style="font-size: 13px;">
                <span>Platform Fee </span>
                <span class="text-success">FREE</span>
            </div>
            <div class="d-flex justify-content-between" style="font-size: 13px;">
                <span>Shipping Fee </span>
                <span class="text-success">FREE</span>
            </div>
            <div class="d-flex justify-content-between" style="font-size: 13px;">
                <span>Total Amount</span>
                <span>Rs. 1,800</span>
            </div>
            <div class="terms" style="text-align: center;">
                By placing the order, you agree to ShowLoom's <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
            </div>
    </div>


  <div class="footer">
    <div class="total">2 Items Selected (Rs. 2,818)</div>
    <button>Place Order</button>
  </div>
</div>

 <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    
  
    <script>
        function toggleOffers() {
          // Get all hidden offer items
          const hiddenOffers = document.querySelectorAll('.offer-item.hidden');
          // Get the "Show More" button
          const showMoreBtn = document.querySelector('.show-more-btn');
        
          // Check if any offer has the "hidden" class
          const isHidden = hiddenOffers.length > 0 && hiddenOffers[0].classList.contains('hidden');
        
          if (isHidden) {
            // Show all hidden offers
            hiddenOffers.forEach((offer) => offer.classList.remove('hidden'));
            // Change button text to "Show Less"
            showMoreBtn.textContent = 'Show Less';
          } else {
            // Hide all offers except the first one
            const allOffers = document.querySelectorAll('.offer-item');
            allOffers.forEach((offer, index) => {
              if (index > 0) {
                offer.classList.add('hidden');
              }
            });
            // Change button text back to "Show More"
            showMoreBtn.textContent = 'Show More';
          }
        }
    </script>



   
    <script>
       // Switch Tab Function
        function switchTab(tabId) {
            
            // Hide all tab content
            const tabContents = document.querySelectorAll('.cart-items');
            tabContents.forEach(content => content.classList.remove('active'));
        
            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
        
            // Show the selected tab content
            const activeTabContent = document.getElementById(tabId);
            activeTabContent.classList.add('active');
        
            // Add active class to the clicked tab
            const activeTab = document.querySelector(`.tab[onclick="switchTab('${tabId}')"]`);
            activeTab.classList.add('active');
        }


    </script>
    
    
    <script>
    
        document.addEventListener("DOMContentLoaded", function () {
            let savedAddressId = localStorage.getItem("selectedAddress");
        
            // Find the saved address radio button and check it
            if (savedAddressId) {
                let savedRadioButton = document.getElementById(savedAddressId);
                if (savedRadioButton) {
                    savedRadioButton.checked = true;
                    updateSelectedAddress(savedRadioButton);
                }
            } else {
                // If no saved address, select the first one by default
                let firstRadioButton = document.querySelector(".address-radio");
                if (firstRadioButton) {
                    firstRadioButton.checked = true;
                    updateSelectedAddress(firstRadioButton);
                }
            }
        
            // Add change event listener to radio buttons
            const radioButtons = document.querySelectorAll('.address-radio');
            radioButtons.forEach((radioButton) => {
                radioButton.addEventListener('change', function () {
                    updateSelectedAddress(this);
                });
            });
        });
        
        // Show "Delivering Here" button and update selected address
        function updateSelectedAddress(radioButton) {
            // Hide all "Delivering Here" buttons
            document.querySelectorAll('.delivering-here-btn').forEach((btn) => {
                btn.style.display = 'none';
            });
        
            // Show the "Delivering Here" button for the selected address
            const button = radioButton.closest('.card-body')?.querySelector('.delivering-here-btn');
            if (button) {
                button.style.display = 'inline-block';
            }
        
            // Get selected address details
            let name = radioButton.dataset.name;
            let pincode = radioButton.dataset.pincode;
            let address1 = radioButton.dataset.address1;
            let address2 = radioButton.dataset.address2;
        
            // Update the selected address display
            document.getElementById('selected-address').innerHTML = `
                <p>Deliver to: <strong>${name}, ${pincode}</strong></p>
                <p style="font-size:12px;">${address1}, ${address2}, ${pincode}</p>
            `;
        
            // Save the selected address ID in localStorage
            localStorage.setItem("selectedAddress", radioButton.id);
        }



        function toggleDropdown(event, button) {
                event.preventDefault();
                event.stopPropagation();
                
                const dropdown = button.nextElementSibling;
                const isVisible = dropdown.style.display === "block";
                
                // Close all dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = "none";
                });
                
                // Toggle current dropdown
                dropdown.style.display = isVisible ? "none" : "block";
            }
            
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown-container')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = "none";
                    });
                }
            });


        function makeDefault(addressId) {
        // Find and check the corresponding radio button
        const radioButton = document.getElementById(addressId);
        if (radioButton) {
            radioButton.checked = true;
    
            // Call updateSelectedAddress to show the "Delivering Here" button
            updateSelectedAddress(radioButton);
        }
    
        // Close dropdown after selecting "Make Default"
        document.querySelectorAll(".dropdown-menu").forEach(menu => {
            menu.style.display = "none";
        });
    }



    </script>







</body>
</html>