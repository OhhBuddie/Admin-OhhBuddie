
@extends('layouts.app')

@section('content')


<style>


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Helvetica, Arial, sans-serif;
}

html,
body {
    height: 100vh;
    overflow: hidden;
    
}

.container {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
}

.row {
    display: flex;
    flex-wrap: wrap;
    height: 100vh;
}

.col {
    width: 50%;
}

.align-items-center {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.form-wrapper {
    width: 100%;
    max-width: 28rem;
}

.form {
    padding: 1rem;
    /*background-color: var(--white);*/
    border-radius: 1.5rem;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    transform: scale(0);
    transition: .5s ease-in-out;
    transition-delay: 1s;
}

.input-group {
    position: relative;
    width: 100%;
    margin: 1rem 0;
}

.input-group i {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
    font-size: 1.4rem;
    /*color: var(--gray-2);*/
}

/*.input-group input {*/
/*    width: 100%;*/
/*    padding: 1rem 3rem;*/
/*    font-size: 1rem;*/
    
/*    border-radius: .5rem;*/
/*    border: 0.125rem solid var(--white);*/
/*    outline: none;*/
/*}*/

.input-group input:focus {
    border: 0.125rem solid var(--primary-color);
}

.btn-danger {
    cursor: pointer;
    width: 100%;
    padding: .6rem 0;
    border-radius: .5rem;
    border: none;
    background-color: var(--primary-color);
    color: var(--white);
    font-size: 1.2rem;
    outline: none;
}

.btn-light {
    cursor: pointer;
    width: 100%;
    padding: .6rem 0;
    border-radius: .5rem;
    border: 1px solid;
    border-color:var(--primary-color);
    /*background-color: white;*/
    color: var(--primary-color);
    font-size: 1.2rem;
    outline: none;
}

.form p {
    margin: 1rem 0;
    font-size: .7rem;
}

.flex-col {
    flex-direction: column;
}

.social-list {
    margin: 2rem 0;
    padding: 1rem;
    border-radius: 1.5rem;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    transform: scale(0);
    transition: .5s ease-in-out;
    transition-delay: 1.2s;
}

.social-list>div {
    color: var(--white);
    margin: 0 .5rem;
    padding: .7rem;
    cursor: pointer;
    border-radius: .5rem;
    cursor: pointer;
    transform: scale(0);
    transition: .5s ease-in-out;
}

.social-list>div:nth-child(1) {
    transition-delay: 1.4s;
}

.social-list>div:nth-child(2) {
    transition-delay: 1.6s;
}

.social-list>div:nth-child(3) {
    transition-delay: 1.8s;
}

.social-list>div:nth-child(4) {
    transition-delay: 2s;
}

.social-list>div>i {
    font-size: 1.5rem;
    transition: .4s ease-in-out;
}

.social-list>div:hover i {
    transform: scale(1.5);
}

.facebook-bg {
    background-color: var(--facebook-color);
}

.google-bg {
    background-color: var(--google-color);
}

.twitter-bg {
    background-color: var(--twitter-color);
}

.insta-bg {
    background-color: var(--insta-color);
}

.pointer {
    cursor: pointer;
}

.container.sign-in .form.sign-in,
.container.sign-in .social-list.sign-in,
.container.sign-in .social-list.sign-in>div,
.container.sign-up .form.sign-up,
.container.sign-up .social-list.sign-up,
.container.sign-up .social-list.sign-up>div {
    transform: scale(1);
}

.content-row {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 6;
    width: 100%;
}

.text {
    margin: 4rem;
    color: var(--white);
}

.text h2 {
    font-size: 3.5rem;
    font-weight: 800;
    margin: 2rem 0;
    transition: 1s ease-in-out;
}

.text p {
    font-weight: 600;
    transition: 1s ease-in-out;
    transition-delay: .2s;
}

.img img {
    width: 30vw;
    transition: 1s ease-in-out;
    transition-delay: .4s;
}

.text.sign-in h2,
.text.sign-in p,
.img.sign-in img {
    transform: translateX(-250%);
}

.text.sign-up h2,
.text.sign-up p,
.img.sign-up img {
    transform: translateX(250%);
}

.container.sign-in .text.sign-in h2,
.container.sign-in .text.sign-in p,
.container.sign-in .img.sign-in img,
.container.sign-up .text.sign-up h2,
.container.sign-up .text.sign-up p,
.container.sign-up .img.sign-up img {
    transform: translateX(0);
}

/* BACKGROUND */

.container::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    height: 100vh;
    width: 300vw;
    transform: translate(35%, 0);
    background: linear-gradient(var(--primary-color), #000053);    transition: 1s ease-in-out;
    z-index: 6;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-bottom-right-radius: max(50vw, 50vh);
    border-top-left-radius: max(50vw, 50vh);
}

.container.sign-in::before {
    transform: translate(0, 0);
    right: 50%;
}

.container.sign-up::before {
    transform: translate(100%, 0);
    right: 50%;
}

/* RESPONSIVE */

@media only screen and (max-width: 768px) {

    .container::before,
    .container.sign-in::before,
    .container.sign-up::before {
        height: 100vh;
        border-bottom-right-radius: 0;
        border-top-left-radius: 0;
        z-index: 0;
        transform: none;
        right: 0;
    }

    /* .container.sign-in .col.sign-up {
        transform: translateY(100%);
    } */

    .container.sign-in .col.sign-in,
    .container.sign-up .col.sign-up {
        transform: translateY(0);
    }

    .content-row {
        align-items: flex-start !important;
    }

    .content-row .col {
        transform: translateY(0);
        background-color: unset;
    }

    .col {
        width: 100%;
        position: absolute;
        padding: 2rem;
        background-color: var(--white);
        border-top-left-radius: 2rem;
        border-top-right-radius: 2rem;
        transform: translateY(100%);
        transition: 1s ease-in-out;
    }

    .row {
        align-items: flex-end;
        justify-content: flex-end;
    }

    .form,
    .social-list {
        box-shadow: none;
        margin: 0;
        padding: 0;
    }

    .text {
        margin: 0;
    }

    .text p {
        display: none;
    }

    .text h2 {
        margin: .5rem;
        font-size: 2rem;
    }
}
</style>
<style>
    .mobile-input-wrapper {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
}

.country-code {
    display: flex;
    align-items: center;
    padding: 5px;
    /*background-color: #f5f5f5;*/
    border-right: 1px solid #ccc;
}

.flag-icon {
    width: 20px;
    height: 14px;
    margin-right: 5px;
}

.mobile-input-wrapper input[type="text"] {
    flex: 1;
    border: none;
    padding: 5px;
    outline: none;
}

</style>

<style>
.divider {
  font-size: 14px;
  display: flex;
  align-items: center;
}

.divider::before, .divider::after {
  flex: 1;
  content: '';
  padding: 1px;
  background-color: var(--primary-color);
  margin: 5px;
}

</style>

<style>


          .otp-input {
              display: flex;
              justify-content: center;
              width:100%;
          }
          .otp-input input {
              width: 100%;
              height: 40px;
              margin: 0 5px;
              text-align: center;
              font-size: 1.2rem;
              border: 1px solid #444;
              border-radius: 4px;
              background-color: #2a2a2a;
              color: #ffffff;
          }
          .otp-input input::-webkit-outer-spin-button,
          .otp-input input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
          }
          .otp-input input[type=number] {
              -moz-appearance: textfield;
          }
          
          .signin{
            padding: 10px 50px;
            background: var(--primary-color);
            border: none;
          }
          
    </style>
    
    

                                
                                
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->Ge
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<div class="form sign-up">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Username">
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="email" placeholder="Email">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Password">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Confirm password">
						</div>
						<button>
							Sign up
						</button>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</div>
				</div>
			
			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in bg-dark">
				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
					    
					 <form method="POST" action="{{ route('sellerotp.getlogin') }}">

                        @csrf
                        <input type="hidden" name="user_id" value="{{$user_id}}" />
                        
						<div class="input-group">
                            <!--<label for="mobile_no" class="col-md-4 col-form-label text-md-end">{{ __('Mobile No') }}</label>-->
                            

                                <!--<input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" placeholder="Enter OTP">-->
                                 <!-- Hidden input to store combined OTP -->
                                <input type="hidden" name="otp" id="otp" class="@error('otp') is-invalid @enderror" value="{{ old('otp') }}" />
                            
                                <div class="otp-input">
                                    <input type="number" min="0" max="9" required oninput="moveNext(this, 1)" maxlength="1">
                                    <input type="number" min="0" max="9" required oninput="moveNext(this, 2)" maxlength="1">
                                    <input type="number" min="0" max="9" required oninput="moveNext(this, 3)" maxlength="1">
                                    <input type="number" min="0" max="9" required oninput="moveNext(this, 4)" maxlength="1">
                                    <input type="number" min="0" max="9" required oninput="moveNext(this, 5)" maxlength="1">
                                    <input type="number" min="0" max="9" required oninput="moveNext(this, 6)" maxlength="1">
                                </div>
  

                                @error('otp')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror
						</div>

						<button class="signin">
							Sign in
						</button>

						</form>

						
						<br>

						<p>
							<b>
								Forgot password?
							</b>
						</p>
						<!--<p>-->
						<!--	<span>-->
						<!--		Don't have an account?-->
						<!--	</span>-->
						<!--	<b onclick="toggle()" class="pointer">-->
						<!--		Sign up here-->
						<!--	</b>-->
						<!--</p>-->
					</div>
				</div>
				<div class="form-wrapper">
		
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome To ShowLoom
					</h2>
	  
				</div>
				<br>
				<div class="img sign-in">
		                <img src="{{ asset('public/assets/images/logo/showloomlogo.jpg') }}" style="height:220px; width:220px;">
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				
				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>
	
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>
	
	
	<script>
	    let container = document.getElementById('container')

toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
}

setTimeout(() => {
	container.classList.add('sign-in')
}, 200)
	</script>
	<script>
	    // -----Country Code Selection
$("#mobile_code").intlTelInput({
	initialCountry: "in",
	separateDialCode: true,
	// utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
});
	</script>

    <!--New otp Input -->
    <script>
          const inputs = document.querySelectorAll('.otp-input input');
         

          inputs.forEach((input, index) => {
              input.addEventListener('input', (e) => {
                  if (e.target.value.length > 1) {
                      e.target.value = e.target.value.slice(0, 1);
                  }
                  if (e.target.value.length === 1) {
                      if (index < inputs.length - 1) {
                          inputs[index + 1].focus();
                      }
                  }
              });

              input.addEventListener('keydown', (e) => {
                  if (e.key === 'Backspace' && !e.target.value) {
                      if (index > 0) {
                          inputs[index - 1].focus();
                      }
                  }
                  if (e.key === 'e') {
                      e.preventDefault();
                  }
              });
          });

          
    </script>
    
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let otpInputs = document.querySelectorAll('.otp-input input');
        let hiddenOtpInput = document.getElementById('otp');

        // Prefill OTP input boxes if old value exists
        let oldOtp = hiddenOtpInput.value;
        if (oldOtp.length === 6) {
            otpInputs.forEach((input, index) => {
                input.value = oldOtp[index] || '';
            });
        }

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function () {
                // Move to next input if a digit is entered
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                // Combine OTP values and set hidden input
                let otpValue = Array.from(otpInputs).map(i => i.value).join('');
                hiddenOtpInput.value = otpValue;
            });

            // Handle backspace to move to previous input
            input.addEventListener('keydown', function (e) {
                if (e.key === "Backspace" && this.value === "" && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
    });
</script>