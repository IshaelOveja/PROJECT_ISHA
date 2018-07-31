<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 
s_validar_pagina_ayax();

$cc_user       = $_REQUEST["cc_user"];
$cc_usuario    = s_usuario_id();

$bo_usuario    = new bo_seg_usuario();
$usuario       = new seg_usuario();
$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();
$ct_ip             = u_ip();

$usuario->setCc_usuario($cc_usuario);
$usuario->setCc_user($cc_user);
$usuario->setCt_clave($_REQUEST["ct_clave"]);
$usuario->setCc_usuario_audit($cc_usuario_audit);
$usuario->setCt_ip($ct_ip);
$val=$bo_usuario->cambiarClave($usuario);
 if(!$val){
     $mensaje    = "No se puede grabar";
     $error      = "1";
}
        
  
   

if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $error;
}
echo $mensaje;
?>
