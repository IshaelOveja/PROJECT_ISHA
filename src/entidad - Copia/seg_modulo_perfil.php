<?php 
class seg_modulo_perfil { 
	private $cc_modulo;
	private $cc_perfil;
	private $cc_usuario_audit;
	private $df_log;
	private $ct_ip;
	function __construct(){
		$this->cc_modulo= 0;
		$this->cc_perfil= 0;
		$this->cc_usuario_audit= 0;
		$this->df_log= "";
		$this->ct_ip= "";
	}
	function __destruct() {
	}
	public function  getCc_modulo() {
			return $this->cc_modulo;
	}
	public function  setCc_modulo($cc_modulo) {
       		$this->cc_modulo = $cc_modulo; 
	}
	public function  getCc_perfil() {
			return $this->cc_perfil;
	}
	public function  setCc_perfil($cc_perfil) {
       		$this->cc_perfil = $cc_perfil; 
	}
	public function  getCc_usuario_audit() {
			return $this->cc_usuario_audit;
	}
	public function  setCc_usuario_audit($cc_usuario_audit) {
       		$this->cc_usuario_audit = $cc_usuario_audit; 
	}
	public function  getDf_log() {
			return $this->df_log;
	}
	public function  setDf_log($df_log) {
       		$this->df_log = $df_log; 
	}
	public function  getCt_ip() {
			return $this->ct_ip;
	}
	public function  setCt_ip($ct_ip) {
       		$this->ct_ip = $ct_ip; 
	}
}
?>