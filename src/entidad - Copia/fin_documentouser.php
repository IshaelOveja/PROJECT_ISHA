<?php 
class fin_documentouser { 
	private $cc_documento;
	private $cc_persona;
	function __construct(){
		$this->cc_documento= 0;
		$this->cc_persona= 0;
	}
	function __destruct() {
	}
	public function  getCc_documento() {
			return $this->cc_documento;
	}
 public function  setCc_documento($cc_documento) {
       		$this->cc_documento = $cc_documento; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
}
?>