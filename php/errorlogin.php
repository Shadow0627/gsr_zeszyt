<?php
session_start();
echo $_SESSION['logerr'];
session_destroy();
?>