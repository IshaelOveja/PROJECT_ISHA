<?php

require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_general       = new bo_general();
$bo_caja       = new bo_fin_ec_reporte();
$bo_personas       = new bo_gen_personas();


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
  
  foreach($data_persona as $ro){
      $inicio =$ro["fecha_de_colegiacion"];
    $nombre = $ro["nombre"];
       $flag_activo  =$ro["flag_activo"];
	 $activo  =$ro["activo"];
     $local    =$ro["c_local"];
    $num_documento    =$ro["num_documento"];
    $cod_documento    =$ro["cod_documento"];
    $fecha_registro   =$ro["fecha_de_registro"];
  }
$data_ph=$bo_personas->estado_habil($cc_persona);
  foreach($data_ph as $ha){
  $deuda=$ha["deuda"];
    }
  }


$foto=foto_colegiado($num_documento,$c_colegiado);

$data_cabecera = $bo_general->listarRegionesID($local);
foreach($data_cabecera as $cab){
$cabnombre =$cab["nombre"];
$cablocal_tel=$cab["local"];
$cablocal_mail=$cab["local_mail"];
}
$fecha_user=date("d/m/Y h:m:s"). "&nbsp;&nbsp;". s_usuario();

	$data_es_cta= $bo_caja->ListarRecibos($cc_persona);
?>
<table class="table" border="1">
<tr>
    <td rowspan="2" ><img src="../img/logo_corladlima.jpg"  width="100" border="0" /></td>
    <td align="center" colspan="4" ><h2><strong>ESTADO DE CUENTA</strong></h2></td>
    <td rowspan="2"  align="center"  ><img src="<?php echo $foto ?>" width="80"  border="0" class="borderedbox" /></td>
  </tr>
  <tr>
    <td align="center" colspan="4" ><strong><?php echo $cabnombre ?></strong><br/><?php echo $fecha_user ?></td>
  </tr>
  <tr>
    <td colspan="3" >CEP : <strong><?php echo $c_colegiado ?> </strong>DOC: <strong>
<strong><?php  if($cod_documento=="CE"){ echo "C. EXT. -".$num_documento;} else {echo "DNI-".$num_documento;}; ?><?php echo $nombre ?></strong></td>
    <td  colspan="3">FECHA RESOL.:<strong>&nbsp;<?php echo $fecha_registro.' ('.$activo.')' ?></strong></td>
    
  </tr>
  <tr>
    <td colspan="3" >OBS :</td>	
    <td colspan="3"><h3>ESTADO :<strong> <?php echo estado_habilidad($deuda,$año). " => ".decimal($deuda,2);?></strong></h3></td>
  </tr>
</table>
<table  >
  <tr>
    <td align="center"><strong>#</strong></td>
    <td align="center"><strong>DOCUMENTO</strong></td>
    <td align="center"><strong>FECHA</strong></td>
    <td align="center"><strong>ESTADO</strong></td>
        <td align="center"><strong>USUARIO</strong></td>
    
    <td align="right"><strong>TOTAL</strong></td>
  </tr>
  <?php  $n=0; $TOTAL=0;		foreach($data_es_cta as $r){ 	
   $n=$n+1;
     $TOTAL=$TOTAL+$r["total"];?>
  <tr>
    <td align="center"><?php echo $n ?></td>
    <td align="center"> <a href="../caja/facturas_print.php?id=<?php echo $r["cc_factura"] ?>" target="_blank"><?php echo $r["cod_documento"]."-".$r["num_documento"]; ?></a></td>
    <td align="center"><?php echo $r["fecha"] ?></td>
  
    <td align="center"><strong>
      
      <?php if($r["flag"]=="A"){echo "<strong>"."*ANULADO*"."</strong>";} else { echo "OK";} ?>
  </td>	
   
   
    
   <td align="center"><?php echo $r["c_usuario"] ?></td>    
   <td align="right"><?php echo $r["total"] ?></td>
  </tr>
  <?php }?>
  <tr>
    <td colspan="5" align="right"><strong>
      TOTAL GENRAL =&gt; </strong></td>
    <td align="right"><strong><?php echo decimal($TOTAL,2) ?></strong></td>
  </tr>
</table>
<p>&nbsp;	</p>
