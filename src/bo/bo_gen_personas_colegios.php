<?php 
require_once(u_src()."dao/dao_gen_personas_colegios.php");
class bo_gen_personas_colegios { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_colegios();
    }
    public function control(gen_personas_colegios $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_colegios){
       return $this->dao->eliminar($cc_colegios);
    }
    public function listar($cc_persona){
		$sql="select cc_colegios, 
				cc_persona, 
				colegio, 
				numero, 
				DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado
				from gen_personas_colegios
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
		
	 public function listarId($cc_colegios){
		$sql="select cc_colegios, 
					cc_persona, 
					colegio, 
					numero, 
					DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,
					fecha_crea, 
					user_crea, 
					fecha_mod, 
					user_mod, 
					estado
				from gen_personas_colegios
				where cc_colegios='".$cc_colegios."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>