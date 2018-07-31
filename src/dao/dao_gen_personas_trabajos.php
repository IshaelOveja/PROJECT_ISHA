<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_trabajos.php");
class dao_gen_personas_trabajos { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }

    
	public function insertar(gen_personas_trabajos $obj){
         $sql="INSERT INTO gen_personas_trabajos(
				cc_giros, 
				cc_persona, 
				raz_soc, 
				cargo, 
				fch_ini, 
				fch_fin, 
				fecha_crea, 
				user_crea, 
				estado
              )VALUES(
				'".$obj->getCc_giros()."',
				'".$obj->getCc_persona()."', 
				'".utf8_decode($obj->getRaz_soc())."',
				'".utf8_decode($obj->getCargo())."',
				".u_fecha($obj->getFch_ini()).", 
				".u_fecha($obj->getFch_fin()).",
				NOW(), 
				'".$obj->getUser_crea()."',
				'".$obj->getEstado()."'
				)";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_personas_trabajos $obj){
         $sql="update gen_personas_trabajos set 
				cc_persona='".$obj->getCc_persona()."',
				cc_giros='".$obj->getCc_giros()."',
				raz_soc='".utf8_decode($obj->getRaz_soc())."', 
				cargo='".utf8_decode($obj->getCargo())."',
				fch_ini=".u_fecha($obj->getFch_ini()).", 
				fch_fin=".u_fecha($obj->getFch_fin()).",
				estado='".$obj->getEstado()."',
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_trabajos='".$obj->getCc_trabajos()."'";
		//echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_trabajos){
			 $sql="DELETE FROM  gen_personas_trabajos
			 WHERE cc_trabajos='".$cc_trabajos."'";
			 //echo $sql;
			  return $this->conecta->sql_query($sql);
		}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>