<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserOtp;
use Twilio\Rest\Client;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\Log;

class AuthOtpController extends Controller
{
    public function login()
    {
        return view('auth.otpLogin');
    }

    public function generate(Request $request)
    {
        
        // Validate the mobile number
        $request->validate([
            'mobile_no' => 'required|numeric|digits:10', // Ensure mobile_no is a 10-digit numeric value
        ]);

        $mobileNo = $request->input('mobile_no');
        $prefixedNumber = '+91' . $mobileNo; // Append +91 for Indian numbers

        // Check if the mobile number exists in the `users` table
        $user = User::where('phone', $prefixedNumber)->first();
        
        // return $prefixedNumber;
        if (!$user) {
            
            $id = DB::table('users')->insertGetId([
                            'phone' => $prefixedNumber,
                            'user_type' => 'Customer',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);


               $user = User::where('id', $id)->first(); 
               $otp = rand(100000, 999999);
            
                    // Save OTP to the database
                    $this->saveOtp($prefixedNumber, $otp);
            
                    // Send OTP via SMS
                    $sendStatus = $this->sendOtpSms($prefixedNumber, $otp);
            
                    if ($sendStatus !== true) {
                        return back()->with('error', 'Failed to send OTP. Please try again.');
                    }
            
            
                    return redirect()->route('otp.verification', ['user_id' => $user->id])
            
                                     ->with('success',  "OTP has been sent on Your Mobile Number."); 
                        
            // return back()->with('error', 'Mobile number not registered.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP to the database
        $this->saveOtp($prefixedNumber, $otp);

        // Send OTP via SMS
        $sendStatus = $this->sendOtpSms($prefixedNumber, $otp);

        if ($sendStatus !== true) {
            return back()->with('error', 'Failed to send OTP. Please try again.');
        }


        return redirect()->route('otp.verification', ['user_id' => $user->id])

                         ->with('success',  "OTP has been sent on Your Mobile Number."); 
    }

    protected function saveOtp($phone, $otp)
    {
        // Delete existing OTPs for the user
        $uid = User::where('phone', $phone)->latest()->first();
        
        // Save the new OTP
        UserOtp::create([
            'user_id' => $uid->id,
            'otp' => $otp,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function sendOtpSms($phone, $otp)
    {
        try {
            $sid = 'ACf0cc3b4153233032c74de604c24c84b2';
            $token = '885ff72dceb4b3702a153d3ea7816423';
            $twilio = new Client($sid, $token);

            $messageBody = "Welcome to ShowLoom: Use One Time Password (OTP) {$otp} to log in to your account. DO NOT SHARE this code with anyone. This code will expire in 5 minutes.";

            $twilio->messages->create($phone, [
                'from' => +19092817841,
                'body' => $messageBody,
            ]);

            return true;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Twilio Error: ' . $e->getMessage());
            return false;
        }
    }
    
        public function verification($user_id)

    {
        return $user_id;
        $mob_no = User::where('id',$user_id)->latest()->first();
        
        $mobile = $mob_no->phone;

        return view('auth.otpVerification')->with([

            'user_id' => $user_id,
            'phone' => $mobile

        ]);

    }
    
        public function loginWithOtp(Request $request)

    {

        /* Validation */

        $request->validate([

            'user_id' => 'required|exists:users,id',

            'otp' => 'required'

        ]);  

  

        /* Validation Logic */

        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

  
        // return $userOtp; 
        $now = now();

        if (!$userOtp) {

            return redirect()->back()->with('error', 'Your OTP is not correct');

        }else if($userOtp && $now->isAfter($userOtp->expire_at)){

            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');

        }

    

        $user = User::whereId($request->user_id)->first();

  

        if($user){

              

            $userOtp->update([

                'expire_at' => now()

            ]);

  

            Auth::login($user);

  

            return redirect('/welcome');

        }

  

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');

    }

    public function logout(Request $request)
    {
        if ($this->guard()->user() != null && ($this->guard()->user()->user_type == 'Admin' || $this->guard()->user()->user_type == 'staff')) {
            $redirect_route = 'login';
        } else {
            $redirect_route = 'home';
        }

        //User's Cart Delete
        // if ($this->guard()->user()) {
        //     Cart::where('user_id', $this->guard()->user()->id)->delete();
        // }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
    }
    
}
