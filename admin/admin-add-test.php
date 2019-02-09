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
    $message = addTest();
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Add a Test</h2>
            </div>
            <div>
                <?php echo $message; ?>
                <form action="admin-add-test.php" method="post">
                    <div class="form-group">
                        <label for="name"><span class="label-text">Test Name:</span>
                            <input type="text" name="name" class="form-input" placeholder="Test Name" title="Must have 2 letters or more" minlength=2 autofocus required
                            value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="description"><span class="label-text">Description:</span>
                            <input type="text" name="description" class="form-input" placeholder="Description" title="Must have 2 letters or more" minlength=2 required
                            value="<?php echo isset($_POST["description"]) ? $_POST["description"] : ""; ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="idCategory"><span class="label-text">Category:</span>
                            <select name="idCategory" id="idCategory" class="form-input">
                            <?php 
                            $categories = getAllCategories();
                            foreach ($categories as $category) {
                            ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo isset($_POST['idCategory']) && $_POST['idCategory'] == $category['id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="numQuestions"><span class="label-text">Number of Questions to Answer:</span>
                            <input type="number" name="numQuestions" class="form-input" placeholder="" pattern="[0-9]{2,}" title="Must have at least 10" min="10" required
                            value="<?php echo isset($_POST["numQuestions"]) ? $_POST["numQuestions"] : "10"; ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-button-small" value="Save Test">
                    </div>
                </form>
            </div>
            
        </main>
    </div>
</body>
</html>
