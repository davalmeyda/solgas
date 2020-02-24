<?php
  session_start();
  $clienteDATA = $_SESSION['clienteDATA'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">MODIFICAR CLIENTES</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/clienteController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmClienteUPDATE" action="#" method="post">
                    <div class="form-group row">
                      <div class="col-2">
                        <label for="id_cli" class="mt-1">CÓDIGO</label>
                      </div>
                      <div class="col-10">
                        <input type="text" class="form-control" id="id_cli" name="id_cli" value="<?= $clienteDATA['DATA'][0]['id_cli'] ?>" readonly required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <label for="sltTipdoc_cli">TIPO DOCUMENTO</label>
                        <select class="form-control" id="sltTipdoc_cli" name="sltTipdoc_cli" onchange="documentoCHANGE()">
                          <option value="1">DNI</option>
                          <option value="6">RUC</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="nbrNumdoc_cli">NÚMERO DOCUMENTO*</label>
                        <input type="number" min="1000000" max="99999999" class="form-control" id="nbrNumdoc_cli" name="nbrNumdoc_cli" placeholder="Digitar el número de documentos" value="<?= $clienteDATA['DATA'][0]['numdoc_cli'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtNombres_cli">NOMBRES O RAZON SOCIAL*</label>
                      <input type="text" class="form-control" id="txtNombres_cli" name="txtNombres_cli" value="<?= $clienteDATA['DATA'][0]['nombres_cli'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="telefono_cli">TELEFONO / CELULAR*</label>
                      <input type="number" max="999999999" class="form-control" id="telefono_cli" name="telefono_cli" value="<?= $clienteDATA['DATA'][0]['telefono_cli'] ?>" placeholder="Digitar telefono" required>
                    </div>
                    <div class="form-group">
                      <label for="direccion_cli">DIRECCIÓN</label>
                      <textarea maxlength="300" class="form-control" id="direccion_cli" name="direccion_cli" placeholder="Digitar dirección" required><?= $clienteDATA['DATA'][0]['direccion_cli'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="referencia_cli">REFERENCIA*</label>
                      <input type="text" maxlength="50" class="form-control" id="referencia_cli" name="referencia_cli" value="<?= $clienteDATA['DATA'][0]['referencia_cli'] ?>" placeholder="Digitar referencia de su ubicacion" required>
                    </div>
                    <div class="form-group">
                      <label for="correo_cli">CORREO*</label>
                      <input type="email" maxlength="50" class="form-control" id="correo_cli" name="correo_cli" placeholder="Digitar correo electrónico" value="<?= $clienteDATA['DATA'][0]['correo_cli'] ?>" required>
                    </div>
              			<button type="submit" class="btn btn-primary">MODIFICAR</button>
                    <div class="row"><div id="mensajeClienteUPDATE" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
  $("#sltTipdoc_cli option[value='<?= $clienteDATA['DATA'][0]['tipdoc_cli'] ?>']").attr("selected",true);
	var frmClienteUPDATE = document.getElementById('frmClienteUPDATE');
	frmClienteUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmClienteUPDATE);
		fetch('../controllers/clienteController.php?op=4',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
			console.log(data.STATUS);
      var mensajeClienteUPDATE = document.getElementById('mensajeClienteUPDATE');
      if (data.STATUS === 'OK') {
        mensajeClienteUPDATE.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Cliente modificado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;

      } else {
        mensajeClienteUPDATE.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido modificar cliente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
  function documentoCHANGE() {
    if ($('#sltTipdoc_cli').val() == 1) {
      $('#nbrNumdoc_cli').removeAttr('min');
      $('#nbrNumdoc_cli').removeAttr('max');
      $('#nbrNumdoc_cli').attr('min','10000000');
      $('#nbrNumdoc_cli').attr('max','99999999');
    }
    if ($('#sltTipdoc_cli').val() == 6) {
      $('#nbrNumdoc_cli').removeAttr('min');
      $('#nbrNumdoc_cli').removeAttr('max');
      $('#nbrNumdoc_cli').attr('min','10000000000');
      $('#nbrNumdoc_cli').attr('max','99999999999');
    }
  }
</script>