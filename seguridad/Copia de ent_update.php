<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_modulo.php"); 
s_validar_pagina();
$bo_modulo  = new bo_seg_modulo();
$error      = "0";
$mensaje    = "";
$nom_clase  = "";
$nom_archivo = "";
$cam_def     = "";
$val         = true;
$data_tabla = $bo_modulo->listar_tablas();
foreach($data_tabla as $tabla){
	$nom_archivo = "../src/entidad/".$tabla.".php";
	$ar=fopen($nom_archivo,"w+") or $val  = false;
	fputs($ar,"<?php ");
	fputs($ar,"\n");
	$nom_clase = "class ".$tabla." { ";
	fputs($ar,$nom_clase);
	fputs($ar,"\n");
	$data_campo = $bo_modulo->listar_campo($tabla);
	foreach($data_campo as $row){
		$cam_def = "	private $".$row["campo"].";";
		fputs($ar,$cam_def);
		fputs($ar,"\n");
	}
	fputs($ar,"	function __construct(){");
	fputs($ar,"\n");
	foreach($data_campo as $row){
		$cam_def = '		$this->'.$row["campo"];
		fputs($ar,$cam_def);
		if(($row["tipo"]=="int") or ($row["tipo"]=="real")){
			$cam_def = '= 0;';
		}else{
			$cam_def = '= "";';
		}
		fputs($ar,$cam_def);
		fputs($ar,"\n");
	}
	fputs($ar,"	}");
	fputs($ar,"\n");
	fputs($ar,"	function __destruct() {");
	fputs($ar,"\n");
	fputs($ar,"	}");
	fputs($ar,"\n");
	foreach($data_campo as $row){
		$cam_def = '	public function  get'.ucfirst($row["campo"]).'() {';
		fputs($ar,$cam_def);
		fputs($ar,"\n");
		$cam_def = '			return $this->'.$row["campo"].';';
		fputs($ar,$cam_def);
		fputs($ar,"\n");
		fputs($ar,"	}");
		fputs($ar,"\n");
		
		$cam_def = ' public function  set'.ucfirst($row["campo"]).'('.'$'.$row["campo"].') {';
		fputs($ar,$cam_def);
		fputs($ar,"\n");
		$cam_def = '       		$this->'.$row["campo"].' = '.'$'.$row["campo"].'; ';
		fputs($ar,$cam_def);
		fputs($ar,"\n");
		fputs($ar,"	}");
		fputs($ar,"\n");
	}
	fputs($ar,"}");
	fputs($ar,"\n");
	fputs($ar,"?>");
	fclose($ar);
}
	
if(!$val){
	$mensaje    = "No se pudo guardar";
	$error      = "2";
}

if($error=="0"){
	$mensaje="1";
}
echo $mensaje;
