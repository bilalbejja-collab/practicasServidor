<?php
    session_start();
    //session_destroy();
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
    
    //Si hemos recibido el formulario hay que añadir la noticia a la sesión
    if ($_POST) {
        //Añadir noticia
        
        //Para que el índice esté bien debemos ver el mayor y sumarle uno
        $indices = [];
        foreach ($_SESSION['news'] as $new)
            $indices[] = $new['index'];      

        array_push($_SESSION['news'],array("index" => max(array_values($indices))+1,
                                           "titulo" => $_POST['titulo'],
                                           "encabezado" => $_POST['encabezado'],
                                           "imagen" => $_POST['imagen'],
                                           "texto" => $_POST['texto']));
                                           
        
        header('Location: index.php');

    } else {
        //Pintar el formulario de añadir noticia
?>

    <form action="add_new.php" method="post">
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
                <input type="text" class="form-control form-control-sm" name="imagen" required>            
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