<?php
	include_once('../models/dao/balonDao.php');
	include_once('../models/dao/clienteDao.php');
	include_once('../models/dao/ventaDao.php');
	include_once('../models/bean/ventaBean.php');
	include_once('../models/bean/balon_ventaBean.php');

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objBalonDao = new balonDao();
	$objClienteDao = new clienteDao();
	$objVentaDao = new ventaDao();
	$objVentaBean = new ventaBean();
	$objBalon_ventaBean = new balon_ventaBean();
	date_default_timezone_set("America/Lima");
	session_start();
	if(isset($_SESSION['ID_PER'])) {
		$Sid_per = $_SESSION['ID_PER'];
		$Stipo_per = $_SESSION['TIPO_PER'];
	}

	switch ($op) {
		case 1: {
			$pro=0;
			if(isset($_GET['pro'])) {
				$pro = $_GET['pro'];
			}
			$page = "../views/ventas/ventasPrincipal.php?pro=" . $pro;
			break;
		}
		case 2: {
			$balonDATA = $objBalonDao->balonDATA($_POST['id_bal']);
			echo json_encode($balonDATA);
			exit();
			break;
		}
		case 3: {
			$clienteDATA = $objClienteDao->clienteDATA($_POST['id_cli']);
			echo json_encode($clienteDATA);
			exit();
			break;
		}
		case 4: {
			if(isset($_POST['ckxProforma'])) {
				require_once '../plugins/vendor/autoload.php';
				require_once '../dist/plantilla/pltProforma.php';
				$css = file_get_contents('../dist/plantilla/style.css');
				$correlativo = $objVentaDao->proformaCOUNT();
				$id_per = $Sid_per;
				$id_cli = $_POST['id_cli'];
				//$fecini_ven = $_POST['fecini'];
				$fecini_ven = date('Y-m-d H:i:s');
				$moneda_ven = 1;
				$tipdoc_cli = $_POST['tipdoc_cli'];
				if ($tipdoc_cli == 1) {
					$tipo_comprobante = '3';
				}
				if ($tipdoc_cli == 6) {
					$tipo_comprobante = '1';
				}
				$tipo_operacion = '';
				$serie_ven = $_POST['serie'];
				$correlativo_ven = $correlativo['DATA'][0]['count(*)+1'];
				$gravado_ven = $_POST['gravado_ven'];
				//$descuento_ven = $_POST['descuento_ven'];
				$igv_ven = $_POST['igv_ven'];
				$total_ven = $_POST['total_ven'];
				$nfilas = $_POST['nfilas'];
				$objVentaBean->setFecini_ven($fecini_ven);
				$objVentaBean->setMoneda_ven($moneda_ven);
				$objVentaBean->setTipo_comprobante($tipo_comprobante);
				$objVentaBean->setTipo_operacion($tipo_operacion);
				$objVentaBean->setSerie_ven($serie_ven);
				$objVentaBean->setCorrelativo_ven($correlativo_ven);
				$objVentaBean->setImporte_ven($gravado_ven);
				//$objVentaBean->setDescuento_ven($descuento_ven);
				$objVentaBean->setIgv_ven($igv_ven);
				$objVentaBean->setTotal_ven($total_ven);
				$objVentaBean->setId_cli($id_cli);
				$objVentaBean->setId_per($Sid_per);
				$response = $objVentaDao->proformaINSERT($objVentaBean);
				if ($response['STATUS'] == 'OK') {
					$id_pro = $response['ID'];
					for ($i=0; $i < $nfilas; $i++) {
						$id_bal = $_POST['id_bal' . ($i+1)];
						$fecreg_balven = date('Y-m-d H:i:s');
						$unidad_balven = 'NIU';
						$descripcion_balven = $_POST['descripcion_balven' . ($i+1)];
						$cantidad_balven = $_POST['cantidad_balven' . ($i+1)];
						$igv_balven = $_POST['igv_balven' . ($i+1)];
						$valor_unitario = $_POST['valor_unitario' . ($i+1)];
						$precio_unitario = $_POST['precio_unitario' . ($i+1)];
						$descuento_balven = $_POST['descuento_balven' . ($i+1)];
						$valor_balven = $_POST['total' . ($i+1)];
						$objBalon_ventaBean->setFecreg_balven($fecreg_balven);
						$objBalon_ventaBean->setUnidad_balven($unidad_balven);
						$objBalon_ventaBean->setDescripcion_balven($descripcion_balven);
						$objBalon_ventaBean->setCantidad_balven($cantidad_balven);
						$objBalon_ventaBean->setIgv_balven($igv_balven);
						$objBalon_ventaBean->setValor_unitario($valor_unitario);
						$objBalon_ventaBean->setPrecio_unitario($precio_unitario);
						$objBalon_ventaBean->setDescuento_balven($descuento_balven);
						$objBalon_ventaBean->setValor_balven($valor_balven);
						$objBalon_ventaBean->setId_bal($id_bal);
						$objBalon_ventaBean->setId_ven($id_pro);
						$response = $objVentaDao->balon_proformaINSERT($objBalon_ventaBean);
						if ($response['STATUS'] == 'OK') {
							$response['ERROR'] = "<strong>CORRECTO!</strong> Proforma realizada correctamente.";
						} else {
							$response['ERROR'] = "<strong>ERROR!</strong> No se pudo registrar la proforma.";
						}
						//echo $id_bal . " - " . $fecreg_balven . " - " . $unidad_balven . " - " . $descripcion_balven . " - " . $cantidad_balven . " - " . $igv_balven . " - " . $valor_unitario . " - " . $precio_unitario . " - " . $descuento_balven . " - " . $valor_balven . "\n";
					}
					$mpdf = new \Mpdf\Mpdf([
					]);
					$proformaDATA = $objVentaDao->proformaDATA($id_pro);
					$balon_proformaSELECT = $objVentaDao->balon_proformaSELECT($id_pro);
					$plantilla = getpltProforma($proformaDATA,$balon_proformaSELECT);
					$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
					$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
					$mpdf->Output('../dist/proformas/proforma' . $id_pro . '.pdf', 'F');
					//$mpdf->Output("factura.pdf", "I");
				}
				//echo $correlativo_ven . " - " . $id_per . " - " . $id_cli . " - " . $fecini_ven . " - " . $tipdoc_cli . " - " . $tipo_comprobante . " - " . $serie_ven . " - " . $correlativo_ven . " - " . $importe_ven . " - " . $descuento_ven . " - " . $igv_ven . " - " . $total_ven . " - " . $nfilas;
				echo json_encode($response);
				exit();
			} else {
				// RUTA para enviar documentos
				$ruta = "https://api.vitekey.com/keyfact/integra-demo/v1/invoices";

				//TOKEN para enviar documentos
				$token = "e8b59a25-0489-446a-9b12-5f5c523ab438";

				$tipopago = 0;//debito
				if(isset($_POST['ckxCredito'])) {
					$tipopago = 1;//credito
				}
				$id_per = $Sid_per;
				$id_cli = $_POST['id_cli'];
				//$fecini_ven = $_POST['fecini'];
				$fecini_ven = date('Y-m-d H:i:s');
				$fecfin = $_POST['fecfin'];
				$fecfin_ven = date("m-d-Y",strtotime(date('Y-m-d')."+ ".$fecfin." days"));
				$moneda_ven = 1;
				$tipdoc_cli = $_POST['tipdoc_cli'];
				if ($tipdoc_cli == 1) {
					$tipo_comprobante = '03';
				}
				if ($tipdoc_cli == 6) {
					$tipo_comprobante = '01';
				}
				$tipo_operacion = '0101';
				$serie_ven = $_POST['serie'];
				$correlativo = $objVentaDao->comprobanteCOUNT($tipo_comprobante);
				$correlativo_ven = $correlativo['DATA'][0]['count(*)+1'];
				$gravado_ven = $_POST['gravado_ven'];
				//$descuento_ven = $_POST['descuento_ven'];
				$igv_ven = $_POST['igv_ven'];
				$total_ven = $_POST['total_ven'];
				$placa = $_POST['placa'];
				$ocompra = $_POST['ocompra'];
				$guia1 = '';
				if ($_POST['nguias'] == 1) {
					//$guia1 = 'REMITENTE - T001-'.$_POST['correlativo_gui1'];
				}
				$observaciones = $_POST['observaciones'];
				$nfilas = $_POST['nfilas'];
				$clienteDATA = $objClienteDao->clienteDATA($id_cli);
				$items = array();
		        for ($i=0; $i < $nfilas; $i++) {
					$id_bal = $_POST['id_bal' . ($i+1)];
					$unidad_balven = 'NIU';
					$descripcion_balven = $_POST['descripcion_balven' . ($i+1)];
					$cantidad_balven = $_POST['cantidad_balven' . ($i+1)];
					$igv_balven = $_POST['igv_balven' . ($i+1)];
					$valor_unitario = $_POST['valor_unitario' . ($i+1)];
					$precio_unitario = $_POST['precio_unitario' . ($i+1)];
					$descuento_balven = $_POST['descuento_balven' . ($i+1)];
					$valor_balven = $_POST['total' . ($i+1)];
		            array_push($items, array(
		                "codigo"                    => $id_bal,
		                "descripcion"               => $descripcion_balven,
		                "unidad_medida"          => $unidad_balven,
		                "cantidad"                  => $cantidad_balven,
		                "precio_unitario"           => $precio_unitario,
		                "descuento_porcentaje"           => 0,
		                "tipo_igv"               => "10"
		            ));
		        }
		        //"numero"                => $correlativo_ven,
		        if (isset($_POST['ckxCredito'])) {
			        $data = array(
			            'tipo' => $tipo_comprobante,
			            'serie' => $serie_ven,
			            'fecha_emision' => date('m-d-Y'),
			            'fecha_vencimiento' => $fecfin_ven,
			            'tipo_operacion' => '0101',
			            'cliente_tipo' => $tipdoc_cli,
			            'cliente_documento' => $clienteDATA['DATA'][0]['numdoc_cli'],
			            'cliente_nombre' => $clienteDATA['DATA'][0]['nombres_cli'],
			            'cliente_direccion' => $clienteDATA['DATA'][0]['direccion_cli'],
			            'cliente_email' => $clienteDATA['DATA'][0]['correo_cli'],
	  					'observaciones' => $observaciones,
	  					'placa_vehiculo' => $placa,
	  					'orden_compra' => $ocompra,
	  					'guia_remision' => $guia1,
	  					'descuento_global_porcentaje' => 0,
			            'moneda' => 'PEN',
			            'incluir_pdf' => true,
			            'incluir_xml' => true,
			            'items' => $items
			        );
			    } else {
			        $data = array(
			            'tipo' => $tipo_comprobante,
			            'serie' => $serie_ven,
			            'fecha_emision' => date('m-d-Y'),
			            'tipo_operacion' => '0101',
			            'cliente_tipo' => $tipdoc_cli,
			            'cliente_documento' => $clienteDATA['DATA'][0]['numdoc_cli'],
			            'cliente_nombre' => $clienteDATA['DATA'][0]['nombres_cli'],
			            'cliente_direccion' => $clienteDATA['DATA'][0]['direccion_cli'],
			            'cliente_email' => $clienteDATA['DATA'][0]['correo_cli'],
	  					'observaciones' => $observaciones,
	  					'placa_vehiculo' => $placa,
	  					'orden_compra' => $ocompra,
	  					'guia_remision' => $guia1,
	  					'descuento_global_porcentaje' => 0,
			            'moneda' => 'PEN',
			            'incluir_pdf' => true,
			            'incluir_xml' => true,
			            'items' => $items
			        );
			    }
		        /*var_dump($data);
		        exit();*/
		        $data_json = json_encode($data);

				//Invocamos el servicio de KEYFACIL
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $ruta);
				curl_setopt(
					$ch, CURLOPT_HTTPHEADER, array(
					#'Authorization: Token token="'.$token.'"',
					'Authorization: Bearer '.$token.'',
					'Content-Type: application/json',
					)
				);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$respuesta  = curl_exec($ch);
				curl_close($ch);

				$response = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
				$leer_respuesta = json_decode($respuesta, true);
		        if (isset($leer_respuesta['serie'])) {
		            $response['STATUS'] = 'OK';
		            $response['DATA']['serie'] = $leer_respuesta['serie'];
		            $response['DATA']['numero'] = $leer_respuesta['numero'];
		            //$response['DATA']['enlace'] = $leer_respuesta['enlace'];
		            //$response['DATA']['aceptada_por_sunat'] = $leer_respuesta['aceptada_por_sunat'];
		            //$response['DATA']['sunat_description'] = $leer_respuesta['sunat_description'];
		            //$response['DATA']['sunat_responsecode'] = $leer_respuesta['sunat_responsecode'];
		            $response['DATA']['pdf_base64'] = $leer_respuesta['pdf_base64'];
		            $response['ERROR'] = "<strong>CORRECTO!</strong> Factura ".$leer_respuesta['serie']."-".$leer_respuesta['numero']." generada correctamente.";
		        } else {
		            //Mostramos los errores si los hay
		            $response['STATUS'] = 'ERROR';
		            $response['ERROR'] = "<strong>ERROR!</strong> No se pudo registrar la Venta. " . $leer_respuesta['errors'];
		        }
		        echo json_encode($response);
			}
			exit();
			break;
		}
		case 5: {
			$tipopago = 0;//debito
			if(isset($_POST['ckxCredito'])) {
				$tipopago = 1;//credito
			}
			$pago_ven = $_POST['pago_ven'];
			$id_cli = $_POST['id_cli'];
			//$fecini_ven = $_POST['fecini'];
			$fecini_ven = date('Y-m-d H:i:s');
			$fecfin_ven = '';
			if (isset($_POST['ckxCredito'])) {
				$fecfin = $_POST['fecfin'];
				$fecfin_ven = date("Y-m-d",strtotime(date('Y-m-d')."+ ".$fecfin." days"));
			}
			$moneda_ven = 1;
			$tipdoc_cli = $_POST['tipdoc_cli'];
			if ($tipdoc_cli == 1) {
				$tipo_comprobante = '03';
			}
			if ($tipdoc_cli == 6) {
				$tipo_comprobante = '01';
			}
			$tipo_operacion = '0101';
			$serie_ven = $_POST['serie'];
			$correlativo_ven = $_POST['numero_comprobante'];
			$gravado_ven = $_POST['gravado_ven'];
			//$descuento_ven = $_POST['descuento_ven'];
			$igv_ven = $_POST['igv_ven'];
			$total_ven = $_POST['total_ven'];
			$placa = $_POST['placa'];
			$ocompra = $_POST['ocompra'];
			$guia1 = '';
			if ($_POST['nguias'] == 1) {
				//$guia1 = 'REMITENTE - T001-'.$_POST['correlativo_gui1'];
			}
			$observaciones = $_POST['observaciones'];
			$nfilas = $_POST['nfilas'];
			$pdf_base64 = $_POST['pdf_base64'];
			$objVentaBean->setFecini_ven($fecini_ven);
	        $objVentaBean->setFecfin_ven($fecfin_ven);
			$objVentaBean->setMoneda_ven($moneda_ven);
			$objVentaBean->setTipo_comprobante($tipo_comprobante);
			$objVentaBean->setTipo_pago($tipopago);
			$objVentaBean->setPago_ven($pago_ven);
			$objVentaBean->setTipo_operacion($tipo_operacion);
			$objVentaBean->setSerie_ven($serie_ven);
			$objVentaBean->setCorrelativo_ven($correlativo_ven);
			$objVentaBean->setImporte_ven($gravado_ven);
			//$objVentaBean->setDescuento_ven($descuento_ven);
			$objVentaBean->setIgv_ven($igv_ven);
			$objVentaBean->setTotal_ven($total_ven);
			$objVentaBean->setEstado_ven(2);
			$objVentaBean->setId_cli($id_cli);
			$objVentaBean->setId_per($Sid_per);
			$response = $objVentaDao->ventaINSERT($objVentaBean);
			if ($response['STATUS'] == 'OK') {
				$id_ven = $response['ID'];
				// Transformamos a pdf
				$pdf_decoded = base64_decode ($pdf_base64);
				$pdf = fopen ('../dist/comprobantes/' . $serie_ven . '-' . $correlativo_ven . '.pdf','w');
				fwrite ($pdf,$pdf_decoded);
				fclose ($pdf);
				for ($i=0; $i < $nfilas; $i++) {
					$id_bal = $_POST['id_bal' . ($i+1)];
					$fecreg_balven = date('Y-m-d H:i:s');
					$unidad_balven = 'NIU';
					$descripcion_balven = $_POST['descripcion_balven' . ($i+1)];
					$cantidad_balven = $_POST['cantidad_balven' . ($i+1)];
					$igv_balven = $_POST['igv_balven' . ($i+1)];
					$valor_unitario = $_POST['valor_unitario' . ($i+1)];
					$precio_unitario = $_POST['precio_unitario' . ($i+1)];
					$descuento_balven = $_POST['descuento_balven' . ($i+1)];
					$valor_balven = $_POST['total' . ($i+1)];
					$objBalon_ventaBean->setFecreg_balven($fecreg_balven);
					$objBalon_ventaBean->setUnidad_balven($unidad_balven);
					$objBalon_ventaBean->setDescripcion_balven($descripcion_balven);
					$objBalon_ventaBean->setCantidad_balven($cantidad_balven);
					$objBalon_ventaBean->setIgv_balven($igv_balven);
					$objBalon_ventaBean->setValor_unitario($valor_unitario);
					$objBalon_ventaBean->setPrecio_unitario($precio_unitario);
					$objBalon_ventaBean->setDescuento_balven($descuento_balven);
					$objBalon_ventaBean->setValor_balven($valor_balven);
					$objBalon_ventaBean->setId_bal($id_bal);
					$objBalon_ventaBean->setId_ven($id_ven);
					$response = $objVentaDao->balon_ventaINSERT($objBalon_ventaBean);
					if ($response['STATUS'] == 'OK') {
						$objBalonDao->cantidad_balRESTAUPDATE($id_bal,$cantidad_balven);
						$response['ERROR'] = "<strong>CORRECTO!</strong> Venta realizada correctamente.";
					} else {
						$response['ERROR'] = "<strong>ERROR!</strong> No se pudo registrar la Venta.";
					}
				}
				if ($_POST['id_pro'] != '') {
					$objVentaDao->proformaUPDATE(2,$id_ven,$_POST['id_pro']);
				}
			} else {
				$response['STATUS'] = "ERROR";
				$response['ERROR'] = $response['ERROR'];
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 6: {
			// RUTA para enviar documentos
			$ruta = "https://api.vitekey.com/keyfact/integra-demo/v1/invoices";

			//TOKEN para enviar documentos
			$token = "e8b59a25-0489-446a-9b12-5f5c523ab438";

			$id_ven = $_POST['id_ven'];
			$ventaDATA = $objVentaDao->ventaDATA($id_ven);
			$serie_ven = $ventaDATA['DATA'][0]['serie_ven'];
			$tipdoc_cli = $ventaDATA['DATA'][0]['tipdoc_cli'];
			$numdoc_cli = $ventaDATA['DATA'][0]['numdoc_cli'];
			$nombres_cli = $ventaDATA['DATA'][0]['nombres_cli'];
			$direccion_cli = $ventaDATA['DATA'][0]['direccion_cli'];
			$correo_cli = $ventaDATA['DATA'][0]['correo_cli'];
			$tipo_comprobante = '0' . $ventaDATA['DATA'][0]['tipo_comprobante'];
			$serie_ven = $ventaDATA['DATA'][0]['serie_ven'];
			$correlativo_ven = $ventaDATA['DATA'][0]['correlativo_ven'];

			$items = array();
			$balon_ventaSELECT = $objVentaDao->balon_ventaSELECT($id_ven);
			foreach ($balon_ventaSELECT['DATA'] as $list) {
				$id_bal = $list['id_bal'];
				$descripcion_balven = $list['descripcion_balven'];
				$unidad_balven = 'NIU';
				$cantidad_balven = $list['cantidad_balven'];
				$precio_unitario = $list['precio_unitario'];
				$valor_balven = $list['valor_balven'];
	            array_push($items, array(
	                "codigo"                    => $id_bal,
	                "descripcion"               => $descripcion_balven,
	                "unidad_medida"          => $unidad_balven,
	                "cantidad"                  => $cantidad_balven,
	                "precio_unitario"           => $precio_unitario,
	                "descuento_porcentaje"           => 0,
	                "tipo_igv"               => "10"
	            ));
			}

			$data = array(
	            'tipo' => '07',
	            'serie' => $serie_ven,
	            'fecha_emision' => date('m-d-Y'),
	            'tipo_operacion' => '0101',
	            'cliente_tipo' => $tipdoc_cli,
	            'cliente_documento' => $numdoc_cli,
	            'cliente_nombre' => $nombres_cli,
	            'cliente_direccion' => $direccion_cli,
	            'cliente_email' => $correo_cli,
	            'moneda' => 'PEN',
	            'nota_tipo' => '06',
				'nota_motivo' => "DEVOLUCION DE PRODUCTO",
				'nota_referencia_tipo' => $tipo_comprobante,
				'nota_referencia_serie' => $serie_ven,
				'nota_referencia_numero' => $correlativo_ven,
	            'incluir_pdf' => true,
	            'incluir_xml' => true,
			    'items' => $items
	        );
	        /*var_dump($data);
	        exit();*/
	        $data_json = json_encode($data);

			//Invocamos el servicio de KEYFACIL
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $ruta);
			curl_setopt(
				$ch, CURLOPT_HTTPHEADER, array(
				#'Authorization: Token token="'.$token.'"',
				'Authorization: Bearer '.$token.'',
				'Content-Type: application/json',
				)
			);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$respuesta  = curl_exec($ch);
			curl_close($ch);

			$response = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
			$leer_respuesta = json_decode($respuesta, true);
	        if (isset($leer_respuesta['serie'])) {
	            $response['STATUS'] = 'OK';
	            $response['DATA']['id_ven'] = $id_ven;
	            $response['DATA']['serie'] = $leer_respuesta['serie'];
	            $response['DATA']['numero'] = $leer_respuesta['numero'];
	            //$response['DATA']['enlace'] = $leer_respuesta['enlace'];
	            //$response['DATA']['aceptada_por_sunat'] = $leer_respuesta['aceptada_por_sunat'];
	            //$response['DATA']['sunat_description'] = $leer_respuesta['sunat_description'];
	            //$response['DATA']['sunat_responsecode'] = $leer_respuesta['sunat_responsecode'];
	            $response['DATA']['pdf_base64'] = $leer_respuesta['pdf_base64'];
	            $response['ERROR'] = "<strong>CORRECTO!</strong> Nota de credito ".$leer_respuesta['serie']."-".$leer_respuesta['numero']." generada correctamente.";
	        } else {
	            //Mostramos los errores si los hay
	            $response['STATUS'] = 'ERROR';
	            $response['ERROR'] = "<strong>ERROR!</strong> No se pudo generar la Nota de credito.";
	        }
	        echo json_encode($response);
	        exit();
			break;
		}
		case 7: {
			$id_ven = $_POST['id_ven'];
			$serie = $_POST['serie'];
			$numero = $_POST['numero'];
			$pdf_base64 = $_POST['pdf_base64'];
			$ventaDATA = $objVentaDao->ventaDATA($id_ven);
			$tipo_pago = $ventaDATA['DATA'][0]['tipo_pago'];
			$importe_ven = $ventaDATA['DATA'][0]['importe_ven'];
			$igv_ven = $ventaDATA['DATA'][0]['igv_ven'];
			$total_ven = $ventaDATA['DATA'][0]['total_ven'];
			$id_cli = $ventaDATA['DATA'][0]['id_cli'];
			$id_per = $ventaDATA['DATA'][0]['id_per'];
			$objVentaBean->setFecini_ven(date('Y-m-d H:i:s'));
	        $objVentaBean->setFecfin_ven('');
			$objVentaBean->setMoneda_ven('1');
			$objVentaBean->setTipo_comprobante(7);
			$objVentaBean->setTipo_pago($tipo_pago);
			$objVentaBean->setTipo_operacion('101');
			$objVentaBean->setSerie_ven($serie);
			$objVentaBean->setCorrelativo_ven($numero);
			$objVentaBean->setImporte_ven($importe_ven);
			//$objVentaBean->setDescuento_ven($descuento_ven);
			$objVentaBean->setIgv_ven($igv_ven);
			$objVentaBean->setTotal_ven($total_ven);
			$objVentaBean->setEstado_ven(2);
			$objVentaBean->setNota_credito($id_ven);
			$objVentaBean->setId_cli($id_cli);
			$objVentaBean->setId_per($id_per);
			$response = $objVentaDao->nota_creditoINSERT($objVentaBean);
			if ($response['STATUS'] == 'OK') {
				$id_venNota = $response['ID'];
				// Transformamos a pdf
				$pdf_decoded = base64_decode ($pdf_base64);
				$pdf = fopen ('../dist/comprobantes/' . $serie . '-' . $numero . '.pdf','w');
				fwrite ($pdf,$pdf_decoded);
				fclose ($pdf);
				$balon_ventaSELECT = $objVentaDao->balon_ventaSELECT($id_ven);
				foreach ($balon_ventaSELECT['DATA'] as $list) {
					$id_bal = $list['id_bal'];
					$fecreg_balven = date('Y-m-d H:i:s');
					$unidad_balven = 'NIU';
					$descripcion_balven = $list['descripcion_balven'];
					$cantidad_balven = $list['cantidad_balven'];
					$igv_balven = $list['igv_balven'];
					$valor_unitario = $list['valor_unitario'];
					$precio_unitario = $list['precio_unitario'];
					$descuento_balven = $list['descuento_balven'];
					$valor_balven = $list['valor_balven'];
					$objBalon_ventaBean->setFecreg_balven($fecreg_balven);
					$objBalon_ventaBean->setUnidad_balven($unidad_balven);
					$objBalon_ventaBean->setDescripcion_balven($descripcion_balven);
					$objBalon_ventaBean->setCantidad_balven($cantidad_balven);
					$objBalon_ventaBean->setIgv_balven($igv_balven);
					$objBalon_ventaBean->setValor_unitario($valor_unitario);
					$objBalon_ventaBean->setPrecio_unitario($precio_unitario);
					$objBalon_ventaBean->setDescuento_balven($descuento_balven);
					$objBalon_ventaBean->setValor_balven($valor_balven);
					$objBalon_ventaBean->setId_bal($id_bal);
					$objBalon_ventaBean->setId_ven($id_venNota);
					$response = $objVentaDao->balon_ventaINSERT($objBalon_ventaBean);
					if ($response['STATUS'] == 'OK') {
						$objBalonDao->cantidad_balSUMAUPDATE($cantidad_balven,$id_bal);
					}
				}
				$objVentaDao->ventaUPDATE(3,$id_ven);
			}
	        echo json_encode($response);
	        exit();
			break;
		}
		case 8: {
			$id_ven = $_GET['id_ven'];
			$balon_venta = $objVentaDao->balon_ventaSELECT($id_ven);
			$i=0;
			foreach ($balon_venta['DATA'] as $list) {
				for ($j=0;$j<$balon_venta['DATA'][$i]['cantidad_balven'];$j++) {
					$balon_venta['DATA'][$i]['balonxu'][$j]['codbar_balxu'] = '';
					$balon_venta['DATA'][$i]['balonxu'][$j]['fecha_balxuven'] = '';
					$balon_venta['DATA'][$i]['balonxu'][$j]['id_balxu'] = '';
				}
				$balon_venta['DATA'][$i]['balonxu'][0]['codbar_balxu'] = '';
				$balonxu_venta = $objVentaDao->balonxu_ventaSELECT_balven($list['id_balven']);
				for ($j=0;$j<count($balonxu_venta['DATA']);$j++) {
					$balon_venta['DATA'][$i]['balonxu'][$j]['codbar_balxu'] = $balonxu_venta['DATA'][$j]['codbar_balxu'];
					$balon_venta['DATA'][$i]['balonxu'][$j]['fecha_balxuven'] = $balonxu_venta['DATA'][$j]['fecha_balxuven'];
					$balon_venta['DATA'][$i]['balonxu'][$j]['id_balxu'] = $balonxu_venta['DATA'][$j]['id_balxu'];
				}
				$i++;
			}
			echo json_encode($balon_venta);
	        exit();
			break;
		}
		case 9: {
			$data = (array)json_decode($_POST['data']);
			foreach ($data['listBalxu'] as $list) {
				$response = $objVentaDao->balonxu_ventaINSERT($list->{'id_balven'},$list->{'id_balxu'});
				if ($response['STATUS'] == 'OK') {
					$response = $objBalonDao->estado_balxuINSERT(3,$list->{'id_balxu'});
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 10: {
			if(isset($_POST['ckxProforma'])) {
				require_once '../plugins/vendor/autoload.php';
				require_once '../dist/plantilla/pltProforma.php';
				$css = file_get_contents('../dist/plantilla/style.css');
				$correlativo = $objVentaDao->proformaCOUNT();
				$id_per = $Sid_per;
				$id_cli = $_POST['id_cli'];
				//$fecini_ven = $_POST['fecini'];
				$fecini_ven = date('Y-m-d H:i:s');
				$moneda_ven = 1;
				$tipdoc_cli = $_POST['tipdoc_cli'];
				if ($tipdoc_cli == 1) {
					$tipo_comprobante = '3';
				}
				if ($tipdoc_cli == 6) {
					$tipo_comprobante = '1';
				}
				$tipo_operacion = '';
				$serie_ven = $_POST['serie'];
				$correlativo_ven = $correlativo['DATA'][0]['count(*)+1'];
				$gravado_ven = $_POST['gravado_ven'];
				//$descuento_ven = $_POST['descuento_ven'];
				$igv_ven = $_POST['igv_ven'];
				$total_ven = $_POST['total_ven'];
				$nfilas = $_POST['nfilas'];
				$objVentaBean->setFecini_ven($fecini_ven);
				$objVentaBean->setMoneda_ven($moneda_ven);
				$objVentaBean->setTipo_comprobante($tipo_comprobante);
				$objVentaBean->setTipo_operacion($tipo_operacion);
				$objVentaBean->setSerie_ven($serie_ven);
				$objVentaBean->setCorrelativo_ven($correlativo_ven);
				$objVentaBean->setImporte_ven($gravado_ven);
				//$objVentaBean->setDescuento_ven($descuento_ven);
				$objVentaBean->setIgv_ven($igv_ven);
				$objVentaBean->setTotal_ven($total_ven);
				$objVentaBean->setId_cli($id_cli);
				$objVentaBean->setId_per($Sid_per);
				$response = $objVentaDao->proformaINSERT($objVentaBean);
				if ($response['STATUS'] == 'OK') {
					$id_pro = $response['ID'];
					for ($i=0; $i < $nfilas; $i++) {
						$id_bal = $_POST['id_bal' . ($i+1)];
						$fecreg_balven = date('Y-m-d H:i:s');
						$unidad_balven = 'NIU';
						$descripcion_balven = $_POST['descripcion_balven' . ($i+1)];
						$cantidad_balven = $_POST['cantidad_balven' . ($i+1)];
						$igv_balven = $_POST['igv_balven' . ($i+1)];
						$valor_unitario = $_POST['valor_unitario' . ($i+1)];
						$precio_unitario = $_POST['precio_unitario' . ($i+1)];
						$descuento_balven = $_POST['descuento_balven' . ($i+1)];
						$valor_balven = $_POST['total' . ($i+1)];
						$objBalon_ventaBean->setFecreg_balven($fecreg_balven);
						$objBalon_ventaBean->setUnidad_balven($unidad_balven);
						$objBalon_ventaBean->setDescripcion_balven($descripcion_balven);
						$objBalon_ventaBean->setCantidad_balven($cantidad_balven);
						$objBalon_ventaBean->setIgv_balven($igv_balven);
						$objBalon_ventaBean->setValor_unitario($valor_unitario);
						$objBalon_ventaBean->setPrecio_unitario($precio_unitario);
						$objBalon_ventaBean->setDescuento_balven($descuento_balven);
						$objBalon_ventaBean->setValor_balven($valor_balven);
						$objBalon_ventaBean->setId_bal($id_bal);
						$objBalon_ventaBean->setId_ven($id_pro);
						$response = $objVentaDao->balon_proformaINSERT($objBalon_ventaBean);
						if ($response['STATUS'] == 'OK') {
							$response['ERROR'] = "<strong>CORRECTO!</strong> Proforma realizada correctamente.";
						} else {
							$response['ERROR'] = "<strong>ERROR!</strong> No se pudo registrar la proforma.";
						}
						//echo $id_bal . " - " . $fecreg_balven . " - " . $unidad_balven . " - " . $descripcion_balven . " - " . $cantidad_balven . " - " . $igv_balven . " - " . $valor_unitario . " - " . $precio_unitario . " - " . $descuento_balven . " - " . $valor_balven . "\n";
					}
					$mpdf = new \Mpdf\Mpdf([
					]);
					$proformaDATA = $objVentaDao->proformaDATA($id_pro);
					$balon_proformaSELECT = $objVentaDao->balon_proformaSELECT($id_pro);
					$plantilla = getpltProforma($proformaDATA,$balon_proformaSELECT);
					$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);
					$mpdf->writeHtml($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
					$mpdf->Output('../dist/proformas/proforma' . $id_pro . '.pdf', 'F');
					//$mpdf->Output("factura.pdf", "I");
				}
				//echo $correlativo_ven . " - " . $id_per . " - " . $id_cli . " - " . $fecini_ven . " - " . $tipdoc_cli . " - " . $tipo_comprobante . " - " . $serie_ven . " - " . $correlativo_ven . " - " . $importe_ven . " - " . $descuento_ven . " - " . $igv_ven . " - " . $total_ven . " - " . $nfilas;
				echo json_encode($response);
				exit();
			} else {
				// RUTA para enviar documentos
				$ruta = "https://api.vitekey.com/keyfact/integra-demo/v1/invoices";

				//TOKEN para enviar documentos
				$token = "e8b59a25-0489-446a-9b12-5f5c523ab438";

				$tipopago = 0;//debito
				if(isset($_POST['ckxCredito'])) {
					$tipopago = 1;//credito
				}
				$id_per = $Sid_per;
				$id_cli = $_POST['id_cli'];
				//$fecini_ven = $_POST['fecini'];
				$fecini_ven = date('Y-m-d H:i:s');
				$fecfin = $_POST['fecfin'];
				$fecfin_ven = date("m-d-Y",strtotime(date('Y-m-d')."+ ".$fecfin." days"));
				$moneda_ven = 1;
				$tipdoc_cli = $_POST['tipdoc_cli'];
				if ($tipdoc_cli == 1) {
					$tipo_comprobante = '03';
				}
				if ($tipdoc_cli == 6) {
					$tipo_comprobante = '01';
				}
				$tipo_operacion = '0101';
				$serie_ven = $_POST['serie'];
				$correlativo = $objVentaDao->comprobanteCOUNT($tipo_comprobante);
				$correlativo_ven = $correlativo['DATA'][0]['count(*)+1'];
				$gravado_ven = $_POST['gravado_ven'];
				//$descuento_ven = $_POST['descuento_ven'];
				$igv_ven = $_POST['igv_ven'];
				$total_ven = $_POST['total_ven'];
				$placa = $_POST['placa'];
				$ocompra = $_POST['ocompra'];
				$guia1 = '';
				if ($_POST['nguias'] == 1) {
					//$guia1 = 'REMITENTE - T001-'.$_POST['correlativo_gui1'];
				}
				$observaciones = $_POST['observaciones'];
				$nfilas = $_POST['nfilas'];
				$clienteDATA = $objClienteDao->clienteDATA($id_cli);
				$items = array();
		        for ($i=0; $i < $nfilas; $i++) {
					$id_bal = $_POST['id_bal' . ($i+1)];
					$unidad_balven = 'NIU';
					$descripcion_balven = $_POST['descripcion_balven' . ($i+1)];
					$cantidad_balven = $_POST['cantidad_balven' . ($i+1)];
					$igv_balven = $_POST['igv_balven' . ($i+1)];
					$valor_unitario = $_POST['valor_unitario' . ($i+1)];
					$precio_unitario = $_POST['precio_unitario' . ($i+1)];
					$descuento_balven = $_POST['descuento_balven' . ($i+1)];
					$valor_balven = $_POST['total' . ($i+1)];
		            array_push($items, array(
		                "codigo"                    => $id_bal,
		                "descripcion"               => $descripcion_balven,
		                "unidad_medida"          => $unidad_balven,
		                "cantidad"                  => $cantidad_balven,
		                "precio_unitario"           => $precio_unitario,
		                "descuento_porcentaje"           => 0,
		                "tipo_igv"               => "10"
		            ));
		        }
		        //"numero"                => $correlativo_ven,
		        $data = array(
		            'tipo' => $tipo_comprobante,
		            'serie' => $serie_ven,
		            'fecha_emision' => date('m-d-Y'),
		            'tipo_operacion' => '0101',
		            'cliente_tipo' => '-',
		            'cliente_documento' => 'ANONIMO',
		            'cliente_nombre' => '---',
		            'cliente_direccion' => 'ANONIMO',
		            'cliente_email' => '',
  					'observaciones' => $observaciones,
  					'placa_vehiculo' => $placa,
  					'orden_compra' => $ocompra,
  					'guia_remision' => $guia1,
  					'descuento_global_porcentaje' => 0,
		            'moneda' => 'PEN',
		            'incluir_pdf' => true,
		            'incluir_xml' => true,
		            'items' => $items
		        );
		        /*var_dump($data);
		        exit();*/
		        $data_json = json_encode($data);

				//Invocamos el servicio de KEYFACIL
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $ruta);
				curl_setopt(
					$ch, CURLOPT_HTTPHEADER, array(
					#'Authorization: Token token="'.$token.'"',
					'Authorization: Bearer '.$token.'',
					'Content-Type: application/json',
					)
				);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$respuesta  = curl_exec($ch);
				curl_close($ch);

				$response = array('STATUS' => 'ERROR', 'ERROR' => '', 'DATA' => array());
				$leer_respuesta = json_decode($respuesta, true);
		        if (isset($leer_respuesta['serie'])) {
		            $response['STATUS'] = 'OK';
		            $response['DATA']['serie'] = $leer_respuesta['serie'];
		            $response['DATA']['numero'] = $leer_respuesta['numero'];
		            //$response['DATA']['enlace'] = $leer_respuesta['enlace'];
		            //$response['DATA']['aceptada_por_sunat'] = $leer_respuesta['aceptada_por_sunat'];
		            //$response['DATA']['sunat_description'] = $leer_respuesta['sunat_description'];
		            //$response['DATA']['sunat_responsecode'] = $leer_respuesta['sunat_responsecode'];
		            $response['DATA']['pdf_base64'] = $leer_respuesta['pdf_base64'];
		            $response['ERROR'] = "<strong>CORRECTO!</strong> Factura ".$leer_respuesta['serie']."-".$leer_respuesta['numero']." generada correctamente.";
		        } else {
		            //Mostramos los errores si los hay
		            $response['STATUS'] = 'ERROR';
		            $response['ERROR'] = "<strong>ERROR!</strong> No se pudo registrar la Venta. " . $leer_respuesta['errors'];
		        }
		        echo json_encode($response);
			}
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>