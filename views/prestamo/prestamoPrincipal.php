<?php
date_default_timezone_set("America/Lima");
$op2 = $_GET['op2'];
session_start();
$Stipo_per = $_SESSION['TIPO_PER'];
$Stipo_user = $_SESSION['TIPO_USER'];
$prestamoSELECT = $_SESSION['prestamoSELECT'];
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">PRESTAMOS</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
					<li class="breadcrumb-item active">Prestamos</li>
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
					<div class="card-header">
						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-header">
											<div class="row">
												<div class="col-10">
													<h3 class="card-title">LISTA DE PRESTAMOS</h3>
												</div>
												<!-- Icono Exportar-->
												<div class="col-2">
													<button type="button" onclick="mdExportarOPEN()" class="btn btn-primary" data-toggle="modal">
														Exportar
													</button>
												</div>
											</div>
											<!--<div class="col-12 text-right">
	            								<button onclick="ajaxPagina('subcontent','./personal/frmPersonalINSERT.php');" class="btn btn-primary btn-sm">AGREGAR PERSONAL</button>
	            							</div>-->
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Filtrar</label>
												<div class="col-sm-10">
													<select id="sltfiltro" class="form-control" onchange="ajaxCompuesto('content','../controllers/prestamoController.php',1,'op2='+this.value)">
														<option value="0">Todos</option>
														<option value="1">Finalizados</option>
														<option value="2">Activos</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div id="mensajePrestamo" class="col-12 mt-2"></div>
											</div>
											<div class="table-responsive">
												<table id="tblPrestamoSELECT" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th class="text-center">ID</th>
															<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
																<th>TRABAJADOR</th>
															<?php } ?>
															<th>CLIENTE</th>
															<th class="text-center">CANTIDAD</th>
															<th class="text-center">FECHA INICIO</th>
															<th class="text-center">FECHA FINAL</th>
															<th class="text-center">ACCIONES</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 0;
														foreach ($prestamoSELECT['DATA'] as $list) { ?>
															<tr id="trPersonalSELECT<?= $i ?>">
																<td class="text-center"><?= $list['id_pre'] ?></td>
																<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
																	<td><?= $list['nombres_per'] ?></td>
																<?php } ?>
																<td><?= $list['nombres_cli'] ?></td>
																<td class="text-center"><?= $list['cantidad_pre'] ?> de <?= $list['total_pre'] ?></td>
																<td class="text-center"><?= $list['fecha_pre'] ?></td>
																<?php if ($list['fecreg_pre'] == NULL) { ?>
																	<td class="text-center text-primary"><span style="display: none;"><?= date('Y-m-d H:i:s') ?></span>AÚN NO FINALIZA</td>
																<?php } else { ?>
																	<td class="text-center"><?= $list['fecreg_pre'] ?></td>
																<?php } ?>
																<td class="text-center">
																	<!--<button onclick="mdlMostrarPrestamo(<?= $list['id_pre'] ?>)" class="btn btn-outline-info btn btn-sm"><span class="fas fa-eye"></span></button>-->
																	<?php if ($Stipo_per == '1' || $Stipo_per == '2' || $Stipo_per == '3' || $Stipo_per == '5') {
																	?>
																		<button onclick="ajaxCompuesto('subcontent','../controllers/prestamoController.php',3,'id_pre=<?= $list['id_pre'] ?>')" class="btn btn-outline-info btn btn-sm"><span class="fas fa-eye"></span></button>
																	<?php } ?>
																	<?php if ($Stipo_per == '1') { ?>
																		<button onclick="ajaxCompuesto('subcontent','../controllers/prestamoController.php',6,'id_pre=<?= $list['id_pre'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
																	<?php } ?>
																	<?php
																	$fecha_actual = date("Y-m-d H:i:00", strtotime(date("Y-m-d H:i:00") . "- 1 days"));
																	$fecha_actual = strtotime($fecha_actual);
																	$fecha_entrada = strtotime($list['fecha_pre']);
																	if ($Stipo_per == '2' && $fecha_actual <= $fecha_entrada) {
																	?>
																		<button onclick="ajaxCompuesto('subcontent','../controllers/prestamoController.php',6,'id_pre=<?= $list['id_pre'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
																	<?php } ?>
																</td>
															</tr>
														<?php $i++;
														} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- AGREGANDO MODAL DE EXPORTACION -->
					<div class="modal fade" id="modalExportar">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<h4 class="modal-title">Panel de exportación</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col">
											<form id="frmExportar" action='../controllers/prestamoController.php?op=10' method="POST" class="form-horizontal">
												<div class="form-group">
													<label>Rango de Fecha:</label>
													<div class="input-group">
														<div class="input-group-addon" style="padding: 6px 12px; font-size: 14px; font-weight: 400; line-height: 1; color: #555; text-align: center; border-radius: 0; border-color: #d2d6de;background-color: #fff; vertical-align: middle;    border: 1px solid #ccc;">
															<i class="fa fa-calendar" style="vertical-align: middle;"></i>
														</div>
														<input type="text" class="form-control pull-right" id='fechaPicker' name="fechaPicker">
													</div>
												</div>
												<div class="form-group row">
													<button type="submit" id="btnExportar" class="btn btn-block btn-primary">Exportar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- TERMINANDO MODAL EXPORTACION -->

					<div class="modal fade" id="mdlMostrarPrestamo">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">DETALLE DE PRESTAMO</h4>&nbsp;&nbsp;&nbsp;&nbsp;
									<h6 class="pt-2"><span id="fecha_pre"></span> al <span id="fecreg_pre"></span></h6>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-12">
											<div class="form-horizontal">
												<div class="form-group">
													<label for="txtNombres_cli">CLIENTE &nbsp;&nbsp;&nbsp;</label>
													<input class="form-control" type="text" id="txtNombres_cli" value="" disabled>
												</div>
												<div class="form-group">
													<label for="txtNombres_per">PERSONAL</label>
													<input class="form-control" type="text" id="txtNombres_per" value="" disabled>
												</div>
												<div class="form-group">
													<label for="txaMotivo_pre">MOTIVO</label>
													<textarea id="txaMotivo_pre" class="form-control" disabled></textarea>
												</div>
												<div class="form-group">
													<label for="divBalones">BALONES</label>
													<div id="divBalones" class="table-responsive" style="max-height: 250px;">
														<table id="tblBalones" class="table table-striped">
															<thead>
																<tr>
																	<th class="text-center">ACCIÓN</th>
																	<th class="text-center">ID</th>
																	<th>NOMBRE</th>
																	<th class="text-center">TIPO</th>
																	<th class="text-center">MARCA</th>
																	<th class="text-center">CANTIDAD</th>
																	<th class="text-center">INICIO</th>
																	<th class="text-center">FIN</th>
																	<th class="text-center">ESTADO</th>
																	<th class="text-center">PROVEEDOR</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
												</div>
												<div id="msjModalBalonprestamo"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer justify-content-between text-center">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<script>
						$(function() {
							$("#sltfiltro option[value='<?= $op2 ?>']").attr("selected", true);
							<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
								$("#tblPrestamoSELECT").DataTable({
									"order": [
										[4, "desc"]
									]
								});
							<?php } else { ?>
								$("#tblPrestamoSELECT").DataTable({
									"order": [
										[3, "desc"]
									]
								});
							<?php } ?>
						});
						// abrimos el modal a exportar
						function mdExportarOPEN() {
							modalShow('modalExportar');
						}
						// daterangepicker
						$('#fechaPicker').daterangepicker()
					</script>