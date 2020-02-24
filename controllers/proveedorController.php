<?php
	require_once '../models/dao/proveedorDao.php';

	require_once '../models/bean/proveedorBean.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objProveedorDao = new proveedorDao();

	$objProveedorBean = new proveedorBean();
	session_start();
	switch ($op) {
		case 1: {
			$proveedorSELECT = $objProveedorDao->proveedorSELECT();
			unset($_SESSION['proveedorSELECT']);
			$_SESSION['proveedorSELECT'] = $proveedorSELECT;
			$page = "../views/proveedor/proveedorPrincipal.php";
			break;
		}
		case 2: {
			$ruc_prov = $_POST['nbrRuc_prov'];
			$razsoc_prov = $_POST['txtRazsoc_prov'];
			$direccion_prov = $_POST['txaDireccion_prov'];
			$objProveedorBean->setRuc_prov($ruc_prov);
			$objProveedorBean->setRazsoc_prov($razsoc_prov);
			$objProveedorBean->setDireccion_prov($direccion_prov);
			$response = $objProveedorDao->proveedorINSERT($objProveedorBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 3: {
			$id_prov = $_GET['id_prov'];
			$proveedorDATA = $objProveedorDao->proveedorDATA($id_prov);
			unset($_SESSION['proveedorDATA']);
			$_SESSION['proveedorDATA'] = $proveedorDATA;
			$page = "../views/proveedor/frmProveedorUPDATE.php";
			break;
		}
		case 4: {
			$id_prov = $_POST['id_prov'];
			$ruc_prov = $_POST['nbrRuc_prov'];
			$razsoc_prov = $_POST['txtRazsoc_prov'];
			$direccion_prov = $_POST['txaDireccion_prov'];
			$objProveedorBean->setId_prov($id_prov);
			$objProveedorBean->setRuc_prov($ruc_prov);
			$objProveedorBean->setRazsoc_prov($razsoc_prov);
			$objProveedorBean->setDireccion_prov($direccion_prov);
			$response = $objProveedorDao->proveedorUPDATE($objProveedorBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 5: {
			$id_prov = $_POST['id_prov'];
			$response = $objProveedorDao->proveedorDELETE($id_prov);
			echo json_encode($response);
			exit();
			break; 
		}
	}
	header("Location:" . $page);
?>