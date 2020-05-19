<?php
if($_SESSION['login'] == 1)
{
    include('./class/db.php'); 
    $notki = new dbh();
    $notki->selectall();
}
else
{
    echo "zaloguj aby zobaczyć";
}
?>