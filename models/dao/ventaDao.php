<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/ventaBean.php';
require_once '../models/bean/balon_ventaBean.php';
date_default_timezone_set("America/Lima");
class ventaDao {
	public function ventaSELECT($fecha) {
		$query = "SELECT venta.id_ven, venta.tipo_comprobante, venta.serie_ven,venta.correlativo_ven,venta.fecini_ven,venta.tipo_comprobante, venta.total_ven, venta.estado_ven,cliente.id_cli,cliente.nombres_cli,cliente.numdoc_cli FROM venta
		INNER JOIN cliente ON venta.id_cli=cliente.id_cli
		WHERE venta.fecini_ven LIKE '$fecha%' ORDER BY venta.id_ven DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ventaSELECT_idper($fecha,$id_per) {
		$query = "SELECT venta.id_ven, venta.tipo_comprobante, venta.serie_ven,venta.correlativo_ven,venta.fecini_ven,venta.tipo_comprobante, venta.total_ven, venta.estado_ven,cliente.id_cli,cliente.nombres_cli,cliente.numdoc_cli FROM venta
		INNER JOIN cliente ON venta.id_cli=cliente.id_cli
		WHERE venta.fecini_ven LIKE '$fecha%' AND venta.id_per='$id_per' ORDER BY venta.id_ven DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ventaSELECT_idcli($id_cli) {
		$query = "SELECT venta.id_ven, venta.tipo_comprobante, venta.serie_ven,venta.correlativo_ven,venta.fecini_ven,venta.tipo_comprobante, venta.total_ven, venta.estado_ven,cliente.id_cli,cliente.nombres_cli,cliente.numdoc_cli FROM venta
		INNER JOIN cliente ON venta.id_cli=cliente.id_cli
		WHERE venta.estado_ven=2 AND (venta.tipo_comprobante=1 OR venta.tipo_comprobante=3) AND cliente.id_cli='$id_cli' ORDER BY venta.id_ven DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaSELECT($fecha) {
		$query = "SELECT proforma.id_pro,proforma.serie_ven,proforma.correlativo_ven,proforma.fecini_ven, proforma.estado_pro, cliente.id_cli,cliente.nombres_cli,cliente.numdoc_cli FROM proforma
		INNER JOIN cliente ON proforma.id_cli=cliente.id_cli
		WHERE proforma.fecini_ven LIKE '$fecha%' ORDER BY proforma.id_pro DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaSELECT_idper($fecha,$id_per) {
		$query = "SELECT proforma.id_pro,proforma.serie_ven,proforma.correlativo_ven,proforma.fecini_ven, proforma.estado_pro, cliente.id_cli,cliente.nombres_cli,cliente.numdoc_cli FROM proforma
		INNER JOIN cliente ON proforma.id_cli=cliente.id_cli
		WHERE proforma.fecini_ven LIKE '$fecha%' AND proforma.id_per='$id_per' ORDER BY proforma.id_pro DESC";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_proformaSELECT($id_pro) {
		$query = "SELECT id_balpro, fecreg_balven, descripcion_balven, cantidad_balven, igv_balven, valor_unitario, precio_unitario, descuento_balven, valor_balven, id_bal, id_pro FROM balon_proforma
		WHERE id_pro='$id_pro'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_ventaSELECT($id_ven) {
		$query = "SELECT id_balven, fecreg_balven, descripcion_balven, cantidad_balven, igv_balven, valor_unitario, precio_unitario, descuento_balven, valor_balven, id_bal, id_ven FROM balon_venta
		WHERE id_ven='$id_ven'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonxu_ventaSELECT_balven($id_balven) {
		$query = "SELECT balonxu_venta.id_balxuven,balonxu_venta.fecha_balxuven,balon_venta.id_balven,balon_venta.descripcion_balven,balon_venta.cantidad_balven,balon_venta.id_bal,balonxu.id_balxu,balonxu.codbar_balxu
			FROM balonxu_venta
			INNER JOIN balon_venta ON balonxu_venta.id_balven=balon_venta.id_balven
			INNER JOIN balonxu ON balonxu_venta.id_balxu=balonxu.id_balxu
			WHERE balonxu_venta.id_balven='$id_balven'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ventaDATA($id_ven) {
		$query = "SELECT venta.id_ven, venta.serie_ven, venta.correlativo_ven, venta.fecini_ven, venta.tipo_comprobante, venta.tipo_pago, venta.importe_ven, venta.igv_ven, venta.total_ven, venta.estado_ven, venta.nota_credito, cliente.id_cli, cliente.nombres_cli, cliente.tipdoc_cli, cliente.numdoc_cli, cliente.direccion_cli, cliente.correo_cli, venta.id_per FROM venta
		INNER JOIN cliente ON venta.id_cli=cliente.id_cli
		WHERE venta.id_ven='$id_ven'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaDATA($id_pro) {
		$query = "SELECT proforma.id_pro,proforma.serie_ven,proforma.correlativo_ven,proforma.fecini_ven, proforma.fecfin_ven, proforma.tipo_comprobante, proforma.total_ven, proforma.estado_pro, cliente.id_cli, cliente.nombres_cli, cliente.tipdoc_cli, cliente.numdoc_cli, cliente.direccion_cli FROM proforma
		INNER JOIN cliente ON proforma.id_cli=cliente.id_cli
		WHERE proforma.id_pro='$id_pro'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ventasCliente($id_cli) {
		$query = "SELECT * FROM (SELECT id_pro AS id_com,serie_ven,correlativo_ven,fecini_ven, 2 AS tipo_comprobante, total_ven, id_cli
			FROM proforma
			WHERE estado_pro=1
			UNION ALL
			SELECT id_ven AS id_com,serie_ven,correlativo_ven,fecini_ven, tipo_comprobante, total_ven, id_cli
			FROM venta
			WHERE estado_ven=2 OR estado_ven=4 OR estado_ven=5
		)a WHERE id_cli='$id_cli'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function pedidosCliente($id_cli) {
		$query = "SELECT id_ped,serie, fecini_ped, total_ped, id_cli
			FROM pedidos
			WHERE estado_ped=1 AND id_cli='$id_cli'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaCOUNT() {
		$query = "SELECT count(*)+1 FROM proforma";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function comprobanteCOUNT($tipo_comprobante) {
		$query = "SELECT count(*)+1 FROM venta WHERE tipo_comprobante='$tipo_comprobante'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaINSERT(ventaBean $objVentaBean) {
		$query = "INSERT INTO proforma(id_pro, fecini_ven, fecfin_ven, moneda_ven, tipo_comprobante, tipo_pago, tipo_operacion, serie_ven, correlativo_ven, importe_ven, igv_ven, total_ven, estado_pro, id_cli, id_per) VALUES (NULL,'" . $objVentaBean->getFecini_ven() . "',NULL,'" . $objVentaBean->getMoneda_ven() . "','" . $objVentaBean->getTipo_comprobante() . "',NULL,'" . $objVentaBean->getTipo_operacion() . "','" . $objVentaBean->getSerie_ven() . "','" . $objVentaBean->getCorrelativo_ven() . "','" . $objVentaBean->getImporte_ven() . "','" . $objVentaBean->getIgv_ven() . "','" . $objVentaBean->getTotal_ven() . "', 1,'" . $objVentaBean->getId_cli() . "','" . $objVentaBean->getId_per() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ventaINSERT(ventaBean $objVentaBean) {
		$query = "INSERT INTO venta(id_ven, fecini_ven, fecfin_ven, moneda_ven, tipo_comprobante, tipo_pago, pago_ven, tipo_operacion, serie_ven, correlativo_ven, importe_ven, igv_ven, total_ven, estado_ven, id_cli, id_per) VALUES (NULL,'" . $objVentaBean->getFecini_ven() . "','" . $objVentaBean->getFecfin_ven() . "','" . $objVentaBean->getMoneda_ven() . "','" . $objVentaBean->getTipo_comprobante() . "','" . $objVentaBean->getTipo_pago() . "','" . $objVentaBean->getPago_ven() . "','" . $objVentaBean->getTipo_operacion() . "','" . $objVentaBean->getSerie_ven() . "','" . $objVentaBean->getCorrelativo_ven() . "','" . $objVentaBean->getImporte_ven() . "','" . $objVentaBean->getIgv_ven() . "','" . $objVentaBean->getTotal_ven() . "','" . $objVentaBean->getEstado_ven() . "','" . $objVentaBean->getId_cli() . "','" . $objVentaBean->getId_per() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function nota_creditoINSERT(ventaBean $objVentaBean) {
		$query = "INSERT INTO venta(id_ven, fecini_ven, fecfin_ven, moneda_ven, tipo_comprobante, tipo_pago, pago_ven, tipo_operacion, serie_ven, correlativo_ven, importe_ven, igv_ven, total_ven, estado_ven, nota_credito, id_cli, id_per) VALUES (NULL,'" . $objVentaBean->getFecini_ven() . "','" . $objVentaBean->getFecfin_ven() . "','" . $objVentaBean->getMoneda_ven() . "','" . $objVentaBean->getTipo_comprobante() . "','" . $objVentaBean->getTipo_pago() . "','" . $objVentaBean->getPago_ven() . "','" . $objVentaBean->getTipo_operacion() . "','" . $objVentaBean->getSerie_ven() . "','" . $objVentaBean->getCorrelativo_ven() . "','" . $objVentaBean->getImporte_ven() . "','" . $objVentaBean->getIgv_ven() . "','" . $objVentaBean->getTotal_ven() . "','" . $objVentaBean->getEstado_ven() . "','" . $objVentaBean->getNota_credito() . "','" . $objVentaBean->getId_cli() . "','" . $objVentaBean->getId_per() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_proformaINSERT(balon_ventaBean $objBalon_ventaBean) {
		$query = "INSERT INTO balon_proforma(id_balpro, fecreg_balven, descripcion_balven, cantidad_balven, igv_balven, valor_unitario, precio_unitario, descuento_balven, valor_balven, id_bal, id_pro) VALUES (NULL,'" . $objBalon_ventaBean->getFecreg_balven() . "','" . $objBalon_ventaBean->getDescripcion_balven() . "','" . $objBalon_ventaBean->getCantidad_balven() . "','" . $objBalon_ventaBean->getIgv_balven() . "','" . $objBalon_ventaBean->getValor_unitario() . "','" . $objBalon_ventaBean->getPrecio_unitario() . "','" . $objBalon_ventaBean->getDescuento_balven() . "','" . $objBalon_ventaBean->getValor_balven() . "','" . $objBalon_ventaBean->getId_bal() . "','" . $objBalon_ventaBean->getId_ven() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_ventaINSERT(balon_ventaBean $objBalon_ventaBean) {
		$query = "INSERT INTO balon_venta(id_balven, fecreg_balven, descripcion_balven, cantidad_balven, igv_balven, valor_unitario, precio_unitario, descuento_balven, valor_balven, id_bal, id_ven) VALUES (NULL,'" . $objBalon_ventaBean->getFecreg_balven() . "','" . $objBalon_ventaBean->getDescripcion_balven() . "','" . $objBalon_ventaBean->getCantidad_balven() . "','" . $objBalon_ventaBean->getIgv_balven() . "','" . $objBalon_ventaBean->getValor_unitario() . "','" . $objBalon_ventaBean->getPrecio_unitario() . "','" . $objBalon_ventaBean->getDescuento_balven() . "','" . $objBalon_ventaBean->getValor_balven() . "','" . $objBalon_ventaBean->getId_bal() . "','" . $objBalon_ventaBean->getId_ven() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balonxu_ventaINSERT($id_balven,$id_balxu) {
		$query = "INSERT INTO balonxu_venta(id_balxuven, fecha_balxuven, id_balven, id_balxu) VALUES (NULL,'" . date('Y-m-d H:i:s') . "','$id_balven','$id_balxu')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function estado_venUPDATE($estado_ven,$id_ven) {
		$query = "UPDATE venta SET estado_ven='$estado_ven' WHERE id_ven='$id_ven'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ubigeoSEARCH($parametro) {
		$query = "SELECT * FROM ubigeo WHERE nombre_ubi LIKE '%$parametro%' OR acronimo_ubi LIKE '%$parametro%' LIMIT 10";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function proformaUPDATE($estado_pro,$id_ven,$id_pro) {
		$query = "UPDATE proforma SET estado_pro='$estado_pro', id_ven='$id_ven' WHERE id_pro='$id_pro'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function ventaUPDATE($estado_ven,$id_ven) {
		$query = "UPDATE venta SET estado_ven='$estado_ven' WHERE id_ven='$id_ven'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function pago_venUPDATE($pago_ven,$id_ven) {
		$query = "UPDATE venta SET pago_ven=pago_ven+'$pago_ven' WHERE id_ven='$id_ven'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>