<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Content-Type: text/html; charset=iso-8859-1");
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once("../util/numeroLetra.php");
require_once(u_src()."bo/bo_caja.php"); 

s_validar_pagina();
$bo_caja			= new bo_caja();
$periodo=$_REQUEST["periodo"];
$cr=$_REQUEST["cr"];

$data_det_cab = $bo_caja->padron($cr);

$data_cabecera = $bo_general->listarRegionesID($cr);
?>
<html>
  <head>
<title>CEP || Colegio de Enfermeros del Per&uacute;</title>
<link rel="stylesheet" type="text/css" href="../css/imprimir.css">
  <style type="text/css">
<!--
.Estilo1 {
	font-size: 14;
	font-weight: bold;
}
.Estilo2 {font-size: 14px}
.Estilo3 {font-size: 18px}
-->
  </style>
  <body>
  
  <table align="center" >
      <?php foreach($data_cabecera as $cab){	  ?>
    <tr>
      <td rowspan="3"  align="center"><a href="javascript:window.print()"><img src="../imag/logo_print.jpg" alt="Clic para imprimir" width="100" border="0" /></a></td>
      <td align="center"><strong>HABILES E INHABILES</strong></td>
    </tr>
     <tr>
      <td align="center"><strong><?php echo $cab["nombre"] ?></strong></td>
    <tr>
      <td align="center"><span class="txt_11"><?php echo $cab["local_tel"] ?>&nbsp;//&nbsp;<?php echo $cab["local_mail"] ?></span></td>
      
    </tr>
      <?php ?>
    <tr>
      <td colspan="2" align="center"><strong class="Estilo3">(PERIODO=&gt; <?php echo $periodo ?>) </strong></td>
    </tr>

    <?php }?>
    <tr>
      <td colspan="2"><hr size="1"></td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" align="center" class="cabecera">
        <tr bgcolor="#CCCCCC">
          <td  class="borde"><strong>#</strong></td>
          <td class="borde"><strong>CEP</strong></td>
          <td  class="borde"><strong>NOMBRE</strong></td>
         
          <td width="57" class="borde"><div align="right"><strong>DEUDA</strong></div></td>
          <td width="60"  class="borde"><div align="center"><strong>HABIL?</strong></div></td>
        </tr>
        <?php $i=1 ;				  				  $thabil=0;$tinhabil=0;
			foreach($data_det_cab as $cabx){	
			
		 if($cabx["flag_habil"]=="HABIL") {   $thabil=$thabil+1;    }
		 else {    $tinhabil=$tinhabil+1; }
			 ?>
        <tr >
          <td  ><?php echo $i ?></td>
          <td align="right"  bgcolor="#CCCCCC"><?php echo $cabx["c_cmp"] ?></td>
          <td ><?php echo $cabx["nombre"] ?></td>
         
          <td ><div align="right"><?php echo  decimal($cabx["abono_favor"],2) ?></div></td>
          <td ><div align="center"><?php echo $cabx["flag_habil"] ?></div></td>
        </tr>
        <tr>
          <td colspan="3" ></td>
        </tr>
        <?php $i++;}?>
        <tr>
          <td colspan="4" ><div align="right"><strong><span class="Estilo3">HABIL==&gt;</span></strong></div></td>
          <td ><div align="center"><strong><span class="Estilo3"> <?php echo number_format($thabil,0) ?></span></strong></div></td>
        </tr>
        <tr>
          <td colspan="4" ><div align="right"><strong><span class="Estilo3">INHABIL==&gt; </span></strong></div></td>
                    <td  ><div align="center"><strong><span class="Estilo3"><?php echo number_format($tinhabil,0) ?></span></strong></div></td>

        </tr>
        <tr>
          
          <td colspan="4" ><div align="right"><strong><span class="Estilo3">TOTAL==&gt; </span></strong></div></td>
          <td ><div align="center"><strong><span class="Estilo3"> <?php echo number_format($tinhabil+$thabil,0) ?></span></strong></div></td>
        </tr>
      </table></td>
    
  </table>
  
  </body>
</html>
