<?php

    $cadena = "<script>alert('hola');</script>";
    echo filter_var($cadena,FILTER_SANITIZE_STRING);
    echo htmlspecialchars($cadena,ENT_QUOTES);


?>