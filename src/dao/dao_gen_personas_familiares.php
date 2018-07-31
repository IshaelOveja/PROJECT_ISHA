<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_familiares.php");
class dao_gen_personas_familiares { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }

    
	public function insertar(gen_personas_familiares $obj){
         $sql="INSERT INTO gen_personas_familiares(
				cc_persona, 
				nombres, 
				fec_nac, 
				parentesco, 
				fecha_crea, 
				user_crea,
				estado
              )VALUES(
				'".$obj->getCc_persona()."', 
				'".utf8_decode($obj->getNombres())."', 
				".u_fecha($obj->getFec_nac()).", 
				'".$obj->getParentesco()."',
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_familiares $obj){
         $sql="update gen_personas_familiares set 
				cc_persona='".$obj->getCc_persona()."',
				nombres='".utf8_decode($obj->getNombres())."', 
				fec_nac=".u_fecha($obj->getFec_nac()).", 
				parentesco='".$obj->getParentesco()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_familiares='".$obj->getCc_familiares()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_familiares){
			 $sql="DELETE FROM  gen_personas_familiares
			 WHERE cc_familiares='".$cc_familiares."'";
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>