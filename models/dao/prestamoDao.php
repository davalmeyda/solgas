<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/prestamoBean.php';
date_default_timezone_set("America/Lima");
class prestamoDao {
	public function prestamoSELECT() {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.total_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function prestamoSELECT_idper($id_per) {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.total_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per
		WHERE personal.id_per='$id_per'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function prestamoSELECT_NOTNULL() {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.total_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per WHERE prestamo.fecreg_pre IS NOT NULL";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function prestamoSELECT_idperNOTNULL($id_per) {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.total_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per
		WHERE personal.id_per='$id_per' AND prestamo.fecreg_pre IS NOT NULL";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function prestamoSELECT_NULL() {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.total_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per WHERE prestamo.fecreg_pre IS NULL";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function prestamoSELECT_idperNULL($id_per) {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.total_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per
		WHERE personal.id_per='$id_per' AND prestamo.fecreg_pre IS NULL";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}

	public function prestamoINSERT(prestamoBean $objPrestamoBean) {
		$query = "INSERT INTO prestamo(id_pre, tipo_pre, fecha_pre, total_pre, cantidad_pre, motivo_pre, id_cli, id_per) VALUES (NULL,'" . $objPrestamoBean->getTipo_pre() . "','" . $objPrestamoBean->getFecha_pre() . "','" . $objPrestamoBean->getTotal_pre() . "','" . $objPrestamoBean->getCantidad_pre() . "','" . $objPrestamoBean->getMotivo_pre() . "','" . $objPrestamoBean->getId_cli() . "','" . $objPrestamoBean->getId_per() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_prestamoINSERT(prestamoBean $objPrestamoBean) {
		$query = "INSERT INTO balon_prestamo(id_balpre, fecini_balpre, fecfin_balpre, total_balpre, cantidad_balpre, estado_balpre, id_bal, id_pre) VALUES (NULL,'" . $objPrestamoBean->getFecini_balpre() . "',NULL, '" . $objPrestamoBean->getTotal_balpre() . "', '" . $objPrestamoBean->getCantidad_balpre() . "',1,'" . $objPrestamoBean->getId_bal() . "','" . $objPrestamoBean->getId_pre() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function prestamoDATA($id_pre) {
		$query = "SELECT prestamo.id_pre, prestamo.fecha_pre, prestamo.fecreg_pre, prestamo.cantidad_pre, prestamo.motivo_pre, cliente.id_cli, cliente.nombres_cli, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per
		FROM prestamo
		INNER JOIN cliente ON prestamo.id_cli=cliente.id_cli
		INNER JOIN personal ON prestamo.id_per=personal.id_per
		WHERE prestamo.id_pre='$id_pre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function estado_balpreUPDATE(prestamoBean $objPrestamoBean) {
		$query = "UPDATE balon_prestamo SET fecfin_balpre='" . $objPrestamoBean->getFecfin_balpre() . "',cantidad_balpre=0, estado_balpre='" . $objPrestamoBean->getEstado_balpre() . "' WHERE id_balpre='" . $objPrestamoBean->getId_balpre() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function cantidad_preSUMAUPDATE($id_pre,$cantidad_pre) {
		$query = "UPDATE prestamo SET total_pre=total_pre+'$cantidad_pre', cantidad_pre=cantidad_pre+'$cantidad_pre' WHERE id_pre='$id_pre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function cantidad_preRESTAUPDATE($id_pre,$cantidad_pre) {
		$query = "UPDATE prestamo SET cantidad_pre=cantidad_pre-'$cantidad_pre' WHERE id_pre='$id_pre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_prestamoDATA($id_balpre) {
		$query = "SELECT id_balpre, fecini_balpre, fecfin_balpre, total_balpre, cantidad_balpre, estado_balpre, id_bal, id_pre FROM balon_prestamo WHERE id_balpre='$id_balpre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonxu_prestamo_balpre($id_balpre) {
		$query ="SELECT balonxu_prestamo.id_balxupre,balonxu_prestamo.ingreso_balxupre,balonxu_prestamo.salida_balxupre,balonxu_prestamo.estado_balxupre,balon_prestamo.id_balpre,balon_prestamo.total_balpre,balon_prestamo.id_bal,balonxu.id_balxu,balonxu.codbar_balxu
			FROM balonxu_prestamo
			INNER JOIN balon_prestamo ON balonxu_prestamo.id_balpre=balon_prestamo.id_balpre
			INNER JOIN balonxu ON balonxu_prestamo.id_balxu=balonxu.id_balxu
			WHERE balon_prestamo.id_balpre='$id_balpre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function numbalonPrestamo($id_pre) {
		$query = "SELECT COUNT(*)
		FROM balon_prestamo
		INNER JOIN prestamo ON balon_prestamo.id_pre=prestamo.id_pre
		WHERE balon_prestamo.estado_balpre=1 AND prestamo.id_pre='$id_pre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function fecreg_preUPDATE($id_pre,$fecreg_pre) {
		$query = "UPDATE prestamo SET fecreg_pre='$fecreg_pre' WHERE id_pre='$id_pre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function registrobalon_prestamoINSERT(prestamoBean $objPrestamoBean) {
		$query = "INSERT INTO registrobalon_prestamo(id_regbalpre, fecha_regbalpre, cantidad_regbalpre, id_balpre, id_per) VALUES (NULL,'" . $objPrestamoBean->getFecreg_pre() . "','" . $objPrestamoBean->getCantidad_balpre() . "','" . $objPrestamoBean->getId_balpre() . "','" . $objPrestamoBean->getId_per() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonxu_prestamoINSERT($id_balpre,$id_balxu) {
		$query = "INSERT INTO balonxu_prestamo(id_balxupre, ingreso_balxupre, salida_balxupre, estado_balxupre, id_balpre, id_balxu) VALUES (NULL,'" . date('Y-m-d H:i:s') . "',NULL,1,'$id_balpre','$id_balxu')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function cantidad_balpreUPDATE($id_balpre,$cantidad_balpre) {
		$query = "UPDATE balon_prestamo SET cantidad_balpre='$cantidad_balpre' WHERE id_balpre='$id_balpre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function total_balpreUPDATE($id_balpre,$editada_balpre) {
		$query = "UPDATE balon_prestamo SET total_balpre=total_balpre+'$editada_balpre' WHERE id_balpre='$id_balpre'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function baloninbalon_prestamoCOUNT($id_bal,$id_pre) {
		$query = "SELECT id_balpre, cantidad_balpre FROM balon_prestamo WHERE id_bal='$id_bal' AND id_pre='$id_pre' ORDER BY id_balpre DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>