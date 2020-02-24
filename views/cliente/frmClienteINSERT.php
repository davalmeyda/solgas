<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">AGREGAR CLIENTES</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/clienteController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmClienteINSERT" action="#" method="post">
              			<div class="form-group row">
                      <div class="col">
                				<label for="sltTipdoc_cli">TIPO DOCUMENTO</label>
                				<select class="form-control" id="sltTipdoc_cli" name="sltTipdoc_cli">
                          <option value="1">DNI</option>
                          <option value="6">RUC</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="nbrNumdoc_cli">NÚMERO DOCUMENTO*</label>
                        <input type="text" maxlength="8" class="form-control" id="nbrNumdoc_cli" name="nbrNumdoc_cli" placeholder="Digitar el número de documentos" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtNombres_cli">NOMBRES O RAZON SOCIAL*</label>
                      <input type="text" maxlength="100" class="form-control" id="txtNombres_cli" name="txtNombres_cli" placeholder="Digitar nombres o razon social" required>
                    </div>
                    <div class="form-group">
                      <label for="telefono_cli">TELEFONO / CELULAR*</label>
                      <input type="number" max="999999999" class="form-control" id="telefono_cli" name="telefono_cli" placeholder="Digitar telefono" required>
                    </div>
                    <div class="form-group">
                      <label for="direccion_cli">DIRECCIÓN*</label>
                      <textarea maxlength="300" class="form-control" id="direccion_cli" name="direccion_cli" placeholder="Digitar dirección" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="referencia_cli">REFERENCIA*</label>
                      <input type="text" maxlength="50" class="form-control" id="referencia_cli" name="referencia_cli" placeholder="Digitar referencia de su ubicacion" required>
                    </div>
                    <div class="form-group">
                      <label for="correo_cli">CORREO*</label>
                      <input type="email" maxlength="50" class="form-control" id="correo_cli" name="correo_cli" placeholder="Digitar correo electrónico" required>
                    </div>
              			<button id="btnClienteINSERT" type="submit" class="btn btn-primary">GUARDAR</button>
                    <div class="row"><div id="mensajeClienteINSERT" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
  document.getElementById('sltTipdoc_cli').addEventListener('change', function() {
    if (this.value == 1) {
      $('#nbrNumdoc_cli').removeAttr('maxlength');
      $('#nbrNumdoc_cli').attr('maxlength','8');
    }
    if (this.value == 6) {
      $('#nbrNumdoc_cli').removeAttr('maxlength');
      $('#nbrNumdoc_cli').attr('maxlength','11');
    }
  })
	var frmClienteINSERT = document.getElementById('frmClienteINSERT');
	frmClienteINSERT.addEventListener('submit', function(e) {
		e.preventDefault();
    $('#btnClienteINSERT').removeAttr('disabled');
    $('#btnClienteINSERT').attr('disabled',true);
    $('#btnClienteINSERT').text('Guardando...');
		var data = new FormData(frmClienteINSERT);
		fetch('../controllers/clienteController.php?op=2',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
      var mensajeClienteINSERT = document.getElementById('mensajeClienteINSERT');
      if (data.STATUS === 'OK') {
        mensajeClienteINSERT.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Cliente ingresado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmClienteINSERT.reset();
        $('#btnClienteINSERT').removeAttr('disabled');
        $('#btnClienteINSERT').text('GUARDAR');
      } else {
        mensajeClienteINSERT.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido ingresar cliente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        $('#btnClienteINSERT').text('GUARDAR');
      }
		})
	})
</script>