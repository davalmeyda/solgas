<?php
	session_start();
	$horariosSELECT = $_SESSION['horariosSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">HORARIOS DE VEHICULOS</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Salidas</li>
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
	            			<h3 class="card-title">LISTA DE SALIDAS</h3>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeHorarios" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblSalidasSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th class="text-center">ID</th>
	    							<th class="text-center">VEHICULO</th>
	    							<th class="text-center">CHOFER</th>
	    							<th class="text-center">AYUDANTE</th>
	    							<th class="text-center">PROMOTOR</th>
	    							<th class="text-center">FECHA INICIO</th>
	    							<th class="text-center">MARCAR</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($horariosSELECT['DATA'] as $list) { ?>
	                			<tr>
	                				<td><?= $list['id_sal'] ?></td>
	                				<td class="text-center"><?= $list['descripcion_veh'] ?> - <?= $list['placa_veh'] ?></td>
	                				<td class="text-center"><?= $list['nombres_chofer'] ?></td>
	                				<td class="text-center"><?= $list['nombres_ayudante'] ?></td>
	                				<td class="text-center"><?= $list['nombres_promotor'] ?></td>
	                				<td class="text-center"><?= $list['fecini_sal'] ?></td>
	                				<td class="text-center">
	                					<button onclick="modalShow('mdlHorarios');$('#id_sal').val(<?= $list['id_sal'] ?>);$('#kilometraje_veh').val(<?= $list['kilometraje_veh'] ?>)" class="btn btn-outline-info btn btn-sm"><span class="fas fa-edit"></span></button>
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
<div class="modal fade" id="mdlHorarios">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">INICIAR SALIDAS</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form id="frmHorarios" class="form-horizontal">
							<input class="form-control" type="hidden" id="id_sal" name="id_sal">
							<input class="form-control" type="hidden" id="kilometraje_veh">
							<div class="form-group">
								<label for="kilini_sal">KILOMETRAJE INICIAL</label>
								<input class="form-control" type="number" step="0.01" id="kilini_sal" name="kilini_sal" required>
								<span class="note">Al marcar el kilometraje inicial, confirma la salida del vehículo</span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">GUARDAR</button>
							</div>
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
    $("#tblSalidasSELECT").DataTable();
    var frmHorarios = document.getElementById('frmHorarios');
    frmHorarios.addEventListener('submit', function(e) {
		e.preventDefault();
		if (parseFloat($('#kilini_sal').val()) >= parseFloat($('#kilometraje_veh').val())) {
		    const data = new FormData(frmHorarios);
		    fetch('../controllers/vehiculoController.php?op=9', {
		    	method: 'POST',
		    	body: data
		    })
			.then(res => res.json())
			.then(data => {
				if (data.STATUS == 'OK') {
					$('#mensajeHorarios').html(`
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>CORRECTO!</strong> Datos guardados.
						  <button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/vehiculoController.php',8)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar</button>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					`);
					modalHide('mdlHorarios');
					frmHorarios.reset();
				} else {
					$('#mensajeHorarios').html(`
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>OH NO!</strong> Se ha producido un error.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					`);
				}
			})
		} else {
			modalHide('mdlHorarios');
			$('#mensajeHorarios').html(`
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>OH NO!</strong> El kilometraje no puede ser menor al actual.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			`);
		}
	})
  });
</script>