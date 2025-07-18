<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $warehouseId = DB::table('warehouses')->insertGetId([
            'seller_id' => $request->input('seller_id'),
            'warehouse_phone_number' => $request->input('warehouse_phone_number'),
            'warehouse_email' => $request->input('warehouse_email'),
            'warehouse_address1' => $request->input('warehouse_address1'),
            'warehouse_address2' => $request->input('warehouse_address2'),
            'warehouse_pincode' => $request->input('warehouse_pincode'),
            'warehouse_city' => $request->input('warehouse_city'),
            'warehouse_state' => $request->input('warehouse_state'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Return response
        // return response()->json([
        //     'message' => 'Warehouse added successfully!',
        //     'warehouse_id' => $warehouseId
        // ], 201);
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
