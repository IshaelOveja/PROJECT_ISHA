<?php 
require_once(u_src()."dao/Conecta.php");
//require_once(u_src()."entidad/fin_caja.php");
class dao_fin_ec_reporte { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }


public function anho_adelantado_insertar($cc_persona){

$sql="call un_anho ('".$cc_persona."')";
        $rs=$this->conecta->sql_query($sql);
			return $rs;
    }

public function anho_adelantado_borrar($cc_persona){

$sql="call un_anho_borar ('".$cc_persona."')"; 

        $rs=$this->conecta->sql_query($sql);
			return $rs;
    }

public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>