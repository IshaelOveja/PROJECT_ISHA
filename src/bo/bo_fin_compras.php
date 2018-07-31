<?php 
require_once(u_src()."dao/dao_fin_compras.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_fin_compras  extends SYQ_Paginacion { 
	private $dao; 
	
    function __construct(){
       $this->dao = new dao_fin_compras();
    }
    public function control(fin_compras $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
	public function eliminar($cc_compras){
       return $this->dao->eliminar($cc_compras);
    }

public function listarId($cc_compras){
	$sql="select 
			cc_compras, 
			ct_fecha, 
			ct_comprobante, 
			ct_serie, 
			ct_numero, 
			DATE_FORMAT(ct_fecha_doc,'%d/%m/%Y') as ct_fecha_doc,
			ct_obs,
			emp_id,
			ct_vigencia, 
			(select seg_usuario.cc_user from seg_usuario where seg_usuario.cc_usuario=fin_compras.cc_usuario) as cc_usuario,
			ct_total
			from fin_compras
			where cc_compras='".$cc_compras."'";
			//echo $sql;
	return $this->dao->consulta($sql);
	}

 public function listar(fin_compras $obj){
         $pagina = $this->getPagina();
         $por_pagina= $this->getSelectable_pages();
         $sql="select SQL_CALC_FOUND_ROWS cc_compras,
				(select gen_empresa.emp_razon_social from gen_empresa where gen_empresa.emp_id=fin_compras.emp_id) as empresa,
				DATE_FORMAT(ct_fecha,'%d/%m/%Y') as ct_fecha,
				(select fin_comprobante.ct_documento from fin_comprobante where fin_comprobante.ct_serie=fin_compras.ct_comprobante and fin_comprobante.ct_tipo='C') as comprobante,
				ct_serie, 
				ct_numero, 
				ct_obs, 
				ct_vigencia,
				DATE_FORMAT(ct_fecha_doc,'%d/%m/%Y') as ct_fecha_doc,
				(select seg_usuario.cc_user from seg_usuario where seg_usuario.cc_usuario=fin_compras.cc_usuario) as cc_usuario,
				ct_total
				from fin_compras
				where lower(ct_obs) like lower('%".u_ascui($obj->getCt_obs())."%')";
				
				if(strlen($obj->getEmp_id())>0){
					 $sql.=" and emp_id='".$obj->getEmp_id()."' "; 
				 }
				 if(strlen($obj->getCt_comprobante())>0){
					 $sql.=" and ct_comprobante='".$obj->getCt_comprobante()."' "; 
				 }
         $sql.=" order by ct_fecha_doc asc";
         $sql.=" LIMIT ". $por_pagina. " offset " . (($pagina - 1) * $por_pagina) ;
		 
         $data = $this->dao->consulta($sql);
         $total = $this->dao->total_pagina();
         $this->records($total);
         $this->calcular_pagina($pagina);
         //echo $sql;
         return $data;
       }
     public function  resumenCompras(fin_compras $obj){
		 $sql="select distinct c.cc_concepto,
				ct.ct_nombre,
				sum(c.ct_monto) as monto
				from fin_compras c inner join fin_concepto ct
				on c.cc_concepto=ct.cc_concepto
				where c.ct_glosa like '%%'
				";
				if(strlen($obj->getCt_anho())>0){
             		$sql.=" and YEAR(c.ct_fecha) = '".$obj->getCt_anho()."'"; 
				 }
				 if(strlen($obj->getCt_periodo())>0){
					 $sql.=" and MONTH(c.ct_fecha) = '".$obj->getCt_periodo()."'"; 
				 }
				if((strlen($obj->getCt_fecha_ini())>0) and (strlen($obj->getCt_fecha_fin())>0)){
					 $sql.=" and c.ct_fecha  BETWEEN ".u_fecha($obj->getCt_fecha_ini())." and ".u_fecha($obj->getCt_fecha_fin())."";
				 }
				 
				  $sql.=" group by c.cc_concepto";
				  //echo $sql;
			return $this->dao->consulta($sql);
		 }    

	
	public function __destruct(){
          unset($this->dao);
	}
}
?>