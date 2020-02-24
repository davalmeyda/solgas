<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/proveedorBean.php';
class proveedorDao {
	public function proveedorSELECT() {
		$query = "SELECT id_prov, ruc_prov, razsoc_prov, direccion_prov FROM proveedor";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proveedorINSERT(proveedorBean $objProveedorBean) {
		$query = "INSERT INTO proveedor(id_prov, ruc_prov, razsoc_prov, direccion_prov) VALUES (NULL,'" . $objProveedorBean->getRuc_prov() . "','" . $objProveedorBean->getRazsoc_prov() . "','" . $objProveedorBean->getDireccion_prov() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proveedorDATA($id_prov) {
		$query = "SELECT id_prov, ruc_prov, razsoc_prov, direccion_prov FROM proveedor WHERE id_prov='$id_prov'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proveedorUPDATE(proveedorBean $objProveedorBean) {
		$query = "UPDATE proveedor SET ruc_prov='" . $objProveedorBean->getRuc_prov() . "',razsoc_prov='" . $objProveedorBean->getRazsoc_prov() . "',direccion_prov='" . $objProveedorBean->getDireccion_prov() . "' WHERE id_prov='" . $objProveedorBean->getId_prov() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proveedorDELETE($id_prov) {
		$query = "DELETE FROM proveedor WHERE id_prov='$id_prov'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>