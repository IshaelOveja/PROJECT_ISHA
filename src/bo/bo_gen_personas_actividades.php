<?php 
require_once(u_src()."dao/dao_gen_personas_actividades.php");

class bo_gen_personas_actividades
{ 
	private $dao;

    function __construct()
    {
       $this->dao = new dao_gen_personas_actividades();
    }

    public function control(gen_personas_actividades $obj,$opc)
    {
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }

    public function eliminar($cc_modulo)
    {
       return $this->dao->eliminar($cc_modulo);
    }

	public function listarPersona($cc_persona)
	{
         $sql="SELECT 
			cc_actividades, 
			cc_personas, 
			id_actividad, 
			preferencia, 
			fecha_crea,
			 user_crea, 
			fecha_mod, 
			user_mod, 
			estado, 
			ip
           FROM gen_personas_actividades
           WHERE cc_personas='".$cc_persona."'";
           return $this->dao->consulta($sql);
    }

    public function listarId($cc_actividades)
    {
         $sql="SELECT 
			cc_actividades, 
			cc_personas, 
			id_actividad, 
			preferencia, 
			fecha_crea,
			 user_crea, 
			fecha_mod, 
			user_mod, 
			estado, 
			ip
           FROM gen_personas_actividades
          WHERE cc_actividades='".$cc_actividades."'";
         return $this->dao->consulta($sql);
    }
	
	public function __destruct()
	{
          unset($this->dao);
	}
	
}
?>