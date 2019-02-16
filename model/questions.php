<?php

class Question {

    private $id;
    private $idTest;
    private $question;
    private $option1;
    private $option2;
    private $option3;
    private $option4;
    private $correctOption;
    private $status;
    private $createdDate;
    private $modifiedDate;

    public function __construct() { }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIdTest(){
        return $this->idTest;
    }

    public function setIdTest($idTest){
        $this->idTest = $idTest;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function setQuestion($question){
        $this->question = $question;
    }

    public function getOption1(){
        return $this->option1;
    }

    public function setOption1($option1){
        $this->option1 = $option1;
    }

    public function getOption2(){
        return $this->option2;
    }

    public function setOption2($option2){
        $this->option2 = $option2;
    }

    public function getOption3(){
        return $this->option3;
    }

    public function setOption3($option3){
        $this->option3 = $option3;
    }

    public function getOption4(){
        return $this->option4;
    }

    public function setOption4($option4){
        $this->option4 = $option4;
    }
    
    public function getCorrectOption(){
        return $this->correctOption;
    }

    public function setCorrectOption($correctOption){
        $this->correctOption = $correctOption;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getCreatedDate(){
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate){
        $this->createdDate = $createdDate;
    }

    public function getModifiedDate(){
        return $this->modifiedDate;
    }

    public function setModifiedDate($modifiedDate){
        $this->modifiedDate = $modifiedDate;
    }


    public static function addQuestion() {
        global $database;
    
        if(isset($_POST['submit']) && $_SESSION['admin']){
    
            $invalid = "&lt;p&gt;&amp;nbsp;&lt;/p&gt;";
    
            $question = trim(htmlspecialchars($_POST['question']));
            $option1 = trim(htmlspecialchars($_POST['option1']));
            $option2 = trim(htmlspecialchars($_POST['option2']));
            $option3 = trim(htmlspecialchars($_POST['option3']));
            $option4 = trim(htmlspecialchars($_POST['option4']));
    
            if($question != $invalid && $option1 != $invalid && $option2 != $invalid && $option3 != $invalid && $option4 != $invalid){
                $correctOption = $_POST['correctOption'];
        
                $correctOption = $database->escape_string($correctOption);
                $idTest = $_SESSION['testId'];
        
                // save question
                if($stmt = $database->prepare("INSERT INTO tb_questions(idTest, question, option1, option2, option3, option4, correctOption) VALUES (?,?,?,?,?,?,?)")){
                    $stmt->bind_param("issssss", $idTest, $question, $option1, $option2, $option3, $option4, $correctOption);
                    $stmt->execute();
                
                    if(!$stmt){
                        $message = "<div class='form-message-box-fail'>Question not added.". die('Query failed: '. mysqli_error($database)) ."</div>";
                        $stmt->close();
                        return $message;
                    } else {
                        $message = "<div class='form-message-box-success'>Question added successfully</div>";
                        $stmt->close();
                        header("Location: admin-edit-test.php?testId={$idTest}&message={$message}");
                    }
                }
            } else {
                $message = "<div class='form-message-box-fail'>All fields must be filled.</div>";
                return $message;
            }
            
        }
    
    }
    
    public static function getAllQuestionsByTestId(){
        global $database;
    
        $testId = $_SESSION['testId'];
    
        $testId = $database->escape_string($testId);

        $testQuestions = [];
    
        if($stmt = $database->prepare("SELECT id, idTest, question, option1, option2, option3, option4, correctOption, status FROM tb_questions WHERE idTest = ?")){
            $stmt->bind_param("i", $testId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idTest, $question, $option1, $option2, $option3, $option4, $correctOption, $status);
        
            if($stmt->num_rows) {
                while($stmt->fetch()){
                    $questionObject = new self;

                    $status = ($status ? "Active" : "Inactive");

                    $questionObject->setId($id);
                    $questionObject->setIdTest($idTest);
                    $questionObject->setQuestion($question);
                    $questionObject->setOption1($option1);
                    $questionObject->setOption2($option2);
                    $questionObject->setOption3($option3);
                    $questionObject->setOption4($option4);
                    $questionObject->setCorrectOption($correctOption);
                    $questionObject->setStatus($status);

                    $testQuestions[] = $questionObject;
                }
            }
            $stmt->close();
        }
        return $testQuestions;
    }
    
    public static function getQuestionsByTestIdRandomly(){
        global $database;
    
        $testId = $_SESSION['testId'];
    
        $testId = $database->escape_string($testId);
    
        $test = Test::getTestData();
        $numQuestions = $test->getNumQuestions();

        $testQuestions = [];
    
        if($stmt = $database->prepare("SELECT id, idTest, question, option1, option2, option3, option4, correctOption FROM tb_questions WHERE idTest = ?")){
            $stmt->bind_param("i", $testId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idTest, $question, $option1, $option2, $option3, $option4, $correctOption);
        
            if($stmt->num_rows) {
                while($stmt->fetch()){
                    $questionObject = new self;

                    $questionObject->setId($id);
                    $questionObject->setIdTest($idTest);
                    $questionObject->setQuestion($question);
                    $questionObject->setOption1($option1);
                    $questionObject->setOption2($option2);
                    $questionObject->setOption3($option3);
                    $questionObject->setOption4($option4);
                    $questionObject->setCorrectOption($correctOption);

                    $testQuestions[] = $questionObject;
                }
            }
            
            $stmt->close();
            
            shuffle($testQuestions);
            array_slice($testQuestions, 0, $numQuestions);
        }
    
        return $testQuestions;
    }
    
    public static function updateQuestion(){
    
        global $database;
    
        if(isset($_POST['submit']) && $_SESSION['admin']){
    
            $question = htmlspecialchars($_POST['question']);
            $option1 = htmlspecialchars($_POST['option1']);        
            $option2 = htmlspecialchars($_POST['option2']);
            $option3 = htmlspecialchars($_POST['option3']);
            $option4 = htmlspecialchars($_POST['option4']);
            $correctOption = $_POST['correctOption'];
            $status = $_POST['status'];
            $questionId = $_SESSION['questionId'];
    
            $correctOption = $database->escape_string($correctOption);
            $status = $database->escape_string($status);
            $questionId = $database->escape_string($questionId);
    
            if($stmt = $database->prepare("UPDATE tb_questions SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correctOption = ?, status = ?, modifiedDate = NOW() WHERE id = ?")){
                $stmt->bind_param("ssssssii", $question, $option1, $option2, $option3, $option4, $correctOption, $status, $questionId);
                $stmt->execute();
            
                if(!$stmt){
                    die('Query failed: '. mysqli_error($database));
                    $stmt->close();
                    return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
                }
                
                $stmt->close();
            }
            return "<div class='form-message-box-success'>Question updated successfully!</div>";
        }
    
    }
    
    public static function getQuestionData(){
        global $database;
    
        $questionId = $_SESSION['questionId'];
    
        $questionId = $database->escape_string($questionId);

        $questionObject = new self;
    
        if($stmt = $database->prepare("SELECT id, idTest, question, option1, option2, option3, option4, correctOption, status FROM tb_questions WHERE id = ?")){
            $stmt->bind_param("i", $questionId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idTest, $question, $option1, $option2, $option3, $option4, $correctOption, $status);
        
            if($stmt->num_rows) {
                $stmt->fetch();
        
                $status = ($status ? "Active" : "Inactive");

                $questionObject->setId($id);
                $questionObject->setIdTest($idTest);
                $questionObject->setQuestion($question);
                $questionObject->setOption1($option1);
                $questionObject->setOption2($option2);
                $questionObject->setOption3($option3);
                $questionObject->setOption4($option4);
                $questionObject->setCorrectOption($correctOption);
                $questionObject->setStatus($status);
                
            }
            
            $stmt->close();
        }
        return $questionObject;
    }

}

?>