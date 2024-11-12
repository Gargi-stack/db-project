<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FABTRAVELS</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

    :root {
        --primary-color: #16c2d5;
        --primary-color-dark: #2f4ae6;
        --text-dark: #0b1221;
        --text-light: black;
        --white: #ffffff;
        font-size: 20px;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Nunito", sans-serif;
        background-color: #f9f9f9;
        color: var(--text-dark);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    nav {
        background-color: paleturquoise;
        padding: 1.5rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .nav_logo {
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--primary-color-dark);
    }

    .nav_links {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 2.5rem;
    }

    .link a {
        color: var(--text-light);
        text-decoration: none;
        cursor: pointer;
        transition: 0.3s;
        font-size: 1.1rem;
    }

    .link a:hover {
        color: var(--primary-color);
    }

    .about-header {
        text-align: center;
        padding: 3rem 0;
    }

    .about-header h1 {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
    }

    .about-description {
        text-align: center;
        margin-bottom: 3rem;
        font-size: 1.25rem;
        color: var(--text-dark);
    }

    .contact-section {
        display: flex;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .contact-info {
        width: 48%;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .contact-info h2 {
        margin-bottom: 1.5rem;
        font-size: 2rem;
        color: var(--primary-color-dark);
    }

    .contact-info p {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .socials {
        display: flex;
        gap: 2rem;
        justify-content: center;
    }

    .socials a {
        font-size: 2rem;
        color: var(--primary-color-dark);
        text-decoration: none;
        transition: color 0.3s;
    }

    .socials a:hover {
        color: var(--primary-color);
    }

    .map-section {
        width: 100%;
        height: 400px;
        margin-bottom: 3rem;
    }

    footer {
        text-align: center;
        padding: 1.5rem;
        background-color: var(--primary-color-dark);
        color: var(--white);
    }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <nav>
            <div class="nav_logo"><b>FABTRAVELS</b></div>
            <ul class="nav_links" id="nav_links">
                <li class="link"><a href="homepage.php"><b>Home</b></a></li>
                <li class="link"><a href="services.php"><b>Services</b></a></li>
                <li class="link"><a href="about_us.php"><b>About Us</b></a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="link"><a href="view_bookings.php"><b>View My Bookings</b></a></li>
                    <li class="link"><a href="book_car.php"><b>Book A Car</b></a></li>
                    <li class="link"><a href="user_prof.php"><b>Update Profile</b></a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- About Us Header -->
        <section class="about-header">
            <h1>About FABTRAVELS</h1>
            <p>Your trusted travel partner, ensuring a smooth and memorable journey.</p>
        </section>

        <!-- About Description Section -->
        <section class="about-description">
            <p>
                FABTRAVELS is committed to offering the most reliable and luxurious travel experiences across the globe.
                We provide top-of-the-line vehicles and highly skilled drivers to make your journey comfortable and stress-free.
                Whether you're looking for a business trip or a family vacation, we've got you covered.
            </p>
        </section>

        <!-- Contact Info Section -->
        <section class="contact-section">
            <div class="contact-info">
                <h2>Contact Us</h2>
                <p><strong>Email:</strong> contact@fabtravels.com</p>
                <p><strong>Phone:</strong> +1 (800) 123-4567</p>
                <p><strong>Address:</strong> 123 Travel St, Suite 101, Cityville, ABC 12345</p>
            </div>

            <div class="contact-info">
                <h2>Social Media</h2>
                <div class="socials">
                    <a href="https://www.facebook.com/FabTravels" target="_blank">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    <a href="https://twitter.com/FabTravels" target="_blank">
                        <i class="ri-twitter-fill"></i>
                    </a>
                    <a href="https://www.instagram.com/FabTravels" target="_blank">
                        <i class="ri-instagram-fill"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Google Map Section -->
        <section class="map-section">
            <h2>Our Location</h2>
            <div id="google-map" style="width:100%; height: 100%;"></div>
        </section>
        
        <footer>
            <p>&copy; 2024 FABTRAVELS. All Rights Reserved.</p>
        </footer>
    </div>

    <!-- Google Maps API Script -->
    <script>
        function initMap() {
            var location = {lat: 40.712776, lng: -74.005974}; // Replace with your location
            var map = new google.maps.Map(document.getElementById('google-map'), {
                zoom: 12,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>

</body>
</html>
