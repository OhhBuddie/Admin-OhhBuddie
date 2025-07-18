@extends('layouts.product1')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    
    <style>
    /* Ensure no horizontal scroll and keep within 100vw */
    
    body {
        overflow-x: hidden;
        max-width: 100vw;
    }

    /* Limit subcategory width */
    .Mens, .Mens-topwear, .Womens, .women-sub {
        max-width: 60vw; /* Adjust width to prevent overflow */
        max-height: 80vh;
        overflow-y: scroll;
        overflow-x: hidden;
        
    }

    /* Reduce subcategory card and image sizes */
    .Mens .card, .Womens .card {
        width: 100%; 
        
    }

    .Mens .card-body img, .Womens .card-body img {
        height: 70px; /* Reduce image size */
        width: 100%;
        object-fit: cover;
    }

    /* Sub-Subcategory (Mens-topwear) adjustments */
    .Mens-topwear .card, .women-sub .card {
        /*max-width: 130px; */
        
    }

    .Mens-topwear .card-body img, .women-sub .card-body img {
        height: 60px; /* Reduce image height */
        width: 100%;
        object-fit: cover;
    }
    
     @media (min-width: 1000px) {
        .container, .container-lg, .container-md, .container-sm {
            max-width: unset;
        }
    }
    
    /* Make subcategories (`id="Mens"`) display one per row */
    
        .Mens .row, .Womens .row {
            display: flex;
            flex-direction: column;
        }
    
        .Mens .col-sm-3, .Womens .col-sm-3 {
            width: 100%; /* Make each item take full width */
            max-width: 250px; /* Optional: Adjust width */
            margin-bottom: 10px; /* Add spacing */
        }
    
        /* Make sub-subcategories (`id="Mens-topwear"`) display one per row */
        .Mens-topwear .row, .women-sub .row {
            display: flex;
            flex-direction: column;
        }
    
        .Mens-topwear .col-sm-2, .women-sub .col-sm-2 {
            width: 100%;
            max-width: 250px;
            margin-bottom: 10px;
        }
        
        a{
            cursor: pointer;
        }

</style>

<style>
/* width */
::-webkit-scrollbar {
  width: 0.1px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 1px grey; 
  border-radius: 0.1px;
}
 
/* H&le */
::-webkit-scrollbar-thumb {
  background: grey; 
  border-radius: 0.1px;
}

/* H&le on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}
</style>
    <style>

        .containerr {
            width: 180%;
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

    </style>
    <style>
        .file-list {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .file-item {
            background: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 300px;
            overflow: hidden;
        }

        .file-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .file-item a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: bold;
        }

        .file-item a:hover {
            text-decoration: underline;
        }
    </style>


    <div class="container" style="margin-top:60px; margin-left:0px; margin-right:0px; width:100%;">


      <div class="row">
          <div class="card" style="border: 1px solid ;">
            <div class="card-body" style="font-weight:bold; ">Add New Product</div>
          </div>
      </div>
      
        <div class="container m-0 pt-2">
            <div class="row">
                
                <!-- Main Categories -->
                <div class="col-sm-3">
                    <div class="card text-white" style="background-color:var(--secondary-color)">
                        <div class="card-header" style="font-weight:bold">Men</div>
                        <div>
                            <a href="#" onclick="menFunction(event)">
                                <img src="https://www.modernfellows.com/wp-content/uploads/2020/10/Best-mens-online-clothing-stores.jpg"
                                    style="height:140px; width:261px;">
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="card text-white" style="background-color:var(--secondary-color)">
                        <div class="card-header" style="font-weight:bold">Women</div>
                        <div>
                            <a href="#" onclick="womenFunction(event)">
                                <img src="https://cdn.shopify.com/s/files/1/0597/5592/1540/files/6-different-styles_1024x1024.jpg?v=1687584397"
                                style="height:140px; width:261px;">
                            </a>    
                        </div>
                    </div>
                    <br>
                    <div class="card text-white" style="background-color:var(--secondary-color)">
                        <div class="card-header" style="font-weight:bold">Kids</div>
                        <div>
                            <a href="#" onclick="kidsFunction(event)">
                                <img src="https://www.dfupublications.com/images/2023/07/27/Growth%20of%20India's%20Kids'%20Wear%20$24.5B%20by%202028_large.jpeg"
                                style="height:140px; width:261px;">
                            </a>    
                        </div>
                    </div>
                </div>
        
                <!-- Subcategories for Men   -->
                <div class="col-sm-3 Mens" id="Mens" style="display:none;">
                    <div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Top Wear</div>
                                    <a href="#" onclick="Mensub(event)">
                                        <div>
                                            <img src="https://frenchcrown.in/cdn/shop/articles/Fashion_Style_Tips_Every_Man_Should_Know.jpg?v=1715837777&width=1600"
                                                style="height:100px; width:218px;">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Indian and Festive Wear</div>
                                    <div   onclick="Mensub(event)">
                                        <img src="https://images.hindustantimes.com/img/2022/10/22/550x309/Collage_Maker-22-Oct-2022-0446-PM_1666437381752_1666437381950_1666437381950.jpg"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Bottom Wear</div>
                                    <a onclick="Mensub(event)">
                                        <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                            style="height:90px; width:100%;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Footwear</div>
                                    <div class="card-body"  onclick="Mensub(event)">
                                        <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Innerwear and Sleepwear</div>
                                    <div class="card-body"  onclick="Mensub(event)">
                                        <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Plus</div>
                                    <div class="card-body"  onclick="Mensub(event)">
                                        <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
              
        
                        
                    </div> 
                </div>
                
                <!--Sub Sub Category For Men -->
                <div class="col-sm-2 p-0 Mens-topwear"  id="Mens-topwear" style="display:none;">
                    <div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a" >T-shirts</div>
                                            <div onclick="subcategory(event)">
                                                <img src="https://frenchcrown.in/cdn/shop/articles/Fashion_Style_Tips_Every_Man_Should_Know.jpg?v=1715837777&width=1600"
                                                    style="height:80px; width:195px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Shirts</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.hindustantimes.com/img/2022/10/22/550x309/Collage_Maker-22-Oct-2022-0446-PM_1666437381752_1666437381950_1666437381950.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Sweatshirts</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Jackets</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Blazers and Coats</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Suits</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
          
                <!-- Subcategories For Women -->
                <div class="col-sm-3 Womens" id="Womens" style="display:none;">
                    <div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Indian and Fusion Wear</div>
                                    <a href="#" onclick="Womensub1(event)">
                                        <div class="card-body">
                                            <img src="https://frenchcrown.in/cdn/shop/articles/Fashion_Style_Tips_Every_Man_Should_Know.jpg?v=1715837777&width=1600"
                                                style="height:90px; width:100%;">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Western Wear</div>
                                    <div class="card-body"  onclick="Womensub2(event)">
                                        <img src="https://images.hindustantimes.com/img/2022/10/22/550x309/Collage_Maker-22-Oct-2022-0446-PM_1666437381752_1666437381950_1666437381950.jpg"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Bottom Wear</div>
                                    <div class="card-body"  onclick="Womensub3(event)">
                                        <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Footwear</div>
                                    <div class="card-body"  onclick="Womensub4(event)">
                                        <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Lingerie and Sleepwear</div>
                                    <div class="card-body"  onclick="Womensub5(event)">
                                        <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">Maternity Wear</div>
                                    <div class="card-body"  onclick="Womensub6(event)">
                                        <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card text-white">
                                    <div class="card-header" style="font-weight:bold; background-color:#00204a">PlusSize</div>
                                    <div class="card-body"  onclick="Womensub7(event)">
                                        <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                            style="height:90px; width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div> 
                </div>
                
                <!--Sub Sub Category For Women -- Indian and Fusion Wear  -->
                <div class="col-sm-3 p-0 womensubsub1 women-sub" id="women-sub" style="display:none;">
                    <div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a" >Sarees</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.jdmagicbox.com/quickquotes/images_main/semi-soft-silk-pattu-saree-pattu-border-saree-2-378530579-jvodt.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Gowns</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.hindustantimes.com/img/2022/10/22/550x309/Collage_Maker-22-Oct-2022-0446-PM_1666437381752_1666437381950_1666437381950.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Tops, Tunics and Kurtis</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Kurtas and Sets</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Dupatta and Shawls</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Lehenga</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                
                <!--Sub Sub Category For Women -- Western Wear  -->
                <div class="col-sm-3 p-0 womensubsub2 women-sub" id="women-sub" style="display:none;">
                    <div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a" >Tops</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.jdmagicbox.com/quickquotes/images_main/semi-soft-silk-pattu-saree-pattu-border-saree-2-378530579-jvodt.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">T-Shirts</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:&9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Shirts</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Dresses</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Co-Ords</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Jumpsuits</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Shrugs</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Hoodie and Sweatshirts</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Jackets and Coats</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Blazers and Waistcoats</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Playsuits</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Shackets</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                
                <!--Sub Sub Category For Women -- Bottom Wear  -->
                <div class="col-sm-3 p-0 womensubsub3 women-sub" id="women-sub" style="display:none;">
                    <div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a" >Jeans</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://offduty.in/cdn/shop/products/ff2def08-93ae-4984-89e8-8352dea110da_540x.jpg?v=1676893036"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Trousers and Capris</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:&9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Shorts and Skirts</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Leggings and Tights</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Plazos, Churidar and Salwars</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Hot Pants</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Cargos and Parachutes</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                </div>
                
                <!--Sub Sub Category For Women -- Footwear  -->
                <div class="col-sm-3 p-0 womensubsub4 women-sub" id="women-sub" style="display:none;">
                    <div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a" >Flats</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:&9GcSWZ9HatFuMhRwMNHJuU_C4bHW7_CQtOIAhZLtD9VLNcdaz1xGJ5_ya3oqMJpWqYc-2e9_OBB5edY15KX-iQgnExYk6ybd5lQkR1Za2tsjsuE0PYdT1tNus"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Heels</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:&9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Floaters</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Boots</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Casual Shoes</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Sneakers</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Bellies</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Socks</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                </div>
                
                <!--Sub Sub Category For Women -- Lingerie and Sleepwear  -->
                <div class="col-sm-3 p-0 womensubsub5 women-sub" id="women-sub" style="display:none;">
                    <div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a" >Bra</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:&9GcSWZ9HatFuMhRwMNHJuU_C4bHW7_CQtOIAhZLtD9VLNcdaz1xGJ5_ya3oqMJpWqYc-2e9_OBB5edY15KX-iQgnExYk6ybd5lQkR1Za2tsjsuE0PYdT1tNus"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Brief</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:&9GcSDSKvFJNgPMvdGdbekIFxOKHrqI1rCtAeN1xPGtgg0iEnQJeVi7DDTt8Qe_8rre8CRTdyMrkcHxTJwTSIIGbSH4-G-S-rZo8GlCRYfQWQKBPmUkJG4QFfxuWA"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Camisoles</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://dennison.in/cdn/shop/files/category_banners_2_28001680-05be-4569-990a-746e835f49fb.png?v=1735387056&width=1920"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Lingerie Set</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://sharpmagazine.com/wp-content/uploads/2023/08/Footwear-Guide-F2-1.jpg"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Babydoll and Sets</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Housecoat</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Night Suit</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Nighties</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Shapewear</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Thermals</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card text-white">
                                            <div class="card-header" style="font-weight:bold; background-color:#00204a">Bath Robes</div>
                                            <div class="card-body" onclick="subcategory(event)">
                                                <img src="https://images.meesho.com/images/products/87830251/ehcoy_512.webp"
                                                    style="height:90px; width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                </div>
                
                
                
                
                <!--Dropzone --> 
                <div class="col-sm-3 p-0">
                    <div id="drop" class="containerr"  style="display:none;">
                        <h2>File Upload System</h2>
                        <form action="/" class="dropzone" id="my-dropzone">
                            <div class="dz-message">Drop files here or click to upload</div>
                        </form>
                        <div class="btn-container">
                            <button type="button" class="btn btn-secondary" id="select-files">Select Files</button>
                        </div>
                    </div>
                </div>
                
            </div> 
    
            <button id="next-button" class=" btn bg-dark text-white px-4 py-2 rounded mt-4" style="position: absolute; right: 45px; bottom: 38px;" onclick="next()">Next</button>
        </div>
    </div>
    
    
    

  <script>
              // Keep track of selected categories
        let selectedMainCategory = '';
        let selectedSubCategory = '';
        let selectedSubSubCategory = '';
        
        function menFunction(event) {
            // Get the category name from the clicked card's header
            selectedMainCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();

            if(document.getElementById("Womens").style.display === 'block' || document.getElementById("women-sub").style.display === "block" ){
                document.getElementById("Womens").style.display = 'none';
                document.getElementById("women-sub").style.display = "none";
            }
         
            

            var x = document.getElementById("Mens");
            var y = document.getElementById("Mens-topwear");
            var z = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "none";
            }
        }
        
        function womenFunction(event) {
            // Get the category name from the clicked card's header
            selectedMainCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
            
            if(document.getElementById("Mens").style.display === "block" || document.getElementById("Mens-topwear").style.display === "block" ){
               document.getElementById("Mens").style.display = "none";
               document.getElementById("Mens-topwear").style.display = "none";
            }
            
            if(document.querySelector(".women-sub").style.display === 'block'){
                document.querySelector(".women-sub").style.display = 'none';
            }
            
            var x = document.getElementById("Womens");
            var y = document.getElementById("women-sub");
            var z = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "none";
            }
            
           
            
            
        }
        
        
        
        function Mensub(event) {
            // Get the category name from the clicked card's header
            selectedSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
            
            var x = document.getElementById("Mens-topwear");
            var y = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
        
        // For Women SUB SUB Category Open 
        
        
        function Womensub1(event) {
            // Get the category name from the clicked card's header
            selectedSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
            
            // var a = document.querySelector(".womensubsub1");
            var b = document.querySelector(".womensubsub2");
            var c = document.querySelector(".womensubsub3");
            var d = document.querySelector(".womensubsub4");
            var e = document.querySelector(".womensubsub5");
            
            if(b.style.display === 'block' || c.style.display === 'block'  || d.style.display === 'block' || e.style.display === 'block' ){
                b.style.display = 'none';
                c.style.display = 'none';
                d.style.display = 'none';
                e.style.display = 'none';
                document.getElementById("drop").style.display = 'none';
            }
            
            var x = document.querySelector(".womensubsub1");
            var y = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
        function Womensub2(event) {
            // Get the category name from the clicked card's header
            selectedSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
            
            var a = document.querySelector(".womensubsub1");
            // var b = document.querySelector(".womensubsub2");
            var c = document.querySelector(".womensubsub3");
            var d = document.querySelector(".womensubsub4");
            var e = document.querySelector(".womensubsub5");
            
            if(a.style.display === 'block' || c.style.display === 'block'  || d.style.display === 'block' || e.style.display === 'block' ){
                a.style.display = 'none';
                c.style.display = 'none';
                d.style.display = 'none';
                e.style.display = 'none';
                document.getElementById("drop").style.display = 'none';
            }
            
            var x = document.querySelector(".womensubsub2");
            var y = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
        function Womensub3(event) {
            // Get the category name from the clicked card's header
            selectedSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
                        
            var a = document.querySelector(".womensubsub1");
            var b = document.querySelector(".womensubsub2");
            // var c = document.querySelector(".womensubsub3");
            var d = document.querySelector(".womensubsub4");
            var e = document.querySelector(".womensubsub5");
            
            if(a.style.display === 'block' || b.style.display === 'block'  || d.style.display === 'block' || e.style.display === 'block' ){
                a.style.display = 'none';
                b.style.display = 'none';
                d.style.display = 'none';
                e.style.display = 'none';
                document.getElementById("drop").style.display = 'none';
            }
            
            var x = document.querySelector(".womensubsub3");
            var y = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
        function Womensub4(event) {
            // Get the category name from the clicked card's header
            selectedSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
                        
            var a = document.querySelector(".womensubsub1");
            var b = document.querySelector(".womensubsub2");
            var c = document.querySelector(".womensubsub3");
            // var d = document.querySelector(".womensubsub4");
            var e = document.querySelector(".womensubsub5");
            
            if(a.style.display === 'block' || b.style.display === 'block'  || c.style.display === 'block' || e.style.display === 'block' ){
                a.style.display = 'none';
                b.style.display = 'none';
                c.style.display = 'none';
                e.style.display = 'none';
                document.getElementById("drop").style.display = 'none';
            }
            
            var x = document.querySelector(".womensubsub4");
            var y = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
        function Womensub5(event) {
            // Get the category name from the clicked card's header
            selectedSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
                        
            var a = document.querySelector(".womensubsub1");
            var b = document.querySelector(".womensubsub2");
            var c = document.querySelector(".womensubsub3");
            var d = document.querySelector(".womensubsub4");
            // var e = document.querySelector(".womensubsub5");
            
            if(a.style.display === 'block' || b.style.display === 'block'  || c.style.display === 'block' || d.style.display === 'block' ){
                a.style.display = 'none';
                b.style.display = 'none';
                c.style.display = 'none';
                d.style.display = 'none';
                document.getElementById("drop").style.display = 'none';
            }
            
            var x = document.querySelector(".womensubsub5");
            var y = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
        
        
        // For DropZone Open 
        function subcategory(event) {
            // Get the category name from the clicked card's header
            selectedSubSubCategory = event.target.closest('.card').querySelector('.card-header').textContent.toLowerCase();
            
            // Original toggle functionality
            var x = document.getElementById("drop");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        
        // Update the next() function to handle multiple files
        function next() {
            // Get the Dropzone instance
            const myDropzone = Dropzone.instances[0];
            
            if (myDropzone && myDropzone.files.length > 0) {
                // Create a promise for each file to ensure dataURL is loaded
                const filePromises = myDropzone.files.map(file => {
                    return new Promise((resolve) => {
                        if (file.dataURL) {
                            // If dataURL already exists, resolve immediately
                            resolve({
                                dataURL: file.dataURL,
                                name: file.name,
                                size: file.size,
                                type: file.type
                            });
                        } else {
                            // If dataURL doesn't exist, create it
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                resolve({
                                    dataURL: e.target.result,
                                    name: file.name,
                                    size: file.size,
                                    type: file.type
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                });
        
                // Wait for all files to be processed
                Promise.all(filePromises).then(filesData => {
                    localStorage.setItem('transferredFiles', JSON.stringify(filesData));
                    
                    // Build the URL with all selected categories
                    let categoryParams = [];
                    if (selectedMainCategory) {
                        categoryParams.push(`main=${selectedMainCategory}`);
                    }
                    if (selectedSubCategory) {
                        categoryParams.push(`sub=${selectedSubCategory}`);
                    }
                    if (selectedSubSubCategory) {
                        categoryParams.push(`type=${selectedSubSubCategory}`);
                    }
                    
                    // Navigate to product-listing with all category parameters
                    const queryString = categoryParams.join('&');
                    window.location.href = `/product-listing?${queryString}`;
                });
            } else {
                // If no files, just navigate
                let categoryParams = [];
                if (selectedMainCategory) {
                    categoryParams.push(`main=${selectedMainCategory}`);
                }
                if (selectedSubCategory) {
                    categoryParams.push(`sub=${selectedSubCategory}`);
                }
                if (selectedSubSubCategory) {
                    categoryParams.push(`type=${selectedSubSubCategory}`);
                }
                
                const queryString = categoryParams.join('&');
                window.location.href = `/product-listing?${queryString}`;
            }
        }
   </script>

    
   <script>
   Dropzone.options.myDropzone = {
        paramName: "file",
        maxFilesize: 100,
        maxFiles: 10,
        acceptedFiles: "image/*,application/pdf",
        addRemoveLinks: true,
        dictRemoveFile: "×",
        autoProcessQueue: false,
        createImageThumbnails: true,
        thumbnailWidth: 120,
        thumbnailHeight: 80,
        uploadMultiple: true,
        
        init: function() {
        var myDropzone = this;
        var uploadProgress = document.querySelector('.upload-progress');
        var progressBar = document.querySelector('.progress-bar');
        var statusMessage = document.querySelector('.status-message');
        var nextButton = document.querySelector("#next-button");
        
        // Ensure button is hidden initially
        if (nextButton) {
            nextButton.style.display = 'none';
            nextButton.classList.add('hidden');
        }
        
        document.querySelector("#select-files").addEventListener("click", function() {
            myDropzone.hiddenFileInput.click();
        });
        
        this.on("addedfile", function(file) {
            if (nextButton) {
                nextButton.style.display = 'block';
                nextButton.classList.remove('hidden');
            }
            
            // Create FileReader for each file
            const reader = new FileReader();
            reader.onload = function(e) {
                file.dataURL = e.target.result; // Store dataURL with the file
            };
            reader.readAsDataURL(file);
        });
        
        this.on("removedfile", function(file) {
            if (this.files.length === 0 && nextButton) {
                nextButton.style.display = 'none';
                nextButton.classList.add('hidden');
            }
        });
            
            this.on("sending", function(file, xhr, formData) {
                console.log('Sending file:', file.name);
                var token = document.querySelector('meta[name="csrf-token"]').content;
                formData.append("_token", token);
            });
            

            
            this.on("success", function(file, response) {
                console.log('Upload successful:', file.name);
                console.log('Server response:', response);
                statusMessage.textContent = "Files uploaded successfully!";
                statusMessage.className = "status-message success";
                setTimeout(() => {
                    uploadProgress.style.display = 'none';
                    progressBar.style.width = "0%";
                }, 2000);
            });
            
            this.on("error", function(file, errorMessage, xhr) {
                console.error('Upload error for file:', file.name);
                console.error('Error message:', errorMessage);
                if (xhr) {
                    console.error('Server response:', xhr.responseText);
                }
                statusMessage.textContent = "Error uploading files: " + errorMessage;
                statusMessage.className = "status-message error";
                uploadProgress.style.display = 'none';
            });
        }
    };



        

        // Function to create a file card
        function createFileCard(file) {
            const card = document.createElement('div');
            card.className = 'border rounded-lg p-4 shadow hover:shadow-md transition-shadow';

            // Format file size
            const formattedSize = formatFileSize(file.size);

            // Format date
            const formattedDate = new Date(file.created_at).toLocaleDateString();

            // Create preview based on file type
            let preview = '';
            if (file.mime_type.startsWith('image/')) {
                preview = `
            <div class="mb-3 h-32 flex items-center justify-center bg-gray-100 rounded">
                <img src="${file.url}" alt="${file.original_name}" 
                     class="max-h-full max-w-full object-contain rounded">
            </div>
        `;
            } else {
                const fileIcon = getFileIcon(file.mime_type);
                preview = `
            <div class="mb-3 h-32 flex items-center justify-center bg-gray-100 rounded">
                <span class="text-4xl">${fileIcon}</span>
            </div>
        `;
            }

            card.innerHTML = `
        ${preview}
        <div class="space-y-2">
            <a href="${file.url}" target="_blank" 
               class="block font-medium text-blue-600 hover:text-blue-800 truncate">
                ${file.original_name}
            </a>
            <div class="text-sm text-gray-500">
                <div>${formattedSize}</div>
                <div>Uploaded: ${formattedDate}</div>
            </div>
        </div>
    `;

            return card;
        }

        // Function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Function to get file icon based on mime type
        function getFileIcon(mimeType) {
            if (mimeType.startsWith('image/')) return '🖼️';
            if (mimeType === 'application/pdf') return '📄';
            if (mimeType === 'text/plain') return '📝';
            return '📎';
        }

        // Initialize file display when DOM is loaded
        // document.addEventListener('DOMContentLoaded', fetchUploadedFiles);

        // Add this to your Dropzone success h&ler
        myDropzone.on("success", function(file, response) {
            statusMessage.textContent = "Files uploaded successfully!";
            statusMessage.className = "status-message success";
            setTimeout(() => {
                uploadProgress.style.display = 'none';
                progressBar.style.width = "0%";
              
            }, 2000);
        });
    </script>
 
 
 
@endsection
