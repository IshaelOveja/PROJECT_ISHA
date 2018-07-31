<?php
header('Content-type: application/json');
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 

$cc_user       = $_REQUEST["cc_user"];
$bo_usuario    = new bo_seg_usuario();
$error         = true;

$data =$bo_usuario->validarUsuario($cc_user);

if(count($data)>0){
         $error = false;
}

echo json_encode(array(
    'valid' => $error,
));
?>
