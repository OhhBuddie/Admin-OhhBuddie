<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Footer Content</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Create Footer Content</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('footer.store') }}" method="POST">
            @csrf
        
            <div class="mb-3">
                <label for="page" class="form-label">Page</label>
                <!--<input type="text" name="page" id="page" class="form-control" required>-->
                <select name="page" id="page" class="form-control" required>
                
                    <option value="">--Select Page--</option>
                    <option value="Home">Home</option>
                    <option value="Category">Category</option>
                    <option value="Product">Product</option>
                </select>
            </div>
        
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category" class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="subcategory" class="form-label">Subcategory</label>
                <input type="text" name="subcategory" id="subcategory" class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="sub_subcategory" class="form-label">Sub-Subcategory</label>
                <input type="text" name="sub_subcategory" id="sub_subcategory" class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="footer" class="form-label">Footer Content</label>
                <textarea name="footer" id="footer" class="form-control" rows="6" required></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary">Save Footer</button>
        </form>
        
    </div>
</div>

<script>
    CKEDITOR.replace('footer');
</script>

</body>
</html>