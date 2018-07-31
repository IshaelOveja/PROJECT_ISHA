<?php 
class gen_personas_actividades { 
	private $cc_actividades;
	private $cc_persona;
	private $cc_actividad;
	private $preferencia;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $estado;
	private $ip;
	function __construct(){
		$this->cc_actividades= 0;
		$this->cc_persona= 0;
		$this->cc_actividad= 0;
		$this->preferencia= 0;
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->estado= "";
		$this->ip= "";
	}
	function __destruct() {
	}
	public function  getCc_actividades() {
			return $this->cc_actividades;
	}
 public function  setCc_actividades($cc_actividades) {
       		$this->cc_actividades = $cc_actividades; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getCc_actividad() {
			return $this->cc_actividad;
	}
 public function  setCc_actividad($cc_actividad) {
       		$this->cc_actividad = $cc_actividad; 
	}
	public function  getPreferencia() {
			return $this->preferencia;
	}
 public function  setPreferencia($preferencia) {
       		$this->preferencia = $preferencia; 
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