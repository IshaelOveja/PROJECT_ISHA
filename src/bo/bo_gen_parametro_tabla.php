<?php 
require_once(u_src()."dao/dao_gen_parametro_tabla.php");
class bo_gen_parametro_tabla { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_parametro_tabla();
    }
    public function control(gen_parametro_tabla $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_parametro){
       return $this->dao->eliminar($cc_parametro);
    }
     public function listarId($cc_parametro){
         $sql="SELECT 
		cc_parametro,
		cc_tabla,
		cc_campo,
           FROM gen_parametro_tabla
          WHERE cc_parametro='".$cc_parametro."'";
         return $this->dao->consulta($sql);
       }
     public function listar(gen_parametro_tabla $obj){
         $sql="SELECT 
		cc_parametro,
		cc_tabla,
		cc_campo,
           FROM gen_parametro_tabla
          WHERE cc_parametro='".$obj->getCc_parametro()."'";
         return $this->dao->consulta($sql);
       }
	public function __destruct(){
          unset($this->dao);
	}
}
?>