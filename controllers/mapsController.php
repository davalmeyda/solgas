<?php
	require_once '../models/dao/mapsDao.php';
	require_once '../models/dao/ventaDao.php';
	require_once '../models/dao/balonDao.php';
	require_once '../models/dao/vehiculoDao.php';
	ini_set('display_errors',1);
	require("../dist/lib/PHPMailer/class.phpmailer.php");
	require("../dist/lib/PHPMailer/class.smtp.php");

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objMapsDao = new mapsDao();
	$objVentaDao = new ventaDao();
	$objBalonDao = new balonDao();
	$objVehiculoDao = new vehiculoDao();
	session_start();
	$Sid_per = $_SESSION['ID_PER'];
	date_default_timezone_set("America/Lima");
	switch ($op) {
		case 1: {
			$fecha = date('Y-m-d H:i:s');
			$lat_cli = $_POST['lat_cli'];
			$lng_cli = $_POST['lng_cli'];
			$id_cli = $_POST['id_cli'];
			$response = $objMapsDao->clientemapsINSERT($fecha, $lat_cli, $lng_cli, $id_cli);
			echo json_encode($response);
			exit();
			break;
		}
		case 2: {
			$fecha = date('Y-m-d H:i:s');
			$latitud = $_POST['latitud'];
			$longitud = $_POST['longitud'];
			$id_per = $_POST['id_per'];
			$response = $objMapsDao->repartidormapsINSERT($fecha, $latitud, $longitud, $id_per);
			echo json_encode($response);
			exit();
			break;
		}
		case 3: {
			$repartidormapsLIST = $objMapsDao->repartidormapsLIST();
			echo json_encode($repartidormapsLIST);
			exit();
			break;
		}
		case 4: {
			$id_cli = $_POST['id_cli'];
			$clientemapsDATA = $objMapsDao->clientemapsDATA($id_cli);
			echo json_encode($clientemapsDATA);
			exit();
			break;
		}
		case 5: {
			$id_cli = $_POST['id_cli'];
			$ventaSELECT = $objVentaDao->ventaSELECT_idcli($id_cli);
			$i=0;
			foreach ($ventaSELECT['DATA'] as $list) {
				$ventaSELECT['DATA'][$i]['nfecini_ven'] = $objBalonDao->NombrarFecha2(substr($list['fecini_ven'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecini_ven'], 11, 5));
				$i++;
			}
			echo json_encode($ventaSELECT);
			exit();
			break;
		}
		case 6: {
			$data = (array)json_decode($_POST['data']);
			$id_repmap = $data['id_repmap'];
			$id_ven = $data['id_ven'];
			$lat_ori = $data['my_lat'];
			$lng_ori = $data['my_lng'];
			$lat_des = $data['lat_cli'];
			$lng_des = $data['lng_cli'];
			$response = $objMapsDao->rutamapsINSERT($lat_ori,$lng_ori,$lat_des,$lng_des,$id_repmap,$id_ven,$Sid_per);
			if ($response['STATUS'] == 'OK') {
				$id_rutmap = $response['ID'];
				$response = $objVentaDao->estado_venUPDATE(4,$id_ven);
				if ($response['STATUS'] == 'OK') {
					$response = $objMapsDao->estado_repmapUPDATE(2,$id_repmap);
					if ($response['STATUS'] == 'OK') {
						$response = $objMapsDao->rutasmapsDATA($id_rutmap);
						$response['DATA'][0]['nfecha_rutmap'] = $objBalonDao->NombrarFecha2(substr($response['DATA'][0]['fecha_rutmap'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($response['DATA'][0]['fecha_rutmap'], 11, 5));
					}
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 7: {
			$ventaSELECT = $objMapsDao->rutasmapsLIST();
			$i=0;
			foreach ($ventaSELECT['DATA'] as $list) {
				$ventaSELECT['DATA'][$i]['nfecha_rutmap'] = $objBalonDao->NombrarFecha2(substr($list['fecha_rutmap'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecha_rutmap'], 11, 5));
				$i++;
			}
			echo json_encode($ventaSELECT);
			exit();
			break;
		}
		case 8: {
			$id_per = $_GET['id_per'];
			$estado_rutmap = $_GET['estado_rutmap'];
			$rutasmapsEXIST = $objMapsDao->rutasmaps_estadoEXIST($id_per,$estado_rutmap);
			echo json_encode($rutasmapsEXIST);
			exit();
			break;
		}
		case 9: {
			$id_repmap = $_POST['id_repmap'];
			$rutasmapsEXIST = $objMapsDao->Balon_ventaLIST_idrepmap($id_repmap);
			echo json_encode($rutasmapsEXIST);
			exit();
			break;
		}
		case 10: {
			$id_repmap = $_POST['id_repmap'];
			$repartidormapsDATA = $objMapsDao->repartidormapsDATA($id_repmap);
			echo json_encode($repartidormapsDATA);
			exit();
			break;
		}
		case 11: {
			$id_rutmap = $_GET['id_rutmap'];
			$isEXISTrutasmaps = $objMapsDao->rutasmapsDATA_estado($id_rutmap,2);
			echo json_encode($isEXISTrutasmaps);
			exit();
			break;
		}
		case 12: {//terminar recorrido;
			$id_rutmap = $_POST['id_rutmap'];
			$id_repmap = $_POST['id_repmap'];
			$id_ven = $_POST['id_ven'];
			$response = $objVentaDao->estado_venUPDATE(5,$id_ven);
			if ($response['STATUS'] == 'OK') {
				$response = $objMapsDao->estado_repmapUPDATE(1,$id_repmap);
				if ($response['STATUS'] == 'OK') {
					$response = $objMapsDao->rutasmapsEND(5,$id_rutmap);
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 13: {
			$id_cli = $_POST['id_cli'];
			$clienteidpreidrutmapidvenDATA = $objMapsDao->clienteidpreidrutmapidvenDATA($id_cli);
			$i=0;
			foreach ($clienteidpreidrutmapidvenDATA['DATA'] as $list) {
				$clienteidpreidrutmapidvenDATA['DATA'][$i]['nultima_atencion'] = $objBalonDao->NombrarFecha2(substr($list['ultima_atencion'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['ultima_atencion'], 11, 5));
				$i++;
			}
			echo json_encode($clienteidpreidrutmapidvenDATA);
			exit();
			break;
		}
		case 14: {
			$id_repmap = $_POST['id_repmap'];
			$rutasmapsDATA = $objMapsDao->rutasmapsDATA_idrepmap($id_repmap);
			$id_rutmap = $rutasmapsDATA['DATA'][0]['id_rutmap'];
			$id_ven = $rutasmapsDATA['DATA'][0]['id_ven'];
			$response = $objMapsDao->rutasmapsEND(4,$id_rutmap);
			if ($response['STATUS'] == 'OK') {
				$response = $objVentaDao->estado_venUPDATE(2,$id_ven);
				if ($response['STATUS'] == 'OK') {
					$response = $objMapsDao->estado_repmapUPDATE(1,$id_repmap);
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 15: {
			$rutasmapsDATA = $objMapsDao->rutasmapsDATA_idper($Sid_per);
			$i=0;
			foreach ($rutasmapsDATA['DATA'] as $list) {
				$rutasmapsDATA['DATA'][$i]['nfecha_rutmap'] = $objBalonDao->NombrarFecha2(substr($list['fecha_rutmap'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecha_rutmap'], 11, 5));
				$i++;
			}
			echo json_encode($rutasmapsDATA);
			exit();
			break;
		}
		case 16: {
			switch ($_GET['op2']) {
				case 1:
					$soatven_vehNOTI = $objVehiculoDao->soatven_vehNOTI();
					$i=0;
					foreach ($soatven_vehNOTI['DATA'] as $list) {
						$soatven_vehNOTI['DATA'][$i]['nsoatven_veh'] = $objBalonDao->NombrarFecha2(substr($list['soatven_veh'], 0, 10));
						$i++;
					}
					echo json_encode($soatven_vehNOTI);
					exit();
					break;
				case 2:
					$rutasmapsDATA = $objMapsDao->rutasmapsDATA_idadmin($Sid_per);
					$i=0;
					foreach ($rutasmapsDATA['DATA'] as $list) {
						$rutasmapsDATA['DATA'][$i]['nfecha_rutmap'] = $objBalonDao->NombrarFecha2(substr($list['fecha_rutmap'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecha_rutmap'], 11, 5));
						$rutasmapsDATA['DATA'][$i]['nfecfin_rutmap'] = $objBalonDao->NombrarFecha2(substr($list['fecfin_rutmap'], 0, 10)) . ", " .  $objBalonDao->amoldarHora(substr($list['fecfin_rutmap'], 11, 5));
						$i++;
					}
					echo json_encode($rutasmapsDATA);
					exit();
					break;
			}
			break;
		}
		case 17: {
			$id_rutmap = $_POST['id_rutmap'];
			$id_repmap = $_POST['id_repmap'];
			$id_ven = $_POST['id_ven'];
			$response = $objVentaDao->estado_venUPDATE(2,$id_ven);
			if ($response['STATUS'] == 'OK') {
				$response = $objMapsDao->estado_repmapUPDATE(1,$id_repmap);
				if ($response['STATUS'] == 'OK') {
					$response = $objMapsDao->rutasmapsEND(3,$id_rutmap);
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 18: {
			$id_rutmap = $_POST['id_rutmap'];
			$id_repmap = $_POST['id_repmap'];
			$id_ven = $_POST['id_ven'];
			$response = $objVentaDao->estado_venUPDATE(4,$id_ven);
			if ($response['STATUS'] == 'OK') {
				$response = $objMapsDao->estado_repmapUPDATE(3,$id_repmap);
				if ($response['STATUS'] == 'OK') {
					$response = $objMapsDao->estado_rutmapUPDATE(2,$id_rutmap);
					if ($response['STATUS'] == 'OK') {
						$response = $objMapsDao->rutasmapsDATA($id_rutmap);
						$mail = new PHPMailer();
			        	$mail->IsSMTP(); 
			 			$mail->Host = "smtp.gmail.com";	
						$mail->Port = 465;  
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = "ssl"; 
						$mail->SMTPDebug = 1; 
						$mail->From = "golegalsac@gmail.com";
						$mail->FromName = "Solgas";
						$mail->isHTML(true);
						$mail->Subject  = "Venta Solgas";
						$link = "https://solgastrujillo.pe/WebSystemSolgasv3.3/views/mapsClients.php?id_rutmap=" . $id_rutmap;
						$cuerpo = "<h4>Gracias por su compra</h4><br>
						<h6>Entra es este link para visializar la llegada de su producto</h6><br>
						<a href='" . $link . "'>https://solgastrujillo.pe/WebSystemSolgasv3.3/views/mapsClients.php</a>";
						$mail->Body = $cuerpo;
						$correo_cli = $response['DATA'][0]['correo_cli'];
						$nombres_cli = $response['DATA'][0]['nombres_cli'];
						$mail->AddAddress($correo_cli,$nombres_cli);
						$mail->SMTPAuth = true;
						$mail->Username = "esteticarubi20@gmail.com";
						$mail->Password = "Estetica@123";
						$mail->Send();
					}
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>