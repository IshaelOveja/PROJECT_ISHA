<?php 
class gen_personas { 
	private $cc_persona;
	private $fecha_de_registro;
	private $cod_tipo;
	private $c_colegiado;
	private $fecha_de_colegiacion;
	private $flag_activo;
	private $cod_sexo;
	private $apellido_Materno;
	private $apellido_Paterno;
	private $Nombre1;
	private $Nombre2;
	private $nombre;
	private $fecha_nacimiento;
	private $pais_nacimiento;
	private $ubigeonac;
	private $cod_documento;
	private $num_documento;
	private $e_civil;
	private $ruc;
	private $afp_onp;
	private $celular1;
	private $celular2;
	private $email1;
	private $email2;
	private $c_local;
	private $tipo_direc;
	private $direccion;
	private $ubigeodirec;
	private $factor_sanguineo;
	private $fecha_de_cese;
	private $fecha_fallecido;
	private $c_entidad_pagadora;
	private $c_sector_entidad_pagadora;
	private $n_folio_cole;
	private $n_libro_cole;
	private $n_resolucion_cole;
	private $flag;
	private $fecha_crea;
	private $user_crea;
	private $fecha_mod;
	private $user_mod;
	function __construct(){
		$this->cc_persona= 0;
		$this->fecha_de_registro= "";
		$this->cod_tipo= "";
		$this->c_colegiado= "";
		$this->fecha_de_colegiacion= "";
		$this->flag_activo= "";
		$this->cod_sexo= "";
		$this->apellido_Materno= "";
		$this->apellido_Paterno= "";
		$this->Nombre1= "";
		$this->Nombre2= "";
		$this->nombre= "";
		$this->fecha_nacimiento= "";
		$this->pais_nacimiento= "";
		$this->ubigeonac= "";
		$this->cod_documento= "";
		$this->num_documento= "";
		$this->e_civil= "";
		$this->ruc= "";
		$this->afp_onp= "";
		$this->celular1= "";
		$this->celular2= "";
		$this->email1= "";
		$this->email2= "";
		$this->c_local= "";
		$this->tipo_direc= "";
		$this->direccion= "";
		$this->ubigeodirec= "";
		$this->factor_sanguineo= "";
		$this->fecha_de_cese= "";
		$this->fecha_fallecido= "";
		$this->c_entidad_pagadora= "";
		$this->c_sector_entidad_pagadora= "";
		$this->n_folio_cole= "";
		$this->n_libro_cole= "";
		$this->n_resolucion_cole= "";
		$this->flag= "";
		$this->fecha_crea= "";
		$this->user_crea= "";
		$this->fecha_mod= "";
		$this->user_mod= "";
	}
	function __destruct() {
	}
	public function  getCc_persona() {
			return $this->cc_persona;
	}
 public function  setCc_persona($cc_persona) {
       		$this->cc_persona = $cc_persona; 
	}
	public function  getFecha_de_registro() {
			return $this->fecha_de_registro;
	}
 public function  setFecha_de_registro($fecha_de_registro) {
       		$this->fecha_de_registro = $fecha_de_registro; 
	}
	public function  getCod_tipo() {
			return $this->cod_tipo;
	}
 public function  setCod_tipo($cod_tipo) {
       		$this->cod_tipo = $cod_tipo; 
	}
	public function  getC_colegiado() {
			return $this->c_colegiado;
	}
 public function  setC_colegiado($c_colegiado) {
       		$this->c_colegiado = $c_colegiado; 
	}
	public function  getFecha_de_colegiacion() {
			return $this->fecha_de_colegiacion;
	}
 public function  setFecha_de_colegiacion($fecha_de_colegiacion) {
       		$this->fecha_de_colegiacion = $fecha_de_colegiacion; 
	}
	public function  getFlag_activo() {
			return $this->flag_activo;
	}
 public function  setFlag_activo($flag_activo) {
       		$this->flag_activo = $flag_activo; 
	}
	public function  getCod_sexo() {
			return $this->cod_sexo;
	}
 public function  setCod_sexo($cod_sexo) {
       		$this->cod_sexo = $cod_sexo; 
	}
	public function  getApellido_Materno() {
			return $this->apellido_Materno;
	}
 public function  setApellido_Materno($apellido_Materno) {
       		$this->apellido_Materno = $apellido_Materno; 
	}
	public function  getApellido_Paterno() {
			return $this->apellido_Paterno;
	}
 public function  setApellido_Paterno($apellido_Paterno) {
       		$this->apellido_Paterno = $apellido_Paterno; 
	}
	public function  getNombre1() {
			return $this->Nombre1;
	}
 public function  setNombre1($Nombre1) {
       		$this->Nombre1 = $Nombre1; 
	}
	public function  getNombre2() {
			return $this->Nombre2;
	}
 public function  setNombre2($Nombre2) {
       		$this->Nombre2 = $Nombre2; 
	}
	public function  getNombre() {
			return $this->nombre;
	}
 public function  setNombre($nombre) {
       		$this->nombre = $nombre; 
	}
	public function  getFecha_nacimiento() {
			return $this->fecha_nacimiento;
	}
 public function  setFecha_nacimiento($fecha_nacimiento) {
       		$this->fecha_nacimiento = $fecha_nacimiento; 
	}
	public function  getPais_nacimiento() {
			return $this->pais_nacimiento;
	}
 public function  setPais_nacimiento($pais_nacimiento) {
       		$this->pais_nacimiento = $pais_nacimiento; 
	}
	public function  getUbigeonac() {
			return $this->ubigeonac;
	}
 public function  setUbigeonac($ubigeonac) {
       		$this->ubigeonac = $ubigeonac; 
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
	public function  getE_civil() {
			return $this->e_civil;
	}
 public function  setE_civil($e_civil) {
       		$this->e_civil = $e_civil; 
	}
	public function  getRuc() {
			return $this->ruc;
	}
 public function  setRuc($ruc) {
       		$this->ruc = $ruc; 
	}
	public function  getAfp_onp() {
			return $this->afp_onp;
	}
 public function  setAfp_onp($afp_onp) {
       		$this->afp_onp = $afp_onp; 
	}
	public function  getCelular1() {
			return $this->celular1;
	}
 public function  setCelular1($celular1) {
       		$this->celular1 = $celular1; 
	}
	public function  getCelular2() {
			return $this->celular2;
	}
 public function  setCelular2($celular2) {
       		$this->celular2 = $celular2; 
	}
	public function  getEmail1() {
			return $this->email1;
	}
 public function  setEmail1($email1) {
       		$this->email1 = $email1; 
	}
	public function  getEmail2() {
			return $this->email2;
	}
 public function  setEmail2($email2) {
       		$this->email2 = $email2; 
	}
	public function  getC_local() {
			return $this->c_local;
	}
 public function  setC_local($c_local) {
       		$this->c_local = $c_local; 
	}
	public function  getTipo_direc() {
			return $this->tipo_direc;
	}
 public function  setTipo_direc($tipo_direc) {
       		$this->tipo_direc = $tipo_direc; 
	}
	public function  getDireccion() {
			return $this->direccion;
	}
 public function  setDireccion($direccion) {
       		$this->direccion = $direccion; 
	}
	public function  getUbigeodirec() {
			return $this->ubigeodirec;
	}
 public function  setUbigeodirec($ubigeodirec) {
       		$this->ubigeodirec = $ubigeodirec; 
	}
	public function  getFactor_sanguineo() {
			return $this->factor_sanguineo;
	}
 public function  setFactor_sanguineo($factor_sanguineo) {
       		$this->factor_sanguineo = $factor_sanguineo; 
	}
	public function  getFecha_de_cese() {
			return $this->fecha_de_cese;
	}
 public function  setFecha_de_cese($fecha_de_cese) {
       		$this->fecha_de_cese = $fecha_de_cese; 
	}
	public function  getFecha_fallecido() {
			return $this->fecha_fallecido;
	}
 public function  setFecha_fallecido($fecha_fallecido) {
       		$this->fecha_fallecido = $fecha_fallecido; 
	}
	public function  getC_entidad_pagadora() {
			return $this->c_entidad_pagadora;
	}
 public function  setC_entidad_pagadora($c_entidad_pagadora) {
       		$this->c_entidad_pagadora = $c_entidad_pagadora; 
	}
	public function  getC_sector_entidad_pagadora() {
			return $this->c_sector_entidad_pagadora;
	}
 public function  setC_sector_entidad_pagadora($c_sector_entidad_pagadora) {
       		$this->c_sector_entidad_pagadora = $c_sector_entidad_pagadora; 
	}
	public function  getN_folio_cole() {
			return $this->n_folio_cole;
	}
 public function  setN_folio_cole($n_folio_cole) {
       		$this->n_folio_cole = $n_folio_cole; 
	}
	public function  getN_libro_cole() {
			return $this->n_libro_cole;
	}
 public function  setN_libro_cole($n_libro_cole) {
       		$this->n_libro_cole = $n_libro_cole; 
	}
	public function  getN_resolucion_cole() {
			return $this->n_resolucion_cole;
	}
 public function  setN_resolucion_cole($n_resolucion_cole) {
       		$this->n_resolucion_cole = $n_resolucion_cole; 
	}
	public function  getFlag() {
			return $this->flag;
	}
 public function  setFlag($flag) {
       		$this->flag = $flag; 
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
}
?>