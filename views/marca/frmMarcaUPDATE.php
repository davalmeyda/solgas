<?php
    session_start();
    $marcaDATA = $_SESSION['marcaDATA'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">EDITAR MARCA</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/marcaController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmMarcaUPDATE" action="#" method="post">
                        <input type="hidden" name="id_mar" value="<?= $marcaDATA['DATA'][0]['id_mar'] ?>">
              			<div class="form-group row">
                            <div class="col">
                                <label for="nota_mar">NOMBRE</label>
                                <input type="text" maxlength="20" class="form-control" id="nota_mar" name="nota_mar" placeholder="Digitar el nombre de la marca" value="<?= $marcaDATA['DATA'][0]['nota_mar'] ?>" required>
                            </div>
                        </div>
              			<div class="form-group row">
                            <div class="col">
                                <label for="tipo">TIPO</label>
                                <select class="form-control" id="tipo" name="tipo">
                                <option value="GAS">GAS</option>
                                <option value="AGUA">AGUA</option>
                                </select>
                            </div>
                        </div>
              			<button id="btnMarcaUPDATE" type="submit" class="btn btn-primary">GUARDAR</button>
                        <div class="row"><div id="mensajeMarcaUPDATE" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
  $("#tipo option[value='<?= $marcaDATA['DATA'][0]['tipo'] ?>']").attr("selected",true);
	var frmMarcaUPDATE = document.getElementById('frmMarcaUPDATE');
	frmMarcaUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
    $('#btnMarcaUPDATE').removeAttr('disabled');
    $('#btnMarcaUPDATE').attr('disabled',true);
    $('#btnMarcaUPDATE').text('Guardando...');
		var data = new FormData(frmMarcaUPDATE);
		fetch('../controllers/marcaController.php?op=4',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
        var mensajeMarcaUPDATE = document.getElementById('mensajeMarcaUPDATE');
        if (data.STATUS === 'OK') {
            mensajeMarcaUPDATE.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>CORRECTO!</strong> marca actualizada correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            `;
            $('#btnMarcaUPDATE').removeAttr('disabled');
            $('#btnMarcaUPDATE').text('GUARDAR');
        } else {
            mensajeMarcaUPDATE.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR!</strong> No se ha podido actualizar marca.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            `;
            frmMarcaUPDATE.reset();
            $('#btnMarcaUPDATE').text('GUARDAR');
        }
		})
	})
</script>