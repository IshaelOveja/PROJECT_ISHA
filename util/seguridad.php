<?php 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Content-Type: text/html; charset=iso-8859-1");
session_start();
function s_validar_pagina(){
    $tiempo_transcurrido=0;
    $time =0;
    $url="X";
    if(!(isset($_SESSION["SES_USUARIO"])) or ($url=="")){
            echo '<script language="javascript">document.location = "salir.php";</script>';
            exit;
    }else{
          $time = $_SESSION["SES_NN_TIEMPO"];
          $fechaGuardada = $_SESSION["ULTIMOACCESO"]; 
          $ahora = date("Y-n-j H:i:s",time()); 
          $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    }
    if($tiempo_transcurrido >= $time) { 
            echo '<script language="javascript">document.location = "salir.php";</script>';
            exit;
    }else { 
            $_SESSION["ULTIMOACCESO"] = $ahora; 
    } 
}
function s_validar_pagina_ayax(){
    $tiempo_transcurrido=0;
    $url="X";
    $time =0;
    if(!(isset($_SESSION["SES_USUARIO"])) or ($url=="")){
            echo 'Acceso denegado';
            exit;
    }else{
          $time = $_SESSION["SES_NN_TIEMPO"];
          $fechaGuardada = $_SESSION["ULTIMOACCESO"]; 
          $ahora = date("Y-n-j H:i:s",time()); 
          $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    }
    if($tiempo_transcurrido >= $time) { 
            echo 'Sesion terminado';
            exit;
    }else { 
            $_SESSION["ULTIMOACCESO"] = $ahora; 
    } 
}
function s_usuario_id(){
	$usu_id="0";
	if(isset($_SESSION["SES_USUARIO"])){
		$usu_id=$_SESSION["SES_USUARIO"];
	}
	return $usu_id;
}
function s_perfil(){
	$usu_id="0";
	if(isset($_SESSION["SEG_PERFIL"])){
		$perfil=$_SESSION["SEG_PERFIL"];
	}
	return $perfil;
}

function s_usu_nombre(){
	$usu_nombre="X";
	if(isset($_SESSION["SES_USUARIO"])){
		$usu_nombre=$_SESSION["SES_ct_nombres"];
	}
	return $usu_nombre;
}
function s_usuario(){
	$usu_nombre="X";
	if(isset($_SESSION["SES_USUARIO"])){
		$usu_nombre=$_SESSION["SES_USER"];
	}
	return $usu_nombre;
}

function s_cod_unico(){/****codigo tempporal para la facturacion***/
    $sid="0";
    if(isset($_SESSION["SES_USUARIO"])){
        if(isset($_SESSION["SES_COD_UNICO"])){
            $sid = $_SESSION["SES_COD_UNICO"];
        }
    }
    return $sid;
}
function s_mod_id1(){/*codigo de los menus*/
	$sid="0";
	if(isset($_SESSION["SES_MOD_ID1"])){
		$sid=$_SESSION["SES_MOD_ID1"];
	}
	return $sid;
}
function s_mod_id2(){/*codigo de los menus*/
	$sid="0";
	if(isset($_SESSION["SES_MOD_ID2"])){
		$sid=$_SESSION["SES_MOD_ID2"];
	}
	return $sid;
}
function s_mod_id3(){/*codigo de los menus*/
	$sid="0";
	if(isset($_SESSION["SES_MOD_ID3"])){
		$sid=$_SESSION["SES_MOD_ID3"];
	}
	return $sid;
}


?>
