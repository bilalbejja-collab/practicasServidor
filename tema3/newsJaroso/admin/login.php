<?php
session_start();
if (!isset($_SESSION['user-agent']))
    $_SESSION['user-agent']=$_SERVER['HTTP_USER_AGENT'];
else {
    if ($_SESSION['user-agent']!=$_SERVER['HTTP_USER_AGENT'])
        session_destroy();
}

include_once('lib/lib.php');

    //Comprobación del email y password
    //Esto se haría en una BBDD

    //Comprobar que login = 'admin@admin.com' y password = 'nimda'
    if ($_POST) {
        $email = filtrado($_POST['email']);
        $password = filtrado($_POST['password']);

        if (($email == 'admin@admin.com') && ($password == 'nimda777')) {
            $_SESSION['usuario']['email'] = $_POST['email'];
            $_SESSION['usuario']['password'] = $_POST['password'];
        } 
    }

    header("Location: index.php");



?>

