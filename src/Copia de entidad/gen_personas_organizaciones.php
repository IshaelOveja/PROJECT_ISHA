<?php 
class gen_personas_organizaciones { 
	private $cc_organizaciones;
	private $cc_persona;
	private $raz_social;
	private $tip_ins;
	private $cargo;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $estado;
	private $ip;
	function __construct(){
		$this->cc_organizaciones= 0;
		$this->cc_persona= 0;
		$this->raz_social= "";
		$this->tip_ins= 0;
		$this->cargo= "";
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->estado= "";
		$this->ip= "";
	}
	function __destruct() {
	}
	public function  getCc_organizaciones() {
			return $this->cc_organizaciones;
	}
 public function  setCc_organizaciones($cc_organizaciones) {
       		$this->cc_organizaciones = $cc_organizaciones; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getRaz_social() {
			return $this->raz_social;
	}
 public function  setRaz_social($raz_social) {
       		$this->raz_social = $raz_social; 
	}
	public function  getTip_ins() {
			return $this->tip_ins;
	}
 public function  setTip_ins($tip_ins) {
       		$this->tip_ins = $tip_ins; 
	}
	public function  getCargo() {
			return $this->cargo;
	}
 public function  setCargo($cargo) {
       		$this->cargo = $cargo; 
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