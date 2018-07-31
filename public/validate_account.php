<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php");
$bo_persona = new bo_gen_personas();
$ent_persona = new gen_personas();
$ent_persona->setNum_documento($_REQUEST['frc_num_doc']);
$ent_persona->setEmail1($_REQUEST['frc_email']);
$res =  $bo_persona->validateAccount($ent_persona);
print_r($res);
