<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registro</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Solgas</b>PERU</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrate a solgas</p>

      <form id="frmRegistroCliente" method="post">
        <div class="input-group mb-3">
          <select id="tipdoc_cli" name="tipdoc_cli" class="form-control">
            <option value="1">DNI</option>
            <option value="6">RUC</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="numdoc_cli" name="numdoc_cli" type="text" maxlength="8" class="form-control" placeholder="Numero documento" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="nombres_cli" type="text" maxlength="100" class="form-control" placeholder="Nombre/Razon social" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="telefono_cli" type="text" maxlength="9" class="form-control" placeholder="Numero documento" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="correo_cli" type="email" maxlength="50" class="form-control" placeholder="Correo" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas">@</span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="direccion_cli" type="text" maxlength="300" class="form-control" placeholder="direccion" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marker"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="referencia_cli" type="text" maxlength="50" class="form-control" placeholder="referencia" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marker"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="clave_cli" type="password" maxlength="50" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Registro</button>
          </div>
        </div>
      </form>
      <a href="./frmLoginCliente.php" class="text-center">Ya tengo cuenta</a>
      <div class="row">
        <div class="col-12" id="mensaje">
        </div>
      </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  document.getElementById("tipdoc_cli").addEventListener('click', function(e) {
    if (document.getElementById("tipdoc_cli").value == 6) {
      $('#numdoc_cli').removeAttr('maxlength');
      $('#numdoc_cli').attr('maxlength',11);
    } else {
      $('#numdoc_cli').removeAttr('maxlength');
      $('#numdoc_cli').attr('maxlength',8);
    }
  })
  var frmRegistro = document.getElementById("frmRegistroCliente");
  frmRegistro.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = new FormData(frmRegistro);
    fetch('../../controllers/clienteController.php?op=12',{
        method: 'POST',
        body: data
    })
    .then(res => res.json())
      .then(data => {
          console.log(data);
          var mensaje = document.getElementById("mensaje");
          if (data.STATUS == 'OK') {
            mensaje.innerHTML = `
                  <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
              <strong>CORRECTO!</strong> Registro correcto.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            `;
          } else {
            mensaje.innerHTML = `
                  <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
              <strong>OH!</strong> Registro incorrecto.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            `;
          }
      })
  })
</script>
</body>
</html>
