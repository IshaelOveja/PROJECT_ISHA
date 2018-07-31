<?php 
require_once(u_src()."dao/dao_gen_personas_diplomas.php");
class bo_gen_personas_diplomas { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_diplomas();
    }
    public function control(gen_personas_diplomas $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_diplomas){
       return $this->dao->eliminar($cc_diplomas);
    }
    public function listar($cc_persona){
		$sql="select cc_diplomas, 
				cc_persona,
				(select gen_universidades.descripcion from gen_universidades where gen_universidades.cc_universidad=gen_personas_diplomas.cc_universidad) as universidad,
				cc_universidad, 
				denominacion, 
				especialidad,
				fc_parametro_valor('gen_personas_diplomas','nivel',nivel) as nivel,
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,
				nro_reg, 
				fecha_crea, 
				user_crea, 
				fecha_mod,
				user_mod, 
				estado
				from gen_personas_diplomas
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
		
	 public function listarId($cc_diplomas){
		$sql="select cc_diplomas, 
				cc_persona,
				cc_universidad,
				cc_universidad, 
				denominacion, 
				especialidad,
				nivel,
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,
				nro_reg, 
				fecha_crea, 
				user_crea, 
				fecha_mod,
				user_mod, 
				estado
				from gen_personas_diplomas
				where cc_diplomas='".$cc_diplomas."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>