<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use DB;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footers = DB::table('footers')->latest()->get();
        return view('footer.index',compact('footers'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->latest()->get();
        return view('footer.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Footer::create([
            'page' => $request->page,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'sub_subcategory' => $request->sub_subcategory,
            'footer' => $request->footer,
        ]);
    
        return redirect()->back()->with('success', 'Footer saved successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function show(Footer $footer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function edit(Footer $footer)
    {
        $categories = DB::table('categories')->latest()->get();
        return view('footer.edit',compact('categories','footer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Footer $footer)
    {
        // $footer = Footer::findOrFail($id);

        // return $request;
        $footer->update([
            'page' => $request->page,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'sub_subcategory' => $request->sub_subcategory,
            'footer' => $request->footer,
        ]);
    
        return redirect()->back()->with('success', 'Footer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footer $footer)
    {
        //
    }
}
