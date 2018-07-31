<?php 
require_once(u_src()."dao/dao_gen_personas_especialidad.php");
class bo_gen_personas_especialidad { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_especialidad();
    }
    public function control(gen_personas_especialidad $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_especialidad){
       return $this->dao->eliminar($cc_especialidad);
    }
    public function listar($cc_persona){
		$sql="select cc_especialidad, 
					cc_persona, 
					denominacion, 
					anios,
					fc_parametro_valor('gen_personas_especialidad','sector',sector) as sector,
					fecha_crea, 
					user_crea, 
					fecha_mod, 
					user_mod, 
					estado
					from gen_personas_especialidad
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
		
	 public function listarId($cc_especialidad){
		$sql="select cc_especialidad, 
					cc_persona, 
					denominacion, 
					anios,
					sector,
					fecha_crea, 
					user_crea, 
					fecha_mod, 
					user_mod, 
					estado
					from gen_personas_especialidad
				where cc_especialidad='".$cc_especialidad."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>