<?php 
class gen_parametro_tabla { 
	private $cc_parametro;
	private $cc_tabla;
	private $cc_campo;
	function __construct(){
		$this->cc_parametro= "";
		$this->cc_tabla= "";
		$this->cc_campo= "";
	}
	function __destruct() {
	}
	public function  getCc_parametro() {
			return $this->cc_parametro;
	}
	public function  setCc_parametro($cc_parametro) {
       		$this->cc_parametro = $cc_parametro; 
	}
	public function  getCc_tabla() {
			return $this->cc_tabla;
	}
	public function  setCc_tabla($cc_tabla) {
       		$this->cc_tabla = $cc_tabla; 
	}
	public function  getCc_campo() {
			return $this->cc_campo;
	}
	public function  setCc_campo($cc_campo) {
       		$this->cc_campo = $cc_campo; 
	}
}
?>