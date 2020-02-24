<?php
  	session_start();
	$pedidosCliente = $_SESSION['pedidosCliente'];
	$ventasCliente = $_SESSION['ventasCliente'];
?>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MIS PEDIDOS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
		    <button onclick="ajaxPagina('content','../cliente/vstPedidosPrincipal.php');" class="btn btn-primary btn-sm">REALIZAR PEDIDO</button>
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
		                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">PENDIENTES</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">ACEPTADOS</a>
		                  </li>
		                </ul>
		            </div>
	            	<div class="card-body">
	            		<div class="tab-content" id="custom-tabs-two-tabContent">
                  			<div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
					        	<div class="table-responsive">
									<table class="table table-striped tblCliente">
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
													<td><?= $list['id_ped'] ?></td>
													<td>PEDIDO</td>
													<td><?= $list['serie'] ?></td>
													<td><?= $list['fecini_ped'] ?></td>
													<td><?= $list['total_ped'] ?></td>
													<td><a href="../../dist/pedidos/pedido<?= $list['id_ped'] ?>.pdf" target="_BLANK" class="btn btn-outline-info"><span class="fas fa-eye"></span></a></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
			                    <div class="table-responsive">
									<table class="table table-striped tblCliente">
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
											<?php foreach ($ventasCliente['DATA'] as $list) { ?>
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
												<?php if ($list['tipo_comprobante'] == 7) { ?>
													<td>NOTA DE CREDITO</td>
												<?php } ?>
													<td><?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?></td>
													<td><?= $list['fecini_ven'] ?></td>
													<td><?= $list['total_ven'] ?></td>
												<?php if ($list['tipo_comprobante'] == 2) { ?>
													<td><a href="../../dist/proformas/proforma<?= $list['id_com'] ?>.pdf" target="_BLANK" class="btn btn-outline-info"><span class="fas fa-eye"></span></a></td>
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
			</div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
	<script>
	$(function () {
		$(".tblCliente").DataTable({"order": [[3, "desc"]]});
		$(".tblCliente").removeAttr('style');
	});
	</script>