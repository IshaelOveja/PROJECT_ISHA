<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php"); 
s_validar_pagina_ayax();
$opc             = $_REQUEST["opc"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_persona= new bo_gen_personas();
$ent_persona       = new gen_personas();
$error             = "0";
$mensaje           = "";
$cc_usuario_audit  = s_usuario_id();
$ct_ip             = u_ip();

if($opc=="D"){
    $val=$bo_perfil->eliminar($cc_perfil);
     if(!$val){
         $mensaje    = "No se puede eliminar";
         $error      = "1";
    }
}else{
        $ent_persona->setCc_persona($cc_persona);
        $ent_persona->setCod_tipo($_REQUEST["cod_tipo"]);
		$ent_persona->setC_colegiado($_REQUEST["c_colegiado"]);
		$ent_persona->setFecha_de_colegiacion($_REQUEST["fecha_de_colegiacion"]);
		$ent_persona->setFlag_activo($_REQUEST["flag_activo"]);
		$ent_persona->setCod_sexo($_REQUEST["cod_sexo"]);
		$ent_persona->setApellido_Materno($_REQUEST["apellido_Materno"]);
		$ent_persona->setApellido_Paterno($_REQUEST["apellido_Paterno"]);
		$ent_persona->setNombre1($_REQUEST["Nombre1"]);
		$ent_persona->setNombre2($_REQUEST["Nombre2"]);
		$ent_persona->setNombre($_REQUEST["apellido_Materno"]." ".$_REQUEST["apellido_Paterno"]." ".$_REQUEST["Nombre1"]." ".$_REQUEST["Nombre2"]);
		$ent_persona->setFecha_nacimiento($_REQUEST["fecha_nacimiento"]);
		$ent_persona->setPais_nacimiento($_REQUEST["pais_nacimiento"]);
		$ent_persona->setUbigeonac($_REQUEST["ubigeonac"]);
		$ent_persona->setCod_documento($_REQUEST["cod_documento"]);
		$ent_persona->setNum_documento($_REQUEST["num_documento"]);
		$ent_persona->setE_civil($_REQUEST["e_civil"]);
		$ent_persona->setRuc($_REQUEST["ruc"]);
		$ent_persona->setAfp_onp($_REQUEST["afp_onp"]);
		$ent_persona->setCelular1($_REQUEST["celular1"]);
		$ent_persona->setCelular2($_REQUEST["celular2"]);
		$ent_persona->setEmail1($_REQUEST["email1"]);
		$ent_persona->setEmail2($_REQUEST["email2"]);
		$ent_persona->setTipo_direc($_REQUEST["tipo_direc"]);
		$ent_persona->setDireccion($_REQUEST["direccion"]);
		$ent_persona->setUbigeodirec($_REQUEST["ubigeodirec"]);
		$ent_persona->setFactor_sanguineo($_REQUEST["factor_sanguineo"]);
		$ent_persona->setFecha_de_cese($_REQUEST["fecha_de_cese"]);
		$ent_persona->setFecha_fallecido($_REQUEST["fecha_fallecido"]);
		$ent_persona->setC_entidad_pagadora($_REQUEST["c_entidad_pagadora"]);
		$ent_persona->setC_sector_entidad_pagadora($_REQUEST["c_sector_entidad_pagadora"]);
		$ent_persona->setN_folio_cole($_REQUEST["n_folio_cole"]);
		$ent_persona->setN_libro_cole($_REQUEST["n_libro_cole"]);
		$ent_persona->setN_resolucion_cole($_REQUEST["n_resolucion_cole"]);
		$ent_persona->setUser_crea($cc_usuario_audit);
		$ent_persona->setUser_mod($cc_usuario_audit);
		
		
        $flag='1';
        if($opc=="U"){
           $flag='0'; 
           if(isset($_REQUEST["flag"])){
               $flag='1'; 
           }
        }
        $ent_persona->setFlag($flag);
        
        $val=$bo_persona->control($ent_persona, $opc);
         if(!$val){
             $mensaje    = "No se puede grabar";
             $error      = "1";
        }
        
  
   
}
if($error=="0"){
    $mensaje = "0";
}else{
    $mensaje  = $error;
}
echo $mensaje;
?>
