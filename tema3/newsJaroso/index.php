<?php
    session_start();
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
    
        <h1>NEWS JAROSO</h2>
         
<?php
        //Leemos el array de noticias y lo vamos pintando
        //De prueba creamos noticias de prueba
        //La primera no está definida la sesión y crea el array. Luego ya sólo lo mostrará
        if (!isset($_SESSION['news'])) {
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
        }

        foreach($_SESSION['news'] as $new) {
            echo "<div class='row mt-4'>";
            echo "  <div class='card' style='width: 25rem;'>";
            echo "    <img src='".$new['imagen']."' class='card-img-top' alt='".$new['titulo']."'>";
            echo "    <div class='card-body'>";
            echo "      <h3 class='card-title'>".$new['titulo']."</h3>";
            echo "      <h5 class='card-title'>".$new['encabezado']."</h5>";
            echo "      <p class='card-text'>".$new['texto']."</p>";
            echo "    </div>";
            echo "  </div>";
            echo "</div>";        
        }


?>

    </div>

</body>
</html>    