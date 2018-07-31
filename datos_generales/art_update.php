<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_articulo.php"); 
s_validar_pagina_ayax();

$opc             = $_REQUEST["opc"];
$cc_articulo     = $_REQUEST["cc_articulo"];

$bo_articulo= new bo_gen_articulo();
$ent_articulo= new gen_articulo();

$error             = "0";
$mensaje           = "";

if($error==0){
		$ct_vigencia="0";
		if (isset($_REQUEST["ct_vigencia"])){
			$ct_vigencia="1";
		}
		$ct_igv="No";
		if (isset($_REQUEST["ct_igv"])){
			$ct_igv="Si";
		}
		$ent_articulo->setCc_articulo($cc_articulo);
		$ent_articulo->setCt_codigo($_REQUEST["ct_codigo"]);
		$ent_articulo->setEmp_id($_REQUEST["emp_id"]);
		$ent_articulo->setCt_grupo($_REQUEST["ct_grupo"]);
		$ent_articulo->setCt_nombre($_REQUEST["ct_nombre"]);
		$ent_articulo->setCt_molecula($_REQUEST["ct_molecula"]);
		$ent_articulo->setCt_umedida($_REQUEST["ct_umedida"]);
		$ent_articulo->setCt_compra($_REQUEST["ct_compra"]);
		$ent_articulo->setCt_rentabilidad($_REQUEST["ct_rentabilidad"]);
		$ent_articulo->setCt_venta($_REQUEST["ct_venta"]);
		$ent_articulo->setCt_stock($_REQUEST["ct_stock"]);
		$ent_articulo->setCt_igv($ct_igv);
		$ent_articulo->setCt_stockmin($_REQUEST["ct_stockmin"]);
		$ent_articulo->setCt_vigencia($ct_vigencia);
		
		$val=$bo_articulo->control($ent_articulo,$opc);	
		 if(!$val){
			 $mensaje    = "No se puede grabar";
			 $error      = "1";
		}
	}
   
if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $mensaje;
}
echo $mensaje;
?>
