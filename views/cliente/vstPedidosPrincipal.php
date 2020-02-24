<?php
	session_start();
  $Sid_cli = $_SESSION['ID_CLI'];
  $Stipdoc_cli = $_SESSION['TIPDOC_CLI'];
	date_default_timezone_set("America/Lima");
?>
<form id="frmProcesarPedido">
<input type="hidden" name="id_pro" id="id_pro">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">NUEVO PEDIDO</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<div class="breadcrumb float-sm-right">
                <div class="custom-control custom-checkbox mr-3">
                  <input class="custom-control-input" type="checkbox" id="ckxCredito" name="ckxCredito" onclick="credito()">
                  <label for="ckxCredito" class="custom-control-label">CRÉDITO</label>
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
              				<div class="col-md-4 col-sm-8">
              					<div class="form-group">
					                <label for="txttipocomprobante">Tipo de comprobante</label>
                        <?php if ($Stipdoc_cli == 1) { ?>
                          <input id="txttipocomprobante" class="form-control" type="text" value="BOLETA DE VENTA ELECTRONICA" readonly>
                        <?php } ?>
                        <?php if ($Stipdoc_cli == 6) { ?>
                          <input id="txttipocomprobante" class="form-control" type="text" value="FACTURA DE VENTA ELECTRONICA" readonly>
                        <?php } ?>
              					</div>
              				</div>
              				<div class="col-md-2 col-sm-4">
              					<div class="form-group">
					                <label for="serie">Serie</label>
                        <?php if ($Stipdoc_cli == 1) { ?>
                          <input name="serie" id="serie" class="form-control" type="text" value="BP01" readonly>
                        <?php } ?>
                        <?php if ($Stipdoc_cli == 6) { ?>
                          <input name="serie" id="serie" class="form-control" type="text" value="FP01" readonly>
                        <?php } ?>
              					</div>
              				</div>
                      <div class="col-md col-sm" style="display: none">
                        <div class="form-group">
                          <label for="pago_ven">Pago</label>
                          <input name="pago_ven" id="pago_ven" class="form-control" type="number" step="0.01" min="0" value="0.00">
                        </div>
                      </div>
              			</div>
                    <script>
                      var divTotales = document.getElementById('divTotales');
                      var btnTotales = document.getElementById('btnTotales');
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
                      btnTotales.addEventListener("click", showHidedivTotales, false);
                      //funcion para cualquier clic en el documento
                      document.addEventListener("click", function(e){
                        //obtiendo informacion del DOM para  
                        var clic = e.target;
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
            <table id="tblPedidoProducto" class="table table-striped">
              <thead>
                <tr>
                  <th>item</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
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
              	<div class="col">
              		<button type="submit" id="btnProcesarPedido" class="btn btn-secondary btn-lg btn-block" disabled>PROCESAR</button>
              	</div>
              </div>
              <div class="mt-2">
                <div id="msjPedidoPrductoGeneral"></div>
              </div>
            </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
</form>
<script>
  var frmProcesarPedido = document.getElementById('frmProcesarPedido');
  frmProcesarPedido.addEventListener('submit', function(e) {
    e.preventDefault();
    $('#btnProcesarPedido').removeAttr('disabled');
    $('#btnProcesarPedido').attr('disabled','true');
    $('#btnProcesarPedido').text('CARGANDO PEDIDO...');
    //alert($('#ckxProforma:checked').val());
    var dataform = new FormData(frmProcesarPedido);
    dataform.append('nfilas', $('#tblPedidoProducto > tbody > tr').length);
    fetch('../../controllers/clienteController.php?op=14',{
        method: 'POST',
        body: dataform
    })
    .then(res => res.json())
    .then(data => {
      var msjPedidoPrductoGeneral = document.getElementById('msjPedidoPrductoGeneral');
      if (data.STATUS === 'OK') {
        msjPedidoPrductoGeneral.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${data.ERROR}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        frmProcesarPedido_CLEAN();
        $('#btnProcesarPedido').removeAttr('disabled');
        $('#btnProcesarPedido').text('PROCESAR');
      } else {
        msjPedidoPrductoGeneral.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${data.ERROR}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
    })
  })
  $('#id_bal').select2({
    placeholder: 'Buscar Producto',
    ajax: {
      url: "../../controllers/buscarController.php?op=2",
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
</script>