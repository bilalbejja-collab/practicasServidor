<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<?php
    //Función para validar que los campos del formulario hay que pintarlos cuando hay errores o en blanco
    function valor(&$cadena) {
        if (isset($cadena)) {
            return $cadena;
        } else {
            return "";
        }
    }


    //Variable para recoger todos los errores del formulario
    $errores = array();

    //Lectura del formulario
    if ($_POST) {
        //Comprobando cada uno de los campos
        if (strlen($_POST['email'] >= 0)) {
            echo "Mail: ".$_POST['email'];
        } else {
            $errores[] = "Email no introducido";
        }
        if (strlen($_POST['password']) >= 8) {
            echo "Password: ".$_POST['password'];
        } else {
            $errores[] = "Password no introducido o menor de 8 caracteres";
        } 
        if (isset($_POST['lenguajes'])) {
            echo "Lenguajes: ";
            foreach($_POST['lenguajes'] as $lenguaje)
                echo $lenguaje." ";
        } else {
            $errores[] = "Lenguajes no introducido";
        } 
        if (strlen($_POST['date'] >= 0)) {
            echo "Fecha Nacimiento: ".$_POST['date'];
        } else {
            $errores[] = "Fecha no introducido";
        } 
        if (strlen($_POST['comentario'] >= 0)) {
            echo "Comentario: ".$_POST['comentario'];
        } else {
            $errores[] = "Comentario no introducido";
        }  
        if (isset($_POST['country'])) {
            echo "Países: ";
            //El input select es múltiple, permite seleccionar más de un elemento
            foreach($_POST['country'] as $pais)
                echo $pais." ";
        } else {
            $errores[] = "Países no introducido";
        }                                        

    }

?>


<?php
    //Si el formulario se ha enviado y no tiene errores entonces no lo pinto
    //Haría la tarea correspondiente

    if ($_POST && count($errores)==0) {
        echo "<h2>ENVIADO CORRECTAMENTE</h2>";
    } else {

?>
<div class="container">
    <form action="formulario.php" method="post">
        <div class="form-group col-5">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control form-control-sm" name="email" value="<?= valor($_POST['email'])?>" required>            
        </div>
        <div class="form-group col-5">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control form-control-sm" name="password" value="<?= valor($_POST['password'])?>" required>
        </div>
        <div class="form-group col-5">
            <label for="exampleInputEmail1">Fecha de nacimiento:</label>
            <input type="date" class="form-control form-control-sm" name="date" value="<?= valor($_POST['date'])?>">            
        </div>        
        <div class="form-group form-check ml-3">
            <input type="checkbox" class="form-check-input" name="lenguajes[]" value="Java">
            <label class="form-check-label" for="exampleCheck1">Java</label>
        </div>
        <div class="form-group form-check ml-3">
            <input type="checkbox" class="form-check-input" name="lenguajes[]" value="PHP">
            <label class="form-check-label" for="exampleCheck1">PHP</label>
        </div>
        <div class="form-group col-5 ml-3">
            <label for="exampleFormControlSelect1">País</label>
            <select class="form-control form-control-sm" name="country[]" multiple>
<?php  
    //Código para pintar las opciones del select en caso de error recordando las opciones marcadas
    if(isset($_POST['country'])) {
        $paises = array("Alemania","Francia","Italia","España","Dinamarca");
        foreach($paises as $pais) {
            if(in_array($pais,$_POST['country'])) {
                echo "<option value='$pais' selected>$pais</option>";
            } else {
                echo "<option value='$pais'>$pais</option>";            }

        }
    } else {
?>
                <option value="Alemania">Alemania</option>
                <option value="Francia">Francia</option>
                <option value="Italia">Italia</option>
                <option value="España">España</option>
                <option value="Dinamarca">Dinamarca</option>
<?php
    }
?>
            </select>
        </div>
        <div class="form-group col-5 ml-3">
            <label class="form-label" >Comentarios</label>
            <textarea class="form-control form-control-sm" name="comentario" rows="3" cols="10"><?= valor($_POST['comentario'])?></textarea>          
        </div>        
        <div class="form-group col-5">
            <button type="submit" class="btn btn-primary">Submit</button> 
            <button type="reset" class="btn btn-primary">Clear</button> 
            <a href='borrar.php?id=3'><button type="button" class="btn btn-primary">Acción</button> </a>
        </div>
    
    </form>
</div>

<?php
    //Cierro la comprobación del formulario enviado sin errores
    }

    //Pintamos los errores
    foreach($errores as $error) {
        echo $error."<br>";
    }

?>


</body>
</html>

