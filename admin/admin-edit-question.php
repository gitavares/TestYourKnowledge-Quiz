<?php include "../view/header-admin.php"; ?>
<?php include "../model/connection.php"; ?>
<?php include "../model/users.php"; ?>
<?php include "../model/tests.php"; ?>
<?php include "../model/questions.php"; ?>

<?php

getSession();
if(!$_SESSION['admin']) {
    redirectUserDashboard();
}

if(isset($_GET['questionId'])){
    $_SESSION['questionId'] = $_GET['questionId'];
}

$test = getTestData();

$message = "";
if(isset($_GET['message'])){
    $message = $_GET['message'];
}

if(isset($_POST['submit'])){
    $message = updateQuestion();
    $question = getQuestionData();
} else {
    $question = getQuestionData();
    if(!$question) {
        header("Location: admin-edit-test.php?testId={$_SESSION['testId']}");
    }
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Edit Question</h2>
            </div>
            <div class="page-title-box">
                <h3>Test: <?php echo $test['name']; ?></h3>
                <h3><a class="link-form" href="admin-edit-test.php?testId=<?php echo $_SESSION['testId']; ?>">&larr; Back</a></h3>
            </div>
            <div>
                <?php echo $message; ?>
                <form action="admin-edit-question.php" method="post">
                    <div class="form-group">
                        <label for="question"><span class="label-text">Question:</span>
                            <textarea name="question" id="question" rows="10" class="form-input" placeholder="Question" title="Must have 20 characters or more" minlength=20 autofocus required><?php echo isset($_POST["question"]) ? $_POST["question"] : $question['question']; ?></textarea>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option1"><span class="label-text">Option 1:</span>
                            <textarea name="option1" id="option1" rows="4" class="form-input" placeholder="Option 1" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option1"]) ? $_POST["option1"] : $question['option1']; ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option1" 
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option1' ? 'checked' : ($question['correctOption'] && $question['correctOption'] == 'option1' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option2"><span class="label-text">Option 2:</span>
                            <textarea name="option2" id="option2" rows="4" class="form-input" placeholder="Option 2" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option2"]) ? $_POST["option2"] : $question['option2']; ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option2" 
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option2' ? 'checked' : ($question['correctOption'] && $question['correctOption'] == 'option2' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option3"><span class="label-text">Option 3:</span>
                            <textarea name="option3" id="option3" rows="4" class="form-input" placeholder="Option 3" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option3"]) ? $_POST["option3"] : $question['option3']; ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option3"
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option3' ? 'checked' : ($question['correctOption'] && $question['correctOption'] == 'option3' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option4"><span class="label-text">Option 4:</span>
                            <textarea name="option4" id="option4" rows="4" class="form-input" placeholder="Option 4" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option4"]) ? $_POST["option4"] : $question['option4']; ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option4"
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option4' ? 'checked' : ($question['correctOption'] && $question['correctOption'] == 'option4' ? 'checked' : ''); ?>> Correct Answer</label>
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
