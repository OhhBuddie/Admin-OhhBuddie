<?php
// app/Http/Controllers/SalesTagController.php

namespace App\Http\Controllers;

use App\Models\Salestag;
use Illuminate\Http\Request;
use DB;
class SalesTagController extends Controller
{
    public function index()
    {
        $tags = DB::table('salestags')->latest()->get();
        return view('salestags.index', compact('tags'))->with('i');
    }

    public function store(Request $request)
    {
     if (!$request->tag) {
            return redirect()->back()->with('error', 'Tag field is required.');
        }
    
        DB::table('salestags')->insert([
            'tag' => $request->tag,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Tag added.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['tag' => 'required']);
        $tag = Salestag::findOrFail($id);
        $tag->update($request->only('tag'));
        return redirect()->back()->with('success', 'Tag updated.');
    }

    public function destroy($id)
    {
        Salestag::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Tag deleted.');
    }
}
