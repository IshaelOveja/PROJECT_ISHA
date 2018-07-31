<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once("../util/numeroLetra.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_general       = new bo_general();
$bo_fin_ec_reporte       = new bo_fin_ec_reporte();
$bo_personas       = new bo_gen_personas();



$cc_persona     = $_REQUEST["p"];
$anho     = $_REQUEST["y"];


$data_personal=$bo_personas->listarId($cc_persona);
foreach($data_personal as $ro){
	    $inicio =$ro["fecha_de_colegiacion"];
		 $c_colegiado =$ro["c_colegiado"];
    $nombre = $ro["nombre"];
  $flag_activo  =$ro["flag_activo"];
	 $activo  =$ro["activo"];
     $local    =$ro["c_local"];
    $num_documento    =$ro["num_documento"];
    $cod_documento    =$ro["cod_documento"];
    $fecha_registro   =$ro["fecha_de_registro"];
	}
$fecha_user=date("d/m/Y h:m:s"). "&nbsp;&nbsp;". s_usuario();


$data_es_cta= $bo_fin_ec_reporte->listarId_detalle($cc_persona,$anho,"%");
$data_cabecera = $bo_general->listarRegionesID($local);
foreach($data_cabecera as $cab){
$cabnombre =$cab["nombre"];
$cablocal_tel=$cab["local"];
$cablocal_mail=$cab["local_mail"];
}
$fecha_user=date("d/m/Y h:m:s"). "&nbsp;&nbsp;". s_usuario();
$data_ph=$bo_personas->estado_habil($cc_persona);
  foreach($data_ph as $ha){
  $deuda=$ha["deuda"];
    }
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PEGASO | COLEGIO DE ENFERMEROS DEL PERU</title>
    <link rel="stylesheet" type="text/css" href="../css/print.css">

</head>

<body>
 <div class="row">
 <body bgcolor="#FFFFFF" >
<table align="center">

 <tr class="active">
	    
	    <td align="center"><table  width="100%" align="center">
	      <tr>
	        <td width="16%" rowspan="3" ><a href="javascript:window.print()"><img src="../imag/logo_corladlima.jpg"  width="100" border="0" /></a></td>
	        <td colspan="2" align="center"  ><h2><strong>ESTADO DE CUENTA</strong></h2>
            <h2>A&NtildeO =&gt;<?php ECHO $anho?></h2></td>
	        </tr>
	      <tr>
	        <td colspan="2"  align="center" ><strong><?php echo $cabnombre ?></strong></td>
	        </tr>
	      <tr>
	        <td colspan="2"  align="rigth" ><div align="right"><?php echo $fecha_user ?></div></td>
	        </tr>
	      <tr>
	        <td colspan="2" >CEP : <strong><?php echo $c_colegiado ?> </strong>DOC: <strong>
<strong><?php  if($cod_documento=="CE"){ echo "C. EXT. -".$num_documento;} else {echo "DNI-".$num_documento;}; ?></strong></td>
	        <td width="50%" >FECHA RESOL.:<strong>&nbsp;<?php echo $fecha_registro.' ('.$activo.')' ?></strong></td>
	        </tr>
	      <tr>
	        <td colspan="2" >NOMBRE : <strong><?php echo $nombre ?></strong></td>
	        <td >ESTADO :<strong> <?php echo estado_habilidad($deuda,$año). " => ".decimal($deuda,2);?></strong></td>
	        </tr>
	      </table>
	      </th>
  </tr>
 
  <tr>

  <tr  class="active">
    <td colspan="2" ><table width="100%"   cellspacing="5" >
  <tr>
    <td align="center"><strong>#</strong></td>
     <td align="center"><strong>PERIODO</strong></td>
        <td align="center"><strong>TIPO</strong></td>
      
        
   
    <td align="center"><strong>DOC</strong></td>
   
    
     <td align="center"><strong>FECHA</strong></td>
   
    <td align="right"><strong>MONTO</strong></td>
  </tr>
   
 <?php  $n=0; $TOTAL=0;		foreach($data_es_cta as $r){ 	
   $n=$n+1;
   if($r["cargo_abono"]=="C"){$v=decimal($r["monto"],2);}else{$v=decimal($r["monto"]*-1,2);};
   $TOTAL=$TOTAL+$v;?>
  <tr>
     <td align="center"><?php echo $n ?></td>
     <td align="center"><?php echo $r["periodo"] ?></td>

        <td align="center"><?php if($r["cargo_abono"]=="A"){echo "<strong>"."*ABONO*"."</strong>";} else { echo "CARGO";} ?></td>
   
      
    
    <td align="center">

	 <strong> <?php if($r["cargo_abono"]=="A"){?><a href="../caja/facturas_print.php?id=<?php echo $r["cc_factura"] ?>" target="_blank"><?php echo $r["cod_documento"].'*'.$r["num_documento"] ?></a><?php }?></strong>
	</td>
    
<td align="center"><?php echo $r["fecha"] ?></td>

<td align="right"><?php if($r["cargo_abono"]=="C"){echo decimal($r["monto"],2);}else{echo "<strong>".decimal($r["monto"]*-1,2)."</strong>";} ?></td>
    </tr>
     <?php }?>
      <tr>
     <td colspan="5" align="right"><strong>
       <?php if($TOTAL<0){echo "SALDO A FAVOR";} else { echo "DEUDA DE";} ?> 
       =&gt; </strong></td>
    <td align="right"><strong><?php echo decimal($TOTAL,2) ?></strong></td>
    </tr>
     
</table>
</td>
  </tr>
  
  <tr  class="active">
  <td colspan="3" >  </td>
</tr>

</table>
 </div>
</body>
</html>

