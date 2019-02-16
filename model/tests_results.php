<?php

class TestResult {

    private $id;
    private $idUser;
    private $idTest;
    private $finished;
    private $score;
    private $passed;
    private $numQuestionsAnswered;
    private $createdDate;
    private $modifiedDate;
    private $finishedDate;
    private $testName;
    private $category;
    private $userName;

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

    public function getFinished(){
        return $this->finished;
    }

    public function setFinished($finished){
        $this->finished = $finished;
    }

    public function getScore(){
        return $this->score;
    }

    public function setScore($score){
        $this->score = $score;
    }

    public function getPassed(){
        return $this->passed;
    }

    public function setPassed($passed){
        $this->passed = $passed;
    }

    public function getNumQuestionsAnswered(){
        return $this->numQuestionsAnswered;
    }

    public function setNumQuestionsAnswered($numQuestionsAnswered){
        $this->numQuestionsAnswered = $numQuestionsAnswered;
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

    public function getFinishedDate(){
        return $this->finishedDate;
    }

    public function setFinishedDate($finishedDate){
        $this->finishedDate = $finishedDate;
    }

    public function getTestName(){
        return $this->testName;
    }

    public function setTestName($testName){
        $this->testName = $testName;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
    }


    public static function addTestResult() {
        global $database;
    
        $idUser = $_SESSION['userId'];
        $idTest = $_SESSION['testId'];
    
        $idUser = $database->escape_string($idUser);
        $idTest = $database->escape_string($idTest);
    
        if($stmt = $database->prepare("INSERT INTO tb_tests_results(idUser, idTest) VALUES (?,?)")){
            $stmt->bind_param("ii", $idUser, $idTest);
            $stmt->execute();
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
            } else {
                $_SESSION['testResultId'] = $database->the_insert_id();
            }
            $stmt->close();
        }
    }
    
    public static function updateTestResult($idTestAnswer){
        global $database;
    
        $maxScore = 10.0;
    
        $test = Test::getTestData();

        if((int)$test->getNumQuestions() == 0){
            header("Location: take-a-test.php");
        }

        $question = Question::getQuestionData();
        $testResult = TestResult::getTestResult();
        $testAnswer = TestAnswer::getTestAnswerById($idTestAnswer);
    
        $testResultScore = floatval($testResult->getScore());
        $scorePoint = $maxScore / (int)$test->getNumQuestions();
    
        $finished = $_SESSION['countQuestion'] == ($test->getNumQuestions()) ? 1 : 0;
        $score = $testAnswer->getOptionChosen() == $testAnswer->getCorrectOption() ? $testResultScore + $scorePoint : $testResultScore;
        $passed = $score >= 8 ? 1 : 0;
        $numQuestionsAnswered = $_SESSION['countQuestion'];
        $idTestResult = $_SESSION['testResultId'];
    
        if($stmt = $database->prepare("UPDATE tb_tests_results SET finished = ?, score = ?, passed = ?, numQuestionsAnswered = ?, modifiedDate = NOW(), finishedDate = NOW() WHERE id = ?")){
            $stmt->bind_param("iiiii", $finished, $score, $passed, $numQuestionsAnswered, $idTestResult);
            $stmt->execute();
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
                $stmt->close();
            }
            
            $stmt->close();
        }
        
    }
    
    public static function getTestResult(){
        global $database;
    
        $idTestResult = $_SESSION['testResultId'];

        $testResultObject = new self;
    
        if($stmt = $database->prepare("SELECT id, idUser, idTest, finished, score, passed, numQuestionsAnswered FROM tb_tests_results WHERE id = ?")){
            $stmt->bind_param("i", $idTestResult);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idUser, $idTest, $finished, $score, $passed, $numQuestionsAnswered);
        
            if($stmt->num_rows) {
                $stmt->fetch();

                $testResultObject->setId($id);
                $testResultObject->setIdUser($idUser);
                $testResultObject->setIdTest($idTest);
                $testResultObject->setFinished($finished);
                $testResultObject->setScore($score);
                $testResultObject->setPassed($passed);
                $testResultObject->setNumQuestionsAnswered($numQuestionsAnswered);
            }
            
            $stmt->close();
        }

        return $testResultObject;
    }
    
    public static function getFinishedTestResultByTestId($testId){
        global $database;

        $testResultStat = [];
    
        if($stmt = $database->prepare("SELECT t.id as idTest, t.name as testName, AVG(r.score) as avgScore, (select count(distinct(idUser)) FROM tb_tests_results WHERE passed = 1 AND idTest = ?) as usersPassed, (select count(DISTINCT(idUser)) FROM tb_tests_results WHERE passed = 0 AND idtest = ?) as usersHaventPassed, (select count(idTest) from tb_tests_results where idTest = ?) as totalTests, (select count(idTest) from tb_tests_results where passed = 1 AND idTest = ?) as totalSuccessTests, (select count(idTest) from tb_tests_results where passed = 0 AND idTest = ?) as totalFailedTests FROM tb_tests t, tb_tests_results r WHERE r.idTest = ? AND r.idTest = t.id AND r.finished = 1 GROUP BY r.idTest")){
            $stmt->bind_param("iiiiii", $testId, $testId, $testId, $testId, $testId, $testId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($idTest, $testName, $avgScore, $usersPassed, $usersHaventPassed, $totalTests, $totalSuccessTests, $totalFailedTests);
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
            } else {
                if($stmt->num_rows) {
                    $stmt->fetch();

                    $testResultStat = [
                        'idTest'=>$idTest, 
                        'testName'=>$testName, 
                        'avgScore'=>$avgScore, 
                        'usersPassed'=>$usersPassed, 
                        'usersHaventPassed'=>$usersHaventPassed, 
                        'totalTests'=>$totalTests, 
                        'totalSuccessTests'=>$totalSuccessTests,
                        'totalFailedTests'=>$totalFailedTests
                    ];
                }
            }
        
            $stmt->close();
            return $testResultStat;
        }
    
    }
    
    public static function getFinishedTestsResults(){
        global $database;
    
        $query = "SELECT t.id AS idTest, t.name AS testName, AVG(r.score) AS avgScore, ";
        $query .= "(select count(distinct(idUser)) FROM tb_tests_results WHERE passed = 1 AND idTest = t.id) AS usersPassed, ";
        $query .= "(select count(DISTINCT(idUser)) FROM tb_tests_results WHERE passed = 0 AND idtest = t.id) AS usersHaventPassed, ";
        $query .= "(select count(idTest) FROM tb_tests_results WHERE idTest = t.id) AS totalTests, ";
        $query .= "(select count(idTest) FROM tb_tests_results WHERE passed = 1 AND idTest = t.id) AS totalSuccessTests, ";
        $query .= "(select count(idTest) FROM tb_tests_results WHERE passed = 0 AND idTest = t.id) AS totalFailedTests ";
        $query .= "FROM tb_tests t LEFT JOIN tb_tests_results r ON t.id = r.idTest AND r.finished = 1 ";
        $query .= "WHERE t.status = 1 ";
        $query .= "GROUP BY t.id ";
        $query .= "ORDER BY totalTests DESC LIMIT 5";
    
        $result = $database->query($query);
    
        $testsResultsStats = [];
    
        if($result->num_rows) {
            while($row = $result->fetch_assoc()){
                $testResults = [];
    
                $testResults = [
                    'idTest'=>$row['idTest'], 
                    'testName'=>$row['testName'], 
                    'avgScore'=>$row['avgScore'], 
                    'usersPassed'=>$row['usersPassed'], 
                    'usersHaventPassed'=>$row['usersHaventPassed'], 
                    'totalTests'=>$row['totalTests'], 
                    'totalSuccessTests'=>$row['totalSuccessTests'],
                    'totalFailedTests'=>$row['totalFailedTests']
                ];
    
                array_push($testsResultsStats, $testResults);
            }
        }
    
        return $testsResultsStats;
    
    }
    
    public static function getAllTestsResultsByUserId(){
        global $database;
    
        $idUser = $_SESSION['userId'];

        $testsResults = [];
    
        if($stmt = $database->prepare("SELECT r.id, r.idUser, r.idTest, r.finished, r.score, r.passed, r.numQuestionsAnswered, r.createdDate, t.name as testName, c.name as category FROM tb_tests_results r, tb_tests t, tb_categories c WHERE idUser = ? AND r.idTest = t.id AND t.idCategory = c.id AND finished = 1 ORDER BY r.createdDate DESC")){
            $stmt->bind_param("i", $idUser);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idUser, $idTest, $finished, $score, $passed, $numQuestionsAnswered, $createdDate, $testName, $category);
        
            if($stmt->num_rows) {
                while($stmt->fetch()){
                    $testResultObject = new self;

                    $testResultObject->setId($id);
                    $testResultObject->setIdUser($idUser);
                    $testResultObject->setIdTest($idTest);
                    $testResultObject->setFinished($finished);
                    $testResultObject->setScore($score);
                    $testResultObject->setPassed($passed);
                    $testResultObject->setNumQuestionsAnswered($numQuestionsAnswered);
                    $testResultObject->setCreatedDate($createdDate);
                    $testResultObject->setTestName($testName);
                    $testResultObject->setCategory($category);

                    $testsResults[] = $testResultObject;
                }
            }
        
            $stmt->close();
            return $testsResults;
        }
    
    }
    
    public static function getAllUsersTestResults($iduser = null, $date = null, $orderby = null){
        global $database;
    
        $idUser = $iduser;
        $finishedDate = $date;
        $orderby = $orderby;
    
        $idUser = $database->escape_string($idUser);
        $finishedDate = $database->escape_string($finishedDate);
        $orderby = $database->escape_string($orderby);
    
        $query = "SELECT r.id as idTestResult, r.idUser as idUser, r.idTest as idTest, r.finished, r.score, r.passed, r.numQuestionsAnswered, r.finishedDate, t.name as testName, c.name as category, CONCAT(u.firstname, ' ', u.lastName) as userName FROM tb_tests_results r, tb_tests t, tb_categories c, tb_users u WHERE r.idTest = t.id AND t.idCategory = c.id AND r.idUser = u.id AND r.finished = 1 ";
    
        if(!empty($idUser)){
            $query .= " AND r.idUser = $idUser ";
        }
    
        if(!empty($finishedDate)){
            $finishedDateMin = date($finishedDate . " 00:00:00");
            $finishedDateMax = date($finishedDate . " 23:59:59");
    
            $query .= " AND r.finishedDate >= '$finishedDateMin' AND r.finishedDate <= '$finishedDateMax' ";
        }
    
        if(!empty($orderby)){
            
            switch ($orderby) {
                case 'highScore':
                    $query .= " ORDER BY r.score DESC";
                    break;
                
                case 'lowScore':
                    $query .= " ORDER BY r.score ASC";
                    break;
                
                case 'recentDate':
                    $query .= " ORDER BY r.finishedDate DESC";
                    break;
                
                case 'olderdate':
                    $query .= " ORDER BY r.finishedDate ASC";
                    break;
                
                case 'userNameAsc':
                    $query .= " ORDER BY username ASC";
                    break;
                
                case 'userNameDesc':
                    $query .= " ORDER BY username DESC";
                    break;
                
                case 'testNameAsc':
                    $query .= " ORDER BY testName ASC";
                    break;
                
                case 'testNameDesc':
                    $query .= " ORDER BY testName DESC";
                    break;
                
                case 'categoryNameAsc':
                    $query .= " ORDER BY category ASC";
                    break;
                
                case 'categoryNameDesc':
                    $query .= " ORDER BY category DESC";
                    break;
            }
        } else {
            $query .= " ORDER BY r.finishedDate DESC";
        }
    
        $result = $database->query($query);
    
        $usersTestsResults = [];
    
        if($result->num_rows) {
            while($row = $result->fetch_assoc()){

                $testResultObject = new self;

                $testResultObject->setId($row['idTestResult']);
                $testResultObject->setIdUser($row['idUser']);
                $testResultObject->setIdTest($row['idTest']);
                $testResultObject->setFinished($row['finished']);
                $testResultObject->setScore($row['score']);
                $testResultObject->setPassed($row['passed']);
                $testResultObject->setNumQuestionsAnswered($row['numQuestionsAnswered']);
                $testResultObject->setFinishedDate($row['finishedDate']);
                $testResultObject->setTestName($row['testName']);
                $testResultObject->setCategory($row['category']);
                $testResultObject->setUserName($row['userName']);

                $usersTestsResults[] = $testResultObject;
            }
        }
    
        return $usersTestsResults;
    }

}

?>