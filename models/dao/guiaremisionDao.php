<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/guiaremisionBean.php';
class guiaremisionDao {
	public function guiaremisionSELECT($fecha) {
		$query = "SELECT DISTINCT guiaremision.id_gui, guiaremision.serie_gui, guiaremision.correlativo_gui, guiaremision.fecemi_gui, guiaremision.observacion_gui, guiaremision.ubigeoori_gui, guiaremision.direccionori, guiaremision.ubigeodes_gui, guiaremision.direcciondes, guiaremision.tipoenvio, guiaremision.fecenvio, guiaremision.cantbultos, guiaremision.peso, guiaremision.movilidad, guiaremision.transportista, cliente.id_cli, cliente.numdoc_cli, cliente.nombres_cli, cliente.direccion_cli, u.nombre_ubi AS nombre_ubiori, b.nombre_ubi AS nombre_ubides FROM guiaremision
			INNER JOIN cliente ON guiaremision.id_cli=cliente.id_cli
			INNER JOIN ubigeo u ON guiaremision.ubigeoori_gui=u.id_ubi
			INNER JOIN ubigeo b ON guiaremision.ubigeodes_gui=b.id_ubi
			WHERE guiaremision.fecemi_gui='$fecha' ORDER BY guiaremision.id_gui DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function guiaremisionDATA($id_gui) {
		$query = "SELECT DISTINCT guiaremision.id_gui, guiaremision.serie_gui, guiaremision.correlativo_gui, guiaremision.fecemi_gui, guiaremision.observacion_gui, guiaremision.ubigeoori_gui, guiaremision.direccionori, guiaremision.ubigeodes_gui, guiaremision.direcciondes, guiaremision.tipoenvio, guiaremision.fecenvio, guiaremision.cantbultos, guiaremision.peso, guiaremision.movilidad, guiaremision.transportista, cliente.id_cli, cliente.tipdoc_cli, cliente.numdoc_cli, cliente.nombres_cli, cliente.direccion_cli, u.nombre_ubi AS nombre_ubiori, b.nombre_ubi AS nombre_ubides, CONCAT(personal.nombre_per,\" \",personal.apellido_per) AS nombres_transportista FROM guiaremision
			INNER JOIN cliente ON guiaremision.id_cli=cliente.id_cli
			INNER JOIN ubigeo u ON guiaremision.ubigeoori_gui=u.id_ubi
			INNER JOIN ubigeo b ON guiaremision.ubigeodes_gui=b.id_ubi
			INNER JOIN personal ON guiaremision.transportista=personal.id_per
			WHERE guiaremision.id_gui='$id_gui'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_guiaSELECT($id_gui) {
		$query = "SELECT balon_guia.id_balgui, balon_guia.cantidad_balgui, balon_guia.detalle_balgui, balon.id_bal, balon.nombre_bal, balon_guia.id_gui
		FROM balon_guia
		INNER JOIN balon ON balon_guia.id_bal=balon.id_bal
		WHERE balon_guia.id_gui='$id_gui'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function guiaremisionINSERT(guiaremisionBean $objGuiaremisionBean) {
		$query = "INSERT INTO guiaremision(id_gui, serie_gui, correlativo_gui, fecemi_gui, observacion_gui, ubigeoori_gui, direccionori, ubigeodes_gui, direcciondes, tipoenvio, fecenvio, cantbultos, peso, movilidad, transportista, id_cli) VALUES (NULL,'" . $objGuiaremisionBean->getSerie_gui() . "','" . $objGuiaremisionBean->getCorrelativo_gui() . "','" . $objGuiaremisionBean->getFecemi_gui() . "','" . $objGuiaremisionBean->getObservacion_gui() . "','" . $objGuiaremisionBean->getUbigeoori_gui() . "','" . $objGuiaremisionBean->getDireccionori() . "','" . $objGuiaremisionBean->getUbigeodes_gui() . "','" . $objGuiaremisionBean->getDirecciondes() . "','" . $objGuiaremisionBean->getTipoenvio() . "','" . $objGuiaremisionBean->getFecenvio() . "','" . $objGuiaremisionBean->getCantbultos() . "','" . $objGuiaremisionBean->getPeso() . "','" . $objGuiaremisionBean->getMovilidad() . "','" . $objGuiaremisionBean->getTransportista() . "','" . $objGuiaremisionBean->getId_cli() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_guiaINSERT(guiaremisionBean $objGuiaremisionBean) {
		$query = "INSERT INTO balon_guia(id_balgui, cantidad_balgui, detalle_balgui, id_bal, id_gui) VALUES (NULL,'" . $objGuiaremisionBean->getCantidad_balgui() . "','" . $objGuiaremisionBean->getDetalle_balgui() . "','" . $objGuiaremisionBean->getId_bal() . "','" . $objGuiaremisionBean->getId_gui() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function guiaremisionCOUNT() {
		$query = "SELECT count(*)+1 FROM guiaremision";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>