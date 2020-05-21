<?php
session_start();
if(isset($_POST['temat']))
{
include('../class/db.php'); 
$notki = new dbh();
$notki->dodaj($_POST['temat'], $_POST['tytul'], $_POST['tresc'], $_SESSION['imie_nazwisko']);
if(isset($_FILES['file'])){
$notki->dodajplik($_FILES['file'], $_SESSION['imie_nazwisko']);
}
unset($_POST['temat']);
unset($_POST['tytul']);
unset($_POST['tresc']);
header('Location: ../index.php');
}
?>