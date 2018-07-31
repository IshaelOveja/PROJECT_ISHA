<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
$coddpto         = $_REQUEST["coddpto"];
$bo_ubigeo      = new bo_general();

$data_provincia = $bo_ubigeo->listarProvincia($coddpto);
echo "<option value=''></option>";
foreach($data_provincia as $row){
    echo "<option value='".$row["codprov"]."'>".$row["nombre"]."</option>";
}
?>