<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_parametro.php");
class dao_gen_parametro { 
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
	public function insertar(gen_parametro $obj){
         $sql="INSERT INTO gen_parametro(
                cc_parametro,
                ct_parametro,
                ct_descripcion,
                cfl_vigencia,
              )VALUES(
                  fc_correlativo('gen_parametro','',''),
                 '".$obj->getCt_parametro()."',
                 '".$obj->getCt_descripcion()."',
                 '".$obj->getCfl_vigencia()."',
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_parametro $obj){
         $sql="UPDATE gen_parametro set 
               ct_parametro='".$obj->getCt_parametro()."',
               ct_descripcion='".$obj->getCt_descripcion()."',
               cfl_vigencia='".$obj->getCfl_vigencia()."',
	     WHERE cc_parametro='".$obj->getCc_parametro()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_parametro){
         $sql="DELETE FROM  gen_parametro
	     WHERE cc_parametro='".$cc_parametro."'";
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>