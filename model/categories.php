<?php

function addCategory() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $name = $_POST['name'];

        $name = mysqli_real_escape_string($connection, $name);

        if(!getCategoryByName($name)){
            $stmt = mysqli_prepare($connection, "INSERT INTO tb_categories(name) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
        
            if(!$stmt){
                die('Query failed: '. mysqli_error($connection));
            } else {
                $_SESSION['categoryId'] = mysqli_insert_id($connection);
                mysqli_stmt_close($stmt);
                header("Location: admin-edit-category.php");
            }
            mysqli_stmt_close($stmt);
        } else {
            return "<div class='form-message-box-fail'>A Category with this name already exist. Please, choose another name.</div>";
        }
    }

}

function getCategoryByName($name){
    global $connection;

    $name = mysqli_real_escape_string($connection, $name);

    $stmt = mysqli_prepare($connection, "SELECT name FROM tb_categories WHERE name = ?");
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

function getCategoryData() {
    global $connection;

    $categoryId = $_SESSION['categoryId'];

    $categoryId = mysqli_real_escape_string($connection, $categoryId);

    $stmt = mysqli_prepare($connection, "SELECT id, name FROM tb_categories WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $categoryId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name);

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $category = [
            'id'=>$id, 
            'name'=>$name
        ];
        mysqli_stmt_close($stmt);
        return $category;
    }
    
    mysqli_stmt_close($stmt);
    return null;
    
}

function updateCategory() {
    global $connection;

    if(isset($_POST['submit']) && $_SESSION['admin']){

        $name = $_POST['name'];
        $categoryId = $_SESSION['categoryId'];

        $name = mysqli_real_escape_string($connection, $name);
        $categoryId = mysqli_real_escape_string($connection, $categoryId);

        $stmt = mysqli_prepare($connection, "UPDATE tb_categories SET name = ?, modifiedDate = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $name, $categoryId);
        mysqli_stmt_execute($stmt);
    
        if(!$stmt){
            die('Query failed: '. mysqli_error($connection));
            mysqli_stmt_close($stmt);
            return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
        }
        
        mysqli_stmt_close($stmt);
        return "<div class='form-message-box-success'>Category updated successfully!</div>";
    }

}

function getAllCategories(){ // change it and the others with the same approach. separate the 
    global $connection;

    $query = "SELECT * FROM tb_categories";

    $result = mysqli_query($connection, $query);
    
    $categories = [];

    if(mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)){

            $category = [];

            $category = [
                'id'=>$row['id'], 
                'name'=>$row['name']
            ];

            array_push($categories, $category);
        } 
    }

    return $categories;

}

?>