<!DOCTYPE html>
<html lang="es" style="height: auto;">
<head>
	<title>Cliente</title>
	<link rel="stylesheet" href="../css/principal.css">

  	<!-- Font Awesome Icons -->
  	<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
  	<link rel="stylesheet" type="text/css" href="../css/base.css">
</head>
<body  style="height: auto;">
	<div class="wrapper">
<?php
	if(isset($_GET['id_rutmap'])) {
		$id_rutmap = $_GET['id_rutmap'];
?>
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col">
						<h1 class="m-0 text-dark">RUTA PARA EL CLIENTE</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
								<h3 id="h3Nombres_cli" class="card-title"><strong>Cliente: </strong></h3><br>
								<h3 id="h3NProductos" class="card-title"><strong>Nro Productos: </strong></h3>
							</div>
							<div class="card-body">
								<div class="container">
									<div class="map" id="map_cli" style="height: 80vh"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
} else { ?>
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Página de error 404</h1>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="error-page">
				<h2 class="headline text-warning"> 404</h2>

				<div class="error-content">
					<h3><i class="fas fa-exclamation-triangle text-warning"></i> ¡Uy! Página no encontrada.</h3>

					<p>
						No pudimos encontrar la página que estabas buscando. Mientras tanto, puede <a href="../index.html">regresar al tablero</a> o intentar usar el formulario de búsqueda.
					</p>

					<form class="search-form">
						<div class="input-group">
							<input type="text" name="search" class="form-control" placeholder="Search">

							<div class="input-group-append">
								<button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
<?php } ?>
	</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDpVrLAddgFJRKLa4PMB98J7q0TiN6LmKM"></script>
<script type="text/javascript" src="../javascript/principal.js"></script>
<script type="text/javascript" src="../javascript/mapsCliente.js"></script>
<script>
	start_map_cli();
	fetch('../controllers/mapsController.php?op=11&id_rutmap=<?= $id_rutmap ?>',{
		method: 'POST'
	})
	.then(res => res.json())
	.then(data => {
		if (data.DATA.length == 0) {
			location.href="./mapsClients.php";
		} else {
			$('#h3Nombres_cli').append(data.DATA[0].nombres_cli)
			$('#h3NProductos').append(parseInt(data.DATA[0].cantidad_ven)+' und')
			VerrepartidorMaps(data.DATA[0].id_repmap)
			draw_rute_rutmap(data.DATA[0].lat_ori,data.DATA[0].lng_ori,data.DATA[0].lat_des,data.DATA[0].lng_des)
		}
	})
</script>
</body>
</html>