<?php

include ("authentication/dbconnection.php");

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
$updated_details = array();
if (isset($_POST['submit'])) {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
    $old_pass = filter_input(INPUT_POST, 'old_pass', FILTER_SANITIZE_STRING);
    $new_pass = filter_input(INPUT_POST, 'new_pass', FILTER_SANITIZE_STRING);
    $confirm_pass = filter_input(INPUT_POST, 'confirm_pass', FILTER_SANITIZE_STRING);

    $select_current_info = $conn->prepare("SELECT email, name FROM `users` WHERE id = ?");
    $select_current_info->bind_param("i", $user_id);
    $select_current_info->execute();
    $select_current_info->bind_result($current_email, $current_name);
    $select_current_info->fetch();
    $select_current_info->close();


    if (!empty($name)) {
        $update_name = $conn->query("UPDATE `users` SET name = '$name' WHERE id = '$user_id'");
        if ($update_name) {
            $updated_details['name'] = $name;
        }

        $message[] = 'Name Changed Successfully';
    }

    if (!empty($email)) {
        $select_email = $conn->query("SELECT * FROM `users` WHERE email = '$email'");
        if ($select_email->num_rows > 0) {
            $message[] = 'Email already taken!';
        } else {
            $update_email = $conn->query("UPDATE `users` SET email = '$email' WHERE id = '$user_id'");
            if ($update_email) {
                $updated_details['email'] = $email;
            }
            // $subject = "Your email has been updated";
            // $body = "Dear $current_name , Your email has been updated to: $email";
            // $headers = "From: tutorialhubofficial11@gmail.com";
            // mail($current_email, $subject, $body, $headers);

        }
    }

    if (!empty($number)) {
        $select_number = $conn->query("SELECT * FROM `users` WHERE phoneno = '$number'");
        if ($select_number->num_rows > 0) {
            $message[] = 'Number already taken!';
        } else {
            $update_number = $conn->query("UPDATE `users` SET phoneno = '$number' WHERE id = '$user_id'");
            if ($update_number) {
                $updated_details['phoneno'] = $number;
            }
        }
    }

    if (!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass)) {
        $select_prev_pass = $conn->query("SELECT password FROM `users` WHERE id = '$user_id'");
        $fetch_prev_pass = $select_prev_pass->fetch_assoc();
        $prev_pass = $fetch_prev_pass['password'];

        if ($old_pass != $prev_pass) {
            $message[] = 'Old password not matched!';
        } elseif ($new_pass != $confirm_pass) {
            $message = 'Confirm password not matched!';
        } else {
            $update_pass = $conn->query("UPDATE `users` SET password = '$new_pass' WHERE id = '$user_id'");
            $message[] = 'Password updated successfully!';
            if ($update_pass) {
                $updated_details['password'] = $new_pass;
            }
        }
    }
    ?>
    <?php

    if (!empty($updated_details)) {
        $to = $current_email;
        $subject = 'Profile Updated';
        $message = 'Hello ' . $name . ',\n\nYour profile details have been updated:\n\n';
        foreach ($updated_details as $key => $value) {
            $message .= $key . ': ' . $value . "\n";
        }
        $headers = 'From: tutorialhub11@gmail.com' . "\r\n" .
            'Reply-To: $current_email' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    ?>
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

    <?php

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | The Prefecient</title>
    <link rel="stylesheet" href="Components/css/update.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <?php
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->bind_param("i", $user_id);
    $select_profile->execute();
    $select_profile->store_result();
    $num_rows = $select_profile->num_rows;

    if ($num_rows > 0) {
        $select_profile->bind_result($id, $name, $email, $phoneno, $password, $created_on, $time);
        $select_profile->fetch();
        ?>

        <div class="nav-main">
            <nav class="navbar">
                <div class="logo">
                    <a href="#" class="logo-text">The Perficient</a>
                </div>
                <div class="nav-items">
                    <p>User Profile</p>
                </div>

                <div class="user-select">
                    <select name="" onchange="userselect(this.value)" id="">
                        <option value="">Profile</option>
                        <option value="home">Home</option>
                        <option value="dashboard">Dashboard</option>
                        <option value="logout">Log out</option>
                    </select>

                    <script>
                        function userselect(option) {
                            if (option === "home") {
                                window.location.href = "index.php";
                            } else if (option === "dashboard") {
                                window.location.href = "dashboard1.php";
                            } else if (option === "logout") {
                                window.location.href = "authentication/logout.php";
                            }
                        }
                    </script>
                </div>
            </nav>
        </div>
        <section class="update-form">
            <form action="" method="post">
                <h2>UPDATE PROFILE</h2>
                <input type="text" name="name" placeholder="<?= $name; ?>" id="">
                <input type="number" name="number" placeholder="<?= $phoneno; ?>" id="">
                <input type="email" name="email" placeholder="<?= $email; ?>" id="">
                <input type="password" name="old_pass" placeholder="Enter your old password">
                <input type="password" name="new_pass" placeholder="Enter your new password" id="">
                <input type="password" name="confirm_pass" placeholder="Confirm your new password" id="">
                <input class="btn" name="submit" type="submit" value="Update">
            </form>
        </section>
        <?php

    }
    ?>
</body>

</html>