<?php
    session_start();
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

print_r($_SESSION['news']);
    echo "<table class='table table-dark'>";
    foreach($_SESSION['news'] as $new) {
        echo "<tr>";
        echo "<td>".$new['titulo']."</td>";
        echo "<td>".$new['encabezado']."</td>";
        echo "<td>".$new['imagen']."</td>";
        echo "<td>".$new['texto']."</td>";
        echo "<td><a href='del_new.php?id=".$new['index']."'><i class='text-danger fa fa-trash' aria-hidden='true'></i></a></td>";
        echo "</tr>";
    }  
    echo "</table>";  
    echo "<a href='add_new.php'><button type='button' class='btn btn-success'>Add</button></a>";


?>


    </div>


</body>
</html>






