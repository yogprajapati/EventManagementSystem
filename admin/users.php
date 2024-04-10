<?php
include ("../authentication/dbconnection.php");
session_start();
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    $admin_id = '';
    header("location:index.php");
}
$count_users = $conn->query("SELECT COUNT(*) as total_users FROM `users`")->fetch_assoc()['total_users'];

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
        :root {
            --main-color: #4834d4;
            --red: #e74c3c;
            --orange: #f39c12;
            --black: #34495e;
            --white: #fff;
            --light-bg: #f5f5f5;
            --light-color: #999;
            --border: .2rem solid var(--black);
            --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
        }

        h2 {
            text-align: center;
        }

        .content-area {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* gap: 1.5rem; */
            place-items: center;
            justify-content: center;
            align-items: flex-start;
        }

        .content-area .box {
            background-color: var(--white);
            border-radius: .5rem;
            box-shadow: var(--box-shadow);
            border: var(--border);
            text-align: center;
            width: 90%;
        }

        .content-area .box p {
            font-size: 1.4rem;
            color: var(--black);
        }

        .content-area .box p span {
            color: var(--main-color);
        }

        .delete-btn {
            display: block;
            /* margin-top: 1rem; */
            border-radius: .5rem;
            cursor: pointer;
            width: 50%;
            margin-left: 80px;
            font-size: 1.4rem;
            color: var(--white);
            padding: 5px;
            margin-bottom: 20px;
            text-transform: capitalize;
            text-align: center;
            background-color: var(--red);
        }

        .count-red {
            /* background-color: red; */
            color: #27c559;
            border-bottom: 2px solid darkblue;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_users->execute([$delete_id]);
    }
    ?>
    <div class="wrapper">
        <div class="sidenav">
            <div class="sidenav-header">
                <a href="#" class="logo">Welcome Admin!</a>
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
                <a href="#" class="user">Hello Admin ! <i class="fas fa-user"></i></a>
                <div class="dropdown">
                    <button class="dropbtn">More <i class="fas fa-angle-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>
            <h2>Users <span class="count-red">  Account (<?php echo$count_users; ?>)
                </span>
            </h2>
            <div class="content-area">
                <?php
                $select_account = $conn->prepare("SELECT * FROM `users`");
                $select_account->execute();
                $result = $select_account->get_result();
                if ($result->num_rows > 0) {
                    while ($fetch_accounts = $result->fetch_assoc()) {
                        ?>
                        <div class="box">
                            <p> user id : <span>
                                    <?= $fetch_accounts['id']; ?>
                                </span> </p>
                            <p> username : <span>
                                    <?= $fetch_accounts['name']; ?>
                                </span> </p>
                            <a href="users.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn"
                                onclick="return confirm('delete this account?');">delete</a>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="empty">no accounts available</p>';
                }
                ?>
            </div>
            <div class="foot">
                <footer>
                    <p>&copy; Copyrights reserved 2024 | <a href="http://www.perficient.com" target="_blank"
                            style="text-decoration: none; color: #ffffff;">www.perficient.com</a></p>

                </footer>
            </div>
        </div>

    </div>

</body>

</html>