<?php
	session_start();
	$salidasSELECT = $_SESSION['salidasSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">SALIDAS DE VEHICULOS</h1>
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
	              		<div class="row"><div id="mensajeSalidas" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblSalidasSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th class="text-center">ID</th>
	    							<th class="text-center">VEHICULO</th>
	    							<th class="text-center">CHOFER</th>
	    							<th class="text-center">AYUDANTE</th>
	    							<th class="text-center">PROMOTOR</th>
	    							<th class="text-center">KLM INICIO</th>
	    							<th class="text-center">KLM FINAL</th>
	    							<th class="text-center">FECHA INICIO</th>
	    							<th class="text-center">FECHA FINAL</th>
	    							<th class="text-center">EDITAR</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($salidasSELECT['DATA'] as $list) { ?>
	                			<tr>
	                				<td><?= $list['id_sal'] ?></td>
	                				<td class="text-center"><?= $list['descripcion_veh'] ?> - <?= $list['placa_veh'] ?></td>
	                				<td class="text-center"><?= $list['chofer_sal'] ?></td>
	                				<td class="text-center"><?= $list['ayudante_sal'] ?></td>
	                				<td class="text-center"><?= $list['promotor_sal'] ?></td>
	                				<td class="text-center"><?= $list['kilini_sal'] ?></td>
	                				<td class="text-center"><?= $list['kilfin_sal'] ?></td>
	                				<td class="text-center"><?= $list['fecini_sal'] ?></td>
	                				<td class="text-center"><?= $list['fecfin_sal'] ?></td>
	                				<td class="text-center">
	                				<?php if ($list['kilfin_sal'] == null) { ?>
	                					<button onclick="modalShow('mdlSalidas');$('#id_sal').val(<?= $list['id_sal'] ?>);$('#kilini_sal').val(<?= $list['kilini_sal'] ?>)" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
	                				<?php } ?>
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
<div class="modal fade" id="mdlSalidas">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">FINALIZAR SALIDAS</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form id="frmSalida" class="form-horizontal">
							<input class="form-control" type="hidden" id="id_sal" name="id_sal">
							<input class="form-control" type="hidden" id="kilini_sal">
							<div class="form-group">
								<label for="kilfin_sal">KILOMETRAJE FINAL</label>
								<input class="form-control" type="number" step="0.01" id="kilfin_sal" name="kilfin_sal" required>
							</div>
							<div class="form-group">
								<label for="fecfin_sal">FECHA TERMINO</label>
								<input class="form-control" type="date" id="fecfin_sal" name="fecfin_sal" required>
							</div>
							<div class="form-group">
								<label for="horfin_sal">HORA TERMINO</label>
								<input class="form-control" type="time" id="horfin_sal" name="horfin_sal" required>
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
    var frmSalida = document.getElementById('frmSalida');
    frmSalida.addEventListener('submit', function(e) {
		e.preventDefault();
		if (parseFloat($('#kilfin_sal').val()) > parseFloat($('#kilini_sal').val())) {
		    const data = new FormData(frmSalida);
		    fetch('../controllers/vehiculoController.php?op=7', {
		    	method: 'POST',
		    	body: data
		    })
			.then(res => res.json())
			.then(data => {
				if (data.STATUS == 'OK') {
					$('#mensajeSalidas').html(`
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>CORRECTO!</strong> Datos guardados.
						  <button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/vehiculoController.php',2)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar</button>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					`);
					modalHide('mdlSalidas');
					frmSalida.reset();
				} else {
					modalHide('mdlSalidas');
					$('#mensajeSalidas').html(`
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>OH NO!</strong> ${data.STATUS}
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					`);
				}
			})
		} else {
			modalHide('mdlSalidas');
			$('#mensajeSalidas').html(`
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>OH NO!</strong> El kilometraje no puede ser menor al kilometraje de inicio.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			`);
		}
	})
  });
</script>