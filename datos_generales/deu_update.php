<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_estado_cuenta.php"); 
s_validar_pagina_ayax();

$opc             = $_REQUEST["opc"];
$cc_estcta     = $_REQUEST["cc_estcta"];
$cc_persona     = $_REQUEST["cc_persona"];
$bo_cuenta= new bo_fin_estado_cuenta();
$ent_cuenta= new fin_estado_cuenta();

$error             = "0";
$mensaje           = "";

if($opc=="D"){
    $val=$bo_cuenta->eliminar($cc_estadocuenta);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}

if($error==0){
		$ent_cuenta->setCc_estadocuenta($cc_estcta);
		$ent_cuenta->setCc_persona($_REQUEST["cc_persona"]);
		$ent_cuenta->setCc_caja("00000");
		$ent_cuenta->setCc_descripcion($_REQUEST["cc_descripcion"]);
		$ent_cuenta->setCt_monto("-".$_REQUEST["ct_monto"]);
		$ent_cuenta->setCt_tipo("P");
		$ent_cuenta->setCt_fecha(date("d/m/Y"));
		$ent_cuenta->setSys_user(s_usuario_id());
		
		$val=$bo_cuenta->control($ent_cuenta,$opc);	
		 if(!$val){
			 $mensaje    = "No se puede grabar";
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
