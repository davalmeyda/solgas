<?php
session_start();
if (isset($_SESSION['ID_CLI'])==false || $_SESSION['ID_CLI']==null || $_SESSION['ID_CLI']=='') {
  header('location:./frmLoginCliente.php');
}
$Sid_cli = $_SESSION['ID_CLI'];
$Snombres_cli = $_SESSION['NOMBRES_CLI'];
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SOLGAS Trujillo | Inicio</title>
  
  <link rel="stylesheet" href="../../css/principal.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- checkbox -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css"/>

  <link rel="stylesheet" type="text/css" href="../../css/base.css">
  <link rel="stylesheet" type="text/css" href="../../css/switch.css">
  <link rel="stylesheet" type="text/css" href="../../css/calendar.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Inicio</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="display: flex">SOLGAS <h6 class="mt-1">&nbsp;&nbsp;Trujillo</h6></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!--<div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>-->
        <div class="info">
          <a href="" class="d-block"><?= $Snombres_cli ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="javascript:ajaxSimple('content','../../controllers/clienteController.php',10)" class="nav-link">
              <i class="nav-icon fas fa-clone"></i>
              <p>Productos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:ajaxSimple('content','../../controllers/clienteController.php',11)" class="nav-link">
              <i class="nav-icon fas fa-clone"></i>
              <p>Mis pedidos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:Pagina('../../controllers/clienteController.php?op=13')" class="nav-link">
              <i class="nav-icon fas fa-times"></i>
              <p>Cerrar Sesión</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div id="content" class="content-wrapper">
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="http://brufat.com/" target="_BANK">Brufat Company</a>.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../javascript/principal.js"></script>
<script src="../../javascript/cliente.js"></script>
<script src="../../javascript/template.js"></script>
<script src="../../javascript/pedido.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- select2 -->
<script src="../../plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- JsBarcode -->
<script src="../../dist/js/JsBarcode.all.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDpVrLAddgFJRKLa4PMB98J7q0TiN6LmKM"></script>
<script type="text/javascript" src="../../javascript/functions.js"></script>
<script>
  ajaxSimple('content','../../controllers/clienteController.php',10);
</script>
</body>
</html>
