<?php
class clienteBean {
	private $Id_cli;
	private $Nombres_cli;
	private $Tipdoc_cli;
	private $Numdoc_cli;
	private $Telefono_cli;
	private $Direccion_cli;
	private $Referencia_cli;
	private $Correo_cli;
	private $Clave_cli;

	private $Tipo_pago;
	private $Modo_pago;
	private $Nutarjeta_pago;
	private $Observacion_pago;
	private $Monto_pago;
	private $Id_ven;
	
	function getId_cli() {
		return $this->Id_cli;
	}

	function setId_cli($Id_cli) {
    	$this->Id_cli = $Id_cli;
	}

	function getNombres_cli() {
		return $this->Nombres_cli;
	}

	function setNombres_cli($Nombres_cli) {
    	$this->Nombres_cli = $Nombres_cli;
	}

	function getTipdoc_cli() {
		return $this->Tipdoc_cli;
	}

	function setTipdoc_cli($Tipdoc_cli) {
    	$this->Tipdoc_cli = $Tipdoc_cli;
	}

	function getNumdoc_cli() {
		return $this->Numdoc_cli;
	}

	function setNumdoc_cli($Numdoc_cli) {
    	$this->Numdoc_cli = $Numdoc_cli;
	}

	function getTelefono_cli() {
		return $this->Telefono_cli;
	}

	function setTelefono_cli($Telefono_cli) {
    	$this->Telefono_cli = $Telefono_cli;
	}

	function getDireccion_cli() {
		return $this->Direccion_cli;
	}

	function setDireccion_cli($Direccion_cli) {
    	$this->Direccion_cli = $Direccion_cli;
	}

	function getReferencia_cli() {
		return $this->Referencia_cli;
	}

	function setReferencia_cli($Referencia_cli) {
    	$this->Referencia_cli = $Referencia_cli;
	}

	function getCorreo_cli() {
		return $this->Correo_cli;
	}

	function setCorreo_cli($Correo_cli) {
    	$this->Correo_cli = $Correo_cli;
	}

	function getClave_cli() {
		return $this->Clave_cli;
	}

	function setClave_cli($Clave_cli) {
    	$this->Clave_cli = $Clave_cli;
	}

	function getTipo_pago() {
		return $this->Tipo_pago;
	}

	function setTipo_pago($Tipo_pago) {
    	$this->Tipo_pago = $Tipo_pago;
	}

	function getModo_pago() {
		return $this->Modo_pago;
	}

	function setModo_pago($Modo_pago) {
    	$this->Modo_pago = $Modo_pago;
	}

	function getNutarjeta_pago() {
		return $this->Nutarjeta_pago;
	}

	function setNutarjeta_pago($Nutarjeta_pago) {
    	$this->Nutarjeta_pago = $Nutarjeta_pago;
	}

	function getObservacion_pago() {
		return $this->Observacion_pago;
	}

	function setObservacion_pago($Observacion_pago) {
    	$this->Observacion_pago = $Observacion_pago;
	}

	function getMonto_pago() {
		return $this->Monto_pago;
	}

	function setMonto_pago($Monto_pago) {
    	$this->Monto_pago = $Monto_pago;
	}

	function getId_ven() {
		return $this->Id_ven;
	}

	function setId_ven($Id_ven) {
    	$this->Id_ven = $Id_ven;
	}
}
?>