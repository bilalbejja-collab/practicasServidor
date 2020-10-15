<?php
session_start();
if (!isset($_SESSION['user-agent']))
    $_SESSION['user-agent']=$_SERVER['HTTP_USER_AGENT'];
else {
    if ($_SESSION['user-agent']!=$_SERVER['HTTP_USER_AGENT'])
        session_destroy();
}

    unset($_SESSION['usuario']);
    header("Location: index.php");

?>