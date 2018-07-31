<?php 
require_once(u_src()."dao/dao_gen_personas_estudios.php");
class bo_gen_personas_estudios { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_estudios();
    }
    public function control(gen_personas_estudios $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_estudios){
       return $this->dao->eliminar($cc_estudios);
    }
    public function listar($cc_persona){
		$sql="select cc_estudios,
				(select gen_universidades.descripcion from gen_universidades where gen_universidades.cc_universidad=gen_personas_estudios.cc_universidad) as universidad, 
				cc_persona, 
				facultad, 
				fc_parametro_valor('gen_personas_estudios','grado',grado) as grado, 
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado
				from gen_personas_estudios 
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	 public function listarId($cc_estudios){
		$sql="select cc_estudios,
				cc_universidad, 
				cc_persona, 
				facultad, 
				grado, 
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado
				from gen_personas_estudios
				where cc_estudios='".$cc_estudios."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>