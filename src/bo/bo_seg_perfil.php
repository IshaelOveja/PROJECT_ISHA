<?php 
require_once(u_src()."dao/dao_seg_perfil.php");
class bo_seg_perfil { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_seg_perfil();
    }
    public function control(seg_perfil $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_perfil){
       return $this->dao->eliminar($cc_perfil);
    }
     public function listarId($cc_perfil){
         $sql="SELECT 
		cc_perfil,
		ct_perfil,
		cc_modulo_defecto,
		cfl_vigencia
           FROM seg_perfil
          WHERE cc_perfil='".$cc_perfil."'";
         return $this->dao->consulta($sql);
       }
     public function listar(seg_perfil $obj){
         $sql="SELECT 
		cc_perfil,
		ct_perfil,
		cc_modulo_defecto,
        fc_modulo_opcion(cc_modulo_defecto) as ct_modulo, 
		cfl_vigencia
           FROM seg_perfil
          order by ct_perfil";
		  //echo $sql;
         return $this->dao->consulta($sql);
       }
       public function listarContar(){/*ok*/
         $sql="SELECT 
		a.cc_perfil,
		a.ct_perfil,
		a.cc_modulo_defecto,
		a.cfl_vigencia,
                (select count(cc_modulo) from seg_modulo_perfil where seg_modulo_perfil.cc_perfil=a.cc_perfil
                ) as cantidad
           FROM seg_perfil a
          order by a.ct_perfil ";
         return $this->dao->consulta($sql);
       }
	public function __destruct(){
          unset($this->dao);
	}
}
?>