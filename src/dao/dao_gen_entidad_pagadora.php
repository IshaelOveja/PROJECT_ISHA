<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_entidad_pagadora.php");
class dao_gen_entidad_pagadora { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
     public function total_pagina(){
		return $this->conecta->total_pagina();
   }
	public function insertar(gen_entidad_pagadora $obj){
         $sql="";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_entidad_pagadora $obj){
         $sql="";
          return $this->conecta->sql_query($sql);
	}
    
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>