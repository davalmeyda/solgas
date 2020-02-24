<?php
  date_default_timezone_set("America/Lima");
	session_start();
  $proveedorSELECT = $_SESSION['proveedorSELECT'];
  $marcaSELECT = $_SESSION['marcaSELECT'];
  $coloresSELECT = $_SESSION['coloresSELECT'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">AGREGAR BALONES GAS/AGUA</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/balonController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmBalonINSERT" action="#" method="post">
                    <input type="hidden" id="precodbar" name="precodbar">
              			<div class="form-group">
              				<label for="sltTipo_bal">Tipo</label>
              				<select onchange="tipo_balCHANGE(this.value)" class="form-control" id="sltTipo_bal" name="sltTipo_bal" required>
                                <option value="">-----</option>
              					<option value="GAS">GAS</option>
              					<option value="AGUA">AGUA</option>
              				</select>
              			</div>
                    <div class="form-group">
                      <label for="sltId_bal">Producto</label>
                      <select class="form-control" id="sltId_bal" name="sltId_bal" onchange="productoCHANGE(this.value,$('#sltTipo_bal').val());">
                        <option value="0">PRODUCTO NUEVO</option>
                      </select>
                    </div>
                    <div class="form-group" id="divCategoria_bal" style="display: none;">
                      <label for="categoria_bal">NORMAL/PREMIUN</label>
                      <div class="row">
                        <label class="switch">
                          <input id="categoria_bal" name="categoria_bal" type="checkbox" class="primary">
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
              			<div class="form-group">
              				<label for="txtNombre_bal">Nombre</label>
              				<input type="text" class="form-control" id="txtNombre_bal" name="txtNombre_bal" placeholder="Digitar nombre">
              			</div>
              			<div class="form-group">
              				<label for="sltMarca_bal">Marca</label>
              				<select class="form-control" id="sltMarca_bal" name="sltMarca_bal" onchange="obtenerbarcode($('#txtColor_bal').val(),$('#codigo_fac').val(),this.value,<?= strtotime(date('Y-m-d H:i:s')) ?>)" required>
                        <option value="">-----</option>
                      <?php foreach ($marcaSELECT['DATA'] as $list) { ?>
              					<option value="<?= $list['id_mar'] ?>"><?= $list['nota_mar'] ?></option>
                      <?php } ?>
              				</select>
              			</div>
              			<div class="form-group">
              				<label for="nbrPeso_bal">Peso</label>
              				<input type="number" min="0" max="999" class="form-control" id="nbrPeso_bal" name="nbrPeso_bal" placeholder="Digitar peso">
              			</div>
              			<div id="divColor_bal" name="divColor_bal" class="form-group">
              				<label for="txtColor_bal">Color</label>
                      <select class="form-control" id="txtColor_bal" name="txtColor_bal" onchange="obtenerbarcode(this.value,$('#codigo_fac').val(),$('#sltMarca_bal').val(),<?= strtotime(date('Y-m-d H:i:s')) ?>)">
                      <?php foreach ($coloresSELECT['DATA'] as $list) { ?>
                        <option value="<?= $list['id_col'] ?>"><?= $list['nota_col'] ?></option>
                      <?php } ?>
                      </select>
              			</div>
                    <div class="form-group">
                      <label for="precio_bal">Precio</label>
                      <input type="number" step="0.01" class="form-control" id="precio_bal" name="precio_bal" placeholder="Digitar precio" required>
                    </div>
                    <div class="form-group">
                      <label for="nbrCantidad_regbal">Cantidad</label>
                      <input type="number" class="form-control" id="nbrCantidad_regbal" name="nbrCantidad_regbal" placeholder="Digitar cantidad">
                    </div>
              			<div class="form-group">
              				<label for="sltId_prov">Proveedor</label>
              				<select class="form-control" id="sltId_prov" name="sltId_prov">
              					<?php foreach ($proveedorSELECT['DATA'] as $list) { ?>
              						<option value="<?= $list['id_prov'] ?>"><?= $list['razsoc_prov'] ?></option>
              					<?php } ?>
              				</select>
              			</div>
                    <div class="form-group">
                      <label for="codigo_fac">Codigo de Factura de compra</label>
                      <input type="number" min="0" max="9999" class="form-control" id="codigo_fac" name="codigo_fac" placeholder="Digitar cantidad" onkeyup="obtenerbarcode($('#txtColor_bal').val(),this.value,$('#sltMarca_bal').val(),<?= strtotime(date('Y-m-d H:i:s')) ?>)" onchange="obtenerbarcode($('#txtColor_bal').val(),this.value,$('#sltMarca_bal').val(),<?= strtotime(date('Y-m-d H:i:s')) ?>)" required>
                    </div>
                    <div class="form-group">
                      <label for="sltId_prov">Codigo de barras</label>
                      <svg id="barcode" class="form-control" style="height: 100px">
                        
                      </svg>
                    </div>
              			<button type="submit" class="btn btn-primary">GUARDAR</button>
                    <div class="row"><div id="mensajeBalonINSERT" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
	var frmBalonINSERT = document.getElementById('frmBalonINSERT');
	frmBalonINSERT.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmBalonINSERT);
		fetch('../controllers/balonController.php?op=3',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
      var mensajeBalonINSERT = document.getElementById('mensajeBalonINSERT');
      if (data.STATUS === 'OK') {
        mensajeBalonINSERT.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Producto ingresado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmBalonINSERT_CLEAN();
      } else {
        mensajeBalonINSERT.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido ingresar producto.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
</script>