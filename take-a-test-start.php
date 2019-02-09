<?php include "view/header.php"; ?>
<?php include "model/connection.php"; ?>
<?php include "model/users.php"; ?>
<?php include "model/tests.php"; ?>
<?php include "model/questions.php"; ?>
<?php include "model/tests_results.php"; ?>
<?php include "model/tests_answers.php"; ?>

<?php

getSession();

$test = getTestData();
$_SESSION['testNumQuestions'] = $test['numQuestions'];

if(!isset($_SESSION['questionsTest']) && (int)$_SESSION['countQuestion'] == 0){
    getQuestionsTest();
}

$question = getQuestion($_SESSION['questionsTest']);

if(isset($_POST['submit']) && $_SESSION['countQuestion'] < $_SESSION['testNumQuestions']){
    updateTestAnswer();
}

if($_SESSION['countQuestion'] < $_SESSION['testNumQuestions']){
    addTestAnswer($question);
}

?>

<body>
    <div class="container">
        <?php include "view/menu-user.php"; ?>
        <main class="main">
            <?php include "view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Test: <?php echo $test['name'];?></h2>
            </div>
            
            <?php
            
            if($_SESSION['countQuestion'] < $_SESSION['testNumQuestions']){

            ?>
            <div>
                <span><strong>Question <?php echo $_SESSION['countQuestion'] + 1;?> / <?php echo $test['numQuestions'];?></strong></span>
            </div>
            <?php $_SESSION['countQuestion']++; ?>
            <div class="question-container">
                <div class="question">
                    <?php echo $question['question']; ?>
                </div>
                <div>
                    <form action="take-a-test-start.php" method="POST">
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option1"> <?php echo $question['option1']; ?></label>
                        </div>
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option2"> <?php echo $question['option2']; ?></label>
                        </div>
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option3"> <?php echo $question['option3']; ?></label>
                        </div>
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option4"> <?php echo $question['option4']; ?></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="form-button-small" value="Next Question">
                        </div>
                    </form>
                </div>
            </div>
            
            <?php

            } else {

                $testResult = getTestResult();

            ?>
            
            <div class="result-container">
                <div class="score-box">
                    <span class="score-title">Score</span>
                    <span class="score"><?php echo $testResult['score']; ?></span>
                </div>
                <div class="score-text-result">
                    <?php if($testResult['score'] >= 8) { ?>
                        <p>You have successfully passed the test. You are now certified in <strong><?php echo $test['name']; ?></strong>.” Where <strong><?php echo $test['name']; ?></strong> is the certification topic you have chosen for this assignment.</p>
                    <?php } else { ?>
                        <p>Unfortunately you did not pass the test. Please try again later!</p>
                    <?php }?>
                </div>
            </div>

            <?php
            }
            ?>
            

        </main>
    </div>
</body>
</html>
