<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_estudios.php");
class dao_gen_personas_estudios { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }

    
	public function insertar(gen_personas_estudios $obj){
         $sql="INSERT INTO gen_personas_estudios(
				cc_universidad, 
				cc_persona, 
				facultad, 
				grado, 
				fecha, 
				fecha_crea, 
				user_crea, 
				estado
              )VALUES(
			    '".$obj->getCc_universidad()."',
				'".$obj->getCc_persona()."', 
				'".utf8_decode($obj->getFacultad())."',
				'".$obj->getGrado()."',
				".u_fecha($obj->getFecha()).", 
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_estudios $obj){
         $sql="update gen_personas_estudios set 
				cc_persona='".$obj->getCc_persona()."',
				cc_universidad='".$obj->getCc_universidad()."',
				facultad='".utf8_decode($obj->getFacultad())."', 
				fecha=".u_fecha($obj->getFecha()).", 
				grado='".$obj->getGrado()."',
				estado='".$obj->getEstado()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_estudios='".$obj->getCc_estudios()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_estudios){
			 $sql="DELETE FROM  gen_personas_estudios
			 WHERE cc_estudios='".$cc_estudios."'";
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>