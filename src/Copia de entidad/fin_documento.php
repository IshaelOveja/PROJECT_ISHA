<?php 
class fin_documento { 
	private $cc_documento;
	private $nombre;
	private $nombre_corto;
	private $numero;
	private $estado;
	function __construct(){
		$this->cc_documento= 0;
		$this->nombre= "";
		$this->nombre_corto= "";
		$this->numero= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_documento() {
			return $this->cc_documento;
	}
 public function  setCc_documento($cc_documento) {
       		$this->cc_documento = $cc_documento; 
	}
	public function  getNombre() {
			return $this->nombre;
	}
 public function  setNombre($nombre) {
       		$this->nombre = $nombre; 
	}
	public function  getNombre_corto() {
			return $this->nombre_corto;
	}
 public function  setNombre_corto($nombre_corto) {
       		$this->nombre_corto = $nombre_corto; 
	}
	public function  getNumero() {
			return $this->numero;
	}
 public function  setNumero($numero) {
       		$this->numero = $numero; 
	}
	public function  getEstado() {
			return $this->estado;
	}
 public function  setEstado($estado) {
       		$this->estado = $estado; 
	}
}
?>