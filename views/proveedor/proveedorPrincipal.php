<?php
	session_start();
	$proveedorSELECT = $_SESSION['proveedorSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">PROVEEDORES</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Proveedores</li>
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
	            			<h3 class="card-title">LISTA DE PROVEEDORES</h3>
	            		</div>
	            		<div class="col-12 text-right">
	            			<button onclick="ajaxPagina('subcontent','./proveedor/frmProveedorINSERT.php');" class="btn btn-primary btn-sm">AGREGAR PROVEEDOR</button>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajeProveedor" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblProveedorSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th>ID</th>
	    							<th>RUC</th>
	    							<th>RAZÓN SOCIAL</th>
	    							<th>DIRECCIÓN</th>
	    							<th>ACCIONES</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($proveedorSELECT['DATA'] as $list) { ?>
	                			<tr id="trProveedorSELECT<?= $i ?>">
	                				<td><?= $list['id_prov'] ?></td>
	                				<td><?= $list['ruc_prov'] ?></td>
	                				<td><?= $list['razsoc_prov'] ?></td>
	                				<td><?= $list['direccion_prov'] ?></td>
	                				<td class="text-center">
	                					<button onclick="ajaxCompuesto('subcontent','../controllers/proveedorController.php',3,'id_prov=<?= $list['id_prov'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
	                					<button onclick="proveedorDELETE(<?= $list['id_prov'] ?>,<?= $i ?>)" class="btn btn-outline-danger btn btn-sm"><span class="fas fa-trash-alt"></span></button>
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
<script>
  $(function () {
    $("#tblProveedorSELECT").DataTable();
  });
</script>