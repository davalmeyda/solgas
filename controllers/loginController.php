<?php
	require_once '../models/dao/personalDao.php';

	require_once '../models/bean/personalBean.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objPersonalDao = new personalDao();

	$objPersonalBean = new personalBean();
	switch ($op) {
		case 1: {
			$usuario = $_POST['user'];
			$clave = $_POST['password'];
			$objPersonalBean->setUsuario_per($usuario);
			$objPersonalBean->setClave_per($clave);
			$response = $objPersonalDao->personalVALIDATE($objPersonalBean);
			if (count($response['DATA']) >= 1) {
				session_start();
				unset($_SESSION['TIPO_PER']);
				unset($_SESSION['ID_PER']);
				unset($_SESSION['NOMBRE_PER']);
				unset($_SESSION['USUARIO_PER']);
				unset($_SESSION['TIPO_USER']);
				$_SESSION['TIPO_PER'] = $response['DATA'][0]['id_temp'];
				$_SESSION['ID_PER'] = $response['DATA'][0]['id_per'];
				$_SESSION['NOMBRE_PER'] = $response['DATA'][0]['nombre_per'];
				$_SESSION['USUARIO_PER'] = $usuario;
				$_SESSION['TIPO_USER'] = $response['DATA'][0]['tipo_user'];
				$mensaje = "OK";
			} else {
				$mensaje = "ERROR";
			}
			echo json_encode($mensaje);
			exit();
			break;
		}
		case 2: {
            session_start();
            session_destroy();
			$page = "../views/login.php";
			break;
		}
		case 3: {
			$usuario_per = $_POST['usuario_per'];
			$clave_per = $_POST['clave_per'];
			$objPersonalBean->setUsuario_per($usuario_per);
			$objPersonalBean->setClave_per($clave_per);
			$response = $objPersonalDao->adminVALIDATE($objPersonalBean);
			if (count($response['DATA']) >= 1) {
				$mensaje = "OK";
			} else {
				$mensaje = "ERROR";
			}
			echo json_encode($mensaje);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>