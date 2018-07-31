<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_especialidad.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_especialidad    = $_REQUEST["cc_especialidad"];

$bo_especialidad         = new bo_gen_personas_especialidad();
$ent_especialidad            = new gen_personas_especialidad();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_especialidad->eliminar($cc_especialidad);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		$ent_especialidad->setCc_especialidad($cc_especialidad);
        $ent_especialidad->setCc_persona($_REQUEST["cc_persona"]);
        $ent_especialidad->setDenominacion($_REQUEST["denominacion"]);
		$ent_especialidad->setAnios($_REQUEST["anios"]);
		$ent_especialidad->setSector($_REQUEST["sector"]);

		$ent_especialidad->setUser_crea($cc_usuario_audit);
		$ent_especialidad->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_especialidad->setEstado($estado);
        
        $val=$bo_especialidad->control($ent_especialidad, $opc);
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
