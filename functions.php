<?php

include "connection.php";

// QUERIES
function createUser() {
    global $connection;

    if(isset($_POST['submit'])){

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password']; // criptografia aqui
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $status = 1;
        $admin = 0;

        $firstName = mysqli_real_escape_string($connection, $firstName);
        $lastName = mysqli_real_escape_string($connection, $lastName);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $phone = mysqli_real_escape_string($connection, $phone);
        $address = mysqli_real_escape_string($connection, $address);

        // password encryptation --> http://php.net/manual/en/function.password-hash.php
        $password = password_hash($password, PASSWORD_BCRYPT); 

        if(!getUserByEmail($email)){
            $query = "INSERT INTO tb_users(firstName, lastName, email, password, phone, address, status, admin) ";
            $query .= "VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$address', '$status', '$admin')";
        
            $result = mysqli_query($connection, $query);
        
            if(!$result){
                die('Query failed: '. mysqli_error());
            } else {
                login();
            }
        } else {
            return "This email already exist";
        }
    }

}

function getUserByEmail($email){
    global $connection;

    $query = "SELECT email FROM tb_users ";
    $query .= "WHERE email = '$email'";

    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)){
        return true;
    }

    return false;
}

function login(){
    global $connection;

    if(isset($_POST['submit'])){

        $email = $_POST['email'];
        $password = $_POST['password']; // criptografia aqui

        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM tb_users ";
        $query .= "WHERE email = '$email'";

        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);

        // decrypt password --> http://php.net/manual/en/function.password-verify.php
        if($user){
            if(password_verify($password, $user['password'])){
                session_start();
                $_SESSION['email'] = $user['email'];
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['id'] = $user['id'];
                redirectDashboard();
            } else {
                return "Password incorrect";
            }
        }

        return "Email or Password incorrect";
    }

}

// SESSIONS
function getSession() {
    session_start();
    
    if($_SESSION['email'] === null){
        redirectLogin();
    }
}

function killSession(){
    session_destroy();
}

// REDIRECTS
function redirectDashboard(){
    header("Location: dashboard.php");
    exit;
}

function redirectLogin() {
    header("Location: index.php");
    exit;
}


?>