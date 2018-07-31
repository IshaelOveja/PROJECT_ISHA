<?php 
class gen_personas_colegios { 
	private $cc_colegios;
	private $cc_persona;
	private $colegio;
	private $numero;
	private $fecha;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $estado;
	private $ip;
	function __construct(){
		$this->cc_colegios= 0;
		$this->cc_persona= 0;
		$this->colegio= "";
		$this->numero= "";
		$this->fecha= "";
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->estado= "";
		$this->ip= "";
	}
	function __destruct() {
	}
	public function  getCc_colegios() {
			return $this->cc_colegios;
	}
 public function  setCc_colegios($cc_colegios) {
       		$this->cc_colegios = $cc_colegios; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getColegio() {
			return $this->colegio;
	}
 public function  setColegio($colegio) {
       		$this->colegio = $colegio; 
	}
	public function  getNumero() {
			return $this->numero;
	}
 public function  setNumero($numero) {
       		$this->numero = $numero; 
	}
	public function  getFecha() {
			return $this->fecha;
	}
 public function  setFecha($fecha) {
       		$this->fecha = $fecha; 
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
	public function  getEstado() {
			return $this->estado;
	}
 public function  setEstado($estado) {
       		$this->estado = $estado; 
	}
	public function  getIp() {
			return $this->ip;
	}
 public function  setIp($ip) {
       		$this->ip = $ip; 
	}
}
?>