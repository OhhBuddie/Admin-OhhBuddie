<?php

namespace App\Http\Controllers;

use App\Models\Explore;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Men 
        
        $men1 = Storage::disk('s3')->url('Explore/Men/explore cetegories t shirt.jpg');
        $men2 = Storage::disk('s3')->url('Explore/Men/explore cetegories kurta.jpg');
        $men3 = Storage::disk('s3')->url('Explore/Men/explore cetegories bottom.jpg');
        $men4 = Storage::disk('s3')->url('Explore/Men/explore cetegories shoe.jpg');
        $men5 = Storage::disk('s3')->url('Explore/Men/explore cetegories inner.jpg');
        
        // Mens Category
        
        // TopWare
        $mentop1 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/tshirt.jpg');
        $mentop2 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/shirt.jpg');
        $mentop3 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/sweatshirt.jpg');
        $mentop4 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/jacket.jpg');
        $mentop5 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/blazer.jpg');
        $mentop6 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/suit.jpg');
        $mentop7 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/tshirt.jpg');
        $mentop8 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/hoodie.jpg');
        $mentop9 = Storage::disk('s3')->url('Explore/Sub Category/Men/Top/Shackets.jpg');
        
        // Indian
        
        $menindan1 = Storage::disk('s3')->url('Explore/Sub Category/Men/Indian/kurta.jpg');
        $menindan2 = Storage::disk('s3')->url('Explore/Sub Category/Men/Indian/sherwani.jpg');
        $menindan3 = Storage::disk('s3')->url('Explore/Sub Category/Men/Indian/indo western.jpg');
        $menindan4 = Storage::disk('s3')->url('Explore/Sub Category/Men/Indian/nehru.jpg');
        
        // Bottom 
        
        $menbottom1 = Storage::disk('s3')->url('Explore/Sub Category/Men/Bottom/jeans.jpg');
        $menbottom2 = Storage::disk('s3')->url('Explore/Sub Category/Men/Bottom/Trousers.jpg');
        $menbottom3 = Storage::disk('s3')->url('Explore/Sub Category/Men/Bottom/Track Pant.jpg');
        $menbottom4 = Storage::disk('s3')->url('Explore/Sub Category/Men/Bottom/shorts.jpg');
        $menbottom5 = Storage::disk('s3')->url('Explore/Sub Category/Men/Bottom/cargo.jpg');
        
        // Foot
        
        $menfoot1 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/flip.jpg');
        $menfoot2 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/casual.jpg');
        $menfoot3 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/formal.jpg');
        $menfoot4 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/sneakers.jpg');
        $menfoot5 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/sports.jpg');
        $menfoot6 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/lofers.jpg');
        $menfoot7 = Storage::disk('s3')->url('Explore/Sub Category/Men/Foot/socks.jpg');
        
        // Inner
        
        $meninner1 = Storage::disk('s3')->url('Explore/Sub Category/Men/Inner/brief.jpg');
        $meninner2 = Storage::disk('s3')->url('Explore/Sub Category/Men/Inner/boxer.jpg');
        $meninner3 = Storage::disk('s3')->url('Explore/Sub Category/Men/Inner/tanks.jpg');
        $meninner4 = Storage::disk('s3')->url('Explore/Sub Category/Men/Inner/brief.jpg');
        $meninner5 = Storage::disk('s3')->url('Explore/Sub Category/Men/Inner/thermals.jpg');
        $meninner6 = Storage::disk('s3')->url('Explore/Sub Category/Men/Inner/brief.jpg');
        
   
        // Women
        
        $Women1 = Storage::disk('s3')->url('Explore/Women/explore cetegories indian.jpg');
        $Women2 = Storage::disk('s3')->url('Explore/Women/explore cetegories western.jpg');
        $Women3 = Storage::disk('s3')->url('Explore/Women/explore cetegories bottom.jpg');
        $Women4 = Storage::disk('s3')->url('Explore/Women/explore cetegories foot.jpg');
        $Women5 = Storage::disk('s3')->url('Explore/Women/explore cetegories lingerie.jpg');
        $Women6 = Storage::disk('s3')->url('Explore/Women/explore cetegories meternity.jpg');
        
        // Kids
        
        $kids1 = Storage::disk('s3')->url('Explore/Kids/explore cetegories boy.jpg');
        $kids2 = Storage::disk('s3')->url('Explore/Kids/explore cetegories girl.jpg');
        $kids3 = Storage::disk('s3')->url('Explore/Kids/explore cetegories kids infants.jpg');
        $kids4 = Storage::disk('s3')->url('Explore/Kids/explore cetegories kids accessories.jpg');
        
        return view('explore.index', 
        compact('men1','men2','men3','men4','men5',
        'Women1','Women2','Women3','Women4','Women5','Women6',
        'kids1','kids2','kids3','kids4', 
        'mentop1','mentop2','mentop3','mentop4','mentop5','mentop6','mentop7','mentop8','mentop9', 'menindan1','menindan2','menindan3','menindan4',
        'menbottom1', 'menbottom2', 'menbottom3', 'menbottom4','menbottom5', 'menfoot1', 'menfoot2', 'menfoot3', 'menfoot4', 'menfoot5', 'menfoot6', 'menfoot7',
        'meninner1','meninner2','meninner3','meninner4','meninner5','meninner6'
        ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Explore $explore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Explore $explore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Explore $explore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Explore $explore)
    {
        //
    }
}
