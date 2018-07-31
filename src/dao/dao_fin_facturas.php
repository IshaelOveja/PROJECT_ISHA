<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/fin_facturas.php");
class dao_fin_facturas { 
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
	
public function insertar(fin_caja $obj){
         $sql="INSERT INTO fin_caja(
				cc_caja, 
				caj_ano, 
				reg_fecha,
				 cc_persona,
				 ct_tipo,
				 ct_serie,
				 ct_numero,
				 ct_vigencia, 
				 caj_obs,
				 cc_usuario,
				 pag_tipo
              )VALUES(
			  	 '".$obj->getCc_caja()."',
				  '".$obj->getCaj_ano()."',
				 ".u_fecha($obj->getReg_fecha()).",
				  '".$obj->getCc_persona()."',
				  '".$obj->getCt_tipo()."',
				  '".$obj->getCt_serie()."',
				  '".$obj->getCt_numero()."',
				  '".$obj->getCt_vigencia()."',
				  '".$obj->getCaj_obs()."',
				  '".$obj->getCc_usuario()."',
				  '".$obj->getpag_tipo()."'
              )";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function anular_recibo($cc_caja){
		$sql="update fin_caja c inner join fin_caja_detalle d
			on c.cc_caja=d.cc_caja	
			set c.ct_vigencia='0',
			d.ct_cantidad='0',
			d.ct_importe='0.00',
			d.ct_total='0.00'
			where c.cc_caja='".$cc_caja."'";
			//echo $sql;
	 return $this->conecta->sql_query($sql);
}

public function ActComprobante($cc_comprobante, $ct_correlativo){
	$sql="update fin_comprobante set 
		ct_correlativo='".$ct_correlativo."' 
		where ct_serie='".$cc_comprobante."'";
		//echo $sql;
	 return $this->conecta->sql_query($sql);
						   
}


public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>