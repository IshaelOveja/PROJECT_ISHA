<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php"); 

s_validar_pagina();

$c_colegiado="";
if(isset($_REQUEST["c_colegiado"])){
	$c_colegiado=digitos($_REQUEST["c_colegiado"],6);
}

$bo_personas = new bo_gen_personas();
$ent_personas = new gen_personas();

$ent_personas->setC_colegiado($c_colegiado);

$data_personac=$bo_personas->buscarPersona($ent_personas);
foreach($data_personac as $r){
	$cc_persona=$r["cc_persona"];
}

$data_persona=$bo_personas->listarId($cc_persona);
if(count($data_persona)>0){
	foreach($data_persona as $per){
		$nombre=$per["nombre"];
	}

?>

<div class="col-md-12">
<div><h3><?php echo $nombre ?></h3></div>
<div class="btn-group text-center" role="group" aria-label="Basic example">
<a href="javascript:fn_ListarPerfil(<?php echo $cc_persona ?>);" title="Perfil" class="btn btn-info" role="button" ><span class="hidden-sm-up"><i class="fa fa-user"></i></span> <span class="hidden-xs-down">Perfil</span></a>
<a href="javascript:fn_ListarFamiliares(<?php echo $cc_persona ?>);"  title="Familiares" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-users"></i></span> <span class="hidden-xs-down">Familiares</span></a>
<a href="javascript:fn_ListarTrabajos(<?php echo $cc_persona ?>);" title="Trabajos" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-address-card-o"></i></span> <span class="hidden-xs-down">Trabajos</span></a>
<a href="javascript:fn_ListarDiplomas(<?php echo $cc_persona ?>);" title="Diplomas" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-graduation-cap"></i></span> <span class="hidden-xs-down">Diplomas</span></a>
<a href="javascript:fn_ListarEspecialidad(<?php echo $cc_persona ?>);" title="Especialidad" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-address-card-o"></i></span> <span class="hidden-xs-down">Especialidad</span></a>
<a href="javascript:fn_ListarDistinciones(<?php echo $cc_persona ?>);" title="Distinciones" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-user-md"></i></span> <span class="hidden-xs-down">Distinciones</span></a>
<a href="javascript:fn_ListarColegios(<?php echo $cc_persona ?>);" title="Colegios" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-retweet"></i></span> <span class="hidden-xs-down">Colegios</span></a>
<a href="javascript:fn_ListarOrganizaciones(<?php echo $cc_persona ?>);" title="Organizaciones" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-university"></i></span> <span class="hidden-xs-down">Organizaciones</span></a>
<a href="javascript:fn_ListarEstudios(<?php echo $cc_persona ?>);" title="Estudios" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-user-circle-o"></i></span> <span class="hidden-xs-down">Estudios</span></a>
<a href="javascript:fn_ListarActividades(<?php echo $cc_persona ?>);" title="Preferencias" class="btn btn-info" role="button"><span class="hidden-sm-up"><i class="fa fa-gratipay"></i></span> <span class="hidden-xs-down">Preferencias</span></a>
</div>

<div id="divListarSubMenu"></div>
<?php }else{?>
<div class="btn-warning text-center">No existe registro</div>
</div>

<?php }?>
<script>
$(function() {
fn_ListarPerfil(<?php echo $cc_persona ?>);
  var botones = $(".btn-group a");
  botones.click(function() {
    botones.removeClass('active');
    $(this).addClass('active');
  });
});

</script>
