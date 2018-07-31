<?php 
class fin_facturas { 
	private $cc_factura;
	private $cod_documento;
	private $num_documento;
	private $cc_persona;
	private $c_local;
	private $fecha;
	private $user_crea;
	private $fecha_crea;
	private $user_mod;
	private $fech_mod;
	private $estado;
	private $flag_centralizado;
	private $flag_igv;
	private $igv;
	private $total;
	private $obs;
	function __construct(){
		$this->cc_factura= 0;
		$this->cod_documento= "";
		$this->num_documento= "";
		$this->cc_persona= 0;
		$this->c_local= "";
		$this->fecha= "";
		$this->user_crea= "";
		$this->fecha_crea= "";
		$this->user_mod= "";
		$this->fech_mod= "";
		$this->estado= "";
		$this->flag_centralizado= "";
		$this->flag_igv= "";
		$this->igv= "";
		$this->total= "";
		$this->obs= "";
	}
	function __destruct() {
	}
	public function  getCc_factura() {
			return $this->cc_factura;
	}
 public function  setCc_factura($cc_factura) {
       		$this->cc_factura = $cc_factura; 
	}
	public function  getCod_documento() {
			return $this->cod_documento;
	}
 public function  setCod_documento($cod_documento) {
       		$this->cod_documento = $cod_documento; 
	}
	public function  getNum_documento() {
			return $this->num_documento;
	}
 public function  setNum_documento($num_documento) {
       		$this->num_documento = $num_documento; 
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getC_local() {
			return $this->c_local;
	}
 public function  setC_local($c_local) {
       		$this->c_local = $c_local; 
	}
	public function  getFecha() {
			return $this->fecha;
	}
 public function  setFecha($fecha) {
       		$this->fecha = $fecha; 
	}
	public function  getUser_crea() {
			return $this->user_crea;
	}
 public function  setUser_crea($user_crea) {
       		$this->user_crea = $user_crea; 
	}
	public function  getFecha_crea() {
			return $this->fecha_crea;
	}
 public function  setFecha_crea($fecha_crea) {
       		$this->fecha_crea = $fecha_crea; 
	}
	public function  getUser_mod() {
			return $this->user_mod;
	}
 public function  setUser_mod($user_mod) {
       		$this->user_mod = $user_mod; 
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
	public function  getFlag_centralizado() {
			return $this->flag_centralizado;
	}
 public function  setFlag_centralizado($flag_centralizado) {
       		$this->flag_centralizado = $flag_centralizado; 
	}
	public function  getFlag_igv() {
			return $this->flag_igv;
	}
 public function  setFlag_igv($flag_igv) {
       		$this->flag_igv = $flag_igv; 
	}
	public function  getIgv() {
			return $this->igv;
	}
 public function  setIgv($igv) {
       		$this->igv = $igv; 
	}
	public function  getTotal() {
			return $this->total;
	}
 public function  setTotal($total) {
       		$this->total = $total; 
	}
	public function  getObs() {
			return $this->obs;
	}
 public function  setObs($obs) {
       		$this->obs = $obs; 
	}
}
?>