<?php 
require_once(u_src()."dao/dao_gen_personas_organizaciones.php");
class bo_gen_personas_organizaciones { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_personas_organizaciones();
    }
    public function control(gen_personas_organizaciones $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_organizaciones){
       return $this->dao->eliminar($cc_organizaciones);
    }
    public function listar($cc_persona){
		$sql="select cc_organizaciones, 
				cc_persona, 
				raz_social,
				fc_parametro_valor('gen_personas_organizaciones','tip_ins',tip_ins) as tip_ins, 
				cargo, 
				fecha_crea, 
				user_crea, 
				fecha_mod, 
				user_mod, 
				estado
				from gen_personas_organizaciones
				where cc_persona='".$cc_persona."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
		
	 public function listarId($cc_organizaciones){
		$sql="select cc_organizaciones, 
					cc_persona, 
					raz_social,
					tip_ins, 
					cargo, 
					fecha_crea, 
					user_crea, 
					fecha_mod, 
					user_mod, 
					estado
					from gen_personas_organizaciones
				where cc_organizaciones='".$cc_organizaciones."'";
				//echo $sql;
		return $this->dao->consulta($sql);
		}
	public function __destruct(){
          unset($this->dao);
	}
}
?>