<?php
require_once(u_src()."dao/dao_general.php");

class bo_general{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_general();
	}
public function url($codigo){
	$sql="SELECT fc_ruta ('".$codigo."') as ruta";
	return $this->dao->consulta($sql);
	}
public function listarIdPais($cc_pais){
		$sql="select cc_pais, 
						nombre 
						from gen_pais 															
  				  	WHERE cc_pais='".$cc_pais."' ";
					//echo $sql
		return $this->dao->consulta($sql);
	}
	
	public function listarPais(){
		
		$sql="select cc_pais, 
				nombre 
				from gen_pais 
			ORDER BY nombre asc ";
					//echo $sql;
		return $this->dao->consulta($sql);
	}


/******************ubigeo*******************/
		public function ubigeoId($ubigeoID){
		$sql="select 
				coddpto, 
				codprov, 
				coddist, 
				nombre
				from gen_ubigeo															
  				WHERE concat(coddpto,'',codprov,'',coddist)='".$ubigeoID."'";
				//echo $sql;
                return $this->dao->consulta($sql);
	}
	public function listarDepartamento(){
		$sql="select ubigeoID,
				coddpto, 
				codprov, 
				coddist, 
				nombre
				from gen_ubigeo 
				WHERE codprov='00'
				AND coddist='00'
				ORDER BY nombre ";
		return $this->dao->consulta($sql);
	}
   
   public function listarProvincia($coddpto){
		
		$sql=	"select 
				ubigeoID, 
				coddpto, 
				codprov, 
				coddist, 
				nombre
				from gen_ubigeo 
				WHERE coddist='00'
				AND codprov<>'00'
				AND coddpto='".$coddpto."'
				ORDER BY nombre ";
				//echo $sql;
		return $this->dao->consulta($sql);
	}
	public function listarDistrito($coddpto,$codprov){
		
		$sql=	"select concat(coddpto,'',codprov,'',coddist) as ubigeo,
				nombre
				from gen_ubigeo 
				WHERE coddpto='".$coddpto."'
				AND codprov='".$codprov."'
				AND coddist <>'00' 
				ORDER BY nombre ";
				//echo $sql;
		return $this->dao->consulta($sql);
	}
	/*************************************/
	public function listarGiros(){
		
		$sql="select cc_giros, 
				descripcion
				from gen_giros
			ORDER BY descripcion asc ";
					//echo $sql;
		return $this->dao->consulta($sql);
	}
	/*****************UNIVERSIDAD********************/
	public function listarUniversidad(){
		
		$sql="select cc_universidad, 
				descripcion, 
				estado
				from gen_universidades
			ORDER BY descripcion asc ";
					//echo $sql;
		return $this->dao->consulta($sql);
	}
	 public function banco_cuentas($val){
		$sql=" select concat(rtrim(b.nombre),' # ',rtrim(bc.cc_cuenta_banco)) as nombre,bc.id from fin_banco_cuenta bc inner join fin_bancos b on bc.cc_banco=b.cc_banco where bc.id like '".$val."'order by b.nombre,bc.cc_cuenta_banco ";
//echo $sql;
        return  $this->dao->consulta($sql);
    }
	
	
	
	public function listarRegionesID($c_local){
	$sql="select c_local, 
				nombre, 
				nombre_abv, 
				local_ref, 
				local_direc, 
				local_tel, 
				local_mail, 
				local_web, 
				local_distrito, 
				local_mapa, 
				ruc
				from gen_local
				where c_local='".$c_local."'";
//			echo $sql;
	return $this->dao->consulta($sql);
	}
	
	function  __destruct(){
		unset($this->dao);
	}
}
?>