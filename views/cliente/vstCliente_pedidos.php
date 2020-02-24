<?php
  	session_start();
	$pedidosCliente = $_SESSION['pedidosCliente'];
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
	            <div class="card card-primary card-outline">
	            	<div class="card-header">
	            		<div class="col-12">
	            			<h3 class="card-title">MIS PEDIDOS</h3>
		            		<div class="col-12 text-right">
		            			<button onclick="ajaxPagina('content','../cliente/vstPedidosPrincipal.php');" class="btn btn-primary btn-sm">REALIZAR PEDIDO</button>
		            		</div>
	            		</div>
	            	</div>
	            	<div class="card-body">
	            		<div class="table-responsive">
	            			<table class="table table-striped">
	            				<thead>
	            					<tr>
	            						<td>ID</td>
	            						<td>COMPROBANTE</td>
	            						<td>SERIE</td>
	            						<td>FECHA</td>
	            						<td>TOTAL</td>
	            						<td>VER PDF</td>
	            					</tr>
	            				</thead>
	            				<tbody>
	            					<?php foreach ($pedidosCliente['DATA'] as $list) { ?>
	            						<tr>
	            							<td><?= $list['id_com'] ?></td>
	            						<?php if ($list['tipo_comprobante'] == 1) { ?>
	            							<td>FACTURA ELECTRÓNICA</td>
	            						<?php } ?>
	            						<?php if ($list['tipo_comprobante'] == 2) { ?>
	            							<td>PROFORMA</td>
	            						<?php } ?>
	            						<?php if ($list['tipo_comprobante'] == 3) { ?>
	            							<td>BOLETA DE VENTA ELECTRÓNICA</td>
	            						<?php } ?>
	            						<?php if ($list['tipo_comprobante'] == 4) { ?>
	            							<td>PEDIDO</td>
	            						<?php } ?>
	            						<?php if ($list['tipo_comprobante'] == 7) { ?>
	            							<td>NOTA DE CREDITO</td>
	            						<?php } ?>
	            							<td><?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?></td>
	            							<td><?= $list['fecini_ven'] ?> KG</td>
	            							<td><?= $list['total_ven'] ?></td>
	            						<?php if ($list['tipo_comprobante'] == 2) { ?>
	            							<td><a href="../../dist/proformas/proforma<?= $list['id_com'] ?>.pdf" target="_BLANK" class="btn btn-outline-info"><span class="fas fa-eye"></span></a></td>
	            						<?php } else if ($list['tipo_comprobante'] == 4) { ?>
	            							<td><a href="../../dist/pedidos/pedido<?= $list['id_com'] ?>.pdf" target="_BLANK" class="btn btn-outline-info"><span class="fas fa-eye"></span></a></td>
	            						<?php } else { ?>
	            							<td><a href="../../dist/comprobantes/<?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?>.pdf" target="_BLANK" class="btn btn-outline-info"><span class="fas fa-eye"></span></a></td>
	            						<?php } ?>
	            						</tr>
	            					<?php } ?>
	            				</tbody>
	            			</table>
	            		</div>
			        </div>
			    </div>
			</div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->