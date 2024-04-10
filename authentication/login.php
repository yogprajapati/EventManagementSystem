<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Yog Prajapati</title>
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <link rel="stylesheet" href="login-register.css">
    <style>
        #captcha{
            
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="image-section">
            <div class="image-wrapper">
                <img src="./mesh-gradient.png" alt="">
            </div>

            <div class="content-container">
                <h1 class="section-heading">Empowering Minds through digital <span>Education.</span></h1>
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

                <h2>Welcome Back! </h2>
                <p>Enter your credientals to access your account.</p>
                <?php if (isset ($errorMessage)): ?>
                    <div class="error-message">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="logincheck.php">
                    <div class="input-container">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="captcha">Please enter the following CAPTCHA:</label><br>
                            <input type="text" id="captcha" name="captcha" required><br><br>
                            <img src="captcha.php" alt="CAPTCHA"><br><br>
                        </div>
                    </div>

                    <button class="login-btn" type="submit">Log In</button>
                </form>
                <div class="or-divider">or</div>
                <button class="login-btn" onclick="nextpage()" type="submit">Create Account</button>
                <script>
                    function nextpage() {
                        window.location.href = "createaccount.php";
                    }
                </script>
            </div>
        </div>
    </section>
</body>

</html>