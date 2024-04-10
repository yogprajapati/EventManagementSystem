<?php
date_default_timezone_set('Asia/Kolkata');
include ("authentication/dbconnection.php");

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
?>

<?php

$timestamp = date('Y-m-d H:i:s');


$date = date('Y-m-d', strtotime($timestamp)); 
$time = date('H:i:s', strtotime($timestamp)); 

if (isset($_POST['submit'])) {
    $name = $_POST["username"];
    $useremail = $_POST["user_email"];
    $user_message = $_POST["message"];

    $sql = "INSERT INTO messages (name,email,message) VALUES ('$name','$useremail','$user_message')";

    $success = mysqli_query($conn, $sql);

    if ($success) {
        $message = 'Your message has been sent successfully';
        $subject = "Contact Comfirmation!";

        $msg= "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333333;
                    background-color: #f4f4f4;
                    padding: 20px;
                    margin: 0;
                }
                .container {
                    max-width: 600px;
                    margin: auto;
                    background: #fff;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #007BFF;
                    margin-top: 0;
                }
                p {
                    margin: 10px 0;
                }
                a {
                    color: #007BFF;
                }
                .footer {
                    margin-top: 20px;
                    text-align: center;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Dear $name,</h2>
                <p>Your response was successfully recorded on  <u> $date $time </u></p>
                <p> Your recorded message - $user_message </p>
                <p> We will contact you as soon as possible </p>
                <p class='footer'>Best regards,<br>The Perficient</p>
            </div>
        </body>
        </html>";
       
        $headers = "From:tutorialhubofficial11@gmail.com\r\n";
        $headers .= "Reply-To: $useremail\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "X-Priority: 1\r\n"; 

       
        $mailSent = mail($useremail, $subject, $msg, $headers);

    } else {
        $message = 'Error occured while sending message';
    }


}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Perficient</title>
    <link rel="stylesheet" href="Components/css/contact.css">


    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <style>
        .red {
            color: red;
            font-size: 20px;
        }
    </style>
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
                                window.location.href = "dashboard1.php";
                            } else if (option === "edit_profile") {
                                window.location.href = "update_profile.php";
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
                        <span style="font-size: 28px;">"Crafting Moments, Creating Memories: Your Perfect Event Starts
                            Here!"</span>
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

        <body style="font-family: Arial, sans-serif;  color: blanchedalmond;">
            <?php
            if (isset($message)) {
                if (is_array($message)) {
                    foreach ($message as $msg) {
                        echo '
                <div class="message">
                    <span>' . $msg . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            ';
                    }
                } else {
                    echo '
            <div class="message">
                <span>' . $message . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>

            </div>
        ';
                }
            }
            ?>
            <div class="form1">
                <form action="" method="post" class="form-group">
                    <h1>Contact us</h1><br>
                    <hr><br><br>
                    <label for="username" class="lbl">Your Name: <span class="red">*</span> </label>
                    <input type="text" name="username" required="" class="yrtxt" id="username"><br><br>
                    <label for="user_email" class="lbl">Email <span class="red">*</span></label>
                    <input type="text" class="conotxt" required="" name="user_email" id="user_email"><br><br>
                    <label for="subject" class="lbl">What do you want to Ask ? <span class="red">*
                        </span></label><br><br>
                    <textarea id="subject" class="queytxt" required="" name="message" name="subject"
                        placeholder="Write something.." style="height:150px"></textarea>
                    <input type="submit" name="submit" class="sbmt">
                </form>
            </div>
            <div class="overview-grid">
                <div class="box1 box">

                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-telephone" viewBox="0 0 16 16" style="margin-left: 50px;">
                        <path
                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>
                    <span style="margin-left: 10px;">+91 1234567890</span>
                </div>
                <div class="box1 box" style="width: 220px;">

                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-envelope-at-fill" viewBox="0 0 16 16" style="margin-left: 75px;">
                        <path
                            d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671" />
                        <path
                            d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791" />
                    </svg>
                    <span>tutorialhub11@gmail.com</span>
                </div>
                <div class="box1 box">

                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-geo-alt" viewBox="0 0 16 16" style="margin-left: 50px;">
                        <path
                            d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, saepe.</span>
                </div>
            </div>
            <div class="foot">
                <footer>
                    <p>&copy; Copyrights reserved 2024 | <a href="http://www.perficient.com" target="_blank"
                            style="text-decoration: none; color: #ffffff;">www.perficient.com</a></p>

                </footer>
            </div>
        </body>

</html>