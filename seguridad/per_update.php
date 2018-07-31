<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_perfil.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_perfil    = $_REQUEST["cc_perfil"];

$bo_perfil    = new bo_seg_perfil();
$perfil       = new seg_perfil();
$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();
$ct_ip             = u_ip();

if($opc=="D"){
    $val=$bo_perfil->eliminar($cc_perfil);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{
        $perfil->setCc_perfil($cc_perfil);
        $perfil->setCt_perfil($_REQUEST["ct_perfil"]);
        $perfil->setCc_modulo_defecto($_REQUEST["cc_modulo_defecto"]);
        $cfl_vigencia='1';
        if($opc=="U"){
           $cfl_vigencia='0'; 
           if(isset($_REQUEST["cfl_vigencia"])){
               $cfl_vigencia='1'; 
           }
        }
        $perfil->setCfl_vigencia($cfl_vigencia);
        
        $val=$bo_perfil->control($perfil, $opc);
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
