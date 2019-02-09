<?php

function addQuestion() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $question = $_POST['question'];
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $option4 = $_POST['option4'];
        $correctOption = $_POST['correctOption'];

        $question = mysqli_real_escape_string($connection, $question);
        $option1 = mysqli_real_escape_string($connection, $option1);
        $option2 = mysqli_real_escape_string($connection, $option2);
        $option3 = mysqli_real_escape_string($connection, $option3);
        $option4 = mysqli_real_escape_string($connection, $option4);
        $correctOption = mysqli_real_escape_string($connection, $correctOption);
        $idTest = $_SESSION['testId'];

        // save question
        $stmt = mysqli_prepare($connection, "INSERT INTO tb_questions(idTest, question, option1, option2, option3, option4, correctOption) VALUES (?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "issssss", $idTest, $question, $option1, $option2, $option3, $option4, $correctOption);
        mysqli_stmt_execute($stmt);
    
        if(!$stmt){
            $message = "<div class='form-message-box-fail'>Question not added.". die('Query failed: '. mysqli_error($connection)) ."</div>";
            mysqli_stmt_close($stmt);
            return $message;
        } else {
            $message = "<div class='form-message-box-success'>Question added successfully</div>";
            mysqli_stmt_close($stmt);
            header("Location: admin-edit-test.php?testId={$idTest}&message={$message}");
        }
        
    }

}

function getAllQuestionsByTestId(){
    global $connection;

    $testId = $_SESSION['testId'];

    $testId = mysqli_real_escape_string($connection, $testId);

    $stmt = mysqli_prepare($connection, "SELECT id, idTest, question, option1, option2, option3, option4, correctOption FROM tb_questions WHERE idTest = ?");
    mysqli_stmt_bind_param($stmt, "i", $testId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idTest, $question, $option1, $option2, $option3, $option4, $correctOption);

    $testQuestions = [];

    if(mysqli_stmt_num_rows($stmt)) {
        while(mysqli_stmt_fetch($stmt)){
            $testQuestion = [];

            $testQuestion = [
                'id'=>$id, 
                'idTest'=>$idTest, 
                'question'=>$question, 
                'option1'=>$option1, 
                'option2'=>$option2, 
                'option3'=>$option3, 
                'option4'=>$option4, 
                'correctOption'=>$correctOption
            ];

            array_push($testQuestions, $testQuestion);
        }
        mysqli_stmt_close($stmt);
        return $testQuestions;
    }
    mysqli_stmt_close($stmt);
    return null;

}

function getQuestionsByTestIdRandomly(){
    global $connection;

    $testId = $_SESSION['testId'];

    $testId = mysqli_real_escape_string($connection, $testId);

    $test = getTestData();
    $numQuestions = $test['numQuestions'];

    $stmt = mysqli_prepare($connection, "SELECT id, idTest, question, option1, option2, option3, option4, correctOption FROM tb_questions WHERE idTest = ?");
    mysqli_stmt_bind_param($stmt, "i", $testId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idTest, $question, $option1, $option2, $option3, $option4, $correctOption);

    $testQuestions = [];

    if(mysqli_stmt_num_rows($stmt)) {
        while(mysqli_stmt_fetch($stmt)){
            $testQuestion = [];

            $testQuestion = [
                'id'=>$id, 
                'idTest'=>$idTest, 
                'question'=>$question, 
                'option1'=>$option1, 
                'option2'=>$option2, 
                'option3'=>$option3, 
                'option4'=>$option4, 
                'correctOption'=>$correctOption
            ];

            array_push($testQuestions, $testQuestion);
        }
    }
    
    mysqli_stmt_close($stmt);

    shuffle($testQuestions);
    array_slice($testQuestions, 0, $numQuestions);

    return $testQuestions;

}

function updateQuestion(){

    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $question = $_POST['question'];
        $option1 = $_POST['option1'];        
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $option4 = $_POST['option4'];
        $correctOption = $_POST['correctOption'];
        $questionId = $_SESSION['questionId'];

        $question = mysqli_real_escape_string($connection, $question);
        $option1 = mysqli_real_escape_string($connection, $option1);
        $option2 = mysqli_real_escape_string($connection, $option2);
        $option3 = mysqli_real_escape_string($connection, $option3);
        $option4 = mysqli_real_escape_string($connection, $option4);
        $correctOption = mysqli_real_escape_string($connection, $correctOption);
        $questionId = mysqli_real_escape_string($connection, $questionId);

        $stmt = mysqli_prepare($connection, "UPDATE tb_questions SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correctOption = ?, modifiedDate = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssssssi", $question, $option1, $option2, $option3, $option4, $correctOption, $questionId);
        mysqli_stmt_execute($stmt);
    
        if(!$stmt){
            die('Query failed: '. mysqli_error($connection));
            mysqli_stmt_close($stmt);
            return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
        }
        
        mysqli_stmt_close($stmt);
        return "<div class='form-message-box-success'>Question updated successfully!</div>";
    }

}

function getQuestionData(){
    global $connection;

    $questionId = $_SESSION['questionId'];

    $questionId = mysqli_real_escape_string($connection, $questionId);

    $stmt = mysqli_prepare($connection, "SELECT id, question, option1, option2, option3, option4, correctOption FROM tb_questions WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $questionId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $question, $option1, $option2, $option3, $option4, $correctOption);

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $question = [
            'id'=>$id, 
            'question'=>$question, 
            'option1'=>$option1, 
            'option2'=>$option2, 
            'option3'=>$option3, 
            'option4'=>$option4, 
            'correctOption'=>$correctOption
        ];
        mysqli_stmt_close($stmt);
        return $question;
    }
    
    mysqli_stmt_close($stmt);
    return null;
}


?>