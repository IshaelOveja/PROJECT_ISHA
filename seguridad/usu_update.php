<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 
require_once(u_src()."bo/bo_seg_modulo_perfil.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
s_validar_pagina_ayax();

$opc           = $_REQUEST["opc"];
$cc_usuario    = $_REQUEST["cc_usuario"];

$bo_usuario    = new bo_seg_usuario();
$bo_empleado    = new bo_gen_personas();
$bo_mod_perfil =new bo_seg_modulo_perfil();

$usuario       = new seg_usuario();

$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();
$ct_ip             = u_ip();

if($opc=="D"){
    $val=$bo_usuario->eliminar($cc_usuario);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{
	if ($opc=="I"){
	$val=$bo_usuario->validarUsuario($_REQUEST["cc_user"]);
    if(count($val)>0){
		 $mensaje    = "El usuario ya existe";
          $error      = "4";
		}
	}
	if($error=="0"){
        /*$ct_clave=$_REQUEST["ct_clave"];
        if ($opc=="I"){
            $data=$bo_empleado->listarId($cc_usuario);
            foreach($data as $row){
                $num_documento=$row["num_documento"];
            }
        }*/
        
        $usuario->setCc_usuario($cc_usuario);
        $usuario->setCc_user($_REQUEST["cc_user"]);
        $usuario->setCc_perfil($_REQUEST["cc_perfil"]);
        $usuario->setCt_clave($_REQUEST["ct_clave"]);
        $cfl_acceso='0';
        if(isset($_REQUEST["cfl_acceso"])){
               $cfl_acceso='1'; 
       }
        $usuario->setCfl_acceso($cfl_acceso);
        $usuario->setCc_usuario_audit($cc_usuario_audit);
        $usuario->setCt_ip($ct_ip);
        $usuario->setNn_tiempo_sesion("3600");
        
        $val=$bo_usuario->control($usuario, $opc);
         if(!$val){
             $mensaje    = "No se puede grabar";
             $error      = "1";
        }

	}
}
   
if($error=="0"){
    $mensaje = $error;
}else{
    $mensaje  = $mensaje;
}
echo $mensaje;
?>
