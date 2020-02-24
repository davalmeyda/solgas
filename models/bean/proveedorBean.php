<?php
class proveedorBean {
	private $Id_prov;
	private $Ruc_prov;
	private $Razsoc_prov;
	private $Direccion_prov;
	
	function getId_prov() {
		return $this->Id_prov;
	}

	function setId_prov($Id_prov) {
    	$this->Id_prov = $Id_prov;
	}

	function getRuc_prov() {
		return $this->Ruc_prov;
	}

	function setRuc_prov($Ruc_prov) {
    	$this->Ruc_prov = $Ruc_prov;
	}

	function getRazsoc_prov() {
		return $this->Razsoc_prov;
	}

	function setRazsoc_prov($Razsoc_prov) {
    	$this->Razsoc_prov = $Razsoc_prov;
	}

	function getDireccion_prov() {
		return $this->Direccion_prov;
	}

	function setDireccion_prov($Direccion_prov) {
    	$this->Direccion_prov = $Direccion_prov;
	}
}
?>