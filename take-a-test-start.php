<?php include "view/header.php"; ?>

<?php

User::getSession();

// users online doing an specific test
$session = session_id();
$time = time();

if(empty(Test::getAllUsersOnlineByTestId($session, $_SESSION['testId']))){
    Test::addUserOnlineByTestId($session, $_SESSION['testId'], $time);
} else {
    Test::updateUserOnlineByTestId($session, $_SESSION['testId'], $time);
}

$test = Test::getTestData();

$_SESSION['testNumQuestions'] = $test->getNumQuestions();

if(!isset($_SESSION['questionsTest']) && (int)$_SESSION['countQuestion'] == 0){
    TestAnswer::getQuestionsTest();
}

$question = TestAnswer::getQuestion($_SESSION['questionsTest']);

if(isset($_POST['submit']) && $_SESSION['countQuestion'] <= $_SESSION['testNumQuestions']){
    TestAnswer::updateTestAnswer();
}

if($_SESSION['countQuestion'] < $_SESSION['testNumQuestions']){
    TestAnswer::addTestAnswer($question);
}

?>

<body>
    <div class="container">
        <?php include "view/menu-user.php"; ?>
        <main class="main">
            <?php include "view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Test: <?php echo $test->getName();?></h2>
            </div>
            
            <?php
            
            if($_SESSION['countQuestion'] < $_SESSION['testNumQuestions']){

            ?>
            <div>
                <span><strong>Question <?php echo $_SESSION['countQuestion'] + 1;?> / <?php echo $test->getNumQuestions();?></strong></span>
            </div>
            <?php $_SESSION['countQuestion']++; ?>
            <div class="question-container">
                <div class="question">
                    <?php echo htmlspecialchars_decode(stripslashes($question->getQuestion()), ENT_QUOTES); ?>
                </div>
                <div>
                    <form action="take-a-test-start.php" method="POST">
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option1" checked> <?php echo htmlspecialchars_decode(stripslashes($question->getOption1()), ENT_QUOTES); ?></label>
                        </div>
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option2"> <?php echo htmlspecialchars_decode(stripslashes($question->getOption2()), ENT_QUOTES); ?></label>
                        </div>
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option3"> <?php echo htmlspecialchars_decode(stripslashes($question->getOption3()), ENT_QUOTES); ?></label>
                        </div>
                        <div class="form-group">
                            <label for="optionChosen"><input type="radio" name="optionChosen" value="option4"> <?php echo htmlspecialchars_decode(stripslashes($question->getOption4()), ENT_QUOTES); ?></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="form-button-small" value="Next Question">
                        </div>
                    </form>
                </div>
            </div>
            
            <?php

            } else {
                $testResult = TestResult::getTestResult();

            ?>
            
            <div class="result-container">
                <div class="score-box">
                    <span class="score-title">Score</span>
                    <span class="score"><?php echo $testResult->getScore(); ?></span>
                </div>
                <div class="score-text-result">
                    <?php if($testResult->getScore() >= 8) { ?>
                        <p>You have successfully passed the test. You are now certified in <strong><?php echo $test->getName(); ?></strong>. Where <strong><?php echo $test->getCategory(); ?></strong> is the certification topic you have chosen for this assignment.</p>
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
