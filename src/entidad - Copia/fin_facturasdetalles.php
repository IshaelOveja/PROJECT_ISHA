<?php 
class fin_facturasdetalles { 
	private $cc_facturasdetalles;
	private $cc_factura;
	private $c_articulo;
	private $cantidad;
	private $precio;
	private $igv;
	private $igv_total;
	private $observacion;
	private $monto;
	private $cod_temporal;
	function __construct(){
		$this->cc_facturasdetalles= 0;
		$this->cc_factura= 0;
		$this->c_articulo= "";
		$this->cantidad= 0;
		$this->precio= "";
		$this->igv= "";
		$this->igv_total= "";
		$this->observacion= "";
		$this->monto= "";
		$this->cod_temporal= "";
	}
	function __destruct() {
	}
	public function  getCc_facturasdetalles() {
			return $this->cc_facturasdetalles;
	}
 public function  setCc_facturasdetalles($cc_facturasdetalles) {
       		$this->cc_facturasdetalles = $cc_facturasdetalles; 
	}
	public function  getCc_factura() {
			return $this->cc_factura;
	}
 public function  setCc_factura($cc_factura) {
       		$this->cc_factura = $cc_factura; 
	}
	public function  getC_articulo() {
			return $this->c_articulo;
	}
 public function  setC_articulo($c_articulo) {
       		$this->c_articulo = $c_articulo; 
	}
	public function  getCantidad() {
			return $this->cantidad;
	}
 public function  setCantidad($cantidad) {
       		$this->cantidad = $cantidad; 
	}
	public function  getPrecio() {
			return $this->precio;
	}
 public function  setPrecio($precio) {
       		$this->precio = $precio; 
	}
	public function  getIgv() {
			return $this->igv;
	}
 public function  setIgv($igv) {
       		$this->igv = $igv; 
	}
	public function  getIgv_total() {
			return $this->igv_total;
	}
 public function  setIgv_total($igv_total) {
       		$this->igv_total = $igv_total; 
	}
	public function  getObservacion() {
			return $this->observacion;
	}
 public function  setObservacion($observacion) {
       		$this->observacion = $observacion; 
	}
	public function  getMonto() {
			return $this->monto;
	}
 public function  setMonto($monto) {
       		$this->monto = $monto; 
	}
	public function  getCod_temporal() {
			return $this->cod_temporal;
	}
 public function  setCod_temporal($cod_temporal) {
       		$this->cod_temporal = $cod_temporal; 
	}
}
?>