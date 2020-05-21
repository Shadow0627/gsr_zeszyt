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
            $_SESSION['id'] = $row['id']; 
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
            $idpo = $row['id'];
            $query = "SELECT nazwa FROM gsr_zeszyt_pliki WHERE post_id = ?";
            $work = $this->connect()->prepare($query);
            $work->execute([$idpo]);
            $efect= $work->fetch();
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
                        <div class="file">
                        ';  if(!empty($efect['nazwa'])){
                        echo'   <a href= "/zeszyt/dane/' .$efect['nazwa']. '" download>Plik do teamtu</a>';
                        }
                            echo'
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
        $sql = 'INSERT INTO gsr_zeszyt_notatki (temat, tytul, tresc, autor, data, godzina) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$temat, $tytul, $tresc, $autor, $data, $time]);
    }

    public function dodajplik($plik, $autor)
    {
      $sql = 'SELECT MAX(id) AS maxx FROM gsr_zeszyt_notatki WHERE autor = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$autor]);
        $result = $stmt->fetch();
        $max = $result;
        $maxx = $max['maxx'];
        $temp = explode(".", $plik['name']);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        if(move_uploaded_file($plik['tmp_name'], '../dane/' . $newfilename))
        {
        $data = date('y-m-d');
        $time = date('H:i:s');
        $sql = 'INSERT INTO gsr_zeszyt_pliki (nazwa, autor, data, godzina, post_id) VALUES (?, ?, ?, ?, ?)';
        $stmt= $this->connect()->prepare($sql);
        if($stmt->execute([$newfilename, $autor, $data, $time, $maxx]))
        {

        }
        else
        {
            echo "duupoa !!" . error_get_last();
        }
        
        }
        else
        {
            echo '   <br> dupa    ' . error_get_last() ;
        }
        
    }

    public function zmiennick($nick, $id)
    {
    $sql = "UPDATE gsr_zeszyt  SET nick = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    if($stmt->execute([$nick, $id]))
        {
        }
        else
        {
            echo "duupoa !!" . error_get_last();
        }
    }


    public function zmienpass($pass, $id)
    {
        $sql = "UPDATE gsr_zeszyt  SET haslo = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    if($stmt->execute([$pass, $id]))
        {
        }
        else
        {
            echo "duupoa !!" . error_get_last();
        }
    }
}