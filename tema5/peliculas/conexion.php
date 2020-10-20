<?php
    //Conexión a BD
    function conectar($basededatos) {
        $MySQL_host = "localhost";
        $MySQL_user = "usuario";
        $MySQL_password = "iesjrs20";
        $conexion= new mysqli($MySQL_host,$MySQL_user,$MySQL_password, $basededatos);
        if ($conexion->connect_error) 
            die("No ha podido realizarse la conexión");
        else {
            return $conexion;
        }    
    }

?>