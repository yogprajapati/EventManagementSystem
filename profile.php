<?php

include ("authentication/dbconnection.php");

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | The Preficient</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="Components/css/profile.css">
</head>

<body>

    <?php
   $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   $select_profile->bind_param("i", $user_id);
   $select_profile->execute();
   $select_profile->store_result(); 
   $num_rows = $select_profile->num_rows;

    if ($num_rows > 0) {
        $select_profile->bind_result($id, $name, $email, $phoneno,$password , $created_on , $time);
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


        <div class="main-content">
            <h1 class="name">Welcome
                <?= $name; ?>
            </h1>
        </div>

        <section class="user-details">
            <div class="user">
                <?php

                ?>
                <img src="assests/images/user-icon.png" alt="">
                <p><i class="fas fa-id-badge"></i><span>
                            <?= $id; ?>
                        </span></p>
                        
                <p><i class="fas fa-user"></i><span>
                    <?= $name; ?>
                    </span></p>

                <p><i class="fas fa-phone"></i><span>
                <?= $phoneno; ?>
                    </span></p>

                    <p ><i class="fas fa-envelope"></i><span >
                <?= $email; ?>
                    </span></p>

                    <p ><i class="fas fa-clock"></i><span>
                <?= $created_on; ?>
                    </span></p>

                <a href="update_profile.php" class="btn">update info</a>
            </div>


        </section>



        <?php
    } else {
        echo 'No Record Found!';
    }

    ?>
</body>

</html>