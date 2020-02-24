<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/personalBean.php';
class personalDao {
	public function personalSELECT() {
		$query = "SELECT id_per, nombre_per, apellido_per, nacionalidad_per, tipdoc_per, numdoc_per, tipo_user, usuario_per, clave_per, templeado.id_temp, templeado.nota_temp
			FROM personal
			INNER JOIN templeado ON personal.id_temp=templeado.id_temp";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalSELECT_tipper($id_temp) {
		$query = "SELECT id_per, nombre_per, apellido_per, nacionalidad_per, tipdoc_per, numdoc_per, tipo_user, usuario_per, clave_per, templeado.id_temp, templeado.nota_temp
			FROM personal
			INNER JOIN templeado ON personal.id_temp=templeado.id_temp
			WHERE templeado.id_temp='$id_temp'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function templeadoSELECT() {
		$query = "SELECT id_temp, nota_temp FROM templeado";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalSERCH($parametro) {
		$query = "SELECT id_per, nombre_per, apellido_per, nacionalidad_per, tipdoc_per, numdoc_per, tipo_user, usuario_per, clave_per, templeado.id_temp, templeado.nota_temp
			FROM personal
			INNER JOIN templeado ON personal.id_temp=templeado.id_temp
			WHERE nombre_per LIKE'%$parametro%' OR numdoc_per LIKE '%$parametro%' LIMIT 10";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalINSERT(personalBean $objPersonalBean) {
		$query = "INSERT INTO personal(id_per, nombre_per, apellido_per, fecing_per, fecnac_per, correo_per, direccion_per, nacionalidad_per, foto_per, licencia_per, tipo_contrato, tipdoc_per, numdoc_per, tipo_user, usuario_per, clave_per, id_temp) VALUES (NULL,'" . $objPersonalBean->getNombre_per() . "','" . $objPersonalBean->getApellido_per() . "','" . $objPersonalBean->getFecing_per() . "','" . $objPersonalBean->getFecnac_per() . "','" . $objPersonalBean->getCorreo_per() . "','" . $objPersonalBean->getDireccion_per() . "','" . $objPersonalBean->getNacionalidad_per() . "','" . $objPersonalBean->getFoto_per() . "','" . $objPersonalBean->getLicencia_per() . "','" . $objPersonalBean->getTipo_contrato() . "','" . $objPersonalBean->getTipdoc_per() . "','" . $objPersonalBean->getNumdoc_per() . "','" . $objPersonalBean->getTipo_user() . "','" . $objPersonalBean->getUsuario_per() . "','" . $objPersonalBean->getClave_per() . "','" . $objPersonalBean->getId_temp() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalDATA($id_per) {
		$query = "SELECT id_per, nombre_per, apellido_per, fecing_per, fecnac_per, correo_per, direccion_per, nacionalidad_per, foto_per, licencia_per, tipo_contrato, tipdoc_per, numdoc_per, tipo_user, usuario_per, clave_per, templeado.id_temp, templeado.nota_temp
			FROM personal
			INNER JOIN templeado ON personal.id_temp=templeado.id_temp
			WHERE id_per='$id_per'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalUPDATE(personalBean $objPersonalBean) {
		$query = "UPDATE personal SET nombre_per='" . $objPersonalBean->getNombre_per() . "',apellido_per='" . $objPersonalBean->getApellido_per() . "',fecing_per='" . $objPersonalBean->getFecing_per() . "',fecnac_per='" . $objPersonalBean->getFecnac_per() . "',correo_per='" . $objPersonalBean->getCorreo_per() . "',direccion_per='" . $objPersonalBean->getDireccion_per() . "',nacionalidad_per='" . $objPersonalBean->getNacionalidad_per() . "',foto_per='" . $objPersonalBean->getFoto_per() . "',licencia_per='" . $objPersonalBean->getLicencia_per() . "',tipo_contrato='" . $objPersonalBean->getTipo_contrato() . "',tipdoc_per='" . $objPersonalBean->getTipdoc_per() . "',numdoc_per='" . $objPersonalBean->getNumdoc_per() . "',tipo_user='" . $objPersonalBean->getTipo_user() . "',usuario_per='" . $objPersonalBean->getUsuario_per() . "',clave_per='" . $objPersonalBean->getClave_per() . "',id_temp='" . $objPersonalBean->getId_temp() . "' WHERE id_per='" . $objPersonalBean->getId_per() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalUPDATExu(personalBean $objPersonalBean) {
		$query = "UPDATE personal SET nombre_per='" . $objPersonalBean->getNombre_per() . "',apellido_per='" . $objPersonalBean->getApellido_per() . "',fecnac_per='" . $objPersonalBean->getFecnac_per() . "',correo_per='" . $objPersonalBean->getCorreo_per() . "',direccion_per='" . $objPersonalBean->getDireccion_per() . "',nacionalidad_per='" . $objPersonalBean->getNacionalidad_per() . "',usuario_per='" . $objPersonalBean->getUsuario_per() . "',clave_per='" . $objPersonalBean->getClave_per() . "' WHERE id_per='" . $objPersonalBean->getId_per() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalDELETE($id_per) {
		$query = "DELETE FROM personal WHERE id_per='$id_per'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function personalVALIDATE(personalBean $objPersonalBean) {
		$query = "SELECT id_per, nombre_per, tipo_user, usuario_per, id_temp FROM personal WHERE usuario_per='" . $objPersonalBean->getUsuario_per() . "' AND clave_per='" . $objPersonalBean->getClave_per() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function adminVALIDATE(personalBean $objPersonalBean) {
		$query = "SELECT id_per, nombre_per, tipo_user, usuario_per, id_temp FROM personal WHERE usuario_per='" . $objPersonalBean->getUsuario_per() . "' AND clave_per='" . $objPersonalBean->getClave_per() . "' AND (tipo_user=1 OR tipo_user=2)";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>