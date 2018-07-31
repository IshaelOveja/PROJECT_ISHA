<?php
require_once(u_src()."dao/dao_caja.php");

class bo_caja{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_caja();
	}
	

		
	
	function  __destruct(){
		unset($this->dao);
	}
}


?>
