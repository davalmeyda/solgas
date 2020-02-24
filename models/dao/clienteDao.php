<?php
require_once '../models/util/conexionBD.php';
require_once '../models/bean/clienteBean.php';
require_once '../models/bean/ventaBean.php';
require_once '../models/bean/balon_ventaBean.php';
class clienteDao {
	public function clienteSELECT() {
		$query = "SELECT id_cli, nombres_cli, tipdoc_cli, numdoc_cli, direccion_cli, correo_cli FROM cliente WHERE 1";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function creditoLIST() {
		$query = "SELECT id_ven, fecini_ven,fecfin_ven, tipo_comprobante, CONCAT(serie_ven,'-',correlativo_ven) AS comprobante, tipo_pago, pago_ven, total_ven, cliente.id_cli, cliente.nombres_cli
			FROM venta
			INNER JOIN cliente ON venta.id_cli=cliente.id_cli
			WHERE (tipo_comprobante=1 OR tipo_comprobante=3) AND tipo_pago=1";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function creditoLIST_idper($id_per) {
		$query = "SELECT id_ven, fecini_ven,fecfin_ven, tipo_comprobante, CONCAT(serie_ven,'-',correlativo_ven) AS comprobante, tipo_pago, pago_ven, total_ven, cliente.id_cli, cliente.nombres_cli
			FROM venta
			INNER JOIN cliente ON venta.id_cli=cliente.id_cli
			WHERE (tipo_comprobante=1 OR tipo_comprobante=3) AND tipo_pago=1 AND venta.id_per='$id_per'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteINSERT(clienteBean $objClienteBean) {
		$query = "INSERT INTO cliente(id_cli, nombres_cli, tipdoc_cli, numdoc_cli, telefono_cli, direccion_cli, referencia_cli, correo_cli, clave_cli) VALUES (NULL,'" . $objClienteBean->getNombres_cli() . "','" . $objClienteBean->getTipdoc_cli() . "','" . $objClienteBean->getNumdoc_cli() . "','" . $objClienteBean->getTelefono_cli() . "','" . $objClienteBean->getDireccion_cli() . "','" . $objClienteBean->getReferencia_cli() . "','" . $objClienteBean->getCorreo_cli() . "','" . $objClienteBean->getClave_cli() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteDATA($id_cli) {
		$query = "SELECT id_cli, nombres_cli, tipdoc_cli, numdoc_cli, telefono_cli, direccion_cli, referencia_cli, correo_cli FROM cliente WHERE id_cli='$id_cli'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteUPDATE(clienteBean $objClienteBean) {
		$query = "UPDATE cliente SET nombres_cli='" . $objClienteBean->getNombres_cli() . "',tipdoc_cli='" . $objClienteBean->getTipdoc_cli() . "',numdoc_cli='" . $objClienteBean->getNumdoc_cli() . "',telefono_cli='" . $objClienteBean->getTelefono_cli() . "',direccion_cli='" . $objClienteBean->getDireccion_cli() . "',referencia_cli='" . $objClienteBean->getReferencia_cli() . "',correo_cli='" . $objClienteBean->getCorreo_cli() . "' WHERE id_cli='" . $objClienteBean->getId_cli() . "'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteDELETE($id_cli) {
		$query = "DELETE FROM cliente WHERE id_cli='$id_cli'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteSEARCH($parametro) {
		$query = "SELECT id_cli, nombres_cli, tipdoc_cli, numdoc_cli, direccion_cli, correo_cli FROM cliente WHERE id_cli LIKE '%$parametro%' or nombres_cli LIKE '%$parametro%' LIMIT 10";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function pagoINSERT(clienteBean $objClienteBean, $id_per) {
		$query = "INSERT INTO pago(id_pago, tipo_pago, modo_pago, nutarjeta_pago, observacion_pago,monto_pago, id_ven, id_per) VALUES (NULL,'" . $objClienteBean->getTipo_pago() . "','" . $objClienteBean->getModo_pago() . "','" . $objClienteBean->getNutarjeta_pago() . "','" . $objClienteBean->getObservacion_pago() . "','" . $objClienteBean->getMonto_pago() . "','" . $objClienteBean->getId_ven() . "','$id_per')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function clienteVALIDATE($clave_cli) {
		$query = "SELECT id_cli, nombres_cli, tipdoc_cli, numdoc_cli, telefono_cli, direccion_cli, referencia_cli, correo_cli, usuario_cli, clave_cli FROM cliente WHERE clave_cli='$clave_cli'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function pedidosINSERT(ventaBean $objVentaBean) {
		$query = "INSERT INTO pedidos(id_ped, fecini_ped, fecfin_ped, tipo_comprobante, serie, importe_ped, igv_ped, total_ped, estado_ped, id_cli, id_ven) VALUES (NULL,'" . $objVentaBean->getFecini_ven() . "'," . $objVentaBean->getFecfin_ven() . ",'" . $objVentaBean->getTipo_comprobante() . "','" . $objVentaBean->getSerie_ven() . "','" . $objVentaBean->getImporte_ven() . "','" . $objVentaBean->getIgv_ven() . "','" . $objVentaBean->getTotal_ven() . "',1,'" . $objVentaBean->getId_cli() . "',NULL)";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_pedidoINSERT(balon_ventaBean $objBalon_ventaBean) {
		$query = "INSERT INTO balon_pedido(id_balped, fecreg_balped, descripcion_balped, cantidad_balped, igv_balped, valor_unitario, precio_unitario, descuento_balped, valor_balped, id_bal, id_ped) VALUES (NULL,'" . $objBalon_ventaBean->getFecreg_balven() . "','" . $objBalon_ventaBean->getDescripcion_balven() . "','" . $objBalon_ventaBean->getCantidad_balven() . "','" . $objBalon_ventaBean->getIgv_balven() . "','" . $objBalon_ventaBean->getValor_unitario() . "','" . $objBalon_ventaBean->getPrecio_unitario() . "','" . $objBalon_ventaBean->getDescuento_balven() . "','" . $objBalon_ventaBean->getValor_balven() . "','" . $objBalon_ventaBean->getId_bal() . "','" . $objBalon_ventaBean->getId_ven() . "')";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function pedidosDATA($id_ped) {
		$query = "SELECT id_ped, fecini_ped, fecfin_ped, tipo_comprobante, serie, importe_ped, igv_ped, total_ped, estado_ped, cliente.id_cli, id_ven, cliente.nombres_cli, cliente.tipdoc_cli, cliente.numdoc_cli, cliente.direccion_cli FROM pedidos
		INNER JOIN cliente ON pedidos.id_cli=cliente.id_cli
		WHERE pedidos.id_ped='$id_ped'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
	public function balon_pedidoSELECT($id_ped) {
		$query = "SELECT id_balped, fecreg_balped, descripcion_balped, cantidad_balped, igv_balped, valor_unitario, precio_unitario, descuento_balped, valor_balped, id_bal, id_ped FROM balon_pedido WHERE id_ped='$id_ped'";
		$objConexionBD = new ConexionBD();
        $answer = $objConexionBD->exe_data($query);
        return $answer;
	}
}
?>