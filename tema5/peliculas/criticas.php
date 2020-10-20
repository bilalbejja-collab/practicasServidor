
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mis Películas Favoritas</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/estilos.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<h2>Mis <b>Películas</b> Favoritas</h2>
					</div>
                    <div class="col-sm-8">                       
                        <a href="#nuevaCriticaModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Críticas</span></a>
                        <a href="index.php" class="btn btn-warning"><i class="material-icons">arrow_back</i></a>
                    </div>
                </div>
			</div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nota</th>
                        <th>Autor</th>
						<th>Texto</th>
                        <th>Accciones</th>
                    </tr>
                </thead>
                <tbody>
<?php
		//Mostramos las peliculas desde la BD
		require('conexion.php');
		$conexion = conectar("2daw");

		//La consulta
		$consulta = "SELECT * FROM criticas WHERE id_pelicula={$_GET['id_pelicula']} ORDER BY nota DESC";

		//Para mostrar correctamente la codificación
		$conexion->query("SET NAMES utf8");
		$resultado = $conexion->query($consulta);

		//Recorremos los resultados
		while($critica = $resultado->fetch_array()) {
?>
                    <tr>

                        <td><?php echo $critica['nota']; ?></td>
                        <td><?php echo $critica['autor']; ?></td>
						<td><?php echo $critica['texto']; ?></td>
                        <td>
                            <a href="controlador.php?borrar_critica=<?php echo $critica['id_critica'];?>&pelicula=<?php echo $_GET['id_pelicula'];?>"><i class="material-icons" title="Borrar">delete</i></a>
                        </td>
                    </tr>
<?php
		}
?>
                </tbody>
			</table>

    <div id="nuevaCriticaModal" class="modal fade">
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
							<input type="range" name="nota" class="form-control" min="1" max="5" required>
						</div>
						<div class="form-group">
							<label>Texto</label>
							<textarea class="form-control" name="texto" required></textarea>
						</div>	
                        <input type="hidden" name="id_pelicula" value="<?php echo $_GET['id_pelicula'];?>">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" name="add_critica" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>                                		                            