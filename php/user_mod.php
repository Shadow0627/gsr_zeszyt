<?php
session_start();
$userid = $_SESSION['id'];
$username = $_SESSION['name'];
$userimie = $_SESSION['imie_nazwisko'];; 
print('<form class="postadd" action="" method="POST">
    <label for="nick">Twój login: </label>
    <input type="text" name="newlogin" id="nick" value="' .$username. '">
    <input type="submit" value="zmień"> 
</form>');

print('<form class="postadd" action="" method="POST">
    <label for="pass">Nowe hasło: </label>
    <input type="password" name="newpass" id="pass">
    <input type="submit" value="zmień"> 
</form>');
if(isset($_POST['newlogin']))
{
        $newnick = $_POST['newlogin'];
        $notki->zmiennick($newnick, $userid);
}
if(isset($_POST['newpass']))
{
        $newpass = $_POST['newpass'];
        $notki->zmienpass($newpass, $userid);
}


unset($newnick);
unset($newpass);
?>