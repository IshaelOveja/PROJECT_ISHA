<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_especialidad.php");
class dao_gen_personas_especialidad { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
    
	public function insertar(gen_personas_especialidad $obj){
         $sql="INSERT INTO gen_personas_especialidad(
				cc_persona, 
				denominacion, 
				anios, 
				sector, 
				fecha_crea, 
				user_crea, 
				estado
              )VALUES(
				'".$obj->getCc_persona()."', 
				'".utf8_decode($obj->getDenominacion())."',
				'".$obj->getAnios()."',
				'".$obj->getSector()."',
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_especialidad $obj){
         $sql="update gen_personas_especialidad set 
				cc_persona='".$obj->getCc_persona()."',
				denominacion='".utf8_decode($obj->getDenominacion())."', 
				anios='".$obj->getAnios()."',
				sector='".$obj->getSector()."',
				estado='".$obj->getEstado()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_especialidad='".$obj->getCc_especialidad()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_especialidad){
			 $sql="DELETE FROM  gen_personas_especialidad
			 WHERE cc_especialidad='".$cc_especialidad."'";
			 //echo $sql;
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>