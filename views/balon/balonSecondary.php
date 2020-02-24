<?php
	$tipo_bal = $_GET['tipo_bal'];
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$productoSELECT = $_SESSION['productoSELECT'];
	$clienteSELECT = $_SESSION['clienteSELECT'];
	$personalSELECT = $_SESSION['personalSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
	        <?php if ($tipo_bal=='GAS') { ?>
            	<h1 class="m-0 text-dark">BALONES</h1>
	        <?php } else { ?>
            	<h1 class="m-0 text-dark">AGUA</h1>
	        <?php } ?>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
	        	<?php if ($tipo_bal=='GAS') { ?>
              		<li class="breadcrumb-item active">Balones</li>
	        	<?php } else { ?>
              		<li class="breadcrumb-item active">Agua</li>
	        	<?php } ?>
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
	            		<?php if ($tipo_bal=='GAS') { ?>
	            			<h3 class="card-title">LISTA DE BALONES GAS</h3>
	            		<?php } else { ?>
	            			<h3 class="card-title">LISTA DE AGUA</h3>
	            		<?php } ?>
	            		</div>
	            		<div class="col-12 text-right">
	            			<button type="button" onclick="prestamoBalon();" class="btn btn-primary btn-sm">PRESTAR <?= $tipo_bal ?></button>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeBalon" class="col-12 mt-2"></div></div>
	              		<div id="subcontent2">
	              		    <div class="table-responsive">
		    				<table id="tblBalonSELECT" class="table table-bordered table-striped">
		    					<thead>
		    						<tr>
			                          	<th class="text-center">
					                        <div class="custom-control custom-checkbox">
					                            <input id="checkBalonALL" type="checkbox" onchange="checkBalonALL()" class="custom-control-input">
					                            <label for="checkBalonALL" class="custom-control-label"></label>
					                        </div>
					                    </th>
		    							<th class="text-center">ID</th>
		    							<th>NOMBRE</th>
		    							<th class="text-center">MARCA</th>
		    							<th class="text-center">PESO</th>
		    					<?php if (isset($productoSELECT['DATA'][0]['tipo_bal'])) { ?>
		    						<?php if ($productoSELECT['DATA'][0]['tipo_bal'] == 'GAS') { ?>
		    							<th class="text-center">COLOR</th>
		    						<?php } ?>
		    					<?php } ?>
		    							<th class="text-center">DISPONIBLES</th>
		    							<th class="text-center">ESTADO</th>
		    						<?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
		    							<th class="text-center">ACCIONES</th>
		    						<?php } ?>
		    						</tr>
		    					</thead>
		    					<tbody>
		                		<?php $i=0;foreach ($productoSELECT['DATA'] as $list) { ?>
		                			<tr id="trBalonSELECT<?= $i ?>">
		                				<td class="text-center">
					                        <div class="custom-control custom-checkbox">
					                        <?php if ($list['estado_bal'] == '1') { ?>
					                            <input id="checkBalon<?= $i ?>" type="checkbox" name="checkBalon" class="custom-control-input">
					                        <?php } else { ?>
					                            <input id="checkBalon<?= $i ?>" type="checkbox" name="checkBalon" class="custom-control-input" disabled>
					                        <?php } ?>
					                            <label for="checkBalon<?= $i ?>" class="custom-control-label"></label>
					                        </div>
										</td>
		                				<td class="text-center"><?= $list['id_bal'] ?></td>
		                				<td><?= $list['nombre_bal'] ?></td>
		                				<td class="text-center"><?= $list['nota_mar'] ?> <?= $list['categoria_bal'] ?></td>
		                				<td class="text-center"><?= $list['peso_bal'] ?></td>
						   
		                			<?php if ($list['tipo_bal'] == 'GAS') { ?>
		                				<td class="text-center"><?= $list['nota_col'] ?></td>
		                			<?php } ?>
		                				<td class="text-center"><?= $list['cantidad_bal'] . " de " . $list['total_bal'] ?></td>
		                			<?php if ($list['estado_bal'] == '1') { ?>
		                				<td class="text-center text-success estado">ACTIVO</td>
		                			<?php } ?>
		                			<?php if ($list['estado_bal'] == '2') { ?>
		                				<td class="text-center text-danger estado">INACTIVO</td>
		                			<?php } ?>
		                			<?php if ($list['estado_bal'] == '3') { ?>
		                				<td class="text-center text-warning estado">AGOTADO</td>
		                			<?php } ?>
		                			<?php
		                			$disabled = '';
			                			$fecha_actual = date("Y-m-d H:i:00",strtotime(date("Y-m-d H:i:00")."- 1 days"));
										$fecha_actual = strtotime($fecha_actual);
										$fecha_entrada = strtotime($list['feccre_bal']);
		                				if ($Stipo_per == '2' && $fecha_actual >= $fecha_entrada) {
		                					$disabled = 'disabled';
		                				}
		                			?>
		                			<?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
		                				<td class="text-center">
		                					<button onclick="balonDELETE(<?= $list['id_bal'] ?>,<?= $i ?>)" class="btn btn-outline-danger btn btn-sm" <?= $disabled ?>><span class="fas fa-trash-alt"></span></button>
		                				</td>
		                			<?php } ?>
		                				<input type="hidden" id="hdnId_bal<?= $i ?>" value="<?= $list['id_bal'] ?>">
		                				<input type="hidden" id="hdnNombre_bal<?= $i ?>" value="<?= $list['nombre_bal'] ?>">
		                				<input type="hidden" id="hdnCantidad_bal<?= $i ?>" value="<?= $list['cantidad_bal'] ?>">
		                			</tr>
		                		<?php $i++;} ?>
		                		</tbody>
		              		</table>
		              		</div>
	              		</div>
	              	</div>
	            </div>
	    	</div>
	    </div>
	</div>
</div>
<div class="modal fade" id="mdlExportarBalon">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
	        <?php if ($tipo_bal=='GAS') { ?>
				<h4 class="modal-title">PRESTAMO DE BALONES</h4>
	        <?php } else { ?>
				<h4 class="modal-title">PRESTAMO DE AGUA</h4>
	        <?php } ?>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form id="frmExportarBalon" class="form-horizontal">
							<div class="form-group">
								<label for="tipo_pre">TIPO DE PRÉSTAMO</label>
								<select id="tipo_pre" name="tipo_pre" class="form-control" onchange="cambiofecha(1)">
									<option value="1">Como data</option>
									<option value="2">En transito</option>
								</select>
							</div>
							<div class="form-group">
								<label for="sltId_cli">CLIENTE</label>
								<select id="sltId_cli" name="sltId_cli" class="form-control" required>
									<?php foreach ($clienteSELECT['DATA'] as $list1) { ?>
										<option value="<?= $list1['id_cli'] ?>"><?= $list1['nombres_cli'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div id="divFecha_pre" style="display: none;">
								<div class="form-group">
									<label for="fecha_pre">FECHA PRESTAMO</label>
									<input type="date" id="fecha_pre" name="fecha_pre" class="form-control">
								</div>
								<div class="form-group">
									<label for="fecha_pre">HORA PRESTAMO</label>
									<input type="time" id="hora_pre" name="hora_pre" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="id_per">RESPONSABLE</label>
								<select id="id_per" name="id_per" class="form-control" required>
								<?php foreach ($personalSELECT['DATA'] as $list) { ?>
									<option value="<?= $list['id_per'] ?>"><?= $list['nombre_per'] ?> <?= $list['apellido_per'] ?> - <?= $list['nota_temp'] ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="txaMotivo_pre">MOTIVO</label>
								<textarea id="txaMotivo_pre" name="txaMotivo_pre" class="form-control" placeholder="¿A qué se debe este prestamo?" required></textarea>
							</div>
							<div class="form-group">
	        				<?php if ($tipo_bal=='GAS') { ?>
								<label>BALONES</label>
							<?php } else { ?>
								<label>AGUA</label>
							<?php } ?>
								<input id="hdnId_bal" type="hidden">
								<div class="table-responsive">
									<table id="tblExportarBalon" class="table table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>PRODUCTO</th>
												<th>STOCK</th>
												<th>PRÉSTAMO</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div>
							<button type="submit" class="btn btn-info">PRESTAR</button>
							<div id="msjModalBalon"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script>
  $(function () {
    $("#tblBalonSELECT").DataTable();
																						  
							   
							   
																			
	   
	  
	  
	var frmExportarBalon = document.getElementById('frmExportarBalon');
    frmExportarBalon.addEventListener('submit', function(e) {
    	e.preventDefault();
    	const data = new FormData(frmExportarBalon);
    	data.append('cantidad_pre',$("#tblExportarBalon > tbody > tr").length);
    	fetch('../controllers/prestamoController.php?op=2', {
    		method: 'POST',
    		body: data
    	})
    	.then(res => res.json())
    	.then(data => {
    		if (data.STATUS == 'OK') {
    			$('#mensajeBalon >').remove();
    		<?php if ($tipo_bal == 'GAS') { ?>
				$('#mensajeBalon').append(`
					<div class="alert alert-success" role="alert" style="height: 57px;">
						<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">El préstamo se realizó correctamente!</font></font>
						<button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/balonController.php',9)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar</button>
					</div>
				`);
			<?php } else { ?>
				$('#mensajeBalon').append(`
					<div class="alert alert-success" role="alert" style="height: 57px;">
						<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">El préstamo se realizó correctamente!</font></font>
						<button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/balonController.php',10)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar</button>
					</div>
				`);
			<?php } ?>
				$('#mdlExportarBalon').modal('hide');
    		} else {
    			$('#msjModalBalon >').remove();
				$('#msjModalBalon').append(`
					<div class="alert alert-danger" role="alert">
						<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">No se realizó el préstamo</font></font>
					</div>
				`);
				setTimeout(function() {$('#msjModalBalon').html('')},3000);
    		}
    	})
    })
  });
</script>