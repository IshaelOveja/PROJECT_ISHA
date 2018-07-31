<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_estado_cuenta.php");
class dao_fin_estado_cuenta { 
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
    
	public function insertar(fin_estado_cuenta $obj){
         $sql="INSERT INTO fin_estado_cuenta(
				cc_persona,
				cc_caja,
				ct_fecha, 
				ct_tipo, 
				cc_descripcion,
				ct_monto,
				sys_user,
				ct_vigencia
              )VALUES(
                  '".$obj->getCc_persona()."',
				  '".$obj->getCc_caja()."',
				  ".u_fecha($obj->getCt_fecha()).",
				  '".$obj->getCt_tipo()."',
				  '".utf8_decode($obj->getCc_descripcion())."',
				  '".$obj->getCt_monto()."',
				  '".$obj->getSys_user()."',
				  '1'
              )";
		 	//echo $sql;
          return $this->conecta->sql_query($sql);
	}

public function modificar(fin_estado_cuenta $obj){
         $sql="UPDATE fin_estado_cuenta set 
			   ct_tipo='".$obj->getCt_tipo()."',
			   cc_descripcion='".utf8_decode($obj->getCc_descripcion())."',
		 	   ct_monto='".$obj->getCt_monto()."',
               sys_user='".$obj->getSys_user()."'
              
	     WHERE cc_estadocuenta='".$obj->getCc_estadocuenta()."'";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
public function anular($cc_caja, $usuario){
	$sql="update fin_estado_cuenta set 
		cc_descripcion='ANULADO', 
		ct_monto='0.00',
		sys_user='".$usuario."',
		ct_vigencia='0'
		where ct_tipo='D' 
		and cc_caja='".$cc_caja."'";
		//echo $sql;
	 return $this->conecta->sql_query($sql);
	}

	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>