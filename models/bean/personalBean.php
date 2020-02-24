<?php
class personalBean {
	private $Id_per;
	private $Nombre_per;
	private $Apellido_per;
	private $Fecing_per;
	private $Fecnac_per;
	private $Correo_per;
	private $Direccion_per;
	private $Nacionalidad_per;
	private $Foto_per;
	private $Licencia_per;
	private $Tipo_contrato;
	private $Tipdoc_per;
	private $Numdoc_per;
	private $Tipo_user;
	private $Usuario_per;
	private $Clave_per;
	private $Id_temp;
	
	function getId_per() {
		return $this->Id_per;
	}

	function setId_per($Id_per) {
    	$this->Id_per = $Id_per;
	}

	function getNombre_per() {
		return $this->Nombre_per;
	}

	function setNombre_per($Nombre_per) {
    	$this->Nombre_per = $Nombre_per;
	}

	function getApellido_per() {
		return $this->Apellido_per;
	}

	function setApellido_per($Apellido_per) {
    	$this->Apellido_per = $Apellido_per;
	}

	function getFecing_per() {
		return $this->Fecing_per;
	}

	function setFecing_per($Fecing_per) {
    	$this->Fecing_per = $Fecing_per;
	}

	function getFecnac_per() {
		return $this->Fecnac_per;
	}

	function setFecnac_per($Fecnac_per) {
    	$this->Fecnac_per = $Fecnac_per;
	}

	function getCorreo_per() {
		return $this->Correo_per;
	}

	function setCorreo_per($Correo_per) {
    	$this->Correo_per = $Correo_per;
	}

	function getDireccion_per() {
		return $this->Direccion_per;
	}

	function setDireccion_per($Direccion_per) {
    	$this->Direccion_per = $Direccion_per;
	}

	function getNacionalidad_per() {
		return $this->Nacionalidad_per;
	}

	function setNacionalidad_per($Nacionalidad_per) {
    	$this->Nacionalidad_per = $Nacionalidad_per;
	}

	function getFoto_per() {
		return $this->Foto_per;
	}

	function setFoto_per($Foto_per) {
    	$this->Foto_per = $Foto_per;
	}

	function getLicencia_per() {
		return $this->Licencia_per;
	}

	function setLicencia_per($Licencia_per) {
    	$this->Licencia_per = $Licencia_per;
	}

	function getTipo_contrato() {
		return $this->Tipo_contrato;
	}

	function setTipo_contrato($Tipo_contrato) {
    	$this->Tipo_contrato = $Tipo_contrato;
	}

	function getTipdoc_per() {
		return $this->Tipdoc_per;
	}

	function setTipdoc_per($Tipdoc_per) {
    	$this->Tipdoc_per = $Tipdoc_per;
	}

	function getNumdoc_per() {
		return $this->Numdoc_per;
	}

	function setNumdoc_per($Numdoc_per) {
    	$this->Numdoc_per = $Numdoc_per;
	}

	function getTipo_user() {
		return $this->Tipo_user;
	}

	function setTipo_user($Tipo_user) {
    	$this->Tipo_user = $Tipo_user;
	}

	function getUsuario_per() {
		return $this->Usuario_per;
	}

	function setUsuario_per($Usuario_per) {
    	$this->Usuario_per = $Usuario_per;
	}

	function getClave_per() {
		return $this->Clave_per;
	}
	
	function setClave_per($Clave_per) {
    	$this->Clave_per = $Clave_per;
	}

	function getId_temp() {
		return $this->Id_temp;
	}

	function setId_temp($Id_temp) {
		$this->Id_temp = $Id_temp;
	}
}
?>