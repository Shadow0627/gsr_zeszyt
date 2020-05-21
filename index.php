<?php session_start() ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>GSR-NOTATKI</title>
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <?php if($_SESSION['login']==1)
                    { 
                        echo "<li id='li6'>";
                        echo 'zalogowano jako: ' . $_SESSION['imie_nazwisko'];
                        echo "</li>";
                    }
                    ?>
                    <li id="li1">Notatki</li>
                    <li id="li2">Szukaj notatki</li>
                    <li id="li3">Dodaj Notatke</li>
                    <?php if($_SESSION['login']==1)
                    { 
                        echo '<li id="li5">Wyloguj</li>';
                    }
                    else
                    {
                        echo '<li id="li4">Zaloguj</li>';
                    }
                    ?>
                    
                </ul>
            </nav>
        </header>
        <h1 class="top-title">Wspólny zeszyt kadetów GSR!!</h1>
        <div class="hide" id="6" style = "display: none;">
            <h2>Zarządaj kontem</h2>
            <?php include('php/user_mod.php'); ?>
        </div>
        <div class="hide" id="1" style = "display: none;">
            <h2>Notatki</h2>
            <?php include('php/notatki.php'); ?>
        </div>
        <div class="hide" id="2" style = "display: none;">
            <h2>Szukaj  notatki</h2>
            <?php include('php/szukaj_notatki.php'); ?>
        </div>
        <div class="hide" id="3" style = "display: none;">
            <h2>Dodaj notatke</h2>
            <?php include('php/dodaj_notatki.php'); ?>
        </div>
        <div class="hide" id="4" style = "display: none;">
            <h2>Zaloguj</h2>
            <form class="loginform" action="php/login.php" method="post">
                <label for="login">Login:</label>
                <input type="text" name="login" id="login" required>
                <label for="pass">Haso:</label>
                <input type="password" name="pass" id="pass" required>
                <input type="submit" value="Zaloguj">
            </form>
        </div>
        <?php if($_SESSION['login']==1)
                    { 
                        echo '<div class="hide" id="5" style = "display: none;">
                        <h2>Wyloguj</h2>
                        <form class="loginform" action="php/logout.php" method="post">
                            <input type="submit" value="Wyloguj">
                        </form>
                    </div>';
                    }

                    ?>
    </body>
</html>
<script src="js/class.js"></script>
<?php
if(isset($_SESSION['logerr']))
{
    print('<script>
    alert(');
    echo "'";
     include('php/errorlogin.php');
      echo "'";
    print('
    );
</script>');
}
?>
