<?php
    session_start();
    
    //Borramos la noticia recibida por GET
    if ($_GET) {

        //Recorrer el array de noticias y borrar aquella que tenga el mismo índice
        foreach($_SESSION['news'] as &$new) {
            if ($new['index'] == $_GET['id']) {
                unset($new);
            }
        }
    }

    //header('Location: index.php');



?>