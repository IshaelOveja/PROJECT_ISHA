<?php
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_actividades.php");

class dao_gen_personas_actividades
{
    private $conecta;

    function __construct()
    {
        $this->conecta = new Conecta();
    }

    public function consulta($sql)
    {
        return $this->conecta->ArrayLista($sql);
    }

    public function totalPagina($sql)
    {
        return $this->conecta->sql_total($sql);
    }

    public function insertar(gen_personas_actividades $obj)
    {
        $sql = "INSERT INTO gen_personas_actividades(
            cc_persona,
            cc_actividad,
            fecha_crea,
            user_crea
            )VALUES(
            '".$obj->getCc_persona()."',
            '".$obj->getCc_actividad()."',
            NOW(),
            '".$obj->getUser_crea()."')";
        return $this->conecta->sql_query($sql);
    }

    public function modificar(gen_personas_actividades $obj)
    {
        $sql = "";
        return $this->conecta->sql_query($sql);
    }

    public function eliminar($cc_persona)
    {
        $sql = "DELETE FROM  gen_personas_actividades
	     WHERE cc_persona='".$cc_persona."'";
		 //echo $sql;
        return $this->conecta->sql_query($sql);
    }


    public function __destruct()
    {
        $this->conecta->cerrarCN();
        unset($this->conecta);
    }
}
?>