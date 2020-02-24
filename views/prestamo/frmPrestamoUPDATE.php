<?php
	session_start();
	$prestamoDATA = $_SESSION['prestamoDATA'];
	$balon_prestamoSELECT = $_SESSION['balon_prestamoSELECT'];
	$clienteSELECT = $_SESSION['clienteSELECT'];
	$balonSELECT_estadobal = $_SESSION['balonSELECT_estadobal'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">MODIFICAR PRESTAMO DE PRODUCTOS</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/prestamoController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
					<form class="form-horizontal">
						<div class="form-group">
							<label for="txtNombres_per">PERSONAL</label>
							<input class="form-control" type="text" id="txtNombres_per" value="<?= $prestamoDATA['DATA'][0]['nombres_per'] ?>" disabled>
						</div>
						<div class="form-group">
							<label for="sltId_cli">CLIENTE &nbsp;&nbsp;&nbsp;</label>
							<select id="sltId_cli" name="sltId_cli" class="form-control" disabled>
							<?php foreach ($clienteSELECT['DATA'] as $list) { ?>
								<?php if ($prestamoDATA['DATA'][0]['id_cli'] == $list['id_cli']) { ?>
								<option value="<?= $list['id_cli'] ?>" selected><?= $list['nombres_cli'] ?></option>
								<?php } else { ?>
								<option value="<?= $list['id_cli'] ?>"><?= $list['nombres_cli'] ?></option>
								<?php } ?>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="txaMotivo_pre">MOTIVO</label>
							<textarea id="txaMotivo_pre" class="form-control" disabled><?= $prestamoDATA['DATA'][0]['motivo_pre'] ?></textarea>
						</div>
						<div id="msjBalonprestamo"></div>
						<div class="form-group">
							<label for="divBalones">BALONES</label>
							<button type="button" class="btn btn-primary btn-sm" onclick="modalShow('mdlSeleccionarProducto')">AGREGAR BALONES</button>
							<div id="divBalones" class="table-responsive">
								<table id="tblBalones" class="table table-striped">
									<thead>
										<tr>
											<th class="text-center">LISTAR</th>
											<th class="text-center">ID</th>
											<th>NOMBRE</th>
											<th class="text-center">TIPO</th>
											<th class="text-center">MARCA</th>
											<th class="text-center">PESO</th>
											<th class="text-center">CANTIDAD</th>
											<th class="text-center">INICIO</th>
											<th class="text-center">FIN</th>
											<th class="text-center">ESTADO</th>
											<th class="text-center">PROVEEDOR</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($balon_prestamoSELECT['DATA'] as $list) { ?>
										<tr>
											<td>
												<button onclick="mdlMostrarPrestamoINSERT(<?= $list['id_balpre'] ?>,<?= $list['id_bal'] ?>,'<?= $list['nombre_bal'] ?>')" class="btn btn-outline-info btn btn-sm" type="button">
                                                    <span class="fas fa-eye"></span>
                                                </button>
											</td>
											<td><?= $list['id_bal'] ?></td>
											<td><?= $list['nombre_bal'] ?></td>
											<td><?= $list['tipo_bal'] ?></td>
											<td><?= $list['marca_bal'] ?></td>
											<td><?= $list['peso_bal'] ?></td>
											<td class="text-center"><?= $list['cantidad_balpre'] ?> de  <?= $list['total_balpre'] ?></td>
											<td><?= $list['fecini_balpre'] ?></td>
											<td><?= $list['fecfin_balpre'] ?></td>
										<?php if ($list['estado_balpre'] == '1') { ?>
											<td class="text-center text-success">EN USO</td>
										<?php } else { ?>
											<td class="text-center text-danger">SIN USAR</td>
										<?php } ?>
											<td><?= $list['razsoc_prov'] ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
<div id="mdlSeleccionarProducto" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">SELECCIONE UN PRODUCTO</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="sltId_bal">PRODUCTO &nbsp;&nbsp;&nbsp;</label>
								<select id="sltId_bal" class="form-control" onchange="addSpan(this.value);">
								<?php foreach ($balonSELECT_estadobal['DATA'] as $list) { ?>
									<option value="<?= $list['id_bal'] ?>"><?= $list['nombre_bal'] ?> -&nbsp;&nbsp;&nbsp; <?= $list['cantidad_bal'] ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="nbrCantidad_balpre">CANTIDAD MAX: 
								<?php if (isset($balonSELECT_estadobal['DATA'][0]['cantidad_bal'])) { ?>
									<span id="spnCantidad_pre"><?= $balonSELECT_estadobal['DATA'][0]['cantidad_bal'] ?></span>
								<?php } else { ?>
									<span id="spnCantidad_pre">0</span>
								<?php } ?>
								</label>
								<input id="nbrCantidad_balpre" type="number" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-primary" onclick="agregarBalon_Prestamo()">AGREGAR</button>
							</div>
						</div>
						<div id="msjModalBalonprestamo"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlMostrarPrestamoDetalle">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">DETALLE DE PRESTAMO - <span id="spnNombre_bal"></span></h4>
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
                            	<table id="tblBalonxu_prestamo" class="table table-striped">
                            		<thead>
                            			<tr>
                            				<td>Nro</td>
                            				<td>Cod barras</td>
                            				<td>Ingreso</td>
                            				<td>Salida</td>
                            				<td>Estado</td>
                            				<td>Quitar</td>
                            			</tr>
                            		</thead>
                            		<tbody></tbody>
                            	</table>
                            </div>
							<div class="form-group">
								<div class="row">
									<div class="col-2">
										<button class="btn btn-primary btn-block" type="button" onclick="balonxu_prestamoINSERT()">GUARDAR</button>
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
<script>
	function validarBalon_Prestamo() {
		if ($('#nbrCantidad_balpre').val() <= 0 || $('#nbrCantidad_balpre').val().trim() == '') {
			$('#msjModalBalonprestamo').html(`
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>ALERTA!</strong> La cantidad es necesario para agregar un producto
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			`);
			return false;
		}
		if (parseInt($('#spnCantidad_pre').text()) < parseInt($('#nbrCantidad_balpre').val())) {
			$('#msjModalBalonprestamo').html(`
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>ALERTA!</strong> No hay muchos producto disponibles
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			`);
			return false;
		}
		return true;
	}
	function agregarBalon_Prestamo() {
		if (validarBalon_Prestamo()) {
			var cabecera = {
				'id_bal' : $('#sltId_bal').val(),
				'cantidad_balpre' : $('#nbrCantidad_balpre').val(),
				'id_pre' : <?= $prestamoDATA['DATA'][0]['id_pre'] ?>
			};
			var data = JSON.stringify(cabecera);
			__ajax('../controllers/prestamoController.php?op=7','POST','JSON',{'data' : data})
			.done(function(info) {
				if (info.STATUS == 'OK') {
					$('#msjBalonprestamo').html(`
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>CORRECTO!</strong> Prestamo realizado con exito
						  <button type="button" class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxCompuesto('subcontent','../controllers/prestamoController.php',6,'id_pre=${<?= $prestamoDATA['DATA'][0]['id_pre'] ?>}')"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar</button>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					`);
					modalHide('mdlSeleccionarProducto');
				} else {
					$('#msjBalonprestamo').html(`
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>ALERTA!</strong> No se realizaron cambios
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					`);
				}
			});
		}
	}
	function addSpan(valor) {
		$('#spnCantidad_pre').text($("#sltId_bal option[value='"+valor+"'").text().substr(-5));
	}
</script>