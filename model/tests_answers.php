<?php
$questionsTest = [];

function getQuestion($questionsTest) {
    global $connection;

    if($_SESSION['countQuestion'] <= (int)$_SESSION['testNumQuestions']){
        $question = $questionsTest[$_SESSION['countQuestion']];
        $_SESSION['questionId'] = $question['id'];
    
        return $question;
    } else {
        $_SESSION['countQuestion'] = 0;
        
        return getTestResult();
    }
}

function getQuestionsTest(){
    $questionsTest = getQuestionsByTestIdRandomly();
    
    $_SESSION['questionsTest'] = $questionsTest;
}

function addTestAnswer($question) {
    global $connection;

    $idUser = $_SESSION['userId'];
    $idTest = $_SESSION['testId'];
    $idTestResult = $_SESSION['testResultId'];
    $idQuestion = $question['id'];
    $correctOption = $question['correctOption'];

    $idUser = mysqli_real_escape_string($connection, $idUser);
    $idTest = mysqli_real_escape_string($connection, $idTest);
    $idTestResult = mysqli_real_escape_string($connection, $idTestResult);

    $stmt = mysqli_prepare($connection, "INSERT INTO tb_tests_answers(idUser, idTest, idTestResult, idQuestion, correctOption) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "iiiis", $idUser, $idTest, $idTestResult, $idQuestion, $correctOption);
    mysqli_stmt_execute($stmt);
    // if(!mysqli_stmt_execute($stmt)){
    //     trigger_error("there was an error....".$connection->error, E_USER_WARNING);
    // }

    if(!$stmt){
        die('Query failed: '. mysqli_error($connection));
    } else {
        $_SESSION['testAnswerId'] = mysqli_insert_id($connection);
    }
    mysqli_stmt_close($stmt);
}

function updateTestAnswer(){
    global $connection;

    $optionChosen = $_POST['optionChosen'];
    $idTestAnswer = $_SESSION['testAnswerId'];

    $optionChosen = mysqli_real_escape_string($connection, $optionChosen);

    $stmt = mysqli_prepare($connection, "UPDATE tb_tests_answers SET optionChosen = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $optionChosen, $idTestAnswer);
    mysqli_stmt_execute($stmt);

    if(!$stmt){
        die('Query failed: '. mysqli_error($connection));
        mysqli_stmt_close($stmt);
    }
    
    mysqli_stmt_close($stmt);
    updateTestResult($idTestAnswer);
}

function getTestAnswerById($testAnswerId) {
    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT id, idUser, idTest, idTestResult, idQuestion, optionChosen, correctOption FROM tb_tests_answers WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $testAnswerId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idUser, $idTest, $idTestResult, $idQuestion, $optionChosen, $correctOption);

    $testAnswer = [];

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $testAnswer = [
            'id'=>$id, 
            'idUser'=>$idUser, 
            'idTest'=>$idTest, 
            'idTestResult'=>$idTestResult, 
            'idQuestion'=>$idQuestion, 
            'optionChosen'=>$optionChosen,
            'correctOption'=>$correctOption
        ];
        
    }
    
    mysqli_stmt_close($stmt);
    return $testAnswer;
}


?>