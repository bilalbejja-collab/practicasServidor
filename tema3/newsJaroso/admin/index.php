<?php
    session_start();
    if (!isset($_SESSION['user-agent']))
        $_SESSION['user-agent']=$_SERVER['HTTP_USER_AGENT'];
    else {
        if ($_SESSION['user-agent']!=$_SERVER['HTTP_USER_AGENT'])
            session_destroy();
    }
/*
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
*/
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Admin - News Jaroso</title>
</head>
<body>

    <script defer src="https://use.fontawesome.com/4ed39114a6.js"></script>

    <div class='container'>
        <h3 class='mt-3'>MÓDULO ADMIN DE NEWSJAROSO</h3>


<?php
    //Login de usuario
    if (isset($_SESSION['usuario'])) {
        echo "<h4>".$_SESSION['usuario']['email']."</h4>";
        echo "<h6><a href='cerrar.php'>Cerrar sesión</a></h6>";

        echo "<table class='table table-dark'>";
        if (isset($_SESSION['news'])) {        
            foreach($_SESSION['news'] as $new) {
                echo "<tr>";
                echo "<td>".$new['titulo']."</td>";
                echo "<td>".$new['encabezado']."</td>";
                echo "<td><img src='../".$new['imagen']."' width='200' class='img-thumbnail' alt='".$new['titulo']."'></td>";
                echo "<td>".$new['texto']."</td>";
                echo "<td><a href='del_new.php?id=".$new['index']."'><i class='text-danger fa fa-trash' aria-hidden='true'></i></a></td>";
                echo "</tr>";
            }  
        }
        echo "</table>";  
        echo "<a href='add_new.php'><button type='button' class='btn btn-success'>Add</button></a>";

        
    } else {
        //Pintar formulario de login de usuario
?>        
        
        <form action="login.php" method="post">
            <div class="form-group col-5">
                <label for="titulo">Email</label>
                <input type="email" class="form-control form-control-sm" name="email" required>            
            </div>
            <div class="form-group col-5">
                <label for="encabezado">Password</label>
                <input type="password" class="form-control form-control-sm" name="password" required>            
            </div>
            <div class="form-group col-5">
                <button type="submit" class="btn btn-primary">Login</button> 
                <button type="reset" class="btn btn-primary">Clear</button> 
            </div>
        </form>
<?php

    }


?>


    </div>


</body>
</html>






