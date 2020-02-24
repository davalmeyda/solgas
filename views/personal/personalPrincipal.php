<?php
	session_start();
	$personalSELECT = $_SESSION['personalSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">PERSONAL</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Personal</li>
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
	            			<h3 class="card-title">LISTA DE PERSONAL</h3>
	            		</div>
	            		<div class="col-12 text-right">
	            			<button onclick="ajaxPagina('subcontent','../controllers/personalController.php?op=0');" class="btn btn-primary btn-sm">AGREGAR PERSONAL</button>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajePersonal" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblPersonalSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th class="text-center">ID</th>
	    							<th class="text-center">TIPO</th>
	    							<th>NOMBRES</th>
	    							<th class="text-center">TIP. DOCUMENTO</th>
	    							<th class="text-center">NUM. DOCUMENTO</th>
	    							<th class="text-center">NACIONALIDAD</th>
	    							<th class="text-center">USUARIO</th>
	    							<th class="text-center">ACCIONES</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($personalSELECT['DATA'] as $list) { ?>
	                			<tr id="trPersonalSELECT<?= $i ?>">
	                				<td><?= $list['id_per'] ?></td>
	                				<td class="text-center" style="text-transform: uppercase;"><?= $list['nota_temp'] ?></td>
	                				<td><?= $list['nombre_per'] . " " . $list['apellido_per'] ?></td>
	                				<td><?= $list['tipdoc_per'] ?></td>
	                				<td><?= $list['numdoc_per'] ?></td>
	                				<td><?= $list['nacionalidad_per'] ?></td>
	                				<td><?= $list['usuario_per'] ?></td>
	                				<td class="text-center">
	                					<button onclick="ajaxCompuesto('subcontent','../controllers/personalController.php',3,'id_per=<?= $list['id_per'] ?>')" class="btn btn-outline-warning btn btn-sm"><span class="fas fa-edit"></span></button>
	                					<button onclick="personalDELETE(<?= $list['id_per'] ?>,<?= $i ?>)" class="btn btn-outline-danger btn btn-sm"><span class="fas fa-trash-alt"></span></button>
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
    $("#tblPersonalSELECT").DataTable();
  });
</script>