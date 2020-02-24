<?php
require_once '../models/util/conexionBD.php';
date_default_timezone_set("America/Lima");
class mapsDao {
	public function repartidormapsLIST() {
		$query = "SELECT id_repmap, fecha_repmap, lat_repmap, long_repmap, estado_repmap, personal.id_per, CONCAT(nombre_per,' ',apellido_per) AS nombres_per
			FROM repartidormaps
			INNER JOIN personal ON repartidormaps.id_per=personal.id_per";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsLIST() {
		$query = "SELECT rutasmaps.id_rutmap, rutasmaps.fecha_rutmap, rutasmaps.fecfin_rutmap, rutasmaps.lat_ori, rutasmaps.lng_ori, rutasmaps.lat_des, rutasmaps.lng_des, rutasmaps.estado_rutmap, repartidormaps.id_repmap, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per, venta.id_ven, CONCAT('COMPROVANTE ',venta.serie_ven,'-',venta.correlativo_ven) AS nombre_ven, cliente.id_cli, cliente.nombres_cli, rutasmaps.id_per
			FROM rutasmaps
			INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
			INNER JOIN personal ON repartidormaps.id_per=personal.id_per
			INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven
			INNER JOIN cliente ON venta.id_cli=cliente.id_cli
			WHERE rutasmaps.estado_rutmap<>4 AND rutasmaps.estado_rutmap<>5";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function Balon_ventaLIST_idrepmap($id_repmap) {
		$query = "SELECT balon_venta.descripcion_balven, balon_venta.cantidad_balven, CONCAT('COMPROVANTE ', venta.serie_ven,'-',venta.correlativo_ven) AS nombre_ven
			FROM balon_venta
			INNER JOIN venta ON balon_venta.id_ven=venta.id_ven
			INNER JOIN rutasmaps ON venta.id_ven=rutasmaps.id_ven
			INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
			WHERE (rutasmaps.estado_rutmap=1 OR rutasmaps.estado_rutmap=2) AND repartidormaps.estado_repmap=3 AND repartidormaps.id_repmap='$id_repmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clientemapsDATA($id_cli) {
		$query = "SELECT * FROM (
			SELECT id_climap, fecha_climap, lat_climap, long_climap, cliente.id_cli, cliente.nombres_cli, cliente.direccion_cli
			FROM clientemaps
			INNER JOIN cliente ON clientemaps.id_cli=cliente.id_cli
			UNION ALL
			SELECT id_climap, fecha_climap, lat_climap, long_climap, cliente.id_cli, cliente.nombres_cli, cliente.direccion_cli
			FROM clientemaps
			RIGHT JOIN cliente ON clientemaps.id_cli=cliente.id_cli
			WHERE clientemaps.id_climap IS NULL
			) a WHERE id_cli='$id_cli'
		";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsDATA($id_rutmap) {
		$query = "SELECT rutasmaps.id_rutmap, rutasmaps.fecha_rutmap, rutasmaps.fecfin_rutmap, rutasmaps.lat_ori, rutasmaps.lng_ori, rutasmaps.lat_des, rutasmaps.lng_des, rutasmaps.estado_rutmap, repartidormaps.id_repmap, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per, venta.id_ven, CONCAT('COMPROVANTE ',venta.serie_ven,'-',venta.correlativo_ven) AS nombre_ven, cliente.id_cli, cliente.nombres_cli, cliente.correo_cli
			FROM rutasmaps
			INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
			INNER JOIN personal ON repartidormaps.id_per=personal.id_per
			INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven
			INNER JOIN cliente ON venta.id_cli=cliente.id_cli
			WHERE rutasmaps.id_rutmap='$id_rutmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsDATA_idrepmap($id_repmap) {
		$query = "SELECT id_rutmap, fecha_rutmap, fecfin_rutmap, lat_ori, lng_ori, lat_des, lng_des, estado_rutmap, id_repmap, id_ven, id_per
			FROM rutasmaps
			WHERE id_repmap='$id_repmap' AND estado_rutmap=1 ORDER BY id_rutmap";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsDATA_idper($id_per) {
		$query = "SELECT rutasmaps.id_rutmap, rutasmaps.fecha_rutmap, rutasmaps.fecfin_rutmap, rutasmaps.lat_ori, rutasmaps.lng_ori, rutasmaps.lat_des, rutasmaps.lng_des, rutasmaps.estado_rutmap, repartidormaps.id_repmap, CONCAT(p1.nombre_per,' ',p1.apellido_per) AS nombres_per, venta.id_ven, CONCAT('COMPROVANTE ',venta.serie_ven,'-',venta.correlativo_ven) AS nombre_ven, cliente.id_cli, cliente.nombres_cli, cliente.correo_cli, rutasmaps.id_per, CONCAT(p2.nombre_per,' ',p2.apellido_per) AS nombres_adm
			FROM rutasmaps
			INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
			INNER JOIN personal p1 ON repartidormaps.id_per=p1.id_per
			INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven
			INNER JOIN cliente ON venta.id_cli=cliente.id_cli
			INNER JOIN personal p2 ON rutasmaps.id_per=p2.id_per
			WHERE p1.id_per='$id_per' AND rutasmaps.estado_rutmap=1 ORDER BY rutasmaps.id_rutmap";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsDATA_idadmin($id_per) {
		$query = "SELECT rutasmaps.id_rutmap, rutasmaps.fecha_rutmap, rutasmaps.fecfin_rutmap, rutasmaps.lat_ori, rutasmaps.lng_ori, rutasmaps.lat_des, rutasmaps.lng_des, rutasmaps.estado_rutmap, repartidormaps.id_repmap, CONCAT(p1.nombre_per,' ',p1.apellido_per) AS nombres_per, venta.id_ven, CONCAT('COMPROVANTE ',venta.serie_ven,'-',venta.correlativo_ven) AS nombre_ven, cliente.id_cli, cliente.nombres_cli, cliente.correo_cli, rutasmaps.id_per, CONCAT(p2.nombre_per,' ',p2.apellido_per) AS nombres_adm
			FROM rutasmaps
			INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
			INNER JOIN personal p1 ON repartidormaps.id_per=p1.id_per
			INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven
			INNER JOIN cliente ON venta.id_cli=cliente.id_cli
			INNER JOIN personal p2 ON rutasmaps.id_per=p2.id_per
			WHERE p2.id_per='$id_per' AND (rutasmaps.estado_rutmap=3 OR rutasmaps.estado_rutmap=2) ORDER BY rutasmaps.id_rutmap DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function repartidormapsDATA($id_repmap) {
		$query = "SELECT repartidormaps.id_repmap, repartidormaps.fecha_repmap, repartidormaps.lat_repmap, repartidormaps.long_repmap, repartidormaps.estado_repmap, personal.id_per, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per FROM repartidormaps
			INNER JOIN personal ON repartidormaps.id_per=personal.id_per
			WHERE id_repmap='$id_repmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteidpreidrutmapidvenDATA($id_cli) {
		$query = "SELECT cliente.nombres_cli,
			(SELECT SUM(prestamo.cantidad_pre) FROM prestamo WHERE prestamo.fecreg_pre IS NULL AND id_cli=cliente.id_cli) AS balones_prestados,
			(SELECT rutasmaps.fecha_rutmap FROM rutasmaps INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven WHERE venta.id_cli=cliente.id_cli AND rutasmaps.estado_rutmap=5 ORDER BY rutasmaps.fecfin_rutmap DESC LIMIT 1) AS ultima_atencion,
			(SELECT CONCAT('COMPROVANTE ',venta.serie_ven,'-',venta.correlativo_ven) FROM rutasmaps INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven WHERE venta.id_cli=cliente.id_cli AND rutasmaps.estado_rutmap=5 ORDER BY rutasmaps.fecfin_rutmap DESC LIMIT 1) AS ultimo_comprovante
			FROM cliente WHERE cliente.id_cli='$id_cli'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clientemapsINSERT($fecha_climap, $lat_climap, $long_climap, $id_cli) {
		$query = "SELECT count(*) FROM clientemaps WHERE id_cli='$id_cli'";
		$objConexionBD = new ConexionBD();
        $response = $objConexionBD->exe_data($query);
        if ($response['DATA'][0]['count(*)'] != 0) {
			$query = "UPDATE clientemaps SET fecha_climap='$fecha_climap', lat_climap='$lat_climap', long_climap='$long_climap' WHERE id_cli='$id_cli'";
		} else {
			$query = "INSERT INTO clientemaps(id_climap, fecha_climap, lat_climap, long_climap, id_cli) VALUES (NULL,'$fecha_climap','$lat_climap','$long_climap','$id_cli')";
		}
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function repartidormapsINSERT($fecha_repmap, $lat_repmap, $long_repmap, $id_per) {
		$query = "SELECT count(*) FROM repartidormaps WHERE id_per='$id_per'";
		$objConexionBD = new ConexionBD();
        $response = $objConexionBD->exe_data($query);
		if ($response['DATA'][0]['count(*)'] != 0) {
			$query = "UPDATE repartidormaps SET fecha_repmap='$fecha_repmap', lat_repmap='$lat_repmap', long_repmap='$long_repmap' WHERE id_per='$id_per'";
		} else {
			$query = "INSERT INTO repartidormaps(id_repmap, fecha_repmap, lat_repmap, long_repmap, estado_repmap, id_per) VALUES (NULL,'$fecha_repmap','$lat_repmap','$long_repmap',1,'$id_per')";
		}
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutamapsINSERT($lat_ori,$lng_ori,$lat_des,$lng_des,$id_repmap,$id_ven,$Sid_per) {
		$query = "INSERT INTO rutasmaps(id_rutmap, fecha_rutmap, fecfin_rutmap, lat_ori, lng_ori, lat_des, lng_des, estado_rutmap, id_repmap, id_ven, id_per) VALUES (NULL,'" . date('Y-m-d H:i:s') . "',NULL,'$lat_ori','$lng_ori','$lat_des','$lng_des', 1,'$id_repmap','$id_ven','$Sid_per')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmaps_estadoEXIST($id_per,$estado_rutmap) {
		$query = "SELECT rutasmaps.id_rutmap, rutasmaps.fecha_rutmap, rutasmaps.fecfin_rutmap, rutasmaps.lat_ori, rutasmaps.lng_ori, rutasmaps.lat_des, rutasmaps.lng_des, rutasmaps.estado_rutmap, repartidormaps.id_repmap, rutasmaps.id_ven, rutasmaps.id_per FROM rutasmaps
		INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
		WHERE repartidormaps.id_per='$id_per' AND rutasmaps.estado_rutmap='$estado_rutmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function estado_repmapUPDATE($estado_repmap,$id_repmap) {
		$query = "UPDATE repartidormaps SET estado_repmap='$estado_repmap' WHERE id_repmap='$id_repmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsDATA_estado($id_rutmap,$estado_rutmap) {
		$query = "SELECT rutasmaps.id_rutmap, rutasmaps.fecha_rutmap, rutasmaps.fecfin_rutmap, rutasmaps.lat_ori, rutasmaps.lng_ori, rutasmaps.lat_des, rutasmaps.lng_des, repartidormaps.id_repmap, CONCAT(personal.nombre_per,' ',personal.apellido_per) AS nombres_per, CONCAT('COMPROBANTE ',venta.serie_ven,'-',venta.correlativo_ven) AS nombre_ven, (SELECT SUM(balon_venta.cantidad_balven) FROM balon_venta WHERE balon_venta.id_ven=venta.id_ven) AS cantidad_ven, cliente.nombres_cli
		FROM rutasmaps
		INNER JOIN repartidormaps ON rutasmaps.id_repmap=repartidormaps.id_repmap
		INNER JOIN personal ON repartidormaps.id_per=personal.id_per
		INNER JOIN venta ON rutasmaps.id_ven=venta.id_ven
		INNER JOIN cliente ON venta.id_cli=cliente.id_cli
		WHERE rutasmaps.id_rutmap='$id_rutmap' AND rutasmaps.estado_rutmap='$estado_rutmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function rutasmapsEND($estado_rutmap,$id_rutmap) {
		$query = "UPDATE rutasmaps SET fecfin_rutmap='" . date('Y-m-d H:i:s') .  "', estado_rutmap='$estado_rutmap' WHERE id_rutmap='$id_rutmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function estado_rutmapUPDATE($estado_rutmap,$id_rutmap) {
		$query = "UPDATE rutasmaps SET estado_rutmap='$estado_rutmap' WHERE id_rutmap='$id_rutmap'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}