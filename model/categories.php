<?php

class Category {

    private $id;
    private $name;
    private $createdDate;
    private $modifiedDate;

    public function __construct() { }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
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


    public static function addCategory() {
        global $database;
    
        if(isset($_POST['submit']) && $_SESSION['admin']){
    
            $name = $_POST['name'];
    
            $name = $database->escape_string($name);
    
            if(!Category::getCategoryByName($name)){
                if($stmt = $database->prepare("INSERT INTO tb_categories(name) VALUES (?)")){
                    $stmt->bind_param("s", $name);
                    $stmt->execute();
                
                    if(!$stmt){
                        die('Query failed: '. mysqli_error($database));
                    } else {
                        $_SESSION['categoryId'] = $database->the_insert_id();
                        $stmt->close();
                        return "<div class='form-message-box-success'>Category created successfully!</div>";
                    }
                    $stmt->close();
                }
            } else {
                return "<div class='form-message-box-fail'>A Category with this name already exist. Please, choose another name.</div>";
            }
        }
    
    }
    
    public static function getCategoryByName($name){
        global $database;
    
        $name = $database->escape_string($name);
    
        if($stmt = $database->prepare("SELECT name FROM tb_categories WHERE name = ?")){
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
    
    public static function getCategoryData() {
        global $database;
    
        $categoryId = $_SESSION['categoryId'];
    
        $categoryId = $database->escape_string($categoryId);

        $categoryObject = new self;
    
        if($stmt = $database->prepare("SELECT id, name FROM tb_categories WHERE id = ?")){
            $stmt->bind_param("i", $categoryId);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name);
        
            if($stmt->num_rows) {
                $stmt->fetch();

                $categoryObject->setId($id);
                $categoryObject->setName($name);
            }
            
            $stmt->close();
        }
        return $categoryObject;
        
    }
    
    public static function updateCategory() {
        global $database;
    
        if(isset($_POST['submit']) && $_SESSION['admin']){
    
            $name = $_POST['name'];
            $categoryId = $_SESSION['categoryId'];
    
            $name = $database->escape_string($name);
            $categoryId = $database->escape_string($categoryId);
    
            if($stmt = $database->prepare("UPDATE tb_categories SET name = ?, modifiedDate = NOW() WHERE id = ?")){
                $stmt->bind_param("si", $name, $categoryId);
                $stmt->execute();
            
                if(!$stmt){
                    die('Query failed: '. mysqli_error($database));
                    $stmt->close();
                    return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
                }
                
                $stmt->close();
            }
            return "<div class='form-message-box-success'>Category updated successfully!</div>";
        }
    
    }
    
    public static function getAllCategories(){
        global $database;
    
        $query = "SELECT * FROM tb_categories";
    
        $result = $database->query($query);
        
        $categories = [];
    
        if($result->num_rows) {
            while($row = $result->fetch_assoc()){
                $categoryObject = new self;

                $categoryObject->setId($row['id']);
                $categoryObject->setName($row['name']);

                $categories[] = $categoryObject;
            } 
        }
        return $categories;
    }

}

?>