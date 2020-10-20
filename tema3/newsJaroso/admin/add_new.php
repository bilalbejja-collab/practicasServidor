<?php
    session_start();
    if (!isset($_SESSION['user-agent']))
        $_SESSION['user-agent']=$_SERVER['HTTP_USER_AGENT'];
    else {
        if ($_SESSION['user-agent']!=$_SERVER['HTTP_USER_AGENT'])
            session_destroy();
    }    
    include_once('lib/lib.php');
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>News Jaroso</title>
</head>
<body>

    <div class='container'>
        <h3 class='mt-3'>MÓDULO ADMIN DE NEWSJAROSO</h3>
        <h4>Añadir nueva noticia:</h4>

<?php

    //Función para subir un archivo al servidor
    function uploadFile() {
        $directorioSubida = "../img/";
        $max_file_size = "5120000";
        $extensionesValidas = array("jpg", "png", "gif");
        $mimesValidos = array("image/jpeg", "image/png", "image/gif");
        if(isset($_FILES['imagen'])){
            $errores = array();
            $nombreArchivo = $_FILES['imagen']['name'];
            $filesize = $_FILES['imagen']['size'];
            $directorioTemp = $_FILES['imagen']['tmp_name'];
            $tipoArchivo = $_FILES['imagen']['type'];
            $arrayArchivo = pathinfo($nombreArchivo);
            $extension = $arrayArchivo['extension'];
            // Comprobamos la extensión del archivo
            if(!in_array($extension, $extensionesValidas)){
                $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
            }

            //Comprobar que el mime del archivo coincide con el tipo de extensiones permitidas
            $mimeinfo = finfo_open(FILEINFO_MIME);
            if(!$mimeinfo){
                $errores[] = "Por motivos de seguridad no puedo analizar el archivo";
            }else{
                $mimereal = finfo_file($mimeinfo, $_FILES["imagen"]["tmp_name"]);
                $mimereal = explode(";",$mimereal)[0]; //Quito lo que viene tras ;
                if(!in_array($mimereal,$mimesValidos)) {
                    $errores[] = "El mime real no corresponde. $mimereal";
                }
            }

            // Comprobamos el tamaño del archivo
            if($filesize > $max_file_size){
                $errores[] = "La imagen debe de tener un tamaño inferior a 50 kb";
            }

            // Comprobamos y renombramos el nombre del archivo [opcional]
            $nombreArchivo = $arrayArchivo['filename'];
            $nombreArchivo = preg_replace("/[^A-Z0-9._-]/i", "_", $nombreArchivo);
            $nombreArchivo = $nombreArchivo . rand(1, 100);

            // Desplazamos el archivo si no hay errores
            if(empty($errores)){
                $nombreCompleto = $directorioSubida.$nombreArchivo.".".$extension;
                move_uploaded_file($directorioTemp, $nombreCompleto); 
                return substr($nombreCompleto, 3); //Para quitar el ../            
            } else {
                return $errores;
            }
            
        }
    }

    //Si hemos recibido el formulario hay que añadir la noticia a la sesión
    if ($_POST) {
        //Añadir noticia
        
        //Para que el índice esté bien debemos ver el mayor y sumarle uno
        $indices = [0];
        if (isset($_SESSION['news'])){
            $indices = array_column($_SESSION['news'],'index');     
        } else {
            $_SESSION['news'] = [];
        }

        //Subimos el fichero al servidor - devuelve el nombre de la imagen
        $imagen = uploadFile();

        array_push($_SESSION['news'],array("index" => max(array_values($indices))+1,
                                           "titulo" => filtrado($_POST['titulo']),
                                           "encabezado" => filtrado($_POST['encabezado']),
                                           "imagen" => filtrado($imagen),
                                           "texto" => filtrado($_POST['texto'])));
                                           
        header('Location: index.php'); exit;

    } else {
        //Pintar el formulario de añadir noticia
?>

    <form action="add_new.php" method="post" enctype="multipart/form-data">
            <div class="form-group col-5">
                <label for="titulo">Título</label>
                <input type="text" class="form-control form-control-sm" name="titulo" required>            
            </div>
            <div class="form-group col-5">
                <label for="encabezado">Encabezado</label>
                <input type="text" class="form-control form-control-sm" name="encabezado" required>            
            </div>
            <div class="form-group col-5">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control form-control-sm" name="imagen" required>            
            </div>
            <div class="form-group col-5">
                <label for="texto">Texto completo</label>
                <textarea class="form-control form-control-sm" name="texto" rows="5" cols="10"></textarea>           
            </div>
            <div class="form-group col-5">
                <button type="submit" class="btn btn-primary">Add</button> 
                <button type="reset" class="btn btn-primary">Clear</button> 
                <a href="index.php"><button type="button" class="btn btn-info">Volver</button></a>
        </div>
    </form>

<?php
    }
?>
    </div>
</body>
</html>