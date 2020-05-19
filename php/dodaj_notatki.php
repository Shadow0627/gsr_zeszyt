<?php
if($_SESSION['login'] == 1)
{
 echo '<form class="postadd" action="php/add.php" method="POST">
 <label for="temat">Temat notatki: </label>
 <input type="text" name="temat" id="temat" require><br>
 <label for="tytul">Tytuł notatki: </label>
 <input type="text" name="tytul" id="tytul" require><br>
 <label for="tresc">Treść notatki: </label>
 <textarea name="tresc" id="tresc" cols="30" rows="10" require></textarea>
 <br>
 <input type="submit" value="Wstaw">
 </form>';
}else
{
    echo'zaloguj aby zobaczyć';
}
?>


