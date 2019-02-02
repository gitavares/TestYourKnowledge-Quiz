<?php include "view/header.php"; ?>
<?php include "model/connection.php"; ?>
<?php include "model/users.php"; ?>

<?php 

$message = login();

?>
<body>
    <div class="container-login">
        <header class="header-login">
            <h1><span class="brand-title-main"><a class="brand-title-main-link" href="index.php" title="Back to Home Page">Test<br>Your<br>Knowledge</a></span></h1>
        </header>
        <main class="main-login">
            <div class="box-form">
                <div class="title-box-form">
                    <h3><span class="title-form">Login</span></h3>
                </div>
                <div>
                    <form action="" method="post">
                        <div class="form-message-box-error">
                            <span class="error-message"><?php echo $message; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-input" placeholder="Your email" required autofocus
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must have a valid email"
                            value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-input" placeholder="Your password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="form-button">Login</button>
                        </div>
                    </form>
                </div>
                <div class="link-box-form">
                    <h3><a class="link-form" href="register.php">Register</a></h3>
                </div>
            </div>
        </main>
    </div>
</body>
</html>