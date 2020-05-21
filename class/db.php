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

    public function selectall()
    {
        $sql = "SELECT * FROM gsr_zeszyt_notatki ORDER BY id DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $rows=$stmt->fetchAll();
        foreach($rows as $row)
        {
            echo'   <section class="notatka">
                        <div class="topic">
                            <h1>Temat: ' .$row["temat"]. '</h1>
                        </div>
                        <div class="title">
                            <h2>Tytuł: ' .$row["tytul"]. '</h2>
                        </div>
                        <div class="author">
                            <h3>Autor: ' .$row["autor"]. '</h3>
                        </div>
                        <div class="time">
                            <h4>Czas: ' .$row["data"]. ' ' .$row["godzina"]. '</h4>
                        </div>
                        <div class="content">
                            <pre>' .$row["tresc"]. '</pre>
                        </div>
                    </section>
                ';
        }
    }

    public function szukaj($wartosc)
    {
        $a = $wartosc;
        $b = $wartosc;
        $c = $wartosc;
        $d = $wartosc;
        $sql = "SELECT * FROM gsr_zeszyt_notatki WHERE temat LIKE ? OR tytul LIKE ? OR autor LIKE ? OR tresc LIKE ? ORDER BY id ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$a, $b, $c, $d]);
        $rows=$stmt->fetchAll();
        foreach($rows as $row)
        {
            echo'   <section class="notatka">
                        <div class="topic">
                            <h1>Temat: ' .$row["temat"]. '</h1>
                        </div>
                        <div class="title">
                            <h2>Tytuł: ' .$row["tytul"]. '</h2>
                        </div>
                        <div class="author">
                            <h3>Autor: ' .$row["autor"]. '</h3>
                        </div>
                        <div class="time">
                            <h4>Czas: ' .$row["data"]. ' ' .$row["godzina"]. '</h4>
                        </div>
                        <div class="content">
                            <p>' .$row["tresc"]. '</p>
                        </div>
                    </section>
                ';
        }
    }

    public function dodaj($temat, $tytul, $tresc, $autor)
    {
        $data = date('y-m-d');
        $time = date('H:i:s');
        // $sql = 'INSERT INTO gsr_zeszyt_notatki (temat, tytul, tresc, autor, data, godzina) VALUES (?, ?, ?, ?, ?, ?)';
        // $stmt = $this->connect()->prepare($sql);
        // $stmt->execute([$temat, $tytul, $tresc, $autor, $data, $time]);
    }

    public function dodajplik($plik, $autor)
    {
      $sql = 'SELECT MAX(id) AS maxx FROM gsr_zeszyt_notatki WHERE autor = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$autor]);
        $result = $stmt->fetchAll();
        $max = $result;
        $temp = explode(".", $plik["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        if(is_array($plik))
        {
            echo $newfilename;
        }else
        {
            echo "to nie plik !!!! <a href='../index.php>wroc</a>";
        }


        // $sql = 'INSERT INTO gsr_zeszyt_pliki (nazwa, data, godzina, post_id) VALUES (?, ?, ?, ?)';
        // $stmt= $this->connect()->prepare($sql);
        // $stmt->execute([])
        
    }
}