<?php
	session_start();
	//$proveedorSELECT = $_SESSION['proveedorSELECT'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">AGREGAR VEHICULO</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/vehiculoController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmVehiculoINSERT" action="#" method="post">
              			<div class="form-group">
              				<label for="sltTipo_veh">Tipo</label>
              				<select class="form-control" id="sltTipo_veh" name="sltTipo_veh">
              					<option value="CAMION">CAMION</option>
              					<option value="MOTO">MOTO</option>
              				</select>
              			</div>
              			<div class="form-group">
              				<label for="txtDescripcion_veh">Descripción*</label>
              				<input type="text" class="form-control" id="txtDescripcion_veh" name="txtDescripcion_veh" placeholder="Digitar nombre" required>
              			</div>
                    <div class="form-group row">
                      <div class="col">
                        <label for="txtPlaca_veh">Placa*</label>
                        <input type="text" class="form-control" id="txtPlaca_veh" name="txtPlaca_veh" placeholder="Digitar nombre" required>
                      </div>
                      <div class="col">
                        <label for="nbrKilometraje_veh">Kilometraje*</label>
                        <input type="number" min="0" step="0.01" class="form-control" id="nbrKilometraje_veh" name="nbrKilometraje_veh" placeholder="Digitar nombre" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col text-center">
                        <label>POLIZA</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm">
                        <div class="form-group">
                          <label for="polemi_veh">Emision*</label>
                          <input type="date" max="<?= date('Y-m-d') ?>" class="form-control" id="polemi_veh" name="polemi_veh" placeholder="Digitar nombre" required>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group">
                          <label for="polven_veh">Vencimiento*</label>
                          <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" id="polven_veh" name="polven_veh" placeholder="Digitar nombre" required>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="form-group">
                          <label for="moncob_pol">Monto cobertura*</label>
                          <input type="number" step="0.01" class="form-control" id="moncob_pol" name="moncob_pol" placeholder="Digitar monto de la cobertura" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col text-center">
                        <label>SOAT</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <div class="form-group">
                          <label for="soatemi_veh">Emision*</label>
                          <input type="date" max="<?= date('Y-m-d') ?>" class="form-control" id="soatemi_veh" name="soatemi_veh" placeholder="Digitar nombre" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="soatven_veh">Vencimiento*</label>
                          <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" id="soatven_veh" name="soatven_veh" placeholder="Digitar nombre" required>
                        </div>
                      </div>
                    </div>
              			<button id="btnVehiculoINSERT" type="submit" class="btn btn-primary">GUARDAR</button>
                    <div class="row"><div id="mensajeBalonINSERT" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
	var frmVehiculoINSERT = document.getElementById('frmVehiculoINSERT');
	frmVehiculoINSERT.addEventListener('submit', function(e) {
		e.preventDefault();
    $('#btnVehiculoINSERT').removeAttr('disabled');
    $('#btnVehiculoINSERT').attr('disabled',true);
    $('#btnVehiculoINSERT').text('Guardando...');
		var data = new FormData(frmVehiculoINSERT);
		fetch('../controllers/vehiculoController.php?op=3',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
      var mensajeBalonINSERT = document.getElementById('mensajeBalonINSERT');
      if (data.STATUS === 'OK') {
        mensajeBalonINSERT.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Proveedor ingresado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmVehiculoINSERT.reset();
        $('#btnVehiculoINSERT').removeAttr('disabled');
        $('#btnVehiculoINSERT').text('GUARDAR');
      } else {
        mensajeBalonINSERT.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido ingresar proveedor.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        $('#btnVehiculoINSERT').text('GUARDAR');
      }
		})
	})
</script>