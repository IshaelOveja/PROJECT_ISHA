<?php 
class seg_pagina { 
	private $cc_pagina;
	private $ct_pagina;
	private $ct_url;
	private $ct_js;
	private $ct_clase_cuerpo;
	private $cfl_vigencia;
	function __construct(){
		$this->cc_pagina= 0;
		$this->ct_pagina= "";
		$this->ct_url= "";
		$this->ct_js= "";
		$this->ct_clase_cuerpo= "";
		$this->cfl_vigencia= 0;
	}
	function __destruct() {
	}
	public function  getCc_pagina() {
			return $this->cc_pagina;
	}
	public function  setCc_pagina($cc_pagina) {
       		$this->cc_pagina = $cc_pagina; 
	}
	public function  getCt_pagina() {
			return $this->ct_pagina;
	}
	public function  setCt_pagina($ct_pagina) {
       		$this->ct_pagina = $ct_pagina; 
	}
	public function  getCt_url() {
			return $this->ct_url;
	}
	public function  setCt_url($ct_url) {
       		$this->ct_url = $ct_url; 
	}
	public function  getCt_js() {
			return $this->ct_js;
	}
	public function  setCt_js($ct_js) {
       		$this->ct_js = $ct_js; 
	}
	public function  getCt_clase_cuerpo() {
			return $this->ct_clase_cuerpo;
	}
	public function  setCt_clase_cuerpo($ct_clase_cuerpo) {
       		$this->ct_clase_cuerpo = $ct_clase_cuerpo; 
	}
	public function  getCfl_vigencia() {
			return $this->cfl_vigencia;
	}
	public function  setCfl_vigencia($cfl_vigencia) {
       		$this->cfl_vigencia = $cfl_vigencia; 
	}
}
?>