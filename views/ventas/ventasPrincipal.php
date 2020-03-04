<?php
	session_start();
  $Sid_per = $_SESSION['ID_PER'];
  $Stipo_per = $_SESSION['TIPO_PER'];
	date_default_timezone_set("America/Lima");
  $pro=0;
  if (isset($_GET['pro'])) {
    $pro = $_GET['pro'];
  }
  if (isset($_GET['ped'])) {
    $ped = $_GET['ped'];
  }
?>
<form id="frmProcesarVenta">
<input type="hidden" name="id_pro" id="id_pro">
<input type="hidden" name="id_ped" id="id_ped">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">NUEVA VENTA</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<div class="breadcrumb float-sm-right">
                <div class="custom-control custom-checkbox mr-3">
              <?php if ($Stipo_per != "1" && $Stipo_per != "2" && $Stipo_per != "3" && $Stipo_per != "5") { ?>
                  <input class="custom-control-input" type="checkbox" id="ckxCredito" name="ckxCredito" onclick="credito()" disabled>
              <?php } else { ?>
                  <input class="custom-control-input" type="checkbox" id="ckxCredito" name="ckxCredito" onclick="credito()">
              <?php } ?>
                  <label for="ckxCredito" class="custom-control-label">CRÉDITO</label>
                </div>
                <div class="custom-control custom-checkbox">
              <?php if ($Stipo_per != "1" && $Stipo_per != "2" && $Stipo_per != "3" && $Stipo_per != "5") { ?>
                  <input class="custom-control-input" type="checkbox" id="ckxProforma" name="ckxProforma" onclick="proforma()" checked="" disabled>
                  <input type="hidden" name="ckxProforma" value="1">
              <?php } else { ?>
                <?php if ($pro == 1) { ?>
                  <input class="custom-control-input" type="checkbox" id="ckxProforma" name="ckxProforma" onclick="proforma()" checked="">
                <?php } else { ?>
                  <input class="custom-control-input" type="checkbox" id="ckxProforma" name="ckxProforma" onclick="proforma()">
                <?php } ?>
              <?php } ?>
                  <label for="ckxProforma" class="custom-control-label">PROFORMA</label>
                </div>
            	</div>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
	    <div class="row">
	    	<div class="col-12">
	            <div class="card">
	              	<div class="card-body">
              			<div class="row">
              				<div class="col-sm">
              					<div class="form-group">
				                    <label for="id_cli">Cliente</label>
				                    <select id="id_cli" name="id_cli" class="form-control" onchange="documentoCHANGE(this.value)" required>
				                    </select>
                            <input type="hidden" id="tipdoc_cli" name="tipdoc_cli">
				                </div>
              				</div>
                      <div class="col-sm-2">
                        <div class="form-group">
                            <label style="opacity: 0">Cliente</label>
                            <button class="btn btn-outline-warning btn-block" type="button" onclick="modalShow('mdlRegistroCliente')">REGISTRAR</button>
                        </div>
                      </div>
              				<div class="col-sm">
              					<div class="form-group">
					                <label for="fecini">Fecha emision</label>
					                <input name="fecini" id="fecini" class="form-control" type="date" value="<?= date('Y-m-d') ?>" readonly>
              					</div>
              				</div>
              				<div class="col-sm" id="divFecfin" style="display: none">
              					<div class="form-group">
					                <label for="fecfin">Fecha de vcto</label>
                          <select name="fecfin" id="fecfin" class="form-control">
                            <option value="15">15 dias</option>
                            <option value="30">30 dias</option>
                            <option value="45">45 dias</option>
                            <option value="60">60 dias</option>
                            <option value="90">90 dias</option>
                            <option value="120">120 dias</option>
                          </select>
					                <!--<input class="form-control" type="date" min="<?= date('Y-m-d') ?>">-->
              					</div>
              				</div>
              			</div>
              			<div class="row">
              				<div class="col-md-4 col-sm-8">
              					<div class="form-group">
					                <label for="txttipocomprobante">Tipo de comprobante</label>
                        <?php if ($pro == 1) { ?>
                          <input id="txttipocomprobante" class="form-control" type="text" value="PROFORMA" readonly>
                        <?php } else { ?>
                          <input id="txttipocomprobante" class="form-control" type="text" value="COMPROBANTE ELECTRÓNICO" readonly>
                        <?php } ?>
              					</div>
              				</div>
              				<div class="col-md-2 col-sm-4">
              					<div class="form-group">
					                <label for="serie">Serie</label>
                        <?php if ($pro == 1) { ?>
                          <input name="serie" id="serie" class="form-control" type="text" value="0001" readonly>
                        <?php } else { ?>
                          <input name="serie" id="serie" class="form-control" type="text" value="" readonly>
                        <?php } ?>
              					</div>
              				</div>
              				<div class="col-md col-sm">
              					<div class="form-group">
					                <label for="txttipooperacion">Tipo de operacion</label>
					                <input id="txttipooperacion" class="form-control" type="text" value="VENTA INTERNA" readonly>
              					</div>
              				</div>
              				<div class="col-md col-sm">
              					<div class="form-group">
					                <label for="descuento">Dscto. global (%)</label>
					                <input name="descuento" id="descuento" class="form-control" type="number" step="0.01" min="0">
              					</div>
              				</div>
                      <div class="col-md col-sm" style="display: none">
                        <div class="form-group">
                          <label for="pago_ven">Pago</label>
                          <input name="pago_ven" id="pago_ven" class="form-control" type="number" step="0.01" min="0" value="0.00">
                        </div>
                      </div>
              			</div>
              			<div class="row">
              				<div class="col-sm-4 col-md-2" style="position: relative;">
              					<button id="btnplaca" class="btn btn-primary btn-block">PLACA</button>
                        <input type="text" class="form-control" name="placa" id="placa" placeholder="PLACA VEHICULO" style="position: absolute;top: 0;border: 2px solid #3310f2;display: none">
              				</div>
              				<div class="col-sm-4 col-md-2" style="position: relative;">
              					<button id="btnocompra" class="btn btn-primary btn-block">O.COMPRA</button>
                        <input type="text" class="form-control" name="ocompra" id="ocompra" placeholder="ORDEN DE COMPRA" style="position: absolute;top: 0;border: 2px solid #3310f2;display: none">
              				</div>
              				<div class="col-sm-4 col-md-5" style="position: relative;">
              					<button id="btngremision" class="btn btn-primary btn-block">G.REMISION</button>
                        <div id="divgremision" class="form-control" style="position: absolute;top: 0;border: 2px solid #3310f2;height: auto;z-index: 10;display: none">
                          <div class="divguia"></div>
                          <button type="button" class="btn btn-outline-primary btn-block" onclick="guiaAdd()">AGREGAR</button>
                        </div>
              				</div>
              				<div class="col-sm col-md-3" style="position: relative;">
              					<button id="btnobservaciones" type="button" class="btn btn-primary btn-block">OBSERVACIONES</button>
                        <input type="text" class="form-control" name="observaciones" id="observaciones" placeholder="OBSERVACIONES" style="position: absolute;top: 0;border: 2px solid #3310f2;display: none">
              				</div>
              			</div>
                    <script>
                      var placa = document.getElementById('placa');
                      var ocompra = document.getElementById('ocompra');
                      var gremision = document.getElementById('divgremision');
                      var observaciones = document.getElementById('observaciones');
                      var divTotales = document.getElementById('divTotales');

                      var btnplaca = document.getElementById('btnplaca');
                      var btnocompra = document.getElementById('btnocompra');
                      var btngremision = document.getElementById('btngremision');
                      var btnobservaciones = document.getElementById('btnobservaciones');
                      var btnTotales = document.getElementById('btnTotales');
                      function showHide(e){
                        e.preventDefault();
                        e.stopPropagation();
                        if(placa.style.display == "none"){
                          placa.style.display = "block";
                        } else if(placa.style.display == "block"){
                          placa.style.display = "none";
                        }
                      }
                      function showHideocompra(e){
                        e.preventDefault();
                        e.stopPropagation();
                        if(ocompra.style.display == "none"){
                          ocompra.style.display = "block";
                        } else if(ocompra.style.display == "block"){
                          ocompra.style.display = "none";
                        }
                      }
                      function showHidegremision(e){
                        e.preventDefault();
                        e.stopPropagation();
                        if(gremision.style.display == "none"){
                          gremision.style.display = "block";
                        } else if(gremision.style.display == "block"){
                          gremision.style.display = "none";
                        }
                      }
                      function showHideobservaciones(e){
                        e.preventDefault();
                        e.stopPropagation();
                        if(observaciones.style.display == "none"){
                          observaciones.style.display = "block";
                        } else if(observaciones.style.display == "block"){
                          observaciones.style.display = "none";
                        }
                      }
                      function showHidedivTotales(e){
                        e.preventDefault();
                        e.stopPropagation();
                        if(divTotales.style.display == "none"){
                          divTotales.style.display = "block";
                        } else if(divTotales.style.display == "block"){
                          divTotales.style.display = "none";
                        }
                      }
                      //al hacer click en el boton
                      btnplaca.addEventListener("click", showHide, false);
                      btnocompra.addEventListener("click", showHideocompra, false);
                      btngremision.addEventListener("click", showHidegremision, false);
                      btnobservaciones.addEventListener("click", showHideobservaciones, false);
                      btnTotales.addEventListener("click", showHidedivTotales, false);

                      //funcion para cualquier clic en el documento
                      document.addEventListener("click", function(e){
                        //obtiendo informacion del DOM para  
                        var clic = e.target;
                        if(placa.style.display == "block" && clic != placa){
                          placa.style.display = "none";
                        }
                        if(ocompra.style.display == "block" && clic != ocompra){
                          ocompra.style.display = "none";
                        }
                        if(gremision.style.display == "block"){
                          if(!(clic == gremision || clic.parentNode == gremision || clic.parentNode.parentNode == gremision || clic.parentNode.parentNode.parentNode == gremision || clic.parentNode.parentNode.parentNode.parentNode == gremision)){
                            gremision.style.display = "none";
                          }
                        }/* else if (gremision.style.display == "block" && clic.parentNode != gremision){
                          gremision.style.display = "none";
                        }*/
                        if(observaciones.style.display == "block" && clic != observaciones){
                          observaciones.style.display = "none";
                        }
                        if(divTotales.style.display == "block"){
                          if(!(clic == divTotales || clic.parentNode == divTotales || clic.parentNode.parentNode == divTotales || clic.parentNode.parentNode.parentNode == divTotales || clic.parentNode.parentNode.parentNode.parentNode == divTotales)){
                            divTotales.style.display = "none";
                          }
                        }
                      }, false);
                    </script>
	              	</div>
	            </div>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-12 text-center" style="min-height: 27vh;" id="divBodyBalon1">
	    	</div>
        <div class="col-12 text-center" style="min-height: 27vh;display: none" id="divBodyBalon2">
          <div id="msjVentaPrducto"></div>
          <div class="table-responsive">
            <table id="tblVentaProducto" class="table table-striped">
              <thead>
                <tr>
                  <th>item</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Dscto.</th>
                  <th>IGV</th>
                  <th>Val. Uni.</th>
                  <th>Pre. Uni.</th>
                  <th>SubTotal</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
	    </div>
	    <div class="row">
	    	<div class="col-12">
	        <div class="card">
	          <div class="card-body">
              <div class="row">
              	<div class="col">
              		<div class="form-group">
				            <select class="form-control" id="id_bal" onchange="listBalonVentaAdd(this.value)"></select>
				          </div>
              	</div>
              </div>
              <div class="row">
              	<div id="divTotal" class="col-6 btn btn-light btn-lg" style="position: relative;">
              		<div class="row" id="btnTotales">
              			<div class="col text-left">
              				<span>TOTAL</span>
              			</div>
              			<div class="col text-right">
              				<span id="spnTotal_ven">0.00</span>
                        <input type="hidden" name="total_ven" id="total_ven">
              			</div>
              		</div>
              		<div id="divTotales" class="row pt-3 pb-3 pl-5 pr-5" style="background-color: white;bottom: 55px;box-shadow: 0px 5px 10px;position: absolute;display: none">
                    <div class="col-12 mt-1 mb-1">
                      <div class="row" style="border-bottom: dotted 1px #000">
                        <div class="col-4 text-left">
                          <strong>DSCTO.</strong>
                        </div>
                        <div class="col-8 text-right">
                          <input class="text-right mb-1" type="text" name="dscto_ven" id="dscto_ven" value="0.00" style="border: 0" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mt-1 mb-1">
                      <div class="row" style="border-bottom: dotted 1px #000">
                        <div class="col-4 text-left">
                          <strong>GRAVADO</strong>
                        </div>
                        <div class="col-8 text-right">
                          <input class="text-right mb-1" type="text" name="gravado_ven" id="gravado_ven" value="0.00" style="border: 0" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mt-1 mb-1">
                      <div class="row" style="border-bottom: dotted 1px #000">
                        <div class="col-4 text-left">
                          <strong>I.G.V.</strong>
                        </div>
                        <div class="col-8 text-right">
                          <input class="text-right mb-1" type="text" name="igv_ven" id="igv_ven" value="0.00" style="border: 0" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
              	</div>
              	<!--<div class="col">
              		<button type="button" class="btn btn-outline-secondary btn-lg btn-block" onclick="frmProcesarVenta_CLEAN()">VISTA PREVIA</button>
              	</div>-->
                <div class="col">
                  <button type="button" id="btnProcesarVentaAnonima" class="btn btn-outline-secondary btn-lg btn-block" onclick="ventaAnonima(<?= $Sid_per ?>)" disabled>VENTA ANONIMA</button>
                </div>
              	<div class="col">
              		<button type="submit" id="btnProcesarVenta" class="btn btn-secondary btn-lg btn-block" disabled>PROCESAR</button>
              	</div>
              </div>
              <div class="mt-2">
                <div id="msjVentaPrductoGeneral"></div>
              </div>
            </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
</form>
<div class="modal fade" id="mdlCredito60">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Confirmacion de Administracion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <form id="frmValidarAdmin" class="form-horizontal" onsubmit="confirmarAdmin(event)">
              <div class="form-group row">
                <label for="observacion_pago" class="col-sm-2">USUARIO*</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="usuario_per" name="usuario_per" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="observacion_pago" class="col-sm-2">CLAVE*</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="clave_per" name="clave_per" required>
                </div>
              </div>
              <div class="form-group row">
                <button class="btn btn-block btn-primary">CONFIRMAR</button>
              </div>
              <div class="form-group row">
                <div class="col" id="msjValidarAdmin"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlRegistroCliente">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title">Registro Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <form id="frmRegistroCliente" class="form-horizontal" onsubmit="RegistroCliente(event)">
              <div class="form-group row">
                <label for="sltTipdoc_cli" class="col-sm-3">DNI*</label>
                <div class="col-sm-9">
                  <select class="form-control" id="sltTipdoc_cli" name="sltTipdoc_cli">
                    <option value="1">DNI</option>
                    <option value="6">RUC</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nbrNumdoc_cli" class="col-sm-3">NÚMERO DOCUMENTO*</label>
                <div class="col-sm-9">
                  <input type="text" maxlength="8" class="form-control" id="nbrNumdoc_cli" name="nbrNumdoc_cli" placeholder="Digitar el número de documentos" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
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
              </script>
              <div class="form-group row">
                <label for="txtNombres_cli" class="col-sm-3">NOMBRES O RAZON SOCIAL*</label>
                <div class="col-sm-9">
                  <input type="text" maxlength="100" class="form-control" id="txtNombres_cli" name="txtNombres_cli" placeholder="Digitar nombres o razon social" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="telefono_cli" class="col-sm-3">TELEFONO / CELULAR*</label>
                <div class="col-sm-9">
                  <input type="number" max="999999999" class="form-control" id="telefono_cli" name="telefono_cli" placeholder="Digitar telefono" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion_cli" class="col-sm-3">DIRECCIÓN*</label>
                <div class="col-sm-9">
                  <textarea maxlength="300" class="form-control" id="direccion_cli" name="direccion_cli" placeholder="Digitar dirección" required></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="referencia_cli" class="col-sm-3">REFERENCIA*</label>
                <div class="col-sm-9">
                  <input type="text" maxlength="50" class="form-control" id="referencia_cli" name="referencia_cli" placeholder="Digitar referencia de su ubicacion" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="correo_cli" class="col-sm-3">CORREO*</label>
                <div class="col-sm-9">
                  <input type="email" maxlength="50" class="form-control" id="correo_cli" name="correo_cli" placeholder="Digitar correo electrónico" required>
                </div>
              </div>
              <div class="form-group row">
                <button id="btnClienteINSERT" class="btn btn-block btn-outline-warning">CONFIRMAR</button>
              </div>
              <div class="form-group row">
                <div class="col" id="msjRegistroCliente"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  var frmProcesarVenta = document.getElementById('frmProcesarVenta');
  frmProcesarVenta.addEventListener('submit', function(e) {
    e.preventDefault();
    var opcion = false;
    if ($('#ckxCredito').is(':checked') == false) {
      opcion = true;
    } else if (parseInt($('#fecfin').val()) >= 60) {
      modalShow('mdlCredito60');
    } else {
      opcion = true;
    }
    if (opcion == true) {
    $('#btnProcesarVenta').removeAttr('disabled');
    $('#btnProcesarVenta').attr('disabled','true');
    $('#btnProcesarVenta').text('CARGANDO COMPROBANTE...');
    //alert($('#ckxProforma:checked').val());
    var dataform = new FormData(frmProcesarVenta);
    dataform.append('nfilas', $('#tblVentaProducto > tbody > tr').length);
    dataform.append('nguias', $('#divgremision .divguiarow').length);
    fetch('../controllers/ventasController.php?op=4',{
        method: 'POST',
        body: dataform
    })
    .then(res => res.json())
    .then(data => {
      var msjVentaPrductoGeneral = document.getElementById('msjVentaPrductoGeneral');
      if (data.STATUS === 'OK') {
        msjVentaPrductoGeneral.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${data.ERROR}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        if ($('#ckxProforma').prop('checked')) {
          frmProcesarVenta_CLEAN();
          $('#btnProcesarVenta').removeAttr('disabled');
          $('#btnProcesarVenta').text('PROCESAR');
        } else {
          $('#btnProcesarVenta').text('REGISTRANDO DATOS...');
          dataform.append('numero_comprobante', `${data.DATA.numero}`);
          dataform.append('pdf_base64', `${data.DATA.pdf_base64}`);
          fetch('../controllers/ventasController.php?op=5',{
              method: 'POST',
              body: dataform
          })
          .then(res => res.json())
          .then(data => {
            if (data.STATUS === 'OK') {
              msjVentaPrductoGeneral.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>CORRECTO!!!</strong> Registro Guardado con exito!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              `;
              $('#btnProcesarVenta').removeAttr('disabled');
              $('#btnProcesarVenta').text('PROCESAR');
              if (<?= $Stipo_per ?> == 1 || <?= $Stipo_per ?> == 2) {
                var id_cli = $('#id_cli').val();
	              ajaxPagina('content','./maps/maps.php?id_cli='+id_cli);
              } else {
                frmProcesarVenta_CLEAN();
              }
            } else {
              msjVentaPrductoGeneral.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>ERROR!!!</strong> No se pudo registrar la venta!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              `;
              $('#btnProcesarVenta').text('ERROR');
            }
          })
        }
      } else {
        msjVentaPrductoGeneral.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${data.ERROR}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
    })
    }
  })
  $('#id_bal').select2({
    placeholder: 'Buscar Producto',
    ajax: {
      url: "../controllers/buscarController.php?op=2",
      dataType: 'json',
      quietMillis: 100,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public'
        }
        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      results: function (data, page) {
        return { results: data.results };
      }
    },
  });
  $('#id_cli').select2({
    placeholder: 'Buscar Cliente',
    ajax: {
      url: "../controllers/buscarController.php?op=1",
      dataType: 'json',
      quietMillis: 100,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public'
        }
        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      results: function (data, page) {
        return { results: data.results };
      }
    },
  });
<?php if (isset($_GET['id_pro'])) { ?>
  cargarDATAVenta(<?= $_GET['id_pro'] ?>);
  modalDestroy();
<?php } ?>
<?php if (isset($_GET['id_ped'])) { ?>
  cargarDATAPedido(<?= $_GET['id_ped'] ?>);
  modalDestroy();
<?php } ?>
</script>