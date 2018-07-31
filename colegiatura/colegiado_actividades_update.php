<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_actividades.php"); 
s_validar_pagina_ayax();

$cc_persona    = $_REQUEST["cc_persona"];

$bo_actividades         = new bo_gen_personas_actividades();
$ent_actividades            = new gen_personas_actividades();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


		$bo_actividades->eliminar($cc_persona);
		
		foreach($_REQUEST["cc_actividad"] as $key => $value){
        $ent_actividades->setCc_persona($_REQUEST["cc_persona"]);
        $ent_actividades->setCc_actividad($value);

		$ent_actividades->setUser_crea($cc_usuario_audit);
		$ent_actividades->setUser_mod($cc_usuario_audit);
        
        $val=$bo_actividades->control($ent_actividades, "I");
         if(!$val){
             $mensaje    = "No se puede grabar";
             $error      = "1";
        }
	}

if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $error;
}
echo $mensaje;
?>
