<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Ohbuddielogo.png" />

    <title>OhhBuddie | Seller-Login</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,300,200,700");
 body {
	 margin: 0;
	 background-color: white;
	 font-family: Poppins, "Helvetica Neue", sans-serif;
}
 .error-message {
	 color: #f22;
}
 .bg {
	 /*background-image: linear-gradient(to right bottom, #9a9a9a, #848484, #6f6f6f, #5a5a5a, #464646, #3b3b3b, #303030, #252525, #1f1f1f, #191919, #141414, #0c0c0c);*/
	 background-size: 400% 400%;
	 animation: gradient 15s ease infinite;
}
 .columns {
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 min-height: 100vh;
	 max-height: 100vh;
	 background-image: url('https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Seller/loginbackground.jpg');
	 background-size: contain;
	 background-repeat: no-repeat;
	 animation-name: MOVE-BG;
	 animation-duration: 2s;
	 animation-timing-function: linear;
	 animation-iteration-count: infinite;
	 animation-fill-mode: forwards;
	 animation-direction: alternate;
}
 @keyframes fadeIn {
	 from {
		 opacity: 0;
	}
	 to {
		 opacity: 1;
	}
}
 @keyframes gradient {
	 0% {
		 background-position: 0% 50%;
	}
	 50% {
		 background-position: 100% 50%;
	}
	 100% {
		 background-position: 0% 50%;
	}
}
 @keyframes MOVE-BG {
	 from {
		 background-size: 80%;
	}
	 to {
		 background-size: 84%;
	}
}
 @keyframes MOVE-BG-MOBILE {
	 from {
		 background-size: 90%;
	}
	 to {
		 background-size: 110%;
	}
}
 .login-box {
	 animation: fadeIn 1s;
	 z-index: 10;
	 border-radius: 5px;
	 position: relative;
	 box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	 min-width: 400px;
	 min-height: 200px;
	 padding: 4rem 3rem;
	 background-color: white;
}
 .login-box a {
	 text-decoration: none;
}
 .login-box .login {
	 display: none;
}
 .login-box .signin {
	 animation: fadeIn 0.8s;
}
 .login-box .signup {
	 animation: fadeIn 0.8s;
}
 .login-box .action p {
	 display: inline;
}
 .login-box .action .signup {
	 float: right;
	 font-weight: 700;
}
 .login-box .input-field {
	 width: 75%;
	 position: relative;
}
 .login-box .input-field i {
	 position: relative;
	 position: absolute;
	 top: 10px;
	 left: 50px;
}
 .login-box .input-field #password {
	 background: url(https://res.cloudinary.com/www-santhoshthomas-xyz/image/upload/v1620796331/portfolio/lock_dnkpk8.png) no-repeat 5%;
	 background-size: 20px;
	 z-index: 50;
}
 .login-box .input-field #email {
	 background: url(https://res.cloudinary.com/www-santhoshthomas-xyz/image/upload/v1620796341/portfolio/name_1_rgo5hw.png) no-repeat 5%;
	 background-size: 20px;
	 z-index: 50;
}
 .login-box .input-field #tel {
	 background: url("../../../assets/telephone.png") no-repeat 5%;
	 background-size: 20px;
	 z-index: 50;
}
 .login-box .input-field input {
	 box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	 width: 100%;
	 display: block;
	 padding: 15px 35px;
	 padding-left: 55px;
	 margin: 26px 0;
	 border: none;
	 border-left: 4px solid #EFC475;
	 border-radius: 4px;
}
 .login-box-button {
	 position: relative;
	 margin-top: 2rem;
	 display: flex;
	 justify-content: center;
	 align-items: center;
}
 .login-box-button button {
	 padding: 0.8rem 2rem;
	 background: #EFC475;
	 color: white;
	 font-weight: 800;
	 border: none;
	 transition: all 1s ease-in;
	 background-position: 0;
}
 .login-box-button button:active {
	 background-image: linear-gradient(to right top, #0e1776, #091b97, #031db9, #011edc, #081dff);
	 background-position: 400%;
	 transform: scale(1.1);
}
 .login-box .topline {
	 display: inline-block;
	 position: relative;
	 position: relative;
}
 .login-box .topline:after {
	 content: "";
	 position: absolute;
	 width: 40%;
	 transform: scaleX(1);
	 height: 5px;
	 top: -5px;
	 left: 0;
	 background-color: #EFC475;
}
 @media screen and (max-width: 776px) {
	 .login-box {
		 padding: 4rem 2rem !important;
		 right: unset !important;
		 width: 50px !important;
		 max-width: 100px;
	}
}
 
    </style>
</head>
<body>
     
      <div class="bg">
      
        <div class="columns ">
      
          <div class="login-box">
            <form method="POST" action="{{ route('login') }}">

                @csrf
              <div class="signin" [hidden]="login">
                <h1 class="topline">Login</h1>
                <br />
                <div class="input-field">
                  <input id="email" type="email" name="email" formControlName="email" placeholder="Input your Email" />
      
                </div>
      
                <div class="input-field">
                  <input id="password" type="password" name="password" formControlName="password" placeholder="Password" />
      
                </div>
      
                <div class="action">
                  <a class="forgot">Forgot Password?</a>
                  <a href="/seller/login" class="signup" style="color:black">Register</a>
                </div>
      
                <div class="login-box-button">
                  <button type="submit" style="cursor:pointer">
                    <i class="fas fa-sign-in-alt"></i>
                    LOG IN
                  </button>
                </div>
              </div>
            </form>
      
          </div>
</body>
</html>