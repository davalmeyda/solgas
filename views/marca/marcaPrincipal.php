<?php
	session_start();
	$marcaSELECT = $_SESSION['marcaSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">MARCA</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Marca</li>
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
	            			<h3 class="card-title">LISTA DE MARCAS</h3>
	            		</div>
	            		<div class="col-12 text-right">
	            			<button onclick="ajaxPagina('subcontent','./marca/frmMarcaINSERT.php');" class="btn btn-primary btn-sm">AGREGAR MARCA</button>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeCliente" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblMarcaSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th>ID</th>
	    							<th>NOTA MARCA</th>
	    							<th>TIPO</th>
	    							<th style="width: 100px">ACCION</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php foreach ($marcaSELECT['DATA'] as $list) { ?>
	                			<tr>
	                				<td><?= $list['id_mar'] ?></td>
	                				<td><?= $list['nota_mar'] ?></td>
	                				<td><?= $list['tipo'] ?></td>
	                				<td class="text-center">
                                        <button onclick="ajaxCompuesto('subcontent','../controllers/marcaController.php',3,'id_mar=<?= $list['id_mar'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
	                				</td>
	                			</tr>
	                		<?php } ?>
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
    $("#tblMarcaSELECT").DataTable();
  });
</script>