<?php
include ("../authentication/dbconnection.php");
$count_users = $conn->query("SELECT COUNT(*) as total_users FROM `users`")->fetch_assoc()['total_users'];

$count_birth = $conn->query("SELECT COUNT(*) as total_birth FROM `birthday`")->fetch_assoc()['total_birth'];


$count_corporate = $conn->query("SELECT COUNT(*) as total_corporate FROM `corporate`")->fetch_assoc()['total_corporate'];


$count_wedding = $conn->query("SELECT COUNT(*) as total_wedding FROM `wedding`")->fetch_assoc()['total_wedding'];

$count_message = $conn->query("SELECT COUNT(*) as total_message FROM `messages`")->fetch_assoc()['total_message'];
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-rounded-bars"></script>
  <style>
    .content-area {
      padding: 20px;
    }

    .box {
      background-color: #f3f3f3;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .box h2 {
      margin-top: 0;
      margin-bottom: 10px;
    }

    .chart {
      width: 100%;
      height: 300px;
      background-color: #f9f9f9;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
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
              <a href="adminprofile.php">Profile</a>
              <a href="#">Logout</a>
            </div>
          </div>
        </div>

        <div class="content-area">
          <div class="box">
            <h2>Total no of users</h2>
            <canvas id="usersChart" width="400" height="200"></canvas>
            <p>Total:
              <?php echo $count_users ?>
            </p>
          </div>

          <div class="box">
            <h2>Birthday Events</h2>
            <canvas id="birthdayChart" width="400" height="200"></canvas>
            <p>Total:
              <?php echo $count_birth ?>
            </p>
          </div>

          <div class="box">
            <h2>Corporate Events</h2>
            <canvas id="corporateChart" width="400" height="200"></canvas>
            <p>Total:
              <?php echo $count_corporate ?>
            </p>
          </div>

          <div class="box">
            <h2>Wedding Events Events</h2>
            <canvas id="weddingChart" width="400" height="200"></canvas>
            <p>Total:
              <?php echo $count_wedding ?>
            </p>
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
  <script>
    // Get the count data from PHP
    var countUsers = <?php echo $count_users ?>;
    var countBirth = <?php echo $count_birth ?>;
    var countWedding = <?php echo $count_wedding ?>;
    var countCorporate = <?php echo $count_corporate ?>;

    // Chart.js code to create charts
    var usersChart = new Chart(document.getElementById('usersChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['Total Users'],
        datasets: [{
          label: 'Total Users',
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          data: [countUsers]
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          borderRadius: 10 // Sets the bar border radius
        }
      }
    });

    var birthdayChart = new Chart(document.getElementById('birthdayChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['Birthday Events'],
        datasets: [{
          label: 'Birthday Events',
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: [countBirth]
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          borderRadius: 10 // Sets the bar border radius
        }
      }
    });

    var weddingChart = new Chart(document.getElementById('weddingChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['Wedding Events'],
        datasets: [{
          label: 'Wedding Events',
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: [countWedding]
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          borderRadius: 10 // Sets the bar border radius
        }
      }
    });

    var corporateChart = new Chart(document.getElementById('corporateChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['Corporate Events'],
        datasets: [{
          label: 'Corporate Events',
          backgroundColor: 'rgba(255, 159, 64, 0.5)',
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 1,
          data: [countCorporate]
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          borderRadius: 10 // Sets the bar border radius
        }
      }
    });
  </script>
</body>
</html>


