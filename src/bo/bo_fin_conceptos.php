<?php 
require_once(u_src()."dao/dao_fin_conceptos.php");
class bo_fin_conceptos { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_fin_conceptos();
    }
    public function control(fin_conceptos $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_conceptos){
       return $this->dao->eliminar($cc_conceptos);
    }
     public function listar(fin_conceptos $obj){
         $sql="select cc_articulo, 
				tipo, 
				nombre, 
				igv, 
				monto, 
				c_cuenta, 
				usur_crea, 
				fecha_crea, 
				usur_mod, 
				fech_mod, 
				estado
				from fin_conceptos
				 WHERE nombre like '%".$obj->getNombre()."%'";
				 if(strlen($obj->getTipo())>0){
					 $sql.=" and tipo='".$obj->getTipo()."' "; 
				 }
				 if(strlen($obj->getEstado())>0){
					 $sql.=" and estado='".$obj->getEstado()."' "; 
				 }
				 $sql.=" order by nombre asc"; 
				//echo $sql;
         return $this->dao->consulta($sql);
       }
     
	
	public function __destruct(){
          unset($this->dao);
	}
}
?>