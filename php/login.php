<?php
class login
{
    public $nick;
    private $pass;
    public function __construct($nick, $pass)
    {
        $this->nick = $nick;
        $this->pass = $pass;
    }
    public function check()
    {
        
        return " zalogowano $this->nick o hasle $this->pass";
    }
}
$admin = new login($_POST['login'], $_POST['pass']);
$user = new login('kocham', 'cie');
echo $admin->nick . '<br>';
echo $user->nick . '<br>';
echo $admin->check();
?>