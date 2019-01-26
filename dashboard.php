<?php
include "functions.php";

getSession();

?>

Welcome, <?php echo $_SESSION['firstName'] .' '. $_SESSION['lastName'] .' '. '('.$_SESSION['email'].' - id: '.$_SESSION['id'] .')'; ?>