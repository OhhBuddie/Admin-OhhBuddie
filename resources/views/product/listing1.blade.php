@extends('layouts.seller.sellerportal')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    
        <!-- Font Awesome for Wishlist Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

     <title>Listing  Page</title>
    <style>
        .card{
            width:100%;
            min-width: 100%;
                box-shadow: none;
        }
        .col-sm-3{
             max-width: 100%;
             width:100%;
        }
        a, img{
            cursor: pointer;
        }
        @media (min-width: 1000px) {
            .container, .container-lg, .container-md, .container-sm {
                max-width: unset;
                width: unset;
            }
        }

</style>
   <style>
        
        .containerr {
            width: 100%;
            height: 98%;
            /*max-width: 800px;*/
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #1a1a1a;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            font-weight: 600;
        }

        .dropzone {
            border: 2px dashed #efc475;
            background: white;
            padding: 10px;
            width: 100%;
            max-width: 600px;
            min-height: 200px;
            text-align: center;
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: flex-start;
            align-content: flex-start;
        }

        .dropzone .dz-message {
            width: 100%;
            margin: 20px 0;
        }

        .dz-preview {
            position: relative;
            border-radius: 8px;
            overflow: visible;
            animation: fadeIn 0.3s ease-in-out;
            background: #fff;
            padding: 3px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: calc((100% - 16px) / 3) !important;
            margin: 0 !important;
        }

        .dz-preview::before {
            content: "";
            display: block;
            padding-top: 100%;
        }

        .dz-preview .dz-image {
            position: absolute !important;
            top: 3px !important;
            left: 3px !important;
            right: 3px !important;
            bottom: 3px !important;
            width: auto !important;
            height: auto !important;
            border-radius: 6px;
        }

        .dz-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
            border-radius: 6px;
        }

        /* Enhanced Remove Button */
        .dz-remove {
            position: absolute !important;
            top: -8px !important;
            right: -8px !important;
            background: #ef4444 !important;
            color: white !important;
            border-radius: 50% !important;
            width: 20px !important;
            /* Smaller size */
            height: 20px !important;
            /* Smaller size */
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-decoration: none !important;
            font-size: 14px !important;
            /* Smaller font */
            font-weight: bold !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
            z-index: 10 !important;
            transition: all 0.2s ease !important;
        }

        .dz-remove:hover {
            background: #dc2626 !important;
            transform: scale(1.1) !important;
        }

        .btn-container {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .upload-progress {
            width: 100%;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-top: 20px;
            overflow: hidden;
            display: none;
        }

        .progress-bar {
            height: 100%;
            background: #4f46e5;
            width: 0%;
            transition: width 0.3s ease;
        }

        .status-message {
            margin-top: 12px;
            text-align: center;
            font-size: 14px;
        }

        .success {
            color: #059669;
        }

        .error {
            color: #dc2626;
        }

        /* File Details */
        .dz-details {
            padding-top: 4px !important;
        }

        .dz-filename {
            text-align: center !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            padding: 0 4px !important;
            font-size: 11px !important;
            color: #4b5563 !important;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            body {
                padding: 8px;
            }

            .dropzone {
                padding: 8px;
                gap: 6px;
            }

            .dz-preview {
                width: calc((100% - 12px) / 3) !important;
            }

            .dz-remove {
                width: 20px;
                height: 20px;
                font-size: 12px;
                line-height: 20px;
                top: -6px;
                right: -6px;
            }

            .upload-btn-container {
                flex-direction: column;
                gap: 10px;
            }

            .upload-btn {
                width: 100%;
            }
        }
        

        .hidden {
            display: none !important;
        }
        
        
        .row{
                /* display: flex
; */
            flex-wrap: nowrap;
        }

    </style>

<div class="container" style="margin-top:0px; margin-left:0px; margin-right:0px; width:100%;  max-width:100%;">

      <div class="titlee">
          <div class="card" style="border:none; background: #f6f7fb;">
            <div class="card-body" style="font-weight:bold; padding:0px 0px 0px 26px;">
                
                <h4 style=" text-align: left; align-items: center; display: flex;">
                    
                     <!-- Back Button -->
                    <a href="javascript:history.back();" style="font-size: 17px; margin-right: 0px; color: Black; margin-right: 10px;">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    Add New Product
                </h4>
            </div>
          </div>
      </div>
      
   
    
    <div class="container m-0 pt-2">
        <div class="row" style="display: flex; width: 25%;">
          
            <!-- Main Categories -->
            <div class="col-sm-3 pl-0">
                 <div class="text-center"><h4>Main Category</h4></div>
                 
                <div style=" height: 81vh; overflow: scroll; scrollbar-width: none; margin-left:10px;">
                    @foreach( $level1 as $level )
                    
                        <div class="card text-white" style="background-color: #08adc5; ">
                            <!--<div class="card-header" style="font-weight:bold">{{ $level->category }}</div>-->
                            <div>
                                <a href="#" onclick="menFunction(event, {{ $level->id }})">
                                    <!--<img src="https://www.modernfellows.com/wp-content/uploads/2020/10/Best-mens-online-clothing-stores.jpg"-->
                                    <!--    style="height:100%; width:100%;">-->
                                    <!--<img src="{{ asset(DB::table('categories')->where('id', 1)->value('image')) }}" style="height:100%; width:100%;">-->
                                    
                                      @php
                                            // Fetch image data from the category dynamically
                                            $images = DB::table('categories')->where('id', $level->id)->value('image');
                        
                                            if ($images) {
                                                if (str_contains($images, ',')) {
                                                    // If images are stored as comma-separated values
                                                    $imagesArray = explode(',', $images);
                                                } elseif (json_decode($images)) {
                                                    // If images are stored as JSON format
                                                    $imagesArray = json_decode($images, true);
                                                } else {
                                                    // If only a single image is stored
                                                    $imagesArray = [$images];
                                                }
                        
                                                // Select a random image from the list
                                                $randomImage = asset(trim($imagesArray[array_rand($imagesArray)]));
                                            } else {
                                                // If no image is found, use a default image
                                                $randomImage = asset('uploads/default.jpg'); // Change to your default image path
                                            }
                                        @endphp

                                         <img src="{{ $randomImage }}" style="height:100%; width:100%;">

                                </a>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
            
            <!-- Sub Category Section -->
            <div class="col-sm-3 p-0">
                <div class="text-center sub"  style="display:none;"><h4>Sub Category</h4></div>
                <div id="subcategory-container" class="row" style="width: 86%; overflow: scroll; scrollbar-width: none; margin-left:10px; flex-direction: column;"></div>
            </div>
    
            <!-- Sub-Sub Category Section -->
            <div class="col-sm-3 p-0">
                <div class="text-center subsub" style="display:none;"><h4>Sub Sub Category</h4></div>
                <div id="subsubcategory-container" class="row" style="width: 86%;  overflow: scroll; scrollbar-width: none; margin-left:10px; flex-direction: column;"></div>
            </div>
       
            <!-- Hidden form with CSRF token for AJAX -->
            <form id="category-form" style="display:none;">
                @csrf
            </form>
        </div>
        <button id="next-button" class="btn bg-dark text-white px-4 py-2 rounded mt-4" style="position: absolute; right: 45px; bottom: 38px; display:none;">Next</button>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let selectedCategoryId = null;
        let selectedSubCategoryId = null;
        let selectedSubSubCategoryId = null;
        
        function menFunction(event, categoryId) {
            event.preventDefault();
            document.querySelector(".sub").style.display = 'none';
            document.querySelector(".subsub").style.display = 'none';
            let subCategoryContainer = $('#subcategory-container');
            let subSubCategoryContainer = $('#subsubcategory-container');
            let nextButton = document.querySelector("#next-button");
        
            // Hide next button when selecting a new main category
            if (nextButton) {
                nextButton.style.display = 'none';
                nextButton.classList.add('hidden');
            }
        
            // Toggle subcategory section
            if (subCategoryContainer.attr('data-category-id') == categoryId) {
                subCategoryContainer.empty();
                subCategoryContainer.removeAttr('data-category-id');
                subSubCategoryContainer.empty();
                subSubCategoryContainer.removeAttr('data-subcategory-id');
                selectedCategoryId = null;
                selectedSubCategoryId = null;
                selectedSubSubCategoryId = null;
                return;
            }
        
            // Store selected category ID
            subCategoryContainer.attr('data-category-id', categoryId);
            selectedCategoryId = categoryId;
        
            // Clear previous content
            subCategoryContainer.empty();
            subSubCategoryContainer.empty();
            selectedSubCategoryId = null;
            selectedSubSubCategoryId = null;
        
            $.ajax({
                url: '/get-subcategories/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(subCategory => {
                            document.querySelector(".sub").style.display = 'Block';
                            subCategoryContainer.append(`
                                <div class="subcategory-card card text-white p-0 mb-2" data-id="${subCategory.id}" data-category-id="${categoryId}">
                                    <img src="${subCategory.image}"
                                        style="height:100%; width:100%; object-fit: fill;">
                                </div>
                            `);
                        });
                    } else {
                        subCategoryContainer.append('<p class="text-white">No Subcategories Found</p>');
                    }
                }
            });
        }
        
        // Event delegation for dynamically generated subcategory cards
        $(document).on('click', '.subcategory-card', function(event) {
            event.preventDefault();
            document.querySelector(".subsub").style.display = 'none';
            let subCategoryId = $(this).data('id');
            let parentCategoryId = $(this).data('category-id'); // Get category ID of clicked subcategory
            let subSubCategoryContainer = $('#subsubcategory-container');
            let nextButton = document.querySelector("#next-button");
            
            // Hide next button when selecting a new sub category
            if (nextButton) {
                nextButton.style.display = 'none';
                nextButton.classList.add('hidden');
            }
        
            // Toggle sub-subcategory section
            if (subSubCategoryContainer.attr('data-subcategory-id') == subCategoryId) {
                subSubCategoryContainer.empty();
                subSubCategoryContainer.removeAttr('data-subcategory-id');
                selectedSubCategoryId = null;
                selectedSubSubCategoryId = null;
                return;
            }
        
            subSubCategoryContainer.attr('data-subcategory-id', subCategoryId);
            subSubCategoryContainer.empty();
            selectedSubCategoryId = subCategoryId;
            selectedSubSubCategoryId = null;
        
            $.ajax({
                url: '/get-sub-subcategories/' + subCategoryId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        document.querySelector(".subsub").style.display = 'Block';
                        response.forEach(subSubCategory => {
                            subSubCategoryContainer.append(`
                                <div class="subsubcategory-card card text-white p-0 mb-4" data-id="${subSubCategory.id}">
                                    <img src="${subSubCategory.image}"
                                        style="height:100%; width:100%; object-fit: fill;">
                                </div>
                            `);
                        });
                    } else {
                        // If no sub-subcategories exist and it's category 88 (special case)
                        if (parentCategoryId == 88 || subCategoryId == 95) {
                            // For special category 88 with no sub-subs, show next button directly
                            if (nextButton) {
                                nextButton.style.display = 'block';
                                nextButton.classList.remove('hidden');
                            }
                        } else {
                            subSubCategoryContainer.append('<p class="text-white">No Sub-Subcategories Found</p>');
                        }
                    }
                }
            });
        });
        
        // Event delegation for dynamically generated sub-subcategory cards
        $(document).on('click', '.subsubcategory-card', function(event) {
            event.preventDefault();
            let subSubCategoryId = $(this).data('id');
            let nextButton = document.querySelector("#next-button");
        
            // Store the selected sub-sub category ID
            selectedSubSubCategoryId = subSubCategoryId;
            
            // Show the next button when a sub-sub category is selected
            if (nextButton) {
                nextButton.style.display = 'block';
                nextButton.classList.remove('hidden');
            }
        });
        
        // Initialize the next button functionality
        document.addEventListener("DOMContentLoaded", function() {
            var nextButton = document.querySelector("#next-button");
            
            if (nextButton) {
                nextButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    
                    if (typeof selectedCategoryId === 'undefined' || !selectedCategoryId) {
                        alert("Please select a category before proceeding.");
                        return;
                    }
                    
                    if (typeof selectedSubCategoryId === 'undefined' || !selectedSubCategoryId) {
                        alert("Please select a sub-category before proceeding.");
                        return;
                    }
                    
                    // Special case for category 88 which might not have sub-sub categories
                    if ((typeof selectedSubSubCategoryId === 'undefined' || !selectedSubSubCategoryId) && selectedCategoryId != 88) {
                        alert("Please select a sub-sub-category before proceeding.");
                        return;
                    }

                    // Show loading indicator or disable button to prevent double-clicks
                    nextButton.disabled = true;
                    nextButton.innerHTML = 'Processing...';

                    // Submit data to create product
                    $.ajax({
                        url: '/save-product-data',
                        type: 'POST',
                        data: {
                            '_token': $('input[name="_token"]').val(),
                            'category_id': selectedCategoryId,
                            'sub_category_id': selectedSubCategoryId,
                            'sub_sub_category_id': selectedSubSubCategoryId
                        },
                        success: function(response) {
                            if (response.success && response.product_id) {
                                // Redirect to product listing with just the product_id
                                window.location.href = `/product-listing?id=${response.product_id}`;
                            } else {
                                alert("Error creating product. Please try again.");
                                nextButton.disabled = false;
                                nextButton.innerHTML = 'Next';
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", xhr.responseText);
                            alert("An error occurred. Please try again.");
                            nextButton.disabled = false;
                            nextButton.innerHTML = 'Next';
                        }
                    });
                });
            }
        });
    </script>
@endsection
