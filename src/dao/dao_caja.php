<?php
//require_once(u_src()."entidad/gen_ano.php");
require_once(u_src()."dao/Conecta.php");
class dao_caja{
	private $conecta;

	function __construct(){
		$this->conecta = new Conecta();
	}
	public function consulta($sql){
		return $this->conecta->ArrayLista($sql);
	}	
	
		public function listar_detalle_proc_habil($periodo,$cr){
      	$sql="exec sp_habil_web '".$periodo."','".$cr."'";
		   $rs=$this->conecta->sql_query($sql);
			return $rs;
    }
	
	public function pago_anual_ejecutar($cep){
      	$sql="exec sp_pago_adelantado_web '".$cep."','".s_usuario()."'";
		   $rs=$this->conecta->sql_query($sql);
		  // echo $sql;
			return $rs;
    }
	
	
	public function actualizar_hablidad($cep){
		$sql="exec sp_PERSONAS_ACT_SALDO '".$cep."','X-WEB'; ";
		//echo $sql;
		$rs=$this->conecta->sql_query($sql);
			return $rs;
	}
	public function anular_venta_ejecutar($tp,$numero, $usuario, $c_local){
		$sql="EXEC anulacion_de_documentos_web '".$tp."','".$numero."','".$c_local."','".$usuario."'";
		//echo $sql;
		 return $this->conecta->sql_query($sql);
	}
	
	function  __destruct(){
		$this->conecta->cerrarCN();
		unset($this->conecta);
	}
}
?>
