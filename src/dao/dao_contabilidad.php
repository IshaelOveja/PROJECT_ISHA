<?php
require_once(u_src()."dao/Conecta.php");
class dao_contabilidad{
	private $conecta;

	function __construct(){
		$this->conecta = new Conecta();
	}
	public function consulta($sql){
		return $this->conecta->ArrayLista($sql);
	}	
	
		
	function  __destruct(){
		$this->conecta->cerrarCN();
		unset($this->conecta);
	}
}
?>
