<?php ob_start(); // turn on output buffering ?>
<?php include "model/database.php"; ?>
<?php include "model/users.php"; ?>
<?php include "model/tests.php"; ?>
<?php include "model/questions.php"; ?>
<?php include "model/tests_results.php"; ?>
<?php include "model/tests_answers.php"; ?>
<?php include "view/tests.php"; ?>
<?php include "model/categories.php"; ?>
<?php include "view/tests_results.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test Your Knowledge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <script src="assets/js/scripts.js"></script>
</head>