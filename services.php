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
    <title>The Perficient</title>
    <link rel="stylesheet" href="components/css/services.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <style>
        .red {
            color: red;
            font-size: 20px;
        }

        .note {
            background-color: #ed9c9c;
            color: #e10a0a;
            text-align: center;
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            font-style: 500;
            text-decoration: underline;
            font-size: 18px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .note-head {
            font-weight: 900;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <script src="Components/js/script.js"></script>
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
                                window.location.href = "edit_profile.php";
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
                <div class="right-side">
                    <img src="
                        alt="">
                </div>
            </div>
        </div><br><br>

        <!-- start -->

        <?php
        if (isset($_GET['remarks']) && $_GET['remarks'] == 'birthsuccess') {
            echo '<div class="message">';
            echo '<span>Your form was submitted successfully!</span><br>';
            echo '<a class="download-pdf" href="event_pdf/birthday_event_.pdf" download="birthday_event_.pdf">Download PDF</a>';
            echo '<i class="fas fa-times" onclick="closeMessage();"></i>';
            echo '</div>';
        }
        ?>
<?php
if (isset($_GET['remarks']) && $_GET['remarks'] == 'corporatesuccess') {
    echo '<div class="message">';
    echo '<span>Your form was submitted successfully!</span><br>';
    echo '<a class="download-pdf" href="event_pdf/corporate_event_.pdf" download="corporate_event_.pdf">Download PDF</a>';

    echo '<i class="fas fa-times" onclick="closeMessage();"></i>';
    echo '</div>';
}


?>

<?php
if (isset($_GET['remarks']) && $_GET['remarks'] == 'weddingsuccess') {

    echo '<div class="message">';
    echo '<span>Your form was submitted successfully!</span><br>';
    echo '<a class="download-pdf" href="event_pdf/wedding_event_.pdf" download="wedding_event_.pdf">Download PDF</a>';

    echo '<i class="fas fa-times" onclick="closeMessage();"></i>';
    echo '</div>';
}


?>

<script>
    function closeMessage() {
        document.querySelector('.message').remove();
        window.location.href = 'services.php';
    }
</script>





                    <body style=" font-family: Arial, sans-serif; color: blanchedalmond;">

                    <div class="note">
                        <span class="note-head">Note : </span> kindly do login before submitting data otherwise data
                        couldn't be sent! <a href="authentication/login.php">Click here to login!</a>
                    </div>
                    <div class="form1">
                        <form method="GET" action="dataentry.php">
                            <h1>Create Your Event</h1><br>
                            <hr><br>
                            <div class="form-group1">
                                <label for="event-type"
                                    style="margin-left: 380px ; font-weight: bold; margin-bottom: 5px;">Select Event
                                    Type:</label><br><br>
                                <select id="event-type" name="event-type" class="seletor" onchange="showFields()">
                                    <option selected value="">Select</option>
                                    <option value="birthday">Birthday Party</option>
                                    <option value="corporate">Corporate Event</option>
                                    <option value="wedding">Wedding</option>
                                </select><br><br>
                            </div><br>

                            <div id="birthday-fields" class="hidden gap" style="display: none;">
                                <h2>Birthday Party Details</h2><br>

                                <div class="form-group">
                                    <label for="birthday-person-name" class="lbl">Name <span
                                            class="red">*</span></label>
                                    <input type="text" class="yrtxt"  id="textfield" name="regname">
                                </div> <br>

                                <div class="form-group">
                                    <label for="birthday-person-name" class="lbl">Name of Birthday Person <span
                                            class="red">*</span></label>
                                    <input type="text" class="brtxt"  id="textfield" name="name">
                                </div> <br>

                                <div class="form-group">
                                    <label for="age" class="lbl">Age <span class="red">*</span></label>
                                    <input type="number" name="age"  class="age" id="age">
                                </div> <br>

                                <div class="form-group">
                                    <label for="date" class="lbl">Date <span class="red">*</span></label>
                                    <input type="date" name="date"  id="date">
                                </div> <br>

                                <div class="form-group">
                                    <label class="lbl" for="time">Time <span class="red">*</span></label>
                                    <input type="time" name="time"  id="time">
                                </div> <br>

                                <div class="form-group">
                                    <label for="cake" class="lbl">Cake Flavour <span class="red">*</span></label>
                                    <select name="cake" class="cakesl dropdown"  id="cake">
                                        <option value="" selected>Select</option>
                                        <option value="vanilla">Vanilla</option>
                                        <option value="choclate">Chocolate</option>
                                        <option value="strawberry">Strawberry</option>
                                        <option value="red-velvet">Red Velvet</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div> <br>

                                <div class="form-group">
                                    <label for="dietary-res" class="lbl">Any Dietary Restrictions?</label>
                                    <input type="text" class="adrtxt" id="dietary-res" name="dietryrestriction">
                                </div> <br>

                                <div class="form-group">
                                    <label for="people" class="lbl">How many people? <span class="red">*</span></label>
                                    <select name="birth-people" id="people"  class="pplsl dropdown">
                                        <option value="10-50">10 - 50</option>
                                        <option value="100-200">100 - 200</option>
                                        <option value="200-300">200 - 300</option>
                                        <option value="300-400">300 - 400</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="state" class="lbl">Select State <span class="red">*</span></label>
                                    <select id="stateSelect" name="birth-state"  class="pplsl dropdown"
                                        onchange="populateCities()">
                                        <option value="select">Select State</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="city" class="lbl">Select City <span class="red">*</span></label>
                                    <select name="birth-city" class="pplsl dropdown" 
                                        onchange="populateVenues()" id="citySelect">
                                        <option value="select">Select City</option>
                                    </select>
                                </div><br>


                                <div class="form-group">
                                    <label for="venue" class="lbl">Select Venue <span class="red">*</span></label>
                                    <select name="birth-venue" class="pplsl dropdown"  onchange=""
                                        id="venueSelect">
                                        <option value="select">Select</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="any-req" class="lbl">Any Special Requirements?</label>
                                    <input type="text" class="asrtxt" id="any-req" name="specialreq"><br><br>
                                </div>


                                <div class="form-group">
                                    <input type="submit" name="submit" class="sbmt">
                                </div>
                            </div>
                            <!-- Birthday Fields Ends -->


                            <!-- Corporate Field Starts -->
                            <div id="corporate-fields" class="hidden" style="display: none;">
                                <h2>Corporate Event Details</h2><br>

                                <div class="form-group">
                                    <label for="corp_username" class="lbl">Name <span class="red">*</span></label>
                                    <input type="text" name="corp_username" id="corp_username">
                                </div><br>


                                <div class="form-group">
                                    <label for="company-name" class="lbl">Company Name <span
                                            class="red">*</span></label>
                                    <input type="text" name="company_name" id="company-name">
                                </div><br>


                                <div class="form-group">
                                    <label for="purpose" class="lbl">Purpose of event :<span
                                            class="red">*</span></label>
                                    <input type="text" name="purpose" id="purpose">
                                </div><br>

                                <div class="form-group">
                                    <label for="location" class="lbl">Preferred location<span
                                            class="red">*</span></label>
                                    <input type="text" name="location" id="location">
                                </div><br>

                                <div class="form-group">
                                    <label for="people" class="lbl">No. of attendes?<span class="red">*</span></label>
                                    <select name="people" id="people" class="pplsl dropdown">
                                        <option value="10-50">10 - 50</option>
                                        <option value="100-200">100 - 200</option>
                                        <option value="200-300">200 - 300</option>
                                        <option value="300-400">300 - 400</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="Beverages" class="lbl">Beverages</label>
                                    <input type="text" name="beverages" id="Beverages">
                                </div><br>

                                <div class="form-group">
                                    <label for="event-date" class="lbl">Event Date<span class="red">*</span></label>
                                    <input type="date" name="event-date" id="event-date">
                                </div><br>

                                <div class="form-group">
                                    <label for="event-time" class="lbl">Event Time<span class="red">*</span></label>
                                    <input type="time" name="event-time" id="event-time">
                                </div><br>

                                <div class="form-group">
                                    <label for="seating" class="lbl">Seating arrangements<span
                                            class="red">*</span></label>
                                    <input type="text" name="seating" id="seating">
                                </div>

                                <div class="form-group">
                                    <label for="any-req" class="lbl">Any Special Requirements?</label>
                                    <input type="text" class="asrtxt" id="any-req" name="any-req">
                                </div><br>

                                <div class="form-group">
                                    <input type="submit" name="submit" class="sbmt">
                                </div>
                            </div><br>
                            <!-- Corporate Fields Ends -->


                            <!-- Wedding Fields Starts -->

                            <div id="wedding-fields" class="hidden" style="display: none;">

                                <h2>Wedding Details</h2><br>
                                <div class="form-group">
                                    <label for="weddname" class="lbl">Your Name: </label>
                                    <input type="text" class="yrtxt" name="nameofreg" id="weddname">
                                </div><br>

                                <div class="form-group">
                                    <label for="bride-name" class="lbl">Bride's Name:</label>
                                    <input type="text" class="brdtxt" name="bride-name" id="bride-name">
                                </div><br>


                                <div class="form-group">
                                    <label for="groom-name" class="lbl">Groom's Name:</label>
                                    <input type="text" name="groom-name" class="grtxt" id="groom-name">
                                </div><br>

                                <!-- <script>
                                    function populateCities2() {
                                        var stateSelect = document.getElementById("stateSelect2");
                                        var citySelect = document.getElementById("citySelect2");
                                        var selectedState = stateSelect.value;

                                        citySelect.innerHTML = "";

                                        if (selectedState === "Gujarat") {
                                            var cities = ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Gandhinagar", "Bhavnagar", "Junagadh", "Anand", "Jamnagar"];
                                        } else if (selectedState === "Maharashtra") {
                                            var cities = ["Mumbai", "Pune", "Nagpur", "Nashik", "Thane", "Aurangabad", "Solapur", "Kolhapur", "Amravati"];
                                        }

                                        cities.forEach(function (city) {
                                            var option = document.createElement("option");
                                            option.text = city;
                                            option.value = city.toLowerCase().replace(/\s+/g, '');
                                            citySelect.add(option);
                                        });
                                    }


                                    function populateVenues2() {
                                        var venueSelect = document.getElementById("venueSelect2");
                                        var selectedCity = document.getElementById("citySelect2").value;
                                        var venues = [];


                                        if (selectedCity === "ahmedabad") {
                                            venues = ["Williams Zone", "Real Paprika", "Dominoz pizza"];
                                        } else if (selectedCity === "mumbai") {
                                            venues = ["Venue A", "Venue B", "Venue C"];
                                        }


                                        venueSelect.innerHTML = "<option value='select'>Select Venue</option>";
                                        venues.forEach(function (venue) {
                                            var option = document.createElement("option");
                                            option.text = venue;
                                            option.value = venue.toLowerCase().replace(/\s+/g, '');
                                            venueSelect.add(option);
                                        });
                                    }

                                </script> -->
                                <div class="form-group">
                                    <label for="state" class="lbl">Select State</label>
                                    <select id="stateSelect2" name="state" class="pplsl dropdown"
                                        onchange="populateCities2()">
                                        <option value="select">Select State</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="city" class="lbl">Select City</label>
                                    <select name="city" id="citySelect2" class="pplsl dropdown"
                                        onchange="populateVenues2()" id="citySelect">
                                        <option value="select">Select City</option>
                                    </select>
                                </div><br>


                                <div class="form-group">
                                    <label for="venue" class="lbl">Select Venue</label>
                                    <select name="venue" class="pplsl dropdown" onchange="" id="venueSelect2">
                                        <option value="select">Select</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="Style-pref" class="lbl">Style Prefernces</label>
                                    <select name="style-pref" class="dropdown" id="style-pref">
                                        <option value="select" selected>Select Style</option>
                                        <option value="classic">Classic/Elegant</option>
                                        <option value="rustic">Rustic/Vintage</option>
                                        <option value="bohemian">Bohemian/Whimsical</option>
                                        <option value="modern">Modern/Minimalist</option>
                                        <option value="glamorous">Glamorous</option>
                                        <option value="romantic">Romantic</option>
                                        <option value="cultural">Cultural/Traditional</option>
                                    </select>
                                </div><br>


                                <div class="form-group">
                                    <label for="people3" class="lbl">No. of attendes?</label>
                                    <select name="people3" id="people3" class="pplsl dropdown">
                                        <option value="">10 - 50</option>
                                        <option value="">100 - 200</option>
                                        <option value="">200 - 300</option>
                                        <option value="">300 - 400</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="save-req" class="lbl">Save Date Requirements?</label>
                                    <input type="date" name="save-req" id="save-req">
                                </div><br>


                                <div class="form-group">
                                    <label for="appetizerSelect" class="lbl">Appetizers</label>
                                    <select id="appetizerSelect" name="appetizer" class="dropdown">
                                        <option value="select">Select Appetizer</option>
                                        <option value="capreseSalad">Caprese Salad</option>
                                        <option value="stuffedMushrooms">Stuffed Mushrooms</option>
                                        <option value="shrimpCocktail">Shrimp Cocktail</option>
                                        <option value="bruschetta">Bruschetta</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="mainCourseSelect" class="lbl">Main Course</label>
                                    <select id="mainCourseSelect" name="maincourse" class="dropdown">
                                        <option value="select">Select Main Course</option>
                                        <option value="filetMignon">Filet Mignon</option>
                                        <option value="salmon">Salmon with Dill Sauce</option>
                                        <option value="vegetableLasagna">Vegetable Lasagna</option>
                                        <option value="chickenMarsala">Chicken Marsala</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="sideDishesSelect" class="lbl">Side Dishes</label>
                                    <select id="sideDishesSelect" name="sidedish" class="dropdown">
                                        <option value="mashedPotatoes">Mashed Potatoes</option>
                                        <option value="roastedVegetables">Roasted Vegetables</option>
                                        <option value="garlicBread">Garlic Bread</option>
                                        <option value="caesarSalad">Caesar Salad</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="dessertSelect" class="lbl">Desserts</label>
                                    <select id="dessertSelect" name="dessert" class="dropdown">
                                        <option value="select">Select Dessert</option>
                                        <option value="weddingCake">Wedding Cake</option>
                                        <option value="cheesecake">Cheesecake</option>
                                        <option value="chocolateMousse">Chocolate Mousse</option>
                                        <option value="fruitTart">Fruit Tart</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="any-requestwed" class="lbl">Any Requirements?</label>
                                    <input type="text" name="any-requestwed" id="any-requestwed">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" class="sbmt">
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br>
                    <div class="foot">
                        <footer>
                            <p>&copy; Copyrights reserved 2024 | <a href="http://www.perficient.com" target="_blank"
                                    style="text-decoration: none; color: #ffffff;">www.perficient.com</a></p>

                        </footer>
                    </div>

                    <script>
                        function showFields() {
                            var eventType = document.getElementById("event-type").value;
                            var birthdayFields = document.getElementById("birthday-fields");
                            var corporateFields = document.getElementById("corporate-fields");
                            var weddingFields = document.getElementById("wedding-fields");

                            if (eventType === "birthday") {
                                birthdayFields.style.display = "block";
                                corporateFields.style.display = "none";
                                weddingFields.style.display = "none";
                            } else if (eventType === "corporate") {
                                birthdayFields.style.display = "none";
                                corporateFields.style.display = "block";
                                weddingFields.style.display = "none";
                            } else if (eventType === "wedding") {
                                birthdayFields.style.display = "none";
                                corporateFields.style.display = "none";
                                weddingFields.style.display = "block";
                            } else {
                                birthdayFields.style.display = "none";
                                corporateFields.style.display = "none";
                                weddingFields.style.display = "none";
                            }
                        }


                    </script>

</body>

</html>