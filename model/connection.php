<?php

    define("DB_HOST",'localhost');
    define("DB_USER", 'root');
    define("DB_PASSWORD", 'root');
    define("DB_NAME", 'test_your_knowledge');

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if(!$connection){
        die("Database connection failed");
    }

?>