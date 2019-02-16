<?php include "view/header.php"; ?>

<?php

User::getSession();

$message = "";
if(isset($_POST['submit'])){
    $message = User::updateUser();
} else {
    $user = User::getUserData();
}

?>

<body>
    <div class="container">
        <?php include "view/menu-user.php"; ?>
        <main class="main">
            <?php include "view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Edit Profile</h2>
            </div>
            <div>
                <p>Email: <?php echo $_SESSION['email']; ?></p><br>

                <?php echo $message; ?>
                <form action="user-edit.php" method="post">
                    <div class="form-group">
                        <label for="firstName"><span class="label-text">First Name: </span>
                            <input type="text" name="firstName" class="form-input" placeholder="First Name" pattern="[A-Za-z ]{2,}" title="Must have 2 letters or more" minlength=2 autofocus required
                            value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName(); ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="lastName"><span class="label-text">Last Name: </span>
                            <input type="text" name="lastName" class="form-input" placeholder="Last Name" pattern="[A-Za-z ]{2,}" title="Must have 2 letters or more" minlength=2 required
                            value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName(); ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="phone"><span class="label-text">Phone: </span>
                            <input type="tel" name="phone" class="form-input" placeholder="Phone Number" pattern="[0-9]{10}" title="Must have 10 numbers" required
                            value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : $user->getPhone(); ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="address"><span class="label-text">Address: </span>
                            <input type="text" name="address" class="form-input" placeholder="Address" pattern="[\w',-\\/.\s]{4,}" title="" minlength=4 required
                            value="<?php echo isset($_POST["address"]) ? $_POST["address"] : $user->getAddress(); ?>">
                        </label>
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
