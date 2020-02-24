<?php
	require_once '../models/dao/prestamoDao.php';
	require_once '../models/dao/balonDao.php';
	require_once '../models/dao/clienteDao.php';

	require_once '../models/bean/prestamoBean.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objPrestamoDao = new prestamoDao();
	$objBalonDao = new balonDao();
	$objClienteDao = new clienteDao();

	$objPrestamoBean = new prestamoBean();
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$Sid_per = $_SESSION['ID_PER'];
	date_default_timezone_set("America/Lima");
	switch ($op) {
		case 1: {
			if(isset($_GET['op2'])) {
				$op2 = $_GET['op2'];
			} else {
				$op2 = 0;
			}
			switch ($op2) {
				case 0:
					if ($Stipo_per == "1" || $Stipo_per == "2") {
						$prestamoSELECT = $objPrestamoDao->prestamoSELECT();
					} else {
						$prestamoSELECT = $objPrestamoDao->prestamoSELECT_idper($Sid_per);
					}
					break;
				case 1:
					if ($Stipo_per == "1" || $Stipo_per == "2") {
						$prestamoSELECT = $objPrestamoDao->prestamoSELECT_NOTNULL();
					} else {
						$prestamoSELECT = $objPrestamoDao->prestamoSELECT_idperNOTNULL($Sid_per);
					}
					break;
				case 2:
					if ($Stipo_per == "1" || $Stipo_per == "2") {
						$prestamoSELECT = $objPrestamoDao->prestamoSELECT_NULL();
					} else {
						$prestamoSELECT = $objPrestamoDao->prestamoSELECT_idperNULL($Sid_per);
					}
					break;
			}
			unset($_SESSION['prestamoSELECT']);
			$_SESSION['prestamoSELECT'] = $prestamoSELECT;
			$page = "../views/prestamo/prestamoPrincipal.php?op2=" . $op2;
			break;
		}
		case 2: {
			$cantidad_pre = 0;
			for ($i=0; $i < $_POST['cantidad_pre']; $i++) {
				$cantidad_pre = $cantidad_pre + $_POST['cantidad_balpre' . $i];
			}
			if ($_POST['tipo_pre']==1) {
				$fecha = date('Y-m-d H:i:s');
			} else {
				$fecha = $_POST['fecha_pre'] . " " . $_POST['hora_pre'] . ":00";
			}
			$objPrestamoBean->setTipo_pre($_POST['tipo_pre']);
			$objPrestamoBean->setFecha_pre($fecha);
			$objPrestamoBean->setTotal_pre($cantidad_pre);
			$objPrestamoBean->setCantidad_pre($cantidad_pre);
			$objPrestamoBean->setMotivo_pre($_POST['txaMotivo_pre']);
			$objPrestamoBean->setId_cli($_POST['sltId_cli']);
			//$objPrestamoBean->setId_per($_POST['id_per']);
			$objPrestamoBean->setId_per($Sid_per);
			$response = $objPrestamoDao->prestamoINSERT($objPrestamoBean);
			if ($response['STATUS'] == 'OK') {
				$objPrestamoBean->setId_pre($response['ID']);
				$objPrestamoBean->setFecini_balpre($fecha);
				for ($i=0; $i < $_POST['cantidad_pre']; $i++) {
					$objPrestamoBean->setId_bal($_POST['id_bal' . $i]);
					$objPrestamoBean->setTotal_balpre($_POST['cantidad_balpre' . $i]);
					$objPrestamoBean->setCantidad_balpre($_POST['cantidad_balpre' . $i]);
					$response = $objPrestamoDao->balon_prestamoINSERT($objPrestamoBean);
					if ($response['STATUS'] == 'OK') {
						$objBalonDao->cantidad_balRESTAUPDATE($_POST['id_bal' . $i],$_POST['cantidad_balpre' . $i]);
					}
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 3: {
			$id_pre = $_GET['id_pre'];
			$prestamoDATA = $objPrestamoDao->prestamoDATA($id_pre);
			$balon_prestamoSELECT = $objBalonDao->balon_prestamoSELECT($id_pre);
			unset($_SESSION['prestamoDATA']);
			unset($_SESSION['prestamoDATA']);
			$_SESSION['prestamoDATA'] = $prestamoDATA;
			$_SESSION['balon_prestamoSELECT'] = $balon_prestamoSELECT;
			$page = "../views/prestamo/vstPrestamoDetalle.php";
			break;
		}
		case 4: {
			$id_balpre = $_POST['id_balpre'];
			$balon_prestamo = $objBalonDao->balon_prestamoDATA($id_balpre);
			$balonxu_prestamo = $objPrestamoDao->balonxu_prestamo_balpre($id_balpre);
			$balonxu_prestamo['ID'] = $balon_prestamo['DATA'][0]['total_balpre'];
			echo json_encode($balonxu_prestamo);
			exit();
			break;
		}
		case 5: {
			$id_balpre = $_POST['id_balpre'];
			$id_bal = $_POST['id_bal'];
			$id_pre = $_POST['id_pre'];
			$cantidad_balpre = $_POST['cantidad_balpre'];
			$editada_balpre = $_POST['editada_balpre'];
			$total_balpre = $_POST['total_balpre'];
			$objPrestamoBean->setId_balpre($id_balpre);
			$objPrestamoBean->setId_per($Sid_per);
			$objPrestamoBean->setFecreg_pre(date('Y-m-d H:i:s'));
			if ($cantidad_balpre == $editada_balpre) {
				$objPrestamoBean->setFecfin_balpre(date('Y-m-d H:i:s'));
				$objPrestamoBean->setEstado_balpre(2);
				$response = $objPrestamoDao->estado_balpreUPDATE($objPrestamoBean);
				$num = $objPrestamoDao->numbalonPrestamo($id_pre);
				if ($num['DATA'][0]['COUNT(*)'] == 0) {
					$response = $objPrestamoDao->fecreg_preUPDATE($id_pre,date('Y-m-d H:i:s'));
				}
			}
			if ($total_balpre > $cantidad_balpre) {
				$objBalonDao->cantidad_balRESTAUPDATE($id_bal,$editada_balpre);
				$objPrestamoDao->cantidad_preSUMAUPDATE($id_pre,$editada_balpre);
				$objPrestamoDao->cantidad_balpreUPDATE($id_balpre,$total_balpre);
				$objPrestamoDao->total_balpreUPDATE($id_balpre,$editada_balpre);
				$objPrestamoBean->setCantidad_balpre($editada_balpre);
				$response = $objPrestamoDao->registrobalon_prestamoINSERT($objPrestamoBean);
			}
			if ($total_balpre < $cantidad_balpre) {
				$response = $objBalonDao->cantidad_balSUMAUPDATE($editada_balpre,$id_bal);
				if ($response['STATUS'] == 'OK') {
					$response = $objPrestamoDao->cantidad_preRESTAUPDATE($id_pre,$editada_balpre);
					if ($response['STATUS'] == 'OK') {
						$response = $objPrestamoDao->cantidad_balpreUPDATE($id_balpre,$total_balpre);
						if ($response['STATUS'] == 'OK') {
							$objPrestamoBean->setCantidad_balpre(-$editada_balpre);
							$response = $objPrestamoDao->registrobalon_prestamoINSERT($objPrestamoBean);
						}
					}
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 6: {
			$id_pre = $_GET['id_pre'];
			$prestamoDATA = $objPrestamoDao->prestamoDATA($id_pre);
			$balon_prestamoSELECT = $objBalonDao->balon_prestamoSELECT($id_pre);
			$balonSELECT_estadobal = $objBalonDao->balonSELECT_estadobal('1');
			$clienteSELECT = $objClienteDao->clienteSELECT();
			$clienteSELECT = $objClienteDao->clienteSELECT();
			unset($_SESSION['prestamoDATA']);
			unset($_SESSION['balon_prestamoSELECT']);
			unset($_SESSION['clienteSELECT']);
			unset($_SESSION['balonSELECT_estadobal']);
			$_SESSION['prestamoDATA'] = $prestamoDATA;
			$_SESSION['balon_prestamoSELECT'] = $balon_prestamoSELECT;
			$_SESSION['clienteSELECT'] = $clienteSELECT;
			$_SESSION['balonSELECT_estadobal'] = $balonSELECT_estadobal;
			$page = "../views/prestamo/frmPrestamoUPDATE.php";
			break;
		}
		case 7: {
			$data = (array)json_decode($_POST['data']);
			$objPrestamoBean->setFecini_balpre(date('Y-m-d H:i:s'));
			$objPrestamoBean->setTotal_balpre($data['cantidad_balpre']);
			$objPrestamoBean->setCantidad_balpre($data['cantidad_balpre']);
			$objPrestamoBean->setId_bal($data['id_bal']);
			$objPrestamoBean->setId_pre($data['id_pre']);
			$objPrestamoBean->setFecreg_pre(date('Y-m-d H:i:s'));
			$objPrestamoBean->setId_per($Sid_per);
			$count = $objPrestamoDao->baloninbalon_prestamoCOUNT($data['id_bal'],$data['id_pre']);
			if (isset($count['DATA'][0]['id_balpre'])) {
				$objBalonDao->cantidad_balRESTAUPDATE($data['id_bal'],$data['cantidad_balpre']);
				$objPrestamoDao->cantidad_preSUMAUPDATE($data['id_pre'],$data['cantidad_balpre']);
				$cantidad_balpre = $count['DATA'][0]['cantidad_balpre'] + $data['cantidad_balpre'];
				$objPrestamoDao->cantidad_balpreUPDATE($count['DATA'][0]['id_balpre'],$cantidad_balpre);
				$objPrestamoDao->total_balpreUPDATE($count['DATA'][0]['id_balpre'],$data['cantidad_balpre']);
				$objPrestamoBean->setCantidad_balpre($data['cantidad_balpre']);
				$objPrestamoBean->setId_balpre($count['DATA'][0]['id_balpre']);
				$response = $objPrestamoDao->registrobalon_prestamoINSERT($objPrestamoBean);
			} else {
				$response = $objPrestamoDao->balon_prestamoINSERT($objPrestamoBean);
				if ($response['STATUS'] == 'OK') {
					$objPrestamoBean->setId_balpre($response['ID']);
					$response = $objPrestamoDao->registrobalon_prestamoINSERT($objPrestamoBean);
					if ($response['STATUS'] == 'OK') {
						$response = $objBalonDao->cantidad_balRESTAUPDATE($data['id_bal'],$data['cantidad_balpre']);
						if ($response['STATUS'] == 'OK') {
							$response = $objPrestamoDao->cantidad_preSUMAUPDATE($data['id_pre'],$data['cantidad_balpre']);
						}
					}
				}
			}
			
			echo json_encode($response);
			exit();
			break;
		}
		case 8: {
			$id_bal = $_POST['id_bal'];
			$balonxuSELECT = $objBalonDao->balonxuSELECT_idbal($id_bal);
			echo json_encode($balonxuSELECT);
			exit();
			break;
		}
		case 9: {
			$data = (array)json_decode($_POST['data']);
			foreach ($data['listBalxu'] as $list) {
				$response = $objPrestamoDao->balonxu_prestamoINSERT($data['id_balpre'],$list->{'id_balxu'});
				if ($response['STATUS'] == 'OK') {
					$response = $objBalonDao->estado_balxuINSERT(2,$list->{'id_balxu'});
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>