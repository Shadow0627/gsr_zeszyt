<?php
class login{
    public $nick;
    public $pass;
    public function con()
    {
        $servername = "fdb22.awardspace.net";
$username = "2826309_db";
$password = "1qaz2wsXX";

try {
    $conn = new PDO("mysql:host=$servername;dbname=2826309_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    }
    public function logon($nick, $pass)
    {
      echo "Hi " .$nick. " your password is: " .$pass. "";
    }
    public function end()
    0
    {
        $conn->close();
    }
  }
   $nick = $_POST['login'];
    $pass = $_POST['pass'];
$con = new login();
$con->nick = $nick;
$con->pass = $pass;
$con->logon($nick, $pass);
$con->con();
$con->end();
?>