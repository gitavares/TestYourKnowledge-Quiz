<?php include "../view/header-admin.php"; ?>
<?php include "../model/connection.php"; ?>
<?php include "../model/users.php"; ?>
<?php include "../model/tests.php"; ?>
<?php include "../model/questions.php"; ?>
<?php include "../model/categories.php"; ?>

<?php

getSession();
if(!$_SESSION['admin']) {
    redirectUserDashboard();
}

$message = "";
if(isset($_POST['submit'])){
    $message = addCategory();
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Add a Category</h2>
            </div>
            <div>
                <?php echo $message; ?>
                <form action="admin-add-category.php" method="post">
                    <div class="form-group">
                        <label for="name"><span class="label-text">Category Name:</span>
                            <input type="text" name="name" class="form-input" placeholder="Test Name" title="Must have 2 letters or more" minlength=2 autofocus required
                            value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-button-small" value="Save Category">
                    </div>
                </form>
            </div>
            
        </main>
    </div>
</body>
</html>
