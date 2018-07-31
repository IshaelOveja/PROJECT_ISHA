<?php
header('Content-type: application/json');
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 

$cc_user       = s_usuario();
$bo_usuario    = new bo_seg_usuario();
$usuario       = new seg_usuario();
$ct_clave      = $_REQUEST["ct_clavea"];
$error         = false;

$usuario->setCc_user($cc_user);
$usuario->setCt_clave($ct_clave);

$data =$bo_usuario->validarClaveAnte($usuario);

if(count($data)>0){
         $error = true;
}

echo json_encode(array(
    'valid' => $error,
));
?>
