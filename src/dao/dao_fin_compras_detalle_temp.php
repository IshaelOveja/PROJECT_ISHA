<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_compras_detalle_temp.php");
class dao_fin_compras_detalle_temp { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
	
	public function insertar(fin_compras_detalle_temp $obj){
         $sql="INSERT INTO fin_compras_detalle_temp(
				cc_codigo,
				cc_articulo,
				ct_cantidad, 
				ct_importe, 
				ct_total
              )VALUES(
			  	 '".$obj->getCc_codigo()."',
				  '".$obj->getCc_articulo()."',
				  '".$obj->getCt_cantidad()."',
				  '".$obj->getCt_importe()."',
				  '".$obj->getCt_total()."'
              )";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	
	public function eliminar($cc_compras_det){
         $sql="DELETE FROM fin_compras_detalle_temp
	     			WHERE cc_compras_det='".$cc_compras_det."'";
					//echo $sql;
          return $this->conecta->sql_query($sql);
	}

public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>