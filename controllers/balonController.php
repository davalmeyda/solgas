<?php
	require_once '../models/dao/balonDao.php';
	require_once '../models/dao/proveedorDao.php';
	require_once '../models/dao/clienteDao.php';
	require_once '../models/dao/personalDao.php';

	require_once '../models/bean/balonBean.php';
	require_once '../models/bean/prestamoBean.php';
	require_once "../dist/lib/PHPBarCode/autoload.php";
	use Picqer\Barcode\BarcodeGeneratorPNG;
	$generador = new BarcodeGeneratorPNG();

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objBalonDao = new balonDao();
	$objProveedorDao = new proveedorDao();
	$objClienteDao = new clienteDao();
	$objPersonalDao = new personalDao();

	$objBalonBean = new balonBean();
	$objPrestamoBean = new prestamoBean();
	session_start();
	$Sid_per = $_SESSION['ID_PER'];
	date_default_timezone_set("America/Lima");
	switch ($op) {
		case 1: {
			$balonSELECT = $objBalonDao->balonSELECT();
			$clienteSELECT = $objClienteDao->clienteSELECT();
			unset($_SESSION['balonSELECT']);
			unset($_SESSION['clienteSELECT']);
			$_SESSION['balonSELECT'] = $balonSELECT;
			$_SESSION['clienteSELECT'] = $clienteSELECT;
			$page = "../views/balon/balonPrincipal.php";
			break;
		}
		case 2: {
			$proveedorSELECT = $objProveedorDao->proveedorSELECT();
			$marcaSELECT = $objBalonDao->marcaSELECT();
			$coloresSELECT = $objBalonDao->coloresSELECT();
			unset($_SESSION['proveedorSELECT']);
			unset($_SESSION['marcaSELECT']);
			unset($_SESSION['coloresSELECT']);
			$_SESSION['proveedorSELECT'] = $proveedorSELECT;
			$_SESSION['marcaSELECT'] = $marcaSELECT;
			$_SESSION['coloresSELECT'] = $coloresSELECT;
			$page = "../views/balon/frmBalonINSERT.php";
			break;
		}
		case 3: {
			$tipo = $generador::TYPE_CODE_128;
			$id_bal = $_POST['sltId_bal'];
			$fecha_regbal = date('Y-m-d H:i:s');
			$cantidad_regbal = $_POST['nbrCantidad_regbal'];
			$precodbar = $_POST['precodbar'];
			if ($id_bal == "0") {
				$nombre_bal = $_POST['txtNombre_bal'];
				$marca_bal = $_POST['sltMarca_bal'];
				$peso_bal = $_POST['nbrPeso_bal'];
				$color_bal = $_POST['txtColor_bal'];
				$precio_bal = $_POST['precio_bal'];
				$tipo_bal = $_POST['sltTipo_bal'];
				if (isset($_POST['categoria_bal'])) {
					$categoria_bal = 'PREMIUN';
				} else {
					$categoria_bal = 'NORMAL';
				}
				$codigo_fac = $_POST['codigo_fac'];
				$id_prov = $_POST['sltId_prov'];
				$objBalonBean->setFeccre_bal(date("Y-m-d H:i:s"));
				$objBalonBean->setNombre_bal($nombre_bal);
				$objBalonBean->setTotal_bal($cantidad_regbal);
				$objBalonBean->setCantidad_bal($cantidad_regbal);
				$objBalonBean->setMarca_bal($marca_bal);
				$objBalonBean->setPeso_bal($peso_bal);
				$objBalonBean->setColor_bal($color_bal);
				$objBalonBean->setPrecio_bal($precio_bal);
				$objBalonBean->setTipo_bal($tipo_bal);
				$objBalonBean->setCategoria_bal($categoria_bal);
				$objBalonBean->setCodigo_fac($codigo_fac);
				$objBalonBean->setBarcode_bal($precodbar);
				$objBalonBean->setId_prov($id_prov);
				$objBalonBean->setFecha_regbal($fecha_regbal);
				$objBalonBean->setCantidad_regbal($cantidad_regbal);
				$objBalonBean->setId_per($Sid_per);
				$response = $objBalonDao->balonINSERT($objBalonBean);
				if ($response['STATUS'] == 'OK') {
					$id_bal = $response['ID'];
					for ($i=0;$i<$cantidad_regbal;$i++) {
						$response = $objBalonDao->balonxuINSERT($precodbar.($i+1),$id_bal);
						$texto = $precodbar.($i+1);
						$imagen = $generador->getBarcode($texto, $tipo);
						$bytesEscritos = file_put_contents('../dist/img/balon/'.$texto.'.png', $imagen);
					}
				}
				echo json_encode($response);
			} else {
				$objBalonBean->setFecha_regbal($fecha_regbal);
				$objBalonBean->setCantidad_regbal($cantidad_regbal);
				$objBalonBean->setId_bal($id_bal);
				$objBalonBean->setId_per($Sid_per);
				$response = $objBalonDao->registrobalonINSERT($objBalonBean);
				if ($response['STATUS'] == 'OK') {
					$balonDATA = $objBalonDao->balonDATA($id_bal);
					$response = $objBalonDao->total_balUPDATE($cantidad_regbal,$id_bal);
					$total_bal = $balonDATA['DATA'][0]['total_bal'];
					$hasta = $total_bal+$cantidad_regbal;
					if ($response['STATUS'] == 'OK') {
						for ($i=$total_bal;$i<$hasta;$i++) {
							$response = $objBalonDao->balonxuINSERT($precodbar.($i+1),$id_bal);
							$texto = $precodbar.($i+1);
							$imagen = $generador->getBarcode($texto, $tipo);
							$bytesEscritos = file_put_contents('../dist/img/balon/'.$texto.'.png', $imagen);
						}
					}
				}
				echo json_encode($response);
			}
			exit();
			break;
		}
		case 4: {
			$id_bal = $_GET['id_bal'];
			$balonDATA = $objBalonDao->balonDATA($id_bal);
			$marcaSELECTAGUA = $objBalonDao->marcaSELECT_tipo('AGUA');
			$marcaSELECTGAS = $objBalonDao->marcaSELECT_tipo('GAS');
			$coloresSELECT = $objBalonDao->coloresSELECT();
			$proveedorSELECT = $objProveedorDao->proveedorSELECT();
			unset($_SESSION['balonDATA']);
			unset($_SESSION['marcaSELECTAGUA']);
			unset($_SESSION['marcaSELECTGAS']);
			unset($_SESSION['coloresSELECT']);
			unset($_SESSION['proveedorSELECT']);
			$_SESSION['balonDATA'] = $balonDATA;
			$_SESSION['marcaSELECTAGUA'] = $marcaSELECTAGUA;
			$_SESSION['marcaSELECTGAS'] = $marcaSELECTGAS;
			$_SESSION['coloresSELECT'] = $coloresSELECT;
			$_SESSION['proveedorSELECT'] = $proveedorSELECT;
			$page = "../views/balon/frmBalonUPDATE.php";
			break;
		}
		case 5: {
			$tipo = $generador::TYPE_CODE_128;
			$id_bal = $_POST['id_bal'];
			$balonDATA = $objBalonDao->balonDATA($id_bal);
			$nombre_bal = $_POST['txtNombre_bal'];
			$cambioCantidad = $_POST['cambioCantidad'];
			$marca_bal = $_POST['sltMarca_bal'];
			$peso_bal = $_POST['nbrPeso_bal'];
			$color_bal = $_POST['txtColor_bal'];
			$precio_bal = $_POST['precio_bal'];
			$tipo_bal = $_POST['sltTipo_bal'];
			if (isset($_POST['categoria_bal'])) {
				$categoria_bal = 'PREMIUN';
			} else {
				$categoria_bal = 'NORMAL';
			}
			$codigo_fac = $_POST['codigo_fac'];
			$precodbar = $_POST['precodbar'];
			$id_prov = $_POST['sltId_prov'];
			$objBalonBean->setId_bal($id_bal);
			$objBalonBean->setNombre_bal($nombre_bal);
			$objBalonBean->setCantidad_bal($cambioCantidad);
			$objBalonBean->setMarca_bal($marca_bal);
			$objBalonBean->setPeso_bal($peso_bal);
			$objBalonBean->setColor_bal($color_bal);
			$objBalonBean->setPrecio_bal($precio_bal);
			$objBalonBean->setTipo_bal($tipo_bal);
			$objBalonBean->setCategoria_bal($categoria_bal);
			$objBalonBean->setCodigo_fac($codigo_fac);
			$objBalonBean->setBarcode_bal($precodbar);
			$objBalonBean->setId_prov($id_prov);
			$response = $objBalonDao->balonUPDATE($objBalonBean);
			if ($response['STATUS'] == 'OK') {
				if ($cambioCantidad != '0') {
					$objBalonBean->setFecha_regbal(date('Y-m-d H:i:s'));
					$objBalonBean->setCantidad_regbal($cambioCantidad);
					$objBalonBean->setId_bal($id_bal);
					$objBalonBean->setId_per($Sid_per);
					$response = $objBalonDao->registrobalonINSERT($objBalonBean);
					$total_bal = $balonDATA['DATA'][0]['total_bal'];
					$hasta = $total_bal+$cambioCantidad;
					if ($response['STATUS'] == 'OK') {
						for ($i=$total_bal;$i<$hasta;$i++) {
							$response = $objBalonDao->balonxuINSERT($precodbar.($i+1),$id_bal);
							$texto = $precodbar.($i+1);
							$imagen = $generador->getBarcode($texto, $tipo);
							$bytesEscritos = file_put_contents('../dist/img/balon/'.$texto.'.png', $imagen);
						}
					}
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 6: {
			$id_bal = $_POST['id_bal'];
			$response = $objBalonDao->balonDELETE($id_bal);
			echo json_encode($response);
			exit();
			break; 
		}
		case 7: {
			$data = (array)json_decode($_POST['data']);
			$objPrestamoBean->setFecha_pre(date('Y-m-d H:i:s'));
			$objPrestamoBean->setCantidad_pre($data['cantidad_pre']);
			$objPrestamoBean->setMotivo_pre($data['motivo_pre']);
			$objPrestamoBean->setId_cli($data['id_cli']);
			$objPrestamoBean->setId_per(1);
			$response = $objPrestamoDao->prestamoINSERT($objPrestamoBean);
			if ($response['STATUS'] == 'OK') {
				$objPrestamoBean->setId_pre($response['ID']);
				foreach ($data['balones'] as $list) {
					$objPrestamoBean->setId_bal($list->{'id_bal'});
					$response = $objPrestamoDao->balon_prestamoINSERT($objPrestamoBean);
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 8: {
			$fecini = $_GET['fecini'];
			$fecfin = $_GET['fecfin'];
			$tipo_bal = $_GET['tipo_bal'];
			$balonSELECT = $objBalonDao->filtroBalonSELECT($fecini . ' 00:00:00',$fecfin . ' 23:59:59',$tipo_bal);
			unset($_SESSION['balonSELECT']);
			$_SESSION['balonSELECT'] = $balonSELECT;
			$page = "../views/tablas/tableBalonPrincipal.php";
			break;
		}
		case 9: {
			//$productoSELECT = $objBalonDao->balonxuSELECT_tipo('GAS');
			$productoSELECT = $objBalonDao->balonSELECT('GAS');
			$clienteSELECT = $objClienteDao->clienteSELECT();
			$personalSELECT = $objPersonalDao->personalSELECT();
			unset($_SESSION['productoSELECT']);
			unset($_SESSION['clienteSELECT']);
			unset($_SESSION['personalSELECT']);
			$_SESSION['productoSELECT'] = $productoSELECT;
			$_SESSION['clienteSELECT'] = $clienteSELECT;
			$_SESSION['personalSELECT'] = $personalSELECT;
			$page = "../views/balon/balonSecondary.php?tipo_bal=GAS";
			break;
		}
		case 10: {
			$productoSELECT = $objBalonDao->productoSELECT('AGUA');
			$clienteSELECT = $objClienteDao->clienteSELECT();
			$personalSELECT = $objPersonalDao->personalSELECT();
			unset($_SESSION['productoSELECT']);
			unset($_SESSION['clienteSELECT']);
			unset($_SESSION['personalSELECT']);
			$_SESSION['productoSELECT'] = $productoSELECT;
			$_SESSION['clienteSELECT'] = $clienteSELECT;
			$_SESSION['personalSELECT'] = $personalSELECT;
			$page = "../views/balon/balonSecondary.php?tipo_bal=AGUA";
			break;
		}
		case 11: {
			$tipo = $_POST['tipo_bal'];
			$productoSELECT = $objBalonDao->productoSELECT($tipo);
			echo json_encode($productoSELECT);
			exit();
			break;
		}
		case 12: {
			$id_bal = $_POST['id_bal'];
			$balonDATA = $objBalonDao->balonDATA($id_bal);
			echo json_encode($balonDATA);
			exit();
			break;
		}
		case 13: {
			$registrobalonSELECT = $objBalonDao->registrobalonSELECT();
			unset($_SESSION['registrobalonSELECT']);
			$_SESSION['registrobalonSELECT'] = $registrobalonSELECT;
			$page = "../views/balon/balonHistory.php";
			break;
		}
		case 14: {
			$balonSELECT = $objBalonDao->balonSELECT();
			echo json_encode($balonSELECT);
			exit();
			break;
		}
		case 15: {
			$tipo = $_GET['tipo'];
			$marcaSELECT = $objBalonDao->marcaSELECT_tipo($tipo);
			echo json_encode($marcaSELECT);
			exit();
			break;
		}
		case 16: {
			$id_bal = $_GET['id_bal'];
			$balonDATA = $objBalonDao->balonDATA($id_bal);
			unset($_SESSION['balonDATA']);
			$_SESSION['balonDATA'] = $balonDATA;
			$page = "../views/balon/vstBalonxu.php";
			break;
		}
		case 17: {
			$id_bal = $_GET['id_bal'];
			$balonxuSELECT = $objBalonDao->balonxuSELECT_idbal($id_bal);
			echo json_encode($balonxuSELECT);
			exit();
			break;
		}
		case 18: {
			$codbar_balxu = $_GET['codbar_balxu'];
			$response = $objBalonDao->balonxuEXIST_barcode($codbar_balxu);
			echo json_encode($response);
			exit();
			break;
		}
		case 19: {
			$id_balxu = $_GET['id_balxu'];
			$balonxuDATA = $objBalonDao->balonxuDATA($id_balxu);
			unset($_SESSION['balonxuDATA']);
			$_SESSION['balonxuDATA'] = $balonxuDATA;
			$page = "../views/balon/scannerView.php";
			break;
		}
		case 20: {
			$id_bal = $_GET['id_bal'];
			$cantidad = $_GET['cantidad'];
			$balonxuSELECT = $objBalonDao->balonxuSELECT_idbalcantidad($id_bal,$cantidad);
			echo json_encode($balonxuSELECT);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>