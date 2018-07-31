<?php 
class seg_modulo_pagina { 
	private $cc_modulo;
	private $cc_pagina;
	function __construct(){
		$this->cc_modulo= 0;
		$this->cc_pagina= 0;
	}
	function __destruct() {
	}
	public function  getCc_modulo() {
			return $this->cc_modulo;
	}
	public function  setCc_modulo($cc_modulo) {
       		$this->cc_modulo = $cc_modulo; 
	}
	public function  getCc_pagina() {
			return $this->cc_pagina;
	}
	public function  setCc_pagina($cc_pagina) {
       		$this->cc_pagina = $cc_pagina; 
	}
}
?>