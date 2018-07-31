<?php
require_once(u_src()."dao/dao_gen_articulo.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_gen_articulo extends SYQ_Paginacion{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_gen_articulo();
	}
         public function control(gen_articulo $obj,$opc){
            if($opc=="I"){
                return $this->dao->insertar($obj);
            }else{
                return $this->dao->modificar($obj);
            }
        }
	public function ActualizarStock($cc_articulo, $cantidad, $signo){
       return $this->dao->ActualizarStock($cc_articulo, $cantidad, $signo);
    }
	public function ActualizarCompras($cc_articulo, $ct_importe){
       return $this->dao->ActualizarCompras($cc_articulo, $ct_importe);
    }
	public function ProcesarRentabilidad($cc_articulo,$costo){
       return $this->dao->ProcesarRentabilidad($cc_articulo,$costo);
    }
	public function listarId($cc_articulo){
		$sql="SELECT
				cc_articulo, 
				ct_codigo, 
				emp_id, 
				ct_grupo, 
				ct_nombre, 
				ct_molecula, 
				ct_umedida,
				ct_compra,
				ct_rentabilidad,
				ct_venta,
				ct_stock,
				ct_stockmin,
				ct_igv,
				ct_vigencia
			FROM  gen_articulo															
            WHERE cc_articulo='".$cc_articulo."'";
			//echo $sql;
		return $this->dao->consulta($sql);
	}

	
	public function listar(gen_articulo $obj){
            $pagina = $this->getPagina();
            $por_pagina= $this->getSelectable_pages();
            $sql= "SELECT
					SQL_CALC_FOUND_ROWS
					cc_articulo, 
				ct_codigo, 
				emp_id, 
				ct_grupo, 
				ct_nombre, 
				
				ct_molecula, 
				fc_parametro_valor('gen_articulo','ct_umedida',ct_umedida) as ct_umedida,
				ct_compra,
				ct_rentabilidad,
				ct_venta,
				ct_stock,
				ct_igv,
				ct_stockmin,
				ct_vigencia
                    FROM  gen_articulo 
                    WHERE lower(ct_nombre) LIKE lower('%".u_ascui($obj->getCt_nombre())."%')";
            if(strlen($obj->getCt_grupo())>0){
                $sql.=" AND ct_grupo='".$obj->getCt_grupo()."' ";
            }
            if(strlen($obj->getEmp_id())>0){
                $sql.=" AND emp_id='".$obj->getEmp_id()."' ";
            }
            $sql.=" ORDER BY ct_nombre  ";
            $sql.=" LIMIT ". (($pagina - 1) * $por_pagina) . ', ' . $por_pagina ;
			//echo $sql;
            $data = $this->dao->consulta($sql);
            $total = $this->dao->total_pagina();
            $this->records($total);
            $this->calcular_pagina($pagina);
            return $data;
	}
	public function listarBuscar(gen_articulo $obj){
            $sql= "SELECT
					SQL_CALC_FOUND_ROWS
					cc_articulo, 
				ct_codigo, 
				emp_id, 
				ct_grupo, 
				ct_nombre, 
				ct_molecula, 
				fc_parametro_valor('gen_articulo','ct_umedida',ct_umedida) as ct_umedida,
				ct_compra,
				ct_rentabilidad,
				ct_venta,
				ct_stock,
				ct_stockmin,
				ct_igv,
				ct_vigencia
                    FROM  gen_articulo 
                    WHERE lower(ct_nombre) LIKE lower('%".u_ascui($obj->getCt_nombre())."%')";
            if(strlen($obj->getct_grupo())>0){
                $sql.=" AND ct_grupo='".$obj->getCt_grupo()."' ";
            }
            
            $sql.=" ORDER BY ct_nombre";
            $sql.=" LIMIT 8";
			//echo $sql;
			return $this->dao->consulta($sql);
            
	}
public function articuloEmpresa($emp_id){
	$sql="select cc_articulo, 
		ct_codigo, 
		emp_id, 
		ct_grupo, 
		ct_nombre, 
		ct_molecula, 
		ct_umedida, 
		ct_compra,
		ct_rentabilidad,
		ct_venta, 
		ct_stockmin, 
		ct_stock, 
		ct_igv,
		ct_vigencia 
		from gen_articulo
		where ct_vigencia='1'
		and emp_id='".$emp_id."'
		order by ct_nombre asc";
		return $this->dao->consulta($sql);
	}
public function articuloTodos(){
	$sql="select cc_articulo, 
		ct_codigo, 
		emp_id, 
		ct_grupo, 
		ct_nombre, 
		ct_molecula, 
		fc_parametro_valor('gen_articulo','ct_umedida',ct_umedida) as ct_umedida,
		ct_compra,
		ct_rentabilidad,
		ct_venta, 
		ct_stockmin, 
		ct_stock, 
		ct_igv,
		ct_vigencia 
		from gen_articulo
		where ct_vigencia='1'
		order by ct_nombre asc";
		return $this->dao->consulta($sql);
	}
	function  __destruct(){
		unset($this->dao);
	}
}
?>
