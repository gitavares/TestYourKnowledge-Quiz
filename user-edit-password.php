<?php include "includes/header.php"; ?>
<?php include "includes/connection.php"; ?>
<?php include "functions/users.php"; ?>

<?php

    getSession();

    $message = "";
    if(isset($_POST['submit'])){
        $message = changePassword();
    }

?>

<body>
    <div class="container">
        <?php include "includes/menu-user.php"; ?>
        <main class="main">
            <?php include "includes/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Change Password</h2>
            </div>
            <div>
                <p>Email: <?php echo $_SESSION['email']; ?></p><br>

                <div class="form-message-box">
                    <span class="message"><?php echo $message; ?></span>
                </div>
                <form action="user-edit-password.php" method="post">
                    <div class="form-group">
                        <input type="password" id="currentPassword" name="currentPassword" class="form-input" placeholder="Current Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-input" placeholder="New Password" title="Must have 6 characters or more" minlength=6 required>
                    </div>
                    <div class="form-message-box-error">
                        <span class="error-message" id="error-message"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="Confirm New Password" title="Must have 6 characters or more" minlength=6 required
                        onkeyup="confirmPasswordCheck();">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-button-small" value="Save Changes">
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
