<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_familiares.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_familiares    = $_REQUEST["cc_familiares"];

$bo_familiares         = new bo_gen_personas_familiares();
$ent_familiares            = new gen_personas_familiares();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_familiares->eliminar($cc_familiares);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		 $ent_familiares->setCc_familiares($cc_familiares);
        $ent_familiares->setCc_persona($_REQUEST["cc_persona"]);
        $ent_familiares->setNombres($_REQUEST["nombres"]);
		$ent_familiares->setFec_nac($_REQUEST["fec_nac"]);
		$ent_familiares->setParentesco($_REQUEST["parentesco"]);

		$ent_familiares->setUser_crea($cc_usuario_audit);
		$ent_familiares->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_familiares->setEstado($estado);
        
        $val=$bo_familiares->control($ent_familiares, $opc);
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
