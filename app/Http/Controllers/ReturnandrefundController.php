<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ReturnRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Client; // Add this at the top of your controller
use App\Http\Controllers\WhatsAppController;


class ReturnandrefundController extends Controller
{
    /**
     * Show the return form for a specific order and product
     */
    public function index()
    {
        $return_requests = DB::table('orderreturns')->latest()->get();
        
        $refund_data = [];
        
        foreach($return_requests as $returns)
        {
            $product_data = DB::table('products')->where('id',$returns->product_id)->latest()->first();
            $order_data = DB::table('orders')->where('id',$returns->order_id)->latest()->first();
            $seller_data = DB::table('sellers')->where('seller_id',$returns->seller_id)->latest()->first();
            $user_data = DB::table('users')->where('id',$returns->user_id)->latest()->first();


            $retrn['id'] = $returns->id;
            $retrn['seller_id'] = $returns->seller_id;
            $retrn['seller_user_id'] = $returns->seller_user_id;
            $retrn['order_id'] = $order_data->order_id;
            $retrn['product_id'] = $product_data->product_id;
            $retrn['return_reason_category'] = $returns->return_category;
            $retrn['return_reason'] = $returns->return_reason;
            $retrn['status'] = $returns->status;
            $retrn['company_name'] = $seller_data->company_name;
            $retrn['customer'] = $user_data->name;
            // $retrn['return_reason'] = $returns->return_reason;
            
            $refund_data[] = $retrn;
            
        }
        // return $refund_data;

        return view('returnandrefunds.index', compact('refund_data'))->with('i');
    }
    
    public function returndetails($id)
    {

        $return_details = DB::table('orderreturns')->where('id',$id)->latest()->first();
        
        $return_details1 = DB::table('orderreturns')->where('id',$id)->latest()->get();
        
        $orderdetail1 = DB::table('orderdetails')->where('order_id',$return_details->order_id)->latest()->first();
        
        $orderdetail = DB::table('orderdetails')->where('order_id',$return_details->order_id)->where('product_id',$return_details->product_id)->latest()->get();
        
        $productdetail = DB::table('products')->where('id',$orderdetail1->id)->latest()->first();
        
        $order_id = DB::table('orders')->where('id',$orderdetail1->order_id)->latest()->first();
        
        foreach($orderdetail as $all)
        {
            $dat['id'] = $all->id;
            
            $product_data = DB::table('products')->where('id',$all->product_id)->latest()->first();
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

            $allorderdetails[] = $dat;
        }
        
        foreach($return_details1 as $returns)
        {
            $product_data = DB::table('products')->where('id',$returns->product_id)->latest()->first();
            $order_data = DB::table('orders')->where('id',$returns->order_id)->latest()->first();
            $seller_data = DB::table('sellers')->where('seller_id',$returns->seller_id)->latest()->first();
            $user_data = DB::table('users')->where('id',$returns->user_id)->latest()->first();


            $retrn['id'] = $returns->id;
            $retrn['seller_id'] = $returns->seller_id;
            $retrn['seller_user_id'] = $returns->seller_user_id;
            $retrn['order_id'] = $order_data->order_id;
            $retrn['oid'] = $order_data->id;
            $retrn['product_id'] = $product_data->product_id;
            $retrn['return_reason_category'] = $returns->return_category;
            $retrn['return_reason'] = $returns->return_reason;
            $retrn['status'] = $returns->status;
            $retrn['company_name'] = $seller_data->company_name;
            $retrn['customer'] = $user_data->name;
            $retrn['image'] = $returns->image;
            $retrn['refund_source'] = $returns->refund_source;
            $retrn['product_stored'] = $returns->product_stored_in;
            $retrn['pickup_status'] = $returns->pickup_status;
            $retrn['note'] = $returns->note;
            
            $refund_data[] = $retrn;
            
        }
        
        // return $refund_data;
        
        return view('returnandrefunds.returndetails',compact('return_details','orderdetail','productdetail','order_id','allorderdetails','refund_data'));
    }
    
    public function updateRefundStatus(Request $request)
    {
        $returnId = $request->order_id;
        $status = $request->delivery_status;
    
        try {
            

            // Start a database transaction
            DB::beginTransaction();
            
            // Step 1: Update return status - with verbose debug info
            $beforeUpdate = DB::table('orderreturns')->where('id', $returnId)->first();

            $updated = DB::table('orderreturns')
                ->where('id', $returnId)
                ->update(['status' => $status]);
    
            
            $afterUpdate = DB::table('orderreturns')->where('id', $returnId)->first();

    
    
            // Step 2: If status is "Refund Settled", process refund
            if ($status === 'Refund Settled') {
                
                // Get return record with verbose logging
                $return = DB::table('orderreturns')->where('id', $returnId)->first();
               
                // Get order record
                $order = DB::table('orders')->where('id', $return->order_id)->first();
               
                // Get transaction record
                $transaction = DB::table('transactions')->where('order_id', $order->order_id)->first();
                
      
                // Get order details for refund amount
                $orderDetail = DB::table('orderdetails')
                    ->where('order_id', $return->order_id)
                    ->where('product_id', $return->product_id)
                    ->first();
            
                
            
                // Calculate refund amount
                $refundAmount = $orderDetail->price * $orderDetail->quantity;
            
                // Get payment method
                $paymentMethod = $transaction->payment_method ?? ($order->payment_method ?? 'PayU');
            
                // Check if this is a test scenario
                $isTestMode = false;
                if (strpos(strtolower($transaction->txn_id), 'test') !== false || env('APP_ENV') !== 'production') {
                    $isTestMode = true;
                }
                
                try {
                    // Call PayU Refund API
             
                $payuResponse = $this->refundViaPayU($transaction->txn_id, $refundAmount);
                    
                    
                } catch (\Exception $e) {
                    $payuResponse = [
                        'status' => 'failed',
                        'message' => 'PayU API error: ' . $e->getMessage(),
                        'response_data' => null
                    ];
                }
                
            
                // Get current user or fallback
                $userId = Auth::check() ? Auth::id() : ($return->user_id ?? null);
            
                // First check if there's already a refund record to avoid duplicates
                $existingRefund = DB::table('refunds')
                    ->where('return_id', $returnId)
                    ->where('order_id', $order->order_id)
                    ->first();
                    
                if ($existingRefund) {
                    // Update existing record with status "done" if refund is successful
                    $updated = DB::table('refunds')
                        ->where('id', $existingRefund->id)
                        ->update([
                            'payment_method' => $paymentMethod,
                            'amount_refunded' => $refundAmount,
                            'refund_transaction_id' => $payuResponse['request_id'] ?? null,
                            'status' => $payuResponse['status'] === 'success' ? 'done' : 'failed', // Changed to "done" from "initiated"
                            'updated_at' => now()
                        ]);
                        
                } 
                else {
                    // Build refund data with status "done" if refund is successful
                    $refundData = [
                        'return_id' => $returnId,
                        'payment_method' => $paymentMethod,
                        'amount_refunded' => $refundAmount,
                        'paid_amount' => $transaction->amount ?? $refundAmount,
                        'refund_source' => $return->refund_source ?? 'seller',
                        'transaction_id' => $transaction->txn_id,
                        'refund_transaction_id' => $payuResponse['request_id'] ?? null,
                        'status' => $payuResponse['status'] === 'success' ? 'Done' : 'failed', // Changed to "done" from "initiated"
                        'user_id' => $userId ?? 1, // Fallback to admin user if all else fails
                        'order_id' => $order->order_id,
                        'settled_date' => $payuResponse['status'] === 'success' ? now() : null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    
                    try {
                        $refundId = DB::table('refunds')->insertGetId($refundData);
                        
                        
                    } 
                    catch (\Exception $e) {
                        // Try to fix any possible issues with the data
                        foreach ($refundData as $key => $value) {
                            if (is_null($value)) {
                                $refundData[$key] = '';
                            }
                        }
                        
                        try {
                            $refundId = DB::table('refunds')->insertGetId($refundData);
                            
                            
                        } catch (\Exception $e2) {
                            \Log::channel('daily')->error("Failed again to insert refund record: " . $e2->getMessage());
                            // Continue with the transaction, we'll log this error but not fail
                        }
                    }
                    
                    
                    // WHATSAPP MSG FOR REFUND TO USER 
                    
                    $user = DB::table('users')->where('id', $userId)->latest()->first();
        
                    $phone = preg_replace('/[^0-9]/', '', $user->phone);
                    if (strlen($phone) == 10) {
                            $phone = '91' . $phone;
                    }
                                
                    // Now create the WhatsApp request with all seller data
                    $whatsappRequest = new Request([
                        'userphone' => $phone,
                        'message' => "Your order has been confirmed and payment received successfully!",
                        'username' => $user->name,
                        'id' => 6,
                        'oid' => $order->order_id
                    ]);
                    
                    $whatsappController = new WhatsAppController();
                    $whatsappController->sendMessage($whatsappRequest);
        
                    // WHATSAPP MSG FOR REFUND TO USER END
                        
                    
                    
                    
                }
            
                // Try to update orderreturns table with refund info (add columns if they don't exist)
                try {
                    
                    $refundUpdateData = [
                        'refund_status' => $payuResponse['status'] ?? 'unknown',
                        'refunded_at' => now()
                    ];
                    
                    // Only add this field if it exists to avoid SQL errors
                    if (Schema::hasColumn('orderreturns', 'refund_response')) {
                        $refundUpdateData['refund_response'] = json_encode($payuResponse['response_data'] ?? $payuResponse);
                    }
                    
                    DB::table('orderreturns')
                        ->where('id', $returnId)
                        ->update($refundUpdateData);
                    
                } catch (\Exception $e) {
                    \Log::channel('daily')->error("Failed to update orderreturns with refund info: " . $e->getMessage());
                    // We'll continue anyway and not fail the whole transaction for this
                }
            
                // Handle response to client
                if ($payuResponse['status'] === 'success' || $isTestMode) {
                    DB::commit();
                    return response()->json(['success' => true, 'message' => 'Refund processed successfully.']);
                } else {
                    DB::commit(); // Still commit to save failure record
                    return response()->json([
                        'success' => false,
                        'message' => 'Refund failed: ' . ($payuResponse['message'] ?? 'Unknown error.')
                    ]);
                }
            }
            
            
            
    
    
    
    
    
    
    
            // If not a refund status change, just commit and return success
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully!'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false, 
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
    
            
      
    
    private function refundViaPayU($txnId, $amount)
    {
      
      
        $merchantKey = '1maOcq'; // Merchant Key
        $merchantSalt = 'I9Pp40tbHr5qlKgzU7Lt2U1QgGTcprGp'; // Merchant Salt
        $apiUrl = 'https://info.payu.in/merchant/postservice.php?form=2'; // Correct Production refund URL

        $txnId = $txnId; 
        $amount =  $amount;
        
        
        $token = time() . rand(100, 999); // Unique integer token for the refund
        $refundReason = 'Customer request'; // Change this as needed
        
        $amount = number_format((float)$amount, 2, '.', '');
        
        // Generate the hash
        $hashString = $merchantKey . '|' . 'cancel_refund_transaction' . '|' . $txnId . '|' . $merchantSalt;
        $hash = strtolower(hash('sha512', $hashString));
        
        // Prepare the payload
        $payload = [
            'key' => $merchantKey,
            'command' => 'cancel_refund_transaction',
            'var1' => $txnId,
            'var2' => $token,
            'var3' => $amount,
            'hash' => $hash
        ];
        
        try {
            
            
            $client = new Client();
        
            $response = $client->post($apiUrl, [
                'form_params' => $payload,
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);
        
            $responseBody = json_decode($response->getBody(), true);
        
            Log::channel('daily')->info("PayU Refund Response:", ['response' => $responseBody]);
        
            if (isset($responseBody['status']) && $responseBody['status'] == 1) {
                
                return [
                    'status' => 'success',
                    'message' => $responseBody['msg'] ?? 'Refund successful',
                    'token' => $token,
                    'response_data' => $responseBody
                ];
                
            } else {
                
                
                return [
                    'status' => 'failed',
                    'message' => $responseBody['msg'] ?? 'Refund failed. Check PayU logs.',
                    'token' => $token,
                    'response_data' => $responseBody
                ];
            }
            
            
            
            
            
        } catch (\Exception $e) {
            Log::channel('daily')->error("PayU Refund Exception", ['error' => $e->getMessage()]);
        
            return [
                'status' => 'failed',
                'message' => 'Exception: ' . $e->getMessage(),
                'token' => $token,
                'response_data' => null
            ];
        }
    
    }
    
    
    
    
       /**
         * Process refund via PayU payment gateway
         * 
         * @param string $txnId Original transaction ID from PayU
         * @param float $amount Amount to refund
         * @return array Response with status and data
         */
        // private function refundViaPayU($txnId, $amount)
        // {
        //     // PayU API Configuration
        //     $merchantKey = '1maOcq';
        //     $merchantSalt = 'I9Pp40tbHr5qlKgzU7Lt2U1QgGTcprGp';
        
        //     // API URL for both production and test
        //     $apiUrl = 'https://info.payu.in/merchant/postservice.php?form=2';
            
        //     // Generate unique request ID for this refund
        //     $requestId = uniqid('REFUND_');
            
        //     // Format the amount properly (no trailing zeros)
        //     $amount = number_format((float)$amount, 2, '.', '');
            
        //     // Create request payload
        //     $payload = [
        //         'key' => $merchantKey,
        //         'command' => 'cancel_refund_transaction',
        //         'var1' => $txnId,         // Original PayU transaction ID
        //         'var2' => $requestId,     // Unique refund ID (for your reference)
        //         'var3' => $amount         // Refund amount
        //     ];
            
        //     // Generate hash for PayU India format
        //     $hashSequence = "key|command|var1|var2|var3";
        //     $hashVarsSeq = explode('|', $hashSequence);
        //     $hash_string = '';
            
        //     foreach ($hashVarsSeq as $hash_var) {
        //         $hash_string .= isset($payload[$hash_var]) ? $payload[$hash_var] : '';
        //         $hash_string .= '|';
        //     }
            
        //     $hash_string .= $merchantSalt;
        //     $payload['hash'] = strtolower(hash('sha512', $hash_string));
            
        //     // Log the request for debugging
        //     $logPayload = $payload;
        //     $logPayload['hash'] = substr($logPayload['hash'], 0, 10) . '...'; // Don't log the full hash
        //     \Log::channel('daily')->info("PayU Refund Request: ", $logPayload);
            
        //     try {
        //         // Make API call using Guzzle or cURL
        //         $client = new \GuzzleHttp\Client();
        //         $response = $client->post($apiUrl, [
        //             'form_params' => $payload,
        //             'headers' => [
        //                 'Content-Type' => 'application/x-www-form-urlencoded'
        //             ]
        //         ]);
                
        //         // Parse response
        //         $responseBody = json_decode($response->getBody(), true);
        //         \Log::channel('daily')->info("PayU Refund Response: ", $responseBody);
                
        //         // Check for refund status - PayU India format
        //         if (isset($responseBody['status']) && $responseBody['status'] == 1) {
        //             return [
        //                 'status' => 'success',
        //                 'message' => 'Refund processed successfully',
        //                 'request_id' => $requestId,
        //                 'response_data' => $responseBody
        //             ];
        //         } else {
        //             return [
        //                 'status' => 'failed',
        //                 'message' => $responseBody['msg'] ?? $responseBody['error'] ?? 'Unknown error from PayU',
        //                 'request_id' => $requestId,
        //                 'response_data' => $responseBody
        //             ];
        //         }
        //     } catch (\Exception $e) {
        //         \Log::channel('daily')->error("PayU Refund API Error: " . $e->getMessage());
                
        //         return [
        //             'status' => 'failed',
        //             'message' => 'API Error: ' . $e->getMessage(),
        //             'request_id' => $requestId,
        //             'response_data' => null
        //         ];
        //     }
        // }
            
    // private function refundViaPayU($txnId, $amount)
    // {
      
    //     $merchantKey = '1maOcq'; // Merchant Key
    //     $merchantSalt = 'I9Pp40tbHr5qlKgzU7Lt2U1QgGTcprGp'; // Merchant Salt
    //     $apiUrl = 'https://secure.payu.in/merchant/postservice?form=2'; // Correct Production refund URL

    //     $requestId = uniqid('REFUND_'); // Generate a unique request ID
        
    //     $txnId = $txnId; // The original transaction ID (replace this with actual value)
    //     $amount =  $amount; // The refund amount (replace this with actual value)

    //     // Ensure that the amount is formatted correctly
    //     $amount = number_format((float)$amount, 2, '.', '');

    //     // Prepare the payload
    //     $payload = [
    //         'key' => $merchantKey, // Merchant Key
    //         'command' => 'cancel_refund_transaction', // The command to perform the refund
    //         'var1' => $txnId, // Original Transaction ID
    //         'var2' => $requestId, // Unique Request ID
    //         'var3' => $amount, // Refund amount
    //     ];

    //     // Generate the hash string correctly
    //     $hashString = $payload['key'] . '|' . $payload['command'] . '|' . $payload['var1'] . '|' . $payload['var2'] . '|' . $payload['var3'] . '|' . $merchantSalt;
    //     $payload['hash'] = strtolower(hash('sha512', $hashString));

    //     try {
    //         $client = new Client(); // GuzzleHttp Client

    //         // Send the POST request
    //         $response = $client->post($apiUrl, [
    //             'form_params' => $payload,
    //             'headers' => ['Content-Type' => 'application/x-www-form-urlencoded']
    //         ]);

    //         // Decode the response body
    //         $responseBody = json_decode($response->getBody(), true);

    //         // Log the full response for debugging
    //         Log::channel('daily')->info("PayU Refund Response:", ['response' => $responseBody]);

    //         // Check if the response indicates a successful refund
    //         if (isset($responseBody['status']) && $responseBody['status'] == 1) {
    //             return [
    //                 'status' => 'success',
    //                 'message' => $responseBody['msg'] ?? 'Refund successful',
    //                 'request_id' => $requestId,
    //                 'response_data' => $responseBody
    //             ];
    //         } else {
    //             return [
    //                 'status' => 'failed',
    //                 'message' => $responseBody['msg'] ?? 'Refund failed. Please check PayU logs for more details.',
    //                 'request_id' => $requestId,
    //                 'response_data' => $responseBody
    //             ];
    //         }

    //     } catch (\Exception $e) {
    //         // Log the exception
    //         Log::channel('daily')->error("PayU Refund Exception", ['error' => $e->getMessage()]);

    //         return [
    //             'status' => 'failed',
    //             'message' => 'Exception: ' . $e->getMessage(),
    //             'request_id' => $requestId,
    //             'response_data' => null
    //         ];
    //     }
    
    // }
   
    
    
    
//   private function refundViaPayU($transactionId, $amount)
// {
//     $merchantKey = '1maOcq';
//     $merchantSalt = 'I9Pp40tbHr5qlKgzU7Lt2U1QgGTcprGp';
//     $isTestMode = false; // Make sure it's false for live transactions
    
//     $endpoint = 'https://info.payu.in/merchant/postservice.php?form=2';
    
//     if ($isTestMode) {
//         $endpoint = 'https://test.payu.in/merchant/postservice.php?form=2';
//     }
    
//     $command = 'cancel_refund_transaction';
    
//     // Build request data with all required parameters
//     $postData = [
//         'key' => $merchantKey,
//         'command' => $command,
//         'var1' => $transactionId, // PayU transaction ID
//         'var2' => $amount, // Refund amount
//         'var3' => 'Auto refund via system', // Refund reason
//     ];
    
//     // Generate hash according to PayU documentation for cancel_refund_transaction
//     // Format should be: key|command|var1|var2|var3|salt
//     $hashString = $merchantKey . '|' . $command . '|' . $postData['var1'] . '|' . $postData['var2'] . '|' . $postData['var3'] . '|' . $merchantSalt;
//     $hash = strtolower(hash('sha512', $hashString));
//     $postData['hash'] = $hash;
    
//     // Log the request for debugging
//     \Log::info('PayU Refund Request', ['request' => $postData, 'endpoint' => $endpoint]);
    
//     // Skip API call if test mode is enabled and not in production
//     if ($isTestMode && env('APP_ENV') !== 'production') {
//         return [
//             'status' => 'success',
//             'request_id' => 'TEST_' . time(),
//             'message' => 'Test refund initiated successfully',
//             'response_data' => [
//                 'status' => 1,
//                 'msg' => 'Test refund initiated',
//                 'request_id' => 'TEST_' . time()
//             ]
//         ];
//     }
    
//     try {
//         // Make the API call with timeout
//         $response = Http::timeout(30)
//             ->withHeaders([
//                 'Content-Type' => 'application/x-www-form-urlencoded'
//             ])
//             ->asForm()
//             ->post($endpoint, $postData);
        
//         // Get raw response and log it
//         $responseBody = $response->body();
//         \Log::info('PayU Refund Response', ['raw' => $responseBody]);
        
//         // PayU sometimes returns responses in different formats
//         // First try to parse as JSON
//         $responseData = json_decode($responseBody, true);
        
//         // If not valid JSON, try to handle as other format
//         if (json_last_error() !== JSON_ERROR_NONE) {
//             // Some PayU responses might be pipe-separated or have different formats
//             if (strpos($responseBody, 'status=1') !== false) {
//                 // Simulate a successful response structure
//                 $responseData = [
//                     'status' => 1,
//                     'msg' => 'Refund initiated successfully',
//                     'request_id' => 'EXTRACTED_' . time()
//                 ];
//             } else {
//                 return [
//                     'status' => 'failed',
//                     'message' => 'Unable to parse payment gateway response',
//                     'response_data' => ['raw_response' => $responseBody]
//                 ];
//             }
//         }
        
//         // Check response status according to PayU docs
//         if (isset($responseData['status']) && $responseData['status'] == 1) {
//             return [
//                 'status' => 'success',
//                 'request_id' => $responseData['request_id'] ?? null,
//                 'message' => $responseData['msg'] ?? 'Refund initiated successfully',
//                 'response_data' => $responseData
//             ];
//         } else {
//             $errorMsg = $responseData['msg'] ?? 'Unknown error from payment gateway';
//             return [
//                 'status' => 'failed',
//                 'message' => $errorMsg,
//                 'error_code' => $responseData['error_code'] ?? null,
//                 'response_data' => $responseData
//             ];
//         }
//     } catch (\Exception $e) {
//         \Log::error('PayU Refund Exception', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
//         return [
//             'status' => 'failed',
//             'message' => 'Payment gateway connection error: ' . $e->getMessage(),
//             'response_data' => ['exception' => $e->getMessage()]
//         ];
//     }
// }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function updateProductstored(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->product_stored;
        
        $update = DB::table('orderreturns')
                    ->where('id', $orderId)
                    ->update(['product_stored_in' => $status]);
    
        if ($update) {
            return response()->json(['success' => true, 'message' => 'Delivery status updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update Stored status.']);
        }
    }
    
    public function updatePickupStatus(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->pickup_status;
        
        $update = DB::table('orderreturns')
                    ->where('id', $orderId)
                    ->update(['pickup_status' => $status]);
    
        if ($update) {
            return response()->json(['success' => true, 'message' => 'Delivery status updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update Pickup status.']);
        }
    }
    
    
    public function updateNote(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orderreturns,id',
            'note' => 'nullable|string|max:255',
            'status_key' => 'required|string',
        ]);
    
        $order = DB::table('orderreturns')->where('id', $request->order_id)->first();
    
        // Decode existing notes or initialize empty array
        $existingNotes = json_decode($order->note, true) ?? [];
    
        // Count how many times this status_key already exists (with suffixes)
        $similarKeys = array_filter(array_keys($existingNotes), function($key) use ($request) {
            return strpos($key, $request->status_key) === 0;
        });
    
        $nextIndex = count($similarKeys) + 1;
        $keyWithIndex = $request->status_key . ' #' . $nextIndex;
    
        // Save the note under that new key
        // $existingNotes[$keyWithIndex] = $request->note;
    
        $existingNotes[$keyWithIndex] = [
            'note' => $request->note,
            'timestamp' => now()->toDateTimeString()
        ];
    
        // Save updated JSON
        DB::table('orderreturns')
            ->where('id', $request->order_id)
            ->update([
                'note' => json_encode($existingNotes),
            ]);
    
        return back()->with('success', 'Note saved under key: ' . $keyWithIndex);
    }

    

}