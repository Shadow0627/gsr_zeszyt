<?php 
include('../class/db.php');
$test = new dbh();
$test->login($_POST['login'], $_POST['pass']);
// echo $_SESSION['name'] . " " . $_SESSION['imie_nazwisko'];
header('Location: ../index.php');

?>