<?php
include ("../authentication/dbconnection.php");

session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    $admin_id = '';
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <style>
        .box1 {
            display: flex;
            flex-direction: column;
            width: 30%;
            border: 2px solid black;
            padding: 20px;
            gap: 5px;
            justify-content: center;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: red;
        }

        .box1 input {
            padding: 10px;
            outline: none;
            border: none;
            font-size: 20px;

        }
        .form-group{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }
    </style>
</head>

<body>
    <?php
    $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE adminid = ?");
    $select_profile->bind_param("i", $admin_id);
    $select_profile->execute();
    $select_profile->store_result();
    $num_rows = $select_profile->num_rows;

    if ($num_rows > 0) {
        $select_profile->bind_result($adminid, $name, $password);
        $select_profile->fetch();
        ?>

        <div class="wrapper">
            <div class="sidenav">
                <div class="sidenav-header">
                    <a href="#" class="logo">Admin Panel
                    </a>
                </div>

                <nav class="sidenav-menu">
                    <ul>
                        <li><a href="dashboard.php">Dashboard <i class="fas fa-chart-line"></i></a></li>
                        <li><a href="users.php">Users <i class="fas fa-users"></i></a></li>
                        <li><a href="#">Settings <i class="fas fa-cog"></i></a></li>
                    </ul>
                </nav>
            </div>

            <div class="main-content">
                <div class="topnav">
                    <a href="#" class="user">Hello
                        <?= $name ?> ! <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown">
                        <button class="dropbtn">More <i class="fas fa-angle-down"></i></button>
                        <div class="dropdown-content">
                            <a href="#">Profile</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="content-area">
                    <div class="box1">
                        <h2 readonly>Admin information</h2>
                        <div class="form-group">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="" readonly placeholder="<?= $admin_id ?>" id="">
                        </div>
                       
                        <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="" readonly placeholder="<?= $name ?>" id="">
                        </div>
                        
                        <div class="form-group">
                        <i class="fas fa-key"></i>
                        <input type="text" name="" readonly placeholder="<?= $password ?>" id="">
                        </div>
                        
                    </div>
                </div>
                <div class="foot">
                    <footer>
                        <p>&copy; Copyrights reserved 2024 | <a href="http://www.perficient.com" target="_blank"
                                style="text-decoration: none; color: #ffffff;">www.perficient.com</a></p>

                    </footer>
                </div>
            </div>
            <?php
    }
    ?>
    </div>

</body>

</html>