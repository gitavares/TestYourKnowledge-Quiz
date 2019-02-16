<?php include "view/header.php"; ?>

<?php

User::getSession();

$_SESSION['countQuestion'] = 0;
$_SESSION['testNumQuestions'] = null;
$_SESSION['questionsTest'] = null;
$_SESSION['testId'] = null;
$_SESSION['testResultId'] = null;
$_SESSION['testAnswerId'] = null;

if(isset($_GET['testId'])){
    $_SESSION['testId'] = $_GET['testId'];
    TestResult::addTestResult();
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
                        $categories = Category::getAllCategories();
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category->getId(); ?>" <?php echo isset($_POST['idCategory']) && $_POST['idCategory'] == $category->getId() ? 'selected' : ''; ?>><?php echo $category->getName(); ?></option>
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
                    <?php showAllTestsUser(Test::getAllTestsToMakeATest($category)); ?>
                </tbody>
            </table>
            <?php 
                }
            ?>

        </main>
    </div>
</body>
</html>
