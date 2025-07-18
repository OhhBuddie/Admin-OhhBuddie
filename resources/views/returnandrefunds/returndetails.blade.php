@extends('layouts.admin.admin')
@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus {
            border: var(--bs-border-width) solid var(--bs-border-color);
            box-shadow: none;
        }
        a {
            text-decoration: none !important;
        }
        
        a:hover {
            text-decoration: none !important;
        }
        th, td, h3, h4, h6 {
            text-transform: none !important;
        }

    </style>

<body class="bg-light">
    @php
        $customer_details = DB::table('users')->where('id',$order_id->user_id)->latest()->first();
        $customer_address = DB::table('addresses')->where('user_id',$order_id->user_id)->latest()->first();
        $city = DB::table('cities')->where('id',$customer_address->city)->latest()->first();
        $state = DB::table('states')->where('id',$customer_address->state)->latest()->first();

    @endphp
    <div class="container-fluid py-4">
        <div class="table-responsive">
            <table id="sellerProductsTable" class="table table-hover table-bordered table-striped" style="zoom:85%;">
                <thead>
                    <tr>
                        <th colspan="14" class="text-center" style="background-color:#EFC475;">
                            <h4>Return Request for Order ID: <span style="color:blue">{{ $order_id->order_id }}</span></h4>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="14" class="text-center">
                            <h6>
                                Order By: {{$customer_details->name}} | 
                                Email: {{$customer_details->email}} | 
                                Contact: {{$customer_details->phone}}
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="14" class="text-center">
                            <h4 style="text-align:left;"><b><i class="fa fa-truck"></i>&nbsp; Delivery Details</b></h4>
                            <h6 style="text-align:left;">
                                <i class="fa fa-user"></i>&nbsp; Name: {{$customer_address->name}} 
                            </h6>
                            <h6 style="text-align:left;">
                                <i class="fa fa-phone"></i>&nbsp; Contact: {{$customer_address->phone}} 
                            </h6>
                            <h6 style="text-align:left;">
                                <i class="fa fa-city"></i>&nbsp; City: {{$city->name}}
                            </h6>
                            <h6 style="text-align:left;">
                                <i class="fa fa-map-marker-alt"></i>&nbsp; Area: {{$customer_address->locality}} 
                            </h6>
                            <h6 style="text-align:left;">
                                <i class="fa fa-flag"></i>&nbsp; State: {{$state->name}} 
                            </h6>     
                            <h6 style="text-align:left;">
                                <i class="fa fa-map-pin"></i>&nbsp; Pincode: {{$customer_address->pincode}}
                            </h6>
                            <h6 style="text-align:left;">
                                <i class="fa fa-home"></i>&nbsp; Address: {{$customer_address->address_line_1}} {{$customer_address->address_line_2}}
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="14" class="text-center" style="background-color:#1f1f1f; color:white">
                            <h6>
                                Payment Mode: {{$order_id->payment_type}}
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:center; background-color:#EFC475"><b>SL No.</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Product</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Product Name</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Sold By</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Brand Name</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>SKU</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Color</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Size</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>MRP</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Bank Settlement Price</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Amount</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Discount</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Quantity</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Delivery Status</b></th>
                    </tr>
                </thead>
                <tbody>
                    <div hidden>
                        {{$total_amount = 0}}
                    </div>
                    @foreach($allorderdetails as $index => $allords)
                    <div hidden>
                        {{$total_amount = $total_amount + $allords['price'] }}
                    </div>
                        <tr>
                            <td style="text-align:center">{{ $index + 1 }}</td>
                            <td><img src="{{ $allords['images'] }}" style="object-fit:fill; width:80px; height:80px;"></td>
                            <td>{{ $allords['product_name'] }}</td>
                            <td>{{ $allords['sold_by'] }}</td>
                            <td>{{ $allords['brand_name'] }}</td>
                            <td>{{ $allords['sku'] }}</td>
                            <td>{{ $allords['color'] }}</td>
                            <td>{{ $allords['size'] }}</td>
                            <td>Rs. {{ number_format($allords['mrp'], 2) }}</td>
                            <td>Rs. {{ number_format($allords['bsp'], 2) }}</td>
                            <td>Rs. {{ number_format($allords['price'], 2) }}</td>
                            <td>Rs. {{ number_format($allords['discount'], 2) }}</td>
                            <td>{{ $allords['quantity'] }}</td>
                            <td><span class="badge badge-info">{{ $allords['delivery_status'] }}</span> 

                            </td>
                                                    
                            </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-center" style="background-color:#EFC475;">
                            <h6>Total Amount: Rs. {{ number_format($total_amount, 2) }}</h6>
                        </th>
                        <th colspan="4" class="text-center" style="background-color:#EFC475;">
                            <h6>Total Shipping: Rs. {{ number_format($order_id->shipping_cost, 2) }}</h6>
                        </th>
                        <th colspan="6" class="text-center" style="background-color:#EFC475;">
                            <h6>Payable Amount: Rs. {{ number_format(($total_amount + $order_id->shipping_cost), 2) }}</h6>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table id="sellerProductsTable" class="table table-hover table-bordered table-striped" style="zoom:85%;">
                <thead>
                    <tr>
                        <th colspan="14" class="text-center" style="background-color:#1f1f1f; color:white">
                            <h6>
                                Return Request
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:center; background-color:#EFC475"><b>SL No.</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Submitted Image</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Seller ID</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Return Category</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Return Reason</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Refund Source</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Return Status</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Product Stored In</b></th>
                        <th style="text-align:center; background-color:#EFC475"><b>Pickup Status</b></th>
                        <!--<th style="text-align:center; background-color:#EFC475"><b>Bank Settlement Price</b></th>-->
                        <!--<th style="text-align:center; background-color:#EFC475"><b>Discount</b></th>-->
                        <!--<th style="text-align:center; background-color:#EFC475"><b>Quantity</b></th>-->
                        <!--<th style="text-align:center; background-color:#EFC475"><b>Delivery Status</b></th>-->
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($refund_data as $index => $allrtrns)
        
                        <tr>
                            <td style="text-align:center">{{ $index + 1 }}</td>
                            <td><img src="{{ $allrtrns['image'] }}" style="object-fit:fill; width:80px; height:80px;"></td>
                            <td>{{ $allrtrns['seller_id'] }}</td>
                            <td>{{ $allrtrns['return_reason_category'] }}</td>
                            <td>{{ $allrtrns['return_reason'] }}</td>
                            <td>{{ $allrtrns['refund_source'] }}</td>
                            <td>
                                <select class="form-select refund-status" data-id="{{ $allrtrns['id'] }}">
                                    <option value="Return Picked Up" {{ $allrtrns['status'] == 'Return Picked Up' ? 'selected' : '' }}>Return Picked Up</option>
                                    <option value="Under Inspection" {{ $allrtrns['status'] == 'Under Inspection' ? 'selected' : '' }}>Under Inspection</option>
                                    <option value="Refund Initiated" {{ $allrtrns['status'] == 'Refund Initiated' ? 'selected' : '' }}>Refund Initiated</option>
                                    <option value="Refund Settled" {{ $allrtrns['status'] == 'Refund Settled' ? 'selected' : '' }}>Refund Settled</option>
                                    <option value="Refund Failed" {{ $allrtrns['status'] == 'Refund Failed' ? 'selected' : '' }}>Refund Failed</option>
                                    <option value="Refund Rejected" {{ $allrtrns['status'] == 'Refund Rejected' ? 'selected' : '' }}>Refund Rejected</option>
                                    <option value="Refund Cancelled" {{ $allrtrns['status'] == 'Refund Cancelled' ? 'selected' : '' }}>Refund Cancelled</option>
                                    <option value="Cancelled" {{ $allrtrns['status'] == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>




                                
                            </td>
                             <td>
                                <select class="form-select product-stored" data-id="{{ $allrtrns['id'] }}">
                                    <option value="Our Warehouse" {{ $allrtrns['product_stored'] == 'Return Picked Up' ? 'selected' : '' }}>Our Warehouse</option>
                                    <option value="Seller Store" {{ $allrtrns['product_stored'] == 'Under Inspection' ? 'selected' : '' }}>Seller Store</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select pickup-status" data-id="{{ $allrtrns['id'] }}">
                                    <option value="Packed"  {{ $allrtrns['pickup_status'] == 'Processing' ? 'Processing' : '' }}>Processing</option>
                                    <option value="Packed" {{ $allrtrns['pickup_status']  == 'Packed' ? 'selected' : '' }}>Packed</option>
                                    <option value="Out for delivery" {{ $allrtrns['pickup_status']  == 'Out for delivery' ? 'selected' : '' }}>Out for delivery</option>
                                    <option value="Delivered" {{ $allrtrns['pickup_status']  == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Return and Refund" {{ $allrtrns['pickup_status']  == 'Return and Refund' ? 'selected' : '' }}>Return and Refund</option>
                                    <option value="Cancelled" {{ $allrtrns['pickup_status']  == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                                
                            
                                                    
                            </tr>
                            
                    @endforeach
                    @php
                        $noteArray = json_decode($allrtrns['note'], true) ?? [];
                        $statusKey = $allrtrns['status'];
                        $noteValue = $noteArray[$statusKey] ?? '';
                    @endphp
                    
                    {{$allrtrns['status']}}
                    
                    <tr>
                        <td colspan="9">
                            <form method="POST" action="{{ route('admin.updateNote') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $allrtrns['id'] }}">
                                <input type="hidden" name="status_key" value="{{ $statusKey }}">
                    
                                <div class="d-flex align-items-center gap-2">
                                    <label for="note-{{ $allrtrns['id'] }}" class="fw-bold mb-0">Admin Note ({{ $statusKey }}):</label>
                                    <input type="text" name="note" id="note-{{ $allrtrns['id'] }}" class="form-control w-50" value="{{ $noteValue }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit Note</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            
          @php
            $notes = json_decode($allrtrns['note'], true) ?? [];
            $reversedNotes =array_reverse($notes, true); // Latest first
        @endphp
        
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active">Activity Log</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="timeline" style="color: #1f1f1f;">
                    <ul class="list-unstyled position-relative" style="color: #1f1f1f;">
                        @if(count($reversedNotes) == 0)
                            <li>No activity logged.</li>
                        @else
                            @foreach($reversedNotes as $status => $note)
                                <li class="position-relative ps-4 border-start border-dark" style="border-left: 2px solid black; border-color: #1f1f1f;">
                                    <div class="position-absolute top-0 start-0 translate-middle bg-primary rounded-circle" style="width:12px; height:12px; margin-top:56px;"></div>
                                    <div class="bg-light p-3 rounded shadow-sm">
                                        <strong>{{ $status }}</strong>
                                        <p class="mb-0">{{ $note['note'] }}</p>
                                        <small class="text-muted">{{ $note['timestamp'] }}</small>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
            
        </div>
    </div>
    <!-- jQuery, Bootstrap & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#sellerProductsTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "lengthMenu": "Show _MENU_ entries per page",
                    "zeroRecords": "No matching records found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries available",
                    "infoFiltered": "(filtered from _MAX_ total entries)"
                }
            });
        });
    </script>
    
<script>


    const customerName = @json($customer_address->name);
    const customerPhone = @json($customer_address->phone);
    const productName = @json($allords['product_name']);

    $(document).ready(function () {
        $('.refund-status').change(function () {
            let status = $(this).val();
            let orderId = $(this).data('id');

            alert(orderId);

            $.ajax({
                url: "{{ route('update.refund.status') }}", 
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: orderId,
                    delivery_status: status,

                },
                success: function (response) {
                    console.log(response); // Debug response
                    if (response.success) {
                        alert("Delivery status updated successfully!");
                    } 
                    
                    // location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Debugging
                    alert("Something went wrong! Check the console.");
                }
            });
        });
    });
</script>

<script>
 $(document).ready(function () {
        $('.product-stored').change(function () {
            let status = $(this).val();
            let orderId = $(this).data('id');

            alert(orderId);

            $.ajax({
                url: "{{ route('update.product.stored') }}", 
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: orderId,
                    product_stored: status,

                },
                success: function (response) {
                    console.log(response); // Debug response
                    if (response.success) {
                        alert("Delivery status updated successfully!");
                    } else {
                        alert("Failed to update delivery status.");
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Debugging
                    alert("Something went wrong! Check the console.");
                }
            });
        });
    });
</script>

<script>
 $(document).ready(function () {
        $('.pickup-status').change(function () {
            let status = $(this).val();
            let orderId = $(this).data('id');

            alert(orderId);

            $.ajax({
                url: "{{ route('update.pickup.status') }}", 
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: orderId,
                    pickup_status: status,

                },
                success: function (response) {
                    console.log(response); // Debug response
                    if (response.success) {
                        alert("Delivery status updated successfully!");
                    } else {
                        alert("Failed to update delivery status.");
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText); // Debugging
                    alert("Something went wrong! Check the console.");
                }
            });
        });
    });
</script>
@endsection