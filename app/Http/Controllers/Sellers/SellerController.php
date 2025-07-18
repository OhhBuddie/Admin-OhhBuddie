<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WhatsAppController;

use App\Models\Brand;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seller.index');
    }
    
    public function registration()
    {
        // $sid= Auth::user()->id;
        
        // $seller_data = DB::table('sellers')->where('user_table_id',$sid)->latest()->first();
        $city = DB::table('cities')->orderBy('name', 'asc')->distinct('name')->latest()->get();
        
        // $state = DB::table('states')->latest()->get();
        $state = DB::table('states')->orderBy('name', 'asc')->orderBy('name', 'asc')->get();

        
        
        // return view('seller.registration',compact('city','state','seller_data'));
        
        return view('seller.registration',compact('city','state'));
        
    }
    
    public function getCities(Request $request)
    {
         $cities = DB::table('cities')
            ->select('name', 'state_id', 'cost', 'status', DB::raw('MIN(id) as id'))
            ->where('state_id', $request->state_id)
            ->groupBy('name', 'state_id', 'cost', 'status')
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($cities);
    }
    
    
    public function submitform(Request $request)
    {
        // return $request;
        
        $mobileNo = $request->registered_phone_number;
        $prefixedNumber = '+91' . $mobileNo; // Append +91 for Indian numbers

        // Check if the mobile number exists in the `users` table
        $user = User::where('phone', $prefixedNumber)->first();
        
   
        // return $prefixedNumber;
        if (!$user) {
            

            // User ID
            $lastUser = DB::table('users')->whereNotNull('user_id')->orderBy('id', 'desc')->first();

            if ($lastUser && preg_match('/OBD-(\d+)/', $lastUser->user_id, $matches)) {
                $nextNumber = str_pad($matches[1] + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '1000'; // Start from OBD-0001
            }

            $newUserId = 'OBD-' . $nextNumber;
            
            $id = DB::table('users')->insertGetId([
                            'phone' => $prefixedNumber,
                            'name' => $request->owner_name,
                            'email' => $request->registered_email_id,
                            'password' => Hash::make($request->password), // Hash the password 
                            'user_type' => 'Seller',
                            'user_id' => $newUserId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        
                        
            // Seller ID
            
            $lastUser1 = DB::table('sellers')->whereNotNull('seller_id')->orderBy('id', 'desc')->first();

            if ($lastUser1 && preg_match('/OBD-SLR-(\d+)/', $lastUser1->seller_id, $matches1)) {
                $nextNumber1 = str_pad($matches1[1] + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber1 = '1000'; // Start from OBD-0001
            }

            $newSellerId = 'OBD-SLR-' . $nextNumber1;
            

            $sid = DB::table('sellers')->insertGetId([
                                        'registered_phone_number' => $prefixedNumber,
                                        'password' => Hash::make($request->password), // Hash the password 
                                        'user_table_id' => $id,
                                        'seller_id' => $newSellerId,
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);
            $workingDays = $request->working_day; // This will be an array of selected days


    
            $seller_id = Db::table('sellers')->where('user_table_id', $id)->latest()->first();
             DB::table('sellers')
                    ->where('user_table_id', $id)
                    ->update([
                        'company_name' => $request->company_name ?? $seller->company_name,
                        'owner_name' => $request->owner_name ?? $seller->owner_name,
                        'registered_phone_number' => $request->registered_phone_number,
                        'shipping_mode' => $request->shipping_mode,
                        'registered_address1' => $request->registered_address1,
                        'registered_address2' => $request->registered_address2,
                        'registered_pincode' => $request->registered_pincode,
                        'registered_city' => $request->registered_city,
                        'registered_state' => $request->registered_state,
                        'warehouse_phone_number' => $request->warehouse_phone_number,
                        'warehouse_email_id' => $request->warehouse_email_id,
                        'warehouse_address1' => $request->warehouse_address1,
                        'warehouse_address2' => $request->warehouse_address2,
                        'warehouse_pincode' => $request->warehouse_pincode,
                        'warehouse_city' => $request->warehouse_city,
                        'warehouse_state' => $request->warehouse_state,
                        'bank_account_holder' => $request->bank_account_holder,
                        'bank_account_number' => $request->bank_account_number,
                        'bank_account_ifsc' => $request->bank_account_ifsc,
                        'bank_account_type' => $request->bank_account_type,
                        'bank_name' => $request->bank_name,
                        'gst_number' => $request->gst_number,
                        'brand_name' => $request->brand_name,
                        'nature_of_brand' => $request->nature_of_brand,
                        'added_by' => 'Admin',
                        // Additional Information
                        'working_day' => json_encode($workingDays),
                        'working_start_time' => $request->working_start_time,
                        'working_close_time' => $request->working_close_time,
                        
                        'note' => $request->note,
                        'payment_mode' => $request->payment_mode,
                        'document_for_proof' => $request->document_for_proof,
                    ]);
                    
                
            $data = [];
    
            // List of file fields
            $fileFields = ['gst_certificate', 'govt_id_proof', 'cancelled_cheque', 'trademark_certificate', 'brand_logo'];
            
            $logoPath = null;
            $documentPath = null;
            
            // Process file uploads
            foreach ($fileFields as $fileField) {
                if ($request->hasFile($fileField)) {
                    $file = $request->file($fileField);
                    
                    // Define the folder path with seller_id
                    $folderPath = "Seller_Details/{$seller_id->seller_id}";
            
                    // R2 doesn't need to explicitly check/make directories like S3,
                    // but keeping this logic in case your app handles directory control via filesystem
                    if (!Storage::disk('r2')->exists($folderPath)) {
                        Storage::disk('r2')->makeDirectory($folderPath);
                    }
            
                    // Generate a unique filename
                    $filename = time() . '_' . $file->getClientOriginalName();
                    
                    // Upload the file to R2 inside the seller's folder
                    $filePath = $file->storeAs($folderPath, $filename, 'r2');
            
                    // Generate the public URL using your R2 public base path
                    $url = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                    $data[$fileField] = $url;
            
                    // Save specific fields for brands table
                    if ($fileField == 'brand_logo') {
                        $logoPath = $url;
                    } elseif ($fileField == 'trademark_certificate') {
                        $documentPath = $url;
                    }
                }
        }
        
            DB::table('sellers')->where('user_table_id', $id)->update($data);
            
            
            //////////////////////////////////////////////////////////////
            
            return redirect()->away('https://admin.ohhbuddie.com/product/allseller');

            $lastProduct = DB::table('brands')
                ->where('seller_id', $seller_id->seller_id)
                ->where('brand_id', 'LIKE', 'OBD-BR-' . $seller_id->seller_id . '-%')
                ->orderBy('id', 'desc')
                ->first();
            
            // Extract last number and increment
            if ($lastProduct) {
                preg_match('/OBD-BR-' . $seller_id->seller_id . '-(\d+)/', $lastProduct->product_id, $matches);
                $nextNumber = isset($matches[1]) ? ((int) $matches[1] + 1) : 1001;
            } else {
                $nextNumber = 1001;
            }
            
            // Generate unique product ID
            $brand_id = 'OBD-BR-' . $seller_id->seller_id . '-' . $nextNumber;
            
            
            
            
            
            $brand_count = DB::table('brands')->where('user_table_id',$id)->count();
            
            $brands_total = $brand_count + 1;
            
            DB::table('sellers')->where('user_table_id',$id)->update(['total_brands'=>$brands_total]);
            
            

            /////////////////////////////////////////////////////////////
            
            
            try{

                
                DB::table('brands')
                    ->insert([
                        'user_table_id' => $id,
                        'seller_id' => $newSellerId,
                        'seller_table_id' =>  $seller_id->id,
                        'brand_id' => $brand_id,
                        'brand_name' =>$request->brand_name,
                        'nature_of_brand' => $request->nature_of_brand,
                        'brand_logo' => $logoPath,
                        'document_type' => $request->document_type,
                        'document' => $documentPath,
                        'no_of_products' => $request->no_of_products,
                    ]);
            }
            catch (\Exception $e) {
                // Log the error
                Log::error('ERROR');
                return back();
            }
            
            $admins = DB::table('users')->where('user_type', 'Admin')->select('name', 'phone')->get();
            
            $adminData = [];
            
            foreach ($admins as $admin) {
                
                $adminnumber = preg_replace('/[^0-9]/', '', $admin->phone);
                if (strlen($adminnumber) == 10) {
                    $adminnumber = '91' . $adminnumber;
                }
                
                $adminData[] = [
                    'adminname' => $admin->name,
                    'adminnumber' => $adminnumber
                ];
            }
                
                
            $sellernumber = preg_replace('/[^0-9]/', '', $prefixedNumber);
            if (strlen($sellernumber) == 10) {
                $sellernumber = '91' . $sellernumber;
            }    
            
            
                
            $city_name = DB::table('cities')->where('id', $request->registered_city)->first();
            $state_name = DB::table('states')->where('id', $request->registered_state)->first();
    
            $full_address = $request->registered_address1 . ', ' .
                    $request->registered_address2 . ', ' .
                    $city_name->name . ', ' .
                    $state_name->name . ' - ' .
                    $request->registered_pincode;
                    
                    
            // Now create the WhatsApp request with all seller data
            $whatsappRequest = new Request([
                'message' => "Your order has been confirmed and payment received successfully!",
                'sellerphone' => $sellernumber,
                'sellername' => $request->owner_name,
                'sellerlocation' => $full_address,
                'sellercompanyname' => $request->company_name,
                'adminData' => $adminData,
                'id' => 3

            ]);
            
            $whatsappController = new WhatsAppController();
            $whatsappController->sendMessage($whatsappRequest);    
                
    
                
            return redirect()->away('https://admin.ohhbuddie.com/product/allseller');

        }
    }
    public function login()
    {
        return view('seller.login');
    }

    public function enterOtp()
    {
        return view('seller.enter-otp');
    }

    public function enterEmail()
    {
        return view('seller.enter-email');
    }

    public function enterEmailOtp()
    {
        return view('seller.enter-email-otp');
    }

    public function submitPhone(Request $request)
    {
        return redirect()->route('seller.enter-otp');
    }

    public function submitOtp(Request $request)
    {
        return redirect()->route('seller.enter-email');
    }

    public function submitEmail(Request $request)
    {
        return redirect()->route('seller.enter-email-otp');
    }

    public function submitEmailOtp(Request $request)
    {
        return redirect()->route('seller.registration');
    }
    
    public function dashboard()
    {

        return view('seller.dashboard');
    }
    
    
    
    public function profile()
    {
         $seller_data = DB::table('sellers')->where('user_table_id', Auth::user()->id)->latest()->first();
        $city = DB::table('cities')->latest()->get();
        $state = DB::table('states')->latest()->get();
       
        return view('seller.profile',compact('city','state','seller_data'));
    }
    
    public function profileedit($id)
    {   
        // return $id;
        $seller_data = DB::table('sellers')->where('id', $id)->latest()->first();
        
     
        $city = DB::table('cities')->orderBy('name', 'asc')->distinct('name')->latest()->get();
        $state = DB::table('states')->orderBy('name', 'asc')->latest()->get();
       
        return view('seller.profile_edit', compact('city','state','seller_data'));
    }

    public function editform(Request $request, $id)
    {
        // return $request;
        
        // Get the latest seller record for the user
        $seller = DB::table('sellers')->where('id', $id)->latest()->first();
        $workingDays = $request->working_day; // This will be an array of selected days
        // Update the main seller details
        DB::table('sellers')
            ->where('id', $id)
            ->update([
                'company_name' => $request->company_name,
                'owner_name' => $request->owner_name,
                'registered_phone_number' => $request->registered_phone_number,
                'registered_address1' => $request->registered_address1,
                'registered_address2' => $request->registered_address2,
                'registered_pincode' => $request->registered_pincode,
                'registered_city' => $request->registered_city,
                'registered_state' => $request->registered_state,
                'registered_email_id' => $request->registered_email_id,
                'warehouse_phone_number' => $request->warehouse_phone_number,
                'warehouse_email_id' => $request->warehouse_email_id,
                'warehouse_address1' => $request->warehouse_address1,
                'warehouse_address2' => $request->warehouse_address2,
                'warehouse_pincode' => $request->warehouse_pincode,
                'warehouse_city' => $request->warehouse_city,
                'warehouse_state' => $request->warehouse_state,
                'bank_account_holder' => $request->bank_account_holder,
                'bank_account_number' => $request->bank_account_number,
                'bank_account_ifsc' => $request->bank_account_ifsc,
                'bank_account_type' => $request->bank_account_type,
                'bank_name' => $request->bank_name,
                'gst_number' => $request->gst_number,
                'brand_name' => $request->brand_name,
                'nature_of_brand' => $request->nature_of_brand,
                'nature_of_business' => $request->nature_of_business,
                
                'working_day' => json_encode($workingDays),
                'working_start_time' => $request->working_start_time,
                'working_close_time' => $request->working_close_time,
            ]);
    
        // Initialize $data array to store file paths
        // Initialize $data array to store file paths
        $data = [];
    
        // List of file fields
        $fileFields = ['gst_certificate', 'govt_id_proof', 'cancelled_cheque', 'trademark_certificate', 'brand_logo'];
        
        // Array to store R2 URLs
        $data = [];
        
        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                
                // Define folder path using seller_id
                $folderPath = "Seller_Details/{$seller->seller_id}";
                
                // Generate a unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Full path in R2 bucket
                $filePath = $folderPath . '/' . $filename;
        
                // Store file in R2 (configured disk named 'r2')
                $file->storeAs($folderPath, $filename, 'r2');
        
                // Generate public URL for Cloudflare R2
                $publicUrl = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $filePath;
                
                // Save public URL to data array
                $data[$fileField] = $publicUrl;
            }
        }
                
        
        
        
        
        
    
        // Update file paths if there are any
        if (!empty($data)) {
            DB::table('sellers')->where('id', $id)->update($data);
            return redirect()->away('https://admin.ohhbuddie.com/product/allseller');

            
        }
    
        return redirect()->away('https://admin.ohhbuddie.com/product/allseller');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
    
    
    public function checkGstNumber(Request $request)
    {
        $gstNumber = $request->query('gst_number');
    
        $exists = DB::table('sellers')->where('gst_number', $gstNumber)->exists();
    
        return response()->json(['exists' => $exists]);
    }
    
    public function checkRegisteredNumber(Request $request)
    {
        $registered_phone_number = '+91' . $request->query('registered_phone_number');
    
        $exists = DB::table('users')->where('phone', $registered_phone_number)->exists();
    
        return response()->json(['exists' => $exists]);

    }
    
    public function checkRegisteredEmail(Request $request)
    {
        $registered_email_id = $request->query('registered_email_id');
    
        $exists = DB::table('sellers')->where('registered_email_id', $registered_email_id)->exists();
    
        return response()->json(['exists' => $exists]);

    }
}
