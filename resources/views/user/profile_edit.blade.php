<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Profile</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: black;
            color: white;
            padding-top: 60px; /* For navbar height */
            padding-bottom: 80px; /* For button height */
            margin: 0;
        }

        .navbar-fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background-color: black;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .navbar-fixed-top .header {
            font-size: 18px;
            font-weight: bold;
            margin-left: 15px;
        }

        .container {
            background: black;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .form-control {
            color: #f5f5f5;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            padding: 12px;
        }

        .form-control:focus {
            outline: none;
            border: 2px solid var(--primary-color);
            box-shadow: none;
        }

        .btn-fixed-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            text-align: center;
        }

        .btn-primaryy {
            background-color: var(--primary-color);
            border: none;
            font-size: 16px;
            font-weight: bold;
            color: black;
            transition: all 0.3s ease;
        }

        .btn-primaryy:active {
            background-color: var(--primary-color);
            color: black;
        }

        @media (max-width: 576px) {
            .form-control {
                font-size: 16px;
                padding: 14px;
            }

            .container {
                padding: 15px;
            }

            .btn-primaryy {
                font-size: 18px;
                padding: 14px;
            }
        }
        /* Uniform height for all input fields and select box */
        .form-control, .select2-container .select2-selection--single {
            height: 50px !important;  /* Set same height */
            font-size: 16px; /* Adjust text size */
            color: black !important; /* Change text color to black */
            background-color: white !important; /* Ensure background is white */
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ccc;
        }
        
        /* Select2 specific styling */
        .select2-container .select2-selection--single {
            display: flex !important;
            align-items: center !important;
        }
        
        /* Ensure dropdown text is black */
        .select2-dropdown {
            font-size: 16px !important;
            color: black !important;
        }
        
        /* Placeholder text color */
        ::placeholder {
            color: black !important;
            opacity: 1;
        }
        
        /* Change icon color in the Select2 dropdown */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: black !important;
        }
        .select2-selection__clear {
    display: none !important;
}
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <div class="navbar-fixed-top">
        <a href="javascript:history.back();" style="font-size: 20px; color:white;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="header">EDIT YOUR PROFILE</div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!--<h5 class="section-title">Enter Your Details</h5>-->
        <form action="{{ url('/profileupdate/' . Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="section-title">Enter Your Name</label>
                <input type="text" class="form-control" placeholder="Enter Your Name" name="name" value="{{ Auth::user()->name }}">
            </div>
            <div class="mb-3">
                <label class="section-title">Enter Your Email</label>
                <input type="email" class="form-control" placeholder="Enter Your Email Address" name="email" value="{{ Auth::user()->email }}">
            </div>
            <div class="mb-3">
                <label class="section-title">Enter Your Date Of Birth</label>
                <input type="date" class="form-control" placeholder="Enter Your Date Of Birth" value="{{ Auth::user()->dob }}" name="dob">
            </div>
            <div class="mb-3">
                <label class="section-title">Enter Your Gender</label>
                <select id="categorySelect" class="form-control select2" name="gender">
                    <option value="" disabled>--Select Gender--</option>
                    <option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Others" {{ Auth::user()->gender == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="section-title">Upload Profile Picture</label>
                <input type="file" class="form-control" name="profile_photo" id="profile_photo_input" accept="image/*">
                <img id="profile_preview" src="#" alt="Profile Preview" style="display: none; margin-top: 10px; width: 150px; height: 150px; object-fit: cover; border-radius: 10px;">
            </div>
            
    

            <!-- Submit Button -->
            <div class="btn-fixed-bottom">
                <button type="submit" class=" btn-primaryy w-100">Save Profile</button>
                
            </div>
            
        </form>

    </div>

    <!-- jQuery (Required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: false,  // Disable the clear (X) button
                minimumResultsForSearch: Infinity // Hide search box
            });
    
            // Ensure Select2 box takes full width
            $('.select2').next('.select2-container').css('width', '100%');
        });
    </script>

    <!-- JavaScript for Image Preview -->
    <script>
    document.getElementById('profile_photo_input').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            let preview = document.getElementById('profile_preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        if (event.target.files.length > 0) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
    </script>
</body>
</html>