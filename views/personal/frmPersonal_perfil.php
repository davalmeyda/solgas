<?php
session_start();
$personalDATA = $_SESSION['personalDATA'];
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
			                <div class="text-center">
			                  <img class="profile-user-img img-fluid img-circle"
			                       src="../dist/img/personal/<?= $personalDATA['DATA'][0]['foto_per'] ?>"
			                       alt="User profile picture" style="width: 100px; height: 100px">
			                </div>
			                <h3 class="profile-username text-center"><?= $personalDATA['DATA'][0]['nombre_per'] ?> <?= $personalDATA['DATA'][0]['apellido_per'] ?></h3>
			                <p class="text-muted text-center"><?= $personalDATA['DATA'][0]['nota_temp'] ?></p>
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
	            		<form id="frmpersonalUPDATE" method="post" class="form-horizontal">
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Nombre</label>
		            			<div class="col-10">
		            				<input name="nombre_per" type="text" maxlength="50" class="form-control" value="<?= $personalDATA['DATA'][0]['nombre_per'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Apellido</label>
		            			<div class="col-10">
		            				<input name="apellido_per" type="text" maxlength="50" class="form-control" value="<?= $personalDATA['DATA'][0]['apellido_per'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Fecha de nacimiento</label>
		            			<div class="col-10">
		            				<input name="fecnac_per" type="date" class="form-control" value="<?= $personalDATA['DATA'][0]['fecnac_per'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Correo</label>
		            			<div class="col-10">
		            				<input name="correo_per" type="email" maxlength="50" class="form-control" value="<?= $personalDATA['DATA'][0]['correo_per'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Direccion</label>
		            			<div class="col-10">
		            				<textarea name="direccion_per" maxlength="300" class="form-control" required><?= $personalDATA['DATA'][0]['direccion_per'] ?></textarea>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Nacionalidad</label>
		            			<div class="col-10">
		            				<input name="nacionalidad_per" type="text" class="form-control" maxlength="20" value="<?= $personalDATA['DATA'][0]['nacionalidad_per'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Usuario</label>
		            			<div class="col-10">
		            				<input name="usuario_per" type="text" maxlength="20" class="form-control" value="<?= $personalDATA['DATA'][0]['usuario_per'] ?>" required>
		            			</div>
	            			</div>
	            			<div class="form-group row">
	            				<label class="from-control-label col-2">Clave</label>
		            			<div class="col-10">
		            				<input name="clave_per" type="password" maxlength="30" class="form-control" value="<?= $personalDATA['DATA'][0]['clave_per'] ?>" required>
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
	var frmpersonalUPDATE = document.getElementById('frmpersonalUPDATE');
	frmpersonalUPDATE.addEventListener('submit', function(e) {
		e.preventDefault();
		var data = new FormData(frmpersonalUPDATE);
		fetch('../controllers/personalController.php?op=7',{
		    method: 'POST',
		    body: data
		})
		.then(res => res.json())
		.then(data => {
	      if (data.STATUS == 'OK') {
	      	ajaxCompuesto('content','../controllers/PersonalController.php',6,'msj=true');
	      } else {
	      	ajaxCompuesto('content','../controllers/PersonalController.php',6,'msj=false');
	      }
		})
	})
</script>