<?php
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas_colegios.php");
class dao_gen_personas_colegios{ 

    private $conecta;
    function __construct()
    {
        $this->conecta = new Conecta();
    }

    public function consulta($sql)
    {
        return $this->conecta->ArrayLista($sql);
    }

    public function insertar(gen_personas_colegios $obj)
    {
        $sql="INSERT INTO gen_personas_colegios(
		cc_persona, 
		colegio, 
		numero, 
		fecha, 
		fecha_crea, 
		user_crea, 
		estado
		)VALUES(
        '".$obj->getCc_persona()."',
        '".utf8_decode($obj->getColegio())."',
        '".$obj->getNumero()."',
		".u_fecha($obj->getFecha()).",
        NOW(),
        '".$obj->getUser_crea()."',
        '".$obj->getEstado()."')";
        return $this->conecta->sql_query($sql);
	}

    public function modificar(gen_personas_colegios $obj)
    {
        $sql="UPDATE gen_personas_colegios set
            colegio='".$obj->getColegio()."',
            cc_persona='".$obj->getCc_persona() . "',
            numero='". $obj->getNumero()."',
            fecha=".u_fecha($obj->getFecha()).",
			fecha_mod= NOW(),
			user_mod='".$obj->getUser_mod()."',
			estado='".$obj->getEstado()."'
	    WHERE cc_colegios='".$obj->getCc_colegios()."'";
        //echo $sql;
		return $this->conecta->sql_query($sql);
		
	}

    public function eliminar($cc_colegios){
        $sql="DELETE FROM  gen_personas_colegios
        WHERE cc_colegios='".$cc_colegios."'";
        return $this->conecta->sql_query($sql);
	}
	
	public function __destruct()
    {
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
  
}
?>