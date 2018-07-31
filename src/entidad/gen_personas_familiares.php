<?php 
class gen_personas_familiares { 
	private $cc_familiares;
	private $cc_persona;
	private $nombres;
	private $cod_sexo;
	private $parentesco;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	private $estado;
	function __construct(){
		$this->cc_familiares= 0;
		$this->cc_persona= 0;
		$this->nombres= "";
		$this->fec_nac= "";
		$this->parentesco= 0;
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
		$this->estado= "";
	}
	function __destruct() {
	}
	public function  getCc_familiares() {
			return $this->cc_familiares;
	}
 public function  setCc_familiares($cc_familiares) {
       		$this->cc_familiares = $cc_familiares; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getNombres() {
			return $this->nombres;
	}
 public function  setNombres($nombres) {
       		$this->nombres = $nombres; 
	}
	public function  getFec_nac() {
			return $this->fec_nac;
	}
 public function  setFec_nac($fec_nac) {
       		$this->fec_nac = $fec_nac; 
	}
	public function  getParentesco() {
			return $this->parentesco;
	}
 public function  setParentesco($parentesco) {
       		$this->parentesco = $parentesco; 
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
}
?>