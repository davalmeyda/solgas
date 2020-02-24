<?php
	require_once '../models/dao/estadisticaDao.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objEstadisticaDao = new estadisticaDao();
	session_start();
	switch ($op) {
		case 1: {
			$dataComprobante = array('DATA' => array());
			$facturaCOUNT = $objEstadisticaDao->facturaCOUNT();
			$boletaCOUNT = $objEstadisticaDao->boletaCOUNT();
			$notascreditoCOUNT = $objEstadisticaDao->notascreditoCOUNT();
			$notasdebitoCOUNT = $objEstadisticaDao->notasdebitoCOUNT();
			$proformaCOUNT = $objEstadisticaDao->proformaCOUNT();
			$guiaremisionCOUNT = $objEstadisticaDao->guiaremisionCOUNT();
			$dataComprobante['DATA'][0]['facturaCOUNT'] = $facturaCOUNT['DATA'][0]['count(*)'];
			$dataComprobante['DATA'][0]['boletaCOUNT'] = $boletaCOUNT['DATA'][0]['count(*)'];
			$dataComprobante['DATA'][0]['notascreditoCOUNT'] = $notascreditoCOUNT['DATA'][0]['count(*)'];
			$dataComprobante['DATA'][0]['notasdebitoCOUNT'] = $notasdebitoCOUNT['DATA'][0]['count(*)'];
			$dataComprobante['DATA'][0]['proformaCOUNT'] = $proformaCOUNT['DATA'][0]['count(*)'];
			$dataComprobante['DATA'][0]['guiaremisionCOUNT'] = $guiaremisionCOUNT['DATA'][0]['count(*)'];
			unset($_SESSION['dataComprobante']);
			$_SESSION['dataComprobante'] = $dataComprobante;
			$page = "../views/estadisticas.php";
			break;
		}
	}
	header("Location:" . $page);
?>