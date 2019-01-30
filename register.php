<?php include "includes/header.php"; ?>
<?php include "includes/connection.php"; ?>
<?php include "functions/users.php"; ?>

<?php

$message = createUser();

?>
<body>
    <div class="container-login">
        <header class="header-login">
            <h1><span class="brand-title-main"><a class="brand-title-main-link" href="index.php" title="Back to Home Page">Test<br>Your<br>Knowledge</a></span></h1>
        </header>
        <main class="main-login">
            <div class="box-form">
                <div class="title-box-form">
                    <h3><span class="title-form">Register</span></h3>
                </div>
                <div>
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <input type="text" name="firstName" class="form-input" placeholder="First Name" pattern="[A-Za-z ]{2,}" title="Must have 2 letters or more" minlength=2 autofocus required
                            value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : ""; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastName" class="form-input" placeholder="Last Name" pattern="[A-Za-z ]{2,}" title="Must have 2 letters or more" minlength=2 required
                            value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : ""; ?>">
                        </div>
                        <div class="form-message-box-error">
                            <span class="error-message"><?php echo $message; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-input" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must have a valid email" required
                            value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Password" title="Must have 6 characters or more" minlength=6 required>
                        </div>
                        <div class="form-message-box-error">
                            <span class="error-message" id="error-message"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="Confirm Password" title="Must have 6 characters or more" minlength=6 required
                            onkeyup="confirmPasswordCheck();">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-input" placeholder="Phone Number" pattern="[0-9]{10}" title="Must have 10 numbers" required
                            value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ""; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-input" placeholder="Address" pattern="[\w',-\\/.\s]{4,}" title="" minlength=4 required
                            value="<?php echo isset($_POST["address"]) ? $_POST["address"] : ""; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="form-button" value="Register">
                        </div>
                    </form>
                </div>
                <div class="link-back-box-form">
                    <h3><a class="link-form" href="index.php">&larr; Back to Login</a></h3>
                </div>
            </div>
        </main>
    </div>
</body>
</html>