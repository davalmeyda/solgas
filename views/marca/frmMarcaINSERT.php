<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">AGREGAR MARCA</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/marcaController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmMarcaINSERT" action="#" method="post">
              			<div class="form-group row">
                            <div class="col">
                                <label for="nota_mar">NOMBRE</label>
                                <input type="text" maxlength="20" class="form-control" id="nota_mar" name="nota_mar" placeholder="Digitar el nombre de la marca" required>
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
              			<button id="btnMarcaINSERT" type="submit" class="btn btn-primary">GUARDAR</button>
                        <div class="row"><div id="mensajeMarcaINSERT" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
	var frmMarcaINSERT = document.getElementById('frmMarcaINSERT');
	frmMarcaINSERT.addEventListener('submit', function(e) {
		e.preventDefault();
    $('#btnMarcaINSERT').removeAttr('disabled');
    $('#btnMarcaINSERT').attr('disabled',true);
    $('#btnMarcaINSERT').text('Guardando...');
		var data = new FormData(frmMarcaINSERT);
		fetch('../controllers/marcaController.php?op=2',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
      var mensajeMarcaINSERT = document.getElementById('mensajeMarcaINSERT');
      if (data.STATUS === 'OK') {
        mensajeMarcaINSERT.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> marca ingresado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmMarcaINSERT.reset();
        $('#btnMarcaINSERT').removeAttr('disabled');
        $('#btnMarcaINSERT').text('GUARDAR');
      } else {
        mensajeMarcaINSERT.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido ingresar marca.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        $('#btnMarcaINSERT').text('GUARDAR');
      }
		})
	})
</script>