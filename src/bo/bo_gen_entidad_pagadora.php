<?php 
require_once(u_src()."dao/dao_gen_entidad_pagadora.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_gen_entidad_pagadora  extends SYQ_Paginacion { 
    private $dao; 
    function __construct(){
       $this->dao = new dao_gen_entidad_pagadora();
    }
    public function control(gen_entidad_pagadora $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_entidad){
       return $this->dao->eliminar($cc_entidad);
    }
     public function listarSelect(){
         $sql="SELECT 
			cc_entidad, 
			nombre, 
			estado
           FROM gen_entidad_pagadora
          WHERE estado='1'";
		  //echo $sql;
         return $this->dao->consulta($sql);
       }
	   
     
	   
     
	public function __destruct(){
          unset($this->dao);
	}
}
?>