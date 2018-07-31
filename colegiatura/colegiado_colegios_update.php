<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_colegios.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_colegios    = $_REQUEST["cc_colegios"];

$bo_colegios         = new bo_gen_personas_colegios();
$ent_colegios            = new gen_personas_colegios();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_colegios->eliminar($cc_colegios);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		$ent_colegios->setCc_colegios($cc_colegios);
        $ent_colegios->setCc_persona($_REQUEST["cc_persona"]);
        $ent_colegios->setFecha($_REQUEST["fecha"]);
		$ent_colegios->setColegio($_REQUEST["colegio"]);
		$ent_colegios->setNumero($_REQUEST["numero"]);

		$ent_colegios->setUser_crea($cc_usuario_audit);
		$ent_colegios->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_colegios->setEstado($estado);
        
        $val=$bo_colegios->control($ent_colegios, $opc);
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
