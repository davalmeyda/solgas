<?php
  session_start();
  $proveedorDATA = $_SESSION['proveedorDATA'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">MODIFICAR PROVEEDORES</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/proveedorController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmProveedorUPDATE" action="#" method="post">
                    <input type="hidden" name="id_prov" value="<?= $proveedorDATA['DATA'][0]['id_prov'] ?>">
              			<div class="form-group">
              				<label for="nbrRuc_prov">RUC</label>
              				<input type="number" class="form-control" id="nbrRuc_prov" name="nbrRuc_prov" value="<?= $proveedorDATA['DATA'][0]['ruc_prov'] ?>">
              			</div>
                    <div class="form-group">
                      <label for="txtRazsoc_prov">RAZÓN SOCIAL</label>
                      <input type="text" class="form-control" id="txtRazsoc_prov" name="txtRazsoc_prov"  value="<?= $proveedorDATA['DATA'][0]['razsoc_prov'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="txaDireccion_prov">Dirección</label>
                      <textarea class="form-control" id="txaDireccion_prov" name="txaDireccion_prov" rows="3" required><?= $proveedorDATA['DATA'][0]['direccion_prov'] ?></textarea>
                    </div>
              			<button type="submit" class="btn btn-primary">MODIFICAR</button>
                    <div class="row"><div id="mensajeProveedorUPDATE" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
	var frmProveedorUPDATE = document.getElementById('frmProveedorUPDATE');
	frmProveedorUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmProveedorUPDATE);
		fetch('../controllers/proveedorController.php?op=4',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
			console.log(data.STATUS);
      var mensajeProveedorUPDATE = document.getElementById('mensajeProveedorUPDATE');
      if (data.STATUS === 'OK') {
        mensajeProveedorUPDATE.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Proveedor modificado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;

      } else {
        mensajeProveedorUPDATE.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido modificar proveedor.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
</script>