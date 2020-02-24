<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/vehiculoBean.php';
class vehiculoDao {
	public function vehiculoSELECT() {
		$query = "SELECT id_veh, descripcion_veh, placa_veh, tipo_veh, kilometraje_veh FROM vehiculo";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function vehiculoSELECT_tipoveh($tipo_veh) {
		$query = "SELECT id_veh, descripcion_veh, placa_veh, tipo_veh, kilometraje_veh FROM vehiculo WHERE tipo_veh='$tipo_veh'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function salidasSELECT() {
		$query = "SELECT salidas.id_sal, salidas.chofer_sal, salidas.ayudante_sal, salidas.promotor_sal, salidas.kilini_sal, salidas.kilfin_sal, salidas.fecini_sal, salidas.fecfin_sal, vehiculo.id_veh, vehiculo.descripcion_veh, vehiculo.placa_veh, vehiculo.kilometraje_veh FROM salidas INNER JOIN vehiculo ON salidas.id_veh=vehiculo.id_veh WHERE kilini_sal IS NOT NULL";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function horariosSELECT() {
		$query = "SELECT *  FROM (
			SELECT salidas.id_sal, salidas.chofer_sal, salidas.ayudante_sal, salidas.promotor_sal, salidas.kilini_sal, salidas.kilfin_sal, salidas.fecini_sal, salidas.fecfin_sal, vehiculo.id_veh, vehiculo.descripcion_veh, vehiculo.placa_veh, vehiculo.kilometraje_veh, CONCAT(c.nombre_per,\" \",c.apellido_per) AS nombres_chofer, CONCAT(a.nombre_per,\" \",a.apellido_per) AS nombres_ayudante, CONCAT(p.nombre_per,\" \",p.apellido_per) AS nombres_promotor
			FROM salidas INNER JOIN vehiculo ON salidas.id_veh=vehiculo.id_veh
			INNER JOIN personal c ON salidas.ayudante_sal = c.id_per
			INNER JOIN personal a ON salidas.ayudante_sal = a.id_per
			INNER JOIN personal p ON salidas.promotor_sal = p.id_per
			UNION ALL
			SELECT salidas.id_sal, salidas.chofer_sal, salidas.ayudante_sal, salidas.promotor_sal, salidas.kilini_sal, salidas.kilfin_sal, salidas.fecini_sal, salidas.fecfin_sal, vehiculo.id_veh, vehiculo.descripcion_veh, vehiculo.placa_veh, vehiculo.kilometraje_veh, NULL AS nombres_chofer, CONCAT(a.nombre_per,\" \",a.apellido_per) AS nombres_ayudante, CONCAT(p.nombre_per,\" \",p.apellido_per) AS nombres_promotor
			FROM salidas INNER JOIN vehiculo ON salidas.id_veh=vehiculo.id_veh
			INNER JOIN personal a ON salidas.ayudante_sal = a.id_per
			INNER JOIN personal p ON salidas.promotor_sal = p.id_per
			WHERE salidas.chofer_sal IS NULL
			UNION ALL
			SELECT salidas.id_sal, salidas.chofer_sal, salidas.ayudante_sal, salidas.promotor_sal, salidas.kilini_sal, salidas.kilfin_sal, salidas.fecini_sal, salidas.fecfin_sal, vehiculo.id_veh, vehiculo.descripcion_veh, vehiculo.placa_veh, vehiculo.kilometraje_veh, CONCAT(c.nombre_per,\" \",c.apellido_per) AS nombres_chofer, NULL AS nombres_ayudante, CONCAT(p.nombre_per,\" \",p.apellido_per) AS nombres_promotor
			FROM salidas INNER JOIN vehiculo ON salidas.id_veh=vehiculo.id_veh
			INNER JOIN personal c ON salidas.chofer_sal = c.id_per
			INNER JOIN personal p ON salidas.promotor_sal = p.id_per
			WHERE salidas.ayudante_sal IS NULL
			UNION ALL
			SELECT salidas.id_sal, salidas.chofer_sal, salidas.ayudante_sal, salidas.promotor_sal, salidas.kilini_sal, salidas.kilfin_sal, salidas.fecini_sal, salidas.fecfin_sal, vehiculo.id_veh, vehiculo.descripcion_veh, vehiculo.placa_veh, vehiculo.kilometraje_veh, CONCAT(c.nombre_per,\" \",c.apellido_per) AS nombres_chofer, CONCAT(a.nombre_per,\" \",a.apellido_per) AS nombres_ayudante, NULL AS nombres_promotor
			FROM salidas INNER JOIN vehiculo ON salidas.id_veh=vehiculo.id_veh
			INNER JOIN personal c ON salidas.chofer_sal = c.id_per
			INNER JOIN personal a ON salidas.ayudante_sal = a.id_per
			WHERE salidas.promotor_sal IS NULL
			) a WHERE kilini_sal IS NULL";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function soatven_vehNOTI() {
		$query = "SELECT vehiculo.soatven_veh, vehiculo.descripcion_veh, vehiculo.placa_veh
			FROM vehiculo
			WHERE TIMESTAMPDIFF(DAY, vehiculo.soatven_veh, CURDATE()) >= 0";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function vehiculoINSERT(vehiculoBean $objVehiculoBean) {
		$query = "INSERT INTO vehiculo(id_veh, descripcion_veh, placa_veh, tipo_veh, kilometraje_veh, polemi_veh, polven_veh, moncob_pol, soatemi_veh, soatven_veh) VALUES (NULL,'" . $objVehiculoBean->getDescripcion_veh() . "','" . $objVehiculoBean->getPlaca_veh() . "','" . $objVehiculoBean->getTipo_veh() . "','" . $objVehiculoBean->getKilometraje_veh() . "','" . $objVehiculoBean->getPolemi_veh() . "','" . $objVehiculoBean->getPolven_veh() . "','" . $objVehiculoBean->getMoncob_pol() . "','" . $objVehiculoBean->getSoatemi_veh() . "','" . $objVehiculoBean->getSoatven_veh() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function vehiculoDATA($id_veh) {
		$query = "SELECT id_veh, descripcion_veh, placa_veh, tipo_veh, kilometraje_veh FROM vehiculo WHERE id_veh='$id_veh'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function vehiculoUPDATE(vehiculoBean $objVehiculoBean) {
		$query = "UPDATE vehiculo SET descripcion_veh='" . $objVehiculoBean->getDescripcion_veh() . "',placa_veh='" . $objVehiculoBean->getPlaca_veh() . "',tipo_veh='" . $objVehiculoBean->getTipo_veh() . "',kilometraje_veh='" . $objVehiculoBean->getKilometraje_veh() . "' WHERE id_veh='" . $objVehiculoBean->getId_veh() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function salidaINSERT(vehiculoBean $objVehiculoBean) {
		$query = "INSERT INTO salidas(id_sal, chofer_sal, ayudante_sal, promotor_sal, fecini_sal, id_veh) VALUES (NULL,'" . $objVehiculoBean->getChofer_sal() . "','" . $objVehiculoBean->getAyudante_sal() . "','" . $objVehiculoBean->getPromotor_sal() . "','" . $objVehiculoBean->getFecini_sal() . "','" . $objVehiculoBean->getId_veh() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function salidaINICIO(vehiculoBean $objVehiculoBean) {
		$query = "UPDATE salidas SET kilini_sal='" . $objVehiculoBean->getKilini_sal() . "' WHERE id_sal='" . $objVehiculoBean->getId_sal() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function salidaFIN(vehiculoBean $objVehiculoBean) {
		$query = "UPDATE salidas SET kilfin_sal='" . $objVehiculoBean->getKilfin_sal() . "', fecfin_sal='" . $objVehiculoBean->getFecfin_sal() . "' WHERE id_sal='" . $objVehiculoBean->getId_sal() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>