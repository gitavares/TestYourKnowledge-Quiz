<?php include "../view/header-admin.php"; ?>

<?php

if(isset($_GET['questionId'])){
    $_SESSION['questionId'] = $_GET['questionId'];
}

$test = Test::getTestData();

$message = "";
if(isset($_GET['message'])){
    $message = $_GET['message'];
}

if(isset($_POST['submit'])){
    $question = Question::getQuestionData();
    $message = Question::updateQuestion();
} else {
    $question = Question::getQuestionData();
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
                <h3>Test: <?php echo $test->getName(); ?></h3>
                <h3><a class="link-form" href="admin-edit-test.php?testId=<?php echo $_SESSION['testId']; ?>">&larr; Back</a></h3>
            </div>
            <div>
                <?php echo $message; ?>
                <form action="admin-edit-question.php" method="post">
                    <div class="form-group">
                        <label for="question"><span class="label-text">Question:</span>
                            <textarea name="question" id="question" rows="10" class="form-input" placeholder="Question" title="Must have 20 characters or more" minlength=20 autofocus required><?php echo isset($_POST["question"]) ? $_POST["question"] : $question->getQuestion(); ?></textarea>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option1"><span class="label-text">Option 1:</span>
                            <textarea name="option1" id="option1" rows="4" class="form-input" placeholder="Option 1" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option1"]) ? $_POST["option1"] : $question->getOption1(); ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option1" 
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option1' ? 'checked' : ($question->getCorrectOption() && $question->getCorrectOption() == 'option1' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option2"><span class="label-text">Option 2:</span>
                            <textarea name="option2" id="option2" rows="4" class="form-input" placeholder="Option 2" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option2"]) ? $_POST["option2"] : $question->getOption2(); ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option2" 
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option2' ? 'checked' : ($question->getCorrectOption() && $question->getCorrectOption() == 'option2' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option3"><span class="label-text">Option 3:</span>
                            <textarea name="option3" id="option3" rows="4" class="form-input" placeholder="Option 3" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option3"]) ? $_POST["option3"] : $question->getOption3(); ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option3"
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option3' ? 'checked' : ($question->getCorrectOption() && $question->getCorrectOption() == 'option3' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="option4"><span class="label-text">Option 4:</span>
                            <textarea name="option4" id="option4" rows="4" class="form-input" placeholder="Option 4" title="Must have 1 character or more" minlength=1 required><?php echo isset($_POST["option4"]) ? $_POST["option4"] : $question->getOption4(); ?></textarea>
                            <label for="correctOption"><input type="radio" name="correctOption" value="option4"
                            <?php echo isset($_POST['correctOption']) && $_POST['correctOption'] == 'option4' ? 'checked' : ($question->getCorrectOption() && $question->getCorrectOption() == 'option4' ? 'checked' : ''); ?>> Correct Answer</label>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="status"><span class="label-text">Status:</span>
                            <select name="status" id="status" class="form-input">
                                <option value="1" <?php echo (isset($_POST['status']) && $_POST['status'] == 1) || $question->getStatus() == 'Active' ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?php echo (isset($_POST['status']) && $_POST['status'] == 0) || $question->getStatus() == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-button-small" value="Save Changes">
                    </div>
                </form>
            </div>
            
        </main>
    </div>
    <?php include "../view/question-editor.php"; ?>
</body>
</html>
