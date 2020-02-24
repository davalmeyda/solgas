<?php
	session_start();
	$registrobalonSELECT = $_SESSION['registrobalonSELECT'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark">HISTORIAL DE REGISTRO DE PRODUCTOS</h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<ol class="breadcrumb float-sm-right">
              		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
              		<li class="breadcrumb-item active">Historial</li>
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
	            			<h3 class="card-title">Lista de registro de productos</h3>
	            		</div>
	            	</div>
	              	<div class="card-body">
	              		<div id="subcontent2">
	              			<div class="table-responsive">
		    				<table id="tblBalonHistory" class="table table-bordered table-striped">
		    					<thead>
		    						<tr>
		    							<th class="text-center">ID</th>
		    							<th class="text-center">NOMBRE DEL<br>PRODUCTO</th>
		    							<th class="text-center">FECHA DE<br>REGISTRO</th>
		    							<th class="text-center">INGRESADO<br>POR</th>
		    							<th class="text-center">CANTIDAD<br>INGRESADA</th>
		    						</tr>
		    					</thead>
		    					<tbody>
		                		<?php foreach ($registrobalonSELECT['DATA'] as $list) { ?>
		                			<tr>
		                				<td class="text-center"><?= $list['id_regbal'] ?></td>
		                				<td><?= $list['nombre_bal'] ?></td>
		                				<td class="text-center"><?= $list['fecha_regbal'] ?></td>
		                				<td class="text-center"><?= $list['nombres_per'] ?></td>
		                				<td class="text-center"><?= $list['cantidad_regbal'] ?></td>
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
</div>
<script>
  $(function () {
    $("#tblBalonHistory").DataTable({
        "order": [[ 2, "desc" ]]
    });
  });
</script>