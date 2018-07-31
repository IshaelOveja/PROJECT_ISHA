<?php 
class gen_articulo{ 
	private $cc_articulo; 
	private $ct_codigo; 
	private $emp_id; 
	private $ct_grupo; 
	private $ct_nombre; 
	private $ct_molecula; 
	private $ct_umedida;
	private $ct_compra;
	private $ct_rentabilidad;
	private $ct_venta;
	private $ct_stock;
	private $ct_stockmin;
	private $ct_igv;
	private $ct_vigencia;
	function __construct(){
		$this->cc_articulo=0; 
		$this->ct_codigo=0; 
		$this->emp_id=""; 
		$this->ct_grupo=""; 
		$this->ct_nombre=""; 
		$this->ct_molecula=""; 
		$this->ct_umedida=""; 
		$this->ct_compra=0;
		$this->ct_rentabilidad=0;
		$this->ct_venta=0;
		$this->ct_stock=0;
		$this->ct_stockmin=0;
		$this->ct_igv="";
		$this->ct_vigencia="";
	}
	function __destruct() {
	}
	public function  getCc_articulo() {
			return $this->cc_articulo;
	}
	public function  setCc_articulo($cc_articulo) {
       		$this->cc_articulo = $cc_articulo; 
	}
	public function  getCt_codigo() {
			return $this->ct_codigo;
	}
	public function  setCt_codigo($ct_codigo) {
       		$this->ct_codigo = $ct_codigo; 
	}
	public function  getEmp_id() {
			return $this->emp_id;
	}
	public function  setEmp_id($emp_id) {
       		$this->emp_id = $emp_id; 
	}
	public function  getCt_grupo() {
			return $this->ct_grupo;
	}
	public function  setCt_grupo($ct_grupo) {
       		$this->ct_grupo = $ct_grupo; 
	}
	public function  getCt_nombre() {
			return $this->ct_nombre;
	}
	public function  setCt_nombre($ct_nombre) {
       		$this->ct_nombre = $ct_nombre; 
	}
	public function  getCt_molecula() {
			return $this->ct_molecula;
	}
	public function  setCt_molecula($ct_molecula) {
       		$this->ct_molecula = $ct_molecula; 
	}
	public function  getCt_umedida() {
			return $this->ct_umedida;
	}
	public function  setCt_umedida($ct_umedida) {
       		$this->ct_umedida = $ct_umedida; 
	}
	public function  getCt_compra() {
			return $this->ct_compra;
	}
	public function  setCt_compra($ct_compra) {
       		$this->ct_compra = $ct_compra; 
	}
	public function  getCt_rentabilidad() {
			return $this->ct_rentabilidad;
	}
	public function  setCt_rentabilidad($ct_rentabilidad) {
       		$this->ct_rentabilidad = $ct_rentabilidad; 
	}
	public function  getCt_venta() {
			return $this->ct_venta;
	}
	public function  setCt_venta($ct_venta) {
       		$this->ct_venta = $ct_venta; 
	}
	public function  getCt_stock() {
			return $this->ct_stock;
	}
	public function  setCt_stock($ct_stock) {
       		$this->ct_stock = $ct_stock; 
	}
	public function  getCt_stockmin() {
			return $this->ct_stockmin;
	}
	public function  setCt_stockmin($ct_stockmin) {
       		$this->ct_stockmin = $ct_stockmin; 
	}
	public function  getCt_igv() {
			return $this->ct_igv;
	}
	public function  setCt_igv($ct_igv) {
       		$this->ct_igv = $ct_igv; 
	}
	
	public function  getCt_vigencia() {
			return $this->ct_vigencia;
	}
	public function  setCt_vigencia($ct_vigencia) {
       		$this->ct_vigencia = $ct_vigencia; 
	}
}
?>