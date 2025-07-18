<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    
    <!-- Include Bootstrap 5 & DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Custom Table Styling */

    .table thead {
        background-color: #007bff;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: all 0.3s ease-in-out;
    }

    .btn-group button {
        transition: all 0.3s ease-in-out;
    }

    .btn-group button:hover {
        transform: scale(1.1);
    }
</style>
    <style>
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .search-box {
            max-width: 300px;
        }
        .filter-chip {
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        .filter-chip.active {
            background-color: #0d6efd !important;
            color: white !important;
            border-color: #0d6efd;
        }
        .filter-chip:hover:not(.active) {
            background-color: #e9ecef !important;
        }
        .recommendation-chip {
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .filter-section {
            gap: 15px;
        }
        .table th {
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            .search-box {
                width: 100%;
                max-width: 100%;
            }
            .navbar-actions {
                flex-direction: column;
                width: 100%;
                gap: 10px;
                margin-top: 10px;
            }
            .filter-section {
                flex-direction: column;
                align-items: stretch !important;
            }
            .filter-group {
                flex-direction: column;
                width: 100%;
            }
            .bulk-actions {
                flex-direction: column;
                width: 100%;
            }
            .bulk-actions button {
                width: 100%;
            }
            .tab-header-actions {
                flex-direction: column;
                gap: 10px;
            }
            .tab-header-actions > div {
                width: 100%;
            }
            .tab-header-actions .btn-group {
                width: 100%;
                display: flex;
            }
            .tab-header-actions .btn-group .btn {
                flex: 1;
            }
        }
        
        .form-control:focus{
            border: var(--bs-border-width) solid var(--bs-border-color);
            box-shadow: none;
        }
        
        .switch {
          position: relative;
          display: inline-block;
          width: 86px;
          height: 28px;
        }
        
        .switch input {
          opacity: 0;
          width: 0;
          height: 0;
        }
        
        .slider {
          position: relative;
          display: flex;
          align-items: center;
          justify-content: center;
          background-color: #e53935; /* red for inactive */
          border-radius: 34px;
          transition: background-color 0.4s ease;
          width: 100%;
          height: 100%;
          font-size: 12px;
          font-weight: bold;
          color: white;
          padding: 0 10px;
          box-sizing: border-box;
        }
        
        .slider::before {
          content: "";
          position: absolute;
          height: 22px;
          width: 22px;
          left: 3px;
          bottom: 3px;
          background-color: white;
          transition: transform 0.4s ease;
          border-radius: 50%;
          z-index: 2;
        }
        
        input:checked + .slider {
          background-color: #4CAF50; /* green when active */
        }
        
        input:checked + .slider::before {
          transform: translateX(58px);
        }
        
        .slider-label {
          position: relative;
          z-index: 3;
          text-align: center;
          width: 100%;
          transition: opacity 0.3s ease;
          line-height: 1;
          pointer-events: none;
        }
        
        .slider-label.on {
          display: none;
        }
        
        .slider-label.off {
          display: block;
        }
        
        input:checked + .slider .slider-label.on {
          display: block;
        }
        
        input:checked + .slider .slider-label.off {
          display: none;
        }

    </style>
    
    
</head>

<body class="bg-light">
     @php
        use Illuminate\Support\Facades\Crypt;
    
     @endphp
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container-fluid">
                    <!-- Back Button -->
        <a href="javascript:history.back();" style="font-size: 17px; margin-right: 11px; color: black;">
           <i class="fa-solid fa-arrow-left"></i>
        </a>
            <a class="navbar-brand fw-bold" href="#">INVENTORY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <div class="ms-auto d-flex navbar-actions">
                    <div class="search-box me-2">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="search" class="form-control border-start-0" placeholder="Search inventory...">
                        </div>
                    </div>
                    <a href="/listing" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid py-4">
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4" id="inventoryTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#active" data-tab="active">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#pending" data-tab="pending">Approval Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#rejected" data-tab="rejected">Rejected</a>
            </li>
        </ul>

        <!-- Dynamic Tab Header -->
        <div class="tab-header-actions d-flex justify-content-between align-items-center mb-4">
            <div class="btn-group" id="tabStateButtons">
                <!-- Buttons will be dynamically updated -->
            </div>
            <div class="d-flex gap-2 bulk-actions">
                <button class="btn btn-outline-primary" id="leftAction">
                    <i class="fas fa-download me-2"></i>Bulk Download
                </button>
                <button class="btn btn-outline-primary" id="rightAction">
                    <i class="fas fa-upload me-2"></i>Bulk Upload
                </button>
            </div>
        </div>

        <!-- Filter and Recommendations Section -->
        <div class="d-flex justify-content-between align-items-center mb-4 filter-section">
            <div class="d-flex align-items-center gap-3 filter-group">
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
                <!-- Recommendations moved next to Filter -->
                <div class="d-flex gap-2">
                    <span class="badge bg-light text-dark filter-chip">Best Selling</span>
                    <span class="badge bg-light text-dark filter-chip">Low Stock</span>
                    <span class="badge bg-light text-dark filter-chip">New Items</span>
                </div>
            </div>
            <button class="btn btn-outline-secondary">
                <i class="fas fa-sort me-2"></i>Sort
            </button>
        </div>

        <!-- Filter Chips -->
        <div class="d-flex gap-2 mb-4 flex-wrap">
            <span class="badge bg-light text-dark filter-chip">Category</span>
            <span class="badge bg-light text-dark filter-chip active">Brand Name</span>
            <span class="badge bg-light text-dark filter-chip">Price Range</span>
            <span class="badge bg-light text-dark filter-chip">Status</span>
        </div>

        <!-- Table -->
       

       
        <div class="table-responsive">
<!-- Add this CSS for sorting arrows -->
<style>
.sortable {
    cursor: pointer;
    position: relative;
}

.sortable:hover {
    background-color: #d4b861 !important;
}

.sort-arrow {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: #666;
}

.sort-arrow.asc::after {
    content: "▲";
}

.sort-arrow.desc::after {
    content: "▼";
}

.sort-arrow.default::after {
    content: "▲▼";
    font-size: 10px;
}
</style>

<table id="sellerProductsTable" class="table table-hover table-bordered table-striped table-dark" style="zoom:85%">
    <thead>
        <tr>
            <th style="background-color:#efc475; color:black">Sl. No</th>
            <th style="background-color:#efc475; color:black">Picture</th>
            <th style="background-color:#efc475; color:black; width:50px;">Company</th>
            <th style="background-color:#efc475; color:black">Product</th>
            <th style="background-color:#efc475; color:black">Parent ID</th>
            <th style="background-color:#efc475; color:black">SKU</th>
            <th style="background-color:#efc475; color:black; position: relative;" class="sortable" data-sort="bsp">
                BSP
                <span class="sort-arrow default"></span>
            </th>
            <th style="background-color:#efc475; color:black; position: relative;" class="sortable" data-sort="price">
                Price
                <span class="sort-arrow default"></span>
            </th>
            <th style="background-color:#efc475; color:black">Color</th>
            <th style="background-color:#efc475; color:black">Stock</th>
            <th style="background-color:#efc475; color:black">Status</th>
            <th style="background-color:#efc475; color:black">Actions</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        @foreach($seller_products as $sellers)
        
        @php 
            $images = json_decode($sellers->images); 
        @endphp
        
        @if($sellers->seller_id == 'OBD-SLR-1007' && empty($images))
        
        @else
        
        <tr data-bsp="{{ $sellers->bank_settlement_price }}" data-price="{{ $sellers->portal_updated_price }}">
            <td>{{ ++$i }}</td> 
            
            @if(empty($images))
            <td>----</td>
            @elseif(!empty($images) && isset($images[0]))
                @php
                    $firstImage = $images[0];
                    $isS3Image = Str::startsWith($firstImage, 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/products/'); 
                    $imageSrc = $isS3Image ? $firstImage : "https://seller.ohhbuddie.com/public/uploads/products/" . basename($firstImage);
                @endphp
            
                <td>
                    @php
                        // Get the product
                        $same_p = DB::table('products')->where('id', $sellers->id )->first();

                        // Initialize variables
                        $sub = '';
                        $brnd_name11 = '';

                        if ($same_p) {
                            // Get seller (common in both cases)
                            $seller_id = DB::table('sellers')
                                ->where('seller_id', $same_p->seller_id)
                                ->latest()
                                ->first();

                            if ($same_p->category_id == 88 || $same_p->subcategory_id == 95) {
                                // Get subcategory
                                $cat_id = DB::table('categories')
                                    ->where('id', $same_p->subcategory_id)
                                    ->latest()
                                    ->first();
                                $sub = $cat_id ? $cat_id->subcategory : '';
                            } else {
                                // Get sub-subcategory
                                $cat_id = DB::table('categories')
                                    ->where('id', $same_p->sub_subcategory_id)
                                    ->latest()
                                    ->first();
                                $sub = $cat_id ? $cat_id->sub_subcategory : '';
                            }

                            // Get brand or fallback to seller company name
                            $brnd_cnt = DB::table('brands')->where('id', $same_p->brand_id)->count();
                            if ($brnd_cnt > 0) {
                                $brnd_name = DB::table('brands')->where('id', $same_p->brand_id)->latest()->first();
                                $brnd_name11 = $brnd_name ? $brnd_name->brand_name : '';
                            } else {
                                $brnd_name11 = $seller_id ? $seller_id->company_name : '';
                            }
                        }
                    @endphp
                         
                    <a href="https://ohhbuddie.com/product/{{ \Illuminate\Support\Str::slug($sub ?? '') }}/{{ \Illuminate\Support\Str::slug($brnd_name11 ?? '') }}/{{ \Illuminate\Support\Str::slug($same_p->product_name ?? '') }}/{{ $same_p->id }}/buy"
                        style="text-decoration: none;">

                        <img src="{{ $imageSrc }}" class="d-block w-100 product-image" alt="Product Image" style="max-height: 100px;">
                     </a>
                    </td>
            @endif
            
            <td>{{ $sellers->company_name }} <br> {{ $sellers->id }} </td> 
            <td> 
                @if($sellers->pstatus == 1)
                    {{ $sellers->product_name }} <span class="badge" style="background-color: green; border-radius: 50%; width: 12px; height: 12px; display: inline-block;"></span>
                @else
                    {{ $sellers->product_name }} <span class="badge" style="background-color: red; border-radius: 50%; width: 12px; height: 12px; display: inline-block;"></span>
                @endif
            </td>
            <td>{{ $sellers->parent_id }}</td>
            <td>{{ $sellers->sku }}</td>
            <td>Rs. {{ $sellers->bank_settlement_price }}</td> 
            <td>Rs. {{ $sellers->portal_updated_price }}</td> 

            <td>
                @php
                    $cname = DB::table('colors')->where('hex_code', $sellers->color_name)->latest()->first();
                @endphp
            
               @if($sellers->color_name == Null)
                ----
                @else
                    @if ($cname)
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $cname->hex_code }}; border: 1px solid #000; border-radius: 4px;"></span>
                        {{ $cname->color_name }}
                    @else
                        N/A
                    @endif                      
                @endif
            </td>
            <td>{{ $sellers->stock_quantity }}</td>
            <td>
                <span class="badge bg-success">In Stock</span>
            </td>
            <td>
                <div class="btn-group gap-2">
                    <a href="{{ route('products.edit', $sellers->id) }}">
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                        <form action="{{ route('products.destroy', $sellers->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>

<!-- JavaScript for sorting functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableHeaders = document.querySelectorAll('.sortable');
    let currentSort = { column: null, direction: null };

    sortableHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const sortType = this.dataset.sort;
            const arrow = this.querySelector('.sort-arrow');
            
            // Reset all arrows
            sortableHeaders.forEach(h => {
                const arr = h.querySelector('.sort-arrow');
                arr.className = 'sort-arrow default';
            });
            
            // Determine sort direction
            let direction;
            if (currentSort.column === sortType) {
                direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
            } else {
                direction = 'asc';
            }
            
            // Update arrow
            arrow.className = `sort-arrow ${direction}`;
            
            // Sort the table
            sortTable(sortType, direction);
            
            // Update current sort
            currentSort = { column: sortType, direction: direction };
        });
    });

    function sortTable(column, direction) {
        const tbody = document.getElementById('tableBody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            let aValue, bValue;
            
            if (column === 'bsp') {
                aValue = parseFloat(a.dataset.bsp) || 0;
                bValue = parseFloat(b.dataset.bsp) || 0;
            } else if (column === 'price') {
                aValue = parseFloat(a.dataset.price) || 0;
                bValue = parseFloat(b.dataset.price) || 0;
            }
            
            if (direction === 'asc') {
                return aValue - bValue;
            } else {
                return bValue - aValue;
            }
        });
        
        // Re-append sorted rows
        rows.forEach(row => tbody.appendChild(row));
        
        // Update serial numbers
        updateSerialNumbers();
    }
    
    function updateSerialNumbers() {
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach((row, index) => {
            const slCell = row.querySelector('td:first-child');
            if (slCell) {
                slCell.textContent = index + 1;
            }
        });
    }
});
</script>
    </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
        

<!-- Include jQuery, Bootstrap & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    
    
   
<script>
        $(document).ready(function () {
            $('#sellerProductsTable').DataTable({
                "pageLength": 10,
                "searching": true,
                "sorting":false,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "lengthMenu": "Show _MENU_ entries per page",
                    "zeroRecords": "No matching records found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries available",
                    "infoFiltered": "(filtered from _MAX_ total entries)"
                },
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                    // Note: Word export is not supported by DataTables natively
                ]
            });
        });
        
    // Tab configuration
    const tabConfig = {
        active: {
            buttons: ['In Stock', 'Out of Stock'],
            leftAction: { text: 'Bulk Download', icon: 'download' },
            rightAction: { text: 'Bulk Upload', icon: 'upload' }
        },
        pending: {
            buttons: ['New', 'In Review'],
            leftAction: { text: 'Approve All', icon: 'check' },
            rightAction: { text: 'Reject All', icon: 'times' }
        },
        rejected: {
            buttons: ['Today', 'This Week'],
            leftAction: { text: 'Archive All', icon: 'archive' },
            rightAction: { text: 'Delete All', icon: 'trash' }
        }
    };

    // Update tab content
    function updateTabContent(tabId) {
        const config = tabConfig[tabId];

        // Update state buttons
        const buttonGroup = document.getElementById('tabStateButtons');
        buttonGroup.innerHTML = config.buttons
            .map((text, i) => `<button class="btn btn-outline-secondary${i === 0 ? ' active' : ''}">${text}</button>`)
            .join('');

        // Update action buttons
        document.getElementById('leftAction').innerHTML =
            `<i class="fas fa-${config.leftAction.icon} me-2"></i>${config.leftAction.text}`;
        document.getElementById('rightAction').innerHTML =
            `<i class="fas fa-${config.rightAction.icon} me-2"></i>${config.rightAction.text}`;
    }

    // Run when DOM is ready
    $(document).ready(function () {
        // Initial setup for tab
        updateTabContent('active');

        // Tab change listener
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                updateTabContent(event.target.getAttribute('data-tab'));
            });
        });

        // Filter chip toggle
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function () {
                this.classList.toggle('active');
            });
        });

        // Initialize DataTable with search and pagination (20 per page)
        $('#productTable').DataTable({
            pageLength: 20,
            lengthChange: false,
            searching: true
        });
    });
</script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-status').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const productId = this.getAttribute('data-id');
                const newStatus = this.checked ? 1 : 0;
    
                fetch(`/products/update-status/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ pstatus: newStatus })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.nextElementSibling.innerText = newStatus ? 'Active' : 'In-Active';
                        window.location.reload();
                    } else {
                        alert('Failed to update status.');
                    }
                });
            });
        });
    });
    </script>
</body>
</html>