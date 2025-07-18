<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <style>
        .new-option {
            display: block;
            width: 100%;
            position: relative;
        }
        .new-option:after {
            content: '+ add new';
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }
        .new-option.style-2:after {
            content: '+ add new';
            display: block;
            position: absolute;
            right: 0;
            top: -2px;
            background: #205b12;
            padding: 2px 5px;
            color: #fff;
            border-radius: 5px;
        }
    </style>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-container {
            padding: 20px;
        }
        .left-column {
            width: 65%;
            padding-right: 20px;
            height:95vh;
            overflow:scroll;
            scrollbar-width:none;
        }
        .right-column {
            width: 35%;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-label {
            font-size: 13px;
            color: #555;
            margin-bottom: 5px;
        }
        .form-control, .form-select {
            font-size: 13px;
            padding: 8px 12px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 22px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e9ecef;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: green;
        }
        input:checked + .slider:before {
            transform: translateX(22px);
        }
        .toggle-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .toggle-label {
            font-size: 13px;
            color: #555;
        }
        .upload-box {
            border: 2px dashed #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 4px;
            margin-bottom: 15px;
            height:150px;
        }
        
        .btn {
            background-color: #EFC475;
        }
        
        .btn:hover{
            background-color: #08adc5;
        }
        
         @media (max-width: 768px) {
             
            .main-container {
                flex-direction: column;
            }
            .left-column, .right-column {
                width: 100%;
                padding-right: 0px;
               
            }
           
        }
    </style>
    <style>
    .custom-dropdown {
        width: 247px;
        position: relative;
        display: inline-block;
    }

    .dropdown-btn {
        width: 110%;
        padding: 10px;
        height:38px;
        border: 1px solid #ccc;
        border-radius:4px;
        background: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease-in-out;
    }

    .color-box {
        width: 15px;
        height: 15px;
        border: 1px solid #000;
        margin-right: 8px;
    }

    .dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        width: 110%;
        background: white;
        border: 1px solid #ccc;
        display: none;
        list-style: none;
        padding: 5px;
        margin: 0;
        z-index: 10;
        height: 240px;
        overflow-y: scroll;
        scrollbar-width: none;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .custom-dropdown:hover .dropdown-list {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-list li {
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.2s ease-in-out;
    }

    .dropdown-list li:hover {
        background: #f0f0f0;
    }

    .search-box {
        width: calc(104% - 20px);
        padding: 5px;
        margin: 5px;
        border: 1px solid #ccc;
    }
    
    
    
    
    
</style>
    <style>
        /* For Chrome, Safari, Edge, and Opera */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* For Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
    </style>
    <style>
        .container {
    max-width: 900px;
    width: 100%;
    background-color: #fff;
    margin: auto;
    padding: 15px;
    box-shadow: 0 2px 20px #0001, 0 1px 6px #0001;
    border-radius: 5px;
    overflow-x: auto;
}

._table {
    width: 100%;
    border-collapse: collapse;
}

._table :is(th, td) {
    border: 1px solid #0002;
    padding: 8px 10px;
}

/* form field design start */
.form_control {
    border: 1px solid #0002;
    background-color: transparent;
    outline: none;
    padding: 8px 12px;
    font-family: 1.2rem;
    width: 100%;
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    transition: 0.3s ease-in-out;
}

.form_control::placeholder {
    color: inherit;
    opacity: 0.5;
}

.form_control:is(:focus, :hover) {
    box-shadow: inset 0 1px 6px #0002;
}




.action_container {
    display: inline-flex;
}

.action_container>* {
    border: none;
    outline: none;
    /*color: #fff;*/
    /*text-decoration: none;*/
    display: inline-block;
    padding: 8px 14px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}


    </style>
    
    
    
    <style>
.btns {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 4px 8px;
  font-size: 12px;
  cursor: pointer;
  border-radius:10px;
}


/* Red */
.danger {
  border-color: #f44336;
  color: red;
}

.danger:hover {
  background: #f44336;
  color: white;
}

/* Gray */
.default {
  border-color: #e7e7e7;
  color: black;
}

.default:hover {
  background: #e7e7e7;
}
</style>

    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
            display: flex !important;
            align-items: center !important;
            border:1px solid #ced4da;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #EFC475;
            color: white;
        }
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: #ced4da;
        }
        .select2-selection__rendered {
            line-height: 40px !important;
        }
        .select2-selection__arrow {
            height: 40px !important;
        }
        *{
            scrollbar-width:none
        }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
   
    <div class="main-container d-flex">
        <!-- Left Column (80%) -->
        <div class="left-column">
            <form action="{{ route('products.update',$product->id ) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!-- Basic Product Details -->
                <div class="card">
                    <h6 class="card-title">Basic Product Details</h6>
                   
                    <div class="row g-3">
                        <div class="col-4">
                            <label class="form-label">Selected Sub Category</label>
                            <input type="text" class="form-control"  value="{{ $subsubcat }}" readonly>
                        </div>                         
                        <div class="col-md-4">
                            <label class="form-label">Parent ID</label>
                            <!--<select class="form-select" name="perent_id">-->
                            <!--    <option value="">Select Subcategory</option>-->
                            <!--</select>-->
                            
                            <select class="select2-3 form-select" name="parent_id" name="state" style="width: 100%" >
                                
                                @foreach($parentid as $pt)
                                <option value="{{$product->parent_id}}">{{ $product->parent_id }}</option>
                                    <option>{{ $pt->parent_id }}</option>
                                    
                                  @endforeach 
                            </select>
                        </div>
                        
                        
                        
                        <div class="col-md-4" hidden>
                            <label class="form-label">Product ID</label>
                            <input type="text" class="form-control" name="product_id" value="{{$product->product_id}}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            
                            @if($brand_cnt >0)
                                <!--<select class="form-control select2" name="brand_id">-->
                                <!--    <option value="1">Select Brand</option>-->
                                <!--</select>-->
                                
                                @if($product->brand_id != Null)
                                
                                    <input type="text" value="{{ \App\Models\Brand::where('id', $product->brand_id)->value('brand_name') }}" class="form-control" readonly>
        
                                    <input type="hidden" value="{{$product->brand_id}}" name="brand_id">
                                @endif
                            @else
                                <p style="color:red">!! No Brand Registered Yet !!</p>
                            @endif
                        </div>
                        



                        <div class="col-md-12">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$product->product_name}}">
                        </div>
                        
                        <div class="col-md-4" hidden>
                            <input type="text" class="form-control" name="category_id" value="{{ $cat_id }}">
                        </div>
                        
                        <div class="col-md-4" hidden>
                            <label class="form-label">Subcategory ID </label>
                            <input type="text" class="form-control" name="subcategory_id" value="{{ $subcat_id }}">
                        </div>
                        
                        <div class="col-md-4" hidden>
                            <input type="text" class="form-control" name="sub_subcategory_id" value="{{ $subsubcat_id }}">
                        </div>
                        

                        

                    </div>
                </div>
                
                <div class="card">
                    <h6 class="card-title">Product Identification Details</h6>
                   
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">HSN</label>
                            <input type="text" class="form-control" name="hsn" placeholder="Enter HSN Code" value="{{$product->hsn}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GST Rate</label>
                            <input type="number" max="18" min="1" class="form-control" name="gst_rate" onkeyup=enforceMinMax(this)  placeholder="Enter GST Rate" value="{{$product->gst_rate}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Size Chart</label>
                            <input type="text" class="form-control" name="size_chart_id"  placeholder="Enter Size Chart" value="{{$product->size_chart_id}}">
                        </div>
                        

                    </div>
                </div>
                
                
                
               <!--For Sarees -->
                <div class="card Sarees"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Saree Length</label>
                            <input type="text" class="form-control" name="saree_length"  placeholder="Enter Saree Length" value="{{$product->saree_length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Blouse Fabric</label>
                            <input type="text" class="form-control" name="blouse_fabric" placeholder="Enter Blouse Fabric" value="{{$product->blouse_fabric}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Blouse Piece Included</label>
                            <input type="text" class="form-control" name="blouse_piece_included" value="{{$product->blouse_piece_included}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Blouse Length</label>
                            <input type="text" class="form-control" name="blouse_length" placeholder="Enter Blouse Length" value="{{$product->blouse_length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Blouse Stiched</label>
                            <input type="text" class="form-control" name="blouse_stiched"  placeholder="Enter Blouse Stiched" value="{{$product->blouse_stiched}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Work Details</label>
                            <!--<input type="text" class="form-control" name="work_details"  placeholder="Enter Work Details">-->
                            
                            <select name="work_details_3" class="form-control select2" >
                                <option selected value="{{$product->work_details}}">{{$product->work_details}}</option>
                                 @foreach($attr as $work)
                                
                                    @if($work->work_details == Null)
                                       
                                    @else
                                       <option>{{$work->work_details}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Border Type</label>
                            <!--<input type="text" class="form-control" name="border_type" placeholder="Enter Border Type">-->
                                                        
                            <select name="border_type_1" class="form-control select2" >
                                <option selected value="{{$product->border_type}}">{{$product->border_type}}</option>
                                 @foreach($attr as $bordertype)
                                
                                    @if($bordertype->border_type == Null)
                                       
                                    @else
                                       <option>{{$bordertype->border_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Weave Type</label>
                            <!--<input type="text" class="form-control" name="weave_type" placeholder="Enter Weave Type">-->
                                                      
                            <select name="weave_type" class="form-control select2" >
                                <option selected value="{{$product->weave_type}}">{{$product->weave_type}}</option>
                                 @foreach($attr as $weavetype)
                                
                                    @if($weavetype->weave_type == Null)
                                       
                                    @else
                                       <option>{{$weavetype->weave_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern"  placeholder="Enter Pattern">-->
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                                         <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >    
                            
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                      
                                    @if($fab->fabric == Null)                                                                             
                                        
                                    @else                                        
                                    <option>{{$fab->fabric}}</option>                                     
                                    @endif                                                                     
                                @endforeach                             
                            </select>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_1" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Gowns-->
                <div class="card Gowns" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Gown Type</label>
                            <!--<input type="text" class="form-control" name="gown_type"  placeholder="Enter Gown Type">-->
                            
                            <select class="form-control select2" name="gown_type">
                                <option selected value="{{$product->gown_type}}">{{$product->gown_type}}</option>
                                @foreach($attr as $Gowntype)
                                
                                    @if($Gowntype->gown_type == Null)
                                       
                                    @else
                                       <option>{{$Gowntype->gown_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Length</label>
                            <!--<input type="text" class="form-control" name="sleeve_length" placeholder="Enter Sleeve Length">-->
                            
                            <select name="sleeve_length_1" class="form-control select2" >
                                <option selected value="{{$product->sleeve_length}}">{{$product->sleeve_length}}</option>
                                 @foreach($attr as $sleevelen)
                                
                                    @if($sleevelen->sleeve_length == Null)
                                       
                                    @else
                                       <option>{{$sleevelen->sleeve_length}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Pattern</label>
                            <!--<input type="text" class="form-control" name="sleeve_pattern"  placeholder="Enter Sleeve Pattern">-->
                            
                            <select name="sleeve_pattern_1" class="form-control select2" >
                                <option selected value="{{$product->sleeve_pattern}}">{{$product->sleeve_pattern}}</option>
                                 @foreach($attr as $sleevepat)
                                
                                    @if($sleevepat->sleeve_pattern == Null)
                                       
                                    @else
                                       <option>{{$sleevepat->sleeve_pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Neck Style</label>
                            <!--<input type="text" class="form-control" name="neck_style" placeholder="Enter Neck Style">-->
                            
                            <select name="neck_style" class="form-control select2" >
                                <option selected value="{{$product->neck_style}}">{{$product->neck_style}}</option>
                                 @foreach($attr as $necksty)
                                
                                    @if($necksty->neck_style == Null)
                                       
                                    @else
                                       <option>{{$necksty->neck_style}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <!--<input type="text" class="form-control" name="closure_type" placeholder="Enter Closure Type">-->
                            
                            <select name="closure_type_1" class="form-control select2" >
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                 @foreach($attr as $clo)
                                
                                    @if($clo->clousure_type == Null)
                                       
                                    @else
                                       <option>{{$clo->clousure_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Embellishment Details</label>
                            <!--<input type="text" class="form-control" name="embellishment_details" placeholder="Enter Embellishment Details">-->
                            
                            <select  name="embellishment_details" class="form-control select2" >
                                <option selected value="{{$product->embellishment_details}}">{{$product->embellishment_details}}</option>
                                 @foreach($attr as $embd)
                                
                                    @if($embd->embelishment_detail == Null)
                                       
                                    @else
                                       <option>{{$embd->embelishment_detail}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lining Present</label>
                            <input type="text" class="form-control" name="lining_present" placeholder="Enter Lining Present" value="{{$product->lining_present}}">
                        </div>
                        
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >    
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                     
                                    @if($fab->fabric == Null)    
                                    
                                    @else                                        
                                        <option>{{$fab->fabric}}</option>                                     
                                    @endif                                                                    
                                @endforeach                             
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_2" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Tops-Tunics-Kurtis-->
                <div class="card Tops-Tunics-Kurtis" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Set Type</label>
                            <input type="text" class="form-control" name="set_type_kurti" placeholder="Enter Set Type" value="{{$product->set_type_kurti}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bottom Included</label>
                            <!--<input type="text" class="form-control" name="bottom_included">-->
                            
                            <select name="bottom_included" class="form-control select2" >
                                <option selected value="{{$product->bottom_included}}">{{$product->bottom_included}}</option>
                                <option>YES</option>
                                <option>NO</option>
                            </select>        
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bottom Type</label>
                            <!--<input type="text" class="form-control" name="bottom_type" placeholder="Enter Bottom Type">-->
                            
                            <select name="bottom_type_1" class="form-control select2" >
                                    <option selected value="{{$product->bottom_type}}">{{$product->bottom_type}}</option>
                                 @foreach($attr as $bottomtype)
                                
                                    @if($bottomtype->bottom_type == Null)
                                       
                                    @else
                                       <option>{{$bottomtype->bottom_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Pattern</label>
                            <!--<input type="text" class="form-control" name="sleeve_pattern" placeholder="Enter Sleeve Pattern">-->
                            
                            <select name="sleeve_pattern_2" class="form-control select2" >
                                <option selected value="{{$product->sleeve_pattern}}">{{$product->sleeve_pattern}}</option>
                                 @foreach($attr as $sleevepat)
                                
                                    @if($sleevepat->sleeve_pattern == Null)
                                       
                                    @else
                                       <option>{{$sleevepat->sleeve_pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dupatta Fabric</label>
                            <!--<input type="text" class="form-control" name="dupatta_fabric" placeholder="Enter Dupatta Fabric">-->
                            
                                                        
                            <select name="dupatta_fabric" class="form-control select2" >
                                    <option selected value="{{$product->dupatta_fabric}}">{{$product->dupatta_fabric}}</option>
                                 @foreach($attr as $dupattafab)
                                
                                    @if($dupattafab->dupatta_type == Null)
                                       
                                    @else
                                       <option>{{$dupattafab->dupatta_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dupatta Length</label>
                            <input type="text" class="form-control" name="dupatta_length_1" value="{{$product->dupatta_length}}" placeholder="Enter Dupatta Length">
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" > 
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                     
                                    @if($fab->fabric == Null) 
                                    
                                    @else                                        
                                        <option>{{$fab->fabric}}</option>                                    
                                    @endif                                                                     
                                @endforeach                             
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_3" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Kurtas & Sets-->
                <div class="card Kurtas" style="display: none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Set Type</label>
                            <input type="text" class="form-control" name="set_type_kurta" placeholder="Enter Set Type" value="{{$product->set_type_kurta}}">
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bottom Included</label>
                            <!--<input type="text" class="form-control" name="bottom_included" placeholder="Enter Bottom Included">-->
                                       
                            <select name="bottom_included" class="form-control select2" >
                                <option selected value="{{$product->bottom_included}}">{{$product->bottom_included}}</option>
                                <option>YES</option>
                                <option>NO</option>
                            </select>  
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bottom Type</label>
                            <!--<input type="text" class="form-control" name="bottom_type" placeholder="Enter Bottom Type">-->
                            
                            <select name="bottom_type_2" class="form-control select2" >
                                    <option selected value="{{$product->bottom_type}}">{{$product->bottom_type}}</option>
                                 @foreach($attr as $bottomtype)
                                
                                    @if($bottomtype->bottom_type == Null)
                                       
                                    @else
                                       <option>{{$bottomtype->bottom_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Pattern</label>
                            <!--<input type="text" class="form-control" name="sleeve_pattern" placeholder="Enter Sleeve Pattern">-->
                            
                            <select name="sleeve_pattern_3" class="form-control select2" >
                                <option selected value="{{$product->sleeve_pattern}}">{{$product->sleeve_pattern}}</option>
                                 @foreach($attr as $sleevepat)
                                
                                    @if($sleevepat->sleeve_pattern == Null)
                                       
                                    @else
                                       <option>{{$sleevepat->sleeve_pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dupatta Fabric</label>
                            <!--<input type="text" class="form-control" name="dupatta_fabric" placeholder="Enter Dupatta Fabric">-->
                            
                                                        
                            <select name="dupatta_fabric" class="form-control select2" >
                                    <option selected value="{{$product->dupatta_fabric}}">{{$product->dupatta_fabric}}</option>
                                 @foreach($attr as $dupattafab)
                                
                                    @if($dupattafab->dupatta_type == Null)
                                       
                                    @else
                                       <option>{{$dupattafab->dupatta_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dupatta Length</label>
                            <input type="text" class="form-control" name="dupatta_length_2" placeholder="Enter Dupatta Length" value="{{$product->dupatta_length}}">
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >  
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                 
                                    @if($fab->fabric == Null)   
                                    
                                    @else     
                                    
                                        <option>{{$fab->fabric}}</option>                                
                                    @endif                                                             
                                @endforeach                         
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                
                                <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_4" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Dupatta & Shawls-->
                <div class="card Dupatta" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Dupatta/Shawl Type</label>
                            <input type="text" class="form-control" name="dupatta_shawl_type" placeholder="Enter Dupatta/Shawl Type" value="{{$product->dupatta_shawl_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Length</label>
                            <input type="text" class="form-control" name="length_1" placeholder="Enter Length" value="{{$product->length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Work Details</label>
                            <!--<input type="text" class="form-control" name="work_details" placeholder="Enter Work Details">-->
                            
                            <select name="work_details_1" class="form-control select2" >
                                <option selected value="{{$product->work_details}}">{{$product->work_details}}</option>
                                 @foreach($attr as $work)
                                
                                    @if($work->work_details == Null)
                                       
                                    @else
                                       <option>{{$work->work_details}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Border Type</label>
                            <!--<input type="text" class="form-control" name="border_type" placeholder="Enter Border Type">-->
                                                                                    
                            <select name="border_type_2" class="form-control select2" >
                                <option selected value="{{$product->border_type}}">{{$product->border_type}}</option>
                                 @foreach($attr as $bordertype)
                                
                                    @if($bordertype->border_type == Null)
                                       
                                    @else
                                       <option>{{$bordertype->border_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >    
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                      
                                    @if($fab->fabric == Null)
                                    
                                    @else                                     
                                    <option>{{$fab->fabric}}</option>                      
                                    @endif                                                
                                @endforeach                            
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_5" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Lehenga-->
                <div class="card Lehenga" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Lehenga Type</label>
                            <!--<input type="text" class="form-control" name="lehenga_type" placeholder="Enter Lehenga Type">-->
                            
                            <select name="lehenga_type" class="form-control select2" >
                                    <option selected value="{{$product->lehenga_type}}">{{$product->lehenga_type}}</option>
                                 @foreach($attr as $lehangatype)
                                
                                    @if($lehangatype->lehanga_type == Null)
                                       
                                    @else
                                       <option>{{$lehangatype->lehanga_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lehenga Length</label>
                            <input type="text" class="form-control" name="lehenga_length" placeholder="Enter Lehenga Length" value="{{$product->lehenga_length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Choli Included</label>
                            <input type="text" class="form-control" name="choli_included" value="{{$product->choli_included}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Choli Length</label>
                            <input type="text" class="form-control" name="choli_length" placeholder="Enter Choli Length" value="{{$product->choli_length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Choli Sleeve Length</label>
                            <input type="text" class="form-control" name="choli_sleeve_length" placeholder="Enter Choli Sleeve Length" value="{{$product->choli_sleeve_length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dupatta Included</label>
                            <input type="text" class="form-control" name="dupatta_included" placeholder="Enter Dupatta Included" value="{{$product->dupatta_included}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dupatta Length</label>
                            <input type="text" class="form-control" name="dupatta_length_3" placeholder="Enter Dupatta Length" value="{{$product->dupatta_length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Work Details</label>
                            <!--<input type="text" class="form-control" name="work_details" placeholder="Enter Work Details">-->
                            
                            <select name="work_details_2" class="form-control select2" >
                                <option selected value="{{$product->work_details}}">{{$product->work_details}}</option>
                                 @foreach($attr as $work)
                                
                                    @if($work->work_details == Null)
                                       
                                    @else
                                       <option>{{$work->work_details}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Flare Type</label>
                            <!--<input type="text" class="form-control" name="flare_type" placeholder="Enter Flare Type">-->
                            
                            
                            <select name="flare_type" class="form-control select2" >
                                    <option selected value="{{$product->flare_type}}">{{$product->flare_type}}</option>
                                 @foreach($attr as $flaretype)
                                
                                    @if($flaretype->flare_type == Null)
                                       
                                    @else
                                       <option>{{$flaretype->flare_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >       
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                           
                                    @if($fab->fabric == Null)    
                                    
                                    @else                                      
                                      <option>{{$fab->fabric}}</option>                               
                                    @endif                                                           
                                @endforeach                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
            
                
                <!--For Tops -->
                <div class="card top"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Top Type</label>
                            <input type="text" class="form-control" name="top_type" placeholder="Enter Top Type" value="{{$product->top_type}}">
                            
                            <select name="top_type" class="form-control select2" >
                                    <option selected value="{{$product->top_type}}">{{$product->top_type}}</option>
                                 @foreach($attr as $top)
                                
                                    @if($top->top_type == Null)
                                       
                                    @else
                                       <option>{{$top->top_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Length</label>
                            <!--<input type="text" class="form-control" name="sleeve_length" placeholder="Enter Sleeve Length">-->
                             
                            <select name="sleeve_length_2" class="form-control select2" >
                                <option selected value="{{$product->sleeve_length}}">{{$product->sleeve_length}}</option>
                                 @foreach($attr as $sleevelen)
                                
                                    @if($sleevelen->sleeve_length == Null)
                                       
                                    @else
                                       <option>{{$sleevelen->sleeve_length}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Neckline</label>
                            <input type="text" class="form-control" name="neckline" placeholder="Enter Neckline" value="{{$product->neckline}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_7" class="form-control select2">
                                <option value="{{$product->fit_type}}" selected>{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >            
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                               
                                    @if($fab->fabric == Null) 
                                    
                                    @else 
                                    
                                      <option>{{$fab->fabric}}</option>   
                                      
                                    @endif                                                  
                                @endforeach                          
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_8" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For T-shirt -->
                <div class="card tshirt" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">T-Shirt Type</label>
                            <!--<input type="text" class="form-control" name="tshirt_type" placeholder="Enter T-Shirt Type">-->
                            
                            
                            <select name="tshirt_type" class="form-control select2" >
                                    <option selected value="{{$product->tshirt_type}}">{{$product->tshirt_type}}</option>
                                 @foreach($attr as $tshirttype)
                                
                                    @if($tshirttype->tshirt_type == Null)
                                       
                                    @else
                                       <option>{{$tshirttype->tshirt_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Style</label>
                            <input type="text" class="form-control" name="sleeve_style" placeholder="Enter Sleeve Style" value="{{$product->sleeve_style}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Collar Type</label>
                            <input type="text" class="form-control" name="collar_type" placeholder="Enter Collar Type" value="{{$product->collar_type}}">
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >         
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                
                                    @if($fab->fabric == Null)  
                                    
                                    @else                                      
                                       <option>{{$fab->fabric}}</option>                        
                                    @endif                                                   
                                @endforeach                         
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_9" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                
                <!--For Shirt -->
                <div class="card shirt"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Shirt Type</label>
                            <input type="text" class="form-control" name="shirt_type" placeholder="Enter Shirt Type" value="{{$product->shirt_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Style</label>
                            <input type="text" class="form-control" name="sleeve_style" placeholder="Enter Sleeve Style" value="{{$product->sleeve_style}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <!--<input type="text" class="form-control" name="closure_type" placeholder="Enter Closure Type">-->
                            
                            <select name="closure_type_2" class="form-control select2" >
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                 @foreach($attr as $clo)
                                
                                    @if($clo->clousure_type == Null)
                                       
                                    @else
                                       <option>{{$clo->clousure_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" > 
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                              
                                    @if($fab->fabric == Null)                                                            
                                    @else                               
                                    <option>{{$fab->fabric}}</option>                        
                                    @endif                                                  
                                @endforeach                         
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_10" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Dresses -->
                <div class="card dresses"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Dress Type</label>
                            <input type="text" class="form-control" name="dress_type" placeholder="Enter Dress Type" value="{{$product->dress_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Hemline</label>
                            <!--<input type="text" class="form-control" name="hemline" placeholder="Enter Hemline">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $hemline)
                                
                                    @if($hemline->hemline == Null)
                                       
                                    @else
                                       <option>{{$hemline->hemline}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Pattern</label>
                            <!--<input type="text" class="form-control" name="sleeve_pattern" placeholder="Enter Sleeve Pattern">-->
                            
                            <select name="sleeve_pattern_4" class="form-control select2" >
                                <option selected value="{{$product->sleeve_pattern}}">{{$product->sleeve_pattern}}</option>
                                 @foreach($attr as $sleevepat)
                                
                                    @if($sleevepat->sleeve_pattern == Null)
                                       
                                    @else
                                       <option>{{$sleevepat->sleeve_pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dress Length</label>
                            <input type="text" class="form-control" name="dress_length" placeholder="Enter Dress Length" value="{{$product->dress_length}}">
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" > 
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                         
                                    @if($fab->fabric == Null)                                                         
                                    @else                                   
                                    <option>{{$fab->fabric}}</option>                              
                                    @endif                                                         
                                @endforeach                         
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_11" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Co-Ords -->
                <div class="card co-ords"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Set Type</label>
                            <input type="text" class="form-control" name="set_type_coord" placeholder="Enter Set Type" value="{{$product->set_type_coord}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Top Style</label>
                            <input type="text" class="form-control" name="top_style" placeholder="Enter Top Style" value="{{$product->top_style}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Bottom Style</label>
                            <input type="text" class="form-control" name="bottom_style" placeholder="Enter Bottom Style" value="{{$product->bottom_style}}">
                        </div>
                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >   
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                   
                                    @if($fab->fabric == Null)   
                                    
                                    @else                                   
                                        <option>{{$fab->fabric}}</option>                         
                                    @endif                                                    
                                @endforeach                           
                            </select>
                        </div> 
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_12" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Jumpsuits -->
                <div class="card jumpsuits"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Jumpsuit Type</label>
                            <input type="text" class="form-control" name="jumpsuit_type" placeholder="Enter Jumpsuit Type" value="{{$product->jumpsuit_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Leg Style</label>
                            <input type="text" class="form-control" name="leg_style" placeholder="Enter Leg Style" value="{{$product->leg_style}}">
                        </div>
                                       

                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >       
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                               
                                    @if($fab->fabric == Null)  
                                    
                                    @else                                    
                                        <option>{{$fab->fabric}}</option>                          
                                    @endif                                                      
                                @endforeach                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_13" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Shrugs -->
                <div class="card Shrugs"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Shrug Type</label>
                            <input type="text" class="form-control" name="shrug_type" placeholder="Enter Shrug Type" value="{{$product->shrug_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Length</label>
                            <input type="text" class="form-control" name="length_2" placeholder="Enter Length" value="{{$product->length}}">
                        </div>
                                       
                        
     

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" > 
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                            
                                    @if($fab->fabric == Null)                                                         
                                    @else                                  
                                        <option>{{$fab->fabric}}</option>                      
                                    @endif                                                 
                                @endforeach                          
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_15" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                
                <!--For Hoodies & Sweatshirts -->
                <div class="card hoodies"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Hoodie Type</label>
                            <input type="text" class="form-control" name="hoodie_type" placeholder="Enter Hoodie Type" value="{{$product->hoodie_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Hood Included</label>
                            <input type="text" class="form-control" name="hood_included" placeholder="Enter Hood Included" value="{{$product->hood_included}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pocket Type</label>
                            <input type="text" class="form-control" name="pocket_type" placeholder="Enter Pocket Type" value="{{$product->pocket_type}}">
                        </div>
                                       
                        
                       

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >            
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                    
                                    @if($fab->fabric == Null)                                                                
                                    @else                                      
                                        <option>{{$fab->fabric}}</option>                         
                                    @endif                                                    
                                @endforeach                        
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                    
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_16" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>

                <!--For Jackets and Coats -->
                <div class="card jackets"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Jacket Type</label>
                            <input type="text" class="form-control" name="jacket_type" placeholder="Enter Jacket Type" value="{{$product->jacket_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <!--<input type="text" class="form-control" name="closure_type" placeholder="Enter Closure Type">-->
                            
                            <select name="closure_type_3" class="form-control select2" >
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                 @foreach($attr as $clo)
                                
                                    @if($clo->clousure_type == Null)
                                       
                                    @else
                                       <option>{{$clo->clousure_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pocket Details</label>
                            <input type="text" class="form-control" name="pocket_details" placeholder="Enter Pocket Details" value="{{$product->pocket_details}}">
                        </div>
                                       
          

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >        
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                               
                                    @if($fab->fabric == Null)                                                                
                                    @else                                     
                                        <option>{{$fab->fabric}}</option>                        
                                    @endif                                                      
                                @endforeach                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_17" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>

                <!--For Playsuits -->
                <div class="card jackets"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Playsuit Type</label>
                            <input type="text" class="form-control" name="playsuit_type" placeholder="Enter Playsuit Type" value="{{$product->playsuit_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sleeve Length</label>
                            <!--<input type="text" class="form-control" name="sleeve_length" placeholder="Enter Sleeve Length">-->
                             
                            <select name="sleeve_length_3" class="form-control select2" >
                                <option selected value="{{$product->sleeve_length}}">{{$product->sleeve_length}}</option>
                                 @foreach($attr as $sleevelen)
                                
                                    @if($sleevelen->sleeve_length == Null)
                                       
                                    @else
                                       <option>{{$sleevelen->sleeve_length}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                     
                        </div>
                                       
                        
                        

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >                
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                               
                                    @if($fab->fabric == Null)                                                            
                                    @else                                     
                                        <option>{{$fab->fabric}}</option>                             
                                    @endif                                                        
                                @endforeach                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_18" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>

                <!--For Shackets -->
                <div class="card shackets"  style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Shacket Type</label>
                            <input type="text" class="form-control" name="shackett_type" placeholder="Enter Shacket Type" value="{{$product->shackett_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lining Present</label>
                            <input type="text" class="form-control" name="lining_present" placeholder="Enter Lining Present" value="{{$product->lining_present}}">
                        </div>
                                       
                        
                       

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >      
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                              
                                    @if($fab->fabric == Null)                                                            
                                    @else                                      
                                        <option>{{$fab->fabric}}</option>                  
                                    @endif                                            
                                @endforeach                            
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_20" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                

                <!--For Jeans-->
            
                
                <div class="card Jeans" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Waist Rise</label>
                            <input type="text" class="form-control" name="waist_rise" placeholder="Enter Waist Rise" value="{{$product->waist_rise}}">
                        </div>
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Fit Type</label>-->
                        <!--    <input type="text" class="form-control" name="fit_type" placeholder="Enter Fit Type">-->
                        <!--</div>-->
                        <div class="col-md-4">
                            <label class="form-label">Stretchability</label>
                            <input type="text" class="form-control" name="stretchability" placeholder="Enter Stretchability" value="{{$product->stretchability}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Distressed/Non-Distressed</label>
                            <!--<input type="text" class="form-control" name="distressed_non_distressed" placeholder="Enter Distressed/Non-Distressed">-->
                            <select class="form-control select2" name="distressed_non_distressed">
                                <option selected disabled>--Select Type--</option>
                                <option>Distressed</option>
                                <option>Non-Distressed</option>
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Number of Pockets</label>
                            <input type="text" class="form-control" name="number_of_pockets" placeholder="Enter Number of Pockets" value="{{$product->number_of_pockets}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <!--<input type="text" class="form-control" name="closure_type" placeholder="Enter Closure Type">-->
                            
                            <select name="closure_type_4" class="form-control select2" >
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                 @foreach($attr as $clo)
                                
                                    @if($clo->clousure_type == Null)
                                       
                                    @else
                                       <option>{{$clo->clousure_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
        
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >           
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                               
                                    @if($fab->fabric == Null)                                                            
                                    @else                                   
                                        <option>{{$fab->fabric}}</option>                       
                                    @endif                                                  
                                @endforeach                          
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_21" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                        
                    </div>
                </div>
                
                <!--For Trousers & Capris-->
                
                <div class="card Trousers" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Waistband Type</label>
                            <input type="text" class="form-control" name="waistband_type" placeholder="Enter Waistband Type" value="{{$product->waistband_type}}">
                        </div>
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Fit Type</label>-->
                        <!--    <input type="text" class="form-control" name="fit_type" placeholder="Enter Fit Type">-->
                        <!--</div>-->
                        <div class="col-md-4">
                            <label class="form-label">Length</label>
                            <input type="text" class="form-control" name="length_3" placeholder="Enter Length" value="{{$product->length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                            
                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >           
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                              
                                    @if($fab->fabric == Null)                                                            
                                    @else                                      
                                        <option>{{$fab->fabric}}</option>                            
                                    @endif                                                        
                                @endforeach                      
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_22" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                    </div>
                </div>
                
                
                <!--For Shorts & Skirts-->
                
                <div class="card Shorts" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Short/Skirt Type</label>
                            <input type="text" class="form-control" name="short_skirt_type" placeholder="Enter Short/Skirt Type" value="{{$product->short_skirt_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Waist Rise</label>
                            <input type="text" class="form-control" name="waist_rise" placeholder="Enter Waist Rise" value="{{$product->waist_rise}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <!--<input type="text" class="form-control" name="closure_type" placeholder="Enter Closure Type">-->
                            
                            <select name="closure_type_5" class="form-control select2" >
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                 @foreach($attr as $clo)
                                
                                    @if($clo->clousure_type == Null)
                                       
                                    @else
                                       <option>{{$clo->clousure_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Length</label>
                            <input type="text" class="form-control" name="length_4" placeholder="Enter Length" value="{{$product->length}}">
                        </div>
                        
                                                
                       

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >            
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                           
                                    @if($fab->fabric == Null)                                                        
                                    @else                                     
                                        <option>{{$fab->fabric}}</option>                          
                                    @endif                                        
                                @endforeach                          
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_23" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                        
                    </div>
                </div>


                <!--For Leggings & Tights-->
                <div class="card Leggings" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Legging Type</label>
                            <input type="text" class="form-control" name="legging_type" placeholder="Enter Legging Type" value="{{$product->legging_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Waistband Type</label>
                            <input type="text" class="form-control" name="waistband_type" placeholder="Enter Waistband Type" value="{{$product->waistband_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Compression Level</label>
                            <input type="text" class="form-control" name="compression_level" placeholder="Enter Compression Level" value="{{$product->compression_level}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Transparency Level</label>
                            <input type="text" class="form-control" name="transparency_level" placeholder="Enter Transparency Level" value="{{$product->transparency_level}}">
                                                        
                            <!--<select name="transparency_level" class="form-control select2" >-->
                            <!--        <option selected disabled>--Select Pattern--</option>-->
                            <!--     @foreach($attr as $pat)-->
                                
                            <!--        @if($pat->pattern == Null)-->
                                       
                            <!--        @else-->
                            <!--           <option>{{$pat->pattern}}</option>-->
                            <!--        @endif-->
                                   
                            <!--    @endforeach-->
                            <!--</select>-->
                            
                        </div>
                   
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >    
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                
                                    @if($fab->fabric == Null)                                                             
                                    @else                                   
                                      <option>{{$fab->fabric}}</option>                  
                                    @endif                                           
                                @endforeach                            
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_24" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">--Select Fit Type--</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                        
                    </div>
                </div>


                <!--For Plazos, Churidar & Salwars-->
                
                <div class="card Plazos" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Bottom Type</label>
                            <!--<input type="text" class="form-control" name="bottom_type" placeholder="Enter Bottom Type">-->
                            
                            <select name="bottom_type_3" class="form-control select2" >
                                    <option selected value="{{$product->bottom_type_3}}">{{$product->bottom_type_3}}</option>
                                 @foreach($attr as $bottomtype)
                                
                                    @if($bottomtype->bottom_type == Null)
                                       
                                    @else
                                       <option>{{$bottomtype->bottom_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Waistband Type</label>
                            <input type="text" class="form-control" name="waistband_type" placeholder="Enter Waistband Type" value="{{$product->waistband_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Length</label>
                            <input type="text" class="form-control" name="length_5" placeholder="Enter Length" value="{{$product->length}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pleated/Non-Pleated</label>
                            <input type="text" class="form-control" name="pleated_non_pleated" placeholder="Enter Pleated/Non-Pleated" value="{{$product->pleated_non_pleated}}">
                        </div>
     
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >          
                            <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                 
                                    @if($fab->fabric == Null)                                                             
                                    @else                                     
                                        <option>{{$fab->fabric}}</option>                            
                                    @endif                                                       
                                @endforeach                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_25" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                        
                    </div>
                </div>

                <!--For Hot Pants -->
                
                <div class="card Hot" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Waist Type</label>
                            <input type="text" class="form-control" name="waist_type" placeholder="Enter Waist Type" value="{{$product->waist_type}}">
                        </div>
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Fit Type</label>-->
                        <!--    <input type="text" class="form-control" name="fit_type" placeholder="Enter Fit Type">-->
                        <!--</div>-->
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <!--<input type="text" class="form-control" name="closure_type" placeholder="Enter Closure Type">-->
                            
                            <select name="closure_type_6" class="form-control select2" >
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                 @foreach($attr as $clo)
                                
                                    @if($clo->clousure_type == Null)
                                       
                                    @else
                                       <option>{{$clo->clousure_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pockets</label>
                            <input type="text" class="form-control" name="pockets" placeholder="Enter Pockets" value="{{$product->pockets}}">
                        </div>
                        
                         

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>                        
                                @foreach($attr as $fab)                                                           
                                    @if($fab->fabric == Null)                                                         
                                    @else                                    
                                     <option>{{$fab->fabric}}</option>                        
                                    @endif                                                   
                                @endforeach                           
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_26" class="form-control select2" >
                                <option selected value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                        
                    </div>
                </div>

                <!--For Cargos & Parachutes-->
                
                <div class="card Cargos" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">            
                        <div class="col-md-4">
                            <label class="form-label">Cargo Type</label>
                            <input type="text" class="form-control" name="cargo_type" placeholder="Enter Cargo Type" value="{{$product->cargo_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pocket Details</label>
                            <input type="text" class="form-control" name="pocket_details" placeholder="Enter Pocket Details" value="{{$product->pocket_details}}">
                        </div>
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Fit Type</label>-->
                        <!--    <input type="text" class="form-control" name="fit_type" placeholder="Enter Fit Type">-->
                        <!--</div>-->
                        <div class="col-md-4">
                            <label class="form-label">Waistband Type</label>
                            <input type="text" class="form-control" name="waistband_type" placeholder="Enter Waistband Type" value="{{$product->waistband_type}}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Length</label>
                            <input type="text" class="form-control" name="length_6" value="{{$product->length}}">
                        </div>
                        
                                                                                                                                       
                        
                        <!--<div class="col-md-4">-->
                        <!--    <label class="form-label">Color</label>-->
                            
                            
                        <!--    <div class="custom-dropdown">-->
                        <!--        <div class="dropdown-btn" id="selectedColor">-->
                        <!--            <div class="color-box"></div>-->
                        <!--            <span style="text-align center">--Select a Color--</span>-->
                        <!--        </div>-->
                        <!--        <div class="dropdown-list" id="dropdownContainer">-->
                        <!--            <input type="text" class="search-box" id="searchColor" placeholder="Search color...">-->
                        <!--            <ul id="colorList">-->
                        <!--                @foreach($colors as $clr)-->
                        <!--                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">-->
                        <!--                    <div class="color-box" style="background: {{ $clr->hex_code }};"></div> {{ $clr->color_name }}-->
                        <!--                </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            
                            <!-- Hidden input to store the selected color -->
                            

                        <!--</div>-->
                        
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
      
                            <select name="fabric" class="form-control select2" >
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                 @foreach($attr as $fab)
                                
                                    @if($fab->fabric == Null)
                                       
                                    @else
                                       <option>{{$fab->fabric}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pattern</label>
                            <!--<input type="text" class="form-control" name="pattern" placeholder="Enter Pattern">-->
                            
                            
                            <select name="pattern" class="form-control select2" >
                                    <option selected value="{{$product->pattern}}">{{$product->pattern}}</option>
                                 @foreach($attr as $pat)
                                
                                    @if($pat->pattern == Null)
                                       
                                    @else
                                       <option>{{$pat->pattern}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fit Type</label>
                            <!--<input type="text" class="form-control" name="fit_type">-->
                            <select name="fit_type_19" class="form-control select2" >
                                <option selected  value="{{$product->fit_type}}">{{$product->fit_type}}</option>
                                 @foreach($attr as $fit)
                                
                                    @if($fit->fit_type == Null)
                                       
                                    @else
                                       <option>{{$fit->fit_type}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Occasion</label>
                            <select class="form-control select2" name="occasion">
                                <option selected value="{{$product->occasion}}">{{$product->occasion}}</option>
                                @foreach($attr as $occasion)
                                
                                    @if($occasion->occasion == Null)
                                       
                                    @else
                                       <option>{{$occasion->occasion}}</option>
                                    @endif
                                   
                                @endforeach
                            </select>
                            
                        </div>
                        
                        
                        
                    </div>
                </div>
                
                
                <!--For Footware-->
                
                <div class="card footware" style="display:none;">
                    <h6 class="card-title">{{$subsubcat}} Details</h6>
                    <div class="row g-3">          
                    
                   
                        
                               <div class="col-md-4">
                            <label class="form-label">Sole Material</label>
                            <select class="form-control select2" name="sole_material">
                                <option selected value="{{$product->sole_material}}">{{$product->sole_material}}</option>
                                <option>Rubber</option>
                                <option>EVA</option>
                                <option>Thermoplastic Elastomers</option>
                                <option>TPR (Thermoplastic Rubber)</option>
                                <option>PU (Polyurethane)</option>
                                <option>PVC (Polyvinyl Chloride)</option>
                                <option>Leather</option>
                                <option>Phylon</option>
                                <option>Resin</option>
                                <option>Crepe</option>
                                <option>Cork</option>
                                <option>Foam</option>
                                <option>Synthetic</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Upper Material</label>
                            <select class="form-control select2" name="upper_material">
                                <option selected value="{{$product->sole_material}}">{{$product->upper_material}}</option>
                                <option>Leather</option>
                                <option>Synthetic Leather</option>
                                 <option>Synthetic</option>
                                 <option>PVC</option>
                                 <option>Rexine</option>
                                <option>Flyknit Upper</option>
                                <option>Mesh</option>
                                <option>Canvas</option>
                                <option>Suede</option>
                                <option>Knitted Fabric</option>
                                <option>Textile</option>
                                <option>Denim</option>
                                <option>Nubuck</option>
                                <option>Faux Leather</option>
                                <option>Satin</option>
                                <option>Velvet</option>
                                <option>Neoprene</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Closure Type</label>
                            <select class="form-control select2" name="closure_type_7">
                                <option selected value="{{$product->closure_type}}">{{$product->closure_type}}</option>
                                <option>Lace-Up</option>
                                <option>Slip-On</option>
                                <option>Velcro</option>
                                <option>Buckle</option>
                                <option>Zip</option>
                                <option>Hook & Loop</option>
                                <option>Button</option>
                                <option>Toggle</option>
                                <option>Tie-Up</option>
                                <option>Elastic Strap</option>
                                <option>Snap Fastener</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Toe Shape</label>
                            <select class="form-control select2" name="toe_shape">
                                <option selected value="{{$product->toe_shape}}">{{$product->toe_shape}}</option>
                                <option>Round Toe</option>
                                <option>Pointed Toe</option>
                                <option>Square Toe</option>
                                <option>Open Toe</option>
                                <option>Almond Toe</option>
                                <option>Peep Toe</option>
                                <option>Closed Toe</option>
                                <option>Tapered Toe</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Heel Type</label>
                            <select class="form-control select2" name="heel_type">
                                <option selected value="{{$product->heel_type}}">{{$product->heel_type}}</option>
                                <option>Flat</option>
                                <option>Block Heel</option>
                                <option>Wedge Heel</option>
                                <option>Stiletto Heel</option>
                                <option>Platform Heel</option>
                                <option>Cone Heel</option>
                                <option>Kitten Heel</option>
                                <option>Cuban Heel</option>
                                <option>Flare Heel</option>
                                <option>Comma Heel</option>
                            </select>
                        </div>
                                                
                        
                        
                    </div>
                </div>
                
                
                
                <!--For Kids-->
                
                <div class="card Kids" style="display:none;">
                    <h6 class="card-title">{{$cat}} Details</h6>
                    <div class="row g-3">          
                    
                        <div class="col-md-4">
                            <label class="form-label">Fabric</label>
                            <select name="fabric" class="form-control select2" >    
                            
                                <option selected value="{{$product->fabric}}">{{$product->fabric}}</option>
                                @foreach($attr as $fab)                                                                      
                                    @if($fab->fabric == Null)                                                                             
                                        
                                    @else                                        
                                    <option>{{$fab->fabric}}</option>                                     
                                    @endif                                                                     
                                @endforeach                             
                            </select>
                        </div>
                        
                        
                        
                    </div>
                </div>

                <!-- Pricing -->
               
                <!-- Inventory -->
                <div id="card_container">
                    <div class="card">
                        <!--<h6 class="card-title">-->
                        <!--<div class="action_container"><button type="button" class="success" onclick="create_card()"><i class="fa fa-plus"></i></button></div></h6>-->
                        <div class="card-title">
                            <div class="row g-3">
                                 <div class="col-md-2">Inventory Details</div>
                                 <div class="col-md-8"></div>
                                 <div class="col-md-2"> <div class="action_container">
                                     <a href="#"  onclick="create_card()">Add New <i class="fa fa-plus"></i></a>
                                     <!--<button type="button" class="success btn-sm" onclick="create_card()">Add New <i class="fa fa-plus"></i></button>-->
                                     
                                 </div></div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Size</label>
                                            <select class="form-control select2 size_select" name="size" style="width:100%" onchange="updateHiddenInput()">
                                                <option value="{{$product->size_name}}" selected>{{$product->size_name}}</option>
                                                @foreach($size as $sz)
                                                    @if(is_array($sz->details) || is_object($sz->details))
                                                        @foreach($sz->details as $dt)
                                                            <option value="{{ $dt }}">{{ $dt }}</option>
                                                        @endforeach
                                                    @else
                                                        <?php $details = json_decode($sz->details); ?>
                                                        @foreach($details as $dt)
                                                            <option value="{{ $dt }}">{{ $dt }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Quantity</label>
                                            <input type="text" class="form-control quantity_input" name="quantity" placeholder="Enter Quantity" oninput="updateHiddenInput()" value="{{$product->stock_quantity}}"  placeholder="Enter Quantity">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">SKU</label>
                                            <input type="text" class="form-control" name="sku" placeholder="Enter SKU Code" value="{{$product->sku}}">
                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                            <label class="form-label">Maximum Retail Price</label>
                                            <input type="number" class="form-control" name="maximum_retail_price" placeholder="Enter Maximum Retail Price" value="{{$product->maximum_retail_price}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Bank Settlement Price</label>
                                            <input type="number" class="form-control" name="bank_settlement_price" placeholder="Enter Bank Settlement Price" value="{{$product->bank_settlement_price}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Portal Updated Price</label>
                                            <input type="number" class="form-control" name="portal_updated_price" placeholder="Enter Portal Updated Price" value="{{$product->portal_updated_price}}">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="size_quantity_data" name="stock_quantity">
                            </div>
                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">SKU</label>-->
                            <!--    <input type="text" class="form-control" name="sku">-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>

                <!-- Shipping -->
                <div class="card">
                    <h6 class="card-title">Shipping Details</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Shipping Time (In Minutes)</label>
                            <input type="text" class="form-control" name="shipping_time" value="15" readonly value="{{$product->shipping_time}}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pack of</label>
                            <input type="text" class="form-control" name="pack_of"  placeholder="Enter Pack of" value="{{$product->pack_of}}">
                        </div>
                        <div class="col-md-6" hidden>
                            <label class="form-label">Return Policy</label>
                            <input type="text" class="form-control" name="return_policy"  placeholder="Enter Return Policy" value="{{$product->return_policy}}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Package Weight (kg)</label>
                            <input type="number" class="form-control" name="package_weight"  placeholder="Enter Package Weight (kg)" value="{{$product->package_weight}}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Length (cm)</label>
                            <input type="number" class="form-control" name="package_length" placeholder="Enter Length (cm)" value="{{$product->package_length}}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Width (cm)</label>
                            <input type="number" class="form-control" name="package_breadth" placeholder="Enter Width (cm)" value="{{$product->package_breadth}}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Height (cm)</label>
                            <input type="number" class="form-control" name="package_height" placeholder="Enter Height (cm)" value="{{$product->package_height}}">
                        </div>
                    </div>
                </div>

                <!-- Manufacturing -->
                <div class="card">
                    <h6 class="card-title">Manufacturing Details</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Country of Origin</label>
                             <select id="country" name="country_of_origin" class="form-control select2">
                                 <option value="{{$product->country_of_origin}}" selected>{{$product->country_of_origin}}</option>
                                 <option value="India">India</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Åland Islands">Åland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                           
                        </div>

                        <div class="col-6">
                            <label class="form-label">Manufacturer Details</label>
                            <!--<textarea class="form-control" name="manufacturer_details" rows="2"></textarea>-->
                            <input type="text" class="form-control" name="manufacturer_details" value="{{$product->manufacturer_details}}"  placeholder="Enter Manufacturer Details">
                        </div>
                        
                        <div class="col-6">
                            <label class="form-label">Packer Details</label>
                            <!--<textarea class="form-control" name="packer_details" rows="2"></textarea>-->
                            <input type="text" class="form-control" name="packer_details" value="{{$product->packer_details}}"  placeholder="Enter Packer Details">
                        </div>
                        
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="card">
                    <h6 class="card-title">Additional Information</h6>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Video URL</label>
                            <input type="url" class="form-control" name="video_url" value="{{$product->video_url}}" placeholder="Enter Video URL">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Procurement Type</label>
                            <input type="text" class="form-control" name="procurement_type" value="{{$product->procurement_type}}" value="Ready Stock" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Listing Status</label>
                            <select class="form-control select2" name="listing_status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Care Instructions</label>
                            <!--<textarea class="form-control" name="care_instructions" rows="2"></textarea>-->
                            
                            <select class="form-control select2" name="care_instructions">
                                <option selected value="{{$product->care_instructions}}">{{$product->care_instructions}}</option>
                                @foreach($attr as $care)
                                @if($care->care_instructions == Null)
                                   
                                @else
                                   <option>{{$care->care_instructions}}</option>
                                @endif 
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" hidden>
                            <label class="form-label">Seller ID</label>
                            <input type="text" class="form-control" name="seller_id"  value="{{$product->seller_id}}" readonly>
                        </div>

       
                        <div class="col-md-6" hidden>
                            <label class="form-label">Added By</label>
                            <input type="text" class="form-control" value="Seller" name="added_by" placeholder="Enter Added By" value="{{$product->added_by}}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" value="{{$product->description}}" id="editor">{{$product->description}}</textarea>
                        </div>
                    </div>
                </div>
            
        </div>

        <!-- Right Column (20%) -->
        <div class="right-column" style="height:20px;">
            <!-- Product Images -->
            <div class="card">
                <h6 class="card-title">Product Images</h6>
         
                <div class="upload-box">
                    <span class="upload-label ">Gallery Images (600x600)</span>/.  
                    <input type="file" name="images[]" class="form-control form-control-sm mt-3" multiple value="{{$product->images}}">
                    
                    <input type="hidden" value="{{$product->images}}">
                </div>
            </div>




                    <button class="mt-4 w-100 btn" >Save</button>
            
                </form>
                
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Get URL parameters
                        const main = @json($cat);
                        const sub =  @json($subcat);
                        const type = @json($subsubcat);
                        
                        
                    
                        // Select variant divs
                        const tshirt = document.querySelector(".tshirt");
                        const shirt = document.querySelector(".shirt");
                        const top = document.querySelector(".top");
                        const dresses = document.querySelector(".dresses");
                        const coOrds = document.querySelector(".co-ords"); // Fixed variable name
                        const jumpsuits = document.querySelector(".jumpsuits"); // Fixed variable name
                        const Shrugs = document.querySelector(".Shrugs");
                        const Hoodies = document.querySelector(".hoodies");
                        const jackets = document.querySelector(".jackets");
                        const shackets = document.querySelector(".shackets");
                        const Sarees = document.querySelector(".Sarees");
                        const Gowns = document.querySelector(".Gowns");
                        const Tunics = document.querySelector(".Tops-Tunics-Kurtis");
                        const Kurtas = document.querySelector(".Kurtas");
                        const Dupatta = document.querySelector(".Dupatta");
                        const Lehenga = document.querySelector(".Lehenga");
                        const Jeans = document.querySelector(".Jeans");
                        const Trousers = document.querySelector(".Trousers");
                        const Shorts = document.querySelector(".Shorts");
                        const Leggings = document.querySelector(".Leggings");
                        const Plazos = document.querySelector(".Plazos");
                        const Hot = document.querySelector(".Hot");
                        const Cargos = document.querySelector(".Cargos");
                        const footware = document.querySelector(".footware");
                        
                        // Hide all initially   
                        if (tshirt) tshirt.style.display = "none";
                        if (shirt) shirt.style.display = "none";
                        if (top) top.style.display = "none";
                        if (dresses) dresses.style.display = "none";
                        if (coOrds) coOrds.style.display = "none";
                        if (jumpsuits) jumpsuits.style.display = "none";
                        if (Shrugs) Shrugs.style.display = "none";
                        if (Hoodies) Hoodies.style.display = "none";
                        if (jackets) jackets.style.display = "none";
                        if (shackets) shackets.style.display = "none";
                        if (Sarees) Sarees.style.display = "none";
                        if (Gowns) Gowns.style.display = "none";
                        if (Tunics) Tunics.style.display = "none";  
                        if (Kurtas) Kurtas.style.display = "none";
                        if (Dupatta) Dupatta.style.display = "none";
                        if (Lehenga) Lehenga.style.display = "none";
                        if (Jeans) Jeans.style.display = "none";
                        if (Trousers) Trousers.style.display = "none";
                        if (Shorts) Shorts.style.display = "none";
                        if (Leggings) Leggings.style.display = "none";
                        if (Plazos) Plazos.style.display = "none";
                        if (Hot) Hot.style.display = "none";
                        if (Cargos) Cargos.style.display = "none";
                        if (footware) footware.style.display = "none";
                        
                        // Show based on conditions  
                        if (main === "Men" && sub === "Topwear" && type === "T-Shirts") {
                            if (tshirt) tshirt.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "T-Shirts") {
                            if (tshirt) tshirt.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Topwear" && type === "Shirts") {
                            if (shirt) shirt.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Shirts") {
                            if (shirt) shirt.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Tops") {
                            if (top) top.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Dresses") {
                            if (dresses) dresses.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Topwear" && type === "Co-Ords") {
                            if (coOrds) coOrds.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Co-Ords") {
                            if (coOrds) coOrds.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Jumpsuits") {
                            if (jumpsuits) jumpsuits.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Shrugs") {
                            if (Shrugs) Shrugs.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Hoodie & Sweatshirts") {
                            if (Hoodies) Hoodies.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Topwear" && type === "Sweatshirts") {
                            if (Hoodies) Hoodies.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Jackets & Coats") {
                            if (jackets) jackets.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Topwear" && type === "Jackets") {
                            if (jackets) jackets.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Western Wear" && type === "Shackets") {
                            if (shackets) shackets.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Topwear" && type === "Shackets") {
                            if (shackets) shackets.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Indian & Fusion Wear" && type === "Sarees") {
                            if (Sarees) Sarees.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Indian & Fusion Wear" && type === "Gowns") {
                            if (Gowns) Gowns.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Indian & Fusion Wear" && type === "Tops, Tunics & Kurtis") {
                            if (Tunics) Tunics.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Indian & Fusion Wear" && type === "Kurtas & Sets") {
                            if (Kurtas) Kurtas.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Indian & Fusion Wear" && type === "Dupatta & Shawls") {
                            if (Dupatta) Dupatta.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Indian & Fusion Wear" && type === "Lehenga") {
                            if (Lehenga) Lehenga.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Jeans") {
                            if (Jeans) Jeans.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Bottom Wear" && type === "Jeans") {
                            if (Jeans) Jeans.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Trousers & Capris") {
                            if (Trousers) Trousers.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Bottom Wear" && type === "Trousers") {
                            if (Trousers) Trousers.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Bottom Wear" && type === "Track pants & Joggers") {
                            if (Trousers) Trousers.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Shorts & Skirts") {
                            if (Shorts) Shorts.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Bottom Wear" && type === "Shorts") {
                            if (Shorts) Shorts.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Leggings & Tights") {
                            if (Leggings) Leggings.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Plazos, Churidar & Salwars") {
                            if (Plazos) Plazos.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Hot Pants") {
                            if (Hot) Hot.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Bottom Wear" && type === "Cargos & Parachutes") {
                            if (Cargos) Cargos.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Bottom Wear" && type === "Cargos & Parachutes ") {
                            if (Cargos) Cargos.style.display = "block";
                        }
                        else if (main === "Women" && sub === "Footwear") {
                            if (footware) footware.style.display = "block";
                        }
                        else if (main === "Men" && sub === "Footwear") {
                            if (footware) footware.style.display = "block";
                        }
                        
                    });

                    </script>
                    
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                <script>
                
                    $(document).ready(function() {
                    $('.select2').select2({
                        tags: true,
                        createTag: function (params) {
                            const term = $.trim(params.term);
                            if (term !== '') {
                                return {
                                    id: params.term,
                                    text: params.term ,
                                    classes: 'add-new-option'
                                };
                            }
                        },
                        templateResult: function (data) {
                            return $('<span>').text(data.text).addClass(data.classes); // Preserve classes
                        }
                    });
                    $('.select2-2').select2({
                        tags: true,
                        createTag: function (params) {
                            const term = $.trim(params.term);
                            if (term !== '') {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    classes: 'new-option'
                                };
                            }
                        },
                        templateResult: function (data) {
                            return $('<span>').text(data.text).addClass(data.classes); // Preserve classes
                        }
                    });
                    $('.select2-3').select2({
                        tags: true,
                        createTag: function (params) {
                            const term = $.trim(params.term);
                            if (term !== '') {
                                return {
                                    id: params.term,
                                    text: params.term,
                                    classes: 'new-option style-2'
                                };
                            }
                        },
                        templateResult: function (data) {
                            return $('<span>').text(data.text).addClass(data.classes); // Preserve classes
                        }
                    });
                });
                </script>
                
         <script>
          
     document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('input[name="images[]"]');
    
    // Create preview container
    let previewContainer = document.querySelector('.image-preview-container');
    if (!previewContainer) {
        previewContainer = document.createElement('div');
        previewContainer.className = 'image-preview-container mt-3 d-flex flex-wrap gap-2';
        fileInput.parentNode.insertAdjacentElement('afterend', previewContainer);
    }
    
    // Style for preview
    const style = document.createElement('style');
    style.textContent = `
        .image-preview-container {max-height:420px; overflow:scroll; scrollbar-width:none; }
        .image-preview { width: 200px; height: 200px; object-fit: fill; border: 1px solid #ddd; border-radius: 4px; }
        .preview-wrapper { position: relative; margin: 5px;}
        .remove-preview { position: absolute; top: -5px; right: -8px; background: #ff4444; color: white; border-radius: 50%; width: 20px; height: 20px; text-align: center; cursor: pointer; font-size: 12px; }
    `;
    document.head.appendChild(style);
    
    // Parse product images from the value attribute
    let productImages = [];
    try {
        // Get product images from the input value attribute
        const imagesValue = fileInput.getAttribute('value') || '[]';
        
        // Check if it's a JSON array or comma-separated string
        if (imagesValue.startsWith('[')) {
            productImages = JSON.parse(imagesValue);
        } else {
            // Handle comma-separated string format
            productImages = imagesValue.split(',').filter(img => img.trim() !== '');
        }
    } catch (e) {
        console.error('Error parsing product images:', e);
    }
    
    // Store currently selected files
    let selectedFiles = [];
    const dataTransfer = new DataTransfer();
    
    // Function to update previews
    function updatePreviews() {
        previewContainer.innerHTML = ''; // Clear previous previews
        
        // Add existing product images first
        productImages.forEach((imagePath, index) => {
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'preview-wrapper';
            previewWrapper.dataset.type = 'existing';
            previewWrapper.dataset.index = index;
            
            const img = document.createElement('img');
            // Handle both relative and absolute paths
            img.src = imagePath.startsWith('http') ? imagePath : `/${imagePath.replace(/^\//, '')}`;
            img.className = 'image-preview';
            img.alt = 'Product image';
            
            const removeButton = document.createElement('div');
            removeButton.className = 'remove-preview';
            removeButton.innerHTML = '×';
            
            previewWrapper.appendChild(img);
            previewWrapper.appendChild(removeButton);
            previewContainer.appendChild(previewWrapper);
            
            // Remove existing image functionality
            removeButton.onclick = function() {
                previewWrapper.remove();
                productImages.splice(index, 1);
                updatePreviews(); // Refresh to update indices
                
                // Create hidden input to track removed images
                let removedInput = document.querySelector('input[name="removed_images"]');
                if (!removedInput) {
                    removedInput = document.createElement('input');
                    removedInput.type = 'hidden';
                    removedInput.name = 'removed_images';
                    fileInput.parentNode.appendChild(removedInput);
                }
                removedInput.value = removedInput.value ? 
                    removedInput.value + ',' + imagePath : 
                    imagePath;
            };
        });
        
        // Add newly selected files
        selectedFiles.forEach((fileData, index) => {
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'preview-wrapper';
            previewWrapper.dataset.type = 'new';
            
            const img = document.createElement('img');
            img.src = fileData.dataURL;
            img.className = 'image-preview';
            img.alt = fileData.name;
            
            const removeButton = document.createElement('div');
            removeButton.className = 'remove-preview';
            removeButton.innerHTML = '×';
            
            previewWrapper.appendChild(img);
            previewWrapper.appendChild(removeButton);
            previewContainer.appendChild(previewWrapper);
            
            // Remove new image functionality
            removeButton.onclick = function() {
                previewWrapper.remove();
                selectedFiles.splice(index, 1);
                
                // Rebuild the DataTransfer object
                const newDataTransfer = new DataTransfer();
                selectedFiles.forEach(fileData => {
                    if (fileData.file) {
                        newDataTransfer.items.add(fileData.file);
                    }
                });
                fileInput.files = newDataTransfer.files;
                
                updatePreviews(); // Refresh to update indices
            };
        });
    }
    
    // Initialize with existing product images
    updatePreviews();
    
    // Handle new file selection
    fileInput.addEventListener('change', function(e) {
        const newFiles = Array.from(this.files);
        const filePromises = newFiles.map(file => {
            return new Promise(resolve => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    resolve({
                        dataURL: e.target.result,
                        name: file.name,
                        size: file.size,
                        type: file.type,
                        file: file
                    });
                };
                reader.readAsDataURL(file);
            });
        });
        
        Promise.all(filePromises).then(newFilesData => {
            // Add new files to selected files
            selectedFiles = [...selectedFiles, ...newFilesData];
            
            // Rebuild the DataTransfer object
            const newDataTransfer = new DataTransfer();
            selectedFiles.forEach(fileData => {
                if (fileData.file) {
                    newDataTransfer.items.add(fileData.file);
                }
            });
            fileInput.files = newDataTransfer.files;
            
            updatePreviews();
        });
    });
});

     </script>
        <!-- Include CKEditor script -->
        <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
        
        <script>
            window.CKEDITOR = window.CKEDITOR || {};
            window.CKEDITOR.disableAutoInline = true;
            console.warn = function () {}; // Disables all console warnings
        
            CKEDITOR.replace('editor', {
                toolbar: [
                    { name: 'document', items: ['-'] },
                    { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
                    { name: 'editing', items: ['SelectAll'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList','Blockquote'] },
                    { name: 'insert', items: ['Image','HorizontalRule'] },
                    { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                    // { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                ],
                height: 200, // Set the desired height here
                on: {
                    instanceReady: function (ev) {
                        console.warn = function () {}; // Suppress console warnings
                    }
                }
            });
        
            // Disable CKEditor version check
            CKEDITOR.config.versionCheck = false;
        </script>



    
    
    
    <!-- jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#countryDropdown').select2({
                placeholder: "Select a country",
                allowClear: true
            });
        });
    </script>

    <script>
    
        $(document).ready(function () {
            
            // Event delegation for color selection
            $(document).on("click", "#colorList li", function () {
                let selectedColor = $(this).data("color");
                let colorName = $(this).text().trim();
        
                let dropdown = $(this).closest(".col-md-4"); // Find parent container
        
                // Update the dropdown button text and color preview
                dropdown.find("#selectedColor").html(
                    `<div class="color-box" style="background: ${selectedColor};"></div> ${colorName}`
                );
        
                // Store selected color in hidden input field
                dropdown.find("#selectedColorInput").val(selectedColor);
        
                // Hide dropdown after selection
                dropdown.find("#dropdownContainer").hide();
            });
        
            // Toggle dropdown visibility on button click
            $(document).on("click", "#selectedColor", function (event) {
                event.stopPropagation(); // Prevent immediate closing
        
                let dropdown = $(this).closest(".col-md-4").find("#dropdownContainer");
                $(".dropdown-list").not(dropdown).hide(); // Hide other dropdowns
                dropdown.toggle(); // Toggle clicked dropdown
            });
        
            // Search function for filtering color list
            $(document).on("input", "#searchColor", function () {
                let filter = $(this).val().toLowerCase();
                let dropdown = $(this).closest(".col-md-4"); // Find parent container
        
                dropdown.find("#colorList li").each(function () {
                    $(this).toggle($(this).text().toLowerCase().includes(filter)); // Filter list
                });
            });
        
            // Close dropdown when clicking outside
            $(document).click(function (event) {
                if (!$(event.target).closest(".custom-dropdown").length) {
                    $(".dropdown-list").hide(); // Close all dropdowns
                }
            });
        });


        
            
    </script>
    <script>
    
    document.querySelectorAll(`
            .tshirt, .shirt, .top, .dresses, .co-ords, .jumpsuits, .Shrugs, 
            .hoodies, .jackets, .shackets, .Sarees, .Gowns, .Tops-Tunics-Kurtis, 
            .Kurtas, .Dupatta, .Lehenga, .Jeans, .Trousers, .Shorts, .Leggings, 
            .Plazos, .Hot, .Cargos, .footware`).forEach((div, index) => { // Use index to make IDs unique
            
            let currentColorHex = "{{ $currentColorHex }}";
            let currentColorName = "{{ $currentColorName }}";
            
            div.innerHTML += `
                <div class="col-md-4 my-2">
                    <label class="form-label">Color</label><br>
                    <div class="custom-dropdown">
                        <div class="dropdown-btn" id="selectedColor${index}">
                            <div class="color-box" style="background: ${currentColorHex}; width: 20px; height: 20px; border: 1px solid #000; display: inline-block; margin-right: 5px;"></div>
                             <span>${currentColorName}</span>
                        </div>
                        <div class="dropdown-list" id="dropdownContainer${index}" style="display: none;">
                            <input type="text" class="search-box" id="searchColor${index}" placeholder="Search color...">
                            <ul id="colorList${index}">
                                @foreach($colors as $clr)
                                <li data-color="{{ $clr->hex_code }}" data-name="{{ $clr->color_name }}">
                                    <div class="color-box" style="background: {{ $clr->hex_code }}; width: 20px; height: 20px; display: inline-block; border: 1px solid #000;"></div> 
                                    {{ $clr->color_name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            `;
        });
        
        // Ensure jQuery runs when the page is fully loaded
        $(document).ready(function () {
            // Open dropdown when clicking the button
            $(document).on("click", "[id^=selectedColor]", function (event) {
                event.stopPropagation(); // Prevents immediate closing
                let dropdownId = $(this).attr("id").replace("selectedColor", "dropdownContainer");
                $("#" + dropdownId).toggle(); // Toggle corresponding dropdown
            });
        
            // Handle color selection
            $(document).on("click", "[id^=colorList] li", function () {
                let selectedColor = $(this).attr("data-color"); // Get color hex
                let colorName = $(this).attr("data-name"); // Get color name
                let parentId = $(this).closest("ul").attr("id").replace("colorList", "selectedColor");
        
                if (selectedColor && colorName) {
                    console.log("Selected Color:", selectedColor, "Color Name:", colorName); // Debugging
        
                    // Update the dropdown button text and color preview
                    $("#" + parentId).html(
                        `<div class="color-box" style="background: ${selectedColor}; width: 20px; height: 20px; display: inline-block; border: 1px solid #000; margin-right: 5px;"></div> <span>${colorName}</span>`
                    );
                    
                    // ✅ Store selected color name in the hidden input field
                     $("#selectedColorInput").val(colorName);
        
                    // Hide dropdown after selection
                    $(this).closest(".dropdown-list").hide();
                } else {
                    console.error("Color selection error!");
                }
            });
        
            // Search function for filtering colors
            $(document).on("input", "[id^=searchColor]", function () {
                let filter = $(this).val().toLowerCase();
                $(this).closest(".dropdown-list").find("li").each(function () {
                    $(this).toggle($(this).attr("data-name").toLowerCase().includes(filter));
                });
            });
        
            // Close dropdown when clicking outside
            $(document).click(function (event) {
                if (!$(event.target).closest(".custom-dropdown").length) {
                    $(".dropdown-list").hide();
                }
            });
        });
        
        
        

    </script>
    <script>
        function updateHiddenInput() {
            let cards = document.querySelectorAll(".card");
            let data = [];
            
            cards.forEach((card) => {
                let sizeSelect = card.querySelector(".size_select");
                let quantityInput = card.querySelector(".quantity_input");
                let skuInput = card.querySelector("input[name='sku']");
                let mrpInput = card.querySelector("input[name='maximum_retail_price']");
                let bspInput = card.querySelector("input[name='bank_settlement_price']");
                
                let pupInput = card.querySelector("input[name='portal_updated_price']");
               
                
            
                
                if (sizeSelect && quantityInput && sizeSelect.value && quantityInput.value && sizeSelect.value !== "--Select Size--" && sizeSelect.value !== "disabled") {
                    data.push({
                        size: sizeSelect.value,
                        quantity: quantityInput.value,
                        sku: skuInput.value,
                        maximum_retail_price: mrpInput.value,
                        bank_settlement_price: bspInput.value,
                        portal_updated_price: pupInput.value
                    });
                }
                
               
            });
            
            
            document.getElementById("size_quantity_data").value = JSON.stringify(data);
            console.log("Current data:", data);
        }
                
        let cardCounter = 1; // Counter to generate unique IDs
        
        function create_card() {
            let cardContainer = document.getElementById("card_container");
            let newCard = document.createElement("div");
            newCard.classList.add("card", "mt-3");
        
            let bankSettlementId = "bankSettlementPrice" + cardCounter;
            let portalPriceId = "portalprice" + cardCounter;
        
            newCard.innerHTML = `
                <div class="card-title">
                    <div class="row g-3">
                        <div class="col-md-2">Inventory Details</div>
                        <div class="col-md-9"></div>
                        <div class="col-md-1">
                            <div class="action_container">
                                <button type="button" class="btns danger" onclick="remove_card(this)"><i class="fa fa-close"></i></button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Size</label>
                                    <select class="form-control select2 size_select" name="size" style="width:100%">
                                        <option selected disabled>--Select Size--</option>
                                        ${document.querySelector(".size_select").innerHTML}
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" class="form-control quantity_input" name="quantity" placeholder="Enter Quantity" oninput="updateHiddenInput()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku" oninput="updateHiddenInput()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Maximum Retail Price</label>
                                    <input type="text" class="form-control" name="maximum_retail_price" oninput="updateHiddenInput()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bank Settlement Price</label>
                                    <input type="number" class="form-control bank-settlement-price" name="bank_settlement_price" id="${bankSettlementId}" oninput="updateHiddenInput()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Portal Updated Price</label>
                                    <input type="number" class="form-control portal-updated-price" name="portal_updated_price" id="${portalPriceId}" readonly>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        
            cardContainer.appendChild(newCard);
            cardCounter++; // Increment counter for next card
        }


function remove_card(element) {
    element.closest(".card").remove();
    updateHiddenInput();
}
</script>

    <script>
        function enforceMinMax(el) {
              if (el.value != "") {
                if (parseInt(el.value) < parseInt(el.min)) {
                  el.value = el.min;
                }
                if (parseInt(el.value) > parseInt(el.max)) {
                  el.value = el.max;
                }
              }
            }
    </script>
    
     
        
    
    
<!--// Price Calculation-->
    
    
   <script>
   
    var shippingMode = @json($shipping_mode); 
    
    
    console.log("Shipping Mode:", shippingMode); // Debugging
    
    document.addEventListener("input", function () {

    var bankSettlementPrice = parseFloat(document.getElementById("bankSettlementPrice").value) || 0;
    
        // In-Store
        
        if (shippingMode === "In-Store") {
            
            if(bankSettlementPrice >=1 && bankSettlementPrice <= 400)
            {   
                var shipping = 131;
                var bankprice = Math.round(bankSettlementPrice + shipping + (0.05 * bankSettlementPrice) + (0.03 * (bankSettlementPrice + shipping + (0.05 * bankSettlementPrice))));
                
            }
            if(bankSettlementPrice >=401 && bankSettlementPrice <= 749)
            {   
                var shipping = 180;

                var basePrice = bankSettlementPrice + shipping;
                var tenPercent = 0.1 * basePrice;
                var threePercent = 0.03 * (basePrice + tenPercent);
        
                var bankprice = Math.round(basePrice + tenPercent + threePercent);

                
            }
            if(bankSettlementPrice >=750 && bankSettlementPrice <= 1499)
            {   
                var shipping = 200;

                var basePrice = bankSettlementPrice + shipping;
                var fifteenPercent = 0.15 * basePrice;
                var threePercent = 0.03 * (basePrice + fifteenPercent);
                var bankprice = Math.round(basePrice + fifteenPercent + threePercent);
                

                
            }
            
            if(bankSettlementPrice >=1500 && bankSettlementPrice <= 2499)
            {   
                var shipping = 220;

                var basePrice = bankSettlementPrice + shipping;
                var eighteenPercent = 0.18 * basePrice;
                var additionalCharge = 0.03 * (basePrice + eighteenPercent);
                var bankprice = Math.round(basePrice + eighteenPercent + additionalCharge);

                
            }
            if(bankSettlementPrice >=2500)
            {   
                var shipping = 240;

                var basePrice = bankSettlementPrice + shipping;
                var twentyPercent = 0.2 * basePrice;
                var threePercent = 0.03 * (basePrice + twentyPercent);
                var bankprice = Math.round(basePrice + twentyPercent + threePercent);

                
            }
            
        }
        
        // Warehouse
        console.log(shippingMode);
        if (shippingMode === "Warehouse") {
            
            if(bankSettlementPrice >=1 && bankSettlementPrice <= 400)
            {   
                var shipping = 131;
                var gurantee = 35;
                var inward = 9;
                var bankprice = Math.round(bankSettlementPrice + shipping + gurantee + inward + (0.05 * bankSettlementPrice) + (0.03 * (bankSettlementPrice + shipping + gurantee + inward + (0.05 * bankSettlementPrice))));
            }
            if(bankSettlementPrice >=401 && bankSettlementPrice <= 749)
            {   
                var shipping = 180;
                var gurantee = 35;
                var inward = 9;

                var basePrice = bankSettlementPrice + shipping + gurantee + inward;
                var tenPercent = 0.1 * (bankSettlementPrice + shipping);
                var threePercent = 0.03 * (basePrice + tenPercent)
                var bankprice = Math.round(basePrice + tenPercent + threePercent);
                
            }
            if(bankSettlementPrice >=750 && bankSettlementPrice <= 1499)
            {   
                
                var shipping = 200;
                var gurantee = 35;
                var inward = 9;

                var basePrice = bankSettlementPrice + shipping + gurantee + inward;
                var fifteenPercent = 0.15 * (bankSettlementPrice + shipping);
                var threePercent = 0.03 * (basePrice + fifteenPercent);
                var bankprice = Math.round(basePrice + fifteenPercent + threePercent);

                // alert(bankSettlementPrice);
            }
            
            if(bankSettlementPrice >=1500 && bankSettlementPrice <= 2499)
            {   
                var shipping = 220;
                var gurantee = 35;
                var inward = 9;

                var basePrice = bankSettlementPrice + shipping + gurantee + inward;
                var eighteenPercent = 0.18 * (bankSettlementPrice + shipping);
                var additionalCharge = 0.03 * (basePrice + eighteenPercent);
                var bankprice = Math.round(basePrice + eighteenPercent + additionalCharge);

                
            }
            if(bankSettlementPrice >=2500)
            {   
                var shipping = 240;
                var gurantee = 35;
                var inward = 9;

                var basePrice = bankSettlementPrice + shipping + gurantee + inward;
                var twentyPercent = 0.2 * (bankSettlementPrice + shipping);
                var threePercent = 0.03 * (basePrice + twentyPercent);
                var bankprice = Math.round(basePrice + twentyPercent + threePercent);

                
            }
            
        }
        
        // console.log(bankprice);
        document.getElementById('portalprice').value = bankprice;
        

    });


</script>








<script>

    document.addEventListener("input", function (event) {
        if (event.target.classList.contains("bank-settlement-price")) {
            let card = event.target.closest(".card"); // Find the parent card
            let bankSettlementPrice = parseFloat(event.target.value) || 0;
            let portalPriceInput = card.querySelector(".portal-updated-price"); // Find portal price in the same card
            
            let bankprice = 0;
            let shippingMode = @json($shipping_mode);
    
            if (shippingMode === "In-Store") {
                if (bankSettlementPrice >= 1 && bankSettlementPrice <= 400) {
                    let shipping = 131;
                    bankprice = Math.round(bankSettlementPrice + shipping + (0.05 * bankSettlementPrice) + (0.03 * (bankSettlementPrice + shipping + (0.05 * bankSettlementPrice))));
                } else if (bankSettlementPrice >= 401 && bankSettlementPrice <= 749) {
                    let shipping = 180;
                    let basePrice = bankSettlementPrice + shipping;
                    bankprice = Math.round(basePrice + (0.1 * basePrice) + (0.03 * (basePrice + (0.1 * basePrice))));
                } else if (bankSettlementPrice >= 750 && bankSettlementPrice <= 1499) {
                    let shipping = 200;
                    let basePrice = bankSettlementPrice + shipping;
                    bankprice = Math.round(basePrice + (0.15 * basePrice) + (0.03 * (basePrice + (0.15 * basePrice))));
                } else if (bankSettlementPrice >= 1500 && bankSettlementPrice <= 2499) {
                    let shipping = 220;
                    let basePrice = bankSettlementPrice + shipping;
                    bankprice = Math.round(basePrice + (0.18 * basePrice) + (0.03 * (basePrice + (0.18 * basePrice))));
                } else if (bankSettlementPrice >= 2500) {
                    let shipping = 240;
                    let basePrice = bankSettlementPrice + shipping;
                    bankprice = Math.round(basePrice + (0.2 * basePrice) + (0.03 * (basePrice + (0.2 * basePrice))));
                }
            } else if (shippingMode === "Warehouse") {
                if (bankSettlementPrice >= 1 && bankSettlementPrice <= 400) {
                    let shipping = 131, gurantee = 35, inward = 9;
                    bankprice = Math.round(bankSettlementPrice + shipping + gurantee + inward + (0.05 * bankSettlementPrice) + (0.03 * (bankSettlementPrice + shipping + gurantee + inward + (0.05 * bankSettlementPrice))));
                } else if (bankSettlementPrice >= 401 && bankSettlementPrice <= 749) {
                    let shipping = 180, gurantee = 35, inward = 9;
                    let basePrice = bankSettlementPrice + shipping + gurantee + inward;
                    bankprice = Math.round(basePrice + (0.1 * (bankSettlementPrice + shipping)) + (0.03 * (basePrice + (0.1 * (bankSettlementPrice + shipping)))));
                } else if (bankSettlementPrice >= 750 && bankSettlementPrice <= 1499) {
                    let shipping = 200, gurantee = 35, inward = 9;
                    let basePrice = bankSettlementPrice + shipping + gurantee + inward;
                    bankprice = Math.round(basePrice + (0.15 * (bankSettlementPrice + shipping)) + (0.03 * (basePrice + (0.15 * (bankSettlementPrice + shipping)))));
                } else if (bankSettlementPrice >= 1500 && bankSettlementPrice <= 2499) {
                    let shipping = 220, gurantee = 35, inward = 9;
                    let basePrice = bankSettlementPrice + shipping + gurantee + inward;
                    bankprice = Math.round(basePrice + (0.18 * (bankSettlementPrice + shipping)) + (0.03 * (basePrice + (0.18 * (bankSettlementPrice + shipping)))));
                } else if (bankSettlementPrice >= 2500) {
                    let shipping = 240, gurantee = 35, inward = 9;
                    let basePrice = bankSettlementPrice + shipping + gurantee + inward;
                    bankprice = Math.round(basePrice + (0.2 * (bankSettlementPrice + shipping)) + (0.03 * (basePrice + (0.2 * (bankSettlementPrice + shipping)))));
                }
            }
    
            portalPriceInput.value = bankprice; // Update Portal Updat  card.querySelector("#portal-san").value = bankprice;
        }
    });

</script>
    
</body>
</html>
                
                
                