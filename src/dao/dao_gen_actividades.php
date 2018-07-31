<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_actividades.php");
class dao_gen_actividades { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }

	public function insertar(gen_actividades $obj){
         $sql="";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_actividades $obj){
         $sql="";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_actividades){
         $sql="";
          return $this->conecta->sql_query($sql);
	}
	
	
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>