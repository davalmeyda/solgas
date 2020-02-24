<?php
require_once '../models/util/conexionBD.php';
class estadisticaDao {
	public function facturaCOUNT() {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=1";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function boletaCOUNT() {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=3";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function notascreditoCOUNT() {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=7";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function notasdebitoCOUNT() {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=8";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaCOUNT() {
		$query = "SELECT count(*) FROM proforma";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function guiaremisionCOUNT() {
		$query = "SELECT count(*) FROM guiaremision";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>