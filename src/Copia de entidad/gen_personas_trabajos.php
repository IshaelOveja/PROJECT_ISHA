<?php 
class gen_personas_trabajos { 
	private $cc_trabajos;
	private $cc_giros;
	private $cc_persona;
	private $raz_soc;
	private $cargo;
	private $fch_ini;
	private $fch_fin;
	private $tip_emp;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $ip;
	private $estado;
	function __construct(){
		$this->cc_trabajos= 0;
		$this->cc_giros= 0;
		$this->cc_persona= 0;
		$this->raz_soc= "";
		$this->cargo= "";
		$this->fch_ini= "";
		$this->fch_fin= "";
		$this->tip_emp= 0;
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->ip= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_trabajos() {
			return $this->cc_trabajos;
	}
 public function  setCc_trabajos($cc_trabajos) {
       		$this->cc_trabajos = $cc_trabajos; 
	}
	public function  getCc_giros() {
			return $this->cc_giros;
	}
 public function  setCc_giros($cc_giros) {
       		$this->cc_giros = $cc_giros; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getRaz_soc() {
			return $this->raz_soc;
	}
 public function  setRaz_soc($raz_soc) {
       		$this->raz_soc = $raz_soc; 
	}
	public function  getCargo() {
			return $this->cargo;
	}
 public function  setCargo($cargo) {
       		$this->cargo = $cargo; 
	}
	public function  getFch_ini() {
			return $this->fch_ini;
	}
 public function  setFch_ini($fch_ini) {
       		$this->fch_ini = $fch_ini; 
	}
	public function  getFch_fin() {
			return $this->fch_fin;
	}
 public function  setFch_fin($fch_fin) {
       		$this->fch_fin = $fch_fin; 
	}
	public function  getTip_emp() {
			return $this->tip_emp;
	}
 public function  setTip_emp($tip_emp) {
       		$this->tip_emp = $tip_emp; 
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