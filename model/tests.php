<?php

function addTest() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $numQuestions = $_POST['numQuestions'];
        $idCategory = $_POST['idCategory'];
        $status = 1;

        $name = mysqli_real_escape_string($connection, $name);
        $description = mysqli_real_escape_string($connection, $description);
        $numQuestions = mysqli_real_escape_string($connection, $numQuestions);
        $idCategory = mysqli_real_escape_string($connection, $idCategory);

        if(!getTestByName($name)){
            $stmt = mysqli_prepare($connection, "INSERT INTO tb_tests(idCategory, name, description, numQuestions, status) VALUES (?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "issii", $idCategory, $name, $description, $numQuestions, $status);
            mysqli_stmt_execute($stmt);
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($connection));
            } else {
                $_SESSION['testId'] = mysqli_insert_id($connection);
                mysqli_stmt_close($stmt);
                header("Location: admin-edit-test.php");
            }
            mysqli_stmt_close($stmt);
        } else {
            return "<div class='form-message-box-fail'>A test with this name already exist. Please, choose another name.</div>";
        }
    }

}

function getTestByName($name){
    global $connection;

    $name = mysqli_real_escape_string($connection, $name);

    $stmt = mysqli_prepare($connection, "SELECT name FROM tb_tests WHERE name = ?");
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt)){
        mysqli_stmt_close($stmt);
        return true;
    }

    mysqli_stmt_close($stmt);
    return false;
}

function getTestData() {
    global $connection;

    $testId = $_SESSION['testId'];

    $testId = mysqli_real_escape_string($connection, $testId);

    $stmt = mysqli_prepare($connection, "SELECT id, idCategory, name, description, numQuestions, status FROM tb_tests WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $testId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idCategory, $name, $description, $numQuestions, $status);

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $test = [
            'id'=>$id, 
            'idCategory'=>$idCategory, 
            'name'=>$name, 
            'description'=>$description, 
            'numQuestions'=>$numQuestions, 
            'status'=>$status
        ];
        mysqli_stmt_close($stmt);
        return $test;
    }
    
    mysqli_stmt_close($stmt);
    return null;
    
}

function updateTest() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $name = $_POST['name'];
        $description = $_POST['description'];        
        $numQuestions = $_POST['numQuestions'];
        $idCategory = $_POST['idCategory'];
        $testId = $_SESSION['testId'];

        $name = mysqli_real_escape_string($connection, $name);
        $description = mysqli_real_escape_string($connection, $description);
        $numQuestions = mysqli_real_escape_string($connection, $numQuestions);
        $idCategory = mysqli_real_escape_string($connection, $idCategory);
        $testId = mysqli_real_escape_string($connection, $testId);

        $stmt = mysqli_prepare($connection, "UPDATE tb_tests SET idCategory = ?, name = ?, description = ?, numQuestions = ?, modifiedDate = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "issii", $idCategory, $name, $description, $numQuestions, $testId);
        mysqli_stmt_execute($stmt);
    
        if(!$stmt){
            die('Query failed: '. mysqli_error($connection));
            mysqli_stmt_close($stmt);
            return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
        }
        
        mysqli_stmt_close($stmt);
        return "<div class='form-message-box-success'>Test updated successfully!</div>";
    }

}

function getAllTests(){
    global $connection;

    $query = "SELECT t.id, t.name, t.numQuestions, t.description, t.status, t.idCategory, c.name as category FROM tb_tests t, tb_categories c WHERE t.idCategory = c.id";

    $result = mysqli_query($connection, $query);

    $tests = [];

    if(mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
            $test = [];

            $status = ($row['status'] ? "Active" : "Inactive");

            $test = [
                'id'=>$row['id'], 
                'category'=>$row['category'], 
                'name'=>$row['name'], 
                'description'=>$row['description'], 
                'numQuestions'=>$row['numQuestions'], 
                'status'=>$status
            ];

            array_push($tests, $test);
        }
    }

    return $tests;

}

function getAllTestsToMakeATest($category){
    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT t.id, t.idCategory, t.name, t.description, t.numQuestions, t.status, c.name as category FROM tb_tests t, tb_categories c WHERE c.id = t.idCategory AND t.status = 1 AND t.idCategory = ? AND t.id IN (SELECT idTest FROM tb_questions GROUP BY idTest HAVING count(*) >= 10)");
    mysqli_stmt_bind_param($stmt, "i", $category);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $idCategory, $name, $description, $numQuestions, $status, $category);

    $tests = [];

    if(mysqli_stmt_num_rows($stmt)) {
        while(mysqli_stmt_fetch($stmt)){
            $test = [];

            $test = [
                'id'=>$id, 
                'category'=>$category, 
                'name'=>$name, 
                'description'=>$description, 
                'numQuestions'=>$numQuestions, 
                'status'=>$status
            ];

            array_push($tests, $test);
        }
    }

    mysqli_stmt_close($stmt);
    return $tests;
}

?>