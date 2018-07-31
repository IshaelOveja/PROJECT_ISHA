<?php 
require_once(u_src()."dao/dao_gen_actividades.php");
class bo_gen_actividades { 
    private $dao; 
    function __construct(){
       $this->dao = new dao_gen_actividades();
    }
    public function control(gen_actividades $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_usuario){
       return $this->dao->eliminar($cc_usuario);
    }
     public function listarPersona($cc_persona){
         $sql="select b.cc_actividad, 
				b.nombre,
				(select count(a.cc_actividad) from gen_personas_actividades a where b.cc_actividad=a.cc_actividad and a.cc_persona='".$cc_persona."' ) as n
				from gen_actividades b ORDER by b.nombre asc";
		  //echo $sql;
         return $this->dao->consulta($sql);
       }

	public function __destruct(){
          unset($this->dao);
	}
}
?>