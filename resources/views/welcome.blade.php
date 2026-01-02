<!DOCTYPE HTML>
<html>
    <head>
        <title>AGAP - Hospital Appointment System</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="assets/css/main.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Smooth Scrolling */
            html {
                scroll-behavior: smooth;
            }

            /* Global Font Settings - Changed to Figtree */
            body, input, select, textarea, button {
                font-family: 'Figtree', sans-serif !important;
            }

            /* Hero Title Styling - Changed to Figtree */
            #hero header h2 {
                font-family: 'Figtree', sans-serif !important;
                font-weight: 700 !important;
                text-transform: none; 
                letter-spacing: -0.01em; /* Figtree looks sharp with a slight tighten */
                font-size: 3.5em !important; 
                line-height: 1.2em;
            }

            .agap-highlight {
                color: #e3f2fd !important; 
            }

            #hero p {
                font-size: 1.25em !important;
                line-height: 1.6em;
            }

            #header-wrapper {
                background-color: #000000 !important; 
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2)), 
                url('https://i.pinimg.com/1200x/ad/72/80/ad72808981be5edcad30596a704e2460.jpg') !important;
                background-size: cover !important;
                background-position: center !important;
                background-attachment: fixed;
                color: #ffffff !important;
                padding-bottom: 5em;
            }

            #nav > ul > li > a, #hero h2, #hero p {
                color: #ffffff !important;
                text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            }

            #nav .break a {
                background: rgba(255, 255, 255, 0.15);
                border: 2px solid #ffffff !important;
                border-radius: 30px !important;
                padding: 0.5em 1.5em !important;
                margin: 0 5px !important;
                color: #ffffff !important;
                font-weight: 600 !important;
                transition: all 0.3s ease;
                display: inline-block;
                line-height: 1.5em;
            }

            #nav .break a:hover {
                background: #ffffff !important;
                color: #000000 !important;
            }



            /* REMOVE DIAGONAL LINES/OVERLAYS */
            .image-wrapper:after, 
            .image-wrapper:before, 
            .image.featured:after, 
            .image.featured:before {
                display: none !important;
                content: none !important;
            }

            /* Uniform Image Sizing for "Why Choose Us" */
            .features .image.featured img {
                width: 100%;
                height: 250px !important;
                object-fit: cover !important;
                object-position: center;
                border: none !important;
            }

            /* Uniform Image Sizing for Features (Top Section) */
            .feature .image.featured img {
                width: 100%;
                height: 350px !important;
                object-fit: cover !important;
                border: none !important;
            }

            /* Global Navy Blue Button Style */
            .button, input[type="submit"], input[type="reset"] {
                background-color: #001f3f !important; 
                color: #ffffff !important;
                border: none !important;
                font-weight: 600 !important;
                font-family: 'Figtree', sans-serif !important;
                box-shadow: 0 4px 10px rgba(0,0,0,0.2) !important;
                transition: background-color 0.3s ease !important;
            }

            .button:hover, input[type="submit"]:hover, input[type="reset"]:hover {
                background-color: #003366 !important;
                transform: translateY(-2px);
            }

            /* Feature Headers & Major Headers - Changed to Figtree */
            .feature header h2, header.major h2 {
                color: #001f3f !important;
                font-size: 2.5em !important;
                font-family: 'Figtree', sans-serif !important;
                font-weight: 700 !important;
                margin-bottom: 0.3em;
            }

            header.major p {
                color: #001f3f !important;
                font-size: 1.4em !important;
                font-weight: 500 !important;
                opacity: 0.9;
            }

            /* Navy Blue Promo Section */
            #promo-wrapper {
                background-color: #001f3f !important; 
                background-image: none !important;
                color: #ffffff !important;
                padding: 5em 0 !important;
            }

            #promo h2 {
                color: #ffffff !important;
                font-weight: 700 !important;
                font-family: 'Figtree', sans-serif !important;
            }

            #promo .button {
                background-color: #ffffff !important;
                color: #001f3f !important;
            }

            /* FOOTER */
            #footer-wrapper {
                padding: 4em 5% !important;
            }

            #footer .icons {
                list-style: none;
                padding: 0;
            }

            #footer .icons li {
                padding: 0.8em 0;
                display: flex;
                align-items: center;
                color: #001f3f !important;
                font-weight: 600;
                font-family: 'Figtree', sans-serif !important;
                border: none !important; 
            }

            #footer .icons li:before {
                border: none !important; 
                background-color: #001f3f !important;
                color: #ffffff !important;
                width: 40px;
                height: 40px;
                line-height: 40px;
                border-radius: 50%;
                text-align: center;
                margin-right: 15px;
                display: inline-block;
                flex-shrink: 0;
            }

            #footer .icons li a {
                color: #001f3f !important;
                text-decoration: none;
            }

            /* Centered Copyright */
            #copyright {
                border-top: 1px solid rgba(0, 31, 63, 0.1);
                padding-top: 2em;
                margin: 0 5%;
                text-align: center; 
            }

            #copyright .menu {
                justify-content: center;
                display: flex;
                list-style: none;
                padding: 0;
            }
        </style>
    </head>
    <body class="homepage is-preload">
        <div id="page-wrapper">
            <div id="header-wrapper">
                <div id="header" class="container">
                    <nav id="nav">
                        <ul>
                            <li class="current"><a href="/">Dashboard</a></li>
                            <li><a href="#about-section">About AGAP</a></li>
                            <li><a href="#footer-wrapper">Contact Us</a></li>
                            <li class="break">
                                @if (Route::has('login'))
                                    <livewire:welcome.navigation />
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>

                <section id="hero" class="container">
                    <header>
                        <h2>Welcome to <span class="agap-highlight">AGAP</span><br />Hospital Appointment System</h2>
                    </header>
                    <p>Appointment and Guided Access Platform that is<br />
                    <i>Mabilis. Maaasahan. Makatao.</i></p>
                    <ul class="actions">
                        <li><a href="#about-section" class="button">Learn More</a></li>
                    </ul>
                </section>
            </div>

            <div class="wrapper" id="about-section">
                <div class="container">
                    <div class="row">
                        <section class="col-6 col-12-narrower feature">
                            <div class="image-wrapper first">
                                <a href="#" class="image featured"><img src="https://vmedx.com/wp-content/uploads/2025/02/Group-of-smiling-Asian-medical-workers-looking-at-the-camera-%E2%80%93-Medical-Virtual-Assistant-Jobs-Philippines-768x512.jpg" alt="Specialists" /></a>
                            </div>
                            <header>
                                <h2>Find the Right Specialist</h2>
                            </header>
                            <p>Browse and select from our wide range of experienced medical professionals and specialized departments.</p>
                        </section>
                        <section class="col-6 col-12-narrower feature">
                            <div class="image-wrapper">
                                <a href="#" class="image featured"><img src="https://lauriebrown.com/wp-content/themes/yootheme/cache/f4/48210476_patient-elderly-sit-on-wheelchair-meet-and-talking-with-nurse-or-staff-at-front-counter-f4c27bb1.webp" alt="Manage Appointments" /></a>
                            </div>
                            <header>
                                <h2>Manage Appointments</h2>
                            </header>
                            <p>Take full control of your health schedule. View, modify, or cancel your upcoming visits anytime.</p>
                        </section>
                    </div>
                </div>
            </div>

            <div id="promo-wrapper">
                <section id="promo" class="container">
                    <h2>Need help or have an urgent concern?</h2>
                    <a href="#footer-wrapper" class="button">Contact the Hospital</a>
                </section>
            </div>

            <div class="wrapper">
                <section class="container">
                    <header class="major">
                        <h2>Why Choose AGAP Hospital?</h2>
                        <p>Dedicated to providing excellent healthcare services to our community.</p>
                    </header>
                    <div class="row features">
                        <section class="col-4 col-12-narrower feature">
                            <div class="image-wrapper first">
                                <span class="image featured"><img src="https://top.org.ph/wp-content/uploads/2023/03/healthcare-center-hospital-room-interior-of-oper-2021-08-26-15-28-02-utc-1.jpg" alt="Facilities" /></span>
                            </div>
                            <p>State-of-the-art facilities and modern medical technology.</p>
                        </section>
                        <section class="col-4 col-12-narrower feature">
                            <div class="image-wrapper">
                                <span class="image featured"><img src="https://slmc-cm.edu.ph/wp-content/uploads/2020/03/EditedENTDSC02527-scaled.jpg" alt="Professionals" /></span>
                            </div>
                            <p>Highly skilled and compassionate healthcare professionals.</p>
                        </section>
                        <section class="col-4 col-12-narrower feature">
                            <div class="image-wrapper">
                                <span class="image featured"><img src="https://capitolmedical.com.ph/wp-content/uploads/2024/07/home-11.jpg" alt="Care" /></span>
                            </div>
                            <p>Patient-centered approach ensuring quality care.</p>
                        </section>
                    </div>
                </section>
            </div>

            <div id="footer-wrapper">
                <div id="footer" class="container">
                    <header class="major">
                        <h2>Get in Touch</h2>
                        <p>Contact us for inquiries, emergency services, or feedback.</p>
                    </header>
                    <div class="row">
                        <section class="col-6 col-12-narrower">
                            <form method="post" action="#">
                                <div class="row gtr-50">
                                    <div class="col-6 col-12-mobile"><input name="name" placeholder="Name" type="text" /></div>
                                    <div class="col-6 col-12-mobile"><input name="email" placeholder="Email" type="text" /></div>
                                    <div class="col-12"><textarea name="message" placeholder="Message"></textarea></div>
                                    <div class="col-12">
                                        <ul class="actions">
                                            <li><input type="submit" value="Send Message" /></li>
                                            <li><input type="reset" value="Clear form" /></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </section>
                        <section class="col-6 col-12-narrower">
                            <div class="row gtr-0">
                                <ul class="icons col-6 col-12-mobile">
                                    <li class="icon solid fa-phone"><a href="tel:1234567890"> (123) 456-7890</a></li>
                                    <li class="icon solid fa-envelope"><a href="mailto:info@agap.com"> info@agap.com</a></li>
                                    <li class="icon brands fa-facebook-f"><a href="#"> Facebook</a></li>
                                </ul>
                                <ul class="icons col-6 col-12-mobile">
                                    <li class="icon solid fa-map-marker-alt"><span> Hospital Main St, City</span></li>
                                    <li class="icon solid fa-clock"><span> 24/7 Emergency</span></li>
                                    <li class="icon brands fa-twitter"><a href="#"> Twitter</a></li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
                <div id="copyright" class="container">
                    <ul class="menu">
                        <li>&copy; 2025 AGAP Hospital. All rights reserved.</li>
                    </ul>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>