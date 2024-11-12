<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FABTRAVELS</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

:root {
    --primary-color: #16c2d5;
    --primary-color-dark: #2f4ae6;
    --text-dark: #0b1221;
    --text-light: black;
    --white: #ffffff;
    font-size: 20px; /* Increase the base font size */
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    font-family: "Nunito", sans-serif;
    background-image: url('home.jpg'); /* Ensure the path is correct */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.container {
    max-width: 1200px;
    margin: auto;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    padding: 20px; /* Add padding to container */
}

nav {
    background-color: paleturquoise;
    padding: 2rem 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.nav_logo {
    font-size: 2.5rem; /* Increase logo font size */
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
    font-size: 1.1rem; /* Increase nav link font size */
}

.link a:hover {
    color: var(--primary-color);
}

.header {
    padding: 0 1rem;
    flex: 1;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    align-items: center;
}

.content h1 {
    margin-bottom: 1rem;
    font-size: 3.5rem; /* Increase heading font size */
    font-weight: 700;
    color: var(--text-dark);
}

.content h1 span {
    font-weight: 400;
}

.content h3 {
    margin-bottom: 2rem;
    color: var(--text-light);
    line-height: 2rem;
    font-size: 1.25rem; /* Increase subheading font size */
}

.content .btn {
    padding: 1rem 2rem;
    outline: none;
    border: none;
    font-size: 1.2rem; /* Increase button font size */
    color: var(--white);
    background-color: var(--primary-color);
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.nav_btns .sign_up, .nav_btns .sign_in {
    padding: 5rem 5rem;
    font-size: 1.5rem; /* Increase button font size */
    color: var(--white);
    background-color: var(--primary-color);
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.nav_btns .sign_up:hover, .nav_btns .sign_in:hover {
    background-color: var(--primary-color-dark);
}

</style>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
    />
</head>
<body>
    <div class="container">
        <nav>
            <div class="nav_logo"><b>FABTRAVELS</b></div>
            <ul class="nav_links" id="nav_links">
                <li class="link"><a href="homepage.php"><b>Home</b></a></li>
                <li class="link"><a href="services.html"><b>Services</b></a></li>
                <li class="link"><a href="about_us.html"><b>About Us</b></a></li>
                
                <!-- Conditional "View My Bookings" Button -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="link">
                        <a href="view_bookings.php">
                            <button style="padding: 15px 25px; background-color: orange; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                View My Bookings
                            </button>
                        </a>
                    </li>
                    <li class="link">
                        <a href="book_car.php">
                            <button style="padding: 15px 25px; background-color: orange; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                Book A Car
                            </button>
                        </a>
                    </li>
                    <li class="link">
                        <a href="user_prof.php">
                            <button style="padding: 10px 20px; background-color: orange; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="location.href='user_prof.php'">
                               Update Profile
                             </button>
                        </a>
                     </li>
                <?php endif; ?>
            </ul>   
        </nav>
        <header class="header">
            <div class="content">
                <h1><span><b>Enjoy Your Holiday With</b></span></h1>
                <br>
                <h3><i><b>Ease In Our Transport System!</b></i></h3>
                <h3><i><b>Have You signed up with us yet?</b></i></h3>
                <br/>
                <div class="nav_btns">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <!-- Displayed when the user is not logged in -->
                        <button class="btn sign_up" onclick="location.href='signup.php'">Sign Up</button>
                        <button class="btn sign_in" onclick="location.href='login.php'">Log In</button>
                    <?php endif; ?>
                </div>
            </div>
        </header>
    </div>
</body>
</html>
