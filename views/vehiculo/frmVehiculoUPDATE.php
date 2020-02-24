<?php
  session_start();
  $vehiculoDATA = $_SESSION['vehiculoDATA'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">MODIFICAR VEHICULO</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/vehiculoController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmVehiculoUPDATE" action="#" method="post">
                    <input type="hidden" name="id_veh" value="<?= $vehiculoDATA['DATA'][0]['id_veh'] ?>">
                    <div class="form-group">
                      <label for="sltTipo_veh">TIPO</label>
                      <select class="form-control" id="sltTipo_veh" name="sltTipo_veh">
                        <option value="CAMION">CAMION</option>    
                        <option value="MOTO">MOTO</option>    
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="txtDescripcion_veh">DESCRIPCION</label>
                      <input type="text" class="form-control" id="txtDescripcion_veh" name="txtDescripcion_veh"  value="<?= $vehiculoDATA['DATA'][0]['descripcion_veh'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="txtPlaca_veh">PLACA</label>
                      <input type="text" class="form-control" id="txtPlaca_veh" name="txtPlaca_veh"  value="<?= $vehiculoDATA['DATA'][0]['placa_veh'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="nbrKilometraje_veh">KILOMETRAJE</label>
                      <input type="number" step="0.01" class="form-control" id="nbrKilometraje_veh" name="nbrKilometraje_veh"  value="<?= $vehiculoDATA['DATA'][0]['kilometraje_veh'] ?>" required>
                    </div>
              			<button type="submit" class="btn btn-primary">MODIFICAR</button>
                    <div class="row"><div id="mensajeVehiculoUPDATE" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
  $("#sltTipo_veh option[value='<?= $vehiculoDATA['DATA'][0]['tipo_veh'] ?>']").attr("selected",true);
	var frmVehiculoUPDATE = document.getElementById('frmVehiculoUPDATE');
	frmVehiculoUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmVehiculoUPDATE);
		fetch('../controllers/vehiculoController.php?op=5',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
			console.log(data.STATUS);
      var mensajeVehiculoUPDATE = document.getElementById('mensajeVehiculoUPDATE');
      if (data.STATUS === 'OK') {
        mensajeVehiculoUPDATE.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Vehiculo modificado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;

      } else {
        mensajeVehiculoUPDATE.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido modificar vehiculo.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
</script>