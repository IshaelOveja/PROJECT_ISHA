<?php 
require_once(u_src()."dao/dao_gen_personas_familiares.php");
class bo_gen_personas_familiares { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_familiares();
    }
    public function control(gen_personas_familiares $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_familiares){
       return $this->dao->eliminar($cc_familiares);
    }
    public function listar($cc_persona){
		$sql="select cc_familiares, 
				cc_persona, 
				nombres,
				DATE_FORMAT(fec_nac,'%d/%m/%Y') as fecha_nacimiento,
				fc_parametro_valor('gen_personas_familiares','parentesco',parentesco) as parentesco,
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado 
				from gen_personas_familiares
				where cc_persona='".$cc_persona."'
				";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	 public function listarId($cc_familiares){
		$sql="select cc_familiares, 
				cc_persona, 
				nombres, 
				DATE_FORMAT(fec_nac,'%d/%m/%Y') as fecha_nacimiento,
				parentesco, 
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado 
				from gen_personas_familiares
				where cc_familiares='".$cc_familiares."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>