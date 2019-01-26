<?php

    $connection = mysqli_connect('localhost', 'root', 'root', 'test_your_knowledge');

    if(!$connection){
        die("Database connection failed");
    }

?>