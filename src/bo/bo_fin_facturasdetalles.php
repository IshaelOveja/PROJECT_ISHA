<?php
require_once(u_src()."dao/dao_fin_facturasdetalles.php");

class bo_fin_facturasdetalles{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_fin_facturasdetalles();
	}
 
	public function control(fin_facturasdetalles $obj,$opc){
            if($opc=="I"){
                return $this->dao->insertar($obj);
            }else{
                return $this->dao->modificar($obj);
            }
            
        }
	public function eliminar_temp($cc_codigo){
            return $this->dao->eliminar_temp($cc_codigo);
        }
	
public function ListaTemporales($cod_temporal){/*de la table temporales*/
	$sql="select cc_facturasdetalles, 
			cc_factura, 
			c_articulo, 
			cantidad, 
			precio, igv, 
			igv_total, 
			observacion, 
			monto, 
			cod_temporal
			from fin_facturasdetalles
			cod_temporal='".cod_temporal."'";
			echo $sql;
			return $this->dao->consulta($sql);
	}
public function ListaDetalle($cc_factura){/*de la table factura*/
	$sql="select cc_facturasdetalles, 
			cc_factura, 
			c_articulo, 
			cantidad, 
			precio, igv, 
			igv_total, 
			observacion, 
			monto, 
			cod_temporal
			from fin_facturasdetalles
			cc_factura='".cc_factura."'";
			echo $sql;
			return $this->dao->consulta($sql);
	}
	
	
	function  __destruct(){
		unset($this->dao);
	}
}
?>