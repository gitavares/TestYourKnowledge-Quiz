<?php

class Test {

    private $id;
    private $idCategory;
    private $category;
    private $name;
    private $description;
    private $numQuestions;
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

    public function getIdCategory(){
        return $this->idCategory;
    }

    public function setIdCategory($idCategory){
        $this->idCategory = $idCategory;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getNumQuestions(){
        return $this->numQuestions;
    }

    public function setNumQuestions($numQuestions){
        $this->numQuestions = $numQuestions;
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



    public static function addTest() {
        global $database;
    
        if(isset($_POST['submit']) && $_SESSION['admin']){
    
            $name = $_POST['name'];
            $description = $_POST['description'];
            $numQuestions = $_POST['numQuestions'];
            $idCategory = $_POST['idCategory'];
            $status = 1;
    
            $name = $database->escape_string($name);
            $description = $database->escape_string($description);
            $numQuestions = $database->escape_string($numQuestions);
            $idCategory = $database->escape_string($idCategory);
    
            if(!self::getTestByName($name)){
                if($stmt = $database->prepare("INSERT INTO tb_tests(idCategory, name, description, numQuestions, status) VALUES (?,?,?,?,?)")){
                    $stmt->bind_param("issii", $idCategory, $name, $description, $numQuestions, $status);
                    $stmt->execute();
                
                    if(!$stmt){
                        die('Query failed: '. mysqli_error($database));
                    } else {
                        $_SESSION['testId'] = $database->the_insert_id();
                        $stmt->close();
                        header("Location: admin-edit-test.php");
                    }
                    $stmt->close();
                }
            } else {
                return "<div class='form-message-box-fail'>A test with this name already exist. Please, choose another name.</div>";
            }
        }
    
    }
    
    public static function getTestByName($name){
        global $database;
    
        $name = $database->escape_string($name);
    
        if($stmt = $database->prepare("SELECT name FROM tb_tests WHERE name = ?")){
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();
        
            if($stmt->num_rows){
                $stmt->close();
                return true;
            }
            $stmt->close();
        }
        return false;
    }
    
    public static function getTestData() {
        global $database;
    
        $testId = $_SESSION['testId'];
    
        $testId = $database->escape_string($testId);

        $testObject = new self;
    
        if($stmt = $database->prepare("SELECT t.id as idTest, t.idCategory, t.name as testName, t.description, t.numQuestions, t.status, c.name as category FROM tb_tests t, tb_categories c WHERE t.id = ? AND c.id = t.idCategory")){
            $stmt->bind_param("i", $testId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($idTest, $idCategory, $testName, $description, $numQuestions, $status, $category);
        
            if($stmt->num_rows) {
                $stmt->fetch();

                $testObject->setId($idTest);
                $testObject->setIdCategory($idCategory);
                $testObject->setName($testName);
                $testObject->setDescription($description);
                $testObject->setNumQuestions($numQuestions);
                $testObject->setStatus($status);
                $testObject->setCategory($category);
            }
            
            $stmt->close();
        }
        return $testObject;
        
    }
    
    public static function updateTest() {
        global $database;
    
        if(isset($_POST['submit']) && $_SESSION['admin']){
    
            $name = $_POST['name'];
            $description = $_POST['description'];        
            $numQuestions = $_POST['numQuestions'];
            $idCategory = $_POST['idCategory'];
            $status = $_POST['status'];
            $testId = $_SESSION['testId'];
    
            $name = $database->escape_string($name);
            $description = $database->escape_string($description);
            $numQuestions = $database->escape_string($numQuestions);
            $idCategory = $database->escape_string($idCategory);
            $status = $database->escape_string($status);
            $testId = $database->escape_string($testId);
    
            if($stmt = $database->prepare("UPDATE tb_tests SET idCategory = ?, name = ?, description = ?, numQuestions = ?, status = ?, modifiedDate = NOW() WHERE id = ?")){
                $stmt->bind_param("issiii", $idCategory, $name, $description, $numQuestions, $status, $testId);
                $stmt->execute();
            
                if(!$stmt){
                    die('Query failed: '. mysqli_error($database));
                    $stmt->close();
                    return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
                }
                
                $stmt->close();
            }
            return "<div class='form-message-box-success'>Test updated successfully!</div>";
        }
    
    }
    
    public static function getAllTests(){
        global $database;
    
        $query = "SELECT t.id, t.name, t.numQuestions, t.description, t.status, t.idCategory, c.name as category FROM tb_tests t, tb_categories c WHERE t.idCategory = c.id ORDER BY t.name";
        $result = $database->query($query);
    
        $tests = [];
    
        if($result->num_rows) {
            while($row = $result->fetch_assoc()){
                $testObject = new self;
                
                $status = ($row['status'] ? "Active" : "Inactive");

                $testObject->setId($row['id']);
                $testObject->setCategory($row['category']);
                $testObject->setName($row['name']);
                $testObject->setDescription($row['description']);
                $testObject->setNumQuestions($row['numQuestions']);
                $testObject->setStatus($status);

                $tests[] = $testObject;
            }
        }
    
        return $tests;
    
    }
    
    public static function getAllTestsToMakeATest($category){
        global $database;

        $tests = [];
    
        if($stmt = $database->prepare("SELECT t.id, t.idCategory, t.name, t.description, t.numQuestions, t.status, c.name as category FROM tb_tests t, tb_categories c WHERE c.id = t.idCategory AND t.status = 1 AND t.idCategory = ? AND t.id IN (SELECT idTest FROM tb_questions GROUP BY idTest HAVING count(*) >= 10)")){
            $stmt->bind_param("i", $category);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $idCategory, $name, $description, $numQuestions, $status, $category);
        
            if($stmt->num_rows) {
                while($stmt->fetch()){
                    $testObject = new self;

                    $testObject->setId($id);
                    $testObject->setCategory($category);
                    $testObject->setName($name);
                    $testObject->setDescription($description);
                    $testObject->setNumQuestions($numQuestions);
                    $testObject->setStatus($status);

                    $tests[] = $testObject;
                }
            }
        
            $stmt->close();
        }
        return $tests;
    }
    
    public static function addUserOnlineByTestId($session, $idTest, $time){
        global $database;
    
        if($stmt = $database->prepare("INSERT INTO tb_users_online (idTest, session, time) VALUES (?,?,?)")){
            $stmt->bind_param("isi", $idTest, $session, $time);
            $stmt->execute();
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
            }
            $stmt->close();
        }
    }
    
    public static function updateUserOnlineByTestId($session, $idTest, $time){
        global $database;
    
        if($stmt = $database->prepare("UPDATE tb_users_online SET time = ? WHERE session = ? AND idTest = ?")){
            $stmt->bind_param("isi", $time, $session, $idTest);
            $stmt->execute();
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($database));
            }
            $stmt->close();
        }
    }
    
    public static function getAllUsersOnlineByTestId($session, $idTest){
        global $database;

        $userOnlineByTest = [];
    
        if($stmt = $database->prepare("SELECT count(*) as numUsers, idTest FROM tb_users_online WHERE session = ? AND idTest = ? GROUP BY idTest")){
            $stmt->bind_param("si", $session, $idTest);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($numUsers, $idTest);
        
            if($stmt->num_rows) {
                $stmt->fetch();
                $userOnlineByTest = [
                    'numUsers'=>$numUsers, 
                    'idTest'=>$idTest
                ];
            }
            
            $stmt->close();
        }
        return $userOnlineByTest;
    }
    
    public static function getAllUsersOnlineByTestIdValid($idTest, $time_out){
        
        global $database;

        $userOnlineByTest = [];
    
        if($stmt = $database->prepare("SELECT count(*) as numUsers, idTest FROM tb_users_online WHERE idTest = ? AND time > ? GROUP BY idTest")){
            $stmt->bind_param("ii", $idTest, $time_out);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($numUsers, $idTest);
        
            if($stmt->num_rows) {
                $stmt->fetch();
                $userOnlineByTest = [
                    'numUsers'=>$numUsers, 
                    'idTest'=>$idTest
                ];
            }
            
            $stmt->close();
        }
        return $userOnlineByTest;
    
    }
}



?>