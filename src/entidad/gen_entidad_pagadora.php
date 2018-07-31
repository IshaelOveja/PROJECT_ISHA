<?php 
class gen_entidad_pagadora { 
	private $cc_entidad;
	private $nombre;
	private $estado;
	function __construct(){
		$this->cc_entidad= 0;
		$this->nombre= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_entidad() {
			return $this->cc_entidad;
	}
 public function  setCc_entidad($cc_entidad) {
       		$this->cc_entidad = $cc_entidad; 
	}
	public function  getNombre() {
			return $this->nombre;
	}
 public function  setNombre($nombre) {
       		$this->nombre = $nombre; 
	}
	public function  getEstado() {
			return $this->estado;
	}
 public function  setEstado($estado) {
       		$this->estado = $estado; 
	}
}
?>