<?php  
    //Librería para usar una aplicación de películas
    
    //Función para pintar un array de peliculas
    function pintar($peliculas) {
        echo "<table class='table'>";
        foreach($peliculas as $pelicula) {
            echo "<tr>";
            foreach($pelicula as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    //Función para saber la nota media de todas las películas
    //Devuelve un array donde la primera posición es la nota media
    //y la segunda es el total de películas
    function nota_media($peliculas) {
        $numpeliculas = count($peliculas);
        $notas = 0;
        foreach($peliculas as $pelicula) {
           $notas += $pelicula['nota'] ;
        }

        return ([$notas/$numpeliculas,$numpeliculas]);
    }



?>
