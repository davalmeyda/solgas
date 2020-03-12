<?php
	require_once '../models/dao/balonDao.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objBalonDao = new balonDao();
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$Sid_per = $_SESSION['ID_PER'];
	switch ($op) {
		case 1: {
			$marcaSELECT = $objBalonDao->marcaSELECT();
			unset($_SESSION['marcaSELECT']);
			$_SESSION['marcaSELECT'] = $marcaSELECT;
			$page = "../views/marca/marcaPrincipal.php";
			break;
        }
        case 2: {
            $nota_mar = $_POST['nota_mar'];
            $tipo = $_POST['tipo'];
			$response = $objBalonDao->marcaINSERT($nota_mar, $tipo);
            echo json_encode($response);
            exit();
            break;
        }
		case 3: {
            $id_mar = $_GET['id_mar'];
			$marcaDATA = $objBalonDao->marcaDATA($id_mar);
			unset($_SESSION['marcaDATA']);
			$_SESSION['marcaDATA'] = $marcaDATA;
			$page = "../views/marca/frmMarcaUPDATE.php";
			break;
        }
        case 4: {
            $id_mar = $_POST['id_mar'];
            $nota_mar = $_POST['nota_mar'];
            $tipo = $_POST['tipo'];
			$response = $objBalonDao->marcaUPDATE($id_mar, $nota_mar, $tipo);
            echo json_encode($response);
            exit();
            break;
        }
	}
	header("Location:" . $page);
?>