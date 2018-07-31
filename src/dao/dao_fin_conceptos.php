<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_conceptos.php");
class dao_fin_conceptos { 
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
	public function insertar(fin_conceptos $obj){
         $sql="INSERT INTO fin_conceptos(
				tipo, 
				nombre, 
				igv, 
				monto, 
				c_cuenta, 
				usur_crea, 
				fecha_crea, 
				estado
              )VALUES(
				 '".$obj->getTipo()."',
				 '".utf8_decode($obj->getNombre())."',
				 '".$obj->getIgv()."',
				 '".$obj->getMonto()."',
				 '".$obj->getC_cuenta()."',
				 '".$obj->getUsur_crea()."',
				 NOW(),
				 '".$obj->getEstado()."'
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(fin_conceptos $obj){
         $sql="UPDATE fin_conceptos set 
               tipo='".$obj->getTipo()."',
               nombre='".utf8_decode($obj->getNombre())."',
               igv='".$obj->getIgv()."',
               monto='".$obj->getMonto()."',
               c_cuenta='".$obj->getC_cuenta()."',
               ct_img='".$obj->getUsur_mod()."',
                fech_mod=NOW(),
               estado='".$obj->getEstado()."',
	     WHERE cc_modulo='".$obj->getCc_modulo()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_articulo){
         $sql="DELETE FROM  fin_conceptos
	     WHERE cc_articulo='".$cc_articulo."'";
          return $this->conecta->sql_query($sql);
	}
	
	
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>