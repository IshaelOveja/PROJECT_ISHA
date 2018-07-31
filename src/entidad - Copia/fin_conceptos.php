<?php 
class fin_conceptos { 
	private $cc_articulo;
	private $tipo;
	private $nombre; 
	private $igv;
	private $monto; 
	private $c_cuenta; 
	private $activo;
	function __construct(){
		$this->cc_articulo= 0;
		$this->tipo= "";
		$this->nombre= "";
		$this->igv= "";
		$this->monto= 0;
		$this->c_cuenta= "";
		$this->activo= "";
	}
	function __destruct() {
	}
	public function  getCc_articulo() {
			return $this->cc_articulo;
	}
 	public function  setCc_articulo($cc_articulo) {
       		$this->cc_articulo = $cc_articulo; 
	}
	public function  getTipo() {
			return $this->tipo;
	}
	 public function  setTipo($tipo) {
       		$this->tipo = $tipo; 
	}
	public function  getNombre() {
			return $this->nombre;
	}
 public function  setNombre($nombre) {
       		$this->nombre = $nombre; 
	}
	public function  getIgv() {
			return $this->igv;
	}
 public function  setIgv($igv) {
       		$this->igv = $igv; 
	}
	public function  getMonto() {
			return $this->monto;
	}
 public function  setMonto($monto) {
       		$this->monto = $monto; 
	}
	public function  getC_cuenta() {
			return $this->c_cuenta;
	}
 public function  setC_cuenta($c_cuenta) {
       		$this->c_cuenta = $c_cuenta; 
	}
	public function  getUsur_crea() {
			return $this->usur_crea;
	}
 public function  setUsur_crea($usur_crea) {
       		$this->usur_crea = $usur_crea; 
	}
	public function  getFecha_crea() {
			return $this->fecha_crea;
	}
 public function  setFecha_crea($fecha_crea) {
       		$this->fecha_crea = $fecha_crea; 
	}
	public function  getUsu_mod() {
			return $this->usu_mod;
	}
 public function  setUsu_mod($usu_mod) {
       		$this->usu_mod = $usu_mod; 
	}
	public function  getFech_mod() {
			return $this->fech_mod;
	}
 public function  setFech_mod($fech_mod) {
       		$this->fech_mod = $fech_mod; 
	}
	public function  getEstado() {
			return $this->estado;
	}
 public function  setEstado($estado) {
       		$this->estado = $estado; 
	}
	
}
?>