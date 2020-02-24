<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicio de sesion</title>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Solgas</b>PERU</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesión con la contraseña enviada a su correo</p>

      <form id="frmLoginCliente" method="post">
        <div class="input-group mb-3">
          <input name="correo" type="email" class="form-control" placeholder="Correo" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-at"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="clave" type="password" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">INGRESAR</button>
          </div>
          <!-- /.col -->
        </div>
        <p class="mb-0">
          <a href="./vstCliente_registro.php" class="text-center">Registro</a>
        </p>
        <div class="row">
          <div class="col-12" id="mensaje">
          </div>
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  var frmLogin = document.getElementById("frmLoginCliente");
  frmLogin.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = new FormData(frmLogin);
    fetch('../../controllers/clienteController.php?op=9',{
        method: 'POST',
        body: data
    })
    .then(res => res.json())
      .then(data => {
          console.log(data);
          if (data == 'OK') {
            window.location="../../views/cliente/frmClientePrincipal.php";
          } else {
            var mensaje = document.getElementById("mensaje");
            mensaje.innerHTML = `
                  <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
              <strong>OH!</strong> Clave incorrecta.
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
