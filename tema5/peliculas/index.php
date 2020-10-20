<?php
	session_start();
?>
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
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
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
						<a href="#addFilmModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Película</span></a>
						<a href="#deleteFilmModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>	
					</div>
                </div>
			</div>
<?php
		//FILTRO
		if (isset($_GET['buscar'])) {
			$busqueda = $_GET['filtro'];
			$_SESSION['filtro'] = $busqueda;
		} else {
			if (isset($_SESSION['filtro'])) {
				$busqueda = $_SESSION['filtro'];	
			} else {
				$busqueda = "";
			}
		}
		$like = "WHERE titulo LIKE '%$busqueda%' OR director LIKE '%$busqueda%'";
?>
            <div class="row">
				<form class="form-inline pull-right" method="GET" action="index.php">
					  <label class="">Filtro:</label>
					  <input type="text" class="form-control" name="filtro" id="inlineFormInputName" value="<?php echo $busqueda;?>">					  
					  <button type="submit" id="buscar" name="buscar" class="btn btn-info">
      					<span class="glyphicon glyphicon-search"></span>
    				  </button>
                </form>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Título</th>
                        <th>Género</th>
						<th>Director</th>
                        <th>Año</th>
                        <th>Sinopsis</th>
                        <th>Cartel</th>
                        <th>Accciones</th>
                    </tr>
                </thead>
                <tbody>
<?php
		//Mostramos las peliculas desde la BD
		require('conexion.php');
		$conexion = conectar("2daw");

		//PAGINADOR
		//Constante para el número de resultados a mostrar
		define('PELIS_POR_PAGINA',4);
		//Obtener el número total de registros en
		$resultado = $conexion->query("SELECT COUNT(*) as total FROM peliculas ".$like);
		$fila = $resultado->fetch_assoc();
		$total_peliculas = $fila['total'];
		//El número de páginas será la división entre el total de registros
		//y los que muestro en cada página
		$num_paginas = ceil($total_peliculas / PELIS_POR_PAGINA);
		//Leemos la página seleccionada
		if(isset($_GET['pag'])) {
			$pagina = $_GET['pag'];
		} else {
			$pagina = 0;
		}
		$inicio = $pagina * PELIS_POR_PAGINA;

		//La consulta
		$consulta = "SELECT * FROM peliculas ".$like." ORDER BY titulo LIMIT $inicio,".PELIS_POR_PAGINA;

		//Para mostrar correctamente la codificación
		$conexion->query("SET NAMES utf8");
		$resultado = $conexion->query($consulta);

		//Recorremos los resultados
		$num_resultados=0;
		while($pelicula = $resultado->fetch_array()) {
			$num_resultados++;
?>
		

                    <tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
                        <td><?php echo $pelicula['titulo']; ?></td>
                        <td><?php echo $pelicula['genero']; ?></td>
						<td><?php echo $pelicula['director']; ?></td>
						<td><?php echo $pelicula['fecha']; ?></td>
						<td><?php echo $pelicula['sinopsis']; ?></td>
                        <td><img class="cartel" src="<?php echo $pelicula['cartel']; ?>"></td>
                        <td>
                            <a href="#editFilmModal<?php echo $pelicula['id_pelicula']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>

							<a href="controlador.php?delete=<?php echo $pelicula['id_pelicula'];?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
					
							<a href="#verActoresModal<?php echo $pelicula['id_pelicula']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Actores">face</i></a>
							
							<a href="criticas.php?id_pelicula=<?php echo $pelicula['id_pelicula']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">grade</i></a>
							
                        </td>
                    </tr>
<?php
		}
?>
                </tbody>
			</table>

			<!-- PAGINADOR -->
			<div class="clearfix">
                <div class="hint-text">Mostrando <b><?php echo $inicio;?> a <?php echo ($num_resultados+$inicio);?></b> de <b><?php echo $total_peliculas;?></b> entradas</div>
                <ul class="pagination">

<?php					
		if ($pagina < 1) {
			echo "<li class='page-item disabled'><a href='#'>Anterior</a></li>";
		} else {
			echo "<li class='page-item'><a href='index.php?pag=".($pagina-1)."'>Anterior</a></li>";
		}

		for($i=0;$i<$num_paginas;$i++){			
			echo "<li class='page-item'><a href='index.php?pag=$i' class='page-link'>".($i+1)."</a></li>";
		}

		if ($pagina == ($num_paginas-1)) {
			echo "<li class='page-item disabled'><a href='#'>Siguiente</a></li>";
		} else {
			echo "<li class='page-item'><a href='index.php?pag=".($pagina+1)."'>Siguiente</a></li>";
		}		
?>					
                </ul>
			</div>
			
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addFilmModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method='POST' action='controlador.php'>
					<div class="modal-header">						
						<h4 class="modal-title">Añadir Película</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Título</label>
							<input type="text" name="titulo" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Género</label>
							<input type="text" name="genero" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Director</label>
							<input type="text" name="director" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Año</label>
							<input type="text" name="fecha" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Sinopsis</label>
							<textarea class="form-control" name="sinopsis" required></textarea>
						</div>
						<div class="form-group">
							<label>Cartel</label>
							<input type="text" name="cartel" class="form-control" required>
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name='add' class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
		//Mostramos las peliculas desde la BD
		$conexion = conectar("2daw");

		//La consulta
		$conexion->query("SET NAMES utf8");
		$resultado = $conexion->query($consulta);

		//Recorremos los resultados
		while($pelicula = $resultado->fetch_array()) {
?>

	<!-- Edit Modal HTML -->
	<div id="editFilmModal<?php echo $pelicula['id_pelicula']; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method='POST' action='controlador.php'>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Película</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula'];?>">
					<div class="modal-body">					
						<div class="form-group">
							<label>Título</label>
							<input type="text" name='titulo' class="form-control" value="<?php echo $pelicula['titulo'];?>" required>
						</div>
						<div class="form-group">
							<label>Género</label>
							<input type="text" name='genero' class="form-control" value="<?php echo $pelicula['genero'];?>" required>
						</div>
						<div class="form-group">
							<label>Director</label>
							<input type="text" name='director' class="form-control" value="<?php echo $pelicula['director'];?>"required>
						</div>
						<div class="form-group">
							<label>Año</label>
							<input type="text" name='fecha' class="form-control" value="<?php echo $pelicula['fecha'];?>"required>
						</div>
						<div class="form-group">
							<label>Sinopsis</label>
							<textarea name='sinopsis' class="form-control" required><?php echo $pelicula['sinopsis'];?></textarea>
						</div>
						<div class="form-group">
							<label>Cartel</label>
							<input type="text" name='cartel' class="form-control" value="<?php echo $pelicula['cartel'];?>"required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name='edit' class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Actores de la película -->
	<!-- Ver actores Modal HTML -->
	<div id="verActoresModal<?php echo $pelicula['id_pelicula']; ?>" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">	
					<div class="modal-header">						
						<h4 class="modal-title">Reparto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

<?php
			//Consulta para sacar todos los actores que intervienen en esta película
			$conexion2 = conectar("2daw");
			//$conexion->query("SET NAMES utf8");
			$consulta_actores = "SELECT * FROM actores INNER JOIN actorespeliculas ON actores.id_actor = actorespeliculas.id_actor WHERE actorespeliculas.id_pelicula = {$pelicula['id_pelicula']}";	
			$resultado_actores = $conexion2->query($consulta_actores);
			//Recorremos el resultado y pintamos los actores
	
			while ($actor = $resultado_actores->fetch_array()) {
				echo "<h5>{$actor['nombre']} {$actor['apellidos']}</h5>";
			}
			$conexion2->close();
?>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Aceptar">
					</div>
				</div>
			</div>
	</div>


<?php
		}

		$conexion->close();
?>



	<!-- Delete Modal HTML -->
	<div id="deleteFilmModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Borrar Película</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>¿Estás seguro que quieres borrar este registro?</p>
						<p class="text-warning"><small>Esta acción no pudo ser realizada.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>                                		                            