<?php
session_start();
if (isset($_SESSION['USUARIO_PER']) == false || $_SESSION['USUARIO_PER'] == null || $_SESSION['USUARIO_PER'] == '') {
  header('location:../index.php');
}
$Stipo_per = $_SESSION['TIPO_PER'];
$Snombre_per = $_SESSION['NOMBRE_PER'];
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SOLGAS Trujillo | Inicio</title>

  <link rel="stylesheet" href="../css/principal.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- checkbox -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- daterangepicker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css" />
  <!-- select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css" />

  <link rel="stylesheet" type="text/css" href="../css/base.css">
  <link rel="stylesheet" type="text/css" href="../css/switch.css">
  <link rel="stylesheet" type="text/css" href="../css/calendar.css">

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

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span id="spnNotificaciones" class="badge badge-warning navbar-badge"></span>
          </a>
          <div id="divNotificaciones" class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height: 250px;overflow-y: auto;">
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="display: flex">SOLGAS <h6 class="mt-1">&nbsp;&nbsp;Trujillo</h6></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="javascript:ajaxSimple('content','../controllers/personalController.php',6)" class="d-block"><?= $Snombre_per ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" || $Stipo_per == "4" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/estadisticaController.php',1)" class="nav-link bg-success">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Estadisticas</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/ventasController.php',1)" class="nav-link bg-info">
                  <i class="nav-icon fas fa-receipt"></i>
                  <p>Venta</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" || $Stipo_per == "4" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/comprobantesController.php',14)" class="nav-link bg-danger">
                  <i class="nav-icon fas fa-calendar-day"></i>
                  <p>Pedidos</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" || $Stipo_per == "4" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/comprobantesController.php',1)" class="nav-link bg-danger">
                  <i class="nav-icon fas fa-file-powerpoint"></i>
                  <p>Proformas</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/comprobantesController.php',2)" class="nav-link bg-warning">
                  <i class="nav-icon fas fa-file-upload"></i>
                  <p>Guia Remision</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/comprobantesController.php',3)" class="nav-link bg-primary">
                  <i class="nav-icon fas fa-file-invoice"></i>
                  <p>Ventas Realizadas</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/comprobantesController.php',5)" class="nav-link bg-light">
                  <i class="nav-icon fas fa-file-upload"></i>
                  <p>Guia Transportista</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "5" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxPagina('content','./maps/maps.php?estado_rutmap=2')" class="nav-link">
                  <i class="nav-icon fas fa-file-upload"></i>
                  <p>GeoMaps</p>
                </a>
              </li>
            <?php } ?>
            <!--<li class="nav-item">
            <a href="javascript:Pagina('./mapas.php')" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>GMapas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:Pagina('./googlemaps.php')" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>Google Mapas</p>
            </a>
          </li>-->
            <li class="nav-item">
              <a href="javascript:ajaxPagina('content','./balon/scannerProducto.php')" class="nav-link">
                <i class="nav-icon fas fa-clone"></i>
                <p>Scanner</p>
              </a>
            </li>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/clienteController.php',7)" class="nav-link">
                  <i class="nav-icon fas fa-clone"></i>
                  <p>Creditos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/prestamoController.php',1)" class="nav-link">
                  <i class="nav-icon fas fa-clone"></i>
                  <p>Prestamos</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-shapes"></i>
                  <p>
                    Productos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="javascript:ajaxSimple('content','../controllers/balonController.php',1)" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Principal</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:ajaxSimple('content','../controllers/balonController.php',9)" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Balones de Gas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:ajaxSimple('content','../controllers/balonController.php',10)" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Agua</p>
                    </a>
                  </li>
                  <?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
                    <li class="nav-item">
                      <a href="javascript:ajaxSimple('content','../controllers/balonController.php',13)" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Historial</p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2") { ?>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Vehículos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="javascript:ajaxSimple('content','../controllers/vehiculoController.php',1)" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Principal</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:ajaxCompuesto('content','../controllers/vehiculoController.php',8)" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Horarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:ajaxSimple('content','../controllers/vehiculoController.php',2)" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Salidas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/personalController.php',1)" class="nav-link">
                  <i class="nav-icon fas fa-user-friends"></i>
                  <p>Personal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/proveedorController.php',1)" class="nav-link">
                  <i class="nav-icon fas fa-dot-circle"></i>
                  <p>Proveedores</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($Stipo_per == "1" || $Stipo_per == "2" || $Stipo_per == "3" ||  $Stipo_per == "4" || $Stipo_per == "5") { ?>
              <li class="nav-item">
                <a href="javascript:ajaxSimple('content','../controllers/clienteController.php',1)" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Clientes</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="javascript:Pagina('../controllers/loginController.php?op=2')" class="nav-link">
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
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">INICIO</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Pagina Inicial</li>
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
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
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
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <script src="../javascript/principal.js"></script>
  <script src="../javascript/balon.js"></script>
  <script src="../javascript/personal.js"></script>
  <script src="../javascript/proveedor.js"></script>
  <script src="../javascript/cliente.js"></script>
  <script src="../javascript/prestamo.js"></script>
  <script src="../javascript/vehiculo.js"></script>
  <script src="../javascript/venta.js"></script>
  <script src="../javascript/guiaremision.js"></script>
  <script src="../javascript/template.js"></script>
  <script src="../javascript/calendar.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- select2 -->
  <script src="../plugins/select2/js/select2.min.js" type="text/javascript"></script>
  <!-- Bootstrap Switch -->
  <script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- JsBarcode -->
  <script src="../dist/js/JsBarcode.all.min.js"></script>
  <!-- daterangePicker -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDpVrLAddgFJRKLa4PMB98J7q0TiN6LmKM"></script>
  <script type="text/javascript" src="../javascript/functions.js"></script>
  <script type="text/javascript" src="../javascript/maps.js"></script>
  <script>
    <?php if ($Stipo_per == '1' || $Stipo_per == '2') { ?>
      CargarNotificacionesAdmin();
    <?php } ?>
    <?php if ($Stipo_per == '5') { ?>
      CargarNotificacionesPersonal();
    <?php } ?>
  </script>
</body>

</html>