<?php include "view/header.php"; ?>
<?php include "model/connection.php"; ?>
<?php include "model/users.php"; ?>
<?php include "model/tests.php"; ?>
<?php include "view/tests.php"; ?>
<?php include "model/questions.php"; ?>
<?php include "model/categories.php"; ?>
<?php include "model/tests_results.php"; ?>
<?php include "model/tests_answers.php"; ?>

<?php

getSession();

if(isset($_GET['testId'])){
    $_SESSION['testId'] = $_GET['testId'];
    $_SESSION['countQuestion'] = 0;
    $_SESSION['testNumQuestions'] = null;
    $_SESSION['questionsTest'] = null;
    addTestResult();
    header("Location: take-a-test-start.php");
}

?>

<body>
    <div class="container">
        <?php include "view/menu-user.php"; ?>
        <main class="main">
            <?php include "view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Take a Test</h2>
            </div>
            <form action="take-a-test.php" method="POST">
                <div class="form-group">
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
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="form-button-small" value="Select this category">
                </div>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $category = $_POST['idCategory'];
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th># Questions</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php showAllTestsUser(getAllTestsToMakeATest($category)); ?>
                </tbody>
            </table>
            <?php 
                }
            ?>

        </main>
    </div>
</body>
</html>
