<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_compras.php");
class dao_fin_compras { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
	
	public function total_pagina(){
		return $this->conecta->total_pagina();
   }
    
	public function insertar(fin_compras $obj){
         $sql="INSERT INTO fin_compras(
					cc_compras,
					ct_ano, 
					ct_fecha, 
					emp_id, 
					ct_comprobante, 
					ct_serie, 
					ct_numero, 
					cc_usuario, 
					ct_fecha_doc, 
					ct_vigencia, 
					ct_obs,
					ct_total
              )VALUES(
			  	'".$obj->getCc_compras()."',
				 '".$obj->getCt_ano()."',
				  now(),
				  '".$obj->getEmp_id()."',
				  '".$obj->getCt_comprobante()."',
                  '".$obj->getCt_serie()."',
				  '".$obj->getCt_numero()."',
				   '".$obj->getCc_usuario()."',
				  ".u_fecha($obj->getCt_fecha_doc()).",
				 	'1',
				   '".utf8_decode($obj->getCt_obs())."',
				   '".$obj->getCt_total()."'
				 
              )";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(fin_compras $obj){
         $sql="UPDATE fin_compras set 
		 	     emp_id='".$obj->getEmp_id()."',
				 ct_comprobante='".$obj->getCt_comprobante()."',
                 ct_serie='".$obj->getCt_serie()."',
				 ct_numero='".$obj->getCt_numero()."',
				 cc_usuario='".$obj->getCc_usuario()."',
				 ct_fecha_doc=".u_fecha($obj->getCt_fecha_doc()).",
				  ct_obs=".utf8_decode($obj->getCt_obs())."
	     	WHERE cc_compras='".$obj->getCc_compras()."'";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_compras){
         $sql="DELETE FROM a1, a2 USING fin_compras AS a1 INNER JOIN fin_compras_detalle AS a2
WHERE a1.cc_compras=a2.cc_compras 
AND a1.cc_compras='".$cc_compras."'";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>