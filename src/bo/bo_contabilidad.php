<?php
require_once(u_src()."dao/dao_contabilidad.php");

class bo_contabilidad{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_contabilidad();
	}
	
	
	function  __destruct(){
		unset($this->dao);
	}
}



?>