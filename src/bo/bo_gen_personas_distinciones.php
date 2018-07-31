<?php 
require_once(u_src()."dao/dao_gen_personas_distinciones.php");
class bo_gen_personas_distinciones { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_distinciones();
    }
    public function control(gen_personas_distinciones $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_distinciones){
       return $this->dao->eliminar($cc_distinciones);
    }
    public function listar($cc_persona){
		$sql="select cc_distinciones, 
				cc_persona, 
				distincion, 
				denominacion,
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha, 
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado
				from gen_personas_distinciones
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
		
	 public function listarId($cc_distinciones){
		$sql="select cc_distinciones, 
				cc_persona, 
				distincion, 
				denominacion,
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha, 
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado
				from gen_personas_distinciones
				where cc_distinciones='".$cc_distinciones."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>