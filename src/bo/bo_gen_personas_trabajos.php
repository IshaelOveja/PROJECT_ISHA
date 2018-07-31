<?php 
require_once(u_src()."dao/dao_gen_personas_trabajos.php");
class bo_gen_personas_trabajos { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_trabajos();
    }
    public function control(gen_personas_trabajos $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_trabajos){
       return $this->dao->eliminar($cc_trabajos);
    }
    public function listar($cc_persona){
		$sql="select cc_trabajos,
				(select gen_giros.descripcion from gen_giros where gen_giros.cc_giros=gen_personas_trabajos.cc_giros )  as giros,
				cc_giros, 
				cc_persona, 
				raz_soc, 
				cargo,
				DATE_FORMAT(fch_ini,'%d/%m/%Y') as fch_ini,
				DATE_FORMAT(fch_fin,'%d/%m/%Y') as fch_fin,
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod,  
				estado
				from gen_personas_trabajos
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
		
	 public function listarId($cc_trabajos){
		$sql="select cc_trabajos,
				cc_giros,
				cc_giros, 
				cc_persona, 
				raz_soc, 
				cargo,
				DATE_FORMAT(fch_ini,'%d/%m/%Y') as fch_ini,
				DATE_FORMAT(fch_fin,'%d/%m/%Y') as fch_fin,
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod,  
				estado
				from gen_personas_trabajos
				where cc_trabajos='".$cc_trabajos."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>