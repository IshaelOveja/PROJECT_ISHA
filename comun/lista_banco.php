<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_contabilidad.php"); 
s_validar_pagina_ayax();

$bo_contabilidad   = new bo_contabilidad();
$data_modelo=$bo_contabilidad->banco_cuentas();
echo "<option value=''>aaaaaaaaa</option>";
foreach($data_modelo as $row){
    echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
}

?>