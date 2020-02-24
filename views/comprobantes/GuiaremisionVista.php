<?php
	session_start();
  $guiaremisionSELECT = $_SESSION['guiaremisionSELECT'];
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
              		<span class="fas fa-chevron-left" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',2,'fecha=<?= $fechaB ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="text" value="<?= $fecha ?>" readonly id="theDate" style="display: none" onchange="ajaxCompuesto('content','../controllers/comprobantesController.php',2,'fecha='+this.value)">
                  <span class="fas fa-calendar" onclick="displayCalendar(document.getElementById('theDate'),'yyyy-mm-dd',this);"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas fa-chevron-right" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',2,'fecha=<?= $fechaA ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas fa-plus" onclick="modalShow('mdlAddguiaremision')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	</div>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
    <div id="msjGuiaremision"></div>
	<?php foreach ($guiaremisionSELECT['DATA'] as $list) { ?>
	    <div class="row">
	    	<div class="col-12">
	            <!--<a class="card" href="../dist/guiaremision/guiaremision<?= $list['id_gui'] ?>.pdf" target="_BLANK" style="color: #000;">-->
              <a class="card" href="javascript:opcionesGuiaremisionOPEN(<?= $list['id_gui'] ?>)" style="color: #000">
	            	<div class="card-header" style="border: 0">
	            		<div class="col-12">
	            			<h3 class="card-title">GUIA DE REMISIÓN » <?= $list['serie_gui'] ?>-<?= $list['correlativo_gui'] ?></h3>
	            		</div>
	            	</div>
	              	<div class="card-body">
              			<div class="row">
              				<div class="col-12">
              					<span class="fas fa-user-alt"></span> <?= $list['nombres_cli'] ?> (<?= $list['numdoc_cli'] ?>)
              				</div>
              				<div class="col-12">
              					<span class="fas fa-map-marker-alt"></span> <?= $list['nombre_ubiori'] ?>
              				</div>
              				<div class="col-12">
              					<span class="fas fa-map-marker"></span> <?= $list['nombre_ubides'] ?>
              				</div>
              				<div class="col-12">
              					<span class="fas fa-clock"></span> <?= $list['nfecemi_gui'] ?>
              				</div>
              			</div>
	              	</div>
	            </a>
	    	</div>
	    </div>
	<?php } ?>
  <?php if (count($guiaremisionSELECT['DATA']) <= 0) { ?>
    <div class="content">
      <div class="row">
        <div class="col">
          <div class="row">
            <div class="col text-center" style="position:relative;">
                <div class="col-4 offset-4">
                  <p class="globo"><span>No se encontraron guías realizadas en esta fecha</span></p>
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
<div class="modal fade" id="mdlAddguiaremision">
  <div class="modal-dialog modal-lg">
    <form id="frmGuiaremision">
      <div class="modal-content">
        <div class="modal-header bg-info" style="border: 0">
          <h4 class="modal-title">Guía de Remisión - Remitente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card card-info card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Información básica</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Datos del envío</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-thre" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Productos</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="serie">Serie</label>
                      <input name="serie" id="serie" class="form-control" type="text" value="T001" readonly>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="fecemi">Fecha de emision</label>
                      <input name="fecemi" id="fecemi" class="form-control" type="date" value="<?= date('Y-m-d') ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="id_cli">Destinatario*</label>
                      <select id="id_cli" name="id_cli" onchange="frmGuiaremisionVALIDATE()" class="form-control" required>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="observaciones">Observaciones</label>
                      <input name="observaciones" id="observaciones" class="form-control" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Origen</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Destino</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="ubigeoori">Ubigeo*</label>
                      <select class="ubigeo form-control" id="ubigeoori" name="ubigeoori" onchange="frmGuiaremisionVALIDATE()" required>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="ubigeodes">Ubigeo*</label>
                      <select class="ubigeo form-control" id="ubigeodes" name="ubigeodes" onchange="frmGuiaremisionVALIDATE()" required>                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="direccionori">Dirección*</label>
                      <input name="direccionori" id="direccionori" onkeyup="frmGuiaremisionVALIDATE()" class="form-control" type="text" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="direcciondes">Dirección*</label>
                      <input name="direcciondes" id="direcciondes" onkeyup="frmGuiaremisionVALIDATE()" class="form-control" type="text" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-two">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="tipenvio">Tipo del envio</label>
                      <select class="form-control" id="tipenvio" name="tipenvio">
                        <option value="0">OTROS</option>
                        <option value="1" selected>VENTAS</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="fecenvio">Fecha del envio*</label>
                      <input name="fecenvio" id="fecenvio" class="form-control" type="date" value="<?= date('Y-m-d') ?>" onchange="frmGuiaremisionVALIDATE()" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="cantbultos">Cantidad de bultos*</label>
                      <input name="cantbultos" id="cantbultos" onkeyup="frmGuiaremisionVALIDATE()"  onchange="frmGuiaremisionVALIDATE()" class="form-control" type="number" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="peso">Peso total en kilogramos*</label>
                      <input name="peso" id="peso" class="form-control" onkeyup="frmGuiaremisionVALIDATE()" onchange="frmGuiaremisionVALIDATE()" type="number" step="0.01" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    TRASLADO
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="movilidad">Movilidad</label>
                      <select class="form-control" id="movilidad" name="movilidad">
                        <option value="PUBLICO">TRANSPORTE PUBLICO</option>
                        <option value="PRIVADO">TRANSPORTE PRIVADO</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    TRANSPORTISTA
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="id_per">Empresa de transporte*</label>
                      <select id="id_per" name="id_per" onchange="frmGuiaremisionVALIDATE()" class="form-control" required>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-thre">
                <div id="divBalones" class="table-responsive" style="display: none">
                  <table id="tblBalones" class="table table-striped">
                    
                  </table>
                </div>
                <button onclick="productoRow()" class="btn btn-outline-info btn-block" type="button">AGREGAR PRODUCTO</button>
                <div id="divId_bal" style="display: none">
                  <select id="sltId_bal" class="form-control" onchange="productoSelect(this.value)"></select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between text-center">
          <div id="msjmdlProducto">
          </div>
          <button id="btnGuiaremision" type="submit" class="btn btn-primary" disabled="true">PROCESAR</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlVerOpcionesGuiaremision">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Comprobante electrónico</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mdlbodyVerOpcionesGuiaremision">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  var frmGuiaremision = document.getElementById('frmGuiaremision');
  frmGuiaremision.addEventListener('submit', function(e) {
    //alert($('#ckxProforma:checked').val());
    e.preventDefault();
      var data = new FormData(frmGuiaremision);
      data.append('nfilas', $('#tblBalones > .trBalones').length);
      fetch('../controllers/comprobantesController.php?op=4',{
          method: 'POST',
          body: data
      })
      .then(res => res.json())
      .then(data => {
        var msjGuiaremision = document.getElementById('msjGuiaremision');
        if (data.STATUS === 'OK') {
          msjGuiaremision.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>CORRECTO!</strong> Guia de remision Agregada con exito.
              <button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/comprobantesController.php',2)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar
              </button>
            </div>
          `;
          frmGuiaremision_CLEAN();
          modalHide('mdlAddguiaremision');
        } else {
          msjGuiaremision.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>ERROR!</strong> ${data.ERROR}.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `;
          modalHide('mdlAddguiaremision');
        }
      })
  })
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
  $('.ubigeo').select2({
    placeholder: 'Buscar Ubigeo',
    ajax: {
      url: "../controllers/buscarController.php?op=3",
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
  $('#id_per').select2({
    placeholder: 'Buscar Ubigeo',
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
  $('#sltId_bal').select2({
    placeholder: 'Buscar Ubigeo',
    ajax: {
      url: "../controllers/buscarController.php?op=2",
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