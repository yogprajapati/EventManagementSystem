<?php

include ("authentication/dbconnection.php");

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Perficient</title>
    <link rel="stylesheet" href="components/css/aboutus.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


</head>

<body>
    <div class="container">
        <div class="nav-main">
            <nav class="navbar">
                <div class="logo">
                    <a href="#" class="logo-text">The Perficient</a>
                </div>
                <div class="nav-items">
                <a href="index.php" class="nav-item">HOME</a>
                    <a href="aboutus.php" class="nav-item">ABOUT</a>
                    <a href="services.php" class="nav-item">SERVICE</a>
                    <a href="events.php" class="nav-item">EVENTS</a>
                    <a href="contact.php" class="nav-item">CONTACT</a>
                </div>
                <div class="icons">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<div class="profile-dropdown">';
                        echo '<select onchange="profileMenu(this.value)">';
                        echo '<option value="">Profile</option>';
                        echo '<option value="dashboard">Dashboard</option>';
                        echo '<option value="edit_profile">Edit Profile</option>';
                        echo '<option value="logout">Logout</option>';
                        echo '</select>';
                        echo '</div>';
                    } else {
                        echo '<button class="book-btn" onclick="registerbtn()">Register</button>';
                        echo '<button class="book-btn" onclick="loginbtn()">Login</button>';
                    }
                    ?>

                    <script>
                        function registerbtn() {
                            window.location.href = "authentication/createaccount.php";
                        }
                        function loginbtn() {
                            window.location.href = "authentication/login.php";
                        }
                        function profileMenu(option) {
                            if (option === "dashboard") {
                                window.location.href = "dashboard.php";
                            } else if (option === "edit_profile") {
                                window.location.href = "edit_profile.php";
                            } else if (option === "logout") {
                                window.location.href = "authentication/logout.php";
                            }
                        }
                    </script>
                </div>

            </nav>
            <div class="box">
            </div>
            <div class="nav-content">
                <div class="left-side">
                    <div class="first-content">
                        <span style="font-size: 28px;">"Meet the Team Behind Your Perfect Event: Bringing Your Vision to
                            Life!"</span>
                    </div>
                    <div class="nav-con-about">
                        <p></p>
                    </div>
                    <div class="book-tbl-btn">
                        <button class="book-btn">Create event</button>
                    </div>
                </div>
            </div>
        </div><br><br>

        <!-- start  -->

        <div class=" services">
                    <h2 style="text-align: center; color: rgb(53, 96, 7);">Meet Our Team</h2>
                    <div class="overview-grid">
                        <div class="box1 box">
                            <span>
                                <img src="https://cdn.shopify.com/s/files/1/2196/3271/files/Indian_wedding_planner_vs_Indian_wedding_stylist_1024x1024.jpg?v=1679913759"
                                    alt="" class="circular--square">
                            </span>
                            <span class="bold">Yagna Patel</span>
                            <span>I'm currently pursuing btech in cse at gls university , i completed my diploma at RC that affliated with gtu.</span>
                            <span><i class="fas fa-phone"></i> 7874078100 </span>
                            <span><i class="fas fa-envelope"></i> yogprajapati08@gmail.com</span>
                            <span><i class="fas fa-map-marker-alt"></i> Ahmedabad,Gujarat</span>
                        </div>
                        <div class="box1 box">
                            <span>
                                <img src="https://www.oyorooms.com/blog/wp-content/uploads/2018/02/How-much-space-does-it-has.png"
                                    alt="" class="circular--square">
                            </span>
                            <span class="bold">Yash Patel</span>
                            <span>I'm currently pursuing btech in cse at gls university , i completed my diploma at RC that affliated with gtu.</span>
                            <span><i class="fas fa-phone"></i> 7874078100 </span>
                            <span><i class="fas fa-envelope"></i> yogprajapati08@gmail.com</span>
                            <span><i class="fas fa-map-marker-alt"></i> Ahmedabad,Gujarat</span>
                        </div>
                        <div class="box1 box">
                            <span>
                                <img src="data:image/jpeg;base64,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"
                                    alt="" class="circular--square">
                            </span>
                            <span class="bold">Yog Prajapati</span>
                            <span>I'm currently pursuing btech in cse at gls university , i completed my diploma at RC that affliated with gtu.</span>
                            <span><i class="fas fa-phone"></i> 7874078100 </span>
                            <span><i class="fas fa-envelope"></i> yogprajapati08@gmail.com</span>
                            <span><i class="fas fa-map-marker-alt"></i> Ahmedabad,Gujarat</span>

                        </div>
                        <div class="box1 box">
                            <span>
                                <img src="https://www.rajwadaevents.com/uploaded-files/feature-images/Corporate-Events03_50_48.jpg"
                                    alt="" class="circular--square">
                            </span>
                            <span class="bold">Neel Chaudhary</span>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, saepe.</span>
                        </div>

                    </div>
                </div>
                <div class="foot">
                    <footer>
                        <p>&copy; Copyrights reserved 2024 | <a href="http://www.perficient.com" target="_blank"
                                style="text-decoration: none; color: #ffffff;">www.perficient.com</a></p>

                    </footer>
                </div>