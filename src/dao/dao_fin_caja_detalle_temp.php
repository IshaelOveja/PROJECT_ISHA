<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_caja_detalle_temp.php");
class dao_fin_caja_detalle_temp { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
	
	public function insertar(fin_caja_detalle_temp $obj){
         $sql="INSERT INTO fin_caja_detalle_temp(
				cc_codigo,
				cc_articulo,
				ct_cantidad, 
				ct_importe, 
				ct_total,
				ct_igv
              )VALUES(
			  	 '".$obj->getCc_codigo()."',
				  '".$obj->getCc_articulo()."',
				  '".$obj->getCt_cantidad()."',
				  '".$obj->getCt_importe()."',
				  '".$obj->getCt_total()."',
				  '".$obj->getCt_igv()."'
              )";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	
	public function eliminar($cc_caja_det){
         $sql="DELETE FROM fin_caja_detalle_temp
	     			WHERE cc_caja_det='".$cc_caja_det."'";
					//echo $sql;
          return $this->conecta->sql_query($sql);
	}

public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>