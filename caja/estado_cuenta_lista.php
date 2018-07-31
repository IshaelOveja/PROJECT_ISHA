<?php

require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_general       = new bo_general();
$bo_fin_ec_reporte       = new bo_fin_ec_reporte();
$bo_personas       = new bo_gen_personas();

$tipo=$_REQUEST["tipo"];
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


$data_es_cta= $bo_fin_ec_reporte->listarId($cc_persona);

$foto=foto_colegiado($num_documento,$c_colegiado);

$data_cabecera = $bo_general->listarRegionesID($local);
foreach($data_cabecera as $cab){
$cabnombre =$cab["nombre"];
$cablocal_mail=$cab["local_mail"];
}
$fecha_user=date("d/m/Y h:m:s"). "&nbsp;&nbsp;". s_usuario();


?>
<table class="table table-striped table-hover"  >
<?php 

if($tipo=="1"){ 
if(estado_habilidad($deuda,$año)=="HABIL"){
		if(decimal($deuda,2)<=0.00){ ?>
    <tr><td colspan="14" >
  <?php echo "SOLO PARA LOS QUE TIENE S/0.00 DEUDA Y DESEAN ADELANTAR 12 CUOTAS (S/13.4 * 12 = S/162.0) -10% !!!"; ?><br/>
  <a href="javascript:fn_ProcesarRegistro('<?php echo $cc_persona ?>','I');" class="btn btn-primary btn-sm active" role="button">PROCESAR PAGO ANUAL</a>
</td></tr>
<?php } }
if(estado_habilidad($deuda,$año)=="HABIL"){
		if(decimal($deuda,2)<=0.00){?>
        <tr><td colspan="14" >
  <?php echo "ELIMINAR PAGO ADELANTADO (CARGA HERRADA) (S/13.4 * 12 = S/162.0) -10% !!!"; ?><br/>
  <a href="javascript:fn_ProcesarRegistro('<?php echo $cc_persona ?>','E');" class="btn btn-primary btn-sm active" role="button">BORRAR PAGO ANUAL</a>
</td></tr>

<?php }}} ?>





<tr>
    <td rowspan="2"  colspan="2" ><img src="../img/logo_corladlima.jpg"  width="100" border="0" /></td>
    <td align="center" colspan="10" ><h2><strong>ESTADO DE CUENTA</strong></h2></td>
    <td rowspan="2" colspan="2"  align="center"  ><img src="<?php echo $foto ?>" width="80"  border="0" class="borderedbox" /></td>
  </tr>
  <tr>
    <td align="center" colspan="10" ><strong><?php echo $cabnombre ?></strong><br/><?php echo $fecha_user ?></td>
  </tr>
  <tr>
    <td colspan="7" >CEP : <strong><?php echo $c_colegiado ?> </strong>DOC: <strong>
<strong><?php  if($cod_documento=="CE"){ echo "C. EXT. -".$num_documento;} else {echo "DNI-".$num_documento;}; ?><?php echo $nombre ?></strong></td>
    <td  colspan="7">FECHA RESOL.:<strong>&nbsp;<?php echo $fecha_registro.' ('.$activo.')' ?></strong></td>
    
  </tr>
  <tr>
    <td colspan="7" >OBS :</td>	
    <td colspan="7"><h3>ESTADO :<strong> <?php echo estado_habilidad($deuda,$año). " => ".decimal($deuda,2);?></strong></h3></td>
  </tr>

   <tr class="active">
    <td ><div align="center"><strong>A&Ntilde;O</strong>
    </div></td>
    <th ><div align="center"><strong>ENE</strong></div></th>
    <th ><div align="center"><strong>FEB</strong></div></th>
    <th ><div align="center"><strong>MAR</strong></div></th>
    <td ><div align="center"><strong>ABR</strong></div></td>
    <td ><div align="center"><strong>MAY</strong></div></td>
    <td ><div align="center"><strong>JUN</strong></div></td>
    <td ><div align="center"><strong>JUL</strong></div></td>
    <td ><div align="center"><strong>AGO</strong></div></td>
    <td ><div align="center"><strong>SET</strong></div></td>
    <td ><div align="center"><strong>OCT</strong></div></td>
    <td ><div align="center"><strong>NOV</strong></div></td>
    <td ><div align="center"><strong>DIC</strong></div></td>
    <td align="right"	 ><strong>TOTAL</strong></td>
  </tr>
  <?php $total=0;
foreach($data_es_cta as $row){ 
  $abono=$row["a01"]+$row["a02"]+$row["a03"]+$row["a04"]+$row["a05"]+$row["a06"]+$row["a07"]+$row["a08"]+$row["a09"]+$row["a10"]+$row["a11"]+$row["a12"];
  $cargo=$row["c01"]+$row["c02"]+$row["c03"]+$row["c04"]+$row["c05"]+$row["c06"]+$row["c07"]+$row["c08"]+$row["c09"]+$row["c10"]+$row["c11"]+$row["c12"];
  $total_ano=$cargo-$abono;
  $total+=$total_ano;
  ?>

  <tr>
    <td ><div align="center"><a href="../caja/ec_detalle.php?p=<?php echo $cc_persona?>&y=<?php echo $row["anho"] ?>" target="_blank"><strong><?php echo $row["anho"]?></strong></a>
    </div></td>
    <td >
          <div align="center">
            <?php if(decimal($row["a01"],2)!=0.00){echo $row["a01"];}else{if(decimal($row["c01"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
          <div align="center">
            <?php if(decimal($row["a02"],2)!=0.00){echo $row["a02"];}else{if(decimal($row["c02"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a03"],2)!=0.00){echo $row["a03"];}else{if(decimal($row["c03"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a04"],2)!=0.00){echo $row["a04"];}else{if(decimal($row["c04"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a05"],2)!=0.00){echo $row["a05"];}else{if(decimal($row["c05"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a06"],2)!=0.00){echo $row["a06"];}else{if(decimal($row["c06"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a07"],2)!=0.00){echo $row["a07"];}else{if(decimal($row["c07"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a08"],2)!=0.00){echo $row["a08"];}else{if(decimal($row["c08"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a09"],2)!=0.00){echo $row["a09"];}else{if(decimal($row["c09"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a10"],2)!=0.00){echo $row["a10"];}else{if(decimal($row["c10"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a11"],2)!=0.00){echo $row["a11"];}else{if(decimal($row["c11"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
    <td >
       
          <div align="center">
            <?php if(decimal($row["a12"],2)!=0.00){echo $row["a12"];}else{if(decimal($row["c12"],2)!=0.00){echo 0.00;}} ?>      
          </div></td>
  
     
      <td  align="right"><strong><?php echo decimal($total_ano, 2) ?> </strong>
   </td>

  </tr> <?php }?>
  </table>


