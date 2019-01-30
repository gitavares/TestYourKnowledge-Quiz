<?php

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

function getUserData() {
    global $connection;

    $email = $_SESSION['email'];

    $query = "SELECT * FROM tb_users ";
    $query .= "WHERE email = '$email'";

    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)) {
        $user = mysqli_fetch_assoc($result);

        return $user;
    } else {
        logout();
    }
}

function editUser() {
    global $connection;

    if(isset($_POST['submit'])){

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];        
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_SESSION['email'];

        $firstName = mysqli_real_escape_string($connection, $firstName);
        $lastName = mysqli_real_escape_string($connection, $lastName);
        $phone = mysqli_real_escape_string($connection, $phone);
        $address = mysqli_real_escape_string($connection, $address);

        $query = "UPDATE tb_users SET firstName = '$firstName', lastName = '$lastName', phone = '$phone', address = '$address' ";
        $query .= "WHERE email = '$email'";
    
        $result = mysqli_query($connection, $query);
    
        if(!$result){
            die('Query failed: '. mysqli_error());
            return "Something got wrong. Please, try again.";
        } else {
            return "Profile updated successfully!";
        }
        
    }

}

function changePassword() {
    global $connection;

    if(isset($_POST['submit'])){
        $currentPassword = $_POST['currentPassword'];
        $password = $_POST['password'];
        $email = $_SESSION['email'];

        $currentPassword = mysqli_real_escape_string($connection, $currentPassword);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM tb_users ";
        $query .= "WHERE email = '$email'";

        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);

        // decrypt password --> http://php.net/manual/en/function.password-verify.php
        if($user){
            if(password_verify($currentPassword, $user['password'])){
                $password = password_hash($password, PASSWORD_BCRYPT); 

                $query = "UPDATE tb_users SET password = '$password' ";
                $query .= "WHERE email = '$email'";
            
                $result = mysqli_query($connection, $query);
            
                if(!$result){
                    die('Query failed: '. mysqli_error());
                    return "Something got wrong. Please, try again.";
                } else {
                    return "Password changed successfully!";
                }

            } else {
                return "Current Password incorrect";
            }
        }
    }
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
                $_SESSION['admin'] = $user['admin'];
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

function logout(){
    session_destroy();
    redirectLogin();
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

function redirectAdminDashboard(){
    header("Location: admin/admin-dashboard.php");
    exit;
}

?>