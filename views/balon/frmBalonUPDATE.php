<?php
  session_start();
  $balonDATA = $_SESSION['balonDATA'];
  $marcaSELECTAGUA = $_SESSION['marcaSELECTAGUA'];
  $marcaSELECTGAS = $_SESSION['marcaSELECTGAS'];
  $coloresSELECT = $_SESSION['coloresSELECT'];
  $proveedorSELECT = $_SESSION['proveedorSELECT'];
?>
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="col-12">
                  <h3 class="card-title">MODIFICAR BALONES GAS/AGUA</h3>
                </div>
                <div class="col-12 text-right">
                  <button onclick="ajaxSimple('content','../controllers/balonController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
                </div>
              </div>
                <div class="card-body">
                  <form id="frmBalonUPDATE" action="#" method="post">
                    <input type="hidden" name="id_bal" value="<?= $balonDATA['DATA'][0]['id_bal'] ?>">
                    <input type="hidden" id="precodbar" name="precodbar" value="<?= $balonDATA['DATA'][0]['barcode_bal'] ?>">
                    <div class="form-group">
                      <label for="sltTipo_bal">Tipo</label>
                      <select onchange="tipo_balCHANGE();" class="form-control" id="sltTipo_bal" name="sltTipo_bal">
                        <option value="GAS">GAS</option>
                        <option value="AGUA">AGUA</option>
                      </select>
                    </div>
                    <?php if ($balonDATA['DATA'][0]['tipo_bal'] == 'GAS') {?>
                    <div class="form-group">
                      <label for="categoria_bal">Categoria</label>
                      <div class="row">
                      <?php if ($balonDATA['DATA'][0]['categoria_bal'] == 'PREMIUN') { ?>
                        <label class="switch">
                          <input id="categoria_bal" name="categoria_bal" type="checkbox" class="primary" checked>
                          <span class="slider round"></span>
                        </label>
                      <?php } else { ?>
                        <label class="switch">
                          <input id="categoria_bal" name="categoria_bal" type="checkbox" class="primary">
                          <span class="slider round"></span>
                        </label>
                      <?php } ?>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                      <label for="txtNombre_bal">Nombre</label>
                      <input type="text" class="form-control" id="txtNombre_bal" name="txtNombre_bal" value="<?= $balonDATA['DATA'][0]['nombre_bal'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="nbrCantida_bal">cantidad</label>
                      <input type="number" min="<?= $balonDATA['DATA'][0]['cantidad_bal'] ?>" class="form-control" id="nbrCantida_bal" name="nbrCantida_bal" value="<?= $balonDATA['DATA'][0]['cantidad_bal'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="sltMarca_bal">Marca</label>
                      <select class="form-control" id="sltMarca_bal" name="sltMarca_bal" onchange="obtenerbarcode($('#txtColor_bal').val(),$('#codigo_fac').val(),this.value,<?= strtotime(date('Y-m-d H:i:s')) ?>)">
                        <option value="">------</option>
                        <?php if ($balonDATA['DATA'][0]['tipo_bal'] == 'AGUA') { ?>
                        <?php foreach ($marcaSELECTAGUA['DATA'] as $list) { ?>
                          <option value="<?= $list['id_mar'] ?>"><?= $list['nota_mar'] ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <?php foreach ($marcaSELECTGAS['DATA'] as $list) { ?>
                          <option value="<?= $list['id_mar'] ?>"><?= $list['nota_mar'] ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="nbrPeso_bal">Peso</label>
                      <input type="number" min="0" max="999" class="form-control" id="nbrPeso_bal" name="nbrPeso_bal" value="<?= $balonDATA['DATA'][0]['peso_bal'] ?>">
                    </div>
                    <?php if ($balonDATA['DATA'][0]['tipo_bal'] == 'AGUA') { ?>
                    <div id="divColor_bal" name="divColor_bal" class="form-group" style="display: none">
                    <?php } else { ?>
                    <div id="divColor_bal" name="divColor_bal" class="form-group">
                    <?php } ?>
                      <label for="txtColor_bal">Color</label>
                      <select class="form-control" id="txtColor_bal" name="txtColor_bal" onchange="obtenerbarcode(this.value,$('#codigo_fac').val(),$('#sltMarca_bal').val(),<?= strtotime(date('Y-m-d H:i:s')) ?>)">
                      <?php foreach ($coloresSELECT['DATA'] as $list) { ?>
                        <option value="<?= $list['id_col'] ?>"><?= $list['nota_col'] ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="precio_bal">Precio</label>
                      <input type="number" step="0.01" class="form-control" id="precio_bal" name="precio_bal" placeholder="Digitar precio" value="<?= $balonDATA['DATA'][0]['precio_bal'] ?>">
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
                      <input type="number" min="0" max="99999" class="form-control" id="codigo_fac" name="codigo_fac" placeholder="Digitar cantidad" onkeyup="obtenerbarcode($('#txtColor_bal').val(),this.value,$('#sltMarca_bal').val(),<?= strtotime(date('Y-m-d H:i:s')) ?>)" onchange="obtenerbarcode($('#txtColor_bal').val(),this.value,$('#sltMarca_bal').val(),<?= strtotime(date('Y-m-d H:i:s')) ?>)" value="<?= $balonDATA['DATA'][0]['codigo_fac'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="sltId_prov">Codigo de barras</label>
                      <svg id="barcode" class="form-control" style="height: 100px">
                        
                      </svg>
                    </div>
                    <button type="submit" class="btn btn-primary">GUARDAR</button>
                    <div class="row"><div id="mensajeBalonUPDATE" class="col-12 mt-2"></div></div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $("#sltTipo_bal option[value='<?= $balonDATA['DATA'][0]['tipo_bal'] ?>']").attr("selected",true);
  $("#sltMarca_bal option[value='<?= $balonDATA['DATA'][0]['marca_bal'] ?>']").attr("selected",true);
  $("#txtColor_bal option[value='<?= $balonDATA['DATA'][0]['color_bal'] ?>']").attr("selected",true);
  $("#sltId_prov option[value='<?= $balonDATA['DATA'][0]['id_prov'] ?>']").attr("selected",true);
  obtenerbarcodeList('<?= $balonDATA['DATA'][0]['barcode_bal'] ?>','')
	var frmBalonUPDATE = document.getElementById('frmBalonUPDATE');
	frmBalonUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmBalonUPDATE);
    data.append('cambioCantidad', parseInt($('#nbrCantida_bal').val())-parseInt(<?= $balonDATA['DATA'][0]['cantidad_bal'] ?>));
		fetch('../controllers/balonController.php?op=5',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
			console.log(data.STATUS);
      var mensajeBalonUPDATE = document.getElementById('mensajeBalonUPDATE');
      if (data.STATUS === 'OK') {
        mensajeBalonUPDATE.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Bal¨®n modificado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;

      } else {
        mensajeBalonUPDATE.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido modificar el bal¨®n.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
</script>