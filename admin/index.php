<?php

include '../authentication/dbconnection.php';

session_start();

if (isset($_POST['submit'])) {

    $name = $_POST['username'];
    $pass = $_POST['pass'];

    $select_admin = ("SELECT * FROM `admin` WHERE name = '$name' AND password = '$pass'");

    $result = $conn->query($select_admin);

    $row_count = $result->num_rows;
    if ($row_count > 0) {
        $fetch_admin_id = $result->fetch_assoc();
        $_SESSION['admin_id'] = $fetch_admin_id['adminid'];
        header('location:dashboard.php');
    } else {
        $message[] = 'incorrect username or password!';
    }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login | The Perficient</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="adminlogin.css">

</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>

    <!-- admin login form section starts  -->
    <div class="blink">
        <p>WARNING!</p>
    </div>
    <p>Only Authorized Persons can access this portal services!</p>
    <section class="form-container">

        <form action="" method="POST">
            <h3>login now</h3>
            <!-- <p>default username = <span>admin</span> & password = <span>111</span></p> -->
            <input type="text" name="username" maxlength="20" required placeholder="enter your username" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="login now" name="submit" class="btn">
        </form>

    </section>

    <!-- admin login form section ends -->











</body>

</html>