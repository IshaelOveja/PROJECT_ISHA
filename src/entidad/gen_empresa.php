<?php 
class gen_empresa { 
	private $emp_razon_social;
	private $emp_nom_comercial;
	private $emp_ruc;
	private $emp_direccion;
	private $emp_telefono;
	private $emp_celular;
	private $emp_email;
	private $emp_web;
	private $emp_estado;
	function __construct(){
		$this->emp_razon_social= "";
		$this->emp_nom_comercial= "";
		$this->emp_ruc= "";
		$this->emp_direccion= "";
		$this->emp_telefono= "";
		$this->emp_celular= "";
		$this->emp_email= "";
		$this->emp_web= "";
		$this->emp_estado= "";
	}
	function __destruct() {
	}
	public function  getEmp_razon_social() {
			return $this->emp_razon_social;
	}
	public function  setEmp_razon_social($val) {
       		$this->emp_razon_social = $val; 
	}
	public function  getEmp_nom_comercial() {
			return $this->emp_nom_comercial;
	}
	public function  setEmp_nom_comercial($val) {
       		$this->emp_nom_comercial = $val; 
	}
	public function  getEmp_ruc() {
			return $this->emp_ruc;
	}
	public function  setEmp_ruc($val) {
       		$this->emp_ruc = $val; 
	}
	public function  getEmp_direccion() {
			return $this->emp_direccion;
	}
	public function  setEmp_direccion($val) {
       		$this->emp_direccion = $val; 
	}
	public function  getEmp_telefono() {
			return $this->emp_telefono;
	}
	public function  setEmp_telefono($val) {
       		$this->emp_telefono = $val; 
	}
	public function  getEmp_celular() {
			return $this->emp_celular;
	}
	public function  setEmp_celular($val) {
       		$this->emp_celular = $val; 
	}
	public function  getEmp_email() {
			return $this->emp_email;
	}
	public function  setEmp_email($val) {
       		$this->emp_email = $val; 
	}
	public function  getEmp_web() {
			return $this->emp_web;
	}
	public function  setEmp_web($val) {
       		$this->emp_web = $val; 
	}
	public function  getEmp_estado() {
			return $this->emp_estado;
	}
	public function  setEmp_estado($val) {
       		$this->emp_estado = $val; 
	}
}
?>