<?php
	date_default_timezone_set("America/Lima");
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$vehiculoSELECT = $_SESSION['vehiculoSELECT'];
	$choferSELECT = $_SESSION['choferSELECT'];
	$promotorSELECT = $_SESSION['promotorSELECT'];
	$empleadoSELECT = $_SESSION['empleadoSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">VEHICULOS</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Vehiculos</li>
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
	            			<h3 class="card-title">LISTA DE VEHICULOS</h3>
	            		</div>
	            		<div class="col-12 text-right">
	            		<?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
	            			<button onclick="ajaxPagina('subcontent','./vehiculo/frmVehiculoINSERT.php');" class="btn btn-primary btn-sm">AGREGAR VEHICULO</button>
	            		<?php } ?>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeVehiculo" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblvehiculoSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th class="text-center">ID</th>
	    							<th class="text-center">TIPO</th>
	    							<th>DESCRIPCION</th>
	    							<th class="text-center">PLACA</th>
	    							<th class="text-center">KILOMETRAJE</th>
	    							<th class="text-center">ACCIONES</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($vehiculoSELECT['DATA'] as $list) { ?>
	                			<tr id="trvehiculoSELECT<?= $i ?>">
	                				<td><?= $list['id_veh'] ?></td>
	                				<td class="text-center" style="text-transform: uppercase;"><?= $list['tipo_veh'] ?></td>
	                				<td><?= $list['descripcion_veh'] ?></td>
	                				<td><?= $list['placa_veh'] ?></td>
	                				<td><?= $list['kilometraje_veh'] ?></td>
	                				<td class="text-center">
	                					<button onclick="ajaxCompuesto('subcontent','../controllers/vehiculoController.php',4,'id_veh=<?= $list['id_veh'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
	                					<button onclick="modalShow('mdlRecorrido');$('#id_veh').val('<?= $list['id_veh'] ?>');$('#placa_veh').val('<?= $list['placa_veh'] ?>')" class="btn btn-outline-secondary btn btn-sm"><span class="fas fa-paper-plane"></span></button>
	                				</td>
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
<div class="modal fade" id="mdlRecorrido">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">PROGRAMAR RECORRIDO</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form id="frmRecorrido" class="form-horizontal">
							<div class="form-group">
								<label for="placa_veh">PLACA DE VEHICULO</label>
								<input class="form-control" type="text" id="placa_veh" readonly>
								<input class="form-control" type="hidden" id="id_veh" name="id_veh">
							</div>
							<div class="form-group">
								<label for="chofer_sal">CHOFER &nbsp;&nbsp;&nbsp;</label>
								<select id="chofer_sal" name="chofer_sal" class="form-control" required>
								<?php foreach ($choferSELECT['DATA'] as $list) { ?>
									<option value="<?= $list['id_per'] ?>"><?= $list['nombre_per'] ?> <?= $list['apellido_per'] ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="ayudante_sal">AYUDANTE</label>
								<select id="ayudante_sal" name="ayudante_sal" class="form-control" required>
								<?php foreach ($empleadoSELECT['DATA'] as $list) { ?>
									<option value="<?= $list['id_per'] ?>"><?= $list['nombre_per'] ?> <?= $list['apellido_per'] ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="promotor_sal">PROMOTOR</label>
								<select id="promotor_sal" name="promotor_sal" class="form-control" required>
								<?php foreach ($promotorSELECT['DATA'] as $list) { ?>
									<option value="<?= $list['id_per'] ?>"><?= $list['nombre_per'] ?> <?= $list['apellido_per'] ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="fecini_sal">FECHA SALIDA</label>
								<input class="form-control" type="datetime-local" min="<?= date('Y-m-d') ?>T<?= date('H:i') ?>" value="<?= date('Y-m-d') ?>T<?= date('H:i') ?>" id="fecini_sal" name="fecini_sal" required>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">GUARDAR</button>
							</div>
							<div id="msjModalRecorrido"></div>
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
    $("#tblvehiculoSELECT").DataTable();
    var frmRecorrido = document.getElementById('frmRecorrido');
    frmRecorrido.addEventListener('submit', function(e) {
		e.preventDefault();
	    const data = new FormData(frmRecorrido);
	    fetch('../controllers/vehiculoController.php?op=6', {
	    	method: 'POST',
	    	body: data
	    })
		.then(res => res.json())
		.then(data => {
			if (data.STATUS == 'OK') {
				$('#mensajeVehiculo').html(`
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>CORRECTO!</strong> Se apartó un recorrido.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				`);
				modalHide('mdlRecorrido');
				frmRecorrido.reset();
			} else {
				$('#mensajeVehiculo').html(`
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong>OH NO!</strong> Se ha producido un error.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				`);
			}
		})
	})
  });
</script>