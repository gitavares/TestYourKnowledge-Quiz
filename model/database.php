<?php

require_once("connection.php");

class Database {

    public $connection;

    function __construct(){
        $this->getConnection();
    }

    public function getConnection(){
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
        if($this->connection->connect_errno){
            die("Database connection failed: " . $this->connection->connect_errno);
        }
    }

    public function query($query){
        $result = $this->connection->query($query);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result){
        if(!$result){
            die("Query failed: " . $this->connection->error);
        }
    }

    public function escape_string($string){
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }

    public function the_insert_id(){
        return $this->connection->insert_id;
    }

    public function prepare($query){
        return $this->connection->prepare($query);
    }

    public function close(){
        return $this->connection->close();
    }

} 

$database = new Database();

?>