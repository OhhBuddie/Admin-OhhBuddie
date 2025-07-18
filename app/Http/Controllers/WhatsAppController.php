<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
    

        $token = 'EAAS6NxQsZCfkBOxJBjShCSZBH6h6Oxy72mW1ssiefQxuIKI62iijYi1rZBBRliL4Xr6RgrqsMS4afNKQ9flpaGMDeh6X7zF0UagqFRjjJ3VazfLwqncMWPL42TjpCChKdgPoeYsbis6VNMp1jnSIWTjji6A3hyulMjKFzNlq8YANi98b2EnhUhDqA1mNqIRxQZDZD';
        $phone_number_id = '648701208316154';

        $to = $request->input('phone');
        $message = $request->input('message');
        $customerName = $request->input('name');
        $id = $request->input('id');
        $productname = $request->productname; 
        
        $sellerphone = $request->sellerphone;
        $sellername = $request->sellername;
        $sellerlocation = $request->sellerlocation;
        $sellercompanyname = $request->sellercompanyname;
        
        
        $sellername2 = $request->sellername2;
        $sellerphone2 = $request->sellerphone2;
        $odr_id = $request->odr_id;
        
        $sellername3 = $request->sellername3;
        $sellerphone3 = $request->sellerphone3;
        $odr_id2 = $request->odr_id2;
        
        $banksettelmentprice = $request->banksettelmentprice;
        $odr_id3 = $request->odr_id3;
        $sellername4 = $request->sellername4;
        $sellerphone4 = $request->sellerphone4;
        
        $adminData = $request->adminData;
        
        
        $userphone = $request->userphone;
        $username = $request->username;
        $oid = $request->oid;
        
        // Log the request details
        Log::info('WhatsApp API Request', [
            'to' => $to,
            'message' => $message,
            'phone_number_id' => $phone_number_id
        ]);

        $url = "https://graph.facebook.com/v19.0/$phone_number_id/messages";

 
    if($id === 1){
                $response = Http::withToken($token)->post($url, [
                    'messaging_product' => 'whatsapp',
                    'to' => $to,
                    'type' => 'template',
                    'template' => [
                        'name' => 'order_delivered',
                        'language' => ['code' => 'en'],
                        'components' => [
                            [
                                'type' => 'header',
                                'parameters' => [
                                    [
                                        'type' => 'image',
                                        'image' => [
                                            'id' => '1051096973536626'
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'body',
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $customerName  // This will replace {{1}} in your template
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
                
                Http::withToken($token)->post($url, [
                    'messaging_product' => 'whatsapp',
                    'to' => $sellerphone2,
                    'type' => 'template',
                    'template' => [
                        'name' => 'slr_order_delivered',
                        'language' => ['code' => 'en'],
                        'components' => [
                            
                            [
                                'type' => 'body',
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $sellername2  // This will replace {{1}} in your template
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $odr_id  // This will replace {{1}} in your template
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
                
                
                
                
                
    }
    elseif($id === 2)
    {
        $response = Http::withToken($token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => 'order_cancelled', // Use your actual template name as shown in WhatsApp Business
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'header',
                        'parameters' => [
                            [
                                'type' => 'image',
                                'image' => [
                                    'id' => '1211160426691134'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $customerName  // This will replace {{1}} in your template
                            ],
                            [
                                'type' => 'text',
                                'text' => $productname  // This will replace {{1}} in your template
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
    elseif($id === 3)
    {
        $response = Http::withToken($token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $sellerphone,
            'type' => 'template',
            'template' => [
                'name' => 'slr_registration', // Use your actual template name as shown in WhatsApp Business
                'language' => ['code' => 'en'],
                'components' => [
                    
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $sellername  // This will replace {{1}} in your template
                            ]
                        ]
                    ]
                ]
            ]
        ]);
        
        
        foreach ($adminData as $admin) {
            // Extract data for this specific seller
            $adminrname = $admin['adminname'];
            $adminnumber = $admin['adminnumber'];
            
            
            // Send WhatsApp message to this seller
            $response = Http::withToken($token)->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $adminnumber,
                'type' => 'template',
                'template' => [
                    'name' => 'adm_seller_onboard',
                    'language' => ['code' => 'en'],
                    'components' => [
                        [   // This opening bracket was missing
                            'type' => 'body',
                            'parameters' => [
                                ['type' => 'text', 'text' => $adminrname],
                                ['type' => 'text', 'text' => $sellername],
                                ['type' => 'text', 'text' => $sellerlocation],
                                ['type' => 'text', 'text' => $sellercompanyname ]
                            ]
                        ]   // This closing bracket was missing
                    ]
                ]
            ]);
        
        }
    }
    elseif($id === 4)
    {
        $response = Http::withToken($token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $sellerphone3,
            'type' => 'template',
            'template' => [
                'name' => 'slr_on_the_way_to_pick_up', // Use your actual template name as shown in WhatsApp Business
                'language' => ['code' => 'en'],
                'components' => [
                    
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $sellername3  // This will replace {{1}} in your template
                            ],
                            [
                                'type' => 'text',
                                'text' => $odr_id2  // This will replace {{1}} in your template
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
    elseif($id === 5)
    {
        $response = Http::withToken($token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $sellerphone4,
            'type' => 'template',
            'template' => [
                'name' => 'slr_payment', // Use your actual template name as shown in WhatsApp Business
                'language' => ['code' => 'en'],
                'components' => [
                    
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $sellername4  // This will replace {{1}} in your template
                            ],
                            [
                                'type' => 'text',
                                'text' => $banksettelmentprice  // This will replace {{1}} in your template
                            ],
                            [
                                'type' => 'text',
                                'text' => $odr_id3  // This will replace {{1}} in your template
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
    elseif($id === 6)
    {
        $response = Http::withToken($token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $userphone,
            'type' => 'template',
            'template' => [
                'name' => 'user_refund_update', // Use your actual template name as shown in WhatsApp Business
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'header',
                        'parameters' => [
                            [
                                'type' => 'image',
                                'image' => [
                                    'id' => '1250240049960988'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $username  // This will replace {{1}} in your template
                            ],
                            [
                                'type' => 'text',
                                'text' => $oid  // This will replace {{1}} in your template
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
    
    elseif($id === 7){
        
                
                Http::withToken($token)->post($url, [
                    'messaging_product' => 'whatsapp',
                    'to' => $to,
                    'type' => 'template',
                    'template' => [
                        'name' => 'product_feedback_2',
                        'language' => ['code' => 'en'],
                        'components' => [
                            [
                                'type' => 'header',
                                'parameters' => [
                                    [
                                        'type' => 'image',
                                        'image' => [
                                            'id' => '1770987916816199'
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'type' => 'body',
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $customerName  // This will replace {{1}} in your template
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
                
                
    }
    
    
    
    
    



        // $response = Http::withToken($token)->post($url, [
        //     'messaging_product' => 'whatsapp',
        //     'to' => $to,
        //     'type' => 'template',
        //     'template' => [
        //         'name' => 'opening_sale_2025',
        //         'language' => ['code' => 'en'],
        //         'components' => [
        //             [
        //                 'type' => 'header',
        //                 'parameters' => [
        //                     [
        //                         'type' => 'image',
        //                         'image' => [
        //                             'link' => 'https://fileinfo.com/img/ss/xl/jpg_44-2.jpg' // <-- your image URL
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //         ]
        //     ]
        // ]);
        
        
        // Log the full response
        Log::info('WhatsApp API Response', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json()
        ]);

        if ($response->successful()) {
            return response()->json([
                'status' => 'Message sent successfully!', 
                'response' => $response->json() // Include the actual API response
            ]);
        } else {
            return response()->json([
                'status' => 'Failed to send message',
                'error' => $response->json()
            ], 500);
        }
    }

    public function verifyWebhook(Request $request)
    {
        $verify_token = 'ohh!buddie-website-042025'; // EXACT match
    
        $mode = $request->query('hub_mode');
        $token = $request->query('hub_verify_token');
        $challenge = $request->query('hub_challenge');
    
        if ($mode === 'subscribe' && $token === $verify_token) {
            return response($challenge, 200);
        } else {
            return response('Forbidden', 403);
        }
    }
    
    public function handleWebhook(Request $request)
    {
        Log::info('Incoming webhook:', $request->all());
    
        // You can customize this to react to messages/events
        return response()->json(['status' => 'received'], 200);
    }

    public function handle(Request $request)
    {
    // WhatsApp verification step
    if ($request->get('hub_mode') === 'subscribe' && 
        $request->get('hub_verify_token') === 'Local-Machine-Token-ohhbuddie2025') {
        
        return response($request->get('hub_challenge'), 200);
    }

    // Log actual messages/events after webhook is verified
    Log::info('Webhook event:', $request->all());

    return response('OK', 200);
    }

}