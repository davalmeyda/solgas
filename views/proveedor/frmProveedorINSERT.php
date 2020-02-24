<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">AGREGAR PROVEEDORES</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/proveedorController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmProveedorINSERT" action="#" method="post">
              			<div class="form-group">
              				<label for="nbrRuc_prov">RUC</label>
              				<input type="number" class="form-control" id="nbrRuc_prov" name="nbrRuc_prov" placeholder="Digitar ruc" minlength="11">
              			</div>
                    <div class="form-group">
                      <label for="txtRazsoc_prov">RAZÓN SOCIAL</label>
                      <input type="text" class="form-control" id="txtRazsoc_prov" name="txtRazsoc_prov" placeholder="Digitar razón social" required>
                    </div>
                    <div class="form-group">
                      <label for="txaDireccion_prov">Dirección</label>
                      <textarea class="form-control" id="txaDireccion_prov" name="txaDireccion_prov" rows="3" required></textarea>
                    </div>
              			<button type="submit" class="btn btn-primary">GUARDAR</button>
                    <div class="row"><div id="mensajeProveedorINSERT" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
	var frmProveedorINSERT = document.getElementById('frmProveedorINSERT');
	frmProveedorINSERT.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmProveedorINSERT);
		fetch('../controllers/proveedorController.php?op=2',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
      var mensajeProveedorINSERT = document.getElementById('mensajeProveedorINSERT');
      if (data.STATUS === 'OK') {
        mensajeProveedorINSERT.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Proveedor ingresado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmProveedorINSERT_CLEAN();
      } else {
        mensajeProveedorINSERT.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido ingresar proveedor.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
</script>