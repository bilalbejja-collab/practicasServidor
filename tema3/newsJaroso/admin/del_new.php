<?php
    session_start();
    
    //Borramos la noticia recibida por GET
    if ($_GET) {
        //Busca el elemento del array de sesión que tiene el mismo id que recibe por GET
        //Para ello buscamos en el array de sesión por la columna 'index'
        $key_delete = array_search($_GET['id'], array_column($_SESSION['news'], 'index'));

        //Eliminamos el elemento en esa posición del array
        unset($_SESSION['news'][$key_delete]);

        //El elemento queda a null pero la posición no se borra. Rehacemos el array regenerando las keys
        $_SESSION['news'] = array_values($_SESSION['news']);
    }
    header('Location: index.php');



?>