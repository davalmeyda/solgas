<?php
	session_start();
  $Sid_per = $_SESSION['ID_PER'];
  $Stipo_per = $_SESSION['TIPO_PER'];
  $ventaSELECT = $_SESSION['ventaSELECT'];
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
                <?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
                  <button onclick="modalShow('mdlFiltro')" class="btn btn-outline-warning btn-xs">&nbsp;&nbsp;&nbsp;FILTRO&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php } ?>
                  <span class="fas fa-chevron-left" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',3,'fecha=<?= $fechaB ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="text" value="<?= $fecha ?>" readonly id="theDate" style="display: none" onchange="ajaxCompuesto('content','../controllers/comprobantesController.php',3,'fecha='+this.value)">
                  <span class="fas fa-calendar" onclick="displayCalendar(document.getElementById('theDate'),'yyyy-mm-dd',this);"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas fa-chevron-right" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',3,'fecha=<?= $fechaA ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas">
                    <li>
                      <a data-toggle="dropdown" href="#" style="color: #212529">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                          <div class="row" onclick="modalShow('mdlBuscarComprobante')">
                            <div class="col-3"><span class="fas fa-search"></span></div>
                            <div class="col-9"><span>Buscar comprobante</span></div>
                          </div>
                        </a>
                        <a href="#" class="dropdown-item">
                          <div class="row" onclick="modalShow('mdlResumendia')">
                            <div class="col-3"><span class="fas fa-bars"></span></div>
                            <div class="col-9"><span>Ver resumen del dia</span></div>
                          </div>
                        </a>
                      </div>
                    </li>
                  </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	</div>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
    <div id="msjhistorialventas"></div>
    <div id='contentVentas'>
  <?php foreach ($ventaSELECT['DATA'] as $list) { ?>
	    <div class="row">
	    	<div class="col-12">
          <?php $bg = 'rgba(255,255,255,1)';$color = ''; ?>
          <?php if ($list['estado_ven'] == 1) {$bg = 'rgba(220,53,69,0.50)';} ?>
          <?php if ($list['estado_ven'] == 3) {$bg = 'rgba(255,193,7,0.50)';} ?>
          <?php if ($list['tipo_comprobante'] == 7) {$color = 'color: #bd2130 !important';} ?>
              <!--<a class="card" href="../dist/comprobantes/<?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?>.pdf" target="_BLANK" style="color: #000">-->
              <a class="card" href="javascript:opcionesComprobanteOPEN(<?= $list['id_ven'] ?>,<?= $Stipo_per ?>)" style="color: #000;background-color: <?= $bg ?>">
	            	<div class="card-header" style="border: 0">
	            		<div class="col-12">
                  <?php if ($list['tipo_comprobante'] == '1') { ?>
                    <h3 class="card-title">FACTURA ELECTRONICA » <?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?></h3>
                  <?php } else if ($list['tipo_comprobante'] == '3') { ?>
                    <h3 class="card-title">BOLETA DE VENTA ELECTRÓNICA » <?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?></h3>
                  <?php } else if ($list['tipo_comprobante'] == '7') { ?>
                    <h3 class="card-title">NOTA DE CRÉDITO ELECTRÓNICA » <?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?></h3>
                  <?php } else if ($list['tipo_comprobante'] == '8') { ?>
                    <h3 class="card-title">NOTA DE DÉBITO ELECTRÓNICA » <?= $list['serie_ven'] ?>-<?= $list['correlativo_ven'] ?></h3>
                  <?php } ?>
	            		</div>
	            	</div>
	              	<div class="card-body">
              			<div class="row">
                      <div class="col-10">
                        <div class="col-12">
                          <span class="fas fa-user-alt"></span> <?= $list['nombres_cli'] ?> (<?= $list['numdoc_cli'] ?>)
                        </div>
                        <div class="col-12">
                          <span class="fas fa-clock"></span> <?= $list['nfecini_ven'] ?>
                        </div>
                      </div>
                      <div class="col-2">
                        <span style="font-size: 15pt;<?= $color ?>" class="text-success">S/ <span style="font-size: 20pt;"><?= $list['total_ven'] ?></span></span>
                      </div>
              			</div>
	              	</div>
	            </a>
	    	</div>
	    </div>
	<?php } ?>
  <?php if (count($ventaSELECT['DATA']) <= 0) { ?>
      <div class="content">
        <div class="row">
          <div class="col">
            <div class="row">
              <div class="col text-center" style="position:relative;">
                  <div class="col-4 offset-4">
                    <p class="globo"><span>No se encontraron comprobantes realizados en esta fecha</span></p>
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
</div>
<div class="modal fade" id="mdlBuscarComprobante">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">BUSCAR COMPROBANTE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="tipo">Tipo &nbsp;&nbsp;&nbsp;</label>
              <select class="form-control" id="tipo">
                <option>FACTURA ELECTRONICA</option>
                <option>BOLETA DE VENTA ELECTRÓNICA</option>
                <option>NOTA DE CRÉDITO ELECTRÓNICA</option>
                <option>NOTA DE DÉBITO ELECTRÓNICA</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="serie">SERIE</label>
              <input class="form-control" type="text" id="serie">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="numero">NUMERO</label>
              <input class="form-control" type="number" id="numero">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlResumendia">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">RESUMEN</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-horizontal pl-2 pr-2">
          <div class="col-12 form-control bg-light mb-1">
            <div class="row">
              <div class="col">
                <span>FACTURA</span>
              </div>
              <div class="col text-right">
                <span>S/ 0.00</span>
              </div>
            </div>
          </div>
          <div class="col-12 form-control bg-light mb-1">
            <div class="row">
              <div class="col">
                <span>BOLETAS</span>
              </div>
              <div class="col text-right">
                <span>S/ 0.00</span>
              </div>
            </div>
          </div>
          <div class="col-12 form-control bg-light mb-1">
            <div class="row">
              <div class="col">
                <span>NOTAS DE CRÉDITO</span>
              </div>
              <div class="col text-right">
                <span>S/ 0.00</span>
              </div>
            </div>
          </div>
          <div class="col-12 form-control bg-light mb-1">
            <div class="row">
              <div class="col">
                <span>NOTAS DE DÉBITO</span>
              </div>
              <div class="col text-right">
                <span>S/ 0.00</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlVerOpcionesVentas">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Comprobante electrónico</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mdlbodyVerOpcionesVentas">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlFiltro">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Comprobante electrónico</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmFiltro" class="p-2 pb-3" onsubmit="filtrarVentas(event,'<?= $fecha ?>')">
          <div class="row">
            <div class="col">
              <label>Cliente</label>
              <select id="id_cli" name="id_cli" class="form-control input-sm">
                <option value="">----</option>
              </select>
            </div>
            <div class="col">
              <label>Trabajadores</label>
              <select id="id_per" name="id_per" class="form-control input-sm">
                <option value="">----</option>
              </select>
            </div>
            <div class="col">
              <label>Tipo de Balones</label>
              <select id="tipo_bal" name="tipo_bal" class="form-control input-sm">
                <option value="">TODOS</option>
                <option value="PREMIUN">GAS PREMIUN</option>
                <option value="NORMAL">GAS NORMAL</option>
                <option value="AGUA">AGUA</option>
              </select>
            </div>
          </div><br>
          <div class="row">
            <div class="col">
              <div class="radio">
                <label><input type="radio" name="optradio" value="" checked>Todos</label>
              </div>
            </div>
            <div class="col">
              <div class="radio">
                <label><input type="radio" name="optradio" value="1">Credito</label>
              </div>
            </div>
            <div class="col">
              <div class="radio">
                <label><input type="radio" name="optradio" value="0">Contato</label>
              </div>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-info">Aceptar</button>
            </div>
            <div class="col">
              <button type="button" onclick="filtrarVentasReset('<?= $fecha ?>')" class="btn btn-info">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  $('#id_per').select2({
    placeholder: 'Buscar Personal',
    ajax: {
      url: "../controllers/buscarController.php?op=4",
      dataType: 'json',
      quietMillis: 100,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public'
        }
        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      results: function (data, page) {
        return { results: data.results };
      }
    },
  });
  $('#id_cli').select2({
    placeholder: 'Buscar Cliente',
    ajax: {
      url: "../controllers/buscarController.php?op=1",
      dataType: 'json',
      quietMillis: 100,
      data: function (params) {
        var query = {
          search: params.term,
          type: 'public'
        }
        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      results: function (data, page) {
        return { results: data.results };
      }
    },
  });
</script>