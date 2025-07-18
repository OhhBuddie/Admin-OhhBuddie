@extends('layouts.account')
@section('content')
    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
 <style>
 
    body {
        background-color: #f0f2f5;
        font-family: sans-serif;
        color: black;
    }

    a {
        text-decoration: none;
    }

    .profile-container {
        max-width: 400px;
        margin: 20px auto;
        background: #393e46;
        padding: 20px;
        height:510px;
        
    }
    
    .profile-container1 {
        max-width: 400px;
        margin: 20px auto;
        background: #393e46;
        padding: 11px 20px;
        height: 104px ;
    }

    .list-group-item {
        font-size: 16px;
        padding: 8px 6px;
        border: none; /* Removes the border lines */
        display: flex;
        align-items: center;
        background-color:#393e46;
 
        justify-content: space-between;
        position: relative; /* For better control over icon placement */
    }

    .list-group-item i {
        font-size: 18px;
        margin-right: 0; /* Remove unnecessary margin */
        margin-left: -8px; /* Push icon further to the left */
        color: white;
    }

    .list-group-item a {
        flex-grow: 1;
        padding-left: 12px; /* Add padding between icon and text */
        color: white;
        text-decoration: none;
    }

    .list-group-item .bi-chevron-right {
        margin-left: auto; /* Moves the chevron to the far right */
        font-size: 16px;
        color: white;
    }

    .logout-btn {
        background-color: #efc475;
        color: black;
        border-radius: 6px;
        height: 40px;
    }

    .logout-btn:hover {
        background-color: var(--secondary-color);
    }

    .flex-grow-1 {
        color: black;
    }

    /* Cover photo styling */
    .cover-photo {
        width: 100%;
        height: 200px;
        overflow: hidden;
        margin-top: -60px;
        object-fit: fill;
    }

    .cover-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Profile header styling */
    .profile-header {
        background-color: black;
        padding: 20px;
        margin-top: -80px;
        height: 200px; /* Slight overlap with the cover photo */
    }

    .profile-header img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid black; /* To highlight the profile picture */
    }

    .profile-header p {
        font-size: 16px;
        margin-top: -2px;
        color: white;
    }
    
    .row{
        background: #1f1f1f;
    }
</style>

 <div class="cover-photo">
    <img src="{{ asset('public/assets/images/banners/cover_photo.jpg') }}" alt="Cover Photo" class="cover-img">
 </div>
 
<div class="profile-header text-center">
    <!--<img src="https://cdn-icons-png.flaticon.com/512/3607/3607444.png" alt="User Profile" class="rounded-circle mb-2">-->
    <img src="{{ asset(Auth::user()->profile_photo) }}">
    <!-- Edit Icon -->
    <a href="/profileedit/{{Auth()->user()->id}}" class="position-absolute" 
       style="color: white;
    right: 157px;
    background-color: #1f1f1f;
    border-radius: 50%;
    padding: 5px;
    top: 169px;">
        <i class="fas fa-edit"></i> <!-- FontAwesome Edit Icon -->
    </a>

    <p style="margin-botton:none;">{{Auth::user()->name}}</p>
    <p>{{Auth::user()->email}}</p>
</div>


<div class="profile-container1">
    <ul class="list-group">
        <li class="list-group-item">
            <i class="bi bi-basket"></i>
            <a href="#" class="flex-grow-1">Orders</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-box-seam"></i>
            <a href="#" class="flex-grow-1">Tryout Orders</a>
            <i class="bi bi-chevron-right"></i>
        </li>
    </ul>
</div>

<div class="profile-container">
    <ul class="list-group">
        <li class="list-group-item">
            <i class="bi bi-heart"></i>
            <a href="#" class="flex-grow-1">Wishlist</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-geo-alt"></i>
            <a href="/address" class="flex-grow-1">Addresses</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-wallet"></i>
            <a href="#" class="flex-grow-1">Wallet</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-ticket"></i>
            <a href="#" class="flex-grow-1">Support Ticket</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-chat-dots"></i>
            <a href="#" class="flex-grow-1">Feedback & Suggestions</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-question-circle"></i>
            <a href="#" class="flex-grow-1">FAQs</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-info-circle"></i>
            <a href="#" class="flex-grow-1">About Us</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-file-earmark-text"></i>
            <a href="#" class="flex-grow-1">Terms of Use</a>
            <i class="bi bi-chevron-right"></i>
        </li>
        <li class="list-group-item">
            <i class="bi bi-shield-lock"></i>
            <a href="#" class="flex-grow-1">Privacy Policy</a>
            <i class="bi bi-chevron-right"></i>
        </li>
    </ul>
    <div class="text-center mt-4">
        <a href="/logout" class="btn logout-btn w-100" style="font-size:20px;">Logout</a>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection