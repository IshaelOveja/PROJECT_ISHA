<?php 
require_once(u_src()."dao/dao_fin_estado_cuenta.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_fin_estado_cuenta  extends SYQ_Paginacion { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_fin_estado_cuenta();
    }
    public function control(fin_estado_cuenta $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function anular($cc_caja, $usuario){
       return $this->dao->anular($cc_caja, $usuario);
    }

            
     public function listarId($cc_estadocuenta){/*OK*/
         $sql="select cc_estadocuenta, 
			cc_persona,
			cc_caja,
			ct_fecha, 
			ct_tipo,
			cc_descripcion, 
			abs(ct_monto) as ct_monto, 
			sys_user, 
			ct_vigencia
			FROM fin_estado_cuenta
			where cc_estadocuenta='".$cc_estadocuenta."'";
		  //echo $sql;
         return $this->dao->consulta($sql);
       }
public function EstadoCuenta($cc_persona){
	$sql="SELECT 
	cc_estadocuenta,
	(select concat(fin_caja.ct_tipo,' ',fin_caja.ct_serie,'-',fin_caja.ct_numero) as voucher from fin_caja where fin_caja.cc_caja=fin_estado_cuenta.cc_caja) as recibo,
	cc_caja,
	DATE_FORMAT(ct_fecha,'%d/%m/%Y %H:%i') as ct_fecha,
	case ct_tipo when 'P' then 'P' when 'D' then 'D' end as tipo,
	cc_descripcion,
	IF(ct_monto <0, ct_monto , 0) ingreso, -- abs(positivo)
	IF(ct_monto >0, ct_monto, 0) egreso
	FROM fin_estado_cuenta
	where cc_persona='".$cc_persona."'
	order by ct_fecha desc";
	//echo $sql;
	return $this->dao->consulta($sql);
	}
public function listarCreditos($fec_ini, $fec_fin){
	$sql="select e.cc_estadocuenta, p.cc_persona, p.ct_nombres,
SUM(IF(e.ct_tipo = 'D', e.ct_monto,0)) AS deuda,
SUM(IF(e.ct_tipo = 'P', abs(e.ct_monto),0)) AS pago
	from  fin_estado_cuenta e inner join gen_personas p
	on e.cc_persona=p.cc_persona
	where e.ct_vigencia='1'";
	if((strlen($fec_ini)>0) and (strlen($fec_fin)>0)){
					 $sql.=" and e.ct_fecha  BETWEEN ".u_fecha($fec_ini)." and ".u_fecha($fec_fin)."";
				 }
				 
	$sql.=" group by e.cc_persona";
	//echo $sql;
	return $this->dao->consulta($sql);
	}
  
	public function __destruct(){
          unset($this->dao);
	}
}
?>