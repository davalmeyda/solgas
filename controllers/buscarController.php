<?php
	include_once('../models/dao/clienteDao.php');
	include_once('../models/dao/balonDao.php');
	include_once('../models/dao/ventaDao.php');
	include_once('../models/dao/personalDao.php');
	if (isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if (isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objClienteDao = new clienteDao();
	$objBalonDao = new balonDao();
	$objVentaDao = new ventaDao();
	$objPersonalDao = new personalDao();
	switch ($op) {
		case 1: {
			$return_arr = array();
			$row_array = array();
			if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
				$parametro = $_GET['search'];
				$data = $objClienteDao->clienteSEARCH($parametro);

				if($data['STATUS'] == 'OK'){
					foreach ($data['DATA'] as $registros) {
						$row_array['id'] = $registros['id_cli'];
				        $row_array['text'] = $registros['nombres_cli'];
				        array_push($return_arr,$row_array);
					}
				}else{
					$row_array['id'] = 0;
				    $row_array['text'] = utf8_encode('Ecriba algo...');
				    array_push($return_arr,$row_array);
				}
			}else{
				$row_array['id'] = 0;
			    $row_array['text'] = utf8_encode('Ecriba algo...');
			    array_push($return_arr,$row_array);
			}
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			break;
		}
		case 2: {
			$return_arr = array();
			$row_array = array();
			if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
				$parametro = $_GET['search'];
				$data = $objBalonDao->balonSEARCH($parametro);

				if($data['STATUS'] == 'OK'){
					foreach ($data['DATA'] as $registros) {
						$row_array['id'] = $registros['id_bal'];
				        $row_array['text'] = $registros['nombre_bal'];
				        array_push($return_arr,$row_array);
					}
				}else{
					$row_array['id'] = 0;
				    $row_array['text'] = utf8_encode('Ecriba algo...');
				    array_push($return_arr,$row_array);
				}
			}else{
				$row_array['id'] = 0;
			    $row_array['text'] = utf8_encode('Ecriba algo...');
			    array_push($return_arr,$row_array);
			}
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			break;
		}
		case 3: {
			$return_arr = array();
			$row_array = array();
			if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
				$parametro = $_GET['search'];
				$data = $objVentaDao->ubigeoSEARCH($parametro);

				if($data['STATUS'] == 'OK'){
					foreach ($data['DATA'] as $registros) {
						$row_array['id'] = $registros['id_ubi'];
				        $row_array['text'] = $registros['acronimo_ubi'] . " - " . $registros['nombre_ubi'];
				        array_push($return_arr,$row_array);
					}
				}else{
					$row_array['id'] = 0;
				    $row_array['text'] = utf8_encode('Ecriba algo...');
				    array_push($return_arr,$row_array);
				}
			}else{
				$row_array['id'] = 0;
			    $row_array['text'] = utf8_encode('Ecriba algo...');
			    array_push($return_arr,$row_array);
			}
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			break;
		}
		case 4: {
			$return_arr = array();
			$row_array = array();
			if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
				$parametro = $_GET['search'];
				$data = $objPersonalDao->personalSERCH($parametro);
				if($data['STATUS'] == 'OK'){
					foreach ($data['DATA'] as $registros) {
						$row_array['id'] = $registros['id_per'];
				        $row_array['text'] = $registros['nombre_per'] . " - " . $registros['apellido_per'];
				        array_push($return_arr,$row_array);
					}
				}else{
					$row_array['id'] = 0;
				    $row_array['text'] = utf8_encode('Ecriba algo...');
				    array_push($return_arr,$row_array);
				}
			}else{
				$row_array['id'] = 0;
			    $row_array['text'] = utf8_encode('Ecriba algo...');
			    array_push($return_arr,$row_array);
			}
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			break;
		}
		case 5: {
			$return_arr = array();
			$row_array = array();
			if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
				$parametro = $_GET['search'];
				$data = $objPersonalDao->personalSERCH_idtemp($parametro,5);

				if($data['STATUS'] == 'OK'){
					foreach ($data['DATA'] as $registros) {
						$row_array['id'] = $registros['id_per'];
				        $row_array['text'] = $registros['nombre_per'] . " - " . $registros['apellido_per'];
				        array_push($return_arr,$row_array);
					}
				}else{
					$row_array['id'] = 0;
				    $row_array['text'] = utf8_encode('Ecriba algo...');
				    array_push($return_arr,$row_array);
				}
			}else{
				$row_array['id'] = 0;
			    $row_array['text'] = utf8_encode('Ecriba algo...');
			    array_push($return_arr,$row_array);
			}
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			break;
		}
	}
?>