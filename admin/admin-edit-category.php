<?php include "../view/header-admin.php"; ?>
<?php include "../model/connection.php"; ?>
<?php include "../model/users.php"; ?>
<?php include "../model/tests.php"; ?>
<?php include "../model/questions.php"; ?>
<?php include "../model/categories.php"; ?>
<?php include "../view/questions.php"; ?>
<?php include "../view/categories.php"; ?>

<?php

getSession();
if(!$_SESSION['admin']) {
    redirectUserDashboard();
}

if(isset($_GET['categoryId'])){
    $_SESSION['categoryId'] = $_GET['categoryId'];
}

$message = "";
if(isset($_GET['message'])){
    $message = $_GET['message'];
}

if(isset($_POST['submit'])){
    $message = updateCategory();
    $category = getCategoryData();
} else {
    $category = getCategoryData();
    if(!$category) {
        header("Location: admin-categories-list.php");
    }
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Category: <?php echo $category['name']; ?></h2>
                <h3><a class="link-form" href="admin-categories-list.php">&larr; Back</a></h3>
            </div>
            <div>
                <?php echo $message; ?>
                <form action="admin-edit-category.php" method="post">
                    <div class="form-group">
                        <label for="name"><span class="label-text">Category Name: </span>
                            <input type="text" name="name" class="form-input" placeholder="Category Name" title="Must have 2 letters or more" minlength=2 autofocus required
                            value="<?php echo isset($_POST["name"]) ? $_POST["name"] : $category['name']; ?>">
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
