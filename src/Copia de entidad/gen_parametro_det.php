<?php 
class gen_parametro_det { 
	private $cc_par_det;
	private $cc_parametro;
	private $cc_codigo;
	private $ct_par_det;
	private $ct_par_det_corto;
	private $nn_orden;
	private $cfl_vigencia;
	private $cc_usuario_audit;
	private $df_log;
	private $ct_ip;
	function __construct(){
		$this->cc_par_det= 0;
		$this->cc_parametro= "";
		$this->cc_codigo= "";
		$this->ct_par_det= "";
		$this->ct_par_det_corto= "";
		$this->nn_orden= 0;
		$this->cfl_vigencia= 0;
		$this->cc_usuario_audit= 0;
		$this->df_log= "";
		$this->ct_ip= "";
	}
	function __destruct() {
	}
	public function  getCc_par_det() {
			return $this->cc_par_det;
	}
	public function  setCc_par_det($cc_par_det) {
       		$this->cc_par_det = $cc_par_det; 
	}
	public function  getCc_parametro() {
			return $this->cc_parametro;
	}
	public function  setCc_parametro($cc_parametro) {
       		$this->cc_parametro = $cc_parametro; 
	}
	public function  getCc_codigo() {
			return $this->cc_codigo;
	}
	public function  setCc_codigo($cc_codigo) {
       		$this->cc_codigo = $cc_codigo; 
	}
	public function  getCt_par_det() {
			return $this->ct_par_det;
	}
	public function  setCt_par_det($ct_par_det) {
       		$this->ct_par_det = $ct_par_det; 
	}
	public function  getCt_par_det_corto() {
			return $this->ct_par_det_corto;
	}
	public function  setCt_par_det_corto($ct_par_det_corto) {
       		$this->ct_par_det_corto = $ct_par_det_corto; 
	}
	public function  getNn_orden() {
			return $this->nn_orden;
	}
	public function  setNn_orden($nn_orden) {
       		$this->nn_orden = $nn_orden; 
	}
	public function  getCfl_vigencia() {
			return $this->cfl_vigencia;
	}
	public function  setCfl_vigencia($cfl_vigencia) {
       		$this->cfl_vigencia = $cfl_vigencia; 
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