<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/guiatransportistaBean.php';
class guiatransportistaDao {
	public function guiatransportistaSELECT($fecha) {
		$query = "SELECT id_guitra, fecha_guitra, nombres_guitra, puntopartida_guitra, ruc_guitra, puntollegada_guitra, placa_guitra, nconstancia_guitra, nlicencia_guitra, serie_ven, numero_ven FROM guiatransportista
		WHERE fecha_guitra LIKE '$fecha%' ORDER BY id_guitra DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_guitraSELECT($id_guitra) {
		$query = "SELECT balon_guitra.id_balguitra, balon_guitra.cantidad_balguitra, balon.id_bal, balon.nombre_bal, balon_guitra.id_guitra
		FROM balon_guitra
		INNER JOIN balon ON balon_guitra.id_bal=balon.id_bal
		WHERE balon_guitra.id_guitra='$id_guitra'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;

	}
	public function guiatransportistaDATA($id_guitra) {
		$query = "SELECT id_guitra, fecha_guitra, nombres_guitra, puntopartida_guitra, ruc_guitra, puntollegada_guitra, placa_guitra, nconstancia_guitra, nlicencia_guitra, serie_ven, numero_ven FROM guiatransportista WHERE id_guitra='$id_guitra'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function guiatransportistaINSERT(guiatransportistaBean $objGuiatransportistaBean) {
		$query = "INSERT INTO guiatransportista(id_guitra, fecha_guitra, nombres_guitra, puntopartida_guitra, ruc_guitra, puntollegada_guitra, placa_guitra, nconstancia_guitra, nlicencia_guitra, serie_ven, numero_ven) VALUES (NULL,'" . $objGuiatransportistaBean->getFecha_guitra() . "','" . $objGuiatransportistaBean->getNombres_guitra() . "','" . $objGuiatransportistaBean->getPuntopartida_guitra() . "','" . $objGuiatransportistaBean->getRuc_guitra() . "','" . $objGuiatransportistaBean->getPuntollegada_guitra() . "','" . $objGuiatransportistaBean->getPlaca_guitra() . "','" . $objGuiatransportistaBean->getNconstancia_guitra() . "','" . $objGuiatransportistaBean->getNlicencia_guitra() . "','" . $objGuiatransportistaBean->getSerie_ven() . "','" . $objGuiatransportistaBean->getNumero_ven() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_guitraINSERT(guiatransportistaBean $objGuiatransportistaBean) {
		$query = "INSERT INTO balon_guitra(id_balguitra, cantidad_balguitra, id_guitra, id_bal) VALUES (NULL,'" . $objGuiatransportistaBean->getCantidad_balguitra() . "','" . $objGuiatransportistaBean->getId_guitra() . "','" . $objGuiatransportistaBean->getId_bal() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>