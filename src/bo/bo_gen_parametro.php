<?php 
require_once(u_src()."dao/dao_gen_parametro.php");
class bo_gen_parametro { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_gen_parametro();
    }
    public function control(gen_parametro $obj,$opc){
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
		ct_parametro,
		ct_descripcion,
		cfl_vigencia,
           FROM gen_parametro
          WHERE cc_parametro='".$cc_parametro."'";
         return $this->dao->consulta($sql);
       }
     public function listar(gen_parametro $obj){
         $sql="SELECT 
		cc_parametro,
		ct_parametro,
		ct_descripcion,
		cfl_vigencia,
           FROM gen_parametro
          WHERE cc_parametro='".$obj->getCc_parametro()."'";
         return $this->dao->consulta($sql);
       }
	public function __destruct(){
          unset($this->dao);
	}
}
?>