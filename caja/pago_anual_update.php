<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
s_validar_pagina();
$bo_caja  = new bo_fin_ec_reporte();


$cc_persona   = $_REQUEST["c"];
$opc  = $_REQUEST["opc"];




$error="0";
$mensaje    = "";
if($error=="0"){
		$val=$bo_caja->pago_anual_ejecutar($cc_persona,$opc);
		if(!$val){
			$mensaje    = "No se pudo procesar!!!!!!!!!!!!!!!!!".$cc_persona.$opc;
			$error      = "1";
		}
	
}

if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $mensaje;
}
echo $mensaje;
?>
