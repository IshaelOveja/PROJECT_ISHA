<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/seg_pagina.php");
class dao_seg_pagina { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
    public function totalPagina($sql){
       return $this->conecta->sql_total($sql);
    }
	public function insertar(seg_pagina $obj){
         $sql="INSERT INTO seg_pagina(
                cc_pagina,
                ct_pagina,
                ct_url,
                ct_js,
                cfl_vigencia,
              )VALUES(
                  fc_correlativo('seg_pagina','',''),
                 '".$obj->getCt_pagina()."',
                 '".$obj->getCt_url()."',
                 '".$obj->getCt_js()."',
                 '".$obj->getCfl_vigencia()."',
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(seg_pagina $obj){
         $sql="UPDATE seg_pagina set 
               ct_pagina='".$obj->getCt_pagina()."',
               ct_url='".$obj->getCt_url()."',
               ct_js='".$obj->getCt_js()."',
               cfl_vigencia='".$obj->getCfl_vigencia()."',
	     WHERE cc_pagina='".$obj->getCc_pagina()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_pagina){
         $sql="DELETE FROM  seg_pagina
	     WHERE cc_pagina='".$cc_pagina."'";
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>