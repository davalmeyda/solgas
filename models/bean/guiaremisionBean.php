<?php
class guiaremisionBean {
	private $Id_gui;
	private $Serie_gui;
	private $Correlativo_gui;
	private $Fecemi_gui;
	private $Observacion_gui;
	private $Ubigeoori_gui;
	private $Direccionori;
	private $Ubigeodes_gui;
	private $Direcciondes;
	private $Tipoenvio;
	private $Fecenvio;
	private $Cantbultos;
	private $Peso;
	private $Movilidad;
	private $Transportista;
	private $Id_cli;
	private $Id_per;

	private $Id_balgui;
	private $Cantidad_balgui;
	private $Detalle_balgui;
	private $Id_bal;

	function getId_gui() {
		return $this->Id_gui;
	}

	function setId_gui($Id_gui) {
    	$this->Id_gui = $Id_gui;
	}

	function getSerie_gui() {
		return $this->Serie_gui;
	}

	function setSerie_gui($Serie_gui) {
    	$this->Serie_gui = $Serie_gui;
	}

	function getCorrelativo_gui() {
		return $this->Correlativo_gui;
	}

	function setCorrelativo_gui($Correlativo_gui) {
    	$this->Correlativo_gui = $Correlativo_gui;
	}

	function getFecemi_gui() {
		return $this->Fecemi_gui;
	}

	function setFecemi_gui($Fecemi_gui) {
    	$this->Fecemi_gui = $Fecemi_gui;
	}

	function getObservacion_gui() {
		return $this->Observacion_gui;
	}

	function setObservacion_gui($Observacion_gui) {
    	$this->Observacion_gui = $Observacion_gui;
	}

	function getUbigeoori_gui() {
		return $this->Ubigeoori_gui;
	}

	function setUbigeoori_gui($Ubigeoori_gui) {
    	$this->Ubigeoori_gui = $Ubigeoori_gui;
	}

	function getDireccionori() {
		return $this->Direccionori;
	}

	function setDireccionori($Direccionori) {
    	$this->Direccionori = $Direccionori;
	}

	function getUbigeodes_gui() {
		return $this->Ubigeodes_gui;
	}

	function setUbigeodes_gui($Ubigeodes_gui) {
    	$this->Ubigeodes_gui = $Ubigeodes_gui;
	}

	function getDirecciondes() {
		return $this->Direcciondes;
	}

	function setDirecciondes($Direcciondes) {
    	$this->Direcciondes = $Direcciondes;
	}

	function getTipoenvio() {
		return $this->Tipoenvio;
	}

	function setTipoenvio($Tipoenvio) {
    	$this->Tipoenvio = $Tipoenvio;
	}

	function getFecenvio() {
		return $this->Fecenvio;
	}

	function setFecenvio($Fecenvio) {
    	$this->Fecenvio = $Fecenvio;
	}

	function getCantbultos() {
		return $this->Cantbultos;
	}

	function setCantbultos($Cantbultos) {
    	$this->Cantbultos = $Cantbultos;
	}

	function getPeso() {
		return $this->Peso;
	}

	function setPeso($Peso) {
    	$this->Peso = $Peso;
	}

	function getMovilidad() {
		return $this->Movilidad;
	}

	function setMovilidad($Movilidad) {
    	$this->Movilidad = $Movilidad;
	}

	function getTransportista() {
		return $this->Transportista;
	}

	function setTransportista($Transportista) {
    	$this->Transportista = $Transportista;
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

	function getId_balgui() {
		return $this->Id_balgui;
	}

	function setId_balgui($Id_balgui) {
    	$this->Id_balgui = $Id_balgui;
	}

	function getCantidad_balgui() {
		return $this->Cantidad_balgui;
	}

	function setCantidad_balgui($Cantidad_balgui) {
    	$this->Cantidad_balgui = $Cantidad_balgui;
	}

	function getDetalle_balgui() {
		return $this->Detalle_balgui;
	}

	function setDetalle_balgui($Detalle_balgui) {
    	$this->Detalle_balgui = $Detalle_balgui;
	}

	function getId_bal() {
		return $this->Id_bal;
	}

	function setId_bal($Id_bal) {
    	$this->Id_bal = $Id_bal;
	}


}
?>