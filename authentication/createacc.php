<?php
date_default_timezone_set('Asia/Kolkata');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["phoneno"];
    $password = $_POST["password"];

    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "event_planning";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $timestamp = date('Y-m-d H:i:s');

   
    $date = date('Y-m-d', strtotime($timestamp)); 
    $time = date('H:i:s', strtotime($timestamp)); 


    $sql = "INSERT INTO users (name, email, phoneno, password, created_on , time) VALUES ('$name', '$email', '$number', '$password','$date','$time')";

    $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, phoneno, password, created_on , time) VALUES (?, ?, ?, ?, ? , ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $number, $password, $date, $time);


    if (mysqli_stmt_execute($stmt)) {
        $subject = "Registration Confirmation";

        // Email body
        $message = "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Confirmation</title>
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
                ul {
                    padding-left: 20px;
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
                <p>Your account was successfully registered on <u> $date $time </u></p>
                <p>Please keep this email for your records.</p>
                <ul>
                    <li>Login with your email address: $email</li>
                    <li>Password: $password</li>
                    <li>Explore the various features and resources available</li>
                </ul>
                <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
                <p class='footer'>Best regards,<br>YYYN TEAM</p>
            </div>
        </body>
        </html>";
      
        $headers = "From:tutorialhubofficial11@gmail.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "X-Priority: 1\r\n"; 

        // Send the email
        $mailSent = mail($email, $subject, $message, $headers);



        header("Location: createaccount.php?remarks=success");
        exit();
    } else {
        $error_message = mysqli_error($con);
        header("Location: signin.php?remarks=error&value=$error_message");
        exit();
    }

    $conn->close();
}

?>