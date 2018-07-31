<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 
require_once(u_src()."bo/bo_seg_perfil.php"); 
$cc_user = $_REQUEST["cc_user"];
$ct_clave    = $_REQUEST["ct_clave"];

if(strlen(trim($ct_clave))>0){
	$ct_clave = sha1($ct_clave);
}
$data_usuario = array();
$pagina       = "salir.php";
$opc          = "N";

if((strlen(trim($cc_user))>0) && (strlen(trim($cc_user))>0)){
	$bo_usuario   = new bo_seg_usuario();
	$data_usuario = $bo_usuario->validar($cc_user,$ct_clave);
	if(is_array($data_usuario)){
		if(count($data_usuario)>0){
	 		if($data_usuario[0]==="S"){
	 			$pagina               = "index.php";
				$opc                  = "S";
				
				$_SESSION["SES_USUARIO"]    = $data_usuario[1];
				$_SESSION["SES_ct_nombres"]= $data_usuario[2];
				$_SESSION["SES_USER"]   = $data_usuario[3];
				$_SESSION["SES_NN_TIEMPO"]    = $data_usuario[4];
				$_SESSION["ULTIMOACCESO"]  = date("Y-n-j H:i:s"); //sesion de hora de acceso
                $_SESSION["SEG_PERFIL"]  = $data_usuario[5];            
                                //$cc_perfil = $data_usuario[5];
                                $cc_cambia_clave = $data_usuario[6];
                                //if($cc_cambia_clave=='0'){
                                    //$pagina               = "nuevoclave.php";
                                //}
                                $bo_perfil  = new bo_seg_perfil();
                                $data_perfil= $bo_perfil->listarId(s_perfil());
                                foreach($data_perfil as $row){
                                    $_SESSION["SES_MOD_ID"]=$row["cc_modulo_defecto"];
                                }
                               
								
		 	}
		}
	}
}

//$opc="S";
//$pagina="index.php";
if($opc=="N"){
	Header ("Location: ".$pagina); 
	exit;
}
?>
<script language="javascript">document.location = "<?php echo $pagina ?>";</script>