<?php
if($_SESSION['login'] == 1)
{
 echo '<form class="postadd" enctype="multipart/form-data" action="php/add.php" method="POST">
 <label for="temat">Temat notatki: </label>
 <input type="text" name="temat" id="temat" required><br><br><br>
 <label for="tytul">Tytuł notatki: </label>
 <input type="text" name="tytul" id="tytul" required><br><br><br>
 <label for="tresc">Treść notatki: </label>
 <textarea name="tresc" id="tresc" cols="30" rows="10" required></textarea>
 <br><br><br>
 <lable for="file">Pliki</lable>
 <input type="file" name="file" id="file">
 <br><br><br>
 <input type="submit" class="type" value="Umieść!">
 </form>
 ';
}else
{
    echo'zaloguj aby zobaczyć';
}
?>


