<?php
require_once(u_src()."dao/dao_fin_compras_detalle.php");

class bo_fin_compras_detalle{
	private $dao;
	
	function __construct(){
		$this->dao = new dao_fin_compras_detalle();
	}
 
	public function control(fin_compras_detalle $obj,$opc){
            if($opc=="I"){
                return $this->dao->insertar($obj);
            }else{
                return $this->dao->modificar($obj);
            }
            
        }
	public function eliminar_temp($cc_codigo){
            return $this->dao->eliminar_temp($cc_codigo);
        }
	
public function ListaTemporales($cod_unico){/*de la table temporales*/
	$sql="select cc_compras_det, 
			cc_codigo, 
			cc_articulo, 
			ct_cantidad, 
			ct_importe, 
			ct_total
			from fin_compras_detalle_temp
			where cc_codigo='".$cod_unico."'";
			return $this->dao->consulta($sql);
	}

public function ultimoRegistro($cc_articulo){
	$sql="select max(cc_compras_det), ct_importe
		from fin_compras_detalle
		where cc_articulo='".$cc_articulo."'";
		//echo $sql;
		return $this->dao->consulta($sql);
	}
	public function ListaId($cc_compras){/*de la table temporales*/
	$sql="select d.cc_articulo,
			a.ct_nombre,
			d.ct_cantidad,
			d.ct_importe,
			d.ct_total
			from fin_compras_detalle d inner join gen_articulo a 
			on d.cc_articulo=a.cc_articulo 
			where d.cc_compras='".$cc_compras."'";
			//echo $sql;
			return $this->dao->consulta($sql);
	}
	public function listarArticulos(){/**Lista compras maximo*/
		$sql="SELECT rh.cc_compras_det, rh.cc_articulo, rh.ct_importe
			FROM fin_compras_detalle rh,
			  (SELECT MAX(cc_compras_det) AS maxdato, cc_articulo
			   FROM fin_compras_detalle
			   GROUP BY cc_articulo) as maxresultado
			WHERE rh.cc_articulo = maxresultado.cc_articulo
			AND rh.cc_compras_det= maxresultado.maxdato";
			return $this->dao->consulta($sql);
		}
	function  __destruct(){
		unset($this->dao);
	}
}
?>