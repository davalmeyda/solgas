<?php
  session_start();
  $templeadoSELECT = $_SESSION['templeadoSELECT'];
  $personalDATA = $_SESSION['personalDATA'];
?>
<div class="container-fluid">
    <div class="row">
    	<div class="col-12">
            <div class="card">
            	<div class="card-header">
            		<div class="col-12">
            			<h3 class="card-title">MODIFICAR CLIENTES</h3>
            		</div>
            		<div class="col-12 text-right">
            			<button onclick="ajaxSimple('content','../controllers/personalController.php',1)" class="btn btn-warning btn-sm"><span class="fas fa-angle-left"></span> REGRESAR</button>
            		</div>
            	</div>
              	<div class="card-body">
              		<form id="frmPersonalUPDATE" action="#" method="post">
                    <input type="hidden" name="id_per" value="<?= $personalDATA['DATA'][0]['id_per'] ?>">
                    <div class="form-group">
                      <label for="sltTipo_per">TIPO EMPLEADO</label>
                      <select class="form-control" id="sltTipo_per" name="sltTipo_per">
                      <?php foreach ($templeadoSELECT['DATA'] as $list) { ?>
                        <option value="<?= $list['id_temp'] ?>"><?= $list['nota_temp'] ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group row">
                      <div class="col-4">
                        <label for="sltTipdoc_per">TIPO DOCUMENTO</label>
                        <select class="form-control" id="sltTipdoc_per" name="sltTipdoc_per">
                          <option value="DNI">DNI</option>    
                          <option value="OTROS">OTROS</option>    
                        </select>
                      </div>
                      <div class="col-8">
                        <label for="nbrNumdoc_per">NÚMERO DOCUMENTO</label>
                        <input type="number" class="form-control" id="nbrNumdoc_per" name="nbrNumdoc_per" value="<?= $personalDATA['DATA'][0]['numdoc_per'] ?>" placeholder="Digitar el número de documentos" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm">
                        <label for="txtNombre_per">NOMBRE</label>
                        <input type="text" class="form-control" id="txtNombre_per" name="txtNombre_per" value="<?= $personalDATA['DATA'][0]['nombre_per'] ?>" placeholder="Digitar nombre" required>
                      </div>
                      <div class="col-sm">
                        <label for="txtApellido_per">APELLIDO</label>
                        <input type="text" class="form-control" id="txtApellido_per" name="txtApellido_per" value="<?= $personalDATA['DATA'][0]['apellido_per'] ?>" placeholder="Digitar apellido" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm">
                        <label for="fecing_per">FECHA INGRESO</label>
                        <input type="date" class="form-control" id="fecing_per" name="fecing_per" value="<?= $personalDATA['DATA'][0]['fecing_per'] ?>" required>
                      </div>
                      <div class="col-sm">
                        <label for="fecnac_per">FECHA NACIMIENTO</label>
                        <input type="date" class="form-control" id="fecnac_per" name="fecnac_per" value="<?= $personalDATA['DATA'][0]['fecnac_per'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="correo_per">CORREO</label>
                      <input type="email" maxlength="50" class="form-control" id="correo_per" name="correo_per" value="<?= $personalDATA['DATA'][0]['correo_per'] ?>" placeholder="Digitar correo" required>
                    </div>
                    <div class="form-group">
                      <label for="direccion_per">DIRECCION DOMICILIO</label>
                      <textarea maxlength="300" class="form-control" id="direccion_per" name="direccion_per" placeholder="Digitar direccion" required><?= $personalDATA['DATA'][0]['direccion_per'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="txtNacionalidad_per">NACIONALIDAD</label>
                      <input type="text" class="form-control" id="txtNacionalidad_per" name="txtNacionalidad_per" value="<?= $personalDATA['DATA'][0]['nacionalidad_per'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="foto_per">FOTO DNI</label>
                      <div class="row">
                        <label class="switch">
                          <input id="ckxFoto_per" name="ckxFoto_per" type="checkbox" class="primary" checked>
                          <span class="slider round"></span>
                        </label>
                        <div class="col">
                          <img src="../dist/img/personal/<?= $personalDATA['DATA'][0]['foto_per'] ?>" width="50" height="75">
                          <input type="hidden" id="foto_perOLD" name="foto_perOLD" value="<?= $personalDATA['DATA'][0]['foto_per'] ?>">
                        </div>
                        <div class="col" style="display: none">
                          <input type="file" class="form-control-file" id="foto_per" name="foto_per" placeholder="Digitar nacionalidad">
                        </div>
                      </div>
                    </div>
                  <?php if ($personalDATA['DATA'][0]['licencia_per'] == '') { ?>
                    <div class="form-group">
                      <label for="licencia_per">LICENCIA</label>
                      <div class="row">
                        <label class="switch">
                          <input id="ckxLicencia_per" name="ckxLicencia_per" type="checkbox" class="primary">
                          <span class="slider round"></span>
                        </label>
                        <div class="col" style="display: none">
                          <input type="text" maxlength="15" class="form-control" name="licencia_per" id="licencia_per" placeholder="Digitar licencia">
                        </div>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="form-group">
                      <label for="licencia_per">LICENCIA</label>
                      <div class="row">
                        <label class="switch">
                          <input id="ckxLicencia_per" name="ckxLicencia_per" type="checkbox" class="primary" checked>
                          <span class="slider round"></span>
                        </label>
                        <div class="col">
                          <input type="text" maxlength="15" class="form-control" name="licencia_per" id="licencia_per" value="<?= $personalDATA['DATA'][0]['licencia_per'] ?>" placeholder="Digitar licencia" required>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                    <div class="form-group">
                      <label for="tipo_contrato">TIPO CONTRATO</label>
                      <select class="form-control" id="tipo_contrato" name="tipo_contrato">
                        <option value="1">SIN CONTRATO</option>    
                        <option value="2">PLANILLA</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tipo_user">TIPO USUARIO</label>
                      <select class="form-control" id="tipo_user" name="tipo_user" onchange="tipo_userCHANGE(this.value)">
                        <option value="3">NINGUNO</option>
                        <option value="1">DE EDICION</option>
                        <option value="2">NORMAL</option>
                      </select>
                    </div>
                  <?php if ($personalDATA['DATA'][0]['tipo_user'] == '3') { ?>
                    <div id="divRegistro" style="display: none">
                    <div class="form-group">
                      <label for="txtUsuario_per">USUARIO</label>
                      <input type="text" class="form-control" id="txtUsuario_per" name="txtUsuario_per"  value="<?= $personalDATA['DATA'][0]['usuario_per'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="pwdClave_per">CLAVE</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="pwdClave_per" name="pwdClave_per" value="<?= $personalDATA['DATA'][0]['clave_per'] ?>">
                        <div class="input-group-prepend">
                          <div id="divClave_per" class="input-group-text" onclick="$('#pwdClave_per').attr('type','text');"><span class="fas fa-eye"></span></div>
                        </div>
                      </div>
                    </div>
                    </div>
                  <?php } else { ?>
                    <div id="divRegistro">
                    <div class="form-group">
                      <label for="txtUsuario_per">USUARIO</label>
                      <input type="text" class="form-control" id="txtUsuario_per" name="txtUsuario_per"  value="<?= $personalDATA['DATA'][0]['usuario_per'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="pwdClave_per">CLAVE</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="pwdClave_per" name="pwdClave_per" value="<?= $personalDATA['DATA'][0]['clave_per'] ?>" required>
                        <div class="input-group-prepend">
                          <div id="divClave_per" class="input-group-text" onclick="$('#pwdClave_per').attr('type','text');"><span class="fas fa-eye"></span></div>
                        </div>
                      </div>
                    </div>
                    </div>
                  <?php } ?>
              			<button type="submit" class="btn btn-primary">MODIFICAR</button>
                    <div class="row"><div id="mensajePersonalUPDATE" class="col-12 mt-2"></div></div>
              		</form>
              	</div>
            </div>
        </div>
    </div>
</div>
<script>
  document.getElementById('ckxLicencia_per').addEventListener('change', function(e) {
    e.preventDefault();
    if ($(this).is(':checked')) {
      $('#licencia_per').parent().css('display','')
      $('#licencia_per').attr('required',true)
    } else {
      $('#licencia_per').parent().css('display','none')
      $('#licencia_per').removeAttr('required')
    }
  })
  document.getElementById('ckxFoto_per').addEventListener('change', function(e) {
    e.preventDefault();
    if ($(this).is(':checked')) {
      $('#foto_per').parent().css('display','none')
      $('#foto_perOLD').parent().css('display','')
      $('#foto_per').removeAttr('required')
    } else {
      $('#foto_per').parent().css('display','')
      $('#foto_perOLD').parent().css('display','none')
      $('#foto_per').attr('required',true)
    }
  })
  $("#sltTipo_per option[value='<?= $personalDATA['DATA'][0]['id_temp'] ?>']").attr("selected",true);
  $("#sltTipdoc_per option[value='<?= $personalDATA['DATA'][0]['tipdoc_per'] ?>']").attr("selected",true);
  $("#tipo_contrato option[value='<?= $personalDATA['DATA'][0]['tipo_contrato'] ?>']").attr("selected",true);
  $("#tipo_user option[value='<?= $personalDATA['DATA'][0]['tipo_user'] ?>']").attr("selected",true);
	var frmPersonalUPDATE = document.getElementById('frmPersonalUPDATE');
	frmPersonalUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmPersonalUPDATE);
		fetch('../controllers/personalController.php?op=4',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
			console.log(data.STATUS);
      var mensajePersonalUPDATE = document.getElementById('mensajePersonalUPDATE');
      if (data.STATUS === 'OK') {
        mensajePersonalUPDATE.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>CORRECTO!</strong> Personal modificado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;

      } else {
        mensajePersonalUPDATE.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ERROR!</strong> No se ha podido modificar personal.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `;
      }
		})
	})
</script>