<?php
  	session_start();
	$balonGASSELECT = $_SESSION['balonGASSELECT'];
	$balonAGUASELECT = $_SESSION['balonAGUASELECT'];
?>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">PRODUCTOS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
	    	<div class="col-12">
	            <div class="card card-primary card-outline card-tabs">
	            	<div class="card-header p-0 pt-1 border-bottom-0">
		                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
		                  <li class="nav-item">
		                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Balones de GAS</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">AGUA</a>
		                  </li>
		                </ul>
		            </div>
	            	<div class="card-body">
	            		<div class="tab-content" id="custom-tabs-two-tabContent">
                  			<div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
					        	<div class="table-responsive">
					        		<table class="table table-striped">
					        			<thead>
					        				<tr>
					        					<td>Nro</td>
					        					<td>NOMBRE</td>
					        					<td>MARCA</td>
					        					<td>PESO</td>
					        					<td>COLOR</td>
					        				</tr>
					        			</thead>
					        			<tbody>
					        			<?php foreach ($balonGASSELECT['DATA'] as $list) { ?>
					        				<tr>
					        					<td><?= $list['id_bal'] ?></td>
					        					<td><?= $list['nombre_bal'] ?></td>
					        					<td><?= $list['nota_mar'] ?></td>
					        					<td><?= $list['peso_bal'] ?> KG</td>
					        					<td><?= $list['nota_col'] ?></td>
					        				</tr>
					        			<?php } ?>
					        			</tbody>
					        		</table>
					        	</div>
					        </div>
					        <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
			                    <div class="table-responsive">
					        		<table class="table table-striped">
					        			<thead>
					        				<tr>
					        					<td>Nro</td>
					        					<td>NOMBRE</td>
					        					<td>MARCA</td>
					        					<td>PESO</td>
					        				</tr>
					        			</thead>
					        			<tbody>
					        			<?php foreach ($balonAGUASELECT['DATA'] as $list) { ?>
					        				<tr>
					        					<td><?= $list['id_bal'] ?></td>
					        					<td><?= $list['nombre_bal'] ?></td>
					        					<td><?= $list['nota_mar'] ?></td>
					        					<td><?= $list['peso_bal'] ?> KG</td>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->