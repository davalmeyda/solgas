<?php
	require_once '../models/dao/personalDao.php';
	require_once '../models/dao/guiatransportistaDao.php';

	require_once '../models/bean/personalBean.php';

	if(isset($_GET['op'])) {
		$op = $_GET['op'];
	}
	if(isset($_POST['op'])) {
		$op = $_POST['op'];
	}
	$objPersonalDao = new personalDao();
	$objGuiatransportistaDao = new guiatransportistaDao();

	$objPersonalBean = new personalBean();
	session_start();
	$Stipo_per = $_SESSION['TIPO_PER'];
	$Sid_per = $_SESSION['ID_PER'];
	switch ($op) {
		case 0: {
			$templeadoSELECT = $objPersonalDao->templeadoSELECT();
			unset($_SESSION['templeadoSELECT']);
			$_SESSION['templeadoSELECT'] = $templeadoSELECT;
			$page = "../views/personal/frmPersonalINSERT.php";
			break;
		}
		case 1: {
			$personalSELECT = $objPersonalDao->personalSELECT();
			unset($_SESSION['personalSELECT']);
			$_SESSION['personalSELECT'] = $personalSELECT;
			$page = "../views/personal/personalPrincipal.php";
			break;
		}
		case 2: {
			$file_per = $_FILES['foto_per'];
			/*foreach ($file_per as $key => $value) {
				echo $key.":".$value."\n";
			}
			exit();*/
			if ($file_per['type'] == "image/jpg" || $file_per['type'] == "image/png" || $file_per['type'] == "image/jpeg") {
				$extencion = substr($file_per['type'], 6,4);
				$foto_per = md5($file_per['tmp_name']) . "." . $extencion;
			} else {
				$response = array('STATUS' => '', 'ERROR' => '', 'ID' => '', 'DATA' => array());
				$response['STATUS'] = 'ERROR';
				$response['ERROR'] = "Se debe seleccionar una imagen tipo jpg o png.";
				echo json_encode($response);
				exit();
			}
			$tipdoc_per = $_POST['sltTipdoc_per'];
			$numdoc_per = $_POST['nbrNumdoc_per'];
			$nombre_per = $_POST['txtNombre_per'];
			$apellido_per = $_POST['txtApellido_per'];
			$fecing_per = $_POST['fecing_per'];
			$fecnac_per = $_POST['fecnac_per'];
			$correo_per = $_POST['correo_per'];
			$direccion_per = $_POST['direccion_per'];
			$nacionalidad_per = $_POST['txtNacionalidad_per'];
			if (isset($_POST['ckxLicencia_per'])) {
				$licencia_per = $_POST['licencia_per'];
			} else {
				$licencia_per = '';
			}
			$tipo_contrato = $_POST['tipo_contrato'];
			$tipo_per = $_POST['sltTipo_per'];
			$tipo_user = $_POST['tipo_user'];
			$usuario_per = $_POST['txtUsuario_per'];
			$clave_per = $_POST['pwdClave_per'];
			$objPersonalBean->setTipdoc_per($tipdoc_per);
			$objPersonalBean->setNumdoc_per($numdoc_per);
			$objPersonalBean->setNombre_per($nombre_per);
			$objPersonalBean->setApellido_per($apellido_per);
			$objPersonalBean->setFecing_per($fecing_per);
			$objPersonalBean->setFecnac_per($fecnac_per);
			$objPersonalBean->setCorreo_per($correo_per);
			$objPersonalBean->setDireccion_per($direccion_per);
			$objPersonalBean->setNacionalidad_per($nacionalidad_per);
			$objPersonalBean->setFoto_per($foto_per);
			$objPersonalBean->setLicencia_per($licencia_per);
			$objPersonalBean->setTipo_contrato($tipo_contrato);
			$objPersonalBean->setTipo_user($tipo_user);
			$objPersonalBean->setUsuario_per($usuario_per);
			$objPersonalBean->setClave_per($clave_per);
			$objPersonalBean->setId_temp($tipo_per);
			$response = $objPersonalDao->personalINSERT($objPersonalBean);
			if ($response['STATUS'] == 'OK') {
				move_uploaded_file($file_per['tmp_name'], "../dist/img/personal/" . $foto_per);
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 3: {
			$id_per = $_GET['id_per'];
			$templeadoSELECT = $objPersonalDao->templeadoSELECT();
			$personalDATA = $objPersonalDao->personalDATA($id_per);
			unset($_SESSION['templeadoSELECT']);
			unset($_SESSION['personalDATA']);
			$_SESSION['templeadoSELECT'] = $templeadoSELECT;
			$_SESSION['personalDATA'] = $personalDATA;
			$page = "../views/personal/frmPersonalUPDATE.php";
			break;
		}
		case 4: {
			if (isset($_POST['ckxFoto_per'])) {
				$foto_per = $_POST['foto_perOLD'];
			} else {
				$file_per = $_FILES['foto_per'];
				/*foreach ($file_per as $key => $value) {
					echo $key.":".$value."\n";
				}
				exit();*/
				if ($file_per['type'] == "image/jpg" || $file_per['type'] == "image/png" || $file_per['type'] == "image/jpeg") {
					$extencion = substr($file_per['type'], 6,4);
					$foto_per = md5($file_per['tmp_name']) . "." . $extencion;
				} else {
					$response = array('STATUS' => '', 'ERROR' => '', 'ID' => '', 'DATA' => array());
					$response['STATUS'] = 'ERROR';
					$response['ERROR'] = "Se debe seleccionar una imagen tipo jpg o png.";
					echo json_encode($response);
					exit();
				}
			}
			$id_per = $_POST['id_per'];
			$nombre_per = $_POST['txtNombre_per'];
			$apellido_per = $_POST['txtApellido_per'];
			$fecing_per = $_POST['fecing_per'];
			$fecnac_per = $_POST['fecnac_per'];
			$correo_per = $_POST['correo_per'];
			$direccion_per = $_POST['direccion_per'];
			$nacionalidad_per = $_POST['txtNacionalidad_per'];
			if (isset($_POST['ckxLicencia_per'])) {
				$licencia_per = $_POST['licencia_per'];
			} else {
				$licencia_per = '';
			}
			$tipo_contrato = $_POST['tipo_contrato'];
			$tipo_per = $_POST['sltTipo_per'];
			$tipdoc_per = $_POST['sltTipdoc_per'];
			$numdoc_per = $_POST['nbrNumdoc_per'];
			$tipo_user = $_POST['tipo_user'];
			$usuario_per = $_POST['txtUsuario_per'];
			$clave_per = $_POST['pwdClave_per'];
			$objPersonalBean->setId_per($id_per);
			$objPersonalBean->setNombre_per($nombre_per);
			$objPersonalBean->setApellido_per($apellido_per);
			$objPersonalBean->setFecing_per($fecing_per);
			$objPersonalBean->setFecnac_per($fecnac_per);
			$objPersonalBean->setCorreo_per($correo_per);
			$objPersonalBean->setDireccion_per($direccion_per);
			$objPersonalBean->setNacionalidad_per($nacionalidad_per);
			$objPersonalBean->setFoto_per($foto_per);
			$objPersonalBean->setLicencia_per($licencia_per);
			$objPersonalBean->setTipo_contrato($tipo_contrato);
			$objPersonalBean->setTipdoc_per($tipdoc_per);
			$objPersonalBean->setNumdoc_per($numdoc_per);
			$objPersonalBean->setTipo_user($tipo_user);
			$objPersonalBean->setUsuario_per($usuario_per);
			$objPersonalBean->setClave_per($clave_per);
			$objPersonalBean->setId_temp($tipo_per);
			$response = $objPersonalDao->personalUPDATE($objPersonalBean);
			if ($response['STATUS'] == 'OK') {
				if (!isset($_POST['ckxFoto_per'])) {
					unlink("../dist/img/personal/" . $_POST['foto_perOLD']);
					move_uploaded_file($file_per['tmp_name'], "../dist/img/personal/" . $foto_per);
				}
			}
			echo json_encode($response);
			exit();
			break;
		}
		case 5: {
			$id_per = $_POST['id_per'];
			$response = $objPersonalDao->personalDELETE($id_per);
			echo json_encode($response);
			exit();
			break;
		}
		case 6: { #Perfil de usuario
			$personalDATA = $objPersonalDao->personalDATA($Sid_per);
			unset($_SESSION['personalDATA']);
			$_SESSION['personalDATA'] = $personalDATA;
			$page = "../views/personal/frmPersonal_perfil.php";
			break;
		}
		case 7: { #Edital perfil de usuarioif (isset($_POST['ckxFoto_per'])) {
			$id_per = $Sid_per;
			$nombre_per = $_POST['nombre_per'];
			$apellido_per = $_POST['apellido_per'];
			$fecnac_per = $_POST['fecnac_per'];
			$correo_per = $_POST['correo_per'];
			$direccion_per = $_POST['direccion_per'];
			$nacionalidad_per = $_POST['nacionalidad_per'];
			$usuario_per = $_POST['usuario_per'];
			$clave_per = $_POST['clave_per'];
			$objPersonalBean->setId_per($id_per);
			$objPersonalBean->setNombre_per($nombre_per);
			$objPersonalBean->setApellido_per($apellido_per);
			$objPersonalBean->setFecnac_per($fecnac_per);
			$objPersonalBean->setCorreo_per($correo_per);
			$objPersonalBean->setDireccion_per($direccion_per);
			$objPersonalBean->setNacionalidad_per($nacionalidad_per);
			$objPersonalBean->setUsuario_per($usuario_per);
			$objPersonalBean->setClave_per($clave_per);
			$response = $objPersonalDao->personalUPDATExu($objPersonalBean);
			echo json_encode($response);
			exit();
			break;
		}
		case 8: { #Datos de Personal x id
			$id_per = $_POST['id_per'];
			$guiaTransportistaCOUNT = $objGuiatransportistaDao->guiaTransportistaCOUNT();
			$personalDATA = $objPersonalDao->personalDATA($id_per);
			$personalDATA['DATA'][0]['correlativo'] = $guiaTransportistaCOUNT['DATA'][0]['count(*)'];
			echo json_encode($personalDATA);
			exit();
			break;
		}
	}
	header("Location:" . $page);
?>