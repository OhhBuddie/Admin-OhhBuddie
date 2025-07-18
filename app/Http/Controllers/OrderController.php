<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WhatsAppController;
use App\Models\ScheduledWhatsappMessage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Order.index');
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    
    public function allorders()
    {
        $allorders = DB::table('orders')->orderBy('created_at', 'desc')->get();
        
        return view('Order.allorders',compact('allorders'))->with('i');

    }
    
    public function allorderdetails($id)
    {
        $order_id = DB::table('orders')->where('id', $id)->latest()->first();
        $allorder_details = DB::table('orderdetails')->where('order_id',$id)->latest()->get();
        
        $allorderdetails = [];
        
        foreach($allorder_details as $all)
        {
            $dat['id'] = $all->id;
            
            $product_data = DB::table('products')->where('id', $all->product_id)->latest()->first();
            $seller_data = DB::table('sellers')->where('seller_id',$product_data->seller_id)->latest()->first();
            $brand_data = DB::table('brands')->where('id',$product_data->brand_id)->latest()->first();
            $color_data = DB::table('colors')->where('hex_code',$product_data->color_name)->latest()->first();
            
            $images = json_decode($product_data->images, true); 
            
            $dat['images'] = !empty($images) ? $images[0] : null;            
            $dat['product_name'] = $product_data->product_name;
            $dat['sold_by'] = $seller_data->company_name;
            $dat['brand_name'] = $brand_data->brand_name;
            $dat['color'] = $color_data->color_name;
            $dat['size'] = $product_data->size_name;
            $dat['price'] = $all->price;
            $dat['quantity'] = $all->quantity;
            $dat['delivery_status'] = $all->delivery_status;
            $dat['sku'] = $product_data->sku;
            $dat['discount'] = $product_data->maximum_retail_price - $all->price;
            $dat['mrp'] = $product_data->maximum_retail_price;
            $dat['bsp'] = $product_data->bank_settlement_price;
            $dat['sellerpaid'] = $all->seller_paid;

            $allorderdetails[] = $dat;
        }
        
        return view('Order.allorderdetails',compact('allorderdetails','order_id'))->with('i');

    }
    
    public function updateDeliveryStatus(Request $request)
    {
        // return $request;
        
        $orderId = $request->order_id;
        
        $status = $request->delivery_status;
        $phone = $request->phone;
        $name =  $request->name;
        $productname = $request->productname;
        $odr_id = $request->odr_id;
        
        $orderdel = DB::table('orderdetails')->where('id', $orderId)->latest()->first();
        $sellername = DB::table('sellers')->where('seller_id', $orderdel->seller_id )->latest()->first();
        
       
        if($status === 'Delivered'){
            
            if ($phone) {
                // Format phone number if needed
                $phone = preg_replace('/[^0-9]/', '', $phone);
                
                // If phone number doesn't start with country code, add it
                if (strlen($phone) == 10) {
                    $phone = '91' . $phone;
                }
              
                $sellerphone2 = preg_replace('/[^0-9]/', '', $sellername->registered_phone_number);
                // If phone number doesn't start with country code, add it
                if (strlen($sellerphone2) == 10) {
                    $sellerphone2 = '91' . $sellerphone2;
                }
                
             
                ScheduledWhatsappMessage::create([
                        'phone' => $phone,
                        'message' => "Your order has been Delivered successfully!",
                        'name' => $name,
                        'dynamic_id' => 7,
                        'send_after' => now()->addMinutes(60),
                ]);
                    
                    
                // Create a request object for the WhatsApp controller
                $whatsappRequest = new Request([
                    'phone' => $phone,
                    'message' => "Your order has been Delivered successfully!",
                    'name' => $name,
                    'odr_id' => $odr_id,
                    'sellername2' => $sellername->owner_name,
                    'sellerphone2' => $sellerphone2,
                    'odr_id' => $odr_id,
                    'id' => 1
                ]);
                
                // Call WhatsAppController's sendMessage method
                $whatsappController = new WhatsAppController();
                $whatsappController->sendMessage($whatsappRequest);
                
                
                
                // Log success
                Log::info('Delivered Successfull for Phone Number : ' . $phone);
            }
        }
        else if($status === 'Cancelled'){
            
            if ($phone) {
                // Format phone number if needed
                $phone = preg_replace('/[^0-9]/', '', $phone);
                
                // If phone number doesn't start with country code, add it
                if (strlen($phone) == 10) {
                    $phone = '91' . $phone;
                }
              
                
                // Create a request object for the WhatsApp controller
                $whatsappRequest = new Request([
                    'phone' => $phone,
                    'message' => "Your order has been Cancelled successfully!",
                    'name' => $name,
                    'productname' => $productname,
                    'id' => 2
                ]);
                
                // Call WhatsAppController's sendMessage method
                $whatsappController = new WhatsAppController();
                $whatsappController->sendMessage($whatsappRequest);
                
                // Log success
                Log::info('Cancelled for Phone Number : ' . $phone);
            }
        }
        else if($status === 'Out for delivery'){
            
            
            
                $sellerphone2 = preg_replace('/[^0-9]/', '', $sellername->registered_phone_number);
                if (strlen($sellerphone2) == 10) {
                    $sellerphone2 = '91' . $sellerphone2;
                }
              
                
                // Create a request object for the WhatsApp controller
                $whatsappRequest = new Request([
                    
                    'message' => "Your order has been Cancelled successfully!",
                    
                    'odr_id2' => $odr_id,
                    'sellername3' => $sellername->owner_name,
                    'sellerphone3' => $sellerphone2,
                    'id' => 4
                ]);
                
                // Call WhatsAppController's sendMessage method
                $whatsappController = new WhatsAppController();
                $whatsappController->sendMessage($whatsappRequest);
                
                // Log success
                Log::info('Cancelled for Phone Number : ' . $phone);
            
        }
        
        
        $update = DB::table('orderdetails')
                    ->where('id', $orderId)
                    ->update(['delivery_status' => $status]);
    
        if ($update) {
            return response()->json(['success' => true, 'message' => 'Delivery status updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update delivery status.']);
        }
    }
    
    public function updateSellerPaid(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->status;
        $odr_id = $request->odr_id;
        
        $orderdel = DB::table('orderdetails')->where('id', $orderId)->latest()->first();
        $productdata = DB::table('products')->where('id', $orderdel->product_id)->latest()->first();
        $sellername = DB::table('sellers')->where('seller_id', $orderdel->seller_id )->latest()->first();
        
        
        if($status === 'YES'){
            
            $sellerphone2 = preg_replace('/[^0-9]/', '', $sellername->registered_phone_number);
            if (strlen($sellerphone2) == 10) {
                $sellerphone2 = '91' . $sellerphone2;
            }
          
            
            // Create a request object for the WhatsApp controller
            $whatsappRequest = new Request([
                
                'message' => "Your order has been Cancelled successfully!",
                
                'odr_id3' => $odr_id,
                'sellername4' => $sellername->owner_name,
                'sellerphone4' => $sellerphone2,
                'banksettelmentprice' => $productdata->bank_settlement_price,
                'id' => 5
            ]);
            
            // Call WhatsAppController's sendMessage method
            $whatsappController = new WhatsAppController();
            $whatsappController->sendMessage($whatsappRequest);
            
            // Log success

        }
        
    
        DB::table('orderdetails')
            ->where('id', $orderId)
            ->update(['seller_paid' => $status]);
    
        return response()->json(['success' => true]);
    }
    
    public function neworders()
    {
        return view('Order.neworders');
    }
}
