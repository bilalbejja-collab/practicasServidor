<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>News Jaroso</title>
</head>
<body>
    
</body>
</html>




    <div class='container'>
    
        <h1>NEWS JAROSO</h2>
         
<?php
        //Leemos el array de noticias y lo vamos pintando
        //De prueba creamos noticias de prueba

        $_SESSION['news'] = array(
            
            array("index" => 1,
                  "titulo" => "Confinan Cuevas de Almanzora",
                  "encabezado" => "Después de una fiesta organizada en el IES Jaroso se han disparado los casos",
                  "imagen" => "img/1.jpg",
                  "texto" => "Lorem ipsum .... "),

            array("index" => 2,
                  "titulo" => "Trump muere de coronavirus",
                  "encabezado" => "Se veía venir",
                  "imagen" => "img/2.jpg",
                  "texto" => "Lorem ipsum .... ")


        );

?>

    </div>