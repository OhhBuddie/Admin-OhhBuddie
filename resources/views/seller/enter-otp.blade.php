@extends('seller.layout')

@section('content')
<h1 class="text-center"><b>Enter OTP</b></h1><br>
<p class="text-center">We have sent an OTP to your mobile number.</p><br>
<form action="{{ route('seller.submit.otp') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="number" maxlength="6" name="otp" class="form-control text-center" placeholder="Enter OTP" required>
    </div>
    <button type="submit" class="btn btn-danger w-100">Verify</button>
</form>
<p class="text-center mt-3 text-muted"><br>
    Didn't receive the OTP? <a href="#">Resend</a>
</p>
@endsection
