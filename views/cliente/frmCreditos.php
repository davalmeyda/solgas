<?php
	session_start();
	$creditoLIST = $_SESSION['creditoLIST'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">CREDITOS</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Creditos</li>
            	</ol>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
	    <div class="row">
	    	<div class="col-12">
	            <div class="card">
	            	<div class="card-header">
	            		<div class="col-12">
	            			<h3 class="card-title">LISTA DE CREDITOS</h3>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeCreditos" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblCreditoList" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th class="text-center">ID</th>
	    							<th class="text-center">FECHA GENERADA</th>
	    							<th class="text-center">FECHA LIMITE</th>
	    							<th>CLIENTE</th>
	    							<th>COMPROBANTE</th>
	    							<th class="text-center">TOTAL VENTA</th>
	    							<th class="text-center">TOTAL PAGO</th>
	    							<th>LIQUIDAR</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($creditoLIST['DATA'] as $list) { ?>
	                			<tr>
	                				<td class="text-center"><?= $list['id_ven'] ?></td>
	                				<td class="text-center"><?= date('d/m/Y', strtotime($list['fecini_ven'])) ?></td>
	                				<td class="text-center"><?= date('d/m/Y', strtotime($list['fecfin_ven'])) ?></td>
	                				<td><?= $list['nombres_cli'] ?></td>
	                			<?php if ($list['tipo_comprobante'] == 1) { ?>
	                				<td>FACTURA <?= $list['comprobante'] ?></td>
	                			<?php } else { ?>
	                				<td>BOLETA <?= $list['comprobante'] ?></td>
	                			<?php } ?>
	                				<td class="text-center">S/ <?= $list['total_ven'] ?></td>
	                				<td class="text-center">S/ <?= $list['pago_ven'] ?></td>
	                				<td class="text-center">
	                					<button onclick="mdlLiquidarOPEN('<?= $list['total_ven'] ?>','<?= $list['pago_ven'] ?>',<?= $list['id_ven'] ?>)" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-money-check-alt"></span></button>
                            <a href="../dist/comprobantes/<?= $list['comprobante'] ?>.pdf" target="_BLANK" class="btn btn-outline-info btn btn-sm"><span class="fas fa-eye"></span></a>
	                				</td>
	                			</tr>
	                		<?php $i++;} ?>
	                		</tbody>
	              		</table>
	              		</div>
	              	</div>
	            </div>
	    	</div>
	    </div>
	</div>
</div>
<div class="modal fade" id="mdlLiquidar">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Panel de liquidacion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col">
      			<form id="frmLiquidar" class="form-horizontal">
      				<input type="hidden" id="id_ven" name="id_ven">
              <div class="form-group row">
                <div class="col-sm-3">
                  <label>TOTAL/PARCIAL</label>
                </div>
                <div class="col-sm">
                  <label class="switch">
                    <input id="tipo_pago" name="tipo_pago" type="checkbox" class="warning">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
	      			<div class="form-group">
	      				<label>EFECTIVO/TARJETA</label>
	      				<div class="row">
	      					<div class="col-sm-2">
		                        <label class="switch">
		                          <input id="modo_pago" name="modo_pago" type="checkbox" class="primary">
		                          <span class="slider round"></span>
		                        </label>
	      					</div>
	                        <div class="col-sm-10" style="display: none">
	                          <input type="number" max="9999" class="form-control" id="nutarjeta_pago" name="nutarjeta_pago" placeholder="Digitar 4 ultimos digitos de tarjeta">
	                        </div>
	      				</div>
	      			</div>
	      			<div class="form-group row">
	      				<label for="observacion_pago" class="col-sm-2">OBSERVA<br>CION</label>
                        <div class="col-sm-10">
                        	<textarea maxlength="50" name="observacion_pago" class="form-control" placeholder="digitar observacion"></textarea>
                        </div>
	      			</div>
	      			<div class="form-group row">
	      				<label for="observacion_pago" class="col-sm-2">MONTO*</label>
                        <div class="col-sm-10">
                        	<input type="number" step="0.01" min="1" id="monto_pago" name="monto_pago" class="form-control" required>
                        </div>
	      			</div>
	      			<div class="form-group row">
	      				<button id="btnLiquidar" class="btn btn-block btn-primary">LIQUIDAR</button>
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
  $(function () {
    $("#tblCreditoList").DataTable({
        "order": [[ 0, "desc" ]]
    });
  });
  document.getElementById('tipo_pago').addEventListener('change', function(e) {
    e.preventDefault();
    if ($(this).is(':checked')) {
      $('#monto_pago').val('');
      $('#monto_pago').removeAttr('readonly')
    } else {
      $('#monto_pago').val(document.getElementById('monto_pago').max);
      $('#monto_pago').attr('readonly',true);
    }
  })
  document.getElementById('modo_pago').addEventListener('change', function(e) {
    e.preventDefault();
    if ($(this).is(':checked')) {
      $('#nutarjeta_pago').parent().css('display','')
      $('#nutarjeta_pago').removeAttr('required')
      $('#nutarjeta_pago').attr('required',true)
    } else {
      $('#nutarjeta_pago').parent().css('display','none')
      $('#nutarjeta_pago').removeAttr('required')
    }
  })
  function mdlLiquidarOPEN(total_ven,pago_ven,id_ven) {
  	$('#id_ven').val(id_ven);
    $('#tipo_pago').removeAttr('checked');
  	$('#monto_pago').removeAttr('max');
    $('#monto_pago').removeAttr('placeholder');
  	$('#monto_pago').removeAttr('readonly');
  	var montomax = (parseFloat(total_ven)-parseFloat(pago_ven)).toFixed(2);
  	$('#monto_pago').attr('max',montomax);
    $('#monto_pago').attr('placeholder',"Monto maximo S/ "+montomax);
    $('#monto_pago').attr('readonly',true);
  	$('#monto_pago').val(montomax);
  	modalShow('mdlLiquidar');
  }
  	var frmLiquidar = document.getElementById('frmLiquidar');
	frmLiquidar.addEventListener('submit', function(e) {
		e.preventDefault();
    	$('#btnLiquidar').removeAttr('disabled');
    	$('#btnLiquidar').attr('disabled',true);
    	$('#btnLiquidar').text('Guardando...');
		var data = new FormData(frmLiquidar);
		fetch('../controllers/clienteController.php?op=8',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
      var mensajeCreditos = document.getElementById('mensajeCreditos');
      if (data.STATUS === 'OK') {
        mensajeCreditos.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Pago registrado exitosamente.
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-outline-primary btn-sm" onclick="ajaxSimple('content','../controllers/clienteController.php',7)">
              Refrescar
            </button>
          </div>
        `;
    	$('#btnLiquidar').removeAttr('disabled');
    	$('#btnLiquidar').text('LIQUIDAR');
    	frmLiquidar.reset();
    	modalHide('mdlLiquidar');
      } else {
        mensajeCreditos.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha Registrar el pago. ${data.ERROR}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
    	$('#btnLiquidar').removeAttr('disabled');
    	$('#btnLiquidar').text('LIQUIDAR');
    	frmLiquidar.reset();
    	modalHide('mdlLiquidar');
      }
		})
	})
</script>