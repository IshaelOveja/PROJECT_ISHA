<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_organizaciones.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_organizaciones    = $_REQUEST["cc_organizaciones"];

$bo_organizaciones         = new bo_gen_personas_organizaciones();
$ent_organizaciones            = new gen_personas_organizaciones();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_organizaciones->eliminar($cc_organizaciones);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		$ent_organizaciones->setCc_organizaciones($cc_organizaciones);
        $ent_organizaciones->setCc_persona($_REQUEST["cc_persona"]);
        $ent_organizaciones->setRaz_social($_REQUEST["raz_social"]);
		$ent_organizaciones->setTip_ins($_REQUEST["tip_ins"]);
		$ent_organizaciones->setCargo($_REQUEST["cargo"]);

		$ent_organizaciones->setUser_crea($cc_usuario_audit);
		$ent_organizaciones->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_organizaciones->setEstado($estado);
        
        $val=$bo_organizaciones->control($ent_organizaciones, $opc);
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
