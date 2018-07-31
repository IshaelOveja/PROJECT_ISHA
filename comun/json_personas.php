<?php
header('Access-Control-Allow-Origin: *');
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php");
s_validar_pagina_ayax();
$bo_personas  = new bo_gen_personas();
$ent_personas = new gen_personas();

$buscar = $_POST["query"];



if (is_numeric($buscar)) {
    $ent_personas->setRuc($buscar);
    $data_personas = $bo_personas->buscarPersona($ent_personas);
} else {
    $ent_personas->setNombre($buscar);
    $data_personas = $bo_personas->buscarPersona($ent_personas);
}
$json = [];
foreach ($data_personas as $row) {
    $json[] =['cc_persona'=>$row['cc_persona'], 'ruc'=>$row['ruc'], 'nombre'=>$row['nombre']];
}
//header('Content-type: application/json');
echo json_encode($json);
//}
?>
