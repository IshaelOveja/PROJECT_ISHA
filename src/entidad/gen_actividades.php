<?php 
class gen_actividades { 
	private $cc_actividad;
	private $nombre;
	function __construct(){
		$this->cc_actividad= 0;
		$this->nombre= "";
	}
	function __destruct() {
	}
	public function  getCc_actividad() {
			return $this->cc_actividad;
	}
 public function  setCc_actividad($cc_actividad) {
       		$this->cc_actividad = $cc_actividad; 
	}
	public function  getNombre() {
			return $this->nombre;
	}
 public function  setNombre($nombre) {
       		$this->nombre = $nombre; 
	}
}
?>