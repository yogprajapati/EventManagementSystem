<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Yog Prajapati</title>
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <link rel="stylesheet" href="login-register.css">
    <style>
        .register-success
        {
            font-size: 21px;
        }
    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phoneno = document.getElementById("phoneno").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("comfirmpassword").value;

            if (name.trim() == "") {
                alert("Name must be filled out");
                return false;
            }
            if (email.trim() == "") {
                alert("Email must be filled out");
                return false;
            }
            if (phoneno.trim() == "") {
                alert("Phone no must be filled out");
                return false;
            }
            if (password.trim() == "") {
                alert("Password must be filled out");
                return false;
            }
            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            return true;
        }
    </script>
    <section class="container">
        <div class="image-section">
            <div class="image-wrapper">
                <img src="./mesh-gradient.png" alt="">
            </div>

            <div class="content-container">
                <h1 class="section-heading">Welcome to the new <span>Journey.</span></h1>
                <p class="section-paragraph">Every step forward is a step towards knowledge. Embrance the journeys</p>
            </div>
        </div>

        <div class="form-section">
            <div class="form-wrapper">
                <div class="logo-container">
                    <a href="#" class="logo-container">
                        <img src="./logo.png" alt="logo">
                    </a>
                </div>

                <h2>Welcome</h2>
                <p>Create your account.</p>
                <?php if (isset ($errorMessage)): ?>
                    <div class="error-message">
                        <?php echo $errorMessage; ?>
                    </div>

                <?php endif; ?>
                <?php
                $remarks = isset($_GET['remarks']) ? $_GET['remarks'] : '';
                if ($remarks == 'success') {

                    echo '
                    <script>
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Registration successfully!",
                        text: "Mail has been sent to your corresponding email address",
                        showConfirmButton: true,
                        footer:\'<a href="login.php">Login to access various features / Events</a>\'
                        
                      });
                      </script>
                    ';

                    // echo '<script>setTimeout(function () {window.location.href = "createaccount.php";}, 3000);</script>';
                }
                ?>

                <p class="register-success" id="success" style="color:green;  font-size: 17px;"></p>
                <form method="post" id="signup-form" action="createacc.php" onsubmit="return validateForm()">
                    <div class="input-container">
                        <div class="form-group">
                            <label for="name">Name <span class="red">*</span></label>
                            <input type="text" required="required" name="name" id="name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="red">*</span></label>
                            <input type="email" name="email" id="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Phone no<span class="red">*</span></label>
                            <!-- <p>Must contain at least 8 numbers 🔽</p> -->
                            <input type="tel" name="phoneno" id="phoneno" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="red">*</span></label>
                            <input type="password" name=password" id="password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="comfirmpassword">Comfirm Password <span class="red">*</span></label>
                            <input name="password" type="comfirmpassword" id="comfirmpassword">
                        </div>
                    </div>

                    <button class="login-btn" type="submit">Sign in</button>
                </form>
                <div class="or-divider">or</div>
                <button class="login-btn" onclick="nextpage()" type="submit">Log in</button>
                <script>
                    function nextpage() {
                        window.location.href = "login.php";
                    }
                </script>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>