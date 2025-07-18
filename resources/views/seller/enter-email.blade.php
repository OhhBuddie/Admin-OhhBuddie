@extends('seller.layout')

@section('content')
<h1 class="text-center"><b>Enter Email</b></h1><br>
<p class="text-center">Please enter your email address.</p><br>
<form action="{{ route('seller.submit.email') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
    </div><br>
    <button type="submit" class="btn btn-danger w-100">Continue</button>
</form>
@endsection
