<?php
class balon_ventaBean {
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
	private $Id_ven;

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

	function getId_ven() {
		return $this->Id_ven;
	}

	function setId_ven($Id_ven) {
    	$this->Id_ven = $Id_ven;
	}
}
?>