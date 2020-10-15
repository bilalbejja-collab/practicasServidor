<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Agenda</h1>

<?php
    //Leemos la agenda y devolvemos array con los contactos
    function leerArchivo($fichero) {
        //Contactos
        $contactos = array();

        //Leemos la agenda
        $datos = file_get_contents($fichero);

        //Nos creamos una array con cada contacto de la agenda
        $datos = explode("\n",$datos);
        array_pop($datos);

        foreach($datos as $valor) {
            //En $contacto tenemos en la primera posición el nombre y en la segunda el teléfono
            $contacto = explode("-",$valor);
            $contactos[] = array("nombre" => $contacto[0], "tlf" => $contacto[1]);
        }  
        
        return $contactos;
    }

    //Pintamos en una tabla la agenda
    function pintarAgenda($contacts) {
        echo "<table>";
        foreach($contacts as $contacto) {
            echo "<tr>";
            echo "<td>".$contacto['nombre']."</td><td>".$contacto['tlf']."</td>";
            echo "<td><a href='file1.php?borrar=".$contacto['tlf']."'>x</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function escribirArchivo($contacts) {
        //Solo para que sea más eficiente y no abra y cierre el archivo cada vez que escribes
        //file_put_contents("agenda.txt",$valor['nombre']."-".$valor['tlf']."\n",FILE_APPEND|LOCK_EX);
        $file = fopen("agenda.txt","w");
        if (flock($file, LOCK_EX)) {
            foreach($contacts as $valor) {
                fwrite($file,$valor['nombre']."-".$valor['tlf']."\n");
            }
        }
        fflush($file);
        flock($file, LOCK_UN);
        fclose($file);
    }

    //Leemos el archivo
    $contactos = leerArchivo("agenda.txt");

    //Compruebo que se haya solicitado eliminar un contacto
    if (isset($_GET['borrar'])) {
        if (in_array($_GET['borrar'],array_column($contactos, 'tlf'))) {
            //Buscamos la posicion del array donde está ese telefono
            $posicion = array_search($_GET['borrar'],array_column($contactos, 'tlf'));
            //Eliminamos ese contacto del array
            unset($contactos[$posicion]);
            //Escribimos el array entero al archivo, sobrescribiéndolo
            escribirArchivo($contactos);
        }
    }

    //Comprobar que hemos mandado el formulario
    if ($_POST) {
        //Si el teléfono no está en la agenda lo añadimos
        if (!in_array($_POST['tlf'],array_column($contactos, 'tlf')))
            file_put_contents("agenda.txt",$_POST['nombre']."-".$_POST['tlf']."\n",FILE_APPEND|LOCK_EX);

        
    }
  
    $contactos = leerArchivo("agenda.txt");
    pintarAgenda($contactos);


?>

    <form action="file1.php" method="post">
        <input type="text" name="nombre">
        <input type="tel" name="tlf">
        <input type="submit" value="Añadir">
    </form>

</body>
</html>
