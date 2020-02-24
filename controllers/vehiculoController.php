<?php
	require_once '../models/dao/vehiculoDao.php';
	require_once '../models/dao/personalDao.php';

	require_once '../models/bean/vehiculoBean.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objVehiculoDao = new vehiculoDao();
	$objPersonalDao = new personalDao();

	$objVehiculoBean = new vehiculoBean();
	session_start();
	date_default_timezone_set("America/Lima");
	switch ($op) {
		case 1: {
			$vehiculoSELECT = $objVehiculoDao->vehiculoSELECT();
			$choferSELECT = $objPersonalDao->personalSELECT_tipper(5);
			$promotorSELECT = $objPersonalDao->personalSELECT_tipper(6);
			$empleadoSELECT = $objPersonalDao->personalSELECT();
			unset($_SESSION['vehiculoSELECT']);
			unset($_SESSION['choferSELECT']);
			unset($_SESSION['promotorSELECT']);
			unset($_SESSION['empleadoSELECT']);
			$_SESSION['vehiculoSELECT'] = $vehiculoSELECT;
			$_SESSION['choferSELECT'] = $choferSELECT;
			$_SESSION['promotorSELECT'] = $promotorSELECT;
			$_SESSION['empleadoSELECT'] = $empleadoSELECT;
			$page = "../views/vehiculo/vehiculoPrincipal.php";
			break;
		}
		case 2: {
			$salidasSELECT = $objVehiculoDao->salidasSELECT();
			unset($_SESSION['salidasSELECT']);
			$_SESSION['salidasSELECT'] = $salidasSELECT;
			$page = "../views/vehiculo/vehiculoSalidas.php";
			break;
		}
		case 3: {
			$descripcion_veh = $_POST['txtDescripcion_veh'];
			$placa_veh = $_POST['txtPlaca_veh'];
			$tipo_veh = $_POST['sltTipo_veh'];
			$kilometraje_veh = $_POST['nbrKilometraje_veh'];
			$polemi_veh = $_POST['polemi_veh'];
			$polven_veh = $_POST['polven_veh'];
			$moncob_pol = $_POST['moncob_pol'];
			$soatemi_veh = $_POST['soatemi_veh'];
			$soatven_veh = $_POST['soatven_veh'];
			$objVehiculoBean->setDescripcion_veh($descripcion_veh);
			$objVehiculoBean->setPlaca_veh($placa_veh);
			$objVehiculoBean->setTipo_veh($tipo_veh);
			$objVehiculoBean->setKilometraje_veh($kilometraje_veh);
			$objVehiculoBean->setPolemi_veh($polemi_veh);
			$objVehiculoBean->setPolven_veh($polven_veh);
			$objVehiculoBean->setMoncob_pol($moncob_pol);
			$objVehiculoBean->setSoatemi_veh($soatemi_veh);
			$objVehiculoBean->setSoatven_veh($soatven_veh);
			$response = $objVehiculoDao->vehiculoINSERT($objVehiculoBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 4: {
			$id_veh = $_GET['id_veh'];
			$vehiculoDATA = $objVehiculoDao->vehiculoDATA($id_veh);
			unset($_SESSION['vehiculoDATA']);
			$_SESSION['vehiculoDATA'] = $vehiculoDATA;
			$page = "../views/vehiculo/frmVehiculoUPDATE.php";
			break;
		}
		case 5: {
			$id_veh = $_POST['id_veh'];
			$descripcion_veh = $_POST['txtDescripcion_veh'];
			$placa_veh = $_POST['txtPlaca_veh'];
			$tipo_veh = $_POST['sltTipo_veh'];
			$kilometraje_veh = $_POST['nbrKilometraje_veh'];
			$objVehiculoBean->setId_veh($id_veh);
			$objVehiculoBean->setDescripcion_veh($descripcion_veh);
			$objVehiculoBean->setPlaca_veh($placa_veh);
			$objVehiculoBean->setTipo_veh($tipo_veh);
			$objVehiculoBean->setKilometraje_veh($kilometraje_veh);
			$response = $objVehiculoDao->vehiculoUPDATE($objVehiculoBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 6: {
			$id_veh = $_POST['id_veh'];
			$chofer_sal = $_POST['chofer_sal'];
			$ayudante_sal = $_POST['ayudante_sal'];
			$promotor_sal = $_POST['promotor_sal'];
			$fecini_sal = str_replace('T', ' ', $_POST['fecini_sal'] . ":00");
			$objVehiculoBean->setId_veh($id_veh);
			$objVehiculoBean->setChofer_sal($chofer_sal);
			$objVehiculoBean->setAyudante_sal($ayudante_sal);
			$objVehiculoBean->setPromotor_sal($promotor_sal);
			$objVehiculoBean->setFecini_sal($fecini_sal);
			$response = $objVehiculoDao->salidaINSERT($objVehiculoBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 7: {
			$id_sal = $_POST['id_sal'];
			if (strtotime(date('Y-m-d H:i:s')) < strtotime($_POST['fecfin_sal'] . " " . $_POST['horfin_sal'] . ":00")) {
				$kilfin_sal = $_POST['kilfin_sal'];
				$fecfin_sal = $_POST['fecfin_sal'] . " " . $_POST['horfin_sal'] . ":00";
				$objVehiculoBean->setId_sal($id_sal);
				$objVehiculoBean->setKilfin_sal($kilfin_sal);
				$objVehiculoBean->setFecfin_sal($fecfin_sal);
				$response = $objVehiculoDao->salidaFIN($objVehiculoBean);
			} else {
				$response['STATUS'] = "La fecha no puede ser pasada";
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 8: {
			$horariosSELECT = $objVehiculoDao->horariosSELECT();
			unset($_SESSION['horariosSELECT']);
			$_SESSION['horariosSELECT'] = $horariosSELECT;
			$page = "../views/vehiculo/vehiculoHorarios.php";
			break;
		}
		case 9: {
			$id_sal = $_POST['id_sal'];
			$kilini_sal = $_POST['kilini_sal'];
			$objVehiculoBean->setId_sal($id_sal);
			$objVehiculoBean->setKilini_sal($kilini_sal);
			$response = $objVehiculoDao->salidaINICIO($objVehiculoBean);
			echo json_encode($response);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>