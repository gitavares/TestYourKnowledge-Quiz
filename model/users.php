<?php

class User {
    
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $phone;
    private $address;
    private $status;
    private $admin;
    private $createdDate;
    private $modifiedDate;
    private $lastLogin;

    public function __construct() { }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getAdmin(){
        return $this->admin;
    }

    public function setAdmin($admin){
        $this->admin = $admin;
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

    public function getLastLogin(){
        return $this->lastLogin;
    }

    public function setLastLogin($lastLogin){
        $this->lastLogin = $lastLogin;
    }
    

    public static function addUser() {
        global $database;

        if(isset($_POST['submit'])){

            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password']; // criptografia aqui
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $status = 1;
            $admin = 0;

            $firstName = $database->escape_string($firstName);
            $lastName = $database->escape_string($lastName);
            $email = $database->escape_string($email);
            $password = $database->escape_string($password);
            $phone = $database->escape_string($phone);
            $address = $database->escape_string($address);

            // password encryptation --> http://php.net/manual/en/function.password-hash.php
            $password = password_hash($password, PASSWORD_BCRYPT); 

            if(!self::getUserByEmail($email)){
                if($stmt = $database->prepare("INSERT INTO tb_users(firstName, lastName, email, password, phone, address, status, admin) VALUES (?,?,?,?,?,?,?,?)")){
                    $stmt->bind_param("ssssssii", $firstName, $lastName, $email, $password, $phone, $address, $status, $admin);
                    $stmt->execute();
                
                    if(!$stmt){
                        die('Query failed: '. mysqli_error($database));
                    } else {
                        $stmt->close();
                        self::login();
                    }
                }
            } else {
                return "This email already exist";
            }
        }

    }

    private static function getUserByEmail($email){
        global $database;

        if($stmt = $database->prepare("SELECT email FROM tb_users WHERE email = ?")){
            $stmt->bind_param("s", $email);
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

    public static function getUserData() {
        global $database;

        $email = $_SESSION['email'];

        $email = $database->escape_string($email);

        $userObject = new self;

        if($stmt = $database->prepare("SELECT id, firstName, lastName, email, password, phone, address, status, admin, lastLogin FROM tb_users WHERE email = ?")){
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $firstName, $lastName, $email, $password, $phone, $address, $status, $admin, $lastLogin);

            if($stmt->num_rows) {
                $stmt->fetch();

                $status = ($status ? "Active" : "Inactive");
                $admin = ($admin ? "Yes" : "No");

                $userObject->setId($id);
                $userObject->setFirstName($firstName);
                $userObject->setLastName($lastName);
                $userObject->setEmail($email);
                $userObject->setPassword($password);
                $userObject->setPhone($phone);
                $userObject->setAddress($address);
                $userObject->setStatus($status);
                $userObject->setAdmin($admin);
                $userObject->setLastLogin($lastLogin);

                $stmt->close();
                return $userObject;
            } else {
                $stmt->close();
                logout();
            }
        }
    }

    public static function updateUser() {
        global $database;

        if(isset($_POST['submit'])){

            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];        
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $email = $_SESSION['email'];

            $firstName = $database->escape_string($firstName);
            $lastName = $database->escape_string($lastName);
            $phone = $database->escape_string($phone);
            $address = $database->escape_string($address);
            $email = $database->escape_string($email);

            if($stmt = $database->prepare("UPDATE tb_users SET firstName = ?, lastName = ?, phone = ?, address = ?, modifiedDate = NOW() WHERE email = ?")){
                $stmt->bind_param("sssss", $firstName, $lastName, $phone, $address, $email);
                $stmt->execute();
            
                if(!$stmt){
                    die('Query failed: '. mysqli_error($database));
                    $stmt->close();
                    return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
                } else {
                    $stmt->close();
                    return "<div class='form-message-box-success'>Profile updated successfully!</div>";
                }
            }
            
        }

    }

    public static function updatePassword() {
        global $database;

        if(isset($_POST['submit'])){
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['password'];
            $email = $_SESSION['email'];

            $currentPassword = $database->escape_string($currentPassword);
            $newPassword = $database->escape_string($newPassword);
            $email = $database->escape_string($email);

            if($stmt = $database->prepare("SELECT password FROM tb_users WHERE email = ?")){
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($password);

                // decrypt password --> http://php.net/manual/en/function.password-verify.php
                if($stmt->num_rows){
                    $stmt->fetch();

                    if(password_verify($currentPassword, $password)){
                        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT); 

                        if($stmt = $database->prepare("UPDATE tb_users SET password = ? WHERE email = ?")){
                            $stmt->bind_param("ss", $newPassword, $email);
                            $stmt->execute();
                        
                            if(!$stmt){
                                die('Query failed: '. mysqli_error($database));
                                $stmt->close();
                                return "<div class='form-message-box-fail'>Something got wrong. Please, try again.</div>";
                            } else {
                                $stmt->close();
                                return "<div class='form-message-box-success'>Password changed successfully!</div>";
                            }
                        }

                    } else {
                        $stmt->close();
                        return "<div class='form-message-box-fail'>Current Password incorrect</div>";
                    }
                }
            }
        }
    }

    public static function getAllUsers(){
        global $database;

        $query = "SELECT id, firstName, lastName, email, phone, address, status, admin, lastLogin FROM tb_users ORDER BY firstName";
        $result = $database->query($query);

        $users = [];

        if($result->num_rows) {
            while($row = $result->fetch_assoc()){
                $userObject = new self;

                $status = ($row['status'] ? "Active" : "Inactive");
                $admin = ($row['admin'] ? "Yes" : "No");

                $userObject->setId($row['id']);
                $userObject->setFirstName($row['firstName']);
                $userObject->setLastName($row['lastName']);
                $userObject->setEmail($row['email']);
                $userObject->setPhone($row['phone']);
                $userObject->setAddress($row['address']);
                $userObject->setStatus($status);
                $userObject->setAdmin($admin);
                $userObject->setLastLogin($row['lastLogin']);

                $users[] = $userObject;
            }
        }

        return $users;
    }

    public static function getAllUsersScoreAverages(){
        global $database;

        $query = "SELECT u.id as idUser, AVG(r.score) as userScoreAverage FROM tb_users u, tb_tests_results r WHERE u.id = r.idUser and u.admin = 0 and u.status = 1 GROUP BY u.id";
        $result = $database->query($query);

        $usersScoreAverage = [];

        if($result->num_rows) {
            while($row = $result->fetch_assoc()){
                $userScoreAverage = [];

                $userScoreAverage = [
                    'idUser'=>$row['idUser'], 
                    'userScoreAverage'=>$row['userScoreAverage']
                ];

                array_push($usersScoreAverage, $userScoreAverage);
            }
        }

        return $usersScoreAverage;
    }

    public static function login(){
        global $database;

        if(isset($_POST['submit'])){

            $email = $_POST['email'];
            $informedPassword = $_POST['password']; // criptografia aqui

            $email = $database->escape_string($email);
            $informedPassword = $database->escape_string($informedPassword);

            if($stmt = $database->prepare("SELECT id, firstName, lastName, email, password, phone, address, status, admin FROM tb_users WHERE email = ?")){
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id, $firstName, $lastName, $email, $password, $phone, $address, $status, $admin);

                // decrypt password --> http://php.net/manual/en/function.password-verify.php
                if($stmt->num_rows){
                    $stmt->fetch();

                    if(password_verify($informedPassword, $password)){
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['firstName'] = $firstName;
                        $_SESSION['lastName'] = $lastName;
                        $_SESSION['userId'] = $id;
                        $_SESSION['admin'] = $admin;
                        $stmt->close();
                        self::redirectDashboard();
                    } else {
                        $stmt->close();
                        return "Password incorrect";
                    }
                }
            }

            $stmt->close();
            return "Email or Password incorrect";
        }

    }

    // SESSIONS
    public static function getSession() {
        session_start();
        
        if($_SESSION['email'] === null){
            self::redirectLogin();
        }
    }

    public static function logout(){
        session_destroy();
        self::redirectLogin();
    }

    // REDIRECTS
    public static function redirectDashboard(){
        header("Location: dashboard.php");
        exit;
    }

    public static function redirectLogin() {
        header("Location: index.php");
        exit;
    }

    public static function redirectAdminDashboard(){
        header("Location: admin/admin-dashboard.php");
        exit;
    }

    public static function redirectUserDashboard(){
        header("Location: dashboard.php");
        exit;
    }

}



?>