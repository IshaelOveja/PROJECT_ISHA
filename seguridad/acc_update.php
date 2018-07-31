<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_modulo_perfil.php"); 
s_validar_pagina_ayax();
$cc_perfil        = $_REQUEST["cc_perfil"];
$cc_modulo		=		$_REQUEST["cc_modulo"];
$bo_modulo_perfil = new bo_seg_modulo_perfil();
$modulo_perfil    = new seg_modulo_perfil();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();
$ct_ip             = u_ip();
if(!(empty($_REQUEST["cc_modulo"]))){
	if(count($cc_modulo)>0){
    $val=$bo_modulo_perfil->eliminar($cc_perfil);
		if(!$val){
			 $mensaje    = "No se puede eliminar";
			 $error      = "1";
		}
	}
	foreach($_REQUEST["cc_modulo"] as $key => $value){
		
		   $modulo_perfil->setCc_modulo($value);
    		$modulo_perfil->setCc_perfil($cc_perfil);
			$modulo_perfil->setCc_usuario_audit($cc_usuario_audit);
			$modulo_perfil->setCt_ip($ct_ip);
			$val=$bo_modulo_perfil->control($modulo_perfil);
			if(!$val){
         $mensaje    = "No se puede grabar";
         $error      = "1";
     	}
	  }
	}

if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $error;
}
echo $mensaje;
?>