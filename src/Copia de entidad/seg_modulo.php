<?php 
class seg_modulo { 
	private $cc_modulo;
	private $ct_modulo;
	private $nn_nivel;
	private $cc_padre;
	private $ct_carpeta;
	private $ct_url;
	private $ct_img;
	private $ct_js;
	private $nn_orden;
	private $ct_clase_cuerpo;
	private $cfl_acceso;
	private $cfl_vigencia;
	
	function __construct(){
		$this->cc_modulo= 0;
		$this->ct_modulo= "";
		$this->nn_nivel= 0;
		$this->cc_padre= 0;
		$this->ct_carpeta= "";
		$this->ct_url= "";
		$this->ct_img= "";
		$this->ct_js= "";
		$this->nn_orden= 0;
		$this->ct_clase_cuerpo= "";
		$this->cfl_acceso= 0;
		$this->cfl_vigencia= 0;
	}
	function __destruct() {
	}
	public function  getCc_modulo() {
			return $this->cc_modulo;
	}
	public function  setCc_modulo($cc_modulo) {
       		$this->cc_modulo = $cc_modulo; 
	}
	public function  getCt_modulo() {
			return $this->ct_modulo;
	}
	public function  setCt_modulo($ct_modulo) {
       		$this->ct_modulo = $ct_modulo; 
	}
	public function  getNn_nivel() {
			return $this->nn_nivel;
	}
	public function  setNn_nivel($nn_nivel) {
       		$this->nn_nivel = $nn_nivel; 
	}
	public function  getCc_padre() {
			return $this->cc_padre;
	}
	public function  setCc_padre($cc_padre) {
       		$this->cc_padre = $cc_padre; 
	}
	public function  getCt_carpeta() {
			return $this->ct_carpeta;
	}
	public function  setCt_carpeta($ct_carpeta) {
       		$this->ct_carpeta = $ct_carpeta; 
	}
	public function  getCt_url() {
			return $this->ct_url;
	}
	public function  setCt_url($ct_url) {
       		$this->ct_url = $ct_url; 
	}
	public function  getCt_img() {
			return $this->ct_img;
	}
	public function  setCt_img($ct_img) {
       		$this->ct_img = $ct_img; 
	}
	public function  getCt_js() {
			return $this->ct_js;
	}
	public function  setCt_js($ct_js) {
       		$this->ct_js = $ct_js; 
	}
	public function  getNn_orden() {
			return $this->nn_orden;
	}
	public function  setNn_orden($nn_orden) {
       		$this->nn_orden = $nn_orden; 
	}
	public function  getCt_clase_cuerpo() {
			return $this->ct_clase_cuerpo;
	}
	public function  setCt_clase_cuerpo($ct_clase_cuerpo) {
       		$this->ct_clase_cuerpo = $ct_clase_cuerpo; 
	}
	public function  getCfl_acceso() {
			return $this->cfl_acceso;
	}
	public function  setCfl_acceso($cfl_acceso) {
       		$this->cfl_acceso = $cfl_acceso; 
	}
	public function  getCfl_vigencia() {
			return $this->cfl_vigencia;
	}
	public function  setCfl_vigencia($cfl_vigencia) {
       		$this->cfl_vigencia = $cfl_vigencia; 
	}
}
?>