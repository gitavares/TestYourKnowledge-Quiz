<?php include "../view/header-admin.php"; ?>

<?php

if(isset($_GET['testId'])){
    $_SESSION['testId'] = $_GET['testId'];
}

$message = "";
if(isset($_GET['message'])){
    $message = $_GET['message'];
}

if(isset($_POST['submit'])){
    $message = Test::updateTest();
    $test = Test::getTestData();
} else {
    $test = Test::getTestData();
    if(!$test) {
        header("Location: admin-tests-list.php");
    }
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Test: <?php echo $test->getName();?></h2>
                <h3><a class="link-form" href="admin-tests-list.php">&larr; Back</a></h3>
            </div>
            <div>
                <?php echo $message; ?>
                <form action="admin-edit-test.php" method="post">
                    <div class="form-group">
                        <label for="name"><span class="label-text">Test Name: </span>
                            <input type="text" name="name" class="form-input" placeholder="Test Name" title="Must have 2 letters or more" minlength=2 autofocus required
                            value="<?php echo isset($_POST["name"]) ? $_POST["name"] : $test->getName(); ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="description"><span class="label-text">Description:</span>
                            <input type="text" name="description" class="form-input" placeholder="Description" title="Must have 2 letters or more" minlength=2 required
                            value="<?php echo isset($_POST["description"]) ? $_POST["description"] : $test->getDescription(); ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="idCategory"><span class="label-text">Category:</span>
                            <select name="idCategory" id="idCategory" class="form-input">
                            <?php 
                            $categories = Category::getAllCategories();
                            foreach ($categories as $category) {
                            ?>
                                <option value="<?php echo $category->getId(); ?>" <?php echo (isset($_POST['idCategory']) && $_POST['idCategory'] == $category->getId()) || $test->getIdCategory() == $category->getId() ? 'selected' : ''; ?>><?php echo $category->getName(); ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="numQuestions"><span class="label-text">Number of Questions to Answer:</span>
                            <input type="number" name="numQuestions" class="form-input" placeholder="" pattern="[0-9]{2,}" title="Must have at least 10" min="10" required
                            value="<?php echo isset($_POST["numQuestions"]) ? $_POST["numQuestions"] : $test->getNumQuestions(); ?>">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="status"><span class="label-text">Status:</span>
                            <select name="status" id="status" class="form-input">
                                <option value="1" <?php echo (isset($_POST['status']) && $_POST['status'] == 1) || $test->getStatus() == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?php echo (isset($_POST['status']) && $_POST['status'] == 0) || $test->getStatus() == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-button-small" value="Save Changes">
                    </div>
                </form>
            </div>

            <br>
            <div class="questions-container">
                <p><strong>All Questions</strong></p>
            </div>
            <br>
            <div class="m-b-10">
                <p><a href="admin-add-question.php" class="link-button">Add New Question</a></p>
            </div>
            <div class="questions-container">

                <?php if(!empty(Question::getAllQuestionsByTestId())) {?>
                    <table class="table-questions">
                        <thead>
                            <tr>
                                <th class="td-questions">#</th>
                                <th class="td-questions">Question</th>
                                <th class="td-questions">Status</th>
                                <th class="td-questions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php showAllQuestions(Question::getAllQuestionsByTestId()); ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "No questions added yet.";
                } ?>

            </div>
        </main>
    </div>
</body>
</html>
