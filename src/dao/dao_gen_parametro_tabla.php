<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_parametro_tabla.php");
class dao_gen_parametro_tabla { 
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
	public function insertar(gen_parametro_tabla $obj){
         $sql="INSERT INTO gen_parametro_tabla(
                cc_parametro,
                cc_tabla,
                cc_campo,
              )VALUES(
                  fc_correlativo('gen_parametro_tabla','',''),
                 '".$obj->getCc_tabla()."',
                 '".$obj->getCc_campo()."',
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_parametro_tabla $obj){
         $sql="UPDATE gen_parametro_tabla set 
               cc_tabla='".$obj->getCc_tabla()."',
               cc_campo='".$obj->getCc_campo()."',
	     WHERE cc_parametro='".$obj->getCc_parametro()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_parametro){
         $sql="DELETE FROM  gen_parametro_tabla
	     WHERE cc_parametro='".$cc_parametro."'";
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>