<?php 
require_once(u_src()."dao/dao_seg_modulo_pagina.php");
class bo_seg_modulo_pagina { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_seg_modulo_pagina();
    }
    public function control(seg_modulo_pagina $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_modulo){
       return $this->dao->eliminar($cc_modulo);
    }
     public function listarId($cc_modulo){
         $sql="SELECT 
		cc_modulo,
		cc_pagina,
           FROM seg_modulo_pagina
          WHERE cc_modulo='".$cc_modulo."'";
         return $this->dao->consulta($sql);
       }
     public function listar(seg_modulo_pagina $obj){
         $sql="SELECT 
		cc_modulo,
		cc_pagina,
           FROM seg_modulo_pagina
          WHERE cc_modulo='".$obj->getCc_modulo()."'";
         return $this->dao->consulta($sql);
       }
       public function asignado_pagina($id,$sec,$cc_usuario,$padre){
		$sql="SELECT 
				  a.cc_pagina, 
				  c.ct_carpeta,
				  concat(c.ct_carpeta,'js/',a.ct_js) as js,
				  c.cc_padre,
				  concat(c.ct_carpeta,a.ct_url) as url,
				  a.ct_url, 
				  a.ct_pagina, 
				  a.cfl_vigencia,
                                  a.ct_clase_cuerpo
				FROM seg_pagina a,seg_modulo_pagina b,seg_modulo c 
				WHERE a.cc_pagina=b.cc_pagina 
				AND b.cc_modulo=c.cc_modulo 
				AND b.cc_modulo IN( 
					select x.cc_modulo from seg_modulo_usuario x where x.cc_usuario='".$cc_usuario."'
                                        union
                                        select x.cc_modulo from seg_modulo_perfil x where x.cc_perfil in(
                                            select cc_perfil from seg_usuario where cc_usuario='".$cc_usuario."'
                                        )
                                        union
                                        select x.cc_modulo from seg_modulo x where x.cfl_acceso='1'  
				)
				AND b.cc_modulo='".$id."'  
				AND c.cc_padre IN (
					SELECT x.cc_modulo FROM seg_modulo x where x.cc_padre='".$padre."'
				)
				AND b.cc_pagina='".$sec."' ";
			return $this->dao->consulta($sql);
	}
	

	public function __destruct(){
          unset($this->dao);
	}
}
?>