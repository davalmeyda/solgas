<?php
	session_start();
	$clienteSELECT = $_SESSION['clienteSELECT'];
	$Stipo_per = $_SESSION['TIPO_PER'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">CLIENTES</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Clientes</li>
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
	            			<h3 class="card-title">LISTA DE CLIENTES</h3>
	            		</div>
	            		<div class="col-12 text-right">
	            			<button onclick="ajaxPagina('subcontent','./cliente/frmClienteINSERT.php');" class="btn btn-primary btn-sm">AGREGAR CLIENTE</button>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeCliente" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblClienteSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th>ID</th>
	    							<th>TIP. DOCUMENTO</th>
	    							<th>NUM. DOCUMENTO</th>
	    							<th>NOMBRES</th>
	    						<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
	    							<th>ACCIONES</th>
	    						<?php } ?>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($clienteSELECT['DATA'] as $list) { ?>
	                			<tr id="trClienteSELECT<?= $i ?>">
	                				<td><?= $list['id_cli'] ?></td>
	                			<?php if ($list['tipdoc_cli'] == 1) { ?>
	                				<td>DNI</td>
	                			<?php } else { ?>
	                				<td>RUC</td>
	                			<?php } ?>
	                				<td><?= $list['numdoc_cli'] ?></td>
	                				<td><?= $list['nombres_cli'] ?></td>
	    						<?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
	                				<td class="text-center">
	                					<button onclick="ajaxCompuesto('subcontent','../controllers/clienteController.php',3,'id_cli=<?= $list['id_cli'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
	                					<button onclick="clienteDELETE(<?= $list['id_cli'] ?>,<?= $i ?>)" class="btn btn-outline-danger btn btn-sm"><span class="fas fa-trash-alt"></span></button>
	                				</td>
	                			<?php } ?>
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
<script>
  $(function () {
    $("#tblClienteSELECT").DataTable();
  });
</script>