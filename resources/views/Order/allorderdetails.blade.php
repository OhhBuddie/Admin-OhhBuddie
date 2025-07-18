@extends('layouts.admin.admin')
@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
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
        $customer_details = DB::table('users')->where('id', $order_id->user_id)->latest()->first();
        $customer_address = DB::table('addresses')->where('user_id',$order_id->user_id)->latest()->first();
        $city = DB::table('cities')->where('id',$customer_address->city)->latest()->first();
        $state = DB::table('states')->where('id',$customer_address->state)->latest()->first();

    @endphp
    <div class="container-fluid py-4">
        <div class="table-responsive">
            <table id="sellerProductsTable" class="table table-hover table-bordered table-striped" style="zoom:85%;">
                <thead>
                    <tr>
                        <th colspan="18" class="text-center" style="background-color:#EFC475;">
                            <h4>All Orders Details for Order ID: <span style="color:blue">{{ $order_id->order_id }}</span></h4>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="18" class="text-center">
                            <h6>
                                Order By: {{$customer_details->name}} | 
                                Email: {{$customer_details->email}} | 
                                Contact: {{$customer_details->phone}}
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="18" class="text-center">
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
                        <th colspan="18" class="text-center">
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
                        <th style="text-align:center; background-color:#EFC475"><b>Seller Paid</b></th>
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
                            <td>{{ $allords['product_name'] }} </td>
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
                            <td>
                                <select class="form-select delivery-status" data-id="{{ $allords['id'] }}">
                                    <option value="Packed" {{ $allords['delivery_status'] == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Packed" {{ $allords['delivery_status'] == 'Packed' ? 'selected' : '' }}>Packed</option>
                                    <option value="Out for delivery" {{ $allords['delivery_status'] == 'Out for delivery' ? 'selected' : '' }}>Out for delivery</option>
                                    <option value="Delivered" {{ $allords['delivery_status'] == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Return and Refund" {{ $allords['delivery_status'] == 'Return and Refund' ? 'selected' : '' }}>Return and Refund</option>
                                    <option value="Cancelled" {{ $allords['delivery_status'] == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select seller-paid" data-id="{{ $allords['id'] }}" {{ $allords['delivery_status'] != 'Delivered' ? 'disabled' : '' }}>
                                    <option value="NO" {{ $allords['sellerpaid'] == 'NO' ? 'selected' : '' }}>NO</option>
                                    <option value="YES" {{ $allords['sellerpaid'] == 'YES' ? 'selected' : '' }}>YES</option>
                                </select>
                            </td>
                            
                            
                                                    
                            </tr>
                    @endforeach
                    <tr>
                        <th colspan="6" class="text-center" style="background-color:#EFC475;">
                            <h6>Total Amount: Rs. {{ number_format($total_amount, 2) }}</h6>
                        </th>
                        <th colspan="6" class="text-center" style="background-color:#EFC475;">
                            <h6>Total Shipping: Rs. {{ number_format($order_id->shipping_cost, 2) }}</h6>
                        </th>
                        <th colspan="6" class="text-center" style="background-color:#EFC475;">
                            <h6>Payable Amount: Rs. {{ number_format(($total_amount + $order_id->shipping_cost), 2) }}</h6>
                        </th>
                    </tr>
                </tbody>
            </table>
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
    const odr_id = @json($order_id->order_id);
    const productName = @json($allords['product_name']);

    $(document).ready(function () {
        $('.delivery-status').change(function () {
            let status = $(this).val();
            let orderId = $(this).data('id');

            console.log("Order ID: " + orderId + ", New Status: " + status); // Debugging log
            console.log(productName);

            $.ajax({
                url: "{{ route('update.delivery.status') }}", 
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: orderId,
                    delivery_status: status,
                    name: customerName,
                    phone: customerPhone,
                    productname : productName,
                    odr_id : odr_id
                    
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


    $(document).ready(function () {
        // Toggle seller-paid dropdown based on delivery status change
        $('.delivery-status').on('change', function () {
            const deliveryStatus = $(this).val();
            const orderId = $(this).data('id');
    
            // Find the corresponding seller-paid select using the same order ID
            const $sellerPaid = $('.seller-paid[data-id="' + orderId + '"]');
    
            if (deliveryStatus === 'Delivered') {
                $sellerPaid.prop('disabled', false);
            } else {
                $sellerPaid.prop('disabled', true);
            }
        });
    
        // Handle seller-paid status change
        $('.seller-paid').on('change', function () {
            const orderId = $(this).data('id');
            const status = $(this).val();
    
            $.ajax({
                url: '/update-seller-paid',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: orderId,
                    status: status,
                    odr_id : odr_id
                },
                success: function (response) {
                    alert('Seller payment status updated successfully.');
                },
                error: function () {
                    alert('Something went wrong!');
                }
            });
        });
    });
</script>

@endsection