<?php
class guiatransportistaBean {
	private $Id_guitra;
	private $Fecha_guitra;
	private $Id_per;
	private $Nombres_guitra;
	private $Puntopartida_guitra;
	private $Ruc_guitra;
	private $Puntollegada_guitra;
	private $Placa_guitra;
	private $Nconstancia_guitra;
	private $Nlicencia_guitra;
	private $Serie_ven;
	private $Numero_ven;

	private $Cantidad_balguitra;
	private $Id_bal;

	function getId_guitra() {
		return $this->Id_guitra;
	}

	function setId_guitra($Id_guitra) {
    	$this->Id_guitra = $Id_guitra;
	}

	function getFecha_guitra() {
		return $this->Fecha_guitra;
	}

	function setFecha_guitra($Fecha_guitra) {
    	$this->Fecha_guitra = $Fecha_guitra;
	}

	function getId_per() {
		return $this->Id_per;
	}

	function setId_per($Id_per) {
    	$this->Id_per = $Id_per;
	}

	function getNombres_guitra() {
		return $this->Nombres_guitra;
	}

	function setNombres_guitra($Nombres_guitra) {
    	$this->Nombres_guitra = $Nombres_guitra;
	}

	function getPuntopartida_guitra() {
		return $this->Puntopartida_guitra;
	}

	function setPuntopartida_guitra($Puntopartida_guitra) {
    	$this->Puntopartida_guitra = $Puntopartida_guitra;
	}

	function getRuc_guitra() {
		return $this->Ruc_guitra;
	}

	function setRuc_guitra($Ruc_guitra) {
    	$this->Ruc_guitra = $Ruc_guitra;
	}
	
	function getPuntollegada_guitra() {
		return $this->Puntollegada_guitra;
	}

	function setPuntollegada_guitra($Puntollegada_guitra) {
    	$this->Puntollegada_guitra = $Puntollegada_guitra;
	}
	
	function getPlaca_guitra() {
		return $this->Placa_guitra;
	}

	function setPlaca_guitra($Placa_guitra) {
    	$this->Placa_guitra = $Placa_guitra;
	}
	
	function getNconstancia_guitra() {
		return $this->Nconstancia_guitra;
	}

	function setNconstancia_guitra($Nconstancia_guitra) {
    	$this->Nconstancia_guitra = $Nconstancia_guitra;
	}
	
	function getNlicencia_guitra() {
		return $this->Nlicencia_guitra;
	}

	function setNlicencia_guitra($Nlicencia_guitra) {
    	$this->Nlicencia_guitra = $Nlicencia_guitra;
	}
	
	function getSerie_ven() {
		return $this->Serie_ven;
	}

	function setSerie_ven($Serie_ven) {
    	$this->Serie_ven = $Serie_ven;
	}
	
	function getNumero_ven() {
		return $this->Numero_ven;
	}

	function setNumero_ven($Numero_ven) {
    	$this->Numero_ven = $Numero_ven;
	}
	
	function getCantidad_balguitra() {
		return $this->Cantidad_balguitra;
	}

	function setCantidad_balguitra($Cantidad_balguitra) {
    	$this->Cantidad_balguitra = $Cantidad_balguitra;
	}
	
	function getId_bal() {
		return $this->Id_bal;
	}

	function setId_bal($Id_bal) {
    	$this->Id_bal = $Id_bal;
	}
}