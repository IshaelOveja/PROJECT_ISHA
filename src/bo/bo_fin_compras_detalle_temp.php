<?php
require_once(u_src()."dao/dao_fin_compras_detalle_temp.php");

class bo_fin_compras_detalle_temp{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_fin_compras_detalle_temp();
	}
 
	public function control(fin_compras_detalle_temp $obj,$opc){
            if($opc=="I"){
                return $this->dao->insertar($obj);
            }else{
                return $this->dao->modificar($obj);
            }
            
        }
	public function eliminar($cc_compras_det){
            return $this->dao->eliminar($cc_compras_det);
        }
		
	public function listar($cde_codigo){
		$sql="select t.cc_compras_det,
				a.ct_codigo,
				a.ct_nombre,
				t.ct_cantidad,
				t.ct_importe,
				t.ct_total
				from fin_compras_detalle_temp t inner join gen_articulo a 
				on t.cc_articulo=a.cc_articulo
				where t.cc_codigo='".$cde_codigo."'";
			//echo $sql;
		return $this->dao->consulta($sql);
	}
	
public function total($cde_codigo){
		$sql="select sum(ct_total) as total
			from fin_compras_detalle_temp
			where cc_codigo='".$cde_codigo."' ";
			//echo $sql;
		return $this->dao->consulta($sql);
	}
	
	
	function  __destruct(){
		unset($this->dao);
	}
}
?>