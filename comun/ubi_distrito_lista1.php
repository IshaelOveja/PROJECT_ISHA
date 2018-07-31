<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
$coddpto1        = $_REQUEST["coddpto1"];
$codprov1         = $_REQUEST["codprov1"];
$bo_ubigeo      = new bo_general();

$data_distrito  = $bo_ubigeo->listarDistrito($coddpto1,$codprov1);
echo "<option value=''></option>";
foreach($data_distrito as $row){
    echo "<option value='".$row["ubigeo"]."'>".$row["nombre"]."</option>";
}
?>
