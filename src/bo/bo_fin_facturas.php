<?php
require_once(u_src()."dao/dao_fin_facturas.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_fin_facturas  extends SYQ_Paginacion { 
	private $dao;
	
	function __construct(){
		$this->dao = new dao_fin_facturas();
	}
 
	public function control(fin_caja $obj,$opc){
            if($opc=="I"){
                return $this->dao->insertar($obj);
            }else{
                return $this->dao->modificar($obj);
            }
            
        }
		
	public function anular_recibo($cc_caja){
            return $this->dao->anular_recibo($cc_caja);
        }
	
	public function ActComprobante($cc_comprobante, $ct_correlativo){
            return $this->dao->ActComprobante($cc_comprobante, $ct_correlativo);
        }
	 public function imprimirReciboCabecera($id){
	$sql="select f.cod_documento,f.num_documento,f.cc_persona,f.fecha,f.estado,g.nombre,g.c_colegiado,f.user_crea FROM fin_facturas f inner join gen_personas g
	on  g.cc_persona=f.cc_persona
	 WHERE f.cc_factura='".$id."'";
		//echo $sql;
	return $this->dao->consulta($sql);
	
	} 
	

	public function imprimirReciboDetalle($id){
		$sql="SELECT  f.cc_factura,	f.cc_factura ,f.c_articulo,	f.cantidad ,f.precio ,f.observacion,	f.monto ,f.cantidad,f.precio FROM fin_facturasdetalles f WHERE f.cc_factura='".$id."'";
		//echo $sql;
		return $this->dao->consulta($sql);
		
}





	



/****************reportes*****************/
}
	
	


	function  __destruct(){
		unset($this->dao);
	}

?>