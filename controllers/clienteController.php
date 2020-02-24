<?php
	require_once '../models/dao/clienteDao.php';
	require_once '../models/dao/ventaDao.php';
	require_once '../models/dao/balonDao.php';

	require_once '../models/bean/clienteBean.php';
	require_once '../models/bean/ventaBean.php';
	require_once '../models/bean/balon_ventaBean.php';

	ini_set('display_errors',1);
	require("../dist/lib/PHPMailer/class.phpmailer.php");
	require("../dist/lib/PHPMailer/class.smtp.php");

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objClienteDao = new clienteDao();
	$objVentaDao = new ventaDao();
	$objBalonDao = new balonDao();

	$objClienteBean = new clienteBean();
	$objVentaBean = new ventaBean();
	$objBalon_ventaBean = new balon_ventaBean();
	session_start();
	if(isset($_SESSION['ID_PER'])) {
		$Sid_per = $_SESSION['ID_PER'];
		$Stipo_per = $_SESSION['TIPO_PER'];
	}
	if(isset($_SESSION['ID_CLI'])) {
		$Sid_cli = $_SESSION['ID_CLI'];
		$Stipdoc_cli = $_SESSION['TIPDOC_CLI'];
	}
	switch ($op) {
		case 1: {
			$clienteSELECT = $objClienteDao->clienteSELECT();
			unset($_SESSION['clienteSELECT']);
			$_SESSION['clienteSELECT'] = $clienteSELECT;
			$page = "../views/cliente/clientePrincipal.php";
			break;
		}
		case 2: {
			$nombres_cli = $_POST['txtNombres_cli'];
			$tipdoc_cli = $_POST['sltTipdoc_cli'];
			$numdoc_cli = $_POST['nbrNumdoc_cli'];
			$telefono_cli = $_POST['telefono_cli'];
			$direccion_cli = $_POST['direccion_cli'];
			$referencia_cli = $_POST['referencia_cli'];
			$correo_cli = $_POST['correo_cli'];
			$clave = 'solgas' . strtotime(date('Y-m-d H:i:s'));
			$objClienteBean->setNombres_cli($nombres_cli);
			$objClienteBean->setTipdoc_cli($tipdoc_cli);
			$objClienteBean->setNumdoc_cli($numdoc_cli);
			$objClienteBean->setTelefono_cli($telefono_cli);
			$objClienteBean->setDireccion_cli($direccion_cli);
			$objClienteBean->setReferencia_cli($referencia_cli);
			$objClienteBean->setCorreo_cli($correo_cli);
			$objClienteBean->setClave_cli($clave);
			$response = $objClienteDao->clienteINSERT($objClienteBean);
			if ($response['STATUS'] == 'OK') {
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
				$link = "https://solgastrujillo.pe/WebSystemSolgasv3.2/views/cliente";
				$cuerpo = "<h4>Se registro su cuenta en solgas</h4><br>
				<h6><strong>Clave: </strong>" . $clave . "</h6><br>
				<a href='" . $link . "'>https://solgastrujillo.pe/WebSystemSolgasv3.2/views/cliente</a>";
				$mail->Body = $cuerpo;
				$mail->AddAddress($correo_cli,$nombres_cli);
				$mail->SMTPAuth = true;
				$mail->Username = "esteticarubi20@gmail.com";
				$mail->Password = "Estetica@123";
				$mail->Send();
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 3: {
			$id_cli = $_GET['id_cli'];
			$clienteDATA = $objClienteDao->clienteDATA($id_cli);
			unset($_SESSION['clienteDATA']);
			$_SESSION['clienteDATA'] = $clienteDATA;
			$page = "../views/cliente/frmClienteUPDATE.php";
			break;
		}
		case 4: {
			$id_cli = $_POST['id_cli'];
			$nombres_cli = $_POST['txtNombres_cli'];
			$tipdoc_cli = $_POST['sltTipdoc_cli'];
			$numdoc_cli = $_POST['nbrNumdoc_cli'];
			$telefono_cli = $_POST['telefono_cli'];
			$direccion_cli = $_POST['direccion_cli'];
			$referencia_cli = $_POST['referencia_cli'];
			$correo_cli = $_POST['correo_cli'];
			$objClienteBean->setId_cli($id_cli);
			$objClienteBean->setNombres_cli($nombres_cli);
			$objClienteBean->setTipdoc_cli($tipdoc_cli);
			$objClienteBean->setNumdoc_cli($numdoc_cli);
			$objClienteBean->setTelefono_cli($telefono_cli);
			$objClienteBean->setDireccion_cli($direccion_cli);
			$objClienteBean->setReferencia_cli($referencia_cli);
			$objClienteBean->setCorreo_cli($correo_cli);
			$response = $objClienteDao->clienteUPDATE($objClienteBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 5: {
			$id_cli = $_POST['id_cli'];
			$response = $objClienteDao->clienteDELETE($id_cli);
			echo json_encode($response);
			exit();
			break; 
		}
		case 6: {
			$clienteSELECT = $objClienteDao->clienteSELECT();
			echo json_encode($clienteSELECT);
			exit();
			break;
		}
		case 7: {
			if ($Stipo_per == '1' && $Stipo_per == '2') {
				$creditoLIST = $objClienteDao->creditoLIST();
			} else {
				$creditoLIST = $objClienteDao->creditoLIST_idper($Sid_per);
			}
			unset($_SESSION['creditoLIST']);
			$_SESSION['creditoLIST'] = $creditoLIST;
			$page = "../views/cliente/frmCreditos.php";
			break;
		}
		case 8: {
			$id_ven = $_POST['id_ven'];
			if (isset($_POST['tipo_pago'])) {
				$tipo_pago = 2;//parcial
			} else {
				$tipo_pago = 1;//total
			}
			if (isset($_POST['modo_pago'])) {
				$modo_pago = 2;//tarjeta
			} else {
				$modo_pago = 1;//efectivo
			}
			$nutarjeta_pago = $_POST['nutarjeta_pago'];
			$observacion_pago = $_POST['observacion_pago'];
			$monto_pago = $_POST['monto_pago'];
			$objClienteBean->setTipo_pago($tipo_pago);
			$objClienteBean->setModo_pago($modo_pago);
			$objClienteBean->setNutarjeta_pago($nutarjeta_pago);
			$objClienteBean->setObservacion_pago($observacion_pago);
			$objClienteBean->setMonto_pago($monto_pago);
			$objClienteBean->setId_ven($id_ven);
			$response = $objClienteDao->pagoINSERT($objClienteBean, $Sid_per);
			if ($response['STATUS'] == 'OK') {
				$response = $objVentaDao->pago_venUPDATE($monto_pago,$id_ven);
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 9: {
			$correo = $_POST['correo'];
			$clave = $_POST['clave'];
			$response = $objClienteDao->clienteVALIDATE($correo,$clave);
			if (count($response['DATA']) >= 1) {
				unset($_SESSION['ID_CLI']);
				$_SESSION['ID_CLI'] = $response['DATA'][0]['id_cli'];
				$_SESSION['NOMBRES_CLI'] = $response['DATA'][0]['nombres_cli'];
				$_SESSION['TIPDOC_CLI'] = $response['DATA'][0]['tipdoc_cli'];
				$mensaje = "OK";
			} else {
				$mensaje = "ERROR";
			}
			echo json_encode($mensaje);
			exit();
			break;
		}
		case 10: {
			$balonGASSELECT = $objBalonDao->balonActivosSELECT_tipobal('GAS');
			$balonAGUASELECT = $objBalonDao->balonActivosSELECT_tipobal('AGUA');
			unset($_SESSION['balonGASSELECT']);
			unset($_SESSION['balonAGUASELECT']);
			$_SESSION['balonGASSELECT'] = $balonGASSELECT;
			$_SESSION['balonAGUASELECT'] = $balonAGUASELECT;
			$page = "../views/cliente/vstCliente_productos.php";
			break;
		}
		case 11: {
			$pedidosCliente = $objVentaDao->pedidosCliente($Sid_cli);
			$ventasCliente = $objVentaDao->ventasCliente($Sid_cli);
			unset($_SESSION['pedidosCliente']);
			unset($_SESSION['ventasCliente']);
			$_SESSION['pedidosCliente'] = $pedidosCliente;
			$_SESSION['ventasCliente'] = $ventasCliente;
			$page = "../views/cliente/vstCliente_pedidos.php";
			break;
		}
		case 12: {
			$tipdoc_cli = $_POST['tipdoc_cli'];
			$numdoc_cli = $_POST['numdoc_cli'];
			$nombres_cli = $_POST['nombres_cli'];
			$telefono_cli = $_POST['telefono_cli'];
			$correo_cli = $_POST['correo_cli'];
			$direccion_cli = $_POST['direccion_cli'];
			$referencia_cli = $_POST['referencia_cli'];
			$clave_cli = $_POST['clave_cli'];
			$objClienteBean->setNombres_cli($nombres_cli);
			$objClienteBean->setTipdoc_cli($tipdoc_cli);
			$objClienteBean->setNumdoc_cli($numdoc_cli);
			$objClienteBean->setTelefono_cli($telefono_cli);
			$objClienteBean->setDireccion_cli($direccion_cli);
			$objClienteBean->setReferencia_cli($referencia_cli);
			$objClienteBean->setCorreo_cli($correo_cli);
			$objClienteBean->setClave_cli($clave_cli);
			$response = $objClienteDao->clienteINSERT($objClienteBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 13: {
            session_start();
            session_destroy();
			$page = "../views/cliente";
			break;
		}
		case 14: {
			require_once '../plugins/vendor/autoload.php';
			require_once '../dist/plantilla/pltPedido.php';
			$css = file_get_contents('../dist/plantilla/style.css');
			$id_cli = $Sid_cli;
			$fecini_ped = date('Y-m-d H:i:s');
			if (isset($_POST['ckxCredito'])) {
				$fecfin_ped = "'" . date("Y-m-d",strtotime(date('Y-m-d')."+ ".$_POST['fecfin']." days")) . "'";
			} else {
				$fecfin_ped = 'NULL';
			}
			/*echo "->".$fecfin_ped."<-";
			exit();*/
			$tipdoc_cli = $Stipdoc_cli;
			if ($Stipdoc_cli == 1) {
				$tipo_comprobante = '3';
			}
			if ($Stipdoc_cli == 6) {
				$tipo_comprobante = '1';
			}
			$serie = $_POST['serie'];
			$gravado_ven = $_POST['gravado_ven'];
			$igv_ven = $_POST['igv_ven'];
			$total_ven = $_POST['total_ven'];
			$nfilas = $_POST['nfilas'];
			$objVentaBean->setFecini_ven($fecini_ped);
			$objVentaBean->setFecfin_ven($fecfin_ped);
			/*echo "->".$objVentaBean->getFecfin_ven()."<-";
			exit();*/
			$objVentaBean->setTipo_comprobante($tipo_comprobante);
			$objVentaBean->setSerie_ven($serie);
			$objVentaBean->setImporte_ven($gravado_ven);
			$objVentaBean->setIgv_ven($igv_ven);
			$objVentaBean->setTotal_ven($total_ven);
			$objVentaBean->setId_cli($id_cli);
			$response = $objClienteDao->pedidosINSERT($objVentaBean);
			if ($response['STATUS'] == 'OK') {
				$id_ped = $response['ID'];
				for ($i=0; $i < $nfilas; $i++) {
					$id_bal = $_POST['id_bal' . ($i+1)];
					$fecreg_balped = date('Y-m-d H:i:s');
					$unidad_balped = 'NIU';
					$descripcion_balped = $_POST['descripcion_balven' . ($i+1)];
					$cantidad_balped = $_POST['cantidad_balven' . ($i+1)];
					$igv_balped = $_POST['igv_balven' . ($i+1)];
					$valor_unitario = $_POST['valor_unitario' . ($i+1)];
					$precio_unitario = $_POST['precio_unitario' . ($i+1)];
					$descuento_balped = '0';
					$valor_balped = $_POST['total' . ($i+1)];
					$objBalon_ventaBean->setFecreg_balven($fecreg_balped);
					$objBalon_ventaBean->setUnidad_balven($unidad_balped);
					$objBalon_ventaBean->setDescripcion_balven($descripcion_balped);
					$objBalon_ventaBean->setCantidad_balven($cantidad_balped);
					$objBalon_ventaBean->setIgv_balven($igv_balped);
					$objBalon_ventaBean->setValor_unitario($valor_unitario);
					$objBalon_ventaBean->setPrecio_unitario($precio_unitario);
					$objBalon_ventaBean->setDescuento_balven($descuento_balped);
					$objBalon_ventaBean->setValor_balven($valor_balped);
					$objBalon_ventaBean->setId_bal($id_bal);
					$objBalon_ventaBean->setId_ven($id_ped);
					$response = $objClienteDao->balon_pedidoINSERT($objBalon_ventaBean);
					if ($response['STATUS'] == 'OK') {
						$response['ERROR'] = "<strong>CORRECTO!</strong> Pedido realizado correctamente.";
					} else {
						$response['ERROR'] = "<strong>ERROR!</strong> No se pudo registrar el pedido.";
					}
				}
				$mpdf = new \Mpdf\Mpdf([
				]);
				$pedidosDATA = $objClienteDao->pedidosDATA($id_ped);
				$balon_pedidoSELECT = $objClienteDao->balon_pedidoSELECT($id_ped);
				$plantilla = getpltPedido($pedidosDATA,$balon_pedidoSELECT);
				$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
				$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
				$mpdf->Output('../dist/pedidos/pedido' . $id_ped . '.pdf', 'F');
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 15: {
			$fecha =  $_POST['fechaPicker'];
			list($inicio, $barra, $fin) = explode(" ", $fecha);
			$fin = date('Y-m-d', strtotime($fin));
			$inicio = date('Y-m-d', strtotime($inicio));
			$response = $objClienteDao->creditoListFecha($inicio, $fin);

			if (!empty($response['DATA'])) {
				$nombre = 'reporte creditos.xls';
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=" . $nombre);

				$mostrar_columnas = false;

				foreach ($response['DATA'] as $data) {
					if (!$mostrar_columnas) {
						echo implode("\t", array_keys($data)) . "\n";
						$mostrar_columnas = true;
					}
					echo implode("\t", array_values($data)) . "\n";
				}
			} else {
				echo 'No hay datos a exportar';
			}
			exit();
			break;
		}
		case 16: { #Perfil de cliente
			$msj = '';
			if(isset($_GET['msj'])) {
				$msj = '?msj='.$_GET['msj'];
			}
			$clienteDATA = $objClienteDao->clienteDATA($Sid_cli);
			unset($_SESSION['clienteDATA']);
			$_SESSION['clienteDATA'] = $clienteDATA;
			$page = "../views/cliente/frmCliente_perfil.php".$msj;
			break;
		}
		case 17: { #Editar perfil de cliente
			$nombres_cli = $_POST['nombres_cli'];
			$telefono_cli = $_POST['telefono_cli'];
			$direccion_cli = $_POST['direccion_cli'];
			$referencia_cli = $_POST['referencia_cli'];
			$correo_cli = $_POST['correo_cli'];
			$clave_cli = $_POST['clave_cli'];
			$objClienteBean->setId_cli($Sid_cli);
			$objClienteBean->setNombres_cli($nombres_cli);
			$objClienteBean->setTelefono_cli($telefono_cli);
			$objClienteBean->setDireccion_cli($direccion_cli);
			$objClienteBean->setReferencia_cli($referencia_cli);
			$objClienteBean->setCorreo_cli($correo_cli);
			$objClienteBean->setClave_cli($clave_cli);
			$response = $objClienteDao->clienteUPDATExu($objClienteBean);
			echo json_encode($response);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>