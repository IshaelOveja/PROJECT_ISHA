<?php 
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_articulo.php"); 
require_once(u_src()."bo/bo_fin_compras_detalle.php"); 

s_validar_pagina();

$bo_articulo		= new bo_gen_articulo();
$bo_compras_del		= new bo_fin_compras_detalle();
$ent_articulo    = new gen_articulo();

$data_arti=	$bo_compras_del->listarArticulos();
foreach($data_arti as $ar){
	$cc_articulo=$ar["cc_articulo"];
	$ct_importe=$ar["ct_importe"];
	$bo_articulo->ActualizarCompras($cc_articulo, $ct_importe);
	}
	

$data_art=$bo_articulo->articuloTodos();
foreach($data_art as $at){
	$cc_articulo=$at["cc_articulo"];
	$ct_compra=$at["ct_compra"];
	$ct_rentabilidad=($at["ct_rentabilidad"]/100);
	if($ct_rentabilidad>0){
		$ct_rentabilidadx=$ct_rentabilidad;
		}else{
			$ct_rentabilidadx=0.3;	
		}
	$x=$ct_compra*$ct_rentabilidadx;
	$costo=$ct_compra+$x;
	
	$bo_articulo->ProcesarRentabilidad($cc_articulo,$costo);
}

	
?>