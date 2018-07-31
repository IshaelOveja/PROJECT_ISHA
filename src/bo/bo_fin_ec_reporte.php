<?php
require_once(u_src()."dao/dao_fin_ec_reporte.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_fin_ec_reporte  extends SYQ_Paginacion { 
	private $dao;
	
	function __construct(){
		$this->dao = new dao_fin_ec_reporte();
	}
 public function pago_anual_ejecutar($cc_persona,$opc){
       if($opc=="I"){
           return $this->dao->anho_adelantado_insertar($cc_persona);
        }else{
          return $this->dao->anho_adelantado_borrar($cc_persona);
        }
    }

 public function listarCaja($fecha_desde,$fecha_hasta){
	$sql="SELECT f.cc_factura,f.cod_documento,f.num_documento,
	f.c_local,f.fecha,f.user_crea,f.estado,f.total,p.nombre,p.c_colegiado,p.ruc ,f.obs FROM fin_facturas f inner join gen_personas p on p.cc_persona=f.cc_persona
			";

	if((strlen($fecha_desde)>0) and (strlen($fecha_hasta)>0)){
				 $sql.=" WHERE f.fecha BETWEEN ".u_fecha($fecha_desde)." and ".u_fecha($fecha_hasta).""; 
			 }
			 $sql.=" order by f.fecha";
			//echo $sql;
			return $this->dao->consulta($sql);
	}	
	
 public function listarCaja_sustento($fecha_desde,$fecha_hasta){
	$sql="SELECT fc_parametro_valor('fin_facturassustentos','cod_forma',fs.cod_forma) as cod_forma,sum(fs.monto) as monto
	 FROM fin_facturassustentos fs 
	inner join fin_facturas f on f.cc_factura=fs.cc_factura";

	if((strlen($fecha_desde)>0) and (strlen($fecha_hasta)>0)){
				 $sql.=" WHERE f.fecha BETWEEN ".u_fecha($fecha_desde)." and ".u_fecha($fecha_hasta).""; 
			 }
			 $sql.=" group by fs.cod_forma order by fs.cod_forma";
			//echo $sql;
			return $this->dao->consulta($sql);
	}	





public function listarId($c_persona){
		$sql="select substring(es.periodo,1,4) as anho, 
sum(case when substring(es.periodo,6,2) = '01' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c01 ,
sum(case when substring(es.periodo,6,2) = '02' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c02 , 
sum(case when substring(es.periodo,6,2) = '03' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c03 ,
sum(case when substring(es.periodo,6,2) = '04' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c04 ,
sum(case when substring(es.periodo,6,2) = '05' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c05 ,
sum(case when substring(es.periodo,6,2) = '06' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c06 ,
sum(case when substring(es.periodo,6,2) = '07' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c07 ,
sum(case when substring(es.periodo,6,2) = '08' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c08 ,
sum(case when substring(es.periodo,6,2) = '09' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c09 ,
sum(case when substring(es.periodo,6,2) = '10' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c10 ,
sum(case when substring(es.periodo,6,2) = '11' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c11 ,
sum(case when substring(es.periodo,6,2) = '12' and es.cargo_abono='C' and es.cod_tipo='99'then es.monto else 0.00 end) as c12 ,
sum(case when substring(es.periodo,6,2) = '01' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a01 ,
sum(case when substring(es.periodo,6,2) = '02' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a02 , 
sum(case when substring(es.periodo,6,2) = '03' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a03 ,
sum(case when substring(es.periodo,6,2) = '04' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a04 ,
sum(case when substring(es.periodo,6,2) = '05' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a05 ,
sum(case when substring(es.periodo,6,2) = '06' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a06 ,
sum(case when substring(es.periodo,6,2) = '07' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a07 ,
sum(case when substring(es.periodo,6,2) = '08' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a08 ,
sum(case when substring(es.periodo,6,2) = '09' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a09 ,
sum(case when substring(es.periodo,6,2) = '10' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a10 ,
sum(case when substring(es.periodo,6,2) = '11' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a11 ,
sum(case when substring(es.periodo,6,2) = '12' and es.cargo_abono='A' and es.cod_tipo='99'then es.monto else 0.00 end) as a12 
from fin_estado_cuenta es where (es.cod_tipo='99' ) and es.cc_persona= '".$c_persona."' 
group by substring(es.periodo,1,4),es.c_local order by substring(es.periodo,1,4) desc";
	//echo $sql;
		return $this->dao->consulta($sql);
	}
	
	public function listarId_detalle($cc_persona,$anho,$tipo){
		$sql="select es.periodo,es.cc_estcuenta, es.fecha , es.referencia,es.monto,es.c_local,es.fecha,es.cargo_abono,f.cod_documento,f.num_documento,es.cc_factura from fin_estado_cuenta es left JOIN fin_facturas f on es.cc_factura=f.cc_factura where es.monto!=0 and (es.cod_tipo='99' ) and SUBSTRING(es.periodo,1,4) like '".$anho."' and es.cc_persona='".$cc_persona."' and cargo_abono like '".$tipo."' order by es.periodo asc
		
";
//echo $sql;
		return $this->dao->consulta($sql);}
		
		
	 public function ListarRecibos($cc_persona){
	$sql="SELECT cc_factura, cod_documento, num_documento, cc_persona, c_local, fecha, user_crea, fecha_crea, user_mod, fech_mod, estado, flag_centralizado, flag_igv, igv, total, obs FROM  fin_facturas 
			where cc_persona='".$cc_persona."'";
			//echo $sql;
			return $this->dao->consulta($sql);
	}	
	
	
	public function buscar_voucher($cc_banco, $numero){
	$sql="SELECT f.cc_factura,f.cod_documento,f.num_documento, f.c_local,f.fecha,f.estado, f.flag_centralizado,f.flag_igv,f.total,f.obs,fs.c_operacion,fs.fecha_referencia	,fs.monto FROM fin_facturas f inner join fin_facturassustentos fs on fs.cc_factura=f.cc_factura where fs.c_operacion like concat('%','".$numero."') and fs.cc_banco='".$cc_banco."' 
";
	//echo $sql;
		return $this->dao->consulta($sql);
	}
	
	
		public function listarCajadetalle_codigo($fec_desde,$fec_hasta){
	$sql="
	select fs.c_articulo,c.nombre,sum(fs.monto) as monto from fin_facturas f inner join fin_facturasdetalles fs on fs.cc_factura=f.cc_factura inner join fin_codigos_caja c on c.cc_articulo=fs.c_articulo where f.fecha BETWEEN ".u_fecha($fec_desde)." and ".u_fecha($fec_hasta)." and f.estado='*' group by fs.c_articulo,c.nombre order by fs.c_articulo,c.nombre 
";
//echo $sql;
return $this->dao->consulta($sql);
	}

public function i_c_detalle($fec_desde, $fec_hasta,$c_articulo){  
	$sql="select fs.cc_facturasdetalles,f.cc_factura,f.cod_documento,f.num_documento,fs.monto,fs.cantidad,fs.precio,p.nombre,p.c_colegiado,p.ruc,f.fecha from fin_facturas f inner join fin_facturasdetalles fs on fs.cc_factura=f.cc_factura inner join fin_codigos_caja c on c.cc_articulo=fs.c_articulo inner join gen_personas p on p.cc_persona =f.cc_persona where f.fecha BETWEEN ".u_fecha($fec_desde)." and ".u_fecha($fec_hasta)." and f.estado='*' and fs.c_articulo='".$c_articulo."' order by fs.c_articulo,c.nombre  ";
      
//echo $sql;
		return $this->dao->consulta($sql);
	}
	


public function periodos_habilitacion(){  
	$sql="select anho,mes from fin_habil_historial group by anho,mes order by anho,mes ";
		return $this->dao->consulta($sql);
	}

/****************reportes*****************/
}
	
	


	function  __destruct(){
		unset($this->dao);
	}

?>