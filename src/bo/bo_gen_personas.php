<?php
require_once(u_src()."dao/dao_gen_personas.php");
require_once(u_src()."dao/SYQ_Paginacion.php");

class bo_gen_personas extends SYQ_Paginacion
{
    private $dao;

    function __construct()
    {
        $this->dao = new dao_gen_personas();
    }

    public function control(gen_personas $obj, $opc)
    {
        if ($opc == "I") {
            return $this->dao->insertar($obj);
        } else {
            return $this->dao->modificar($obj);
        }
    }

    public function insertCollege(gen_personas $obj)
    {
        return $this->dao->insertCollege($obj);
    }

    public function eliminar($cc_persona)
    {
        return $this->dao->eliminar($cc_persona);
    }

    public function listarAsignarUsuario($ct_nombre)
    {/* Crear usuario */
        $sql = "SELECT cc_persona,
		c_colegiado,
		ruc,
		nombre,
		DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') as fecha_nacimiento,
		num_documento,
		cod_sexo,
		email1,
		celular1,
		flag FROM gen_personas
          WHERE cc_persona not in(select cc_usuario from seg_usuario )
          and (lower(nombre) like lower('%".u_ascui($ct_nombre)."%') 
         )";

        $sql .= " order by nombre ";
        $sql .= " limit 5 offset 0 ";
        //echo $sql;
        return $this->dao->consulta($sql);
    }

    public function buscarPersona(gen_personas $obj)
    {/* Busqueda general */
        $sql = "SELECT cc_persona,
		c_colegiado,
		ruc,
		nombre,
		DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') as fecha_nacimiento,
		num_documento,
		cod_sexo,
		email1,
		celular1,
		flag FROM gen_personas
          WHERE nombre like '%".$obj->getNombre()."%'
		  and flag='1'";


        if (strlen($obj->getNum_documento()) > 0) {
            $sql .= " and num_documento='".$obj->getNum_documento()."' ";
        }
        if (strlen($obj->getC_colegiado()) > 0) {
            $sql .= " and c_colegiado='".$obj->getC_colegiado()."' ";
        }
        if (strlen($obj->getRuc()) > 0) {
            $sql .= " and ruc like '%".$obj->getRuc()."%' ";
        }
        $sql .= " order by nombre ";
        $sql .= " limit 8 offset 0 ";
        //echo $sql;
        return $this->dao->consulta($sql);
    }

    public function listarId($cc_persona)
    {/* OK****** */
        $sql = "select cc_persona,
		 fecha_de_registro, 
		 cod_tipo, 
		 c_colegiado, 
		 DATE_FORMAT(fecha_de_colegiacion, '%d/%m/%Y')  as fecha_de_colegiacion, 
		 flag_activo, 
		 fc_parametro_valor('gen_personas','flag_activo',flag_activo) as activo,
		 fc_parametro_valor('gen_personas','e_civil',e_civil) as e_civil,
		 cod_sexo, 
		 apellido_Materno, 
		 apellido_Paterno,
		 Nombre1, 
		 Nombre2, 
		 nombre, 
		  DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y')  as fecha_nacimiento, 
		 pais_nacimiento, 
		 ubigeonac, 
		 cod_documento, 
		 num_documento, 
		 e_civil, 
		 ruc, 
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
		 DATE_FORMAT(fecha_de_cese, '%d/%m/%Y')  as fecha_de_cese, 
		 DATE_FORMAT(fecha_fallecido, '%d/%m/%Y')  as fecha_fallecido, 
		 c_entidad_pagadora, 
		 c_sector_entidad_pagadora,
		 n_folio_cole, 
		 n_libro_cole, 
		 n_resolucion_cole, 
		 flag
		 from gen_personas
          WHERE cc_persona='".$cc_persona."'";
        // echo $sql;
        return $this->dao->consulta($sql);
    }

    public function estado_habil($cc_persona)
    {/* OK*** */
        $sql = "select deuda
				from vt_persona_habil
          WHERE cc_persona='".$cc_persona."'";
        //echo $sql;
        return $this->dao->consulta($sql);
    }

    public function listar(gen_personas $obj)
    {/* ok */
        $sql = "select cc_persona,
				DATE_FORMAT(fecha_de_registro, '%d/%m/%Y') as  fecha_de_registro, 
				cod_tipo, 
				c_colegiado, 
				DATE_FORMAT(fecha_de_colegiacion, '%d/%m/%Y')  as fecha_de_colegiacion,
				flag_activo,
				fc_parametro_valor('gen_personas','cod_sexo',cod_sexo) as cod_sexo,
				apellido_Materno, 
				apellido_Paterno, 
				Nombre1, 
				Nombre2,
				nombre,
				DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y')  as fecha_nacimiento, 
				pais_nacimiento, 
				ubigeonac, 
				cod_documento, 
				num_documento,
				fc_parametro_valor('gen_personas','e_civil',e_civil) as e_civil, 
				ruc, 
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
				n_resolucion_cole
				from gen_personas
				
        		WHERE nombre like '%".u_ascui($obj->getNombre())."%'";

        if (strlen($obj->getNum_documento()) > 0) {
            $sql .= " and num_documento='".$obj->getNum_documento()."' ";
        }
        if (strlen($obj->getC_colegiado()) > 0) {
            $sql .= " and c_colegiado='".$obj->getC_colegiado()."' ";
        }

        $sql .= " order by nombre";

        return $this->dao->consulta($sql);
    }

    public function validarDNI($num_documento)
    {
        $sql = "SELECT cc_persona,
				FROM gen_personas 
            WHERE  num_documento='".$num_documento."' ";
        return $this->dao->consulta($sql);
    }

    public function validarRUC($ruc)
    {
        $sql = "SELECT cc_persona,
				FROM gen_personas 
           		WHERE  ruc='".$ruc."' ";
        return $this->dao->consulta($sql);
    }

    public function validateAccount(gen_personas $obj)
    {
        $sql = "call validate_college_account('{$obj->getNum_documento()}','{$obj->getEmail1()}');";
        return $this->dao->consulta($sql);
    }

    public function __destruct()
    {
        unset($this->dao);
    }
}
?>