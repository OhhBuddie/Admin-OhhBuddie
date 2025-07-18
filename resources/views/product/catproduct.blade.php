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
        <table id="sellerProductsTable" class="table table-hover table-bordered table-striped" style="zoom:85%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Sub Sub Category Name</th>
                    <th>Number Of Product</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($categoryCounts as $sellers)
                <tr>
                    <td>{{ $sellers->id }}</td> 
                    <td>{{ $sellers->category }}</td>
                    <td>{{ $sellers->subcategory }}</td>
                    <td>{{ $sellers->sub_subcategory }}</td> 
                    <td>{{ $sellers->product_count }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
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

        // Initialize tabs
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

        // Initialize filter chips
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });

        // Tab change listener
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(event) {
                updateTabContent(event.target.getAttribute('data-tab'));
            });
        });

        // Initial setup
        updateTabContent('active');
    </script>
</body>
</html>