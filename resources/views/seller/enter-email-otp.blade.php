@extends('seller.layout')

@section('content')
<h1 class="text-center"><b>Enter Email OTP</b></h1><br>
<p class="text-center">We have sent an OTP to your email.</p><br>
<form action="{{ route('seller.submit.email.otp') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="text" name="email_otp" class="form-control text-center" placeholder="Enter OTP" required>
    </div>
    <button type="submit" class="btn btn-danger w-100">Verify</button>
</form><br>
<p class="text-center mt-3 text-muted">
    Didn't receive the OTP? <a href="#">Resend</a>
</p>
@endsection
