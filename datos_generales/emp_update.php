<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_empresa.php"); 
s_validar_pagina();

$bo_empresa  = new bo_gen_empresa();
$emp_ruc     = $_REQUEST["emp_ruc"];
$opc        = $_REQUEST["opc"];
$error      = "0";
$mensaje    = "";
if($opc=="D"){
	$val=$bo_empresa->eliminar($emp_ruc);
	if(!$val){
		$mensaje    = "No se pudo eliminar";
		$error      = "1";
	}
	
}else{
        
        if($opc=="I"){
			//$emp_ruc= $_REQUEST["emp_ruc"];
            $data_valida = $bo_empresa->validarRuc($emp_ruc);
            if (count($data_valida)>0){
                $mensaje    = "Ruc ".$emp_ruc." ya existe";
                $error      = "D";
            }
        }
        if($error=="0"){
        
            $ent_empresa = new gen_empresa();
            $emp_estado     = "0";
            if(isset($_REQUEST["emp_estado"])){
                $emp_estado     = "1";
            }
            $ent_empresa->setEmp_direccion($_REQUEST["emp_direccion"]);
            $ent_empresa->setEmp_email($_REQUEST["emp_email"]);
            $ent_empresa->setEmp_nom_comercial($_REQUEST["emp_nom_comercial"]);
            $ent_empresa->setEmp_razon_social($_REQUEST["emp_razon_social"]);
            $ent_empresa->setEmp_ruc($_REQUEST["emp_ruc"]);
            $ent_empresa->setEmp_telefono($_REQUEST["emp_telefono"]);
            $ent_empresa->setEmp_web($_REQUEST["emp_web"]);
			$ent_empresa->setEmp_celular($_REQUEST["emp_celular"]);
            $ent_empresa->setEmp_estado($emp_estado);
            $val=$bo_empresa->control($ent_empresa,$opc);	
            if(!$val){
                    $mensaje    = "No se pudo guardar";
                    $error      = "2";
            }
        }
	
}
if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $error ;
}
echo $mensaje;
?>