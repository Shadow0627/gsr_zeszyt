<?php
if($_SESSION['login'] == 1)
{

    ?>
    <form action="" method="get" class="szukanie">
        <label for="lista">Szukaj po tematach/tytułach/treści:</label>
        <input id="lista" type="text" name="szukaj" value="<?php if(isset($_REQUEST['szukaj'])){echo $_REQUEST['szukaj'];} ?>">
        <input type="submit" value="Szukaj">
    </form>
<?php
    $notki->szukaj($_REQUEST['szukaj']);
}
else
{
    echo "zaloguj aby zobaczyć";
}
?>