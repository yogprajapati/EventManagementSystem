<?php
include ("dbconnection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $captcha = $_POST["captcha"];

    if (isset($_SESSION["captcha_code"]) && $captcha === $_SESSION["captcha_code"]) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            if ($password == $row["password"]) {

                $_SESSION["user_id"] = $row["id"];

                header("Location: ../index.php");

                exit();
            } else {
                $errorMessage = "Invalid email or password. Please try again.";
            }
        } else {

            $errorMessage = "User not found. Please register.";
        }
    } else {

        $errorMessage = "CAPTCHA verification failed. Please try again.";
    }


    $conn->close();
}

include ("login.php");
?>