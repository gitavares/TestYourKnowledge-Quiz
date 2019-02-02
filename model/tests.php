<?php

function createTest() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $numQuestions = $_POST['numQuestions'];
        $status = 1;

        $name = mysqli_real_escape_string($connection, $name);
        $description = mysqli_real_escape_string($connection, $description);
        $numQuestions = mysqli_real_escape_string($connection, $numQuestions);

        if(!getTestByName($name)){
            $stmt = mysqli_prepare($connection, "INSERT INTO tb_tests(name, description, numQuestions, status) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "ssii", $name, $description, $numQuestions, $status);
            mysqli_stmt_execute($stmt);
        
            if(!$stmt){
                die('Query failed: '. mysqli_error());
            } else {
                $_SESSION['testId'] = mysqli_insert_id($connection);
                header("Location: admin-edit-test.php");
            }
        } else {
            return "A test with this name already exist. Please, choose another name.";
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
        return true;
    }

    return false;
}

function getTestData() {
    global $connection;

    $testId = $_SESSION['testId'];

    $testId = mysqli_real_escape_string($connection, $testId);

    $stmt = mysqli_prepare($connection, "SELECT id, name, description, numQuestions, status FROM tb_tests WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $testId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $description, $numQuestions, $status);

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $test = [
            'id'=>$id, 
            'name'=>$name, 
            'description'=>$description, 
            'numQuestions'=>$numQuestions, 
            'status'=>$status
        ];
        return $test;
    } else {
        return null;
    }
}

function editTest() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $name = $_POST['name'];
        $description = $_POST['description'];        
        $numQuestions = $_POST['numQuestions'];
        $testId = $_SESSION['testId'];

        $name = mysqli_real_escape_string($connection, $name);
        $description = mysqli_real_escape_string($connection, $description);
        $numQuestions = mysqli_real_escape_string($connection, $numQuestions);
        $testId = mysqli_real_escape_string($connection, $testId);

        $stmt = mysqli_prepare($connection, "UPDATE tb_tests SET name = ?, description = ?, numQuestions = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssii", $name, $description, $numQuestions, $testId);
        mysqli_stmt_execute($stmt);
    
        if(!$stmt){
            die('Query failed: '. mysqli_error());
            return "Something got wrong. Please, try again.";
        } else {
            return "Test updated successfully!";
        }
        
    }

}

function getAllTests(){
    global $connection;

    $query = "SELECT * FROM tb_tests";

    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){
            $status = ($row['status'] ? "Active" : "Inactive");

            echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['numQuestions']} (of 20)</td>";
                echo "<td>{$status}</td>";
                echo "<td><a href='admin-edit-test.php?testId={$row['id']}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";
        }
    } else {
        return "Nothing to show. <a href='admin-add-test.php'>Add a Test</a>";
    }
}

?>