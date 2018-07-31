<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_trabajos.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_trabajos    = $_REQUEST["cc_trabajos"];

$bo_trabajos         = new bo_gen_personas_trabajos();
$ent_trabajos            = new gen_personas_trabajos();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();


if($opc=="D"){
    $val=$bo_trabajos->eliminar($cc_trabajos);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{	
		$ent_trabajos->setCc_trabajos($cc_trabajos);
        $ent_trabajos->setCc_persona($_REQUEST["cc_persona"]);
        $ent_trabajos->setCc_giros($_REQUEST["cc_giros"]);
		$ent_trabajos->setRaz_soc($_REQUEST["raz_soc"]);
		$ent_trabajos->setCargo($_REQUEST["cargo"]);
		$ent_trabajos->setFch_ini($_REQUEST["fch_ini"]);
		$ent_trabajos->setFch_fin($_REQUEST["fch_fin"]);

		$ent_trabajos->setUser_crea($cc_usuario_audit);
		$ent_trabajos->setUser_mod($cc_usuario_audit);
		
		
        $estado='1';
        if($opc=="U"){
           $estado='0'; 
           if(isset($_REQUEST["estado"])){
               $estado='1'; 
           }
        }
        $ent_trabajos->setEstado($estado);
        
        $val=$bo_trabajos->control($ent_trabajos, $opc);
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
