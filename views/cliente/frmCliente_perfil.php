<?php
session_start();
$clienteDATA = $_SESSION['clienteDATA'];
?>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MI PERFIL</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Perfil</li>
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
	            		<div class="card-body box-profile">
			                <!--<div class="text-center">
			                  <img class="profile-user-img img-fluid img-circle"
			                       src="../dist/img/personal/"
			                       alt="User profile picture" style="width: 100px; height: 100px">
			                </div>-->
			                <h3 class="profile-username text-center"><?= $clienteDATA['DATA'][0]['nombres_cli'] ?></h3>
			                <p class="text-muted text-center">CLIENTE</p>
			            </div>
	            	</div>
	            	<div class="card-body">
	            	<?php if (isset($_GET['msj'])) { ?>
	            		<?php if ($_GET['msj'] == 'true') { ?>
	            		<div class="alert alert-success alert-dismissible fade show" role="alert">
						    <strong>CORRECTO!</strong> Cambios realizados correctamente.
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						              <span aria-hidden="true">&times;</span>
						    </button>
						</div>
						<?php } ?>
	            		<?php if ($_GET['msj'] == 'false') { ?>
	            		<div class="alert alert-warning alert-dismissible fade show" role="alert">
						    <strong>ALERTA!</strong> No se han podido realizar los cambios.
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						              <span aria-hidden="true">&times;</span>
						    </button>
						</div>
						<?php } ?>
					<?php } ?>
	            		<form id="frmclienteUPDATE" method="post" class="form-horizontal">
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Nombre</label>
		            			<div class="col-10">
		            				<input name="nombres_cli" type="text" maxlength="50" class="form-control" value="<?= $clienteDATA['DATA'][0]['nombres_cli'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Telefono</label>
		            			<div class="col-10">
		            				<input name="telefono_cli" type="number" max="999999999" class="form-control" value="<?= $clienteDATA['DATA'][0]['telefono_cli'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Direccion</label>
		            			<div class="col-10">
		            				<textarea name="direccion_cli" maxlength="300" class="form-control" required><?= $clienteDATA['DATA'][0]['direccion_cli'] ?></textarea>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Referencia</label>
		            			<div class="col-10">
		            				<input name="referencia_cli" type="text" maxlength="300" class="form-control" value="<?= $clienteDATA['DATA'][0]['referencia_cli'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Correo</label>
		            			<div class="col-10">
		            				<input name="correo_cli" type="email" maxlength="50" class="form-control" value="<?= $clienteDATA['DATA'][0]['correo_cli'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Contraseña</label>
		            			<div class="col-10">
                                    <input name="clave_cli" type="password" maxlength="30" class="form-control" value="<?= $clienteDATA['DATA'][0]['clave_cli'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<button class="btn btn-outline-info">Actualizar</button>
	            			</div>
	            		</form>
			        </div>
			    </div>
			</div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<script>
	var frmclienteUPDATE = document.getElementById('frmclienteUPDATE');
	frmclienteUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmclienteUPDATE);
		fetch('../../controllers/clienteController.php?op=17',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
	      if (data.STATUS == 'OK') {
	      	ajaxCompuesto('content','../../controllers/clienteController.php',16,'msj=true');
	      } else {
	      	ajaxCompuesto('content','../../controllers/clienteController.php',16,'msj=false');
	      }
		})
	})
</script>