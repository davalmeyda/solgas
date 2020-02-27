<?php
  session_start();
  $Sid_per = $_SESSION['ID_PER'];
  $Stipo_per = $_SESSION['TIPO_PER'];
  $pedidosSELECT = $_SESSION['pedidosSELECT'];
	date_default_timezone_set("America/Lima");
  $nfecha = $_GET['nfecha'];
  $fecha = $_GET['fecha'];
  $fechaA = date("Y-m-d",strtotime($fecha."+ 1 days"));
  $fechaB = date("Y-m-d",strtotime($fecha."- 1 days"));
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0 text-dark" style="text-transform: uppercase;"><?= $nfecha ?></h1>
          	</div><!-- /.col -->
          	<div class="col-sm-6">
            	<div class="breadcrumb float-sm-right" style="font-size: 1.4rem">
              		<span class="fas fa-chevron-left" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',14,'fecha=<?= $fechaB ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="text" value="<?= $fecha ?>" readonly id="theDate" style="display: none" onchange="ajaxCompuesto('content','../controllers/comprobantesController.php',14,'fecha='+this.value)">
              		<span class="fas fa-calendar" onclick="displayCalendar(document.getElementById('theDate'),'yyyy-mm-dd',this);"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas fa-chevron-right" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',14,'fecha=<?= $fechaA ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas fa-plus" onclick="ajaxCompuesto('content','../controllers/ventasController.php',1,'pro=1')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	</div>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
  <?php foreach ($pedidosSELECT['DATA'] as $list) { ?>
	    <div class="row">
	    	<div class="col-12">
          <?php if ($list['estado_ped'] == 0) {$color = 'rgba(220,53,69,0.50)';} ?>
          <?php if ($list['estado_ped'] == 1) {$color = 'rgba(255,255,255,1)';} ?>
          <?php if ($list['estado_ped'] == 2) {$color = 'rgba(40,167,69,0.50)';} ?>
              <!--<a class="card" href="../dist/proformas/proforma<?= $list['id_ped'] ?>.pdf" target="_BLANK" style="color: #000;">-->
              <a class="card" href="javascript:opcionesPedidosOPEN(<?= $list['id_ped'] ?>,<?= $Stipo_per ?>)" style="color: #000;background-color: <?= $color ?>">
	            	<div class="card-header" style="border: 0">
	            		<div class="col-12">
	            			<h3 class="card-title">PEDIDO » <?= $list['serie'] ?></h3>
	            		</div>
	            	</div>
              	<div class="card-body">
            		  <div class="row">
                    <div class="col-12">
                      <span class="fas fa-user-alt"></span> <?= $list['nombres_cli'] ?> (<?= $list['numdoc_cli'] ?>)
                    </div>
                    <div class="col-12">
                      <span class="fas fa-clock"></span> <?= $list['nfecini_ped'] ?>
                    </div>
                  </div>
                </div>
	            </a>
	    	</div>
	    </div>
	<?php } ?>
  <?php if (count($pedidosSELECT['DATA']) <= 0) { ?>
    <div class="content">
      <div class="row">
        <div class="col">
          <div class="row">
            <div class="col text-center" style="position:relative;">
                <div class="col-4 offset-4">
                  <p class="globo"><span>No se encontraron pedidos realizados en esta fecha</span></p>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col text-center">
              <img src="../dist/img/avatarkeyfacil.png" width="250">
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
	</div>
</div>
<div class="modal fade" id="mdlVerOpcionesProforma">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Proforma</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mdlbodyVerOpcionesProforma">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>