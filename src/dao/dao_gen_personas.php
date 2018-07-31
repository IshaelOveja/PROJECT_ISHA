<?php
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_personas.php");

class dao_gen_personas
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

    public function total_pagina()
    {
        return $this->conecta->total_pagina();
    }

    public function insertar(gen_personas $obj)
    {
        $sql = "INSERT INTO gen_personas(
				fecha_de_registro, 
				cod_tipo, 
				c_colegiado, 
				fecha_de_colegiacion, 
				flag_activo, 
				cod_sexo, 
				apellido_Materno, 
				apellido_Paterno, 
				Nombre1, 
				Nombre2, 
				nombre, 
				fecha_nacimiento, 
				pais_nacimiento, 
				ubigeonac, 
				cod_documento, 
				num_documento, 
				e_civil, ruc, 
				afp_onp, 
				celular1, 
				celular2, 
				email1, 
				email2, 
				c_local, 
				tipo_direc, 
				direccion, 
				ubigeodirec, 
				factor_sanguineo, 
				fecha_de_cese, 
				fecha_fallecido, 
				c_entidad_pagadora, 
				c_sector_entidad_pagadora, 
				n_folio_cole, 
				n_libro_cole, 
				n_resolucion_cole, 
				flag, 
				fecha_crea, 
				fecha_mod, 
				flag
              )VALUES(
				 NOW(),
				'".$obj->getVod_tipo()."', 
				'".$obj->getC_colegiado()."', 
				".u_fecha($obj->getFecha_de_colegiacion()).", 
				'".$obj->getFlag_activo()."', 
				'".$obj->getCod_sexo()."', 
				'".utf8_decode($obj->getApellido_Materno())."', 
				'".utf8_decode($obj->getApellido_Paterno())."', 
				'".utf8_decode($obj->getNombre1())."', 
				'".utf8_decode($obj->getNombre2())."', 
				'".utf8_decode($obj->getNombre())."', 
				'".$obj->getFecha_nacimiento()."', 
				'".$obj->getPais_nacimiento()."', 
				'".$obj->getUbigeonac()."', 
				'".$obj->getCod_documento()."', 
				'".$obj->getNum_documento()."', 
				'".$obj->getE_civil()."', 
				'".$obj->getRuc()."', 
				'".$obj->getAfp_onp()."', 
				'".$obj->getCelular1()."', 
				'".$obj->getCelular2()."', 
				'".$obj->getEmail1()."', 
				'".$obj->getEmail2()."', 
				1, 
				'".$obj->getTipo_direc()."', 
				'".utf8_decode($obj->getDireccion())."', 
				'".$obj->getUbigeodirec()."', 
				'".$obj->getFactor_sanguineo()."', 
				".u_fecha($obj->getFecha_de_cese()).", 
				".u_fecha($obj->getFecha_fallecido()).", 
				'".$obj->getC_entidad_pagadora()."', 
				'".$obj->getC_sector_entidad_pagadora()."', 
				'".$obj->getN_folio_cole()."', 
				'".$obj->getN_libro_cole()."', 
				'".$obj->getN_resolucion_cole()."', 
				'".$obj->getFlag()."', 
				NOW(), 
				'".$obj->getUser_crea()."')";
        //echo $sql;
        return $this->conecta->sql_query($sql);
    }

    public function modificar(gen_personas $obj)
    {
        $sql = "update gen_personas set
				cod_tipo='".$obj->getCod_tipo()."', 
				c_colegiado='".$obj->getC_colegiado()."', 
				fecha_de_colegiacion=".u_fecha($obj->getFecha_de_colegiacion()).", 
				flag_activo='".$obj->getFlag_activo()."', 
				cod_sexo='".$obj->getCod_sexo()."', 
				apellido_Materno='".utf8_decode($obj->getApellido_Materno())."', 
				apellido_Paterno='".utf8_decode($obj->getApellido_Paterno())."', 
				Nombre1='".utf8_decode($obj->getNombre1())."', 
				Nombre2='".utf8_decode($obj->getNombre2())."', 
				nombre='".utf8_decode($obj->getNombre())."', 
				fecha_nacimiento=".u_fecha($obj->getFecha_nacimiento()).", 
				pais_nacimiento='".$obj->getPais_nacimiento()."', 
				ubigeonac='".$obj->getUbigeonac()."', 
				cod_documento='".$obj->getCod_documento()."', 
				num_documento='".$obj->getNum_documento()."', 
				e_civil='".$obj->getE_civil()."',
				ruc='".$obj->getRuc()."', 
				afp_onp='".$obj->getAfp_onp()."', 
				celular1='".$obj->getCelular1()."', 
				celular2='".$obj->getCelular2()."', 
				email1='".$obj->getEmail1()."', 
				email2='".$obj->getEmail2()."', 
				c_local='1', 
				tipo_direc='".$obj->getTipo_direc()."', 
				direccion='".utf8_decode($obj->getDireccion())."', 
				ubigeodirec='".$obj->getUbigeodirec()."', 
				factor_sanguineo='".$obj->getFactor_sanguineo()."', 
				fecha_de_cese=".u_fecha($obj->getFecha_de_cese()).", 
				fecha_fallecido=".u_fecha($obj->getFecha_fallecido()).", 
				c_entidad_pagadora='".$obj->getC_entidad_pagadora()."', 
				c_sector_entidad_pagadora='".$obj->getC_sector_entidad_pagadora()."', 
				n_folio_cole='".$obj->getN_folio_cole()."', 
				n_libro_cole='".$obj->getN_libro_cole()."', 
				n_resolucion_cole='".$obj->getN_resolucion_cole()."', 
				flag='".$obj->getFlag()."', 
				fecha_mod= NOW(),
				user_mod='".$obj->getUser_mod()."'
				where cc_persona='".$obj->getCc_persona()."'";
        //echo $sql;
        return $this->conecta->sql_query($sql);
    }
    
    public function insertCollege(gen_personas $obj)
    {
        $sql = "call reg_new_college('{$obj->getApellido_Paterno()}', "
        . "'{$obj->getApellido_Materno()}', '{$obj->getNombre1()}', "
        . "'{$obj->getNombre2()}', '{$obj->getPais_nacimiento()}', "
        . "'{$obj->getCod_documento()}', '{$obj->getNum_documento()}', "
        . "'{$obj->getCelular1()}', '{$obj->getEmail1()}');";
        //return $sql;
        return $this->conecta->sql_execute($sql);
    }

    public function __destruct()
    {
        $this->conecta->cerrarCN();
        unset($this->conecta);
    }
}
?>