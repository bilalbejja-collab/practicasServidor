<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mis Películas Favoritas - Críticas cinematográficas</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/estilos.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php
    if (isset($_GET['pelicula'])) {
        //Obtenemos el título de la película
        require('conexion.php');
		$conexion = conectar("2daw");
        $consulta = "SELECT titulo FROM peliculas WHERE id_pelicula={$_GET['pelicula']}";
        $conexion->query("SET NAMES utf8");
        $resultado = $conexion->query($consulta);
        $pelicula = $resultado->fetch_assoc();

?>
    
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Mis <b>Películas</b> Favoritas</h2>
                    </div>
                    <div class="col-sm-4">
						<a href="#addCriticaModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Crítica</span></a>
                        <a href="index.php" class="btn btn-warning"><i class="material-icons">arrow_back</i></a>	
					</div>
                </div>
            </div>
            <div class="row col-sm-8">
                    <h4>&nbsp;Críticas cinematográficas - <?php echo $pelicula['titulo'];?></h4>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
	                    <th>Nota</th>
                        <th>Autor/Medio</th>
						<th>Crítica</th>
                        <th>Accciones</th>
                    </tr>
                </thead>
                <tbody>
<?php
		//Mostramos las críticas de la película desde la BD
		//La consulta
		$consulta = "SELECT * FROM criticas WHERE criticas.id_pelicula = {$_GET['pelicula']} ORDER BY nota DESC";

		//Para mostrar correctamente la codificación
		$conexion->query("SET NAMES utf8");
		$resultado = $conexion->query($consulta);

		//Recorremos los resultados
		$num_resultados=0;
		while($critica = $resultado->fetch_array()) {
			$num_resultados++;
?>
		
                    <tr>
                        <td><?php echo $critica['nota']; ?></td>
                        <td><?php echo $critica['autor']; ?></td>
						<td><?php echo $critica['critica']; ?></td>
                        <td>
                        <a href="controlador.php?delete_critica=<?php echo $critica['id_critica'];?>&pelicula=<?php echo $critica['id_pelicula'];?>"><i class="material-icons" data-toggle="tooltip" title="Borrar">&#xE872;</i></a>
                        </td>
                    </tr>
<?php
        }
        $conexion->close();
?>
                </tbody>
			</table>
			
        </div>
    </div>
<?php
    } else {
        header("Location: index.php");
    }
?>
    
    
	<!-- Add Modal HTML -->
	<div id="addCriticaModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method='POST' action='controlador.php'>
					<div class="modal-header">						
						<h4 class="modal-title">Añadir Crítica</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Autor</label>
							<input type="text" name="autor" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nota</label>
							<input type="range" name="nota" min="1" max="5" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Crítica</label>
							<textarea class="form-control" name="critica" required></textarea>
                        </div>
                        <input type="hidden" name="id_pelicula" value="<?php echo $_GET['pelicula'];?>">
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name='add_critica' class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>


</body>
</html>                                		                            