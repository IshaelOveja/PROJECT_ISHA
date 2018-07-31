<?php 
require_once(u_src()."dao/dao_fin_documento.php");
class bo_fin_documento { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_fin_documento();
    }
    public function control(fin_documento $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_diplomas){
       return $this->dao->eliminar($cc_diplomas);
    }
	
     public function ListarCajasUser($cc_persona){
         $sql="SELECT d.cc_documento,
		 		d.nombre, 
		 		d.nombre_corto,
				d.serie,
				d.numero
				FROM fin_documento d inner join fin_documentouser du
				on d.cc_documento=du.cc_documento
				where du.cc_persona='".$cc_persona."'
				and d.estado='1'";
		  //cho $sql;
        return $this->dao->consulta($sql);
       }
       public function ListarDocumentoID($cc_persona, $tpdoc){
         $sql="SELECT d.cc_documento,
				d.nombre,
				d.nombre_corto,
				d.serie,
				d.numero
				FROM fin_documento d inner join fin_documentouser du
				on d.cc_documento=du.cc_documento
				where du.cc_persona='".$cc_persona."'
				and d.estado='1'
				and d.nombre_corto='".$tpdoc."'";
				//echo $sql;
		  //cho $sql;
        return $this->dao->consulta($sql);
       } 
       
	public function __destruct(){
          unset($this->dao);
	}
}
?>