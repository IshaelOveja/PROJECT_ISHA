<?php 
require_once(u_src()."dao/dao_seg_pagina.php");
class bo_seg_pagina { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_seg_pagina();
    }
    public function control(seg_pagina $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_pagina){
       return $this->dao->eliminar($cc_pagina);
    }
     public function listarId($cc_pagina){
         $sql="SELECT 
		cc_pagina,
		ct_pagina,
		ct_url,
		ct_js,
		cfl_vigencia,
           FROM seg_pagina
          WHERE cc_pagina='".$cc_pagina."'";
         return $this->dao->consulta($sql);
       }
     public function listar(seg_pagina $obj){
         $sql="SELECT 
		cc_pagina,
		ct_pagina,
		ct_url,
		ct_js,
		cfl_vigencia,
           FROM seg_pagina
          WHERE cc_pagina='".$obj->getCc_pagina()."'";
         return $this->dao->consulta($sql);
       }
	public function __destruct(){
          unset($this->dao);
	}
}
?>