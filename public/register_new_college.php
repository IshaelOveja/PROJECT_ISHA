<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php");
$bo_persona = new bo_gen_personas();
$ent_persona = new gen_personas();
$ent_persona->setApellido_Paterno($_REQUEST['frc_surname_f']);
$ent_persona->setApellido_Materno($_REQUEST['frc_surname_m']);
$ent_persona->setNombre1($_REQUEST['frc_name_o']);
$ent_persona->setNombre2($_REQUEST['frc_name_t']);
$ent_persona->setPais_nacimiento($_REQUEST['frc_country']);
$ent_persona->setCod_documento($_REQUEST['frc_type_doc']);
$ent_persona->setNum_documento($_REQUEST['frc_num_doc']);
$ent_persona->setCelular1($_REQUEST['frc_mobile']);
$ent_persona->setEmail1($_REQUEST['frc_email']);
$res =  $bo_persona->insertCollege($ent_persona);
echo $res;

