<?php 
include('../class/db.php');
$test = new dbh();
$test->login($_POST['login'], $_POST['pass']);
header('Location: ../index.php');

?>