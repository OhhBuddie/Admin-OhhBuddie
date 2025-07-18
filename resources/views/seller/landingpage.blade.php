<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="{{asset('public/assets/dashboard/images/Ohbuddielogo.png')}}" />

    <title>Start Selling - Ohh! Buddie</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 2%;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            height: 80px;
            width: 100px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-primary {
            background: #EFC475;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: black;
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid #EFC475;
            color: #EFC475;
            background: white;
        }

        .btn-outline:hover {
            background: black;
            color: white;
            border: 2px solid black;
        }

        .hero {
            display: flex;
            padding: 4rem 5%;
            background-image: url("https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/Long+Banner+1.jpg");
            min-height: 500px;
            align-items: center;
            background-size: cover; /* Ensures section is fully covered */
            background-position: center;
            background-repeat: no-repeat;
        }


        .hero-content {
            flex: 1;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: black;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #424242;
        }

       

        .features {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 3rem 3%;
            text-align: center;
            background: white;
        }

         .feature-card {
            flex: 1;
            text-align: right;
        }

        .feature-card img {
            max-width: 100%;
            height: 230px;
            width: 400px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-card img:hover {
            transform: translateY(-10px);
        }

        .journey {
            text-align: center;
        }

        .journey h2 {
            color: black;
            font-size: 2rem;
            margin-bottom: 3rem;
        }

        .step {
            text-align: center;
           
            background: white;
        }

        .step:hover {
            transform: translateY(-10px);
        }

        .step img {
            max-width: 100%;
            height: auto;
            width: auto;
            
        }

        .offers {
            padding: 6rem 5%;
            background: white;
        }

        .offers h2 {
            text-align: center;
            color: black;
            margin-bottom: 3rem;
            font-size: 2rem;
        }

        .offer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .offer-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            /*padding: 2rem;*/
            border-radius: 15px;
            background: #f8f9fa;
            transition: transform 0.3s ease;
            width:300px;
        }

        /*.offer-item img{*/
            
        /*    width: 350px;*/
        /*}*/
        
        .offer-item:hover {
            transform: translateX(10px);
            background: #e8eaf6;
        }

        .contact {
            padding: 6rem 5%;
            background-image: url("https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/Contact+Us.png");
            /*align-items: center;*/
            background-size: cover; /* Ensures section is fully covered */
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 4rem;
        }

        .contact-form {
            flex: 1;
            max-width: 500px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.9);
            transition: all 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
        }

        .footer {
            padding: 2rem 5%;
            background: #f5f5f5;
            text-align: center;
        }

        .footer a {
            color: black;
            text-decoration: none;
            margin: 0 1rem;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #283593;
        }

        @media (max-width: 768px) {
            .features,
            .journey-steps,
            .offer-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 2rem 5%;
            }

            .hero-content {
                margin-bottom: 2rem;
            }

            .contact {
                flex-direction: column;
                padding: 4rem 5%;
            }

            .contact-form {
                max-width: 100%;
            }

            .btn {
                padding: 0.6rem 1.2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <img src="https://seller.ohhbuddie.com/public/assets/dashboard/images/Ohbuddielogo.png" alt="Ohh Buddie Logo" class="logo">
        <div class="nav-buttons">
            <a href="/login" class="btn btn-outline">Login</a>
            <a href="/seller/login" class="btn btn-primary">Start Selling</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Start selling with us at<br>0% commission</h1>
            <p>Become a seller on Ohh! Buddie now and grow your business across India</p>
            <a href="#" class="btn btn-primary">Start Selling</a>
        </div>
   
    </section>
 
 
    <section class="features">
        <div class="feature-card">
            <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card+2.jpg" >
        </div>
        <div class="feature-card">
             <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card+2).png" >
        </div>
        <div class="feature-card">
           <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card3).png" >
        </div>
        <div class="feature-card">
            <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card4.png" >
        </div>
    </section>

    <section class="journey">
        <h2>Your Journey on Ohh! Buddie</h2>
        
            <div class="step">
                <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/Long+Banner+2.png" alt="Create Account">
            </div>
        
    </section>

    <section class="offers">
        <h2>WHAT Ohh! Buddie OFFERS TO SELLERS?</h2>
        <div class="offer-grid">
            <div class="offer-item">
                <!--<img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/Below+Card+1.png" alt="Brand Visibility">-->
              <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card.jpg" alt="Product Listing">
            </div>
            <div class="offer-item">
                <!--<img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/Below+Card+2.png" alt="Zero Charges">-->
           <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card.jpg" alt="Product Listing">
            </div>
            <div class="offer-item">
                <img src="https://fileuploaderbucket.s3.ap-southeast-1.amazonaws.com/Seller/card.jpg" alt="Product Listing">
               
            </div>
        </div>
    </section>

    <section class="contact">
        <div>
            <h2>We are happy to help you!</h2>
            <p>Still have questions? Fill out this form and we'll get back to you.</p>
        </div>
        <form class="contact-form" method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name = "company_name" placeholder="Company Name" required>
            <input type="tel"  name="phone" placeholder="Mobile Number" required>
            <input type="email"  name="email" placeholder="Email" required>
            <input type="text"  name="business_type" placeholder="Business Type" required>
            <textarea  name="comments" placeholder="Message" rows="4"></textarea>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>

    <footer class="footer">
        <p>© 2025 Ohh! Buddie Technologies Pvt Ltd</p>
        <div>
            <a href="#">Privacy Policy</a> |
            <a href="#">Terms & Conditions</a> |
            <a href="#">FAQs</a>
        </div>
    </footer>


</body>
</html>