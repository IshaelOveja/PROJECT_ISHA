<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_documento.php"); 
$tp_doc         = $_REQUEST["tp_doc"];
$bo_documento      = new bo_fin_documento();
$cc_persona=s_usuario_id();
$data_documento = $bo_documento->ListarDocumentoID($cc_persona, $tp_doc);
foreach($data_documento as $row){
	$serie=$row["serie"];
    $numero=$row["numero"]+1;
	echo $serie."-".$numero;
}
?>