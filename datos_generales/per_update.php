<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php");

s_validar_pagina_ayax();
$bo_personas    = new bo_gen_personas();
$ent_personas           = new gen_personas();
$cc_persona        = $_REQUEST["cc_persona"];
$opc                = $_REQUEST["opc"];
$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();
$ct_ip             = u_ip();

if($opc=="D"){
    
}else{
    $cp_tipo_doc  = $_REQUEST["cp_tipo_doc"];
    $ct_nro_doc   = $_REQUEST["ct_nro_doc"];
    $data_documento = $bo_personas->validarDocumento($cp_tipo_doc, $ct_nro_doc,$cc_persona);
    if (count($data_documento)>0){
        $mensaje    = "Número de documento ya existe";
        $error      = "D";
    }
}
if ($error=="0"){

    $ent_personas->setCc_persona($cc_persona);
    $cfl_vigencia="0";
    if (isset($_REQUEST["cfl_vigencia"])){
        $cfl_vigencia="1";
    }
    if($opc=="1"){
        $cfl_vigencia="1";
    }
    $ent_personas->setCfl_vigencia($cfl_vigencia);
    $ent_personas->setCp_sexo($_REQUEST["cp_sexo"]);

    $ent_personas->setCt_email($_REQUEST["ct_email"]);
	$ent_personas->setCt_emailc($_REQUEST["ct_emailc"]);
    $ent_personas->setCt_nombres(strtoupper($_REQUEST["ct_nombres"]));
	$ent_personas->setCt_nombresc(strtoupper($_REQUEST["ct_nombresc"]));
    $ent_personas->setCt_nro_doc(ltrim(rtrim($_REQUEST["ct_nro_doc"])));
	$ent_personas->setCt_celular($_REQUEST["ct_celular"]);
	$ent_personas->setCt_celularc($_REQUEST["ct_celularc"]);
	$ent_personas->setCt_direccion($_REQUEST["ct_direccion"]);
    $ent_personas->setCt_fech_nac($_REQUEST["ct_fech_nac"]);
	$ent_personas->setCt_est_civil($_REQUEST["ct_est_civil"]);
	$ent_personas->setCt_obs($_REQUEST["ct_obs"]);


    $val=$bo_personas->control($ent_personas,$opc);	
    if(!$val){
         $mensaje    = "No se pudo grabar";
         $error      = "1";
    }
}

if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $error ;
}
echo $mensaje;
?>
