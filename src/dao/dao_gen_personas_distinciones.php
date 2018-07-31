<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_distinciones.php");
class dao_gen_personas_distinciones { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }

    
	public function insertar(gen_personas_distinciones $obj){
         $sql="INSERT INTO gen_personas_distinciones(
				cc_persona, 
				distincion, 
				denominacion, 
				fecha, 
				fecha_crea, 
				user_crea, 
				estado
              )VALUES(
				'".$obj->getCc_persona()."',
				'".utf8_decode($obj->getDistincion())."',
				'".utf8_decode($obj->getDenominacion())."',
				".u_fecha($obj->getFecha()).", 
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_distinciones $obj){
         $sql="update gen_personas_distinciones set 
				cc_persona='".$obj->getCc_persona()."',
				distincion='".utf8_decode($obj->getDistincion())."',
				denominacion='".utf8_decode($obj->getDenominacion())."', 
				fecha=".u_fecha($obj->getFecha()).",
				estado='".$obj->getEstado()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_distinciones='".$obj->getcc_distinciones()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_distinciones){
			 $sql="DELETE FROM  gen_personas_distinciones
			 WHERE cc_distinciones='".$cc_distinciones."'";
			 //echo $sql;
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>