<?php
	date_default_timezone_set("America/Lima");
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$balonSELECT = $_SESSION['balonSELECT'];
	$clienteSELECT = $_SESSION['clienteSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">BALONES</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Balones</li>
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
	            			<h3 class="card-title">LISTA DE BALONES GAS/AGUA</h3>
	            		</div>
	            		<div class="col-12 text-right">
	            		<?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
	            			<button onclick="ajaxSimple('subcontent','../controllers/balonController.php',2);" class="btn btn-primary btn-sm">AGREGAR PRODUCTO</button>
	            		<?php } ?>
	            			<!--<button onclick="prestamoBalon();" class="btn btn-info btn-sm">PRESTAR BALON</button>-->
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeBalon" class="col-12 mt-2"></div></div>
	              		<div class="row mt-3 mb-3">
	              			<div class="col-3">
	              				<label for="fecini">DESDE:</label>
	              				<input type="date" name="fecini" id="fecini" class="form-control">
	              			</div>
	              			<div class="col-3">
	              				<label for="fecfin">HASTA:</label>
	              				<input type="date" name="fecfin" id="fecfin" class="form-control" value="<?= date('Y-m-d') ?>">
	              			</div>
	              			<div class="col-3">
	              				<label for="tipo_bal">TIPO PRODUCTO:</label>
	              				<select class="form-control" id="tipo_bal" name="tipo_bal">
	              					<option value="GAS">GAS</option>
	              					<option value="AGUA">AGUA</option>
	              				</select>
	              			</div>
	              			<div class="col-3">
	              				<label for="btnBuscar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	              				<button type="button" class="btn btn-md btn-secondary form-control" id="btnBuscar" onclick="ajaxCompuesto('subcontent2','../controllers/balonController.php',8,'fecini='+$('#fecini').val()+'&fecfin='+$('#fecfin').val()+'&tipo_bal='+$('#tipo_bal').val())">BUSCAR</button>
	              			</div>
	              		</div>
	              		<div id="subcontent2">
	              			<div class="table-responsive">
		    				<table id="tblBalonSELECT" class="table table-bordered table-striped">
		    					<thead>
		    						<tr>
		    							<th class="text-center">ID</th>
		    							<th>NOMBRE</th>
		    							<th class="text-center">MARCA</th>
		    							<th class="text-center">PESO</th>
		    							<th class="text-center">COLOR</th>
		    							<th class="text-center">DISPONIBLES</th>
		    							<th class="text-center" style="width: 494px">COD.BARRAS</th>
		                			<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
		    							<th class="text-center" style="min-width: 100px">ACCIONES</th>
		    						<?php } ?>
		    						</tr>
		    					</thead>
		    					<tbody>
		                		<?php $i=0;foreach ($balonSELECT['DATA'] as $list) { ?>
		                			<tr id="trBalonSELECT<?= $i ?>">
		                				<td class="text-center"><?= $list['id_bal'] ?></td>
		                				<td><?= $list['nombre_bal'] ?></td>
		                				<td class="text-center"><?= $list['marca_bal'] ?></td>
		                				<td class="text-center"><?= $list['peso_bal'] ?></td>
		                				<td class="text-center"><?= $list['color_bal'] ?></td>
		                				<td class="text-center"><?= $list['cantidad_bal'] . " de " . $list['total_bal'] ?></td>
		                				<td style="width: 494px">
		                					<svg id="barcode<?= $list['id_bal'] ?>"></svg>
		                				</td>
		                			<?php
		                			$disabled = '';
			                			$fecha_actual = date("Y-m-d H:i:00",strtotime(date("Y-m-d H:i:00")."- 1 days"));
										$fecha_actual = strtotime($fecha_actual);
										$fecha_entrada = strtotime($list['feccre_bal']);
		                				if ($Stipo_per == '2' && $fecha_actual >= $fecha_entrada) {
		                					$disabled = 'disabled';
		                				}
		                			?>
		                			<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
		                				<td class="text-center">
		                					<a href="javascript:ajaxCompuesto('content','../controllers/balonController.php',16,'id_bal=<?= $list['id_bal'] ?>')" class="btn btn-outline-secondary btn btn-sm" <?= $disabled ?>><span class="fas fa-print"></span></a>
		                					<button onclick="ajaxCompuesto('subcontent','../controllers/balonController.php',4,'id_bal=<?= $list['id_bal'] ?>')" class="btn btn-outline-warning btn btn-sm" <?= $disabled ?>><span class="fas fa-edit"></span></button>
		                					<button onclick="balonDELETE(<?= $list['id_bal'] ?>,<?= $i ?>)" class="btn btn-outline-danger btn btn-sm" <?= $disabled ?>><span class="fas fa-trash-alt"></span></button>
		                				</td>
		                				<input type="hidden" id="hdnId_bal<?= $i ?>" value="<?= $list['id_bal'] ?>">
		                				<input type="hidden" id="hdnNombre_bal<?= $i ?>" value="<?= $list['nombre_bal'] ?>">
		                			</tr>
	                				<?php } ?>
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
</div>
<div class="modal fade" id="mdlExportarBalon">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">PRESTAMO DE BALONES</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="boxId_bal">BALONES &nbsp;&nbsp;&nbsp;<span id="spnCantidad_pre"></span> und</label>
								<div id="boxId_bal" class="pt-1 pr-2 pl-2" style="width: 100%;display: flex;flex-wrap: wrap;border: 1px solid #ced4da;border-radius: .25rem">
								</div>
							</div>
							<div class="form-group">
								<label for="sltId_cli">CLIENTE</label>
								<select id="sltId_cli" class="form-control">
									<?php foreach ($clienteSELECT['DATA'] as $list1) { ?>
										<option value="<?= $list1['id_cli'] ?>"><?= $list1['nombres_cli'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="txaMotivo_pre">MOTIVO</label>
								<textarea id="txaMotivo_pre" class="form-control" placeholder="¿A qué se debe este prestamo?"></textarea>
							</div>
							<div id="msjModalBalon"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-info" onclick="balonPRESTAR()">PRESTAR</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script>
  $(function () {
    $("#tblBalonSELECT").DataTable();
    __ajax('../controllers/balonController.php?op=14','POST','JSON').done(function(info) {
    	if (info.STATUS == 'OK') {
	    	for(var i in info.DATA) {
	    		obtenerbarcodeList(`${info.DATA[i].barcode_bal}`,info.DATA[i].id_bal)
	    	}
    	}
    })
  });
</script>