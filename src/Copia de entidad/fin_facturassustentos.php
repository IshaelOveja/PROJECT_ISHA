<?php 
class fin_facturassustentos { 
	private $cc_facturassustentos;
	private $cc_factura;
	private $cod_forma;
	private $fecha;
	private $c_operacion;
	private $fecha_referencia;
	private $ch_numero;
	private $ch_banco;
	private $monto;
	private $cc_banco;
	function __construct(){
		$this->cc_facturassustentos= 0;
		$this->cc_factura= 0;
		$this->cod_forma= "";
		$this->fecha= "";
		$this->c_operacion= "";
		$this->fecha_referencia= "";
		$this->ch_numero= "";
		$this->ch_banco= "";
		$this->monto= 0;
		$this->cc_banco= 0;
	}
	function __destruct() {
	}
	public function  getCc_facturassustentos() {
			return $this->cc_facturassustentos;
	}
 public function  setCc_facturassustentos($cc_facturassustentos) {
       		$this->cc_facturassustentos = $cc_facturassustentos; 
	}
	public function  getCc_factura() {
			return $this->cc_factura;
	}
 public function  setCc_factura($cc_factura) {
       		$this->cc_factura = $cc_factura; 
	}
	public function  getCod_forma() {
			return $this->cod_forma;
	}
 public function  setCod_forma($cod_forma) {
       		$this->cod_forma = $cod_forma; 
	}
	public function  getFecha() {
			return $this->fecha;
	}
 public function  setFecha($fecha) {
       		$this->fecha = $fecha; 
	}
	public function  getC_operacion() {
			return $this->c_operacion;
	}
 public function  setC_operacion($c_operacion) {
       		$this->c_operacion = $c_operacion; 
	}
	public function  getFecha_referencia() {
			return $this->fecha_referencia;
	}
 public function  setFecha_referencia($fecha_referencia) {
       		$this->fecha_referencia = $fecha_referencia; 
	}
	public function  getCh_numero() {
			return $this->ch_numero;
	}
 public function  setCh_numero($ch_numero) {
       		$this->ch_numero = $ch_numero; 
	}
	public function  getCh_banco() {
			return $this->ch_banco;
	}
 public function  setCh_banco($ch_banco) {
       		$this->ch_banco = $ch_banco; 
	}
	public function  getMonto() {
			return $this->monto;
	}
 public function  setMonto($monto) {
       		$this->monto = $monto; 
	}
	public function  getCc_banco() {
			return $this->cc_banco;
	}
 public function  setCc_banco($cc_banco) {
       		$this->cc_banco = $cc_banco; 
	}
}
?>