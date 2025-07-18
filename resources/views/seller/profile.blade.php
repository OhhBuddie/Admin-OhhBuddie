<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .profile-header {
            background: #efc475;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            padding: 30px;
            margin-bottom: 30px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            object-fit: cover;
        }
        .section-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }
        .section-card:hover {
            transform: translateY(-5px);
        }
        .section-title {
            color: #efc475;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .info-item {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        .info-label {
            min-width: 180px;
            font-weight: 600;
            color: #495057;
        }
        .info-value {
            color: #212529;
            flex-grow: 1;
        }
        .badge-verified {
            background-color: #28a745;
            color: white;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
            margin-left: 10px;
        }
        .badge-pending {
            background-color: #ffc107;
            color: white;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
            margin-left: 10px;
        }
        .document-thumbnail {
            width: 100%;
            height: 100%;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .document-thumbnail:hover {
            transform: scale(1.05);
        }
        .nav-tabs .nav-link {
            color: #6c757d;
            font-weight: 500;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 10px 20px;
        }
        .nav-tabs .nav-link.active {
            color: #efc475;
            border-bottom: 3px solid #efc475;
            background-color: transparent;
        }
        .contact-icon {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(106, 17, 203, 0.1);
            color: #efc475;
            border-radius: 50%;
            margin-right: 15px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .action-btn {
            flex: 1;
            padding: 12px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .edit-btn {
            background-color: #efc475;
            color: white;
        }
        .edit-btn:hover {
            background-color: #5a0db7;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .brand-logo {
            max-width: 185px;
            max-height: 120px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            padding: 5px;
        }
        .status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 20px;
        }
        .status-active {
            background-color: #28a745;
            color: white;
        }
    </style>
    <style>
        .mobile-input-wrapper {
            display: flex;
            align-items: center;
            
            border-radius: 4px;
            background-color: #ECEFF1
        }

        .country-code {
            display: flex;
            align-items: center;
            padding: 5px;
            /*background-color: #f5f5f5;*/
            /* border-right: 1px solid #ccc; */
        }

        .flag-icon {
            width: 20px;
            height: 14px;
            margin-right: 5px;
        }

        .mobile-input-wrapper input[type="text"] {
            flex: 1;
            border: none;
            padding: 5px;
            outline: none;
        }
    </style>
</head>
<body>
        @php
            $selle_datas = DB::table('sellers')
                ->where('user_table_id', Auth::user()->id)
                ->latest()
                ->first();
        @endphp

    <div class="p-0 m-0">
        <div class="profile-header position-relative">
            <!--<span class="status-badge status-active">Active</span>-->
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="https://w7.pngwing.com/pngs/165/652/png-transparent-businessperson-computer-icons-avatar-avatar-heroes-public-relations-business-thumbnail.png" alt="Seller Profile" class="profile-img">
                </div>
                <div class="col-md-10">
                    <h1 class="display-5 mb-1">{{ $selle_datas->company_name }}</h1>
                    <p class="fs-5 mb-3" id="ownerName">{{ $selle_datas->owner_name }}</p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <span id="phoneNumber">{{ $selle_datas->registered_phone_number }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span id="emailAddress">{{ $selle_datas->registered_email_id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs mb-4" id="sellerTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">
                    <i class="fas fa-user me-2"></i>Basic Information
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="warehouse-tab" data-bs-toggle="tab" data-bs-target="#warehouse" type="button" role="tab" aria-controls="warehouse" aria-selected="false">
                    <i class="fas fa-warehouse me-2"></i>Warehouse Details
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="bank" aria-selected="false">
                    <i class="fas fa-university me-2"></i>Bank Details
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="brand-tab" data-bs-toggle="tab" data-bs-target="#brand" type="button" role="tab" aria-controls="brand" aria-selected="false">
                    <i class="fas fa-tag me-2"></i>Brand Details
                </button>
            </li>
        </ul>

        <div class="tab-content" id="sellerTabContent">
            
            <!-- Basic Information Tab -->
            <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                <div class="section-card">
                    
                    <div class="d-flex align-items-center justify-content-between ">
                        <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Basic Information</h3>
                        
                        <!-- Button to Open Modal -->
                        <div data-bs-toggle="modal" data-bs-target="#editDetailsModal" style="cursor: pointer;">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Business Owner:</span>
                                <span class="info-value" id="basicOwnerName">{{ $selle_datas->owner_name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Company Name:</span>
                                <span class="info-value" id="basicCompanyName">{{ $selle_datas->company_name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">GST Number:</span>
                                <span class="info-value" id="gstNumber">{{ $selle_datas->gst_number }} 
                                    
                                    @if(!is_null($selle_datas->gst_number))
                                        <span class="badge-verified">Verified</span>
                                    @endif    
                                </span>
                                
                            </div>
                            <div class="info-item">
                                <span class="info-label">Owner's Contact:</span>
                                <span class="info-value" id="basicPhoneNumber">{{ $selle_datas->registered_phone_number }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Owner's Email:</span>
                                <span class="info-value" id="basicEmailAddress">{{ $selle_datas->registered_email_id }}</span>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Address 1:</span>
                                <span class="info-value" id="address1">{{ $selle_datas->registered_address1 }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Address 2:</span>
                                <span class="info-value" id="address2">{{ $selle_datas->registered_address2 }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">City:</span>
                                <span class="info-value" id="city">{{ $selle_datas->registered_city }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">State:</span>
                                <span class="info-value" id="state">{{ $selle_datas->registered_state }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pin Code:</span>
                                <span class="info-value" id="pincode">{{ $selle_datas->registered_pincode }}</span>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4 mb-3" style="color: #efc475;">Documents</h4>
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div>
                                <img src="{{ asset('public/' . $selle_datas->gst_certificate) }}" alt="GST Certificate" class="document-thumbnail">
                                <!--{{ asset('public/assets/images/banners/mobile home slider.jpg') }}-->
                                <p class="mt-2 mb-0">GST Certificate</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div>
                                <img src="{{ asset('public/' . $selle_datas->govt_id_proof) }}" alt="Government ID Proof" class="document-thumbnail">
                                <p class="mt-2 mb-0">Government ID Proof</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Basic Information Modal -->
            
                <div class="modal fade" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
                
                <form id="msform" action="/editform/{{Auth::user()->id}}" enctype="multipart/form-data" method="POST">
                 @csrf
                 
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDetailsModalLabel">Edit Basic Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Basic Information:</h2>
                                        </div>
                         
                                    </div>
                                    <div hidden>
                                        <label>Added By:</label>
                                        <input type="hidden" name="added_by" value="seller" disabled />
                                    </div>
                                    <div>
                                        <label>Business Owner Name:</label>
                                        <input type="text" name="owner_name" placeholder="Business Owner Name" value="{{$seller_data->owner_name}}" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>Company Name:</label>
                                        <input type="text" name="company_name" placeholder="Company Name" value="{{$seller_data->company_name}}" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>GST Details:</label>
                                        <input type="text" id="gst_number" name="gst_number" value="{{$seller_data->gst_number}}" placeholder="Enter your GST Number" minlength="15" maxlength="15" class="form-control" readonly />
                                        <p id="gst_error" style="color: red;"></p>
                                    </div>
                                    <div>
                                        <label>Owner's Contact Number:</label>
                                        <div class="mobile-input-wrapper" style="width:100%">
                                            <span class="country-code text-dark">
                                                <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" alt="India Flag" class="flag-icon">
                                                +91
                                            </span>
                                            <input type="text" id="mobile_code" placeholder="Enter Your Mobile Number"  name="registered_phone_number" value="{{Auth::user()->phone}}" readonly class="form-control" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label>Owner's Email Address:</label>
                                        <input type="email" name="registered_email_id" placeholder="Owner's Email Address" value="{{$seller_data->registered_email_id}}" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>Address1:</label>
                                        <input type="text" name="registered_address1" placeholder="Address1" value="{{$seller_data->registered_address1}}" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>Address2:</label>
                                        <input type="text" name="registered_address2" placeholder="Address2" value="{{$seller_data->registered_address2}}" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>Registered City:</label>
                                        <select name="registered_city" class="form-control select2">
                                            <option value="{{$seller_data->registered_city}}" selected>{{$seller_data->registered_city}}</option>
                                            @foreach($city as $cty)
                                                <option value="{{$cty->id}}">{{$cty->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>Registered State:</label>
                                        <select name="registered_state" class="form-control select2">
                                            <option value="{{$seller_data->registered_state}}" selected>{{$seller_data->registered_state}}</option>
                                            @foreach($state as $sta)
                                                <option value="{{$sta->id}}">{{$sta->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>Pin Code:</label>
                                        <input type="text" name="registered_pincode" value="{{$seller_data->registered_pincode}}" maxlength="6" minlength="6"  placeholder="Post Code" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>GST Certificate:</label>
                                        <input type="file" name="gst_certificate" class="form-control"/>
                                    </div>
                                    <div>
                                        <label>Government ID Proof:</label>
                                        <input type="file" name="govt_id_proof" class="form-control"/>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
    
            <!--Modal End -->
                    
                        
            @php
                $seller = DB::table('sellers')
                    ->where('user_table_id', Auth::user()->id)
                    ->select('seller_id')
                    ->first();
                    
                   $warehouse = DB::table('warehouses')
                    ->where('seller_id', $seller->seller_id)
                    ->get();
            @endphp
        
            <!-- Warehouse Details Tab -->
              <div class="tab-pane fade" id="warehouse" role="tabpanel" aria-labelledby="warehouse-tab">
                <div class="section-card">
                    <h3 class="section-title d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-warehouse me-2"></i>
                            Warehouse Details
                        </div>
                        <button class="btn btn-primary" id="addWarehouseBtn">Add New Warehouse</button>    
                    </h3>
                    
                    <h3 class="section-title ">Addresses</h3>
                    
                    @foreach($warehouse as $ware)
                    
                    <div class="row card p-2 mb-2">
                        <div>
                            <div class="info-item">
                                <span class="info-label">Address 1:</span>
                                <span class="info-value" id="warehouseAddress1">{{ $ware->warehouse_address1 }}</span>
                                <!-- Button to Open Modal -->
                                <div data-bs-toggle="modal" data-bs-target="#warehouses" style="cursor: pointer;">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Address 2:</span>
                                <span class="info-value" id="warehouseAddress2">{{ $ware->warehouse_address2 }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">City:</span>
                                <span class="info-value" id="warehouseCity">{{ $ware->warehouse_city }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">State:</span>
                                <span class="info-value" id="warehouseState">{{ $ware->warehouse_state }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pin Code:</span>
                                <span class="info-value" id="warehousePincode">{{ $ware->warehouse_pincode }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Contact Number:</span>
                                <span class="info-value" id="warehousePhone">{{ $ware->warehouse_phone_number }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value" id="warehouseEmail">{{ $ware->warehouse_email }}</span>
                            </div>
                        </div>
                    </div>
                   @endforeach
            
                  <!-- Hidden Form for Adding New Warehouse -->
                <div id="warehouseForm" class="mt-3" style="display: none;">
                <form action="{{ route('warehouses.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="newWarehouseAddress1">Address 1</label>
                            <input type="text" name="warehouse_address1" id="newWarehouseAddress1" class="form-control" placeholder="Enter Address 1" required>
            
                            <input type="hidden" name="seller_id" value="{{ $selle_datas->seller_id ?? '' }}">
            
                            <label for="newWarehouseAddress2">Address 2</label>
                            <input type="text" name="warehouse_address2" id="newWarehouseAddress2" class="form-control" placeholder="Enter Address 2">
            
                            <label for="newWarehouseCity">City</label>
                            <input type="text" name="warehouse_city" id="newWarehouseCity" class="form-control" placeholder="Enter City" required>
                        </div>
                        <div class="col-md-6">
                            <label for="newWarehouseState">State</label>
                            <input type="text" name="warehouse_state" id="newWarehouseState" class="form-control" placeholder="Enter State" required>
            
                            <label for="newWarehousePincode">Pin Code</label>
                            <input type="text" name="warehouse_pincode" id="newWarehousePincode" class="form-control" placeholder="Enter Pin Code">
            
                            <label for="newWarehousePhone">Contact Number</label>
                            <input type="text" name="warehouse_phone_number" id="newWarehousePhone" class="form-control" placeholder="Enter Contact Number" required>
            
                            <label for="newWarehouseEmail">Email</label>
                            <input type="email" name="warehouse_email" id="newWarehouseEmail" class="form-control" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Save Warehouse</button>
                </form>
           </div>  


                </div>
            </div>

                        
            <!--Bank Details  Modal -->
                <div class="modal fade" id="warehouses" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
                
                
                
                <form id="msform" action="/editform/{{Auth::user()->id}}" enctype="multipart/form-data" method="POST">
                 @csrf
                 
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDetailsModalLabel">Change Addresses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
           
                            <fieldset>
                            <div class="form-card">
                        
                                <div>
                                    <label class="fieldlabels">Address 1:</label>
                                    <input type="text" placeholder="Account Holder Name" name="bank_account_holder" value="{{ $ware->warehouse_address1 }}">
                                </div>
                                <div>
                                    <label class="fieldlabels">Account Number</label>
                                    <input type="text" placeholder="Account Number" name="bank_account_number" value="{{$seller_data->bank_account_number}}">
                                </div>



                                <div>
                                    <label class="fieldlabels">IFSC Code</label>
                                    <input type="text" placeholder="IFSC Code" name="bank_account_ifsc" value="{{$seller_data->bank_account_ifsc}}">
                                </div>
                                <div>
                                    <label class="fieldlabels">Bank Name</label>
                                    <input type="text" placeholder="Bank Name" name="bank_name" value="{{$seller_data->bank_name}}">
                                </div>


                                <div>
                                    <label class="fieldlabels">Account Type</label>
                                    <select name="bank_account_type">
                                        <option value="{{$seller_data->bank_account_type}}" selected>{{$seller_data->bank_account_type}}</option>
                                        <option value="saving">Saving</option>
                                        <option value="current">Current</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="fieldlabels">Upload Cancelled Cheque</label>
                                    <input type="file" accept="image/*" name="cancelled_cheque" value="{{$seller_data->cancelled_cheque}}">
                                </div>

                            </div>
                           
                        </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
            <!--Modal End -->
            
            
            <!-- Bank Details Tab -->
              <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                <div class="section-card">
 
                    <div class="d-flex align-items-center justify-content-between ">
                        <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Bank Details</h3>
                        
                        <!-- Button to Open Modal -->
                        <div data-bs-toggle="modal" data-bs-target="#editDetailsModal" style="cursor: pointer;">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Account Holder:</span>
                                <span class="info-value" id="accountHolder">{{ $selle_datas->bank_account_holder }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Account Number:</span>
                                <span class="info-value" id="accountNumber">{{ $selle_datas->bank_account_number }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">IFSC Code:</span>
                                <span class="info-value" id="ifscCode">{{ $selle_datas->bank_account_ifsc }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Bank Name:</span>
                                <span class="info-value" id="bankName">{{ $selle_datas->bank_name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Account Type:</span>
                                <span class="info-value" id="accountType">{{ $selle_datas->bank_account_type }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Cancelled Cheque:</span>
                                <div class="info-value">
                                    <img src="{{ asset('public/' . $selle_datas->cancelled_cheque) }}" alt="Cancelled Cheque" class="document-thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Bank Details  Modal -->
                <div class="modal fade" id="editDetailsModal2" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
                
                <form id="msform" action="/editform/{{Auth::user()->id}}" enctype="multipart/form-data" method="POST">
                 @csrf
                 
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDetailsModalLabel">Edit Basic Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Bank Details:</h2>
                                    </div>
                         
                                </div>


                                <div>
                                    <label class="fieldlabels">Account Holder Name</label>
                                    <input type="text" placeholder="Account Holder Name" name="bank_account_holder" value="{{$seller_data->bank_account_holder}}">
                                </div>
                                <div>
                                    <label class="fieldlabels">Account Number</label>
                                    <input type="text" placeholder="Account Number" name="bank_account_number" value="{{$seller_data->bank_account_number}}">
                                </div>



                                <div>
                                    <label class="fieldlabels">IFSC Code</label>
                                    <input type="text" placeholder="IFSC Code" name="bank_account_ifsc" value="{{$seller_data->bank_account_ifsc}}">
                                </div>
                                <div>
                                    <label class="fieldlabels">Bank Name</label>
                                    <input type="text" placeholder="Bank Name" name="bank_name" value="{{$seller_data->bank_name}}">
                                </div>


                                <div>
                                    <label class="fieldlabels">Account Type</label>
                                    <select name="bank_account_type">
                                        <option value="{{$seller_data->bank_account_type}}" selected>{{$seller_data->bank_account_type}}</option>
                                        <option value="saving">Saving</option>
                                        <option value="current">Current</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="fieldlabels">Upload Cancelled Cheque</label>
                                    <input type="file" accept="image/*" name="cancelled_cheque" value="{{$seller_data->cancelled_cheque}}">
                                </div>

                            </div>
                           
                        </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
            <!--Modal End -->

            <!-- Brand Details Tab -->
            <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                <div class="section-card">
                    
                    <div class="d-flex align-items-center justify-content-between ">
                        <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Brand Details</h3>
                        
                        <!-- Button to Open Modal -->
                        <div data-bs-toggle="modal" data-bs-target="#editDetailsModal" style="cursor: pointer;">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-4">
                            <img src="{{ asset('public/' . $selle_datas->brand_logo) }}" alt="Brand Logo" class="brand-logo">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Brand Name:</span>
                                        <span class="info-value" id="brandName">{{ $selle_datas->brand_name }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Nature of Business:</span>
                                        <span class="info-value" id="businessNature">{{ $selle_datas->nature_of_business }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <span class="info-label">Document for Proof:</span>
                                        <span class="info-value" id="documentProof">{{ $selle_datas->document_for_proof }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Authorized Document:</span>
                                        <div class="info-value">
                                            <img src="{{ asset('public/' . $selle_datas->trademark_certificate) }}" alt="Authorized Document" class="document-thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Brand Details Modal -->
            
            <div class="modal fade" id="editDetailsModal3" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
                
                <form id="msform" action="/editform/{{Auth::user()->id}}" enctype="multipart/form-data" method="POST">
                 @csrf
                 
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDetailsModalLabel">Edit Basic Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                            <div class="form-card">
                                
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Brand Details (Optional) :</h2>
                                    </div>
                        
                                </div>

                                    <div>
                                        <label class="fieldlabels">Brand Name</label>
                                        <input type="text" placeholder="Brand Name" name="brand_name" value="{{$seller_data->brand_name}}">
                                    </div>
                                    <div >
                                        <label class="fieldlabels">Nature Of Business</label>
                                        <select name="nature_of_business">
                                            <option value="">Brand Owner + Manufacturer</option>
                                        </select>
                                    </div>
                                    <div >
                                        <label class="fieldlabels">Document for Proof</label>
                                        <select name="document_for_proof">
                                            <option value="">Trademark</option>
                                        </select>
                                    </div>
                               
                    
                                
                                    <div >
                                        <label class="fieldlabels">Authorized Document</label>
                                        <input type="file" accept="image/*" name="trademark_certificate" value="{{$seller_data->trademark_certificate}}">
                                    </div>
                                    <div >
                                        <label class="fieldlabels">Brand Logo</label>
                                        <input type="file" accept="image/*" name="brand_logo" value="{{$seller_data->brand_logo}}">
                                    </div>

                            </div>


                            <input type="submit" value="Submit" />
                            <input type="button" name="previous" class="previous action-button-previous"
                            value="Previous" />
                        </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
    
            <!--Modal End -->
            
        </div>



        <!--<div class="action-buttons">-->
        <!--    <a class="action-btn edit-btn"  href="{{ route('seller.profileedit') }}">-->
       
        <!--        <i class="fas fa-edit me-2"></i> Edit Profile-->
       
        <!--    </a>-->
        <!--    <div class="action-btn delete-btn">-->
        <!--        <i class="fas fa-trash-alt me-2"></i> Delete Account-->
        <!--    </div>-->
        <!--</div>-->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sample data loading script - would be replaced with real data in production -->
 
    
                <script>
                    document.getElementById("addWarehouseBtn").addEventListener("click", function() {
                        document.getElementById("warehouseForm").style.display = "block";
                    });
                </script>
</body>
</html>