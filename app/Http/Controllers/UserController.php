<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use DB;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
        return view('user.profile_edit');
    }

    public function nameupdate(Request $request)
    {
        // Ensure user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
    
            // If user_id is not already set, generate a new unique user_id
            if (empty($user->user_id)) {
                // Fetch the last user_id from the database
                $lastUser = DB::table('users')->whereNotNull('user_id')->orderBy('id', 'desc')->first();
    
                if ($lastUser && preg_match('/OBD-(\d+)/', $lastUser->user_id, $matches)) {
                    $nextNumber = str_pad($matches[1] + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '1000'; // Start from OBD-0001
                }
    
                $newUserId = 'OBD-' . $nextNumber;
    
                // Update both name and user_id
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'name' => $request->name,
                        'user_id' => $newUserId,
                        'user_type' => 'Customer',
                    ]);
            } else {
                // Only update the name if user_id already exists
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['name' => $request->name]);
            }
        }
    
        return back()->with('success', 'Name updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     DB::table('users')
    //     ->where('id', $id)
    //     ->update([
            
    //         'email' => $request->email,
    //         'profile_photo' => $request->profile_photo,
    //         'gender' => $request->gender,
    //         'dob' => $request->dob,
    //      ]); // Correct update syntax
         
    //     return redirect('/account')->with('success', 'Profile updated successfully.');

    // }


    public function update(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
    
        // Validate the input fields
        $request->validate([
            'email' => 'required|email',
            'dob' => 'required|date',
            'gender' => 'required',
            'name' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);
    
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filepath = 'uploads/profile_photos/';
    
            // Store the file in public/storage/uploads/profile_photos
            $filePath = $file->storeAs($filepath, $filename, 'public');
    
            // Set new file path in DB
            $profile_photo = 'public/storage/' . $filePath;
        } else {
            // Keep the old profile photo if no new file is uploaded
            $profile_photo = $user->profile_photo;
        }
    
        // Update user record
        DB::table('users')->where('id', $id)->update([
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'name' => $request->name,
            'profile_photo' => $profile_photo,
        ]);
    
        return redirect('/account')->with('success', 'Profile updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
