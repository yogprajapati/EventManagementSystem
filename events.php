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

<html>

<head>
    <title>
        Our Services
    </title>
    <link rel="stylesheet" href="Components/css/events.css">
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

            <!--wedding-->
            <div class="box">
                <h1 class="title">WEDDINGS BY PERFICIENT</h1>
            </div>
        </div>
        <div class="main">
            <div class="p">
                <p>
                    A wedding does not only bring two souls together but their entire family as well. That is why we
                    take the responsibility to make this important day of our client’s life filled with memories they
                    can always cherish.
                </p></br>
                <p>
                    We provide for exotic wedding locations all over India to help the couples create an experience of a
                    lifetime. The ever so helpful Team ensures that every wedding is a mixture of fun, convenient, and
                    memorable. From traditional and sophisticated to the chic and modern wedding, we can get it all done
                    for you!
                </p></br>
                <p>
                    We present our clients with various options to choose from which includes the theme, color
                    combination, food menu, and more so that their day is filled with perfection. What makes us the
                    industry leader is the fact that we not only plan and make the arrangements, we even take care of
                    the minute details to ensure each one of the guests have the best time of their lives at your
                    wedding and make it the talk of the town!
                </p></br>
            </div>
            <div class="img">
                <img class="lazy loaded"
                    src="https://brothersevents.in/wp-content/uploads/2022/06/wedding-brothersevents-1.x38221.jpg"
                    data-src="https://brothersevents.in/wp-content/uploads/2022/06/wedding-brothersevents-1.x38221.jpg"
                    alt="" data-was-processed="true">
            </div>
        </div><BR><br>

        <!--Birthday-->

        <div class="birthday">
            <div class="box">
                <h1 class="title">BIRTHDAYS BY PERFICIENT</h1>
            </div>
        </div>
        <div class="main">
            <div class="p1">
                <p>
                    A birthday celebration isn't just about marking another year; it's about creating lasting memories
                    with loved ones. At our event planning company, we understand the significance of birthdays and
                    strive to make each one truly special.
                </p></br>
                <p>
                    From intimate gatherings to grand parties, we offer a range of options to suit every style and
                    preference. Our dedicated team works tirelessly to ensure that every detail, from the venue to the
                    decorations and entertainment, is tailored to perfection, making your birthday celebration an
                    unforgettable experience.
                </p></br>
                <p>
                    We believe in personalization, which is why we work closely with our clients to understand their
                    vision and bring it to life. Whether you're looking for a themed extravaganza or a more elegant
                    affair, we have the expertise and creativity to make your birthday celebration a momentous occasion
                    that you and your guests will cherish for years to come.
                </p></br>
            </div>
            <div class="imgb">
                <img class="lazy loaded" src="assests/images/birthday.png" alt="" data-was-processed="true">
            </div>
        </div><BR><br>

        <!--party-->
        <div class="party">
            <div class="box">
                <h1 class="title">PARTIES BY PERFICIENT</h1>
            </div>
        </div>
        <div class="main">
            <div class="p1">
                <p>
                    A party is more than just an event; it's a celebration of life and shared moments with friends and
                    family. At our event planning agency, we understand the importance of every occasion, whether it's a
                    birthday, anniversary, or just a gathering to enjoy good company.
                </p></br>
                <p>
                    We offer a range of options for your party, from cozy indoor settings to vibrant outdoor venues,
                    ensuring that your chosen atmosphere perfectly complements the mood of the event. Our dedicated team
                    works tirelessly to create a personalized experience, incorporating your preferences and ideas into
                    every aspect of the celebration.
                </p></br>
                <p>
                    Moreover, we pay attention to the little details that make a big difference, from thematic
                    decorations and delicious menus to engaging activities and entertainment. With our expertise and
                    passion for creating memorable experiences, we guarantee that your party will be a joyous and
                    unforgettable occasion for you and your guests to cherish.
                </p></br>
            </div>
            <div class="imgp">
                <img class="lazy loaded" src="assests/images/party.png" alt="" data-was-processed="true">
            </div>
        </div><BR><br>

        <div class="foot">
            <footer>
                <p>&copy; Copyrights reserved 2024 | <a href="http://www.perficient.com" target="_blank"
                        style="text-decoration: none; color: #ffffff;">www.perficient.com</a></p>

            </footer>
        </div>
</body>

</html>