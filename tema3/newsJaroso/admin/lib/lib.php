<?php
    function filtrado($datos){
        $datos = trim($datos);                                  // Elimina espacios antes y después de los datos
        $datos = stripslashes($datos);                          // Elimina backslashes \
        $datos = filter_var($datos,FILTER_SANITIZE_STRING);     // Elimina todas las etiquetas    
        return $datos;
    }
?>