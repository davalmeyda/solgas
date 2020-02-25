<?php
require_once '../models/dao/ventaDao.php';
require_once '../models/dao/balonDao.php';
require_once '../models/dao/guiaremisionDao.php';
require_once '../models/bean/guiaremisionBean.php';
require_once '../models/dao/principalDao.php';
require_once '../models/dao/guiatransportistaDao.php';
require_once '../models/bean/guiatransportistaBean.php';

if (isset($_GET['op'])) {
	$op = $_GET['op'];
}
if (isset($_POST['op'])) {
	$op = $_POST['op'];
}
$objVentaDao = new ventaDao();
$objBalonDao = new balonDao();
$objGuiaremisionDao = new guiaremisionDao();
$objGuiaremisionBean = new guiaremisionBean();
$objPrincipalDao = new principalDao();
$objGuiatransportistaDao = new guiatransportistaDao();
$objGuiatransportistaBean = new guiatransportistaBean();
date_default_timezone_set("America/Lima");
session_start();
$Sid_per = $_SESSION['ID_PER'];
$Stipo_per = $_SESSION['TIPO_PER'];
switch ($op) {
	case 1: {
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}
			$nfecha = $objPrincipalDao->NombrarFecha($fecha);
			if ($Stipo_per == "1" || $Stipo_per == "2") {
				$proformaSELECT = $objVentaDao->proformaSELECT($fecha);
			} else {
				$proformaSELECT = $objVentaDao->proformaSELECT_idper($fecha, $Sid_per);
			}
			$i = 0;
			foreach ($proformaSELECT['DATA'] as $list) {
				$proformaSELECT['DATA'][$i]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($list['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecini_ven'], 11, 5));
				$i++;
			}
			unset($_SESSION['proformaSELECT']);
			$_SESSION['proformaSELECT'] = $proformaSELECT;
			$page = "../views/comprobantes/proformaVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
	case 2: {
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}
			$nfecha = $objPrincipalDao->NombrarFecha($fecha);
			$guiaremisionSELECT = $objGuiaremisionDao->guiaremisionSELECT($fecha);
			$i = 0;
			foreach ($guiaremisionSELECT['DATA'] as $list) {
				$guiaremisionSELECT['DATA'][$i]['nfecemi_gui'] = $objBalonDao->NombrarFecha2(substr($list['fecemi_gui'], 0, 10));
				$i++;
			}
			unset($_SESSION['guiaremisionSELECT']);
			$_SESSION['guiaremisionSELECT'] = $guiaremisionSELECT;
			$page = "../views/comprobantes/GuiaremisionVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
	case 3: {
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}
			$nfecha = $objPrincipalDao->NombrarFecha($fecha);
			if ($Stipo_per == "1" || $Stipo_per == "2") {
				$ventaSELECT = $objVentaDao->ventaSELECT($fecha);
			} else {
				$ventaSELECT = $objVentaDao->ventaSELECT_idper($fecha, $Sid_per);
			}
			$i = 0;
			foreach ($ventaSELECT['DATA'] as $list) {
				$ventaSELECT['DATA'][$i]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($list['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecini_ven'], 11, 5));
				$i++;
			}
			unset($_SESSION['ventaSELECT']);
			$_SESSION['ventaSELECT'] = $ventaSELECT;
			$page = "../views/comprobantes/historialventasVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
	case 4: {
			require_once '../plugins/vendor/autoload.php';
			require_once '../dist/plantilla/pltGuiaRemision.php';
			$count = $objGuiaremisionDao->guiaremisionCOUNT();
			$serie = $_POST['serie'];
			$correlativo = $count['DATA'][0]['count(*)+1'];
			$fecemi = $_POST['fecemi'];
			$id_cli = $_POST['id_cli'];
			$observaciones = $_POST['observaciones'];
			$ubigeoori = $_POST['ubigeoori'];
			$ubigeodes = $_POST['ubigeodes'];
			$direccionori = $_POST['direccionori'];
			$direcciondes = $_POST['direcciondes'];
			$tipenvio = $_POST['tipenvio'];
			$fecenvio = $_POST['fecenvio'];
			$cantbultos = $_POST['cantbultos'];
			$peso = $_POST['peso'];
			$movilidad = $_POST['movilidad'];
			$id_per = $_POST['id_per'];
			$nfilas = $_POST['nfilas'];
			$objGuiaremisionBean->setSerie_gui($serie);
			$objGuiaremisionBean->setCorrelativo_gui($correlativo);
			$objGuiaremisionBean->setFecemi_gui($fecemi);
			$objGuiaremisionBean->setObservacion_gui($observaciones);
			$objGuiaremisionBean->setUbigeoori_gui($ubigeoori);
			$objGuiaremisionBean->setDireccionori($direccionori);
			$objGuiaremisionBean->setUbigeodes_gui($ubigeodes);
			$objGuiaremisionBean->setDirecciondes($direcciondes);
			$objGuiaremisionBean->setTipoenvio($tipenvio);
			$objGuiaremisionBean->setFecenvio($fecenvio);
			$objGuiaremisionBean->setCantbultos($cantbultos);
			$objGuiaremisionBean->setPeso($peso);
			$objGuiaremisionBean->setMovilidad($movilidad);
			$objGuiaremisionBean->setTransportista($id_per);
			$objGuiaremisionBean->setId_cli($id_cli);
			$response = $objGuiaremisionDao->guiaremisionINSERT($objGuiaremisionBean);
			if ($response['STATUS'] == 'OK') {
				$id_gui = $response['ID'];
				$objGuiaremisionBean->setId_gui($id_gui);
				for ($i = 0; $i < $nfilas; $i++) {
					$objGuiaremisionBean->setCantidad_balgui($_POST['cantidad_balgui' . ($i + 1)]);
					$objGuiaremisionBean->setDetalle_balgui($_POST['detalle_balgui' . ($i + 1)]);
					$objGuiaremisionBean->setId_bal($_POST['id_bal' . ($i + 1)]);
					$response = $objGuiaremisionDao->balon_guiaINSERT($objGuiaremisionBean);
				}
				if ($response['STATUS'] == 'OK') {
					$css = file_get_contents('../dist/plantilla/style.css');
					$mpdf = new \Mpdf\Mpdf([]);
					$guiaremisionDATA = $objGuiaremisionDao->guiaremisionDATA($id_gui);
					$balon_guiaSELECT = $objGuiaremisionDao->balon_guiaSELECT($id_gui);
					$plantilla = getpltGuiaRemision($guiaremisionDATA, $balon_guiaSELECT);
					$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
					$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
					$mpdf->Output('../dist/guiaremision/guiaremision' . $id_gui . '.pdf', 'F');
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
	case 5: {
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}
			$nfecha = $objPrincipalDao->NombrarFecha($fecha);
			$guiatransportistaSELECT = $objGuiatransportistaDao->guiatransportistaSELECT($fecha);
			$i = 0;
			foreach ($guiatransportistaSELECT['DATA'] as $list) {
				$guiatransportistaSELECT['DATA'][$i]['nfecha_guitra'] = $objBalonDao->NombrarFecha2(substr($list['fecha_guitra'], 0, 10)) . ", " . $objPrincipalDao->amoldarHora(substr($list['fecha_guitra'], 11, 5));
				$i++;
			}
			unset($_SESSION['guiatransportistaSELECT']);
			$_SESSION['guiatransportistaSELECT'] = $guiatransportistaSELECT;
			$page = "../views/comprobantes/GuiatransportistaVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
	case 6: {
			require_once '../plugins/vendor/autoload.php';
			require_once '../dist/plantilla/pltGuiaTransportista.php';
			$count = $objGuiaremisionDao->guiaremisionCOUNT();
			$Fecha_guitra = date('Y-m-d H:i:s');
			$Nombres_guitra = $_POST['nombers_guitra'];
			$Puntopartida_guitra = $_POST['puntopartida_guitra'];
			$Ruc_guitra = $_POST['ruc_guitra'];
			$Puntollegada_guitra = $_POST['puntollegada_guitra'];
			$Placa_guitra = $_POST['placa_guitra'];
			$Nconstancia_guitra = $_POST['nconstancia_guitra'];
			$Nlicencia_guitra = $_POST['nlicencia_guitra'];
			$Serie_ven = $_POST['serie_ven'];
			$Numero_ven = $_POST['numero_ven'];
			$nfilas = $_POST['nfilas'];
			$objGuiatransportistaBean->setFecha_guitra($Fecha_guitra);
			$objGuiatransportistaBean->setNombres_guitra($Nombres_guitra);
			$objGuiatransportistaBean->setPuntopartida_guitra($Puntopartida_guitra);
			$objGuiatransportistaBean->setRuc_guitra($Ruc_guitra);
			$objGuiatransportistaBean->setPuntollegada_guitra($Puntollegada_guitra);
			$objGuiatransportistaBean->setPlaca_guitra($Placa_guitra);
			$objGuiatransportistaBean->setNconstancia_guitra($Nconstancia_guitra);
			$objGuiatransportistaBean->setNlicencia_guitra($Nlicencia_guitra);
			$objGuiatransportistaBean->setSerie_ven($Serie_ven);
			$objGuiatransportistaBean->setNumero_ven($Numero_ven);
			$response = $objGuiatransportistaDao->guiatransportistaINSERT($objGuiatransportistaBean);
			if ($response['STATUS'] == 'OK') {
				$id_guitra = $response['ID'];
				$objGuiatransportistaBean->setId_guitra($id_guitra);
				for ($i = 0; $i < $nfilas; $i++) {
					$objGuiatransportistaBean->setCantidad_balguitra($_POST['cantidad_balguitra' . ($i + 1)]);
					$objGuiatransportistaBean->setId_bal($_POST['id_bal' . ($i + 1)]);
					$response = $objGuiatransportistaDao->balon_guitraINSERT($objGuiatransportistaBean);
				}
				//$id_guitra = 1;
				$css = file_get_contents('../dist/plantilla/style.css');
				$mpdf = new \Mpdf\Mpdf([]);
				$guiatransportistaDATA = $objGuiatransportistaDao->guiatransportistaDATA($id_guitra);
				$balon_guitraSELECT = $objGuiatransportistaDao->balon_guitraSELECT($id_guitra);
				$plantilla = getpltGuiaTransportista($guiatransportistaDATA, $balon_guitraSELECT);
				$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
				$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
				$mpdf->Output('../dist/guiatransportista/guiatransportista' . $id_guitra . '.pdf', 'F');
			}
			echo json_encode($response);
			exit();
			break;
		}
	case 7: {
			$id_ven = $_POST['id_ven'];
			$ventaDATA = $objVentaDao->ventaDATA($id_ven);
			$ventaDATA['DATA'][0]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($ventaDATA['DATA'][0]['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($ventaDATA['DATA'][0]['fecini_ven'], 11, 5));
			$ventaDATA['DATA'][0]['serie_docafec'] = '';
			$ventaDATA['DATA'][0]['numero_docafec'] = '';
			if ($ventaDATA['DATA'][0]['tipo_comprobante'] == 7) {
				$venta2DATA = $objVentaDao->ventaDATA($ventaDATA['DATA'][0]['nota_credito']);
				$ventaDATA['DATA'][0]['serie_docafec'] = $venta2DATA['DATA'][0]['serie_ven'];
				$ventaDATA['DATA'][0]['numero_docafec'] = $venta2DATA['DATA'][0]['correlativo_ven'];
			}
			echo json_encode($ventaDATA);
			exit();
			break;
		}
	case 8: {
			$id_gui = $_POST['id_gui'];
			$guiaremisionDATA = $objGuiaremisionDao->guiaremisionDATA($id_gui);
			$guiaremisionDATA['DATA'][0]['nfecemi_gui'] = $objBalonDao->NombrarFecha2(substr($guiaremisionDATA['DATA'][0]['fecemi_gui'], 0, 10));
			echo json_encode($guiaremisionDATA);
			exit();
			break;
		}
	case 9: {
			$id_pro = $_POST['id_pro'];
			$proformaDATA = $objVentaDao->proformaDATA($id_pro);
			$proformaDATA['DATA'][0]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($proformaDATA['DATA'][0]['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($proformaDATA['DATA'][0]['fecini_ven'], 11, 5));
			echo json_encode($proformaDATA);
			exit();
			break;
		}
	case 10: {
			$id_guitra = $_POST['id_guitra'];
			$guiatransportistaDATA = $objGuiatransportistaDao->guiatransportistaDATA($id_guitra);
			$guiatransportistaDATA['DATA'][0]['nfecha_guitra'] = $objBalonDao->NombrarFecha2(substr($guiatransportistaDATA['DATA'][0]['fecha_guitra'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($guiatransportistaDATA['DATA'][0]['fecha_guitra'], 11, 5));
			echo json_encode($guiatransportistaDATA);
			exit();
			break;
		}
	case 11: {
			$id_pro = $_POST['id_pro'];
			$proformaDATA = $objVentaDao->proformaDATA($id_pro);
			$proformaDATA['DATA'][0]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($proformaDATA['DATA'][0]['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($proformaDATA['DATA'][0]['fecini_ven'], 11, 5));
			$balon_proformaSELECT = $objVentaDao->balon_proformaSELECT($id_pro);
			$i = 0;
			foreach ($balon_proformaSELECT['DATA'] as $list) {
				$proformaDATA['DATA'][0]['BALONES'][$i]['id_bal'] = $list['id_bal'];
				$proformaDATA['DATA'][0]['BALONES'][$i]['nombre_bal'] = $list['descripcion_balven'];
				$proformaDATA['DATA'][0]['BALONES'][$i]['cantidad_balven'] = $list['cantidad_balven'];
				$proformaDATA['DATA'][0]['BALONES'][$i]['descuento_balven'] = $list['descuento_balven'];
				$proformaDATA['DATA'][0]['BALONES'][$i]['precio_unitario'] = $list['precio_unitario'];
				$balonDATA = $objBalonDao->balonDATA($list['id_bal']);
				$proformaDATA['DATA'][0]['BALONES'][$i]['cantidad_bal'] = $balonDATA['DATA'][0]['cantidad_bal'];
				$i++;
			}
			echo json_encode($proformaDATA);
			exit();
			break;
		}
	case 12: {
			$id_pro = $_GET['id_pro'];
			$objVentaDao->proformaUPDATE(0, '', $id_pro);
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}
			$nfecha = $objPrincipalDao->NombrarFecha($fecha);
			$proformaSELECT = $objVentaDao->proformaSELECT($fecha);
			$i = 0;
			foreach ($proformaSELECT['DATA'] as $list) {
				$proformaSELECT['DATA'][$i]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($list['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecini_ven'], 11, 5));
				$i++;
			}
			unset($_SESSION['proformaSELECT']);
			$_SESSION['proformaSELECT'] = $proformaSELECT;
			$page = "../views/comprobantes/proformaVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
	case 13: {
			require_once '../plugins/vendor/autoload.php';
			require_once '../dist/plantilla/pltGuiaTransportistaREPORTE.php';
			$css = file_get_contents('../dist/plantilla/style.css');
			$mpdf = new \Mpdf\Mpdf([]);
			$fecha = $_GET['fecha'];
			$guitraSELECT = $objGuiatransportistaDao->guiatransportistaSELECT($fecha);
			$i = 0;
			foreach ($guitraSELECT['DATA'] as $list) {
				$guitraSELECT['DATA'][$i]['noComprobante'] = $list['serie_ven'] . "-" . $list['numero_ven'];
				$guitraSELECT['DATA'][$i]['nombres_guitra'] = $list['nombres_guitra'];
				$guitraSELECT['DATA'][$i]['placa_guitra'] = $list['placa_guitra'];
				$guitraSELECT['DATA'][$i]['puntopartida_guitra'] = $list['puntopartida_guitra'];
				$guitraSELECT['DATA'][$i]['puntollegada_guitra'] = $list['puntollegada_guitra'];
				$guitraSELECT['DATA'][$i]['nconstancia_guitra'] = $list['nconstancia_guitra'];
				$guitraSELECT['DATA'][$i]['nlicencia_guitra'] = $list['nlicencia_guitra'];
				$balon_guitraSELECT = $objGuiatransportistaDao->balon_guitraSELECT($list['id_guitra']);
				for ($j = 0; $j < count($balon_guitraSELECT['DATA']); $j++) {
					$guitraSELECT['DATA'][$i]['balon'][$j]['nombre_bal'] = $balon_guitraSELECT['DATA'][$j]['nombre_bal'];
					$guitraSELECT['DATA'][$i]['balon'][$j]['cantidad_balguitra'] = $balon_guitraSELECT['DATA'][$j]['cantidad_balguitra'];
				}
				$i++;
			}
			$plantilla = getpltGuiaTransportistaREPORTE($guitraSELECT);
			$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
			$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
			//$mpdf->Output('../dist/proformas/proformas.pdf', 'F');
			$response = false;
			$mpdf->Output("factura.pdf", "I");
			exit();
			break;
		}
	case 14: {
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}
			$nfecha = $objPrincipalDao->NombrarFecha($fecha);

			$pedidosSELECT = $objVentaDao->pedidosSELECT($fecha);

			$i = 0;
			foreach ($pedidosSELECT['DATA'] as $list) {
				$pedidosSELECT['DATA'][$i]['nfecini_ped'] = $objBalonDao->NombrarFecha2(substr($list['fecini_ped'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecini_ped'], 11, 5));
				$i++;
			}
			// var_dump($pedidosSELECT);
			unset($_SESSION['pedidosSELECT']);
			$_SESSION['pedidosSELECT'] = $pedidosSELECT;
			$page = "../views/comprobantes/pedidosVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
	case 15: {
			$id_ped = $_POST['id_ped'];
			$proformaDATA = $objVentaDao->pedidosDATA($id_ped);
			$proformaDATA['DATA'][0]['nfecini_ped'] = $objBalonDao->NombrarFecha2(substr($proformaDATA['DATA'][0]['fecini_ped'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($proformaDATA['DATA'][0]['fecini_ped'], 11, 5));
			echo json_encode($proformaDATA);
			exit();
			break;
		}
	case 16: {
			$id_ped = $_POST['id_ped'];
			$pedidosDATA = $objVentaDao->pedidosDATA($id_ped);
			$pedidosDATA['DATA'][0]['nfecini_ped'] = $objBalonDao->NombrarFecha2(substr($pedidosDATA['DATA'][0]['fecini_ped'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($pedidosDATA['DATA'][0]['fecini_ped'], 11, 5));
			$balon_pedidoSELECT = $objVentaDao->balon_pedidoSELECT($id_ped);
			$i = 0;
			foreach ($balon_pedidoSELECT['DATA'] as $list) {
				$pedidosDATA['DATA'][0]['BALONES'][$i]['id_bal'] = $list['id_bal'];
				$pedidosDATA['DATA'][0]['BALONES'][$i]['nombre_bal'] = $list['descripcion_balped'];
				$pedidosDATA['DATA'][0]['BALONES'][$i]['cantidad_balven'] = $list['cantidad_balped'];
				$pedidosDATA['DATA'][0]['BALONES'][$i]['descuento_balven'] = $list['descuento_balped'];
				$pedidosDATA['DATA'][0]['BALONES'][$i]['precio_unitario'] = $list['precio_unitario'];
				$balonDATA = $objBalonDao->balonDATA($list['id_bal']);
				$pedidosDATA['DATA'][0]['BALONES'][$i]['cantidad_bal'] = $balonDATA['DATA'][0]['cantidad_bal'];
				$i++;
			}
			echo json_encode($pedidosDATA);
			exit();
			break;
		}
	case 17: {
			$id_ped = $_GET['id_ped'];
			$objVentaDao->pedidoUPDATE(0, '', $id_ped);
			if (isset($_GET['fecha'])) {
				$fecha = $_GET['fecha'];
			} else {
				$fecha = date('Y-m-d');
			}

			$nfecha = $objPrincipalDao->NombrarFecha($fecha);

			$pedidosSELECT = $objVentaDao->pedidosSELECT($fecha);

			$i = 0;
			foreach ($pedidosSELECT['DATA'] as $list) {
				$pedidosSELECT['DATA'][$i]['nfecini_ped'] = $objBalonDao->NombrarFecha2(substr($list['fecini_ped'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecini_ped'], 11, 5));
				$i++;
			}
			// var_dump($pedidosSELECT);
			unset($_SESSION['pedidosSELECT']);
			$_SESSION['pedidosSELECT'] = $pedidosSELECT;
			$page = "../views/comprobantes/pedidosVista.php?fecha=" . $fecha . "&nfecha=" . $nfecha;
			break;
		}
}
header("Location:" . $page);
