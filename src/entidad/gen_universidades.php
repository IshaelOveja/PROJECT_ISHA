<?php 
class gen_universidades { 
	private $cc_universidad;
	private $descripcion;
	private $estado;
	function __construct(){
		$this->cc_universidad= 0;
		$this->descripcion= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_universidad() {
			return $this->cc_universidad;
	}
 public function  setCc_universidad($cc_universidad) {
       		$this->cc_universidad = $cc_universidad; 
	}
	public function  getDescripcion() {
			return $this->descripcion;
	}
 public function  setDescripcion($descripcion) {
       		$this->descripcion = $descripcion; 
	}
	public function  getEstado() {
			return $this->estado;
	}
 public function  setEstado($estado) {
       		$this->estado = $estado; 
	}
}
?>