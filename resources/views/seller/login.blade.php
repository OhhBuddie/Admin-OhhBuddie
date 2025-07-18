@extends('seller.layout')

@section('content')

<h1 class="text-center"><b>Login/SignUp</b></h1><br>
<p class="text-center">Turn Your Passion into Profits, Start Selling Fashion Online!.</p><br>
<form action="{{ route('seller.submit.phone') }}" method="POST">
    @csrf
    <div class="input-group mb-3" style="border: 1px solid #ced4da; border-radius: 5px; overflow: hidden;">
        <span class="input-group-text bg-white border-0">
            <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" width="24" height="16" alt="Indian Flag" class="me-1">
            +91
            <input type="text" name="phone" class="form-control border-0" placeholder="Enter Mobile Number" required pattern="[0-9]{10}" maxlength="10">
        </span>
        
    </div><br>
    <button type="submit" class="btn btn-danger w-100" style="background-color: #EFC475; border:none">Continue</button>
</form>

@endsection