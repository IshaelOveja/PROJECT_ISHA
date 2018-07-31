<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_distinciones.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_distinciones    = $_REQUEST["cc_distinciones"];

$bo_distinciones         = new bo_gen_personas_distinciones();
$ent_distinciones            = new gen_personas_distinciones();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_distinciones->eliminar($cc_distinciones);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		$ent_distinciones->setCc_distinciones($cc_distinciones);
        $ent_distinciones->setCc_persona($_REQUEST["cc_persona"]);
        $ent_distinciones->setDistincion($_REQUEST["distincion"]);
		$ent_distinciones->setDenominacion($_REQUEST["denominacion"]);
		$ent_distinciones->setFecha($_REQUEST["fecha"]);

		$ent_distinciones->setUser_crea($cc_usuario_audit);
		$ent_distinciones->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_distinciones->setEstado($estado);
        
        $val=$bo_distinciones->control($ent_distinciones, $opc);
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
