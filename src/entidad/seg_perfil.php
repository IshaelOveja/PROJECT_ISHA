<?php 
class seg_perfil { 
	private $cc_perfil;
	private $ct_perfil;
	private $cc_modulo_defecto;
	private $cfl_vigencia;
	function __construct(){
		$this->cc_perfil= 0;
		$this->ct_perfil= "";
		$this->cc_modulo_defecto= 0;
		$this->cfl_vigencia= 0;
	}
	function __destruct() {
	}
	public function  getCc_perfil() {
			return $this->cc_perfil;
	}
	public function  setCc_perfil($cc_perfil) {
       		$this->cc_perfil = $cc_perfil; 
	}
	public function  getCt_perfil() {
			return $this->ct_perfil;
	}
	public function  setCt_perfil($ct_perfil) {
       		$this->ct_perfil = $ct_perfil; 
	}
	public function  getCc_modulo_defecto() {
			return $this->cc_modulo_defecto;
	}
	public function  setCc_modulo_defecto($cc_modulo_defecto) {
       		$this->cc_modulo_defecto = $cc_modulo_defecto; 
	}
	public function  getCfl_vigencia() {
			return $this->cfl_vigencia;
	}
	public function  setCfl_vigencia($cfl_vigencia) {
       		$this->cfl_vigencia = $cfl_vigencia; 
	}
}
?>