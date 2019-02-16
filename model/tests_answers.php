<?php

class TestAnswer {

    private $id;
    private $idUser;
    private $idTest;
    private $idTestResult;
    private $idQuestion;
    private $optionChosen;
    private $correctOption;
    private $createdDate;

    public function __construct() { }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIdUser(){
        return $this->idUser;
    }

    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    public function getIdTest(){
        return $this->idTest;
    }

    public function setIdTest($idTest){
        $this->idTest = $idTest;
    }

    public function getIdTestResult(){
        return $this->idTestResult;
    }

    public function setIdTestResult($idTestResult){
        $this->idTestResult = $idTestResult;
    }

    public function getIdQuestion(){
        return $this->idQuestion;
    }

    public function setIdQuestion($idQuestion){
        $this->idQuestion = $idQuestion;
    }

    public function getOptionChosen(){
        return $this->optionChosen;
    }

    public function setOptionChosen($optionChosen){
        $this->optionChosen = $optionChosen;
    }

    public function getCorrectOption(){
        return $this->correctOption;
    }

    public function setCorrectOption($correctOption){
        $this->correctOption = $correctOption;
    }

    public function getCreatedDate(){
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate){
        $this->createdDate = $createdDate;
    }

    public $questionsTest = [];

    public static function getQuestion($questionsTest) {
        if($_SESSION['countQuestion'] <= (int)$_SESSION['testNumQuestions']){
            $question = $questionsTest[$_SESSION['countQuestion']];
            $_SESSION['questionId'] = $question->getId();
        
            return $question;
        } else {
            $_SESSION['countQuestion'] = 0;
            
            return TestResult::getTestResult();
        }
    }

    public static function getQuestionsTest(){
        $questionsTest = Question::getQuestionsByTestIdRandomly();
        
        $_SESSION['questionsTest'] = $questionsTest;
    }

    public static function addTestAnswer($question) {
        global $database;

        $idUser = $_SESSION['userId'];
        $idTest = $_SESSION['testId'];
        $idTestResult = $_SESSION['testResultId'];
        $idQuestion = $question->getId();
        $correctOption = $question->getCorrectOption();

        $idUser = $database->escape_string($idUser);
        $idTest = $database->escape_string($idTest);
        $idTestResult = $database->escape_string($idTestResult);

        if($stmt = $database->prepare("INSERT INTO tb_tests_answers(idUser, idTest, idTestResult, idQuestion, correctOption) VALUES (?,?,?,?,?)")){
            $stmt->bind_param("iiiis", $idUser, $idTest, $idTestResult, $idQuestion, $correctOption);
            $stmt->execute();
            // if(!$stmt->execute()){
            //     trigger_error("there was an error....".$connection->error, E_USER_WARNING);
            // }

            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
            } else {
                $_SESSION['testAnswerId'] = $database->the_insert_id();
            }
            $stmt->close();
        }
    }

    public static function updateTestAnswer(){
        global $database;

        $optionChosen = $_POST['optionChosen'];
        $idTestAnswer = $_SESSION['testAnswerId'];

        $optionChosen = $database->escape_string($optionChosen);

        if($stmt = $database->prepare("UPDATE tb_tests_answers SET optionChosen = ? WHERE id = ?")){
            $stmt->bind_param("si", $optionChosen, $idTestAnswer);
            $stmt->execute();

            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
                $stmt->close();
            }
            
            $stmt->close();
            TestResult::updateTestResult($idTestAnswer);
        }
    }

    public static function getTestAnswerById($testAnswerId) {
        global $database;

        $testAnswerObject = new self;

        if($stmt = $database->prepare("SELECT id, idUser, idTest, idTestResult, idQuestion, optionChosen, correctOption FROM tb_tests_answers WHERE id = ?")){
            $stmt->bind_param("i", $testAnswerId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idUser, $idTest, $idTestResult, $idQuestion, $optionChosen, $correctOption);

            if($stmt->num_rows) {
                $stmt->fetch();

                $testAnswerObject->setId($id);
                $testAnswerObject->setIdUser($idUser);
                $testAnswerObject->setIdTest($idTest);
                $testAnswerObject->setIdTestResult($idTestResult);
                $testAnswerObject->setIdQuestion($idQuestion);
                $testAnswerObject->setOptionChosen($optionChosen);
                $testAnswerObject->setCorrectOption($correctOption);
            }
            
            $stmt->close();
        }
        return $testAnswerObject;
    }

}

?>