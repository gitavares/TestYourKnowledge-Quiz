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
            $stmt = mysqli_prepare($connection, "INSERT INTO tb_users(firstName, lastName, email, password, phone, address, status, admin) VALUES (?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "ssssssii", $firstName, $lastName, $email, $password, $phone, $address, $status, $admin);
            mysqli_stmt_execute($stmt);
        
            if(!$stmt){
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

    $email = mysqli_real_escape_string($connection, $email);

    $stmt = mysqli_prepare($connection, "SELECT email FROM tb_users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt)){
        return true;
    }

    return false;
}

function getUserData() {
    global $connection;

    $email = $_SESSION['email'];

    $email = mysqli_real_escape_string($connection, $email);

    $stmt = mysqli_prepare($connection, "SELECT id, firstName, lastName, email, password, phone, address, status, admin FROM tb_users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName, $email, $password, $phone, $address, $status, $admin);

    if(mysqli_stmt_num_rows($stmt)) {
        mysqli_stmt_fetch($stmt);
        $user = [
            'id'=>$id, 
            'firstName'=>$firstName, 
            'lastName'=>$lastName, 
            'email'=>$email, 
            'password'=>$password,
            'phone'=>$phone,
            'address'=>$address,
            'status'=>$status,
            'admin'=>$admin
        ];
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
        $email = mysqli_real_escape_string($connection, $email);

        $stmt = mysqli_prepare($connection, "UPDATE tb_users SET firstName = ?, lastName = ?, phone = ?, address = ? WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $phone, $address, $email);
        mysqli_stmt_execute($stmt);
    
        if(!$stmt){
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
        $newPassword = $_POST['password'];
        $email = $_SESSION['email'];

        $currentPassword = mysqli_real_escape_string($connection, $currentPassword);
        $newPassword = mysqli_real_escape_string($connection, $newPassword);
        $email = mysqli_real_escape_string($connection, $email);

        $stmt = mysqli_prepare($connection, "SELECT password FROM tb_users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $password);

        // decrypt password --> http://php.net/manual/en/function.password-verify.php
        if(mysqli_stmt_num_rows($stmt)){
            mysqli_stmt_fetch($stmt);

            if(password_verify($currentPassword, $password)){
                $newPassword = password_hash($newPassword, PASSWORD_BCRYPT); 

                $stmt = mysqli_prepare($connection, "UPDATE tb_users SET password = ? WHERE email = ?");
                mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
                mysqli_stmt_execute($stmt);
            
                if(!$stmt){
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
        $informed_password = $_POST['password']; // criptografia aqui

        $email = mysqli_real_escape_string($connection, $email);
        $informed_password = mysqli_real_escape_string($connection, $informed_password);

        $stmt = mysqli_prepare($connection, "SELECT id, firstName, lastName, email, password, phone, address, status, admin FROM tb_users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName, $email, $password, $phone, $address, $status, $admin);

        // decrypt password --> http://php.net/manual/en/function.password-verify.php
        if(mysqli_stmt_num_rows($stmt)){
            mysqli_stmt_fetch($stmt);

            if(password_verify($informed_password, $password)){
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['id'] = $id;
                $_SESSION['admin'] = $admin;
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
    header("Location: ".getUrlDirPath()."dashboard");
    exit;
}

function redirectLogin() {
    header("Location: ".getUrlDirPath());
    exit;
}

function redirectAdminDashboard(){
    header("Location: admin/admin-dashboard.php");
    exit;
}

function redirectUserDashboard(){
    header("Location: ".getUrlDirPath()."dashboard");
    exit;
}

// PATHS
function getUrlDirPath(){
    return "/Lambton/MAD3134-PHPAndMySQL/MAD3134-Final-Project/";
}


?>