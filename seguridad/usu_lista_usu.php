<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php"); 
s_validar_pagina();
$bo_persona    = new bo_gen_personas();
$ct_nombre      = $_REQUEST["ct_nombreper"];
//$cc_categoria   = $_REQUEST["cc_categoriaper"];



$data_persona  = $bo_persona->listarAsignarUsuario($ct_nombre);

$i=1;
?>

<table class='table'>
<thead>
    <tr>
    	<th>#</th>
        <th>C&oacute;digo</th>
        <th>Nombres</th>
        <th>Estado</th>
    </tr>
</thead>
<tbody>
    <?php
	if(count($data_persona)>0){
    foreach($data_persona as $row){
    ?>
        <tr>
           <td width="5%"><?php echo $i ?></td>
           <td ><?php echo $row["c_colegio"] ?></td>
           <td><a href='javascript:fn_asignarUsuario(<?php echo $i ?>);' id='cc_emplevarev<?php echo $i ?>' title='<?php echo $row["cc_persona"] ?>'><?php echo $row["nombre"] ?></a></td>
           <td ><?php echo $row["flag_habil"] ?></td>
        </tr>
 <?php
    $i++;
 }}else{
 ?>
 <tr>
 	<td colspan="4" class="text-center">B&uacute;queda sin &eacute;xito</td>
 </tr>
 <?php }?>
</tbody>
</table>