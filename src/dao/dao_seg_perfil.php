<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/seg_perfil.php");
class dao_seg_perfil { 
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
	public function insertar(seg_perfil $obj){
         $sql="INSERT INTO seg_perfil(
                cc_perfil,
                ct_perfil,
                cc_modulo_defecto,
                cfl_vigencia
              )VALUES(
                  fc_correlativo('seg_perfil','',''),
                 '".$obj->getCt_perfil()."',
                 '".$obj->getCc_modulo_defecto()."',
                 '".$obj->getCfl_vigencia()."'
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(seg_perfil $obj){
         $sql="UPDATE seg_perfil set 
               ct_perfil='".$obj->getCt_perfil()."',
               cc_modulo_defecto='".$obj->getCc_modulo_defecto()."',
               cfl_vigencia='".$obj->getCfl_vigencia()."'
	     WHERE cc_perfil='".$obj->getCc_perfil()."'";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_perfil){
         $sql="DELETE FROM  seg_perfil
	     WHERE cc_perfil='".$cc_perfil."'";
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>