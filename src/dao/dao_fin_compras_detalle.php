<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_compras_detalle.php");
class dao_fin_compras_detalle { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
	
	public function insertar(fin_compras_detalle $obj){
         $sql="INSERT INTO fin_compras_detalle(
				cc_compras,
				cc_articulo,
				ct_cantidad, 
				ct_importe, 
				ct_total
              )VALUES(
			  	 '".$obj->getCc_compras()."',
				  '".$obj->getCc_articulo()."',
				  '".$obj->getCt_cantidad()."',
				  '".$obj->getCt_importe()."',
				  '".$obj->getCt_total()."'
              )";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
public function eliminar_temp($cc_codigo){
	$sql="delete from fin_compras_detalle_temp 
	where cc_codigo='".$cc_codigo."'";
	return $this->conecta->sql_query($sql);
}


public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>