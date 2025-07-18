@extends('layouts.admin.admin')
@section('content')

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Management</title>

<!-- Bootstrap 5 & FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .table thead {
        background-color: #007bff;
        color: white;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: all 0.3s ease-in-out;
    }
    .btn-group button:hover {
        transform: scale(1.1);
    }
    .form-control:focus {
        border: var(--bs-border-width) solid var(--bs-border-color);
        box-shadow: none;
    }
    a {
        text-decoration: none !important;
        color: inherit;
    }
    a:hover {
        text-decoration: none !important;
        color: inherit;
    }
</style>

<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="table-responsive">
            <table id="sellerProductsTable" class="table table-hover table-bordered table-striped table-dark" style="zoom:85%">
                <thead>
                    <tr>
                        <th colspan="9" class="text-center">
                            <h3><b>All Orders Details</b></h3>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:center">SL No.</th>
                        <th style="text-align:center">Ordered By</th>
                        <th style="text-align:center">Ordered On</th>
                        <th style="text-align:center">Order ID</th>
                        <th style="text-align:center">Total Quantity</th>
                        <th style="text-align:center">Total Amount</th>
                        <th style="text-align:center">Shipping Cost</th>
                        <th style="text-align:center">Payment Type</th>
                        <th style="text-align:center">Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allorders as $index => $allords)
                        <tr>
                            <td style="text-align:center">{{ $index + 1 }}</td>
                            <td style="text-align:center">{{ DB::table('users')->where('id', $allords->user_id)->latest()->value('name') }}</td>
                            <td style="text-align:center">{{ $allords->created_at }}</td>
                            <td style="text-align:center; color:blue">
                                <a href="{{ url('/allorderdetails/'.$allords->id) }}" style="color:lightblue">{{ $allords->order_id }}</a>
                            </td>
                            <td style="text-align:center">
                                <span class="badge bg-info">{{ $allords->quantity }}</span>
                            </td>
                            <td style="text-align:center">Rs. {{ number_format($allords->grand_total, 2) }}</td>
                            <td style="text-align:center">Rs. {{ number_format($allords->shipping_cost, 2) }}</td>
                            <td style="text-align:center">
                                <span class="badge bg-warning">{{ $allords->payment_type }}</span>
                            </td>
                            <td style="text-align:center">
                                <span class="badge 
                                    {{ $allords->payment_status == 'completed' ? 'bg-success' : 
                                       ($allords->payment_status == 'Pending' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $allords->payment_status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Load jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        console.log("✅ jQuery Loaded:", typeof jQuery !== "undefined" ? "Yes" : "No");
    </script>

    <!-- ✅ Load Bootstrap & DataTables Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            console.log("✅ Checking DataTables:", typeof $.fn.DataTable !== "undefined" ? "Loaded" : "Not Loaded");

            if (!$.fn.DataTable) {
                console.error("❌ DataTables plugin not loaded!");
                return;
            }

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

@endsection
