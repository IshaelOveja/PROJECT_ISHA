<?php
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_articulo.php");
class dao_gen_articulo{
	private $conecta;

	function __construct(){
		$this->conecta = new Conecta();
	}
	public function consulta($sql){
		return $this->conecta->ArrayLista($sql);
	}
        public function total_pagina(){
		return $this->conecta->total_pagina();
        }
	public function insertar(gen_articulo $obj){
            $sql="INSERT INTO gen_articulo(
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
								ct_vigencia,
								ct_igv
                                )VALUES(
                                '".$obj->getCt_codigo()."',
                                '".$obj->getEmp_id()."',
                                '".$obj->getCt_grupo()."',
                                '".utf8_decode($obj->getCt_nombre())."',
                                '".utf8_decode($obj->getCt_molecula())."',
								'".$obj->getCt_umedida()."',
								'".$obj->getCt_compra()."',
								'".$obj->getCt_rentabilidad()."',
								'".$obj->getCt_venta()."',
								'".$obj->getCt_stock()."',
								'".$obj->getCt_stockmin()."',
                                '1',
								'".$obj->getCt_igv()."'
                                )";
            return $this->conecta->sql_query($sql);
        }
        public function modificar(gen_articulo $obj){
            $sql="UPDATE gen_articulo SET 
                        ct_codigo='".$obj->getCt_codigo()."',
                        emp_id='".$obj->getEmp_id()."',
                        ct_grupo='".$obj->getCt_grupo()."',
                        ct_nombre='".utf8_decode($obj->getCt_nombre())."',
                        ct_molecula='".utf8_decode($obj->getCt_molecula())."',
						 ct_umedida='".$obj->getCt_umedida()."',
						  ct_compra='".$obj->getCt_compra()."',
						 ct_rentabilidad='".$obj->getCt_rentabilidad()."',
						 ct_venta='".$obj->getCt_venta()."',
						 ct_stock='".$obj->getCt_stock()."',
						 ct_stockmin='".$obj->getCt_stockmin()."',
						  ct_igv='".$obj->getCt_igv()."',
                        ct_vigencia='".$obj->getct_vigencia()."'
                       
                   WHERE cc_articulo='".$obj->getCc_articulo()."' ";
            return $this->conecta->sql_query($sql);
        }

	public function ActualizarStock($cc_articulo, $cantidad, $signo){
		$sql="update gen_articulo 
			set ct_stock=ct_stock".$signo."".$cantidad."
			where cc_articulo='".$cc_articulo."'";
			//echo $sql;
		return $this->conecta->sql_query($sql);
		}
	public function	ActualizarCompras($cc_articulo, $ct_importe){
		$sql="UPDATE gen_articulo SET  
		ct_compra='".$ct_importe."'
		WHERE cc_articulo='".$cc_articulo."' ";
		//echo $sql;
		return $this->conecta->sql_query($sql);
		}
	public function ProcesarRentabilidad($cc_articulo,$costo){
		$sql="update gen_articulo set 
			ct_venta='".$costo."'
			where cc_articulo='".$cc_articulo."'";
			//echo $sql;
		return $this->conecta->sql_query($sql);
		}
		
	function  __destruct(){
		$this->conecta->cerrarCN();
		unset($this->conecta);
	}
}
?>