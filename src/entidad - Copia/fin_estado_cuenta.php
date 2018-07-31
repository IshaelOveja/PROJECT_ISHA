<?php 
class fin_estado_cuenta { 
	private $cc_estcuenta;
	private $cc_persona;
	private $cod_tipo;
	private $periodo;
	private $fecha;
	private $cc_factura;
	private $referencia;
	private $cargo_abono;
	private $monto;
	private $flag;
	private $c_local;
	private $usuario;
	function __construct(){
		$this->cc_estcuenta= 0;
		$this->cc_persona= 0;
		$this->cod_tipo= "";
		$this->periodo= "";
		$this->fecha= "";
		$this->cc_factura= 0;
		$this->referencia= "";
		$this->cargo_abono= "";
		$this->monto= 0;
		$this->flag= "";
		$this->c_local= "";
		$this->usuario= "";
	}
	function __destruct() {
	}
	public function  getCc_estcuenta() {
			return $this->cc_estcuenta;
	}
 public function  setCc_estcuenta($cc_estcuenta) {
       		$this->cc_estcuenta = $cc_estcuenta; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getCod_tipo() {
			return $this->cod_tipo;
	}
 public function  setCod_tipo($cod_tipo) {
       		$this->cod_tipo = $cod_tipo; 
	}
	public function  getPeriodo() {
			return $this->periodo;
	}
 public function  setPeriodo($periodo) {
       		$this->periodo = $periodo; 
	}
	public function  getFecha() {
			return $this->fecha;
	}
 public function  setFecha($fecha) {
       		$this->fecha = $fecha; 
	}
	public function  getCc_factura() {
			return $this->cc_factura;
	}
 public function  setCc_factura($cc_factura) {
       		$this->cc_factura = $cc_factura; 
	}
	public function  getReferencia() {
			return $this->referencia;
	}
 public function  setReferencia($referencia) {
       		$this->referencia = $referencia; 
	}
	public function  getCargo_abono() {
			return $this->cargo_abono;
	}
 public function  setCargo_abono($cargo_abono) {
       		$this->cargo_abono = $cargo_abono; 
	}
	public function  getMonto() {
			return $this->monto;
	}
 public function  setMonto($monto) {
       		$this->monto = $monto; 
	}
	public function  getFlag() {
			return $this->flag;
	}
 public function  setFlag($flag) {
       		$this->flag = $flag; 
	}
	public function  getC_local() {
			return $this->c_local;
	}
 public function  setC_local($c_local) {
       		$this->c_local = $c_local; 
	}
	public function  getUsuario() {
			return $this->usuario;
	}
 public function  setUsuario($usuario) {
       		$this->usuario = $usuario; 
	}
}
?>