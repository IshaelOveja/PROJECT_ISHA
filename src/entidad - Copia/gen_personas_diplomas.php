<?php 
class gen_personas_diplomas { 
	private $cc_diplomas;
	private $cc_persona;
	private $cc_universidad;
	private $nivel;
	private $denominacion;
	private $especialidad;
	private $fecha;
	private $nro_reg;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $ip;
	private $estado;
	function __construct(){
		$this->cc_diplomas= 0;
		$this->cc_persona= 0;
		$this->cc_universidad= 0;
		$this->nivel= 0;
		$this->denominacion= "";
		$this->especialidad= "";
		$this->fecha= "";
		$this->nro_reg= "";
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->ip= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_diplomas() {
			return $this->cc_diplomas;
	}
 public function  setCc_diplomas($cc_diplomas) {
       		$this->cc_diplomas = $cc_diplomas; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getCc_universidad() {
			return $this->cc_universidad;
	}
 public function  setCc_universidad($cc_universidad) {
       		$this->cc_universidad = $cc_universidad; 
	}
	public function  getNivel() {
			return $this->nivel;
	}
 public function  setNivel($nivel) {
       		$this->nivel = $nivel; 
	}
	public function  getDenominacion() {
			return $this->denominacion;
	}
 public function  setDenominacion($denominacion) {
       		$this->denominacion = $denominacion; 
	}
	public function  getEspecialidad() {
			return $this->especialidad;
	}
 public function  setEspecialidad($especialidad) {
       		$this->especialidad = $especialidad; 
	}
	public function  getFecha() {
			return $this->fecha;
	}
 public function  setFecha($fecha) {
       		$this->fecha = $fecha; 
	}
	public function  getNro_reg() {
			return $this->nro_reg;
	}
 public function  setNro_reg($nro_reg) {
       		$this->nro_reg = $nro_reg; 
	}
	public function  getFecha_crea() {
			return $this->fecha_crea;
	}
 public function  setFecha_crea($fecha_crea) {
       		$this->fecha_crea = $fecha_crea; 
	}
	public function  getUser_crea() {
			return $this->user_crea;
	}
 public function  setUser_crea($user_crea) {
       		$this->user_crea = $user_crea; 
	}
	public function  getFecha_mod() {
			return $this->fecha_mod;
	}
 public function  setFecha_mod($fecha_mod) {
       		$this->fecha_mod = $fecha_mod; 
	}
	public function  getUser_mod() {
			return $this->user_mod;
	}
 public function  setUser_mod($user_mod) {
       		$this->user_mod = $user_mod; 
	}
	public function  getIp() {
			return $this->ip;
	}
 public function  setIp($ip) {
       		$this->ip = $ip; 
	}
	public function  getEstado() {
			return $this->estado;
	}
 public function  setEstado($estado) {
       		$this->estado = $estado; 
	}
}
?>