<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Components/css/dashboard1.css">
</head>

</html>
<?php
include ("authentication/dbconnection.php");

date_default_timezone_set('Asia/Kolkata');
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// Fetch the name from the users table
$select_profile = $conn->prepare("SELECT name FROM `users` WHERE id = ?");
$select_profile->bind_param("i", $user_id);
$select_profile->execute();
$select_profile->store_result();

if ($select_profile->num_rows > 0) {
    $select_profile->bind_result($name);
    $select_profile->fetch();

    // Navbar
    echo "
    <div class='nav-main'>
        <nav class='navbar'>
            <div class='logo'>
                <a href='#' class='logo-text'>The Perficient</a>
            </div>
            <div class='nav-items'>
                <p>User Events</p>
            </div>

            <div class='user-select'>
                <select name='' onchange='userselect(this.value)' id=''>
                    <option value='home'>Home</option>
                    <option value='profile.php'>Profile</option>
                    <option value='logout'>Log out</option>
                </select>

                <script>
                    function userselect(option) {
                        if (option === 'home') {
                            window.location.href = 'index.php';
                        } else if (option === 'profile.php') {
                            window.location.href = 'profile.php';
                        } else if (option === 'logout') {
                            window.location.href = 'authentication/logout.php';
                        }
                    }
                </script>
            </div>
        </nav>
    </div>

    <div class='main-content'>
        <h1 class='name'>Welcome
            {$name}
        </h1>
    </div>

    ";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['events'])) {
            $selectedEvents = $_POST['events'];
            foreach ($selectedEvents as $event) {
                switch ($event) {
                    case 'wedding':
                        echo display_wedding_data($conn, $user_id);
                        break;
                    case 'corporate':
                        echo display_corporate_data($conn, $user_id);
                        break;
                    case 'birthday':
                        echo display_birthday_data($conn, $user_id);
                        break;
                    default:
                        // Handle unknown event type
                        break;
                }
            }
        }
    }


    // Form for checkboxes
    echo "
    <form action='' method='post'>
    <label for=''>SELECT EVENTS</label><br>
    <input type='checkbox' name='events[]' id='wedding' value='wedding'>
    <label for='wedding'>WEDDINGS</label>
    <input type='checkbox' name='events[]' id='corporate' value='corporate'>
    <label for='corporate'>CORPORATE</label>
    <input type='checkbox' name='events[]' id='birthday' value='birthday'>
    <label for='birthday'>BIRTHDAY</label>
    <input type='submit' name='submit' value='Get Data'>
</form>

    ";
} else {
    echo 'No Record Found!';
}

// Display wedding data
// Display wedding data
function display_wedding_data($conn, $user_id)
{
    $select_profile = $conn->prepare("SELECT * FROM `wedding` WHERE userid = ?");
    $select_profile->bind_param("i", $user_id);
    $select_profile->execute();
    $result = $select_profile->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='weddingtable' id='weddingtable'>";
        echo "<caption>WEDDING EVENT</caption>";
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>STATUS</th>
                <th>BRIDE NAME</th>
                <th>GROOM NAME</th>
                <th>VENUE</th>
                <th>SAVE REQUEST</th>
                <th>CITY</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['bride_name']}</td>
                    <td>{$row['groom_name']}</td>
                    <td>{$row['venue']}</td>
                    <td>{$row['save_req']}</td>
                    <td>{$row['city']}</td>
                  </tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No Record Found";
    }
}

// Similarly update display_corporate_data and display_birthday_data functions


// Display corporate data

// Display corporate data
function display_corporate_data($conn, $user_id)
{
    $select_profile = $conn->prepare("SELECT * FROM `corporate` WHERE userid = ?");
    $select_profile->bind_param("i", $user_id);
    $select_profile->execute();
    $result = $select_profile->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='corporatetable' id='corporatetable'>";
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>STATUS</th>
                <th>COMPANY NAME</th>
                <th>PURPOSE</th>
                <th>EVENT LOCATION</th>
                <th>EVENT DATE</th>
                <th>EVENT TIME</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['company_name']}</td>
                    <td>{$row['purpose']}</td>
                    <td>{$row['location']}</td>
                    <td>{$row['event_date']}</td>
                    <td>{$row['event_time']}</td>
                  </tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No Record Found";
    }
}

// Display birthday data
function display_birthday_data($conn, $user_id)
{
    $select_profile = $conn->prepare("SELECT * FROM `birthday` WHERE userid = ?");
    $select_profile->bind_param("i", $user_id);
    $select_profile->execute();
    $result = $select_profile->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='table' id='table'>";
        echo "<table border='1px' class='table-info'>";
        echo "<caption>Birthday Data</caption>";
        echo "<tr>
              
                <th>NAME OF REGISTRAR</th>
                <th>BIRTHDAY NAME</th>
                <th>AGE</th>
                <th>DATE</th>
                <th>TIME</th>
                <th>STATE</th>
                <th>CITY</th>
                <th>VENUE</th>
                <th>STATUS</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            $statusColor = ($row['status'] == 'pending') ? 'red' : 'green';
            echo "<tr>
                   
                    <td>{$row['regname']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['time']}</td>
                    <td>{$row['state']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['venue']}</td>
                    <td style='color: $statusColor;'>{$row['status']}</td>
                  </tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No Record Found";
    }
}

?>