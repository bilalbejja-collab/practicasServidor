<?php   
    namespace ProyectoPeliculas;

    //Librería de películas

    //Cabecera HTML
    include_once("cabecera.php");
    //Librería con funciones sobre películas
    include "libreria.php";

    $peliculas = array(
        array("titulo" => "Reservoir Dogs", "director" => "Tarantino", "nota" => 8),
        array("titulo" => "Ciudadano Kane", "director" => "Wells", "nota" => 9),
        array("titulo" => "Apocalipse Now", "director" => "Coppola", "nota" => 9)               
    );

    pintar($peliculas);
    $resultado = nota_media($peliculas);
    echo "<p>Hay ".$resultado[1]." películas y la media es ".$resultado[0]."</p>";

    /*
    echo $_SERVER['SERVER_PROTOCOL']."<br>";
    echo $_SERVER['REQUEST_TIME']."<br>";
    echo $_SERVER['REQUEST_TIME_FLOAT']."<br>";
    echo $_SERVER['SERVER_PORT']."<br>";
    echo $_SERVER['REQUEST_URI']."<br>";
    */


    //Incluimos el pie de HTML
    include_once("pie.php");
?>