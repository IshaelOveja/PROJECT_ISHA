<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php"); 
s_validar_pagina();
$bo_persona  = new bo_gen_personas();
$ent_persona    = new gen_personas();

$c_colegiado="";
if(isset($_REQUEST["c_colegiado"])){
$c_colegiado=digitos($_REQUEST["c_colegiado"],6);
if($c_colegiado=='000000'){
		$c_colegiado="";
}
}




$nombre = "";
if(isset($_REQUEST["nombre"])){
	$nombre=$_REQUEST["nombre"];
}

$ent_persona->setC_colegiado($c_colegiado);
$ent_persona->setNombre($nombre);

$data_persona   = $bo_persona->buscarPersona($ent_persona);
?>
	<table class="table table-bordered">
	<tr class="active">
		<th>#</th>
        <th>DNI</th>
        <th>C&oacute;digo</th>
        <th>Apellidos y Nombres <?php echo $nombre ?></th>
        </tr>
	
	<?php
	$i=1;

	foreach($data_persona as $row){
	?>
	<tr>
            <td><?php echo $i ?></td>
            <td ><?php echo $row["num_documento"]?></td>
            <td ><?php echo $row["c_colegiado"]?></td>
            <td >
            <a href="javascript:fn_asignar_persona('<?php echo $row["cc_persona"]?>','<?php echo $row["nombre"]?>','<?php echo $row["c_colegiado"]?>');">
            <?php echo $row["nombre"]?> </a></td>
          </tr>
	
	
	<?php

            $i++;
	}
	?>
	</table>
