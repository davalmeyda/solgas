<?php
require_once '../models/util/conexionBD.php';
class estadisticaDao {
	public function facturaCOUNT($extra) {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=1" . $extra;
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function boletaCOUNT($extra) {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=3" . $extra;
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function notascreditoCOUNT($extra) {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=7" . $extra;
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function notasdebitoCOUNT($extra) {
		$query = "SELECT count(*) FROM venta WHERE tipo_comprobante=8" . $extra;
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaCOUNT($extra) {
		$query = "SELECT count(*) FROM proforma" . $extra;
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function guiaremisionCOUNT($extra) {
		$query = "SELECT count(*) FROM guiaremision" . $extra;
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>