<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_perfil.php"); 
s_validar_pagina();
$bo_perfil         = new bo_seg_perfil();
$perfil            = new seg_perfil();


$data_perfil  = $bo_perfil->listar($perfil);
?>


    <?php 
$i=1;
foreach($data_perfil as $row){?>
	<tr>
		<td ><?php echo $i ?></td>
		<td><?php echo $row["ct_perfil"] ?></td>
		<td><?php echo $row["ct_modulo"];?></td>
		<td><?php echo u_vigencia($row["cfl_vigencia"]);?></td>
		<td ><a href="javascript:fn_controlRegistro('<?php echo $row["cc_perfil"]?>','U');" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
			<a href="javascript:fn_confirmarEliminar('<?php echo $row["cc_perfil"]?>');" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a></td>
	</tr>
<?php $i++;}?>
