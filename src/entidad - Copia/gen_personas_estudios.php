<?php 
class gen_personas_estudios { 
	private $cc_estudios;
	private $cc_universidad;
	private $cc_persona;
	private $facultad;
	private $grado;
	private $fecha;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $estado;
	private $ip;
	function __construct(){
		$this->cc_estudios= 0;
		$this->cc_universidad= 0;
		$this->cc_persona= 0;
		$this->facultad= "";
		$this->grado= "";
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
	public function  getCc_estudios() {
			return $this->cc_estudios;
	}
 public function  setCc_estudios($cc_estudios) {
       		$this->cc_estudios = $cc_estudios; 
	}
	public function  getCc_universidad() {
			return $this->cc_universidad;
	}
 public function  setCc_universidad($cc_universidad) {
       		$this->cc_universidad = $cc_universidad; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getFacultad() {
			return $this->facultad;
	}
 public function  setFacultad($facultad) {
       		$this->facultad = $facultad; 
	}
	public function  getGrado() {
			return $this->grado;
	}
 public function  setGrado($grado) {
       		$this->grado = $grado; 
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