<?php
class prestamoBean {
	private $Id_pre;
	private $Tipo_pre;
	private $Fecha_pre;
	private $Fecreg_pre;
	private $Total_pre;
	private $Cantidad_pre;
	private $Motivo_pre;
	private $Id_cli;
	private $Id_per;
	private $Id_bal;
	private $Id_balpre;
	private $Fecini_balpre;
	private $Fecfin_balpre;
	private $Total_balpre;
	private $Cantidad_balpre;
	private $Estado_balpre;
	
	function getId_pre() {
		return $this->Id_pre;
	}

	function setId_pre($Id_pre) {
    	$this->Id_pre = $Id_pre;
	}

	function getTipo_pre() {
		return $this->Tipo_pre;
	}

	function setTipo_pre($Tipo_pre) {
    	$this->Tipo_pre = $Tipo_pre;
	}

	function getFecha_pre() {
		return $this->Fecha_pre;
	}

	function setFecha_pre($Fecha_pre) {
    	$this->Fecha_pre = $Fecha_pre;
	}

	function getFecreg_pre() {
		return $this->Fecreg_pre;
	}

	function setFecreg_pre($Fecreg_pre) {
    	$this->Fecreg_pre = $Fecreg_pre;
	}

	function getCantidad_pre() {
		return $this->Cantidad_pre;
	}

	function setCantidad_pre($Cantidad_pre) {
    	$this->Cantidad_pre = $Cantidad_pre;
	}

	function getTotal_pre() {
		return $this->Total_pre;
	}

	function setTotal_pre($Total_pre) {
    	$this->Total_pre = $Total_pre;
	}

	function getMotivo_pre() {
		return $this->Motivo_pre;
	}

	function setMotivo_pre($Motivo_pre) {
    	$this->Motivo_pre = $Motivo_pre;
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

	function getId_bal() {
		return $this->Id_bal;
	}
	
	function setId_bal($Id_bal) {
    	$this->Id_bal = $Id_bal;
	}

	function getId_balpre() {
		return $this->Id_balpre;
	}
	
	function setId_balpre($Id_balpre) {
    	$this->Id_balpre = $Id_balpre;
	}

	function getFecini_balpre() {
		return $this->Fecini_balpre;
	}
	
	function setFecini_balpre($Fecini_balpre) {
    	$this->Fecini_balpre = $Fecini_balpre;
	}

	function getFecfin_balpre() {
		return $this->Fecfin_balpre;
	}
	
	function setFecfin_balpre($Fecfin_balpre) {
    	$this->Fecfin_balpre = $Fecfin_balpre;
	}

	function getCantidad_balpre() {
		return $this->Cantidad_balpre;
	}
	
	function setCantidad_balpre($Cantidad_balpre) {
    	$this->Cantidad_balpre = $Cantidad_balpre;
	}

	function getTotal_balpre() {
		return $this->Total_balpre;
	}
	
	function setTotal_balpre($Total_balpre) {
    	$this->Total_balpre = $Total_balpre;
	}

	function getEstado_balpre() {
		return $this->Estado_balpre;
	}
	
	function setEstado_balpre($Estado_balpre) {
    	$this->Estado_balpre = $Estado_balpre;
	}
}
?>