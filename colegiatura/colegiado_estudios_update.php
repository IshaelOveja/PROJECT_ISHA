<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_estudios.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_estudios    = $_REQUEST["cc_estudios"];

$bo_estudios         = new bo_gen_personas_estudios();
$ent_estudios            = new gen_personas_estudios();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_estudios->eliminar($cc_estudios);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		 $ent_estudios->setCc_estudios($cc_estudios);
        $ent_estudios->setCc_persona($_REQUEST["cc_persona"]);
        $ent_estudios->setCc_universidad($_REQUEST["cc_universidad"]);
		$ent_estudios->setFacultad($_REQUEST["facultad"]);
		$ent_estudios->setGrado($_REQUEST["grado"]);
		$ent_estudios->setFecha($_REQUEST["fecha"]);

		$ent_estudios->setUser_crea($cc_usuario_audit);
		$ent_estudios->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_estudios->setEstado($estado);
        
        $val=$bo_estudios->control($ent_estudios, $opc);
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
