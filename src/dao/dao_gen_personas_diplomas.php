<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_diplomas.php");
class dao_gen_personas_diplomas { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
    
	public function insertar(gen_personas_diplomas $obj){
         $sql="INSERT INTO gen_personas_diplomas(
				cc_persona, 
				cc_universidad, 
				denominacion, 
				especialidad,
				nivel,
				fecha, 
				nro_reg, 
				fecha_crea, 
				user_crea, 
				estado
              )VALUES(
				'".$obj->getCc_persona()."', 
				'".$obj->getCc_universidad()."',
				'".utf8_decode($obj->getDenominacion())."',
				'".utf8_decode($obj->getEspecialidad())."',
				'".$obj->getNivel()."',
				".u_fecha($obj->getFecha()).", 
				'".utf8_decode($obj->getNro_reg())."',
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_diplomas $obj){
         $sql="update gen_personas_diplomas set 
				cc_persona='".$obj->getCc_persona()."',
				cc_universidad='".$obj->getCc_universidad()."',
				denominacion='".utf8_decode($obj->getDenominacion())."', 
				especialidad='".utf8_decode($obj->getEspecialidad())."',
				nivel='".$obj->getNivel()."',
				fecha=".u_fecha($obj->getFecha()).", 
				nro_reg='".utf8_decode($obj->getNro_reg())."',
				estado='".$obj->getEstado()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_diplomas='".$obj->getCc_diplomas()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_diplomas){
			 $sql="DELETE FROM  gen_personas_diplomas
			 WHERE cc_diplomas='".$cc_diplomas."'";
			 //echo $sql;
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>