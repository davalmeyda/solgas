<?php
class ventaBean {
	private $Id_ven;
	private $Fecini_ven;
	private $Fecfin_ven;
	private $Moneda_ven;
	private $Tipo_comprobante;
	private $Tipo_pago;
	private $Pago_ven;
	private $Tipo_operacion;
	private $Serie_ven;
	private $Correlativo_ven;
	private $Importe_ven;
	private $Descuento_ven;
	private $Igv_ven;
	private $Total_ven;
	private $Estado_ven;
	private $Nota_credito;
	private $Id_cli;
	private $Id_per;
	
	private $Id_balven;
	private $Fecreg_balven;
	private $Unidad_balven;
	private $Descripcion_balven;
	private $Cantidad_balven;
	private $Igv_balven;
	private $Valor_unitario;
	private $Precio_unitario;
	private $Descuento_balven;
	private $Valor_balven;
	private $Id_bal;

	function getId_ven() {
		return $this->Id_ven;
	}

	function setId_ven($Id_ven) {
    	$this->Id_ven = $Id_ven;
	}

	function getFecini_ven() {
		return $this->Fecini_ven;
	}

	function setFecini_ven($Fecini_ven) {
    	$this->Fecini_ven = $Fecini_ven;
	}

	function getFecfin_ven() {
		return $this->Fecfin_ven;
	}

	function setFecfin_ven($Fecfin_ven) {
    	$this->Fecfin_ven = $Fecfin_ven;
	}

	function getMoneda_ven() {
		return $this->Moneda_ven;
	}

	function setMoneda_ven($Moneda_ven) {
    	$this->Moneda_ven = $Moneda_ven;
	}

	function getTipo_comprobante() {
		return $this->Tipo_comprobante;
	}

	function setTipo_comprobante($Tipo_comprobante) {
    	$this->Tipo_comprobante = $Tipo_comprobante;
	}

	function getTipo_pago() {
		return $this->Tipo_pago;
	}

	function setTipo_pago($Tipo_pago) {
    	$this->Tipo_pago = $Tipo_pago;
	}

	function getPago_ven() {
		return $this->Pago_ven;
	}

	function setPago_ven($Pago_ven) {
    	$this->Pago_ven = $Pago_ven;
	}

	function getTipo_operacion() {
		return $this->Tipo_operacion;
	}

	function setTipo_operacion($Tipo_operacion) {
    	$this->Tipo_operacion = $Tipo_operacion;
	}

	function getSerie_ven() {
		return $this->Serie_ven;
	}

	function setSerie_ven($Serie_ven) {
    	$this->Serie_ven = $Serie_ven;
	}

	function getCorrelativo_ven() {
		return $this->Correlativo_ven;
	}

	function setCorrelativo_ven($Correlativo_ven) {
    	$this->Correlativo_ven = $Correlativo_ven;
	}

	function getImporte_ven() {
		return $this->Importe_ven;
	}

	function setImporte_ven($Importe_ven) {
    	$this->Importe_ven = $Importe_ven;
	}

	function getDescuento_ven() {
		return $this->Descuento_ven;
	}

	function setDescuento_ven($Descuento_ven) {
    	$this->Descuento_ven = $Descuento_ven;
	}

	function getIgv_ven() {
		return $this->Igv_ven;
	}

	function setIgv_ven($Igv_ven) {
    	$this->Igv_ven = $Igv_ven;
	}

	function getTotal_ven() {
		return $this->Total_ven;
	}

	function setTotal_ven($Total_ven) {
    	$this->Total_ven = $Total_ven;
	}

	function getEstado_ven() {
		return $this->Estado_ven;
	}

	function setEstado_ven($Estado_ven) {
    	$this->Estado_ven = $Estado_ven;
	}

	function getNota_credito() {
		return $this->Nota_credito;
	}

	function setNota_credito($Nota_credito) {
    	$this->Nota_credito = $Nota_credito;
	}

	function getId_cli() {
		return $this->Id_cli;
	}

	function setId_cli($Id_cli) {
    	$this->Id_cli = $Id_cli;
	}

	function getId_per() {
		return $this->Id_per;
	}

	function setId_per($Id_per) {
    	$this->Id_per = $Id_per;
	}

	function getId_balven() {
		return $this->Id_balven;
	}

	function setId_balven($Id_balven) {
    	$this->Id_balven = $Id_balven;
	}

	function getFecreg_balven() {
		return $this->Fecreg_balven;
	}

	function setFecreg_balven($Fecreg_balven) {
    	$this->Fecreg_balven = $Fecreg_balven;
	}

	function getUnidad_balven() {
		return $this->Unidad_balven;
	}

	function setUnidad_balven($Unidad_balven) {
    	$this->Unidad_balven = $Unidad_balven;
	}

	function getDescripcion_balven() {
		return $this->Descripcion_balven;
	}

	function setDescripcion_balven($Descripcion_balven) {
    	$this->Descripcion_balven = $Descripcion_balven;
	}

	function getCantidad_balven() {
		return $this->Cantidad_balven;
	}

	function setCantidad_balven($Cantidad_balven) {
    	$this->Cantidad_balven = $Cantidad_balven;
	}

	function getIgv_balven() {
		return $this->Igv_balven;
	}

	function setIgv_balven($Igv_balven) {
    	$this->Igv_balven = $Igv_balven;
	}

	function getValor_unitario() {
		return $this->Valor_unitario;
	}

	function setValor_unitario($Valor_unitario) {
    	$this->Valor_unitario = $Valor_unitario;
	}

	function getPrecio_unitario() {
		return $this->Precio_unitario;
	}

	function setPrecio_unitario($Precio_unitario) {
    	$this->Precio_unitario = $Precio_unitario;
	}

	function getDescuento_balven() {
		return $this->Descuento_balven;
	}

	function setDescuento_balven($Descuento_balven) {
    	$this->Descuento_balven = $Descuento_balven;
	}

	function getValor_balven() {
		return $this->Valor_balven;
	}

	function setValor_balven($Valor_balven) {
    	$this->Valor_balven = $Valor_balven;
	}

	function getId_bal() {
		return $this->Id_bal;
	}

	function setId_bal($Id_bal) {
    	$this->Id_bal = $Id_bal;
	}
}
?>