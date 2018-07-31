<?php 
require_once(u_src()."entidad/gen_personas.php");
class seg_usuario extends gen_personas { 
	private $cc_usuario;
	private $cc_user;
	private $cc_perfil;
	private $ct_clave;
	private $nn_tiempo_sesion;
	private $cp_nivel;
	private $cfl_acceso;
	private $df_caduca;
	private $cfl_clave_cambia;
	private $cc_usuario_audit;
	private $df_log;
	private $ct_ip;
	function __construct(){
		$this->cc_usuario= "";
		$this->cc_user= "";
		$this->cc_perfil= 0;
		$this->ct_clave= "";
		$this->nn_tiempo_sesion= 0;
		$this->cp_nivel= "";
		$this->cfl_acceso= 0;
		$this->df_caduca= "";
		$this->cfl_clave_cambia= 0;
		$this->cc_usuario_audit= "";
		$this->df_log= "";
		$this->ct_ip= "";
	}
	function __destruct() {
	}
	public function  getCc_usuario() {
			return $this->cc_usuario;
	}
	public function  setCc_usuario($cc_usuario) {
       		$this->cc_usuario = $cc_usuario; 
	}
	public function  getCc_user() {
			return $this->cc_user;
	}
	public function  setCc_user($cc_user) {
       		$this->cc_user = $cc_user; 
	}
	public function  getCc_perfil() {
			return $this->cc_perfil;
	}
	public function  setCc_perfil($cc_perfil) {
       		$this->cc_perfil = $cc_perfil; 
	}
	public function  getCt_clave() {
			return $this->ct_clave;
	}
	public function  setCt_clave($ct_clave) {
       		$this->ct_clave = $ct_clave; 
	}
	public function  getNn_tiempo_sesion() {
			return $this->nn_tiempo_sesion;
	}
	public function  setNn_tiempo_sesion($nn_tiempo_sesion) {
       		$this->nn_tiempo_sesion = $nn_tiempo_sesion; 
	}
	public function  getCp_nivel() {
			return $this->cp_nivel;
	}
	public function  setCp_nivel($cp_nivel) {
       		$this->cp_nivel = $cp_nivel; 
	}
	public function  getCfl_acceso() {
			return $this->cfl_acceso;
	}
	public function  setCfl_acceso($cfl_acceso) {
       		$this->cfl_acceso = $cfl_acceso; 
	}
	public function  getDf_caduca() {
			return $this->df_caduca;
	}
	public function  setDf_caduca($df_caduca) {
       		$this->df_caduca = $df_caduca; 
	}
	public function  getCfl_clave_cambia() {
			return $this->cfl_clave_cambia;
	}
	public function  setCfl_clave_cambia($cfl_clave_cambia) {
       		$this->cfl_clave_cambia = $cfl_clave_cambia; 
	}
	public function  getCc_usuario_audit() {
			return $this->cc_usuario_audit;
	}
	public function  setCc_usuario_audit($cc_usuario_audit) {
       		$this->cc_usuario_audit = $cc_usuario_audit; 
	}
	public function  getDf_log() {
			return $this->df_log;
	}
	public function  setDf_log($df_log) {
       		$this->df_log = $df_log; 
	}
	public function  getCt_ip() {
			return $this->ct_ip;
	}
	public function  setCt_ip($ct_ip) {
       		$this->ct_ip = $ct_ip; 
	}
}
?>