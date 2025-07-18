<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = DB::table('cities')->latest()->distinct()->get();
        $state = DB::table('states')->latest()->distinct()->get();

        
        return view('address.index',compact('city','state'));
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
        $address_cnt = DB::table('addresses')->where('user_id',Auth::user()->id)->count();
             
        if($address_cnt == 0)
        {
            $default = 1;
        }
        else{
             $default = 0;
        }

        // Manually override the 'is_default' value if not provided (to ensure it's correct)
         $request->merge(['is_default' => $default]);
    
        // Create a new address record
        $address = Address::create($request->all());
    
        return redirect('/addtocart');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
