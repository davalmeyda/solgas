<?php
    session_start();
    $Stipo_per = $_SESSION['TIPO_PER'];
    $Stipo_user = $_SESSION['TIPO_USER'];
    $prestamoDATA = $_SESSION['prestamoDATA'];
    $balon_prestamoSELECT = $_SESSION['balon_prestamoSELECT'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">DETALLE DE PRÉSTAMO</h3><span id="fecha_pre"><?= $prestamoDATA['DATA'][0]['fecha_pre'] ?></span>
                        <?php if (isset($prestamoDATA['DATA'][0]['fecreg_pre'])) { ?> al <span id="fecreg_pre"></span><?php } ?>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/prestamoController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="txtNombres_cli">CLIENTE &nbsp;&nbsp;&nbsp;</label>
                                    <input class="form-control" type="text" id="txtNombres_cli" value="<?= $prestamoDATA['DATA'][0]['nombres_cli'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="txtNombres_per">PERSONAL</label>
                                    <input class="form-control" type="text" id="txtNombres_per" value="<?= $prestamoDATA['DATA'][0]['nombres_per'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="txaMotivo_pre">MOTIVO</label>
                                    <textarea id="txaMotivo_pre" class="form-control" disabled><?= $prestamoDATA['DATA'][0]['motivo_pre'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="divBalones">BALONES</label>
                                    <div id="msjModalBalonprestamoDetalle"></div>
                                    <div id="divBalones" class="table-responsive">
                                        <table id="tblBalones" class="table table-striped">
                                            <thead>
                                                <tr>
                                                <?php
                                                    $fecha_actual = date("Y-m-d H:i:00",strtotime(date("Y-m-d H:i:00")."- 1 days"));
                                                    $fecha_actual = strtotime($fecha_actual);
                                                    $fecha_entrada = strtotime($prestamoDATA['DATA'][0]['fecha_pre']);
                                                    if ($Stipo_per == '1') {
                                                ?>
                                                        <th class="text-center">ACCIÓN</th>
                                                <?php } else if ($Stipo_per == '2' && $fecha_actual < $fecha_entrada) { ?>
                                                    <th class="text-center">ACCIÓN</th>
                                                <?php } ?>
                                                    <th class="text-center">ID</th>
                                                    <th>NOMBRE</th>
                                                    <th class="text-center">TIPO</th>
                                                    <th class="text-center">MARCA</th>
                                                    <th class="text-center">CANTIDAD</th>
                                                    <th class="text-center">INICIO</th>
                                                    <th class="text-center">PROVEEDOR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($balon_prestamoSELECT['DATA'] as $listBalones) { ?>
                                                <tr>
                                                <?php if ($Stipo_per == '1') { ?>
                                                    <td>
                                                        <button onclick="mdlMostrarPrestamoDetalle(<?= $listBalones['id_balpre'] ?>,<?= $listBalones['id_bal'] ?>,'<?= $listBalones['nombre_bal'] ?>')" class="btn btn-outline-info btn btn-sm" type="button">
                                                            <span class="fas fa-eye"></span>
                                                        </button>
                                                    </td>
                                                <?php } else if ($Stipo_per == '2' && $fecha_actual < $fecha_entrada) { ?>
                                                    <td>
                                                        <button onclick="mdlMostrarPrestamoDetalle(<?= $listBalones['id_balpre'] ?>)" class="btn btn-outline-secondary btn btn-sm">
                                                            <span class="fas fa-eye"></span>
                                                        </button>
                                                    </td>
                                                <?php } ?>
                                                    <td class="text-center"><?= $listBalones['id_bal'] ?></td>
                                                    <td><?= $listBalones['nombre_bal'] ?></td>
                                                    <td class="text-center"><?= $listBalones['tipo_bal'] ?></td>
                                                    <td class="text-center"><?= $listBalones['marca_bal'] ?></td>
                                                    <td class="text-center"><?= $listBalones['cantidad_balpre'] ?> de <?= $listBalones['total_balpre'] ?></td>
                                                    <td class="text-center"><?= $listBalones['fecini_balpre'] ?></td>
                                                    <!--<td class="text-center"><?= $listBalones['fecfin_balpre'] ?></td>
                                                <?php if ($listBalones['estado_balpre'] == 1) { ?>
                                                    <td class="text-center text-success">EN USO</td>
                                                <?php } else { ?>
                                                    <td class="text-center text-danger">TERMINADO</td>
                                                <?php } ?>-->
                                                    <td class="text-center"><?= $listBalones['razsoc_prov'] ?></td>
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
    </div>
</div>
<div class="modal fade" id="mdlMostrarPrestamoDetalle">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">DETALLE DE PRESTAMO - <span id="spnNombre_bal"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-horizontal">
                            <input type="hidden" id="id_balpre" name="id_balpre">
                            <div class="table-responsive">
                                <table id="tblBalonxu_prestamo" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Nro</td>
                                            <td>Cod barras</td>
                                            <td>Ingreso</td>
                                            <td>Salida</td>
                                            <td>Estado</td>
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
    </div>
</div>
<script>
    var frmModificarcantidad = document.getElementById('frmModificarcantidad');
    frmModificarcantidad.addEventListener('submit', function(e) {
        e.preventDefault();
        var data = new FormData(frmModificarcantidad);
        data.append('id_pre', <?= $prestamoDATA['DATA'][0]['id_pre'] ?>);
        fetch('../controllers/prestamoController.php?op=5',{
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(data => {
      var msjModalBalonprestamoDetalle = document.getElementById('msjModalBalonprestamoDetalle');
      if (data.STATUS === 'OK') {
        msjModalBalonprestamoDetalle.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Detalle de prestamo modificado correctamente.
            <button class="btn btn-sm btn-outline-light" style="float: right;" onclick="ajaxCompuesto('subcontent','../controllers/prestamoController.php',3,'id_pre=<?= $prestamoDATA['DATA'][0]['id_pre'] ?>')"><span class="fas -fa-sync-alt"></span>&nbsp;&nbsp;Refrescar
            </button>
          </div>
        `;
        $('#editada_balpre').val('');
        modalHide('mdlMostrarPrestamoDetalle');
      } else {
        msjModalBalonprestamoDetalle.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido modificar el prestamo.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
        modalHide('mdlMostrarPrestamoDetalle');
      }
        })
    })
</script>