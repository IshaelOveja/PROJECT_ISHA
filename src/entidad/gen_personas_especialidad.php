<?php 
class gen_personas_especialidad { 
	private $cc_especialidad;
	private $cc_persona;
	private $denominacion;
	private $anios;
	private $sector;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $ip;
	private $estado;
	function __construct(){
		$this->cc_especialidad= 0;
		$this->cc_persona= 0;
		$this->denominacion= "";
		$this->anios= 0;
		$this->sector= 0;
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->ip= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_especialidad() {
			return $this->cc_especialidad;
	}
 public function  setCc_especialidad($cc_especialidad) {
       		$this->cc_especialidad = $cc_especialidad; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getDenominacion() {
			return $this->denominacion;
	}
 public function  setDenominacion($denominacion) {
       		$this->denominacion = $denominacion; 
	}
	public function  getAnios() {
			return $this->anios;
	}
 public function  setAnios($anios) {
       		$this->anios = $anios; 
	}
	public function  getSector() {
			return $this->sector;
	}
 public function  setSector($sector) {
       		$this->sector = $sector; 
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