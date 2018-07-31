<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_organizaciones.php");
class dao_gen_personas_organizaciones { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }

    
	public function insertar(gen_personas_organizaciones $obj){
         $sql="INSERT INTO gen_personas_organizaciones(
				cc_persona, 
				raz_social, 
				tip_ins, 
				cargo, 
				fecha_crea, 
				user_crea, 
				estado
              )VALUES(
				'".$obj->getCc_persona()."', 
				'".utf8_decode($obj->getRaz_social())."',
				'".utf8_decode($obj->getTip_ins())."',
				'".$obj->getCargo()."', 
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_organizaciones $obj){
         $sql="update gen_personas_organizaciones set 
				cc_persona='".$obj->getCc_persona()."',
				raz_social='".utf8_decode($obj->getRaz_social())."',
				tip_ins='".$obj->getTip_ins()."', 
				cargo='".utf8_decode($obj->getCargo())."',
				estado='".$obj->getEstado()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_organizaciones='".$obj->getCc_organizaciones()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_organizaciones){
			 $sql="DELETE FROM  gen_personas_organizaciones
			 WHERE cc_organizaciones='".$cc_organizaciones."'";
			 //echo $sql;
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>