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
	$Sid_per = $_SESSION['ID_PER'];
	$Stipo_per = $_SESSION['TIPO_PER'];
	switch ($op) {
		case 1: {
			$dataComprobante = array('DATA' => array());
			$extra = '';
			$extra2 = '';
			if ($Stipo_per != 1 && $Stipo_per != 2) {
				$extra = " AND id_per='$Sid_per'";
				$extra2 = " WHERE id_per='$Sid_per'";
			}
			$facturaCOUNT = $objEstadisticaDao->facturaCOUNT($extra);
			$boletaCOUNT = $objEstadisticaDao->boletaCOUNT($extra);
			$notascreditoCOUNT = $objEstadisticaDao->notascreditoCOUNT($extra);
			$notasdebitoCOUNT = $objEstadisticaDao->notasdebitoCOUNT($extra);
			$proformaCOUNT = $objEstadisticaDao->proformaCOUNT($extra2);
			$guiaremisionCOUNT = $objEstadisticaDao->guiaremisionCOUNT($extra2);
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