<?php
require_once(u_src()."dao/dao_fin_caja_detalle_temp.php");

class bo_fin_caja_detalle_temp{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_fin_caja_detalle_temp();
	}
 
	public function control(fin_caja_detalle_temp $obj,$opc){
            if($opc=="I"){
                return $this->dao->insertar($obj);
            }else{
                return $this->dao->modificar($obj);
            }
            
        }
	public function eliminar($cc_caja_det){
            return $this->dao->eliminar($cc_caja_det);
        }
		
	public function listar($cde_codigo){
		$sql="select t.cc_caja_det,
				a.ct_codigo,
				a.ct_nombre,
				t.ct_cantidad,
				t.ct_importe,
				t.ct_total,
				t.ct_igv
				from fin_caja_detalle_temp t inner join gen_articulo a 
				on t.cc_articulo=a.cc_articulo
				where t.cc_codigo='".$cde_codigo."'";
			//echo $sql;
		return $this->dao->consulta($sql);
	}
	
public function total($cde_codigo,$igv){
		$sql="select sum(ct_total) as total 
		from fin_caja_detalle_temp d inner join gen_articulo a
		on d.cc_articulo=a.cc_articulo 
		where d.cc_codigo='".$cde_codigo."'
		and a.ct_igv='".$igv."'";
			//echo $sql;
		return $this->dao->consulta($sql);
	}
	
	
	function  __destruct(){
		unset($this->dao);
	}
}
?>