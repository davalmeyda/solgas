<?php
	session_start();
  $guiatransportistaSELECT = $_SESSION['guiatransportistaSELECT'];
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
              		<span class="fas fa-chevron-left" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',5,'fecha=<?= $fechaB ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="text" value="<?= $fecha ?>" readonly id="theDate" style="display: none" onchange="ajaxCompuesto('content','../controllers/comprobantesController.php',5,'fecha='+this.value)">
                  <span class="fas fa-calendar" onclick="displayCalendar(document.getElementById('theDate'),'yyyy-mm-dd',this);"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<span class="fas fa-chevron-right" onclick="ajaxCompuesto('content','../controllers/comprobantesController.php',5,'fecha=<?= $fechaA ?>')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="fas fa-plus" onclick="modalShow('mdlAddguiatransportista')"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<a class="fas fa-file-pdf" href="../controllers/comprobantesController.php?op=13&fecha=<?= $fecha ?>" target="_BANK"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	</div>
          	</div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="subcontent" class="content">
	<div class="container-fluid">
    <div id="msjGuiatransportista"></div>
	<?php foreach ($guiatransportistaSELECT['DATA'] as $list) { ?>
	    <div class="row">
	    	<div class="col-12">
	            <!--<a class="card" href="../dist/guiatransportista/guiatransportista<?= $list['id_guitra'] ?>.pdf" target="_BLANK" style="color: #000;">-->
              <a class="card" href="javascript:opcionesGuiatransportistaOPEN(<?= $list['id_guitra'] ?>)" style="color: #000">
	            	<div class="card-header" style="border: 0">
	            		<div class="col-12">
	            			<h3 class="card-title">GUÍA DE REMISIÓN -TRANSPORTISTA » <?= $list['serie_ven'] ?>-<?= $list['numero_ven'] ?></h3>
	            		</div>
	            	</div>
	              	<div class="card-body">
              			<div class="row">
              				<div class="col-12">
              					<span class="fas fa-user-alt"></span> <?= $list['nombres_guitra'] ?> <?= $list['ruc_guitra'] ?>
              				</div>
              				<div class="col-12">
              					<span class="fas fa-map-marker-alt"></span> <?= $list['puntopartida_guitra'] ?>
              				</div>
              				<div class="col-12">
              					<span class="fas fa-map-marker"></span> <?= $list['puntollegada_guitra'] ?>
              				</div>
              				<div class="col-12">
              					<span class="fas fa-clock"></span> <?= $list['nfecha_guitra'] ?>
              				</div>
              			</div>
	              	</div>
	            </a>
	    	</div>
	    </div>
	<?php } ?>
  <?php if (count($guiatransportistaSELECT['DATA']) <= 0) { ?>
    <div class="content">
      <div class="row">
        <div class="col">
          <div class="row">
            <div class="col text-center" style="position:relative;">
                <div class="col-4 offset-4">
                  <p class="globo"><span>No se encontraron guías de transportista realizadas en esta fecha</span></p>
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
<div class="modal fade" id="mdlAddguiatransportista">
  <div class="modal-dialog modal-lg">
    <form id="frmGuiatransportista">
      <div class="modal-content">
        <div class="modal-header bg-info" style="border: 0">
          <h4 class="modal-title">Guía de Remisión - Transportista</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-horizontal">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="fecha_guitra">Fecha</label>
                      <input name="fecha_guitra" id="fecha_guitra" class="form-control" type="date" value="<?= date('Y-m-d') ?>" readonly>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="serie_ven">Serie Venta*</label>
                      <input name="serie_ven" id="serie_ven" class="form-control" type="text" maxlength="5" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="numero_ven">Numero Venta*</label>
                      <input name="numero_ven" id="numero_ven" class="form-control" type="number" max="99999" required>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_per" class="col-sm-2 col-form-label">Nombres Transportista*</label>
                  <div class="col-sm-10">
                    <select id="id_per" name="id_per" onchange="sltId_perCHANGE(this.value)"></select>
                    <input type="hidden" id="nombres_guitra" name="nombres_guitra">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ruc_guitra" class="col-sm-2 col-form-label">Ruc</label>
                  <div class="col-sm-4">
                    <input id="ruc_guitra" name="ruc_guitra" class="form-control" type="number" max="99999999999">
                  </div>
                  <label for="placa_guitra" class="col-sm-2 col-form-label">Placa</label>
                  <div class="col-sm-4">
                    <input name="placa_guitra" id="placa_guitra" class="form-control" type="text" maxlength="10" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="puntopartida_guitra" class="col-sm-2 col-form-label">Direccion inicio*</label>
                  <div class="col-sm-10">
                    <input id="puntopartida_guitra" name="puntopartida_guitra" type="text" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="puntollegada_guitra" class="col-sm-2 col-form-label">Direccion llegada*</label>
                  <div class="col-sm-10">
                    <input id="puntollegada_guitra" name="puntollegada_guitra" type="text" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nconstancia_guitra" class="col-sm-2 col-form-label">N constancia*</label>
                  <div class="col-sm-4">
                    <input name="nconstancia_guitra" id="nconstancia_guitra" class="form-control text-right" type="number" max="99999999999999999999" readonly required>
                  </div>
                  <label for="nlicencia_guitra" class="col-sm-2 col-form-label">N licencia*</label>
                  <div class="col-sm-4">
                    <input name="nlicencia_guitra" id="nlicencia_guitra" class="form-control" type="number" max="99999999999999999999">
                  </div>
                </div>
                <div class="form-group row">
                  <button onclick="productoRow()" class="btn btn-outline-info btn-block" type="button">AGREGAR PRODUCTO</button>
                  <div id="divId_bal" style="width: 100%;display: none">
                    <select id="sltId_bal" class="form-control" onchange="productoSelectTra(this.value)"></select>
                  </div>
                  <div id="divBalonesTra" class="table-responsive" style="height: 120px;overflow-y: auto;display: none">
                    <table id="tblBalonesTra" class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width: 110px">Quitar</th>
                          <th>Balon</th>
                          <th>Cantidad</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between text-center">
          <div id="msjmdlProducto">
          </div>
          <button id="btnGuiatransportista" type="submit" class="btn btn-primary" disabled>PROCESAR</button>
          <!--<a type="button" class="btn btn-primary" href="../controllers/comprobantesController.php?op=6" target="_BANK">PROCESAR</a>-->
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlVerOpcionesGuiatransportista">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Comprobante electrónico</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mdlbodyVerOpcionesGuiatransportista">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdlTraking">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">TRACKING DEL USUARIO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mdlbodyTraking">
      </div>
      <div class="modal-footer" id="mdlfooterTraking">
				<div class='row'>
					<div class='col'>
						<button id="btnfooterTraking" onclick='imprim2()' class='btn btn-warning btn-block'>LIGUIDAR</button>
					</div>
					<div class='col'>
						<button onclick="modalHide('mdlTraking')" class='btn btn-ligth btn-block'>CANCELAR</button>
					</div>
				</div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  var frmGuiatransportista = document.getElementById('frmGuiatransportista');
  frmGuiatransportista.addEventListener('submit', function(e) {
    //alert($('#ckxProforma:checked').val());
    e.preventDefault();
      $('#btnGuiatransportista').removeAttr('disabled');
      $('#btnGuiatransportista').attr('disabled',true);
      $('#btnGuiatransportista').text('Guardando...');
      var data = new FormData(frmGuiatransportista);
      data.append('nfilas', $('#tblBalonesTra > tbody > tr').length);
      fetch('../controllers/comprobantesController.php?op=6',{
          method: 'POST',
          body: data
      })
      .then(res => res.json())
      .then(data => {
        var msjGuiatransportista = document.getElementById('msjGuiatransportista');
        if (data.STATUS === 'OK') {
          msjGuiatransportista.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>CORRECTO!</strong> Guia de transportista Agregada con exito.
              <button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxSimple('content','../controllers/comprobantesController.php',5)"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar
              </button>
            </div>
          `;
          frmGuiatransportista.reset();
          modalHide('mdlAddguiatransportista');
          $('#btnGuiatransportista').removeAttr('disabled');
          $('#btnGuiatransportista').text('PROCESAR');
        } else {
          msjGuiatransportista.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>ERROR!</strong> ${data.ERROR}.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `;
          modalHide('mdlAddguiatransportista');
          $('#btnGuiatransportista').removeAttr('disabled');
          $('#btnGuiatransportista').text('PROCESAR');
        }
      })
  })
  $('#id_per').select2({
    placeholder: 'Buscar transportista',
    ajax: {
      url: "../controllers/buscarController.php?op=5",
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
    placeholder: 'Buscar Balon',
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
function imprim2(){
  var printContents = document.getElementById('mdlbodyTraking').innerHTML;
    w = window.open();
    w.document.write('TRACKING DEL USUARIO<br><br>');
    w.document.write(printContents);
    w.document.close(); // necessary for IE >= 10
    w.focus(); // necessary for IE >= 10
    w.print();
    w.close();
    return true;
  }
</script>