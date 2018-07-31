<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_diplomas.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_diplomas    = $_REQUEST["cc_diplomas"];

$bo_diplomas         = new bo_gen_personas_diplomas();
$ent_diplomas            = new gen_personas_diplomas();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_diplomas->eliminar($cc_diplomas);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		$ent_diplomas->setCc_diplomas($cc_diplomas);
        $ent_diplomas->setCc_persona($_REQUEST["cc_persona"]);
        $ent_diplomas->setCc_universidad($_REQUEST["cc_universidad"]);
		$ent_diplomas->setDenominacion($_REQUEST["denominacion"]);
		$ent_diplomas->setNivel($_REQUEST["nivel"]);
		$ent_diplomas->setEspecialidad($_REQUEST["especialidad"]);
		$ent_diplomas->setFecha($_REQUEST["fecha"]);
		$ent_diplomas->setNro_reg($_REQUEST["nro_reg"]);

		$ent_diplomas->setUser_crea($cc_usuario_audit);
		$ent_diplomas->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_diplomas->setEstado($estado);
        
        $val=$bo_diplomas->control($ent_diplomas, $opc);
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
