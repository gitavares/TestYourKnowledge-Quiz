<?php include "../view/header-admin.php"; ?>

<?php

$message = "";
if(isset($_POST['submit'])){
    $message = Category::addCategory();
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Add a Category</h2>
                <h3><a class="link-form" href="admin-categories-list.php">&larr; Back</a></h3>
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
