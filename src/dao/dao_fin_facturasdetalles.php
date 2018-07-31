<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_facturasdetalles.php");
class dao_fin_facturasdetalles { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
	
public function insertar(fin_facturasdetalles $obj){
         $sql="INSERT INTO fin_facturasdetalles(
				c_articulo, 
				cantidad, 
				precio, 
				igv, 
				igv_total, 
				monto, 
				cod_temporal
              )VALUES(
				  '".$obj->getC_articulo()."',
				  '".$obj->getCantidad()."',
				  '".$obj->getPrecio()."',
				  '".$obj->getIgv()."',
				  '".$obj->getIgv_total()."',
				  '".$obj->getCt_vigencia()."',
				  '".$obj->getCod_temporal()."'
              )";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}

	public function modificar(fin_facturasdetalles $obj){
         $sql="UPDATE fin_facturasdetalles set 
               cc_factura='".$obj->getCc_factura()."',
	     WHERE cc_facturasdetalles='".$obj->getCc_facturasdetalles()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_facturasdetalles){
         $sql="DELETE FROM fin_facturasdetalles
	     WHERE cc_facturasdetalles='".$cc_facturasdetalles."'";
          return $this->conecta->sql_query($sql);
	}


public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>