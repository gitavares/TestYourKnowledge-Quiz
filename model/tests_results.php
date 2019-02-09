<?php

function addTestResult() {
    global $connection;

    $idUser = $_SESSION['userId'];
    $idTest = $_SESSION['testId'];

    $idUser = mysqli_real_escape_string($connection, $idUser);
    $idTest = mysqli_real_escape_string($connection, $idTest);

    $stmt = mysqli_prepare($connection, "INSERT INTO tb_tests_results(idUser, idTest) VALUES (?,?)");
    mysqli_stmt_bind_param($stmt, "ii", $idUser, $idTest);
    mysqli_stmt_execute($stmt);

    if(!$stmt){
        die('Query failed: '. mysqli_error($connection));
    } else {
        $_SESSION['testResultId'] = mysqli_insert_id($connection);
    }
    mysqli_stmt_close($stmt);
}

function updateTestResult($idTestAnswer){
    global $connection;

    $maxScore = 10.0;

    $test = getTestData();
    $question = getQuestionData();
    $testResult = getTestResult();
    $testAnswer = getTestAnswerById($idTestAnswer);

    $testResultScore = floatval($testResult['score']);
    $scorePoint = $maxScore / (int)$test['numQuestions'];

    $finished = $_SESSION['countQuestion'] == $test['numQuestions'] ? 1 : 0;
    $score = $testAnswer['optionChosen'] == $testAnswer['correctOption'] ? $testResultScore + $scorePoint : $testResultScore;
    $passed = $score >= 8 ? 1 : 0;
    $numQuestionsAnswered = $_SESSION['countQuestion'];
    $idTestResult = $_SESSION['testResultId'];

    $stmt = mysqli_prepare($connection, "UPDATE tb_tests_results SET finished = ?, score = ?, passed = ?, numQuestionsAnswered = ?, modifiedDate = NOW(), finishedDate = NOW() WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "iiiii", $finished, $score, $passed, $numQuestionsAnswered, $idTestResult);
    mysqli_stmt_execute($stmt);

    if(!$stmt){
        die('Query failed: '. mysqli_error($connection));
        mysqli_stmt_close($stmt);
    }
    
    mysqli_stmt_close($stmt);
    
}

function getTestResult(){
    global $connection;

    $idTestResult = $_SESSION['testResultId'];

    $stmt = mysqli_prepare($connection, "SELECT id, idUser, idTest, finished, score, passed, numQuestionsAnswered FROM tb_tests_results WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $idTestResult);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idUser, $idTest, $finished, $score, $passed, $numQuestionsAnswered);

    $testResult = [];

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $testResult = [
            'id'=>$id, 
            'idUser'=>$idUser, 
            'idTest'=>$idTest, 
            'finished'=>$finished, 
            'score'=>$score, 
            'passed'=>$passed, 
            'numQuestionsAnswered'=>$numQuestionsAnswered
        ];
    }
    
    mysqli_stmt_close($stmt);
    return $testResult;
}

function getAllTestsResultsByUserId(){
    global $connection;

    $idUser = $_SESSION['userId'];

    $stmt = mysqli_prepare($connection, "SELECT r.id, r.idUser, r.idTest, r.finished, r.score, r.passed, r.numQuestionsAnswered, r.createdDate, t.name as testName, c.name as category FROM tb_tests_results r, tb_tests t, tb_categories c WHERE idUser = ? AND r.idTest = t.id AND t.idCategory = c.id AND finished = 1 ORDER BY r.createdDate DESC");
    mysqli_stmt_bind_param($stmt, "i", $idUser);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idUser, $idTest, $finished, $score, $passed, $numQuestionsAnswered, $createdDate, $testName, $category);

    $testsResults = [];

    if(mysqli_stmt_num_rows($stmt)) {
        while(mysqli_stmt_fetch($stmt)){
            $testResult = [];

            $testResult = [
                'id'=>$id, 
                'idUser'=>$idUser, 
                'idTest'=>$idTest, 
                'finished'=>$finished, 
                'score'=>$score, 
                'passed'=>$passed, 
                'numQuestionsAnswered'=>$numQuestionsAnswered,
                'createdDate'=>$createdDate,
                'testName'=>$testName,
                'category'=>$category
            ];

            array_push($testsResults, $testResult);
        }
    }

    mysqli_stmt_close($stmt);
    return $testsResults;

}


?>