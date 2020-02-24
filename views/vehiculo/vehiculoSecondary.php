<?php
	$tipo_veh = $_GET['tipo_veh'];
	session_start();
	$vehiculoSELECT = $_SESSION['vehiculoSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark"><?= $tipo_veh ?></h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active"><?= $tipo_veh ?></li>
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
	            			<h3 class="card-title">LISTA DE <?= $tipo_veh ?></h3>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div class="row"><div id="mensajePersonal" class="col-12 mt-2"></div></div>
	              		<div class="table-responsive">
	    				<table id="tblvehiculoSELECT" class="table table-bordered table-striped">
	    					<thead>
	    						<tr>
	    							<th class="text-center">ID</th>
	    							<th>DESCRIPCION</th>
	    							<th class="text-center">PLACA</th>
	    							<th class="text-center">KILOMETRAJE</th>
	    							<th class="text-center">ACCIONES</th>
	    						</tr>
	    					</thead>
	    					<tbody>
	                		<?php $i=0;foreach ($vehiculoSELECT['DATA'] as $list) { ?>
	                			<tr id="trvehiculoSELECT<?= $i ?>">
	                				<td><?= $list['id_veh'] ?></td>
	                				<td><?= $list['descripcion_veh'] ?></td>
	                				<td><?= $list['placa_veh'] ?></td>
	                				<td><?= $list['kilometraje_veh'] ?></td>
	                				<td class="text-center">
	                					<button onclick="ajaxCompuesto('subcontent','../controllers/vehiculoController.php',3,'id_veh=<?= $list['id_veh'] ?>')" class="btn btn-outline-secondary btn btn-sm"><span class="fas fa-paper-plane"></span></button>
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
    $("#tblvehiculoSELECT").DataTable();
  });
</script>