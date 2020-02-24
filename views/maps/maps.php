<?php
session_start();
$Stipo_per = $_SESSION['TIPO_PER'];
$Sid_per = $_SESSION['ID_PER']; ?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">MAPA</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item active">Mapa</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<?php
					if ($Stipo_per == '1' || $Stipo_per == '2') {
					?>
						<div class="card-header">
							<div class="col-12">
								<h3 class="card-title">Vista de mapa - Administrador</h3>
							</div>
							<!--<div class="col-12 text-right">
		<button onclick="ajaxPagina('subcontent','./personal/frmPersonalINSERT.php');" class="btn btn-primary btn-sm">AGREGAR PERSONAL</button>
	</div>-->
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col" id="msjMaps">

								</div>
							</div>
							<div class="container">
								<table class="table-elements">
									<tr>
										<td>
											<input type="text" placeholder="Latitud repartidor" id="my_lat" class="form-control" readonly>
										</td>
										<td>
											<input type="text" placeholder="Longitud repartidor" id="my_lng" class="form-control" readonly>
										</td>
									</tr>
								</table>
								<div class="map" id="map">

								</div>
								<table class="table-elements">
									<tr>
										<td colspan="2">

											<!-- <select id="id_cli" name="id_cli" class="form-control" onchange="rutaChange(this.value)" required>
				                    </select> -->
											<select class="form-control" id="id_cli" onchange="draw_rute()">
											</select>
										</td>
										<td>
											<button type="button" onclick="guardar_ubi();" id="btnUbicaionSAVE" class="btn btn-primary btn-block" disabled>Guardar ubicacion del cliente</button>
											<!--<button type="button" onclick="markerREMOVE('-12.218402053852957','-76.76011296328124');" class="btn btn-primary btn-block">Eliminar</button>-->
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" placeholder="Latitud cliente" id="lat_cli" class="form-control" readonly>
										</td>
										<td>
											<input type="text" placeholder="Longitud cliente" id="lng_cli" class="form-control" readonly>
										</td>
										<td>
											<button type="button" onclick="marcar_my_location();" id="btnUbicaionSELECT" class="btn btn-info btn-block" disabled>Elegir ubicacion - Cliente</button>
										</td>
									</tr>
								</table>
							</div>
							<div class="row">
								<div class="col">
									<div class="table-responsive">
										<table id="tblRutamaps" class="table table-striped">
											<thead>
												<tr>
													<th>Nro</th>
													<th>Repartidor</th>
													<th>Cliente</th>
													<th>Comprovante</th>
													<th>Hora</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="mdlAsignarRuta">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<h4 class="modal-title">Asignar ruta</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="mdlbodymdlAsignarRuta">
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<div class="modal fade" id="mdlVerPedido">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<h4 class="modal-title">Pedidos</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="mdlbodymdlVerPedido">
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<div class="modal fade" id="mdlMapa">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-primary">
										<h4 class="modal-title">Ruta especifica</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="mdlmap" style="height: 80vh">
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<script type="text/javascript">
							start_map();
							ver_repartidores();
							start_mdlmap();
							fetch('../controllers/clienteController.php?op=6', {
									method: 'POST'
								})
								.then(res => res.json())
								.then(data => {
									var id_cli = document.getElementById('id_cli');
									var listcliente = '<option value="0">------</option>';
									for (var i in data.DATA) {
										listcliente += `<option value="${data.DATA[i].id_cli}">${data.DATA[i].nombres_cli}</option>`;
									}
									id_cli.innerHTML = listcliente;
								})
							fetch('../controllers/mapsController.php?op=7', {
									method: 'POST'
								})
								.then(res => res.json())
								.then(data => {
									var tblRutamaps = document.querySelector('#tblRutamaps tbody');
									var listRutasmaps = '';
									for (var i in data.DATA) {
										listRutasmaps += `
				<tr>
					<td>${parseInt(i)+1}</td>
					<td>${data.DATA[i].nombres_per}</td>
					<td>${data.DATA[i].nombres_cli}</td>
					<td>${data.DATA[i].nombre_ven}</td>
					<td>${data.DATA[i].nfecha_rutmap}</td>
					<td><button class="btn btn-outline-info btn-sm" onclick="mdlMapaSHOW(${data.DATA[i].id_repmap},${data.DATA[i].lat_ori},${data.DATA[i].lng_ori},${data.DATA[i].lat_des},${data.DATA[i].lng_des})"><span class="fas fa-eye"></span></button></td>
				</tr>
			`;
									}
									// AGREGO LA PAGINACION Y EL ORDEN
									$(function() {
										$("#tblRutamaps").DataTable({
											"order": [
												[4, "desc"]
											]
										});
									});
									// BUSQUEDA CLIENTES
									$('#id_cli').select2({
										placeholder: 'Buscar Cliente',
										ajax: {
											url: "../controllers/buscarController.php?op=1",
											dataType: 'json',
											quietMillis: 100,
											data: function(params) {
												var query = {
													search: params.term,
													type: 'public'
												}
												// Query parameters will be ?search=[term]&type=public
												return query;
											},
											results: function(data, page) {
												return {
													results: data.results
												};
											}
										},
									});
									tblRutamaps.innerHTML = listRutasmaps;
								})
						</script>
					<?php } else { ?>
						<div class="card-header">
							<div class="col-12">
								<h3 class="card-title">Vista de mapa - Empleado</h3>
							</div>
							<!--<div class="col-12 text-right">
		<button onclick="ajaxPagina('subcontent','./personal/frmPersonalINSERT.php');" class="btn btn-primary btn-sm">AGREGAR PERSONAL</button>
	</div>-->
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col" id="msjMaps">

								</div>
							</div>
							<div class="container">
								<input type="hidden" id="lat_des">
								<input type="hidden" id="lng_des">
								<table class="table-elements">
									<tr>
										<td>
											<button class="btn btn-block btn-primary" onclick="centermap($('#lat_per').val(),$('#lng_per').val())">Mi ubicacion</button>
										</td>
										<td>
											<input type="text" placeholder="Latitud" id="lat_per" class="form-control" readonly>
										</td>
										<td>
											<input type="text" placeholder="Longitud" id="lng_per" class="form-control" readonly>
										</td>
									</tr>
								</table>
								<div class="map" id="map"></div>
								<table class="table-elements">
									<tr>
										<td>
											<div id="tblbotones">
												<?php if (isset($_GET['id_ven'])) { ?>
													<button id="btnRegistro" class="btn btn-dark btn-block" onclick="RegistrarBalones(<?= $_GET['id_ven'] ?>)">REGISTRAR BALONES</button>
												<?php } ?>
											</div>
											<button id="btnLlegada" class="btn btn-dark btn-block mt-2">YA HE LLEGADO</button>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="modal fade" id="mdlMostrarVentaDetalle">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">CIERRE DE RUTA<span id="spnNombre_bal"></span></h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-12">
												<div class="form-horizontal">
													<input type="hidden" id="id_balpre" name="id_balpre">
													<div class="table-responsive">
														<table id="tblBalonxu_venta" class="table table-striped">
															<thead>
																<tr>
																	<td>Nro</td>
																	<td>Descripcion</td>
																	<td>Cod barras</td>
																	<td>Fec Registro</td>
																</tr>
															</thead>
															<tbody></tbody>
														</table>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-2">
																<button class="btn btn-primary btn-block" type="button" onclick="balonxu_ventaINSERT()">GUARDAR</button>
															</div>
															<div class="col-10">
																<div id="msjmdlProducto">

																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							start_map();
							guardar_ubiRepartidor(<?= $Sid_per ?>, 0);
							<?php if (isset($_GET['estado_rutmap'])) { ?>
								mostrarRuta(<?= $Sid_per ?>, <?= $_GET['estado_rutmap'] ?>)
							<?php } ?>
						</script>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>