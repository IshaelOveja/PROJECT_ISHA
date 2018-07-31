<?php 
class gen_parametro { 
	private $cc_parametro;
	private $ct_parametro;
	private $ct_descripcion;
	private $cfl_vigencia;
	function __construct(){
		$this->cc_parametro= "";
		$this->ct_parametro= "";
		$this->ct_descripcion= "";
		$this->cfl_vigencia= 0;
	}
	function __destruct() {
	}
	public function  getCc_parametro() {
			return $this->cc_parametro;
	}
	public function  setCc_parametro($cc_parametro) {
       		$this->cc_parametro = $cc_parametro; 
	}
	public function  getCt_parametro() {
			return $this->ct_parametro;
	}
	public function  setCt_parametro($ct_parametro) {
       		$this->ct_parametro = $ct_parametro; 
	}
	public function  getCt_descripcion() {
			return $this->ct_descripcion;
	}
	public function  setCt_descripcion($ct_descripcion) {
       		$this->ct_descripcion = $ct_descripcion; 
	}
	public function  getCfl_vigencia() {
			return $this->cfl_vigencia;
	}
	public function  setCfl_vigencia($cfl_vigencia) {
       		$this->cfl_vigencia = $cfl_vigencia; 
	}
}
?>