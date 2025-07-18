<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $product = Storage::disk('s3')->url('Product/Comp 1 (4).gif');
       return view('product.index', compact('product'));

    }
    
    public function sellerproduct()
    {

        $seller_products = DB::table('products')
                            ->join('sellers', DB::raw('BINARY products.seller_id'), '=', DB::raw('BINARY sellers.seller_id'))
                            ->joinSub(function ($query) {
                                $query->from('products')
                                      ->select('product_id', DB::raw('MAX(id) as max_id'))
                                      ->groupBy('product_id');
                            }, 'latest_products', function ($join) {
                                $join->on('products.product_id', '=', 'latest_products.product_id')
                                     ->on('products.id', '=', 'latest_products.max_id');
                            })
                            ->whereNotNull('product_name')
                            ->select('products.*', 'sellers.owner_name', 'sellers.company_name')
                            ->orderBy('products.id', 'desc')
                            ->get();
        // Example S3 product image URL
        $product = Storage::disk('s3')->url('Product/Comp 1 (4).gif');
    
        return view('product.sellerproduct', compact('product', 'seller_products'))->with('i');
    }
    
    public function sellerdetails()
    {
        // Fetch all products along with their seller names

        $seller_details = DB::table('sellers')->whereNotNull('company_name')->orderBy('created_at', 'DESC')->get()->toArray();
        

        // Example S3 product image URL
        $product = Storage::disk('s3')->url('Product/Comp 1 (4).gif');
    
        return view('product.sellerdetails', compact('product', 'seller_details'))->with('i');
    }

    
    
    public function listing()
    {
       return view('product.listing');

    }
    public function listing1()
    {
        $level1 = DB::table('categories')->select('id','category')->where('level',0)->get();
        
        $level2_men = DB::table('categories')->select('id','subcategory')->where('level',1)->where('category','Men')->get();
        $level2_women = DB::table('categories')->select('id','subcategory')->where('level',1)->where('category','Women')->get();

        
        // return $level2_men;
        return view('product.listing1',compact('level1'));

    }
    
    public function form()
    {
        
        // $seller_id = DB::table('sellers')->where('user_table_id', Auth::user()->id)->latest()->first();
        // $parentid = DB::table('products')->where('seller_id', $seller_id->seller_id)->whereNotNull('parent_id')->latest()->get();
        
        // $shipping_mode = $seller_id->shipping_mode;
        // $brand_cnt = DB::table('brands')->where('seller_id',$seller_id->seller_id)->count();
        
        $attr = DB::table('attributes')->latest()->get();
        
        $cate = request()->query('id'); 
    
        $table = DB::table('products')->where('id', $cate)->latest()->first();
        
        $cat_id = $table->category_id; 
        $subcat_id = $table->subcategory_id; 
        $subsubcat_id = $table->sub_subcategory_id; 
        $pid = $table->product_id;
        
        // return $table;

        $a = DB::table('categories')->where('id', $table->category_id)->select('category')->latest()->first();
        $b = DB::table('categories')->where('id', $table->subcategory_id)->select('subcategory')->latest()->first();
        $c = DB::table('categories')->where('id', $table->sub_subcategory_id)->select('sub_subcategory')->latest()->first();
        
        // return $b;
        
        if($b->subcategory == 'Lingerie & Sleepwear')
        {
            $size = DB::table('sizes')->where('id',5)->latest()->get();
        }
        else if($a->category == 'Kids')
        {
            $size = DB::table('sizes')->where('id',2)->latest()->get();
        }
        else if($b->subcategory == 'Bottom Wear')
        {
            $size = DB::table('sizes')->where('id',3)->latest()->get();
        }
        else if($b->subcategory == 'Footwear')
        {
            $size = DB::table('sizes')->where('id',4)->latest()->get();
        }
        else if($b->subcategory == 'Innerwear')
        {
            $size = DB::table('sizes')->where('id',6)->latest()->get();
        }
        else
        {
            $size = DB::table('sizes')->where('id',1)->latest()->get();
        }
        
        $cat = $a->category;
        $subcat = $b->subcategory;
        
        if($c == Null)
        {
            $subsubcat = 'NA';
        }
        else
        {
            $subsubcat = $c->sub_subcategory;
        }
        
        
        $colors = DB::table('colors')->where('level','1')->get(); // Fetch all colors from the database

        $seller_data = DB::table('sellers')->distinct()->get();
        

        // return view('product.create', compact('parentid','seller_data','brand_cnt','attr', 'cat', 'subcat', 'subsubcat', 'cat_id', 'subcat_id', 'subsubcat_id','colors','size','pid','shipping_mode'));
        return view('product.create_new', compact('seller_data','attr', 'cat', 'subcat', 'subsubcat', 'cat_id', 'subcat_id', 'subsubcat_id','colors','size','pid'));

    }
    
    
    
    
    
        public function form_new()
    {
        
        // $seller_id = DB::table('sellers')->where('user_table_id', Auth::user()->id)->latest()->first();
        // $parentid = DB::table('products')->where('seller_id', $seller_id->seller_id)->whereNotNull('parent_id')->latest()->get();
        
        // $shipping_mode = $seller_id->shipping_mode;
        // $brand_cnt = DB::table('brands')->where('seller_id',$seller_id->seller_id)->count();
        
        $attr = DB::table('attributes')->latest()->get();
        
        $cate = request()->query('id'); 
    
        $table = DB::table('products')->where('id', $cate)->latest()->first();
        
        $cat_id = $table->category_id; 
        $subcat_id = $table->subcategory_id; 
        $subsubcat_id = $table->sub_subcategory_id; 
        $pid = $table->product_id;
        
        // return $table;

        $a = DB::table('categories')->where('id', $table->category_id)->select('category')->latest()->first();
        $b = DB::table('categories')->where('id', $table->subcategory_id)->select('subcategory')->latest()->first();
        $c = DB::table('categories')->where('id', $table->sub_subcategory_id)->select('sub_subcategory')->latest()->first();
        
        // return $b;
        
        if($b->subcategory == 'Lingerie & Sleepwear')
        {
            $size = DB::table('sizes')->where('id',5)->latest()->get();
        }
        else if($a->category == 'Kids')
        {
            $size = DB::table('sizes')->where('id',2)->latest()->get();
        }
        else if($b->subcategory == 'Bottom Wear')
        {
            $size = DB::table('sizes')->where('id',3)->latest()->get();
        }
        else if($b->subcategory == 'Footwear')
        {
            $size = DB::table('sizes')->where('id',4)->latest()->get();
        }
        else if($b->subcategory == 'Innerwear')
        {
            $size = DB::table('sizes')->where('id',6)->latest()->get();
        }
        else
        {
            $size = DB::table('sizes')->where('id',1)->latest()->get();
        }
        
        $cat = $a->category;
        $subcat = $b->subcategory;
        
        if($c == Null)
        {
            $subsubcat = 'NA';
        }
        else
        {
            $subsubcat = $c->sub_subcategory;
        }
        
        
        $colors = DB::table('colors')->where('level','1')->get(); // Fetch all colors from the database

        $seller_data = DB::table('sellers')->distinct()->get();
        

        // return view('product.create', compact('parentid','seller_data','brand_cnt','attr', 'cat', 'subcat', 'subsubcat', 'cat_id', 'subcat_id', 'subsubcat_id','colors','size','pid','shipping_mode'));
        return view('product.create_new', compact('seller_data','attr', 'cat', 'subcat', 'subsubcat', 'cat_id', 'subcat_id', 'subsubcat_id','colors','size','pid'));

    }
    
    public function getSellerData(Request $request)
    {
        $sellerId = $request->seller_id;

        // Fetch seller details
        $seller = DB::table('sellers')->where('id', $sellerId)->first();

        if (!$seller) {
            return response()->json([
                'brand_name' => [],
                'parent_ids' => [],
                'shipping_mode' => null
            ]);
        }

        // Get brand names for the seller
        $brands = DB::table('brands')
            ->where('seller_table_id', $request->seller_id)
            ->select('id','brand_name') // Get only brand names
            ->get();

        // Get parent IDs from products table
        $parentIds = DB::table('products')
            ->where('seller_id', $seller->seller_id)
            ->whereNotNull('parent_id')
            ->distinct()
            ->pluck('parent_id');

        // Return JSON response
        return response()->json([
            'brand_name' => $brands,
            'parent_ids' => $parentIds,
            'shipping_mode' => $seller->shipping_mode
        ]);
    }
    
    public function getSubcategories($id)
    {
        $subcategories = Category::where('parent_id', $id)->get();
        return response()->json($subcategories);
    }
    
    public function getSubSubcategories($id)
    {
        $subsubcategories = Category::where('parent_id', $id)->get();
    
        // Debugging: Check if data is returned
        if ($subsubcategories->isEmpty()) {
            return response()->json(['message' => 'No Sub-Subcategories Found']);
        }
    
        return response()->json($subsubcategories);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
   
    public function saveProductData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
            'sub_sub_category_id' => 'nullable|integer',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        
        try {
            // Generate a unique product ID without seller_id
            $lastProduct = DB::table('products')
                ->where('product_id', 'LIKE', 'OBD-PR-%')
                ->orderBy('id', 'desc')
                ->first();
                
            // Extract last number and increment
            if ($lastProduct) {
                preg_match('/OBD-PR-(\d+)/', $lastProduct->product_id, $matches);
                $nextNumber = isset($matches[1]) ? ((int) $matches[1] + 1) : 1001;
            } else {
                $nextNumber = 1001;
            }
            
            // Generate unique product ID without seller_id
            $product_id = 'OBD-PR-' . $nextNumber;
            
            // Insert product data into the database (without seller_id)
            $productId = DB::table('products')->insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->sub_category_id,
                'sub_subcategory_id' => $request->sub_sub_category_id,
                'product_id' => $product_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Product saved successfully!',
                'product_id' => $productId
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error saving product data: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to save product data.'
            ], 500);
        }
    }


    
 



        
        public function store(Request $request)
        {
            // return 'store';
            // Fabric
            $fabric = !empty($request->fabric) ? $request->fabric : null;
            if (!$fabric) {
                for ($i = 1; $i <= 25; $i++) {
                    $key = 'fabric' . $i;
                    if (!empty($request->$key)) {
                        $fabric = $request->$key;
                        break;
                    }
                }
            }
            
            // Bottom Included
            $bottom_included = null;
            for ($i = 1; $i <= 2; $i++) {
                $key = 'bottom_included' . $i;
                if (!empty($request->$key)) {
                    $bottom_included = $request->$key;
                    break;
                }
            }
            
            // Set Type
            $set_type_keys = ['set_type_kurti', 'set_type_kurta', 'set_type_coord'];
            $set_type = null;
            foreach ($set_type_keys as $key) {
                if (!empty($request->$key)) {
                    $set_type = $request->$key;
                    break;
                }
            }
            
            // Sleeve Length
            $sleeve_length = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'sleeve_length_' . $i;
                if (!empty($request->$key)) {
                    $sleeve_length = $request->$key;
                    break;
                }
            }
            
            // Sleeve Pattern
            $sleeve_pattern = null;
            for ($i = 1; $i <= 4; $i++) {
                $key = 'sleeve_pattern_' . $i;
                if (!empty($request->$key)) {
                    $sleeve_pattern = $request->$key;
                    break;
                }
            }
            
            // Closure Type
            $closure_type = null;
            for ($i = 1; $i <= 7; $i++) {
                $key = 'closure_type_' . $i;
                if (!empty($request->$key)) {
                    $closure_type = $request->$key;
                    break;
                }
            }
            
            // Work Details
            $work_details = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'work_details_' . $i;
                if (!empty($request->$key)) {
                    $work_details = $request->$key;
                    break;
                }
            }
            
            // Border Type
            $border_type = null;
            for ($i = 1; $i <= 2; $i++) {
                $key = 'border_type_' . $i;
                if (!empty($request->$key)) {
                    $border_type = $request->$key;
                    break;
                }
            }
            
            // Bottom Type
            $bottom_type = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'bottom_type_' . $i;
                if (!empty($request->$key)) {
                    $bottom_type = $request->$key;
                    break;
                }
            }
            
            // Dupatta Length
            $dupatta_length = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'dupatta_length_' . $i;
                if (!empty($request->$key)) {
                    $dupatta_length = $request->$key;
                    break;
                }
            }
            
            // Length
            $length = null;
            for ($i = 1; $i <= 6; $i++) {
                $key = 'length_' . $i;
                if (!empty($request->$key)) {
                    $length = $request->$key;
                    break;
                }
            }
            
            // Fit Type
            $fit_type = null;
            for ($i = 1; $i <= 26; $i++) {
                $key = 'fit_type_' . $i;
                if (!empty($request->$key)) {
                    $fit_type = $request->$key;
                    break;
                }
            }
            
            // Waistband Type
            $waistband_type = null;
            for ($i = 1; $i <= 4; $i++) {
                $key = 'waistband_type_' . $i;
                if (!empty($request->$key)) {
                    $waistband_type = $request->$key;
                    break;
                }
            }
            
            // Waist Rise
            $waist_rise = null;
            for ($i = 1; $i <= 2; $i++) {
                $key = 'waist_rise_' . $i;
                if (!empty($request->$key)) {
                    $waist_rise = $request->$key;
                    break;
                }
            }
            
            //Sleeve Style
            
            $sleeve_style = null;
            for($i = 1; $i <= 2; $i++){
                $key = 'sleeve_style_' . $i;
                if(!empty($request->$key)){
                    $sleeve_style = $request->$key;
                    break;
                }
            }
                    
        
        
        $seller_id_name = DB::table('sellers')->where('id', $request->seller_table_id)->latest()->first();
        
        $color_name =  DB::table('colors')
        ->where('color_name', $request->color_name)
        ->latest()
        ->first()
        ->hex_code;
        
        
        $id = $request->product_id;
        
        
        
        // return $id;
        
        // Retrieve the existing product
        $product = DB::table('products')->where('id', $id)->first();
        
        
        if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
        }
        
        
        
        // Generate parent_id if needed
        $pids = DB::table('products')
        ->whereNotNull('parent_id')
        ->where('seller_user_id', $seller_id_name->user_table_id)
        ->pluck('parent_id')
        ->toArray();
        
        if (!in_array($request->parent_id, $pids)) {
        $lastProduct = DB::table('products')
        ->where('seller_user_id', $seller_id_name->user_table_id)
        ->orderBy('id', 'desc')
        ->first();
        
        $nextNumber = $lastProduct ? ((int) str_replace('OBD-' . $seller_id_name->seller_id . '-' . $request->parent_id . '-', '', $lastProduct->product_id) + 1) : 1000;
        $parent_id = 'OBD-' . $seller_id_name->seller_id . '-' . $request->parent_id;
        } else {
        $parent_id = $request->parent_id;
        }
        
        
        
        
        
        $lastProduct1 = DB::table('products')
        ->where('seller_id', $seller_id_name->seller_id)
        ->where('product_id', 'LIKE', 'OBD-PR-' . $seller_id_name->seller_id . '-%')
        ->orderBy('id', 'desc')
        ->first();
        
        // Extract last number and increment
        if ($lastProduct1) {
        preg_match('/OBD-PR-' . $seller_id_name->seller_id . '-(\d+)/', $lastProduct1->product_id, $matches1);
        $nextNumber1 = isset($matches[1]) ? ((int) $matches1[1] + 1) : 1001;
        } else {
        $nextNumber1 = 1001;
        }
        
        // Generate unique product ID
        $product_id = 'OBD-PR-' . $seller_id_name->seller_id . '-' . $nextNumber1;
        
        
        
        
        
        $seller_user_id = DB::table('sellers')->where('user_table_id', $seller_id_name->user_table_id )->latest()->first();
        
        
        // return $request->stock_quantity;
        
        $array = json_decode($request->stock_quantity, true); // Convert JSON string to PHP array
        
        
        
        //Product ID
        
        $lastProduct = DB::table('products')
        ->where('seller_id', $seller_id_name->seller_id)
        ->where('product_id', 'LIKE', 'OBD-PR-' . $seller_id_name->seller_id . '-%')
        ->orderBy('id', 'desc')
        ->first();
        
        // Extract last number and increment
        if ($lastProduct) {
        preg_match('/OBD-PR-' . $seller_id_name->seller_id . '-(\d+)/', $lastProduct->product_id, $matches);
        $nextNumber = isset($matches[1]) ? ((int) $matches[1] + 1) : 1001;
        } else {
        $nextNumber = 1001;
        }
        
        // Generate unique product ID
        $product_id = 'OBD-PR-' . $seller_id_name->seller_id . '-' . $nextNumber;
        
        // return $product_id;
        $seller_id = $seller_id_name->seller_id;
        
        
        $imageUrls = [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $folderPath = "products/{$seller_id}/{$product_id}";
                $fileName = time() . '_' . $file->getClientOriginalName();
        
                // Detect MIME type reliably
                $imageInfo = getimagesize($file->getPathname());
                $mime = $imageInfo['mime'] ?? null;
        
                // Load image based on MIME type
                switch ($mime) {
                    case 'image/jpeg':
                        $sourceImage = imagecreatefromjpeg($file->getPathname());
                        break;
                    case 'image/png':
                        $sourceImage = imagecreatefrompng($file->getPathname());
                        break;
                    default:
                        continue; // unsupported format, skip file
                }
        
                if (!$sourceImage) {
                    continue;
                }
        
                // Resize image to 692 x 1040
                $targetWidth = 412;
                $targetHeight = 559;
                $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
        
                // Maintain transparency for PNGs
                if ($mime === 'image/png') {
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                }
        
                // Resize with resampling
                imagecopyresampled(
                    $resizedImage, $sourceImage,
                    0, 0, 0, 0,
                    $targetWidth, $targetHeight,
                    imagesx($sourceImage), imagesy($sourceImage)
                );
        
                // Compress to JPEG with 70% quality
                ob_start();
                imagejpeg($resizedImage, null, 70);
                $imageData = ob_get_clean();
        
                // Upload to R2
                $filePath = $folderPath . '/' . $fileName;
                Storage::disk('r2')->put($filePath, $imageData, 'public');
        
                // Public URL
                $url = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                $imageUrls[] = $url;
        
                // Cleanup
                imagedestroy($sourceImage);
                imagedestroy($resizedImage);
            }
        }
                
                
                
                
                
                
                
                
                
        
        
        // return $array;
        if ($array === null) {
        $elementCount = 0;
        } else {
        $elementCount = count($array);
        }
        

        // return json_decode($request->stock_quantity);
        
        $first = true;
        
        foreach (json_decode($request->stock_quantity) as $stck) {
        

        $bankSettlementPrice = $stck->bank_settlement_price;
        $shippingMode = $seller_id_name->shipping_mode;
        $bankprice = 0;
        
        if ($shippingMode == "In-Store") {
        
        if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) {
        $shipping = 131;
        $bankprice = round($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice) + (0.03 * ($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice))));
        } elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) {
        $shipping = 180;
        $basePrice = $bankSettlementPrice + $shipping;
        $tenPercent = 0.1 * $basePrice;
        $threePercent = 0.03 * ($basePrice + $tenPercent);
        $bankprice = round($basePrice + $tenPercent + $threePercent);
        } elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) {
        $shipping = 200;
        $basePrice = $bankSettlementPrice + $shipping;
        $fifteenPercent = 0.15 * $basePrice;
        $threePercent = 0.03 * ($basePrice + $fifteenPercent);
        $bankprice = round($basePrice + $fifteenPercent + $threePercent);
        } elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) {
        $shipping = 220;
        $basePrice = $bankSettlementPrice + $shipping;
        $eighteenPercent = 0.18 * $basePrice;
        $additionalCharge = 0.03 * ($basePrice + $eighteenPercent);
        $bankprice = round($basePrice + $eighteenPercent + $additionalCharge);
        } elseif ($bankSettlementPrice >= 2500) {
        $shipping = 240;
        $basePrice = $bankSettlementPrice + $shipping;
        $twentyPercent = 0.2 * $basePrice;
        $threePercent = 0.03 * ($basePrice + $twentyPercent);
        $bankprice = round($basePrice + $twentyPercent + $threePercent);
        }
        }
        
        elseif ($shippingMode == "Warehouse") {
        
        // return 'out';
        $gurantee = 35;
        $inward = 9;
        
        if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) {
        $shipping = 131;
        $bankprice = round($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice) + (0.03 * ($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice))));
        } elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) {
        $shipping = 180;
        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
        $tenPercent = 0.1 * ($bankSettlementPrice + $shipping);
        $threePercent = 0.03 * ($basePrice + $tenPercent);
        $bankprice = round($basePrice + $tenPercent + $threePercent);
        } elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) {
        $shipping = 200;
        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
        $fifteenPercent = 0.15 * ($bankSettlementPrice + $shipping);
        $threePercent = 0.03 * ($basePrice + $fifteenPercent);
        $bankprice = round($basePrice + $fifteenPercent + $threePercent);
        } elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) {
        $shipping = 220;
        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
        $eighteenPercent = 0.18 * ($bankSettlementPrice + $shipping);
        $additionalCharge = 0.03 * ($basePrice + $eighteenPercent);
        $bankprice = round($basePrice + $eighteenPercent + $additionalCharge);
        } elseif ($bankSettlementPrice >= 2500) {
        $shipping = 240;
        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
        $twentyPercent = 0.2 * ($bankSettlementPrice + $shipping);
        $threePercent = 0.03 * ($basePrice + $twentyPercent);
        $bankprice = round($basePrice + $twentyPercent + $threePercent);
        }
        }
        
        
        
        $data = [
        'category_id' => $request->input('category_id'),
        'subcategory_id' => $request->input('subcategory_id'),
        'sub_subcategory_id' => $request->input('sub_subcategory_id'),
        'product_name' => $request->input('product_name'),
        'product_id' => $product_id, // Auto-generated
        'seller_user_id' => $seller_id_name->user_table_id,
        'seller_id' => $seller_id_name->seller_id,
        'parent_id' => $parent_id,
        'brand_id' => $request->input('brand_id'),
        'description' => $request->input('description'),
        'size_name' => $stck->size,
        'stock_quantity' => $stck->quantity,
        'color_name' => $color_name,
        'fabric' => $fabric,
        'occasion' => $request->input('occasion'),
        'care_instructions' => $request->input('care_instructions'),
        'video_url' => $request->input('video_url'),
        'shipping_time' => $request->input('shipping_time'),
        'return_policy' => $request->input('return_policy'),
        'sku' => $stck->sku,
        'hsn' => $request->input('hsn'),
        'gst_rate' => $request->input('gst_rate'),
        'procurement_type' => $request->input('procurement_type'),
        'package_weight' => $request->input('package_weight'),
        'package_length' => $request->input('package_length'),
        'package_breadth' => $request->input('package_breadth'),
        'package_height' => $request->input('package_height'),
        'pack_of' => $request->input('pack_of'),
        'country_of_origin' => $request->input('country_of_origin'),
        'manufacturer_details' => $request->input('manufacturer_details'),
        'packer_details' => $request->input('packer_details'),
        'size_chart_id' => $request->input('size_chart_id'),
        'listing_status' => $request->input('listing_status'),
        'maximum_retail_price' => $stck->maximum_retail_price,
        'bank_settlement_price' => $stck->bank_settlement_price,
        'portal_updated_price' => $bankprice,
        'alt_text' => $request->input('alt_text'),
        'pattern' => $request->input('pattern'),
        
        'added_by' => Auth::id(),
        'images' => json_encode($imageUrls),
        'sole_material' => $request->input('sole_material'),
        'upper_material' => $request->input('upper_material'),
        
        'toe_shape' => $request->input('toe_shape'),
        'heel_type' => $request->input('heel_type'),
        
        'pstatus' => $request->pstatus,
        'saree_length' => $request->saree_length,
        'blouse_fabric' => $request->blouse_fabric,
        'blouse_piece_included' => $request->blouse_piece_included,
        'blouse_length' => $request->blouse_length,
        'blouse_stiched' => $request->blouse_stiched,
        'work_details' => $work_details ?? null,
        'border_type' => $border_type ?? null,
        'weave_type' => $request->weave_type,
        'pattern' => $request->pattern,
        'gown_type' => $request->gown_type,
        'sleeve_length' => $sleeve_length ?? null,
        'sleeve_pattern' => $sleeve_pattern ?? null,
        'neck_style' => $request->neck_style,
        'closure_type' => $closure_type ?? null,
        'embellishment_details' => $request->embellishment_details,
        'lining_present' => $request->lining_present,
        'top_type' => $request->top_type,
        'hemline' => $request->hemline,
        'transparency_level' => $request->transparency_level,
        'set_type' => $set_type ?? null,
        'bottom_included' => $bottom_included,
        'bottom_type' => $bottom_type ?? null,
        'dupatta_fabric' => $request->dupatta_fabric,
        'dupatta_length' => $dupatta_length ?? null,
        'dupatta_shawl_type' => $request->dupatta_shawl_type,
        'length' => $length ?? null,
        'lehenga_type' => $request->lehenga_type,
        'lehenga_length' => $request->lehenga_length,
        'choli_included' => $request->choli_included,
        'choli_length' => $request->choli_length,
        'choli_sleeve_length' => $request->choli_sleeve_length,
        'dupatta_included' => $request->dupatta_included,
        'flare_type' => $request->flare_type,
        'neckline' => $request->neckline,
        'fit_type' => $fit_type ?? null,
        'tshirt_type' => $request->tshirt_type,
        'sleeve_style' => $sleeve_style,
        'collar_type' => $request->collar_type,
        'shirt_type' => $request->shirt_type,
        'dress_type' => $request->dress_type,
        'dress_length' => $request->dress_length,
        'top_style' => $request->top_style,
        'bottom_style' => $request->bottom_style,
        'jumpsuit_type' => $request->jumpsuit_type,
        'leg_style' => $request->leg_style,
        'shrug_type' => $request->shrug_type,
        'hoodie_type' => $request->hoodie_type,
        'hood_included' => $request->hood_included,
        'pocket_type' => $request->pocket_type,
        'jacket_type' => $request->jacket_type,
        'pocket_details' => $request->pocket_details,
        'blazer_type' => $request->blazer_type,
        'lapel_style' => $request->lapel_style,
        'playsuit_type' => $request->playsuit_type,
        'shacket_type' => $request->shacket_type,
        'waist_rise' => $waist_rise,
        'stretchability' => $request->stretchability,
        'distressed_non_distressed' => $request->distressed_non_distressed,
        'number_of_pockets' => $request->number_of_pockets,
        'waistband_type' => $waistband_type ?? null,
        'compression_level' => $request->compression_level,
        'pleated_non_pleated' => $request->pleated_non_pleated,
        'waist_type' => $request->waist_type,
        'cargo_type' => $request->cargo_type,
        
        
        
        'created_at' => now(),
        'updated_at' => now(),
        ];
        
        if ($first) {
        // Update the first row based on ID
        DB::table('products')->where('id', $id)->update($data);
        $first = false;
        } else {
        // Insert new rows for the rest of the data
        DB::table('products')->insert($data);
        }
        }
        
        // Redirect after processing all data
        return redirect('/product/sellerproduct')->with('success', 'Product Added successfully.');
        
        
        
        
        }
        
        
        
        
        
        
        
        
        
        
        public function store_new(Request $request)
        {
            
            // return $request->stock_quantity;
            // return $request->stock_quantity;
            // Fabric
            $fabric = !empty($request->fabric) ? $request->fabric : null;
            if (!$fabric) {
                for ($i = 1; $i <= 25; $i++) {
                    $key = 'fabric' . $i;
                    if (!empty($request->$key)) {
                        $fabric = $request->$key;
                        break;
                    }
                }
            }
            
            // Bottom Included
            $bottom_included = null;
            for ($i = 1; $i <= 2; $i++) {
                $key = 'bottom_included' . $i;
                if (!empty($request->$key)) {
                    $bottom_included = $request->$key;
                    break;
                }
            }
            
            // Set Type
            $set_type_keys = ['set_type_kurti', 'set_type_kurta', 'set_type_coord'];
            $set_type = null;
            foreach ($set_type_keys as $key) {
                if (!empty($request->$key)) {
                    $set_type = $request->$key;
                    break;
                }
            }
            
            // Sleeve Length
            $sleeve_length = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'sleeve_length_' . $i;
                if (!empty($request->$key)) {
                    $sleeve_length = $request->$key;
                    break;
                }
            }
            
            // Sleeve Pattern
            $sleeve_pattern = null;
            for ($i = 1; $i <= 4; $i++) {
                $key = 'sleeve_pattern_' . $i;
                if (!empty($request->$key)) {
                    $sleeve_pattern = $request->$key;
                    break;
                }
            }
            
            // Closure Type
            $closure_type = null;
            for ($i = 1; $i <= 7; $i++) {
                $key = 'closure_type_' . $i;
                if (!empty($request->$key)) {
                    $closure_type = $request->$key;
                    break;
                }
            }
            
            // Work Details
            $work_details = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'work_details_' . $i;
                if (!empty($request->$key)) {
                    $work_details = $request->$key;
                    break;
                }
            }
            
            // Border Type
            $border_type = null;
            for ($i = 1; $i <= 2; $i++) {
                $key = 'border_type_' . $i;
                if (!empty($request->$key)) {
                    $border_type = $request->$key;
                    break;
                }
            }
            
            // Bottom Type
            $bottom_type = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'bottom_type_' . $i;
                if (!empty($request->$key)) {
                    $bottom_type = $request->$key;
                    break;
                }
            }
            
            // Dupatta Length
            $dupatta_length = null;
            for ($i = 1; $i <= 3; $i++) {
                $key = 'dupatta_length_' . $i;
                if (!empty($request->$key)) {
                    $dupatta_length = $request->$key;
                    break;
                }
            }
            
            // Length
            $length = null;
            for ($i = 1; $i <= 6; $i++) {
                $key = 'length_' . $i;
                if (!empty($request->$key)) {
                    $length = $request->$key;
                    break;
                }
            }
            
            // Fit Type
            $fit_type = null;
            for ($i = 1; $i <= 26; $i++) {
                $key = 'fit_type_' . $i;
                if (!empty($request->$key)) {
                    $fit_type = $request->$key;
                    break;
                }
            }
            
            // Waistband Type
            $waistband_type = null;
            for ($i = 1; $i <= 4; $i++) {
                $key = 'waistband_type_' . $i;
                if (!empty($request->$key)) {
                    $waistband_type = $request->$key;
                    break;
                }
            }
            
            // Waist Rise
            $waist_rise = null;
            for ($i = 1; $i <= 2; $i++) {
                $key = 'waist_rise_' . $i;
                if (!empty($request->$key)) {
                    $waist_rise = $request->$key;
                    break;
                }
            }
            
            //Sleeve Style
            
            $sleeve_style = null;
            for($i = 1; $i <= 2; $i++){
                $key = 'sleeve_style_' . $i;
                if(!empty($request->$key)){
                    $sleeve_style = $request->$key;
                    break;
                }
            }
                    
        
        
        $seller_id_name = DB::table('sellers')->where('id', $request->seller_table_id)->latest()->first();
        
        $color_name =  DB::table('colors')
        ->where('color_name', $request->color_name)
        ->latest()
        ->first()
        ->hex_code;
        
        
        $id = $request->product_id;
        
        
        
        // return $id;
        
        // Retrieve the existing product
        $product = DB::table('products')->where('id', $id)->first();
        
        
        if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
        }
        
        
        
        // Generate parent_id if needed
        $pids = DB::table('products')
        ->whereNotNull('parent_id')
        ->where('seller_user_id', $seller_id_name->user_table_id)
        ->pluck('parent_id')
        ->toArray();
        
        if (!in_array($request->parent_id, $pids)) {
        $lastProduct = DB::table('products')
        ->where('seller_user_id', $seller_id_name->user_table_id)
        ->orderBy('id', 'desc')
        ->first();
        
        $nextNumber = $lastProduct ? ((int) str_replace('OBD-' . $seller_id_name->seller_id . '-' . $request->parent_id . '-', '', $lastProduct->product_id) + 1) : 1000;
        $parent_id = 'OBD-' . $seller_id_name->seller_id . '-' . $request->parent_id;
        } else {
        $parent_id = $request->parent_id;
        }
        
        
        
        
        
        $lastProduct1 = DB::table('products')
        ->where('seller_id', $seller_id_name->seller_id)
        ->where('product_id', 'LIKE', 'OBD-PR-' . $seller_id_name->seller_id . '-%')
        ->orderBy('id', 'desc')
        ->first();
        
        // Extract last number and increment
        if ($lastProduct1) {
        preg_match('/OBD-PR-' . $seller_id_name->seller_id . '-(\d+)/', $lastProduct1->product_id, $matches1);
        $nextNumber1 = isset($matches[1]) ? ((int) $matches1[1] + 1) : 1001;
        } else {
        $nextNumber1 = 1001;
        }
        
        // Generate unique product ID
        $product_id = 'OBD-PR-' . $seller_id_name->seller_id . '-' . $nextNumber1;
        
        
        
        
        
        $seller_user_id = DB::table('sellers')->where('user_table_id', $seller_id_name->user_table_id )->latest()->first();
        
        
        // return $request->stock_quantity;
        
        $array = json_decode($request->stock_quantity, true); // Convert JSON string to PHP array
        
        
        
        //Product ID
        
        $lastProduct = DB::table('products')
        ->where('seller_id', $seller_id_name->seller_id)
        ->where('product_id', 'LIKE', 'OBD-PR-' . $seller_id_name->seller_id . '-%')
        ->orderBy('id', 'desc')
        ->first();
        
        // Extract last number and increment
        if ($lastProduct) {
        preg_match('/OBD-PR-' . $seller_id_name->seller_id . '-(\d+)/', $lastProduct->product_id, $matches);
        $nextNumber = isset($matches[1]) ? ((int) $matches[1] + 1) : 1001;
        } else {
        $nextNumber = 1001;
        }
        
        // Generate unique product ID
        $product_id = 'OBD-PR-' . $seller_id_name->seller_id . '-' . $nextNumber;
        
        // return $product_id;
        $seller_id = $seller_id_name->seller_id;
        
        
        $imageUrls = [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // ❗ Check if file size is more than 200 KB (200 * 1024 = 204800 bytes)
                if ($file->getSize() <= 204800) {
                    // File is already small — just upload directly without compression
                    $folderPath = "products/{$seller_id}/{$product_id}";
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $folderPath . '/' . $fileName;
        
                    // Upload original image
                    Storage::disk('r2')->put($filePath, file_get_contents($file->getPathname()), 'public');
        
                    $url = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                    $imageUrls[] = $url;
        
                    continue;
                }
        
                // Else: Proceed with compression for files > 200 KB
                $folderPath = "products/{$seller_id}/{$product_id}";
                $fileName = time() . '_' . $file->getClientOriginalName();
        
                // Detect MIME type reliably
                $imageInfo = getimagesize($file->getPathname());
                $mime = $imageInfo['mime'] ?? null;
        
                // Load image based on MIME type
                switch ($mime) {
                    case 'image/jpeg':
                        $sourceImage = imagecreatefromjpeg($file->getPathname());
                        break;
                    case 'image/png':
                        $sourceImage = imagecreatefrompng($file->getPathname());
                        break;
                    default:
                        continue; // unsupported format, skip file
                }
        
                if (!$sourceImage) {
                    continue;
                }
        
                // Resize image to 412 x 559
                $targetWidth = 412;
                $targetHeight = 559;
                $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
        
                // Maintain transparency for PNGs
                if ($mime === 'image/png') {
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                }
        
                // Resize with resampling
                imagecopyresampled(
                    $resizedImage, $sourceImage,
                    0, 0, 0, 0,
                    $targetWidth, $targetHeight,
                    imagesx($sourceImage), imagesy($sourceImage)
                );
        
                // Compress to JPEG with 70% quality
                ob_start();
                imagejpeg($resizedImage, null, 70);
                $imageData = ob_get_clean();
        
                // Upload to R2
                $filePath = $folderPath . '/' . $fileName;
                Storage::disk('r2')->put($filePath, $imageData, 'public');
        
                // Public URL
                $url = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                $imageUrls[] = $url;
        
                // Cleanup
                imagedestroy($sourceImage);
                imagedestroy($resizedImage);
            }
        }
                
        
        // return $array;
        if ($array === null) {
        $elementCount = 0;
        } else {
        $elementCount = count($array);
        }
        

        // return ($request->stock_quantity);
        
        $first = true;
        
        foreach (json_decode($request->stock_quantity) as $stck) {
        

        $bankSettlementPrice = $stck->bank_settlement_price;
        $shippingMode = $seller_id_name->shipping_mode;
        $bankprice = 0;
        
        if ($shippingMode == "In-Store") {
        
            if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) 
            {
                $shipping = 131;
                $bankprice = round($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice) + (0.03 * ($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice))));
            } 
            elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) 
            {
                $shipping = 180;
                $basePrice = $bankSettlementPrice + $shipping;
                $tenPercent = 0.1 * $basePrice;
                $threePercent = 0.03 * ($basePrice + $tenPercent);
                $bankprice = round($basePrice + $tenPercent + $threePercent);
            } 
            elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) 
            {
                $shipping = 200;
                $basePrice = $bankSettlementPrice + $shipping;
                $fifteenPercent = 0.15 * $basePrice;
                $threePercent = 0.03 * ($basePrice + $fifteenPercent);
                $bankprice = round($basePrice + $fifteenPercent + $threePercent);
            } 
            elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) 
            {
                $shipping = 220;
                $basePrice = $bankSettlementPrice + $shipping;
                $eighteenPercent = 0.18 * $basePrice;
                $additionalCharge = 0.03 * ($basePrice + $eighteenPercent);
                $bankprice = round($basePrice + $eighteenPercent + $additionalCharge);
            } 
            elseif ($bankSettlementPrice >= 2500) 
            {
                $shipping = 240;
                $basePrice = $bankSettlementPrice + $shipping;
                $twentyPercent = 0.2 * $basePrice;
                $threePercent = 0.03 * ($basePrice + $twentyPercent);
                $bankprice = round($basePrice + $twentyPercent + $threePercent);
            }
        }
        
        elseif ($shippingMode == "Warehouse") 
        {
        
            $gurantee = 35;
            $inward = 9;
            
            if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) 
            {
                $shipping = 131;
                $bankprice = round($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice) + (0.03 * ($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice))));
            } 
            elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) 
            {
                $shipping = 180;
                $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                $tenPercent = 0.1 * ($bankSettlementPrice + $shipping);
                $threePercent = 0.03 * ($basePrice + $tenPercent);
                $bankprice = round($basePrice + $tenPercent + $threePercent);
            } 
            elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) 
            {
                $shipping = 200;
                $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                $fifteenPercent = 0.15 * ($bankSettlementPrice + $shipping);
                $threePercent = 0.03 * ($basePrice + $fifteenPercent);
                $bankprice = round($basePrice + $fifteenPercent + $threePercent);
            } 
            elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) 
            {
                $shipping = 220;
                $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                $eighteenPercent = 0.18 * ($bankSettlementPrice + $shipping);
                $additionalCharge = 0.03 * ($basePrice + $eighteenPercent);
                $bankprice = round($basePrice + $eighteenPercent + $additionalCharge);
            } 
            elseif ($bankSettlementPrice >= 2500) 
            {
                $shipping = 240;
                $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                $twentyPercent = 0.2 * ($bankSettlementPrice + $shipping);
                $threePercent = 0.03 * ($basePrice + $twentyPercent);
                $bankprice = round($basePrice + $twentyPercent + $threePercent);
            }
        }
        
        
        
        $data = [
        'category_id' => $request->input('category_id'),
        'subcategory_id' => $request->input('subcategory_id'),
        'sub_subcategory_id' => $request->input('sub_subcategory_id'),
        'product_name' => $request->input('product_name'),
        'product_id' => $product_id, // Auto-generated
        'seller_user_id' => $seller_id_name->user_table_id,
        'seller_id' => $seller_id_name->seller_id,
        'parent_id' => $parent_id,
        'brand_id' => $request->input('brand_id'),
        'description' => $request->input('description'),
        'size_name' => $stck->size,
        'stock_quantity' => $stck->quantity,
        'color_name' => $color_name,
        'fabric' => $fabric,
        'occasion' => $request->input('occasion'),
        'care_instructions' => $request->input('care_instructions'),
        'video_url' => $request->input('video_url'),
        'shipping_time' => $request->input('shipping_time'),
        'return_policy' => $request->input('return_policy'),
        'sku' => $stck->sku,
        'hsn' => $request->input('hsn'),
        'gst_rate' => $request->input('gst_rate'),
        'procurement_type' => $request->input('procurement_type'),
        'package_weight' => $request->input('package_weight'),
        'package_length' => $request->input('package_length'),
        'package_breadth' => $request->input('package_breadth'),
        'package_height' => $request->input('package_height'),
        'pack_of' => $request->input('pack_of'),
        'country_of_origin' => $request->input('country_of_origin'),
        'manufacturer_details' => $request->input('manufacturer_details'),
        'packer_details' => $request->input('packer_details'),
        'size_chart_id' => $request->input('size_chart_id'),
        'listing_status' => $request->input('listing_status'),
        'maximum_retail_price' => $stck->maximum_retail_price,
        'bank_settlement_price' => $stck->bank_settlement_price,
        'portal_updated_price' => $bankprice,
        'alt_text' => $request->input('alt_text'),
        'pattern' => $request->input('pattern'),
        
        'added_by' => Auth::id(),
        'images' => json_encode($imageUrls),
        'sole_material' => $request->input('sole_material'),
        'upper_material' => $request->input('upper_material'),
        
        'toe_shape' => $request->input('toe_shape'),
        'heel_type' => $request->input('heel_type'),
        
        'pstatus' => $request->pstatus,
        'saree_length' => $request->saree_length,
        'blouse_fabric' => $request->blouse_fabric,
        'blouse_piece_included' => $request->blouse_piece_included,
        'blouse_length' => $request->blouse_length,
        'blouse_stiched' => $request->blouse_stiched,
        'work_details' => $work_details ?? null,
        'border_type' => $border_type ?? null,
        'weave_type' => $request->weave_type,
        'pattern' => $request->pattern,
        'gown_type' => $request->gown_type,
        'sleeve_length' => $sleeve_length ?? null,
        'sleeve_pattern' => $sleeve_pattern ?? null,
        'neck_style' => $request->neck_style,
        'closure_type' => $closure_type ?? null,
        'embellishment_details' => $request->embellishment_details,
        'lining_present' => $request->lining_present,
        'top_type' => $request->top_type,
        'hemline' => $request->hemline,
        'transparency_level' => $request->transparency_level,
        'set_type' => $set_type ?? null,
        'bottom_included' => $bottom_included,
        'bottom_type' => $bottom_type ?? null,
        'dupatta_fabric' => $request->dupatta_fabric,
        'dupatta_length' => $dupatta_length ?? null,
        'dupatta_shawl_type' => $request->dupatta_shawl_type,
        'length' => $length ?? null,
        'lehenga_type' => $request->lehenga_type,
        'lehenga_length' => $request->lehenga_length,
        'choli_included' => $request->choli_included,
        'choli_length' => $request->choli_length,
        'choli_sleeve_length' => $request->choli_sleeve_length,
        'dupatta_included' => $request->dupatta_included,
        'flare_type' => $request->flare_type,
        'neckline' => $request->neckline,
        'fit_type' => $fit_type ?? null,
        'tshirt_type' => $request->tshirt_type,
        'sleeve_style' => $sleeve_style,
        'collar_type' => $request->collar_type,
        'shirt_type' => $request->shirt_type,
        'dress_type' => $request->dress_type,
        'dress_length' => $request->dress_length,
        'top_style' => $request->top_style,
        'bottom_style' => $request->bottom_style,
        'jumpsuit_type' => $request->jumpsuit_type,
        'leg_style' => $request->leg_style,
        'shrug_type' => $request->shrug_type,
        'hoodie_type' => $request->hoodie_type,
        'hood_included' => $request->hood_included,
        'pocket_type' => $request->pocket_type,
        'jacket_type' => $request->jacket_type,
        'pocket_details' => $request->pocket_details,
        'blazer_type' => $request->blazer_type,
        'lapel_style' => $request->lapel_style,
        'playsuit_type' => $request->playsuit_type,
        'shacket_type' => $request->shacket_type,
        'waist_rise' => $waist_rise,
        'stretchability' => $request->stretchability,
        'distressed_non_distressed' => $request->distressed_non_distressed,
        'number_of_pockets' => $request->number_of_pockets,
        'waistband_type' => $waistband_type ?? null,
        'compression_level' => $request->compression_level,
        'pleated_non_pleated' => $request->pleated_non_pleated,
        'waist_type' => $request->waist_type,
        'cargo_type' => $request->cargo_type,
        
        'bust_size' => blank($stck->bust_size) ? null : $stck->bust_size,
        'hip_size' => blank($stck->hip_size) ? null : $stck->hip_size,
        'weist_size' => blank($stck->weist_size) ? null : $stck->weist_size,
        'shoulder_size' => blank($stck->shoulder_size) ? null : $stck->shoulder_size,
        'product_length' => blank($stck->product_length) ? null : $stck->product_length,


        
        
        'created_at' => now(),
        'updated_at' => now(),
        ];
        
        if ($first) {
        // Update the first row based on ID
        DB::table('products')->where('id', $id)->update($data);
        $first = false;
        } else {
        // Insert new rows for the rest of the data
        DB::table('products')->insert($data);
        }
        }
        
        // Redirect after processing all data
        return redirect('/product/sellerproduct')->with('success', 'Product Added successfully.');
        
        
        
        
        }

        
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
    
    //   $seller_id = DB::table('sellers')->where('user_table_id', Auth::user()->id)->latest()->first();
    
        $seller_id = $product;
           
        $seller_data = DB::table('sellers')->where('seller_id',$seller_id->seller_id)->latest()->first();
        $shipping_mode = $seller_data->shipping_mode;
        $parentid = DB::table('products')->where('seller_id', $seller_id->seller_id)->whereNotNull('parent_id')->latest()->get();
        
        $brand_cnt = DB::table('brands')->where('seller_id',$seller_id->seller_id)->count();
        
        $attr = DB::table('attributes')->latest()->get();
        
        $cat_id = $product->category_id; 
        $subcat_id = $product->subcategory_id; 
        $subsubcat_id = $product->sub_subcategory_id; 
         
        $a = DB::table('categories')->where('id', $product->category_id )->select('category')->latest()->first();
        $b = DB::table('categories')->where('id', $product->subcategory_id )->select('subcategory')->latest()->first();
        $c = DB::table('categories')->where('id', $product->sub_subcategory_id )->select('sub_subcategory')->latest()->first();
        
        $cat = $a->category;
        $subcat = $b->subcategory;
        
        if($c == Null)
        {
            $subsubcat = 'NA';
        }
        else
        {
            $subsubcat = $c->sub_subcategory;
        }
        
        
        $obtained = DB::table('products')->where('color_name',$product->color_name)->where('parent_id',$product->parent_id)->pluck('size_name')->toArray();
        
        if($b->subcategory == 'Lingerie & Sleepwear')
        {
            $size = DB::table('sizes')->where('id',5)->latest()->get();
        }
        else if($a->category == 'Kids')
        {
            $size = DB::table('sizes')->where('id',2)->latest()->get();
        }
        else if($b->subcategory == 'Bottom Wear')
        {
            $size = DB::table('sizes')->where('id',3)->latest()->get();
        }
        else if($b->subcategory == 'Footwear')
        {
            $size = DB::table('sizes')->where('id',4)->latest()->get();
        }
        else if($b->subcategory == 'Innerwear')
        {
            $size = DB::table('sizes')->where('id',6)->latest()->get();
        }
        else
        {
            $size = DB::table('sizes')->where('id',1)->latest()->get();
        }
        
        $colors = DB::table('colors')->where('level','1')->get(); // Fetch all colors from the database
        
          // Find the color name by matching the hex_code
        $colorInfo = DB::table('colors')->where('hex_code', $product->color_name)->first();
        
        // Prepare variables for the view
        $currentColorName = $colorInfo ? $colorInfo->color_name : '--Select a Color--';
        $currentColorHex = $product->color_name; 
        
        
      
        //  $alldat = DB::table('products')->where('product_id',$product->product_id)->whereNotNull('size_name')->distinct('size')->get();
         
         $alldat = DB::table('products')
                        ->where('product_id', $product->product_id)
                        ->whereNotNull('size_name')
                        ->distinct('size')
                        ->get();
                        
    
         $multidata = [];
         
         foreach($alldat as $dat)
         {
             $multi['id'] = $dat->id;
             $multi['size'] = $dat->size_name;
             $multi['sku'] = $dat->sku;
             $multi['quantity'] = $dat->stock_quantity;
             $multi['mrp'] = $dat->maximum_retail_price;
             $multi['bsp'] = $dat->bank_settlement_price;
             $multi['portal_updated_price'] = $dat->portal_updated_price;
             
             $multi['bust_size'] = $dat->bust_size;
             $multi['hip_size'] = $dat->hip_size;
             $multi['weist_size'] = $dat->weist_size;
             $multi['shoulder_size'] = $dat->shoulder_size;
             $multi['product_length'] = $dat->product_length;
    
             
             $multidata[] = $multi;
         }
         
        //  return $multidata;
         return view('product.edit_new', compact('product', 'currentColorName', 'currentColorHex','shipping_mode','multidata', 'seller_id', 'attr', 'parentid','brand_cnt', 'cat', 'subcat', 'subsubcat', 'cat_id', 'subcat_id', 'subsubcat_id','colors','size'));

        
    
    }
    
    
    
    
    
    
    
    public function update(Request $request, $id)
    {
        
            // bottom_included
        if(!empty($request->fabric1)) {
            $fabric = $request->fabric1;
        } elseif(!empty($request->fabric2)) {
            $fabric = $request->fabric2;
        } elseif(!empty($request->fabric3)) {
            $fabric = $request->fabric3;
        } elseif(!empty($request->fabric4)) {
            $fabric = $request->fabric4;
        } elseif(!empty($request->fabric5)) {
            $fabric = $request->fabric5;
        } elseif(!empty($request->fabric6)) {
            $fabric = $request->fabric6;
        } elseif(!empty($request->fabric7)) {
            $fabric = $request->fabric7;
        } elseif(!empty($request->fabric8)) {
            $fabric = $request->fabric8;
        } elseif(!empty($request->fabric9)) {
            $fabric = $request->fabric9;
        } elseif(!empty($request->fabric10)) {
            $fabric = $request->fabric10;
        } elseif(!empty($request->fabric11)) {
            $fabric = $request->fabric11;
        } elseif(!empty($request->fabric12)) {
            $fabric = $request->fabric12;
        } elseif(!empty($request->fabric13)) {
            $fabric = $request->fabric13;
        } elseif(!empty($request->fabric14)) {
            $fabric = $request->fabric14;
        } elseif(!empty($request->fabric15)) {
            $fabric = $request->fabric15;
        } elseif(!empty($request->fabric16)) {
            $fabric = $request->fabric16;
        } elseif(!empty($request->fabric17)) {
            $fabric = $request->fabric17;
        } elseif(!empty($request->fabric18)) {
            $fabric = $request->fabric18;
        } elseif(!empty($request->fabric19)) {
            $fabric = $request->fabric19;
        } elseif(!empty($request->fabric20)) {
            $fabric = $request->fabric20;
        } elseif(!empty($request->fabric21)) {
            $fabric = $request->fabric21;
        } elseif(!empty($request->fabric22)) {
            $fabric = $request->fabric22;
        } elseif(!empty($request->fabric23)) {
            $fabric = $request->fabric23;
        } elseif(!empty($request->fabric24)) {
            $fabric = $request->fabric24;
        } elseif(!empty($request->fabric25)) {
            $fabric = $request->fabric25;
        }
                    
        // return $fabric;
            if(!empty($request->bottom_included1))
            {
                $bottom_included = $request->bottom_included1;
            }
            
            elseif(!empty($request->bottom_included2))
            {
                $bottom_included = $request->bottom_included2;
            }
            else 
            {
                $bottom_included = null; // or any default value like 'N/A', 'None', etc.
            }
        
            if (!empty($request->set_type)) {
                $set_type = $request->set_type;
            }
            elseif (!empty($request->set_type_kurti)) {
                $set_type = $request->set_type_kurti;
            } elseif (!empty($request->set_type_kurta)) {
                $set_type = $request->set_type_kurta;
            } elseif (!empty($request->set_type_coord)) {
                $set_type = $request->set_type_coord;
            } else 
            {
                $set_type = null; // or any default value like 'N/A', 'None', etc.
            }

            // Sleeve Length
            
            if(!empty($request->sleeve_length_1))
            {
                $sleeve_length = $request->sleeve_length_1;
            }
            
            elseif(!empty($request->sleeve_length_2))
            {
                $sleeve_length = $request->sleeve_length_2;
            }
            
            elseif(!empty($request->sleeve_length_3))
            {
                $sleeve_length = $request->sleeve_length_3;
            }
            else 
            {
                $sleeve_length = null; // or any default value like 'N/A', 'None', etc.
            }
            
            
            // Sleeve pattern
            
            if(!empty($request->sleeve_pattern_1))
            {
                $sleeve_pattern = $request->sleeve_pattern_1;
            }
            elseif(!empty($request->sleeve_pattern_2))
            {
                $sleeve_pattern = $request->sleeve_pattern_2;
            }
            elseif(!empty($request->sleeve_pattern_3))
            {
                $sleeve_pattern = $request->sleeve_pattern_3;
            }
            elseif(!empty($request->sleeve_pattern_4))
            {
                $sleeve_pattern = $request->sleeve_pattern_4;
            }
            else 
            {
                $sleeve_pattern = null; // or any default value like 'N/A', 'None', etc.
            }
            
            
            // Closure Type 
            
            if(!empty($request->closure_type_1))
            {
                $closure_type = $request->closure_type_1;
            }
            elseif(!empty($request->closure_type_2))
            {
                $closure_type = $request->closure_type_2;
            }
            elseif(!empty($request->closure_type_3))
            {
                $closure_type = $request->closure_type_3;
            }
            elseif(!empty($request->closure_type_4))
            {
                $closure_type = $request->closure_type_4;
            }
            elseif(!empty($request->closure_type_5))
            {
                $closure_type = $request->closure_type_5;
            }
            elseif(!empty($request->closure_type_6))
            {
                $closure_type = $request->closure_type_6;
            }
            elseif(!empty($request->closure_type_7))
            {
                $closure_type = $request->closure_type_7;
            }
            else 
            {
                $closure_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Work Details
            
            if(!empty($request->work_details_1))
            {
                $work_details = $request->work_details_1;
            }
            elseif(!empty($request->work_details_2))
            {
                $work_details = $request->work_details_2;
            }
            elseif(!empty($request->work_details_3))
            {
                $work_details = $request->work_details_3;
            }
            else 
            {
                $work_details = null; // or any default value like 'N/A', 'None', etc.
            }
            
            
            // Border Type
            
            if(!empty($request->border_type_1))
            {
                $border_type = $request->border_type_1;
            }
            elseif(!empty($request->border_type_2))
            {
                $border_type = $request->border_type_2;
            }
            else 
            {
                $border_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Bottom Type
            
            if(!empty($request->bottom_type_1))
            {
                $bottom_type = $request->bottom_type_1;
            }
            elseif(!empty($request->bottom_type_2))
            {
                $bottom_type = $request->bottom_type_2;
            }
            elseif(!empty($request->bottom_type_3))
            {
                $bottom_type = $request->bottom_type_3;
            }
            else 
            {
                $bottom_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Dupatta Length
            
             if(!empty($request->dupatta_length_1))
            {
                $dupatta_length = $request->dupatta_length_1;
            }
            elseif(!empty($request->dupatta_length_2))
            {
                $dupatta_length = $request->dupatta_length_2;
            }
            elseif(!empty($request->dupatta_length_3))
            {
                $dupatta_length = $request->dupatta_length_3;
            }
            else 
            {
                $dupatta_length = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Length 
            
            
            if(!empty($request->length_1))
            {
                $length = $request->length_1;
            }
            elseif(!empty($request->length_2))
            {
                $length = $request->length_2;
            }
            elseif(!empty($request->length_3))
            {
                $length = $request->length_3;
            }
            elseif(!empty($request->length_4))
            {
                $length = $request->length_4;
            }
            elseif(!empty($request->length_5))
            {
                $length = $request->length_5;
            }
            elseif(!empty($request->length_6))
            {
                $length = $request->length_6;
            }
            else 
            {
                $length = null; // or any default value like 'N/A', 'None', etc.
            }
            // Fit Type
            
            if (!empty($request->fit_type_1)) {
                $fit_type = $request->fit_type_1;
            } elseif (!empty($request->fit_type_2)) {
                $fit_type = $request->fit_type_2;
            } elseif (!empty($request->fit_type_3)) {
                $fit_type = $request->fit_type_3;
            } elseif (!empty($request->fit_type_4)) {
                $fit_type = $request->fit_type_4;
            } elseif (!empty($request->fit_type_5)) {
                $fit_type = $request->fit_type_5;
            } elseif (!empty($request->fit_type_6)) {
                $fit_type = $request->fit_type_6;
            } elseif (!empty($request->fit_type_7)) {
                $fit_type = $request->fit_type_7;
            } elseif (!empty($request->fit_type_8)) {
                $fit_type = $request->fit_type_8;
            } elseif (!empty($request->fit_type_9)) {
                $fit_type = $request->fit_type_9;
            } elseif (!empty($request->fit_type_10)) {
                $fit_type = $request->fit_type_10;
            } elseif (!empty($request->fit_type_11)) {
                $fit_type = $request->fit_type_11;
            } elseif (!empty($request->fit_type_12)) {
                $fit_type = $request->fit_type_12;
            } elseif (!empty($request->fit_type_13)) {
                $fit_type = $request->fit_type_13;
            } elseif (!empty($request->fit_type_14)) {
                $fit_type = $request->fit_type_14;
            } elseif (!empty($request->fit_type_15)) {
                $fit_type = $request->fit_type_15;
            } elseif (!empty($request->fit_type_16)) {
                $fit_type = $request->fit_type_16;
            } elseif (!empty($request->fit_type_17)) {
                $fit_type = $request->fit_type_17;
            } elseif (!empty($request->fit_type_18)) {
                $fit_type = $request->fit_type_18;
            } elseif (!empty($request->fit_type_19)) {
                $fit_type = $request->fit_type_19;
            } elseif (!empty($request->fit_type_20)) {
                $fit_type = $request->fit_type_20;
            } elseif (!empty($request->fit_type_21)) {
                $fit_type = $request->fit_type_21;
            } elseif (!empty($request->fit_type_22)) {
                $fit_type = $request->fit_type_22;
            } elseif (!empty($request->fit_type_23)) {
                $fit_type = $request->fit_type_23;
            } elseif (!empty($request->fit_type_24)) {
                $fit_type = $request->fit_type_24;
            } elseif (!empty($request->fit_type_25)) {
                $fit_type = $request->fit_type_25;
            } elseif (!empty($request->fit_type_26)) {
                $fit_type = $request->fit_type_26;
            }
            else 
            {
                $fit_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // return $fit_type;
            // Waistband Type
            
            if (!empty($request->waistband_type_1)) 
            {
                $waistband_type = $request->waistband_type_1;
            }
            elseif (!empty($request->waistband_type_2)) 
            {
                $waistband_type = $request->waistband_type_2;
            }
            elseif (!empty($request->waistband_type_3)) 
            {
                $waistband_type = $request->waistband_type_3;
            }
            elseif (!empty($request->waistband_type_4)) 
            {
                $waistband_type = $request->waistband_type_4;
            }
            else 
            {
                $waistband_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
              
            // waist_rise
            
            if (!empty($request->waist_rise_1)) 
            {
                $waist_rise = $request->waist_rise_1;
            }
            elseif (!empty($request->waist_rise_2)) 
            {
                $waist_rise = $request->waist_rise_2;
            }
            else{
                $waist_rise = null;
            }
            
                        
            //Sleeve Style
            
            $sleeve_style = null;
            for($i = 1; $i <= 2; $i++){
                $key = 'sleeve_style_' . $i;
                if(!empty($request->$key)){
                    $sleeve_style = $request->$key;
                    break;
                }
            }
        
        
        
        // Get color name/hex code
        $color_name = Str::contains($request->color_name, '#') 
            ? $request->color_name 
            : DB::table('colors')->where('color_name', $request->color_name)->latest()->first()->hex_code;
    
        // Retrieve existing product
        $product = DB::table('products')->where('id', $id)->first();
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
    
        // Handle image processing
        // $existingImages = json_decode($product->images, true) ?? [];
        // $seller_id = $request->input('seller_id');
        
        // $product_id = $request->product_id;
        
        // // Step 1: Remove images from existing if user clicked "×"
        // if ($request->filled('removed_images')) {
        // $removedImages = explode(',', $request->input('removed_images'));

        //     foreach ($removedImages as $removedImageUrl) {
        //         // Remove from S3 (extract path from URL)
        //         $path = parse_url($removedImageUrl, PHP_URL_PATH);
        //         $path = ltrim($path, '/'); // remove leading slash if any
        
        //         if (Storage::disk('s3')->exists($path)) {
        //             Storage::disk('s3')->delete($path);
        //         }
        
        //         // Remove from the local array
        //         $existingImages = array_filter($existingImages, function ($img) use ($removedImageUrl) {
        //             return $img !== $removedImageUrl;
        //         });
        //     }
        
        //     $existingImages = array_values($existingImages); // reindex array
        // }

        // $existingImages = json_decode($product->images, true) ?? [];
        // $seller_id = $request->input('seller_id');
        
        // $product_id = $request->product_id;
        
        // // Handle removed images (always do this)
        // if ($request->filled('removed_images')) {
        //     $removedImages = explode(',', $request->input('removed_images'));
        
        //     foreach ($removedImages as $removedImageUrl) {
        //         // Delete from S3
        //         $path = parse_url($removedImageUrl, PHP_URL_PATH);
        //         $path = ltrim($path, '/');
        //         if (Storage::disk('s3')->exists($path)) {
        //             Storage::disk('s3')->delete($path);
        //         }
        
        //         // Remove from array
        //         $existingImages = array_filter($existingImages, function ($img) use ($removedImageUrl) {
        //             return $img !== $removedImageUrl;
        //         });
        //     }
        
        //     $existingImages = array_values($existingImages); // Reindex
        // }
        
        
        
        
        
        // // Handle newly uploaded files (optional step)
        // if ($request->hasFile('images')) {
        //     $folderPath = "products/{$seller_id}/{$product_id}";
        
        //     if (!Storage::disk('s3')->exists($folderPath)) {
        //         Storage::disk('s3')->makeDirectory($folderPath);
        //     }
        
        //     $newImageUrls = [];
        //     foreach ($request->file('images') as $image) {
        //         $fileName = time() . '_' . $image->getClientOriginalName();
        //         $filePath = $image->storeAs($folderPath, $fileName, 's3');
        //         $newImageUrls[] = Storage::disk('s3')->url($filePath);
        //     }
        
        //     $existingImages = array_merge($existingImages, $newImageUrls);
        // }
        
        
        
        $existingImages1 = json_decode($product->images, true) ?? [];
        $removedImages = explode(',', $request->input('removed_images') ?? '');
        
        $existingImages = array_values(array_diff($existingImages1, $removedImages));
        $seller_id = $request->input('seller_id');
        $product_id = $request->product_id;
        
        if ($request->hasFile('images')) {
            $newImageUrls = [];
        
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $folderPath = "products/{$seller_id}/{$product_id}";
                $filePath = $folderPath . '/' . $originalName;
        
                // Detect MIME
                $imageInfo = getimagesize($image->getPathname());
                $mime = $imageInfo['mime'] ?? null;
        
                // Load image
                switch ($mime) {
                    case 'image/jpeg':
                        $sourceImage = imagecreatefromjpeg($image->getPathname());
                        break;
                    case 'image/png':
                        $sourceImage = imagecreatefrompng($image->getPathname());
                        break;
                    default:
                        continue 2; // skip this image
                }
        
                if (!$sourceImage) {
                    continue;
                }
        
                // Resize to 412x559
                $targetWidth = 412;
                $targetHeight = 559;
                $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
        
                // Maintain transparency for PNG
                if ($mime === 'image/png') {
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                    $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
                    imagefilledrectangle($resizedImage, 0, 0, $targetWidth, $targetHeight, $transparent);
                }
        
                imagecopyresampled(
                    $resizedImage, $sourceImage,
                    0, 0, 0, 0,
                    $targetWidth, $targetHeight,
                    imagesx($sourceImage), imagesy($sourceImage)
                );
        
                // Convert and compress to JPEG (70%)
                ob_start();
                imagejpeg($resizedImage, null, 70);
                $imageData = ob_get_clean();
        
                // Save to R2
                Storage::disk('r2')->put($filePath, $imageData, 'public');
        
                // Create public URL
                $publicUrl = "https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/{$filePath}";
                $newImageUrls[] = $publicUrl;
        
                // Cleanup
                imagedestroy($sourceImage);
                imagedestroy($resizedImage);
            }
        
            // Merge filtered old + new
            $existingImages = array_merge($existingImages, $newImageUrls);
        }
                
        
    
        // Get parent_id
        $parent_id = $request->parent_id;
        
        // Process stock quantity
        $stockData = json_decode($request->stock_quantity, true);
        $elementCount = is_array($stockData) ? count($stockData) : 0;
        
        // Get seller info for pricing calculations
        $seller_id_name = DB::table('sellers')->where('seller_id', $seller_id)->latest()->first();
        
        // Handle brand
        $brand_cnt = DB::table('brands')->where('seller_id', $seller_id)->count();
        $brand = $brand_cnt > 0 
            ? DB::table('brands')->where('brand_name', $request->input('brand_id'))->latest()->first() 
            : null;
        $bname = $brand ? $request->brand_id : 0;
        
        // Base product data array for all scenarios
        $baseData = [
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'sub_subcategory_id' => $request->input('sub_subcategory_id'),
            'product_name' => $request->input('product_name'),
            
             'brand_id' => $request->input('brand_id'),

            'parent_id' => $parent_id,
            'product_id' => $request->product_id,
            'seller_user_id' => Auth::id(),
            'description' => $request->input('description'),
            'color_name' => $color_name,
            'fabric' => $fabric,
            'occasion' => $request->input('occasion'),
            'care_instructions' => $request->input('care_instructions'),
            'video_url' => $request->input('video_url'),
            'seller_id' => $seller_id,
            'shipping_time' => $request->input('shipping_time'),
            'return_policy' => $request->input('return_policy'),
            'hsn' => $request->input('hsn'),
            'gst_rate' => $request->input('gst_rate'),
            'procurement_type' => $request->input('procurement_type'),
            'package_weight' => $request->input('package_weight'),
            'package_length' => $request->input('package_length'),
            'package_breadth' => $request->input('package_breadth'),
            'package_height' => $request->input('package_height'),
            'pack_of' => $request->input('pack_of'),
            'country_of_origin' => $request->input('country_of_origin'),
            'manufacturer_details' => $request->input('manufacturer_details'),
            'packer_details' => $request->input('packer_details'),
            'size_chart_id' => $request->input('size_chart_id'),
            'listing_status' => $request->input('listing_status'),
            'alt_text' => $request->input('alt_text'),
            'pattern' => $request->input('pattern'),
            'added_by' => Auth::id(),
            'updated_at' => now(),
            'images' => json_encode($existingImages),
            'tryout_eligibility' => $request->input('tryout_eligibility', 'YES'),
            'sole_material' => $request->input('sole_material'),
            'upper_material' => $request->input('upper_material'),
            'toe_shape' => $request->input('toe_shape'),
            'heel_type' => $request->input('heel_type'),
            
            // Apparel specific fields
            'saree_length' => $request->saree_length,
            'blouse_fabric' => $request->blouse_fabric,
            'blouse_piece_included' => $request->blouse_piece_included,
            'blouse_length' => $request->blouse_length,
            'blouse_stiched' => $request->blouse_stiched,
            'work_details' => $work_details,
            'border_type' => $border_type,
            'weave_type' => $request->weave_type,
            'gown_type' => $request->gown_type,
            'sleeve_length' => $sleeve_length,
            'sleeve_pattern' => $sleeve_pattern,
            'neck_style' => $request->neck_style,
            'closure_type' => $closure_type,
            'embellishment_details' => $request->embellishment_details,
            'lining_present' => $request->lining_present,
            'top_type' => $request->top_type,
            'hemline' => $request->hemline,
            'transparency_level' => $request->transparency_level,
            'set_type' => $set_type,
            'bottom_included' => $bottom_included,
            'bottom_type' => $bottom_type,
            'dupatta_fabric' => $request->dupatta_fabric,
            'dupatta_length' => $dupatta_length,
            'dupatta_shawl_type' => $request->dupatta_shawl_type,
            'length' => $length,
            'lehenga_type' => $request->lehenga_type,
            'lehenga_length' => $request->lehenga_length,
            'choli_included' => $request->choli_included,
            'choli_length' => $request->choli_length,
            'choli_sleeve_length' => $request->choli_sleeve_length,
            'dupatta_included' => $request->dupatta_included,
            'flare_type' => $request->flare_type,
            'neckline' => $request->neckline,
            'fit_type' => $fit_type,
            'tshirt_type' => $request->tshirt_type,
            'sleeve_style' => $sleeve_style,
            'collar_type' => $request->collar_type,
            'shirt_type' => $request->shirt_type,
            'dress_type' => $request->dress_type,
            'dress_length' => $request->dress_length,
            'top_style' => $request->top_style,
            'bottom_style' => $request->bottom_style,
            'jumpsuit_type' => $request->jumpsuit_type,
            'leg_style' => $request->leg_style,
            'shrug_type' => $request->shrug_type,
            'hoodie_type' => $request->hoodie_type,
            'hood_included' => $request->hood_included,
            'pocket_type' => $request->pocket_type,
            'jacket_type' => $request->jacket_type,
            'pocket_details' => $request->pocket_details,
            'blazer_type' => $request->blazer_type,
            'lapel_style' => $request->lapel_style,
            'playsuit_type' => $request->playsuit_type,
            'shacket_type' => $request->shacket_type,
            'waist_rise' => $waist_rise,
            'stretchability' => $request->stretchability,
            'distressed_non_distressed' => $request->distressed_non_distressed,
            'number_of_pockets' => $request->number_of_pockets,
            'waistband_type' => $waistband_type,
            'compression_level' => $request->compression_level,
            'pleated_non_pleated' => $request->pleated_non_pleated,
            'waist_type' => $request->waist_type,
            'cargo_type' => $request->cargo_type,
            
            
            
            'bust_size' =>  $request->bust_size,
            'hip_size' => $request->hip_size,
            'weist_size' => $request->weist_size,
            'shoulder_size' => $request->shoulder_size,
            'product_length' => $request->product_length,
        ];
        
        // Add brand if exists
        if ($bname != 0) {
            $baseData['brand_id'] = $bname;
        }
        
        // Helper function to calculate bankprice based on bankSettlementPrice and shippingMode
        $calculateBankPrice = function($bankSettlementPrice, $shippingMode) {
            $bankprice = 0;
            $gurantee = 35;
            $inward = 9;
            
            // Determine shipping cost based on price range
            if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) {
                $shipping = 131;
            } elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) {
                $shipping = 180;
            } elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) {
                $shipping = 200;
            } elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) {
                $shipping = 220;
            } elseif ($bankSettlementPrice >= 2500) {
                $shipping = 240;
            }
            
            // Apply pricing formula based on shipping mode
            if ($shippingMode == "In-Store") {
                if ($bankSettlementPrice <= 400) {
                    $bankprice = round($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice) + 
                               (0.03 * ($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice))));
                } elseif ($bankSettlementPrice <= 749) {
                    $basePrice = $bankSettlementPrice + $shipping;
                    $bankprice = round($basePrice + (0.1 * $basePrice) + (0.03 * ($basePrice + 0.1 * $basePrice)));
                } elseif ($bankSettlementPrice <= 1499) {
                    $basePrice = $bankSettlementPrice + $shipping;
                    $bankprice = round($basePrice + (0.15 * $basePrice) + (0.03 * ($basePrice + 0.15 * $basePrice)));
                } elseif ($bankSettlementPrice <= 2499) {
                    $basePrice = $bankSettlementPrice + $shipping;
                    $bankprice = round($basePrice + (0.18 * $basePrice) + (0.03 * ($basePrice + 0.18 * $basePrice)));
                } else {
                    $basePrice = $bankSettlementPrice + $shipping;
                    $bankprice = round($basePrice + (0.2 * $basePrice) + (0.03 * ($basePrice + 0.2 * $basePrice)));
                }
            } elseif ($shippingMode == "Warehouse") {
                if ($bankSettlementPrice <= 400) {
                    $bankprice = round($bankSettlementPrice + $shipping + $gurantee + $inward + 
                               (0.05 * $bankSettlementPrice) + 
                               (0.03 * ($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice))));
                } elseif ($bankSettlementPrice <= 749) {
                    $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                    $tenPercent = 0.1 * ($bankSettlementPrice + $shipping);
                    $bankprice = round($basePrice + $tenPercent + (0.03 * ($basePrice + $tenPercent)));
                } elseif ($bankSettlementPrice <= 1499) {
                    $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                    $fifteenPercent = 0.15 * ($bankSettlementPrice + $shipping);
                    $bankprice = round($basePrice + $fifteenPercent + (0.03 * ($basePrice + $fifteenPercent)));
                } elseif ($bankSettlementPrice <= 2499) {
                    $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                    $eighteenPercent = 0.18 * ($bankSettlementPrice + $shipping);
                    $bankprice = round($basePrice + $eighteenPercent + (0.03 * ($basePrice + $eighteenPercent)));
                } else {
                    $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                    $twentyPercent = 0.2 * ($bankSettlementPrice + $shipping);
                    $bankprice = round($basePrice + $twentyPercent + (0.03 * ($basePrice + $twentyPercent)));
                }
            }
            
            return $bankprice;
        };
    
        if ($elementCount <= 1) {
            // Single product scenario (0 or 1 elements in stock data)
            $bankSettlementPrice = $request->input('bank_settlement_price');
            $bankprice = $calculateBankPrice($bankSettlementPrice, $seller_id_name->shipping_mode);
            
            $productData = $baseData;
            $productData['bank_settlement_price'] = $bankSettlementPrice;
            $productData['portal_updated_price'] = $bankprice;
            $productData['maximum_retail_price'] = $request->input('maximum_retail_price');
            
            // Set size and quantity based on elementCount
            if ($elementCount == 0) {
                $productData['size_name'] = $request->size;
                $productData['stock_quantity'] = $request->quantity;
                $productData['sku'] = $request->input('sku');
            } else {
                $productData['size_name'] = $stockData[0]['size'];
                $productData['stock_quantity'] = $stockData[0]['quantity'];
                $productData['sku'] = $stockData[0]['sku'];
            }
            
            // Update the product
            DB::table('products')->where('id', $id)->update($productData);
        } else {
            // Multiple sizes/variants scenario
            $first = true;
            foreach ($stockData as $stck) {
                $bankSettlementPrice = $stck->bank_settlement_price;
                $bankprice = $calculateBankPrice($bankSettlementPrice, $seller_id_name->shipping_mode);
                
                $productData = $baseData;
                $productData['size_name'] = $stck->size;
                $productData['stock_quantity'] = $stck->quantity;
                $productData['sku'] = $stck->sku;
                $productData['maximum_retail_price'] = $stck->maximum_retail_price;
                $productData['bank_settlement_price'] = $stck->bank_settlement_price;
                $productData['portal_updated_price'] = $bankprice;
                
                if ($first) {
                    // Update the first row
                    DB::table('products')->where('id', $id)->update($productData);
                    $first = false;
                } else {
                    // Add created_at timestamp for new records
                    $productData['created_at'] = now();
                    // Insert remaining rows as new entries
                    DB::table('products')->insert($productData);
                }
            }
        }
        
        return redirect('/product/sellerproduct')->with('success', 'Product Added successfully.');
    }






    public function update2(Request $request, $id)
    {
        
     
        // return $request;
            // bottom_included
        if(!empty($request->fabric1)) {
            $fabric = $request->fabric1;
        } elseif(!empty($request->fabric2)) {
            $fabric = $request->fabric2;
        } elseif(!empty($request->fabric3)) {
            $fabric = $request->fabric3;
        } elseif(!empty($request->fabric4)) {
            $fabric = $request->fabric4;
        } elseif(!empty($request->fabric5)) {
            $fabric = $request->fabric5;
        } elseif(!empty($request->fabric6)) {
            $fabric = $request->fabric6;
        } elseif(!empty($request->fabric7)) {
            $fabric = $request->fabric7;
        } elseif(!empty($request->fabric8)) {
            $fabric = $request->fabric8;
        } elseif(!empty($request->fabric9)) {
            $fabric = $request->fabric9;
        } elseif(!empty($request->fabric10)) {
            $fabric = $request->fabric10;
        } elseif(!empty($request->fabric11)) {
            $fabric = $request->fabric11;
        } elseif(!empty($request->fabric12)) {
            $fabric = $request->fabric12;
        } elseif(!empty($request->fabric13)) {
            $fabric = $request->fabric13;
        } elseif(!empty($request->fabric14)) {
            $fabric = $request->fabric14;
        } elseif(!empty($request->fabric15)) {
            $fabric = $request->fabric15;
        } elseif(!empty($request->fabric16)) {
            $fabric = $request->fabric16;
        } elseif(!empty($request->fabric17)) {
            $fabric = $request->fabric17;
        } elseif(!empty($request->fabric18)) {
            $fabric = $request->fabric18;
        } elseif(!empty($request->fabric19)) {
            $fabric = $request->fabric19;
        } elseif(!empty($request->fabric20)) {
            $fabric = $request->fabric20;
        } elseif(!empty($request->fabric21)) {
            $fabric = $request->fabric21;
        } elseif(!empty($request->fabric22)) {
            $fabric = $request->fabric22;
        } elseif(!empty($request->fabric23)) {
            $fabric = $request->fabric23;
        } elseif(!empty($request->fabric24)) {
            $fabric = $request->fabric24;
        } elseif(!empty($request->fabric25)) {
            $fabric = $request->fabric25;
        }
        else 
        {
            $fabric = null; 
        }       
        // return $fabric;
            if(!empty($request->bottom_included1))
            {
                $bottom_included = $request->bottom_included1;
            }
            
            elseif(!empty($request->bottom_included2))
            {
                $bottom_included = $request->bottom_included2;
            }
            else 
            {
                $bottom_included = null; // or any default value like 'N/A', 'None', etc.
            }
        
            if (!empty($request->set_type)) {
                $set_type = $request->set_type;
            }
            elseif (!empty($request->set_type_kurti)) {
                $set_type = $request->set_type_kurti;
            } elseif (!empty($request->set_type_kurta)) {
                $set_type = $request->set_type_kurta;
            } elseif (!empty($request->set_type_coord)) {
                $set_type = $request->set_type_coord;
            } else 
            {
                $set_type = null; // or any default value like 'N/A', 'None', etc.
            }

            // Sleeve Length
            
            if(!empty($request->sleeve_length_1))
            {
                $sleeve_length = $request->sleeve_length_1;
            }
            
            elseif(!empty($request->sleeve_length_2))
            {
                $sleeve_length = $request->sleeve_length_2;
            }
            
            elseif(!empty($request->sleeve_length_3))
            {
                $sleeve_length = $request->sleeve_length_3;
            }
            else 
            {
                $sleeve_length = null; // or any default value like 'N/A', 'None', etc.
            }
            
            
            // Sleeve pattern
            
            if(!empty($request->sleeve_pattern_1))
            {
                $sleeve_pattern = $request->sleeve_pattern_1;
            }
            elseif(!empty($request->sleeve_pattern_2))
            {
                $sleeve_pattern = $request->sleeve_pattern_2;
            }
            elseif(!empty($request->sleeve_pattern_3))
            {
                $sleeve_pattern = $request->sleeve_pattern_3;
            }
            elseif(!empty($request->sleeve_pattern_4))
            {
                $sleeve_pattern = $request->sleeve_pattern_4;
            }
            else 
            {
                $sleeve_pattern = null; // or any default value like 'N/A', 'None', etc.
            }
            
            
            // Closure Type 
            
            if(!empty($request->closure_type_1))
            {
                $closure_type = $request->closure_type_1;
            }
            elseif(!empty($request->closure_type_2))
            {
                $closure_type = $request->closure_type_2;
            }
            elseif(!empty($request->closure_type_3))
            {
                $closure_type = $request->closure_type_3;
            }
            elseif(!empty($request->closure_type_4))
            {
                $closure_type = $request->closure_type_4;
            }
            elseif(!empty($request->closure_type_5))
            {
                $closure_type = $request->closure_type_5;
            }
            elseif(!empty($request->closure_type_6))
            {
                $closure_type = $request->closure_type_6;
            }
            elseif(!empty($request->closure_type_7))
            {
                $closure_type = $request->closure_type_7;
            }
            else 
            {
                $closure_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Work Details
            
            if(!empty($request->work_details_1))
            {
                $work_details = $request->work_details_1;
            }
            elseif(!empty($request->work_details_2))
            {
                $work_details = $request->work_details_2;
            }
            elseif(!empty($request->work_details_3))
            {
                $work_details = $request->work_details_3;
            }
            else 
            {
                $work_details = null; // or any default value like 'N/A', 'None', etc.
            }
            
            
            // Border Type
            
            if(!empty($request->border_type_1))
            {
                $border_type = $request->border_type_1;
            }
            elseif(!empty($request->border_type_2))
            {
                $border_type = $request->border_type_2;
            }
            else 
            {
                $border_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Bottom Type
            
            if(!empty($request->bottom_type_1))
            {
                $bottom_type = $request->bottom_type_1;
            }
            elseif(!empty($request->bottom_type_2))
            {
                $bottom_type = $request->bottom_type_2;
            }
            elseif(!empty($request->bottom_type_3))
            {
                $bottom_type = $request->bottom_type_3;
            }
            else 
            {
                $bottom_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Dupatta Length
            
             if(!empty($request->dupatta_length_1))
            {
                $dupatta_length = $request->dupatta_length_1;
            }
            elseif(!empty($request->dupatta_length_2))
            {
                $dupatta_length = $request->dupatta_length_2;
            }
            elseif(!empty($request->dupatta_length_3))
            {
                $dupatta_length = $request->dupatta_length_3;
            }
            else 
            {
                $dupatta_length = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // Length 
            
            
            if(!empty($request->length_1))
            {
                $length = $request->length_1;
            }
            elseif(!empty($request->length_2))
            {
                $length = $request->length_2;
            }
            elseif(!empty($request->length_3))
            {
                $length = $request->length_3;
            }
            elseif(!empty($request->length_4))
            {
                $length = $request->length_4;
            }
            elseif(!empty($request->length_5))
            {
                $length = $request->length_5;
            }
            elseif(!empty($request->length_6))
            {
                $length = $request->length_6;
            }
            else 
            {
                $length = null; // or any default value like 'N/A', 'None', etc.
            }
            // Fit Type
            
            if (!empty($request->fit_type_1)) {
                $fit_type = $request->fit_type_1;
            } elseif (!empty($request->fit_type_2)) {
                $fit_type = $request->fit_type_2;
            } elseif (!empty($request->fit_type_3)) {
                $fit_type = $request->fit_type_3;
            } elseif (!empty($request->fit_type_4)) {
                $fit_type = $request->fit_type_4;
            } elseif (!empty($request->fit_type_5)) {
                $fit_type = $request->fit_type_5;
            } elseif (!empty($request->fit_type_6)) {
                $fit_type = $request->fit_type_6;
            } elseif (!empty($request->fit_type_7)) {
                $fit_type = $request->fit_type_7;
            } elseif (!empty($request->fit_type_8)) {
                $fit_type = $request->fit_type_8;
            } elseif (!empty($request->fit_type_9)) {
                $fit_type = $request->fit_type_9;
            } elseif (!empty($request->fit_type_10)) {
                $fit_type = $request->fit_type_10;
            } elseif (!empty($request->fit_type_11)) {
                $fit_type = $request->fit_type_11;
            } elseif (!empty($request->fit_type_12)) {
                $fit_type = $request->fit_type_12;
            } elseif (!empty($request->fit_type_13)) {
                $fit_type = $request->fit_type_13;
            } elseif (!empty($request->fit_type_14)) {
                $fit_type = $request->fit_type_14;
            } elseif (!empty($request->fit_type_15)) {
                $fit_type = $request->fit_type_15;
            } elseif (!empty($request->fit_type_16)) {
                $fit_type = $request->fit_type_16;
            } elseif (!empty($request->fit_type_17)) {
                $fit_type = $request->fit_type_17;
            } elseif (!empty($request->fit_type_18)) {
                $fit_type = $request->fit_type_18;
            } elseif (!empty($request->fit_type_19)) {
                $fit_type = $request->fit_type_19;
            } elseif (!empty($request->fit_type_20)) {
                $fit_type = $request->fit_type_20;
            } elseif (!empty($request->fit_type_21)) {
                $fit_type = $request->fit_type_21;
            } elseif (!empty($request->fit_type_22)) {
                $fit_type = $request->fit_type_22;
            } elseif (!empty($request->fit_type_23)) {
                $fit_type = $request->fit_type_23;
            } elseif (!empty($request->fit_type_24)) {
                $fit_type = $request->fit_type_24;
            } elseif (!empty($request->fit_type_25)) {
                $fit_type = $request->fit_type_25;
            } elseif (!empty($request->fit_type_26)) {
                $fit_type = $request->fit_type_26;
            }
            else 
            {
                $fit_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
            // return $fit_type;
            // Waistband Type
            
            if (!empty($request->waistband_type_1)) 
            {
                $waistband_type = $request->waistband_type_1;
            }
            elseif (!empty($request->waistband_type_2)) 
            {
                $waistband_type = $request->waistband_type_2;
            }
            elseif (!empty($request->waistband_type_3)) 
            {
                $waistband_type = $request->waistband_type_3;
            }
            elseif (!empty($request->waistband_type_4)) 
            {
                $waistband_type = $request->waistband_type_4;
            }
            else 
            {
                $waistband_type = null; // or any default value like 'N/A', 'None', etc.
            }
            
              
            // waist_rise
            
            if (!empty($request->waist_rise_1)) 
            {
                $waist_rise = $request->waist_rise_1;
            }
            elseif (!empty($request->waist_rise_2)) 
            {
                $waist_rise = $request->waist_rise_2;
            }
            else{
                $waist_rise = null;
            }
            
            // Sleeve Style 
            if (!empty($request->sleeve_style1)) 
            {
                $sleeve_style = $request->sleeve_style1;
            }
            elseif (!empty($request->sleeve_style2)) 
            {
                $sleeve_style = $request->sleeve_style2;
            }
            else
            {
                $sleeve_style = null;
            }
        

        $pid_data = DB::table('products')->where('id',$id)->latest()->first();
        if(Auth::user()->id == 9)
        {
            $alldat = DB::table('products')->where('product_id',$pid_data->product_id)->get();
             
            $multidata = [];
             
            foreach ($alldat as $dat) {
                $sizeKey = 'size' . $dat->id;
                $selectedSize = $request->input($sizeKey);
                
                $mrpKey = 'maximum_retail_price' . $dat->id;
                $mrp = $request->input($mrpKey);
                
                $pupKey = 'portal_updated_price' . $dat->id;
                $pup = $request->input($pupKey);
                
                $bspKey = 'bank_settlement_price' . $dat->id;
                $bsp = $request->input($bspKey);
                
                $skuKey = 'sku' . $dat->id;
                $sku = $request->input($skuKey);
                
                $QtyKey = 'quantity' . $dat->id;
                $Qty = $request->input($QtyKey);
                
            
                DB::table('products')
                    ->where('id', $dat->id)
                    ->update([
                        'size_name' => $selectedSize,
                        'maximum_retail_price' => $mrp,
                        'portal_updated_price' => $pup,
                        'bank_settlement_price' => $bsp,
                        'sku' => $sku,
                        'stock_quantity' => $Qty,
                    ]);
            }
             
        }

        
        // Get color name/hex code
        $color_name = Str::contains($request->color_name, '#') 
            ? $request->color_name 
            : DB::table('colors')->where('color_name', $request->color_name)->latest()->first()->hex_code;
    
        // Retrieve existing product
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
    
        // Handle image processing
        $existingImages1 = json_decode($product->images, true) ?? [];
        
        // AWS CODE
        

        $removedImages = isset($request->rmvimg) ? json_decode($request->rmvimg, true) : [];
        
        // Filter out removed images from existing
        $existingImages = array_values(array_diff($existingImages1, $removedImages));
        
        $seller_id = $request->input('seller_id');
        $product_id = $request->product_id;
        
        if ($request->hasFile('images')) {
            $newImageUrls = [];
        
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $folderPath = "products/{$seller_id}/{$product_id}";
                $filePath = $folderPath . '/' . $originalName;
        
                if ($image->getSize() <= 204800) {
                    // ≤ 200KB → upload directly
                    $image->storeAs($folderPath, $originalName, 'r2');
                } else {
                    // > 200KB → compress and resize before upload
        
                    // Detect MIME type
                    $imageInfo = getimagesize($image->getPathname());
                    $mime = $imageInfo['mime'] ?? null;
        
                    switch ($mime) {
                        case 'image/jpeg':
                            $sourceImage = imagecreatefromjpeg($image->getPathname());
                            break;
                        case 'image/png':
                            $sourceImage = imagecreatefrompng($image->getPathname());
                            break;
                        default:
                            continue 2; // skip this file
                    }
        
                    if (!$sourceImage) {
                        continue;
                    }
        
                    $targetWidth = 412;
                    $targetHeight = 559;
                    $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
        
                    if ($mime === 'image/png') {
                        imagealphablending($resizedImage, false);
                        imagesavealpha($resizedImage, true);
                    }
        
                    imagecopyresampled(
                        $resizedImage, $sourceImage,
                        0, 0, 0, 0,
                        $targetWidth, $targetHeight,
                        imagesx($sourceImage), imagesy($sourceImage)
                    );
        
                    ob_start();
                    imagejpeg($resizedImage, null, 70);
                    $imageData = ob_get_clean();
        
                    Storage::disk('r2')->put($filePath, $imageData, 'public');
        
                    imagedestroy($sourceImage);
                    imagedestroy($resizedImage);
        
                    // Skip default upload for this compressed image
                    $newImageUrls[] = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                    continue;
                }
        
                // Generate public URL for directly uploaded image
                $publicUrl = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                $newImageUrls[] = $publicUrl;
            }
        
            // Merge new images with old (filtered) ones
            $existingImages = array_merge($existingImages, $newImageUrls);
        }

    
        // Get parent_id
        $parent_id = $request->parent_id;
        
        // Process stock quantity
        $stockData = json_decode($request->stock_quantity, true);
        $elementCount = is_array($stockData) ? count($stockData) : 0;
        
        // Get seller info for pricing calculations
        $seller_id_name = DB::table('sellers')->where('seller_id', $seller_id)->latest()->first();
        
        // Handle brand
        $brand_cnt = DB::table('brands')->where('seller_id', $seller_id)->count();
        $brand = $brand_cnt > 0 
            ? DB::table('brands')->where('brand_name', $request->input('brand_id'))->latest()->first() 
            : null;
        $bname = $brand ? $request->brand_id : 0;
        
        // Base product data array for all scenarios
        $baseData = [
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'sub_subcategory_id' => $request->input('sub_subcategory_id'),
            'product_name' => $request->input('product_name'),
            'brand_id' => $request->input('brand_id'),

            'parent_id' => $parent_id,
            'product_id' => $request->product_id,
            'seller_user_id' => Auth::id(),
            'description' => $request->input('description'),
            'color_name' => $color_name,
            'fabric' => $fabric,
            'occasion' => $request->input('occasion'),
            'care_instructions' => $request->input('care_instructions'),
            'video_url' => $request->input('video_url'),
            'seller_id' => $seller_id,
            'shipping_time' => $request->input('shipping_time'),
            'return_policy' => $request->input('return_policy'),
            'hsn' => $request->input('hsn'),
            'gst_rate' => $request->input('gst_rate'),
            'procurement_type' => $request->input('procurement_type'),
            'package_weight' => $request->input('package_weight'),
            'package_length' => $request->input('package_length'),
            'package_breadth' => $request->input('package_breadth'),
            'package_height' => $request->input('package_height'),
            'pack_of' => $request->input('pack_of'),
            'country_of_origin' => $request->input('country_of_origin'),
            'manufacturer_details' => $request->input('manufacturer_details'),
            'packer_details' => $request->input('packer_details'),
            'size_chart_id' => $request->input('size_chart_id'),
            'listing_status' => $request->input('listing_status'),
            'alt_text' => $request->input('alt_text'),
            'pattern' => $request->input('pattern'),
            'added_by' => Auth::id(),
            'updated_at' => now(),
            'images' => json_encode($existingImages),
            'tryout_eligibility' => $request->input('tryout_eligibility', 'YES'),
            'sole_material' => $request->input('sole_material'),
            'upper_material' => $request->input('upper_material'),
            'toe_shape' => $request->input('toe_shape'),
            'heel_type' => $request->input('heel_type'),
            
            // Apparel specific fields
            'saree_length' => $request->saree_length,
            'blouse_fabric' => $request->blouse_fabric,
            'blouse_piece_included' => $request->blouse_piece_included,
            'blouse_length' => $request->blouse_length,
            'blouse_stiched' => $request->blouse_stiched,
            'work_details' => $work_details,
            'border_type' => $border_type,
            'weave_type' => $request->weave_type,
            'gown_type' => $request->gown_type,
            'sleeve_length' => $sleeve_length,
            'sleeve_pattern' => $sleeve_pattern,
            'neck_style' => $request->neck_style,
            'closure_type' => $closure_type,
            'embellishment_details' => $request->embellishment_details,
            'lining_present' => $request->lining_present,
            'top_type' => $request->top_type,
            'hemline' => $request->hemline,
            'transparency_level' => $request->transparency_level,
            'set_type' => $set_type,
            'bottom_included' => $bottom_included,
            'bottom_type' => $bottom_type,
            'dupatta_fabric' => $request->dupatta_fabric,
            'dupatta_length' => $dupatta_length,
            'dupatta_shawl_type' => $request->dupatta_shawl_type,
            'length' => $length,
            'lehenga_type' => $request->lehenga_type,
            'lehenga_length' => $request->lehenga_length,
            'choli_included' => $request->choli_included,
            'choli_length' => $request->choli_length,
            'choli_sleeve_length' => $request->choli_sleeve_length,
            'dupatta_included' => $request->dupatta_included,
            'flare_type' => $request->flare_type,
            'neckline' => $request->neckline,
            'fit_type' => $fit_type,
            'tshirt_type' => $request->tshirt_type,
            'sleeve_style' => $sleeve_style,
            'collar_type' => $request->collar_type,
            'shirt_type' => $request->shirt_type,
            'dress_type' => $request->dress_type,
            'dress_length' => $request->dress_length,
            'top_style' => $request->top_style,
            'bottom_style' => $request->bottom_style,
            'jumpsuit_type' => $request->jumpsuit_type,
            'leg_style' => $request->leg_style,
            'shrug_type' => $request->shrug_type,
            'hoodie_type' => $request->hoodie_type,
            'hood_included' => $request->hood_included,
            'pocket_type' => $request->pocket_type,
            'jacket_type' => $request->jacket_type,
            'pocket_details' => $request->pocket_details,
            'blazer_type' => $request->blazer_type,
            'lapel_style' => $request->lapel_style,
            'playsuit_type' => $request->playsuit_type,
            'shacket_type' => $request->shacket_type,
            'waist_rise' => $waist_rise,
            'stretchability' => $request->stretchability,
            'distressed_non_distressed' => $request->distressed_non_distressed,
            'number_of_pockets' => $request->number_of_pockets,
            'waistband_type' => $waistband_type,
            'compression_level' => $request->compression_level,
            'pleated_non_pleated' => $request->pleated_non_pleated,
            'waist_type' => $request->waist_type,
            'cargo_type' => $request->cargo_type,
            

            'bust_size' => blank($request->bust_size) ? null : $request->bust_size,
            'hip_size' => blank($request->hip_size) ? null : $request->hip_size,
            'weist_size' => blank($request->weist_size) ? null : $request->weist_size,
            'shoulder_size' => blank($request->shoulder_size) ? null : $request->shoulder_size,
            'product_length' => blank($request->product_length) ? null : $request->product_length,

            
        ];
        
        // Add brand if exists
        if ($bname != 0) {
            $baseData['brand_id'] = $bname;
        }
        
        DB::table('products')->where('product_id', $request->product_id)->update($baseData);
        
        // return $request->stock_quantity;
       
            
        if(!empty($request->stock_quantity))
        {
            
            //  $ab = [];
            //  foreach (json_decode($request->stock_quantity) as $stckkkk) {
                 
            //      $bd['id'] = $stckkkk->id;
            //      $bd['bust'] = $stckkkk->bust_size;
                 
            //      $ab[] = $bd;
                 
            //  }
            
            // return $ab;
            foreach (json_decode($request->stock_quantity) as $stck) {
                
                
                
                $bankSettlementPrice = $stck->bsp;
                $shippingMode = $seller_id_name->shipping_mode;
                $bankprice = 0;
            
                if ($shippingMode == "In-Store") {
                    
                    if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) {
                        $shipping = 131;
                        $bankprice = round($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice) + (0.03 * ($bankSettlementPrice + $shipping + (0.05 * $bankSettlementPrice))));
                    } elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) {
                        $shipping = 180;
                        $basePrice = $bankSettlementPrice + $shipping;
                        $tenPercent = 0.1 * $basePrice;
                        $threePercent = 0.03 * ($basePrice + $tenPercent);
                        $bankprice = round($basePrice + $tenPercent + $threePercent);
                    } elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) {
                        $shipping = 200;
                        $basePrice = $bankSettlementPrice + $shipping;
                        $fifteenPercent = 0.15 * $basePrice;
                        $threePercent = 0.03 * ($basePrice + $fifteenPercent);
                        $bankprice = round($basePrice + $fifteenPercent + $threePercent);
                    } elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) {
                        $shipping = 220;
                        $basePrice = $bankSettlementPrice + $shipping;
                        $eighteenPercent = 0.18 * $basePrice;
                        $additionalCharge = 0.03 * ($basePrice + $eighteenPercent);
                        $bankprice = round($basePrice + $eighteenPercent + $additionalCharge);
                    } elseif ($bankSettlementPrice >= 2500) {
                        $shipping = 240;
                        $basePrice = $bankSettlementPrice + $shipping;
                        $twentyPercent = 0.2 * $basePrice;
                        $threePercent = 0.03 * ($basePrice + $twentyPercent);
                        $bankprice = round($basePrice + $twentyPercent + $threePercent);
                    }
                }
            
                elseif ($shippingMode == "Warehouse") {
                    
                    // return 'out';
                    $gurantee = 35;
                    $inward = 9;
                    
                    if ($bankSettlementPrice >= 1 && $bankSettlementPrice <= 400) {
                        $shipping = 131;
                        $bankprice = round($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice) + (0.03 * ($bankSettlementPrice + $shipping + $gurantee + $inward + (0.05 * $bankSettlementPrice))));
                    } elseif ($bankSettlementPrice >= 401 && $bankSettlementPrice <= 749) {
                        $shipping = 180;
                        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                        $tenPercent = 0.1 * ($bankSettlementPrice + $shipping);
                        $threePercent = 0.03 * ($basePrice + $tenPercent);
                        $bankprice = round($basePrice + $tenPercent + $threePercent);
                    } elseif ($bankSettlementPrice >= 750 && $bankSettlementPrice <= 1499) {
                        $shipping = 200;
                        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                        $fifteenPercent = 0.15 * ($bankSettlementPrice + $shipping);
                        $threePercent = 0.03 * ($basePrice + $fifteenPercent);
                        $bankprice = round($basePrice + $fifteenPercent + $threePercent);
                    } elseif ($bankSettlementPrice >= 1500 && $bankSettlementPrice <= 2499) {
                        $shipping = 220;
                        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                        $eighteenPercent = 0.18 * ($bankSettlementPrice + $shipping);
                        $additionalCharge = 0.03 * ($basePrice + $eighteenPercent);
                        $bankprice = round($basePrice + $eighteenPercent + $additionalCharge);
                    } elseif ($bankSettlementPrice >= 2500) {
                        $shipping = 240;
                        $basePrice = $bankSettlementPrice + $shipping + $gurantee + $inward;
                        $twentyPercent = 0.2 * ($bankSettlementPrice + $shipping);
                        $threePercent = 0.03 * ($basePrice + $twentyPercent);
                        $bankprice = round($basePrice + $twentyPercent + $threePercent);
                    }
                }
            
            
            
                
                
                
                $data = [
                    'category_id' => $request->input('category_id'),
                    'subcategory_id' => $request->input('subcategory_id'),
                    'sub_subcategory_id' => $request->input('sub_subcategory_id'),
                    'product_name' => $request->input('product_name'),
                    'product_id' => $product_id, // Auto-generated
                    'seller_user_id' => Auth::user()->id,
                    'seller_id' => $seller_id_name->seller_id,
                    'parent_id' => $parent_id,
                    'brand_id' => $request->input('brand_id'),
                    'description' => $request->input('description'),
                    'size_name' => $stck->size,
                    'stock_quantity' => $stck->quantity,
                    'color_name' => $color_name,
                    'fabric' => $fabric,
                    'occasion' => $request->input('occasion'),
                    'care_instructions' => $request->input('care_instructions'),
                    'video_url' => $request->input('video_url'),
                    'shipping_time' => $request->input('shipping_time'),
                    'return_policy' => $request->input('return_policy'),
                    'sku' => $stck->sku,
                    'hsn' => $request->input('hsn'),
                    'gst_rate' => $request->input('gst_rate'),
                    'procurement_type' => $request->input('procurement_type'),
                    'package_weight' => $request->input('package_weight'),
                    'package_length' => $request->input('package_length'),
                    'package_breadth' => $request->input('package_breadth'),
                    'package_height' => $request->input('package_height'),
                    'pack_of' => $request->input('pack_of'),
                    'country_of_origin' => $request->input('country_of_origin'),
                    'manufacturer_details' => $request->input('manufacturer_details'),
                    'packer_details' => $request->input('packer_details'),
                    'size_chart_id' => $request->input('size_chart_id'),
                    'listing_status' => $request->input('listing_status'),
                    'maximum_retail_price' => $stck->mrp,
                    'bank_settlement_price' => $stck->bsp,
                    'portal_updated_price' => $bankprice,
                    'alt_text' => $request->input('alt_text'),
                    'pattern' => $request->input('pattern'),
                    
                    'added_by' => Auth::id(),
                    'images' => json_encode($existingImages),
                    'sole_material' => $request->input('sole_material'),
                    'upper_material' => $request->input('upper_material'),
                    
                    'toe_shape' => $request->input('toe_shape'),
                    'heel_type' => $request->input('heel_type'),
                    
                       
                    'saree_length' => $request->saree_length,
                    'blouse_fabric' => $request->blouse_fabric,
                    'blouse_piece_included' => $request->blouse_piece_included,
                    'blouse_length' => $request->blouse_length,
                    'blouse_stiched' => $request->blouse_stiched,
                    'work_details' => $work_details ?? null,
                    'border_type' => $border_type ?? null,
                    'weave_type' => $request->weave_type,
                    'pattern' => $request->pattern,
                    'gown_type' => $request->gown_type,
                    'sleeve_length' => $sleeve_length ?? null,
                    'sleeve_pattern' => $sleeve_pattern ?? null,
                    'neck_style' => $request->neck_style,
                    'closure_type' => $closure_type ?? null,
                    'embellishment_details' => $request->embellishment_details,
                    'lining_present' => $request->lining_present,
                    'top_type' => $request->top_type,
                    'hemline' => $request->hemline,
                    'transparency_level' => $request->transparency_level,
                    'set_type' => $set_type ?? null,
                    'bottom_included' => $bottom_included,
                    'bottom_type' => $bottom_type ?? null,
                    'dupatta_fabric' => $request->dupatta_fabric,
                    'dupatta_length' => $dupatta_length ?? null,
                    'dupatta_shawl_type' => $request->dupatta_shawl_type,
                    'length' => $length ?? null,
                    'lehenga_type' => $request->lehenga_type,
                    'lehenga_length' => $request->lehenga_length,
                    'choli_included' => $request->choli_included,
                    'choli_length' => $request->choli_length,
                    'choli_sleeve_length' => $request->choli_sleeve_length,
                    'dupatta_included' => $request->dupatta_included,
                    'flare_type' => $request->flare_type,
                    'neckline' => $request->neckline,
                    'fit_type' => $fit_type ?? null,
                    'tshirt_type' => $request->tshirt_type,
                    'sleeve_style' => $sleeve_style,
                    'collar_type' => $request->collar_type,
                    'shirt_type' => $request->shirt_type,
                    'dress_type' => $request->dress_type,
                    'dress_length' => $request->dress_length,
                    'top_style' => $request->top_style,
                    'bottom_style' => $request->bottom_style,
                    'jumpsuit_type' => $request->jumpsuit_type,
                    'leg_style' => $request->leg_style,
                    'shrug_type' => $request->shrug_type,
                    'hoodie_type' => $request->hoodie_type,
                    'hood_included' => $request->hood_included,
                    'pocket_type' => $request->pocket_type,
                    'jacket_type' => $request->jacket_type,
                    'pocket_details' => $request->pocket_details,
                    'blazer_type' => $request->blazer_type,
                    'lapel_style' => $request->lapel_style,
                    'playsuit_type' => $request->playsuit_type,
                    'shacket_type' => $request->shacket_type,
                    'waist_rise' => $waist_rise,
                    'stretchability' => $request->stretchability,
                    'distressed_non_distressed' => $request->distressed_non_distressed,
                    'number_of_pockets' => $request->number_of_pockets,
                    'waistband_type' => $waistband_type ?? null,
                    'compression_level' => $request->compression_level,
                    'pleated_non_pleated' => $request->pleated_non_pleated,
                    'waist_type' => $request->waist_type,
                    'cargo_type' => $request->cargo_type,
            
                    'bust_size' => blank($stck->bust_size) ? null : $stck->bust_size,
                    'hip_size' => blank($stck->hip_size) ? null : $stck->hip_size,
                    'weist_size' => blank($stck->weist_size) ? null : $stck->weist_size,
                    'shoulder_size' => blank($stck->shoulder_size) ? null : $stck->shoulder_size,
                    'product_length' => blank($stck->product_length) ? null : $stck->product_length,

                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            
            
                  
                    $szcnt = DB::table('products')->where('product_id',$product_id)->where('size_name',$stck->size)->count();
                    
                    $sid = DB::table('products')
                            ->where('product_id',$product_id)
                            ->where('size_name',$stck->size)
                            ->latest()
                            ->first();
     
                    if($szcnt >= 1)
                    {
                        // return 'Here';
                        DB::table('products')->where('id',$stck->id)->update($data);
                    }
                    else
                    {
                        DB::table('products')->insert($data);
                    }
                    
                
            }

        }
                    
                    
       $skt = is_string($request->stock_quantity);     

       
       if(!empty($skt))
       {
           
             $avl = DB::table('products')->select('id','size_name')->where('product_id',$request->product_id)->latest()->get();
        

                    // Convert DB results to array for easy lookup
            $sizeIdMap = collect($avl)
                ->filter(function($item) {
                    return !is_null($item->size_name);
                })
                ->pluck('id', 'size_name') // ['38' => 5411, '40' => 5412, ...]
                ->toArray();
            
           $stock_quantity = is_string($request->stock_quantity)
                ? json_decode($request->stock_quantity, true)
                : $request->stock_quantity;        
                    // Build the desired array
           $final = collect($stock_quantity)->map(function ($item) use ($sizeIdMap) {
                        return [
                            'size' => $item['size'],
                            'id'   => isset($sizeIdMap[$item['size']]) ? $sizeIdMap[$item['size']] : null,
                        ];
                    })->filter(function ($row) {
                        return !is_null($row['id']);
                    })->values()->toArray();
                    
                    
            // Step 1: Get all size_name => id map from DB
            $sizeIdMapFromDB = collect($avl)
                ->filter(function ($item) {
                    return !is_null($item->size_name);
                })
                ->pluck('id', 'size_name') // ['38' => 5411, '40' => 5412, ..., '46' => 5414]
                ->toArray();
            
            // Step 2: Get used sizes from $final (like: ['38', '40', '44'])
            $usedSizes = collect($final)
                ->pluck('size')
                ->toArray();
            
            // Step 3: Get sizes in DB that were NOT used
            $unusedSizes = array_diff(array_keys($sizeIdMapFromDB), $usedSizes);
            
            // Step 4: Get corresponding IDs
            $unusedSizeIds = [];
            foreach ($unusedSizes as $size) {
                if (isset($sizeIdMapFromDB[$size])) {
                    $unusedSizeIds[] = $sizeIdMapFromDB[$size];
                }
            }
            
            if (!empty($unusedSizeIds)) {
                DB::table('products')->whereIn('id', $unusedSizeIds)->delete();
            }
           
       }
  
        
        
        
            // Redirect after processing all data
            return redirect('/product/sellerproduct')->with('success', 'Product Added successfully.');
            
        }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return back()->with('success','Product deleted successfully');
    }
    
    
    public function getProductImages(Request $request)
    {
        $product = DB::table('products')->where('id', $request->id)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $images = json_decode($product->images, true) ?? []; // Assuming images are stored as a JSON array

        return response()->json(['images' => $images]);
    }

    /**
     * Get file extension from mime type
     * 
     * @param string $mimeType
     * @return string
     */
    private function getExtensionFromMimeType($mimeType)
    {
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
            'application/pdf' => 'pdf',
            // Add more mime types as needed
        ];
        
        return $extensions[$mimeType] ?? 'jpg';
    }
    
    public function catproduct()
    {
         // Query 1: Non-Kids - sub_subcategory-level distinct product counts
        $query1 = DB::table('categories as c3')
            ->leftJoin('categories as c2', 'c3.parent_id', '=', 'c2.id') // subcategory
            ->leftJoin('categories as c1', 'c2.parent_id', '=', 'c1.id') // category
            ->leftJoin('products', 'products.sub_subcategory_id', '=', 'c3.id')
            ->select(
                'c3.id',
                'c1.category',
                'c2.subcategory',
                'c3.sub_subcategory',
                DB::raw('COUNT(DISTINCT products.product_id) as product_count') // ✅ count unique product_id
            )
            ->where('c3.level', '=', 2)
            ->where('c1.category', '!=', 'Kids')
            ->groupBy('c3.id', 'c1.category', 'c2.subcategory', 'c3.sub_subcategory');
        
        $query2 = DB::table('categories as c2')
            ->leftJoin('categories as c1', 'c2.parent_id', '=', 'c1.id')
            ->leftJoin('products', 'products.subcategory_id', '=', 'c2.id')
            ->select(
                'c2.id as id',
                'c1.category',
                'c2.subcategory',
                DB::raw('NULL as sub_subcategory'),
                DB::raw('COUNT(DISTINCT products.product_id) as product_count') // ✅ count unique product_id
            )
            ->where('c1.category', '=', 'Kids')
            ->whereNotNull('c2.subcategory')
            ->groupBy('c2.id', 'c1.category', 'c2.subcategory');
        
        $categoryCounts = $query1->unionAll($query2)
            ->orderBy('id', 'asc')
            ->get();


        
        return view('product.catproduct', compact('categoryCounts'))->with('i');

    }
    
    public function updateStatus(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->pstatus = $request->pstatus;
    $product->save();

    return response()->json(['success' => true]);
}

}
