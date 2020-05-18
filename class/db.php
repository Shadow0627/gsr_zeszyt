<?php
class dbh{
    private $host = "fdb22.awardspace.net";
    private $user = "2826309_db";
    private $pwd = "1qaz2wsXX";
    private $dbname = "2826309_db";
    protected function connect(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

    public function login($nick, $pass)
    {
        $sql = "SELECT * FROM gsr_zeszyt WHERE nick = ? AND haslo = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$nick, $pass]);
        if($stmt->rowCount() == 1)
        {
            session_start();
            $_SESSION['login'] = 1;
            $row = $stmt->fetch();
            $_SESSION['name'] = $row['nick'];
            $_SESSION['imie_nazwisko'] = $row['imie_nazswisko'];
        }
        else
        {
            session_start();
            $_SESSION['logerr'] = "błędne dane logowania";
            header('Location: ../index.php');
            
        }
    }
}