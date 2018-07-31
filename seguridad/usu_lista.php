<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 
s_validar_pagina();
$bo_usuario          = new bo_seg_usuario();
$ent_usuario             = new seg_usuario();

$pag=1;
if(isset($_REQUEST["pagPagina"])){
	$pag=$_REQUEST["pagPagina"];
}
$mostrar=10;
if(isset($_REQUEST["pagMostrar"])){
	$mostrar=$_REQUEST["pagMostrar"];
}
$bo_usuario->selectable_pages($mostrar);
$bo_usuario->records_per_page($mostrar);
$bo_usuario->pagina_actual($pag);


$cc_perfil="";
if(isset($_REQUEST["cc_perfilb"])){
	$cc_perfil = $_REQUEST["cc_perfilb"];
	}
$ct_nombre="";
if(isset($_REQUEST["ct_nombreb"])){
	$ct_nombre           = $_REQUEST["ct_nombreb"];
	}

$ent_usuario->setCc_perfil($cc_perfil);
$ent_usuario->setNombre($ct_nombre);

$data_usuario  = $bo_usuario->listar($ent_usuario);

?>
  
        <?php  $i=1;
if(count($data_usuario)>0){
foreach($data_usuario as $row){ ?>      
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row["cc_user"] ?></td>
            <td><?php echo $row["nombre"] ?></td>
            <td><?php echo $row["ct_perfil"] ?></td>
            <td><?php echo $row["celular1"] ?></td>
            <td ><?php echo u_vigencia($row["cfl_acceso"]);?></td>
            
            <td ><a href="javascript:fn_controlUsuario('<?php echo $row["cc_usuario"]?>','U');" data-toggle="tooltip" data-original-title="Modificar"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
            	 <a href="javascript:fn_controlUsuario('<?php echo $row["cc_usuario"]?>','T');" data-toggle="tooltip" data-original-title="Reset clave"> <i class="fa fa-unlock text-inverse m-r-10"></i></a>
			<?php if($row["cc_usuario"]<>"000001"){?>
			<a href="javascript:fn_eliminar('<?php echo $row["cc_usuario"]?>','');" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a></td>
        	<?php }?>
        </tr>
 <?php
    $i++;
 }?>
 <tr>
    <td class="text-center" colspan="13">       
    <?php echo $bo_usuario->render(); ?><br/> 
    </td>
</tr>
  <?php }else{
 ?>
<tr>
<td colspan="6" align="center"> B&uacute;queda sin &eacute;xito</td>
</tr>


<?php }?>


     
