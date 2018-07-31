<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Content-Type: text/html; charset=iso-8859-1");
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once("../util/numeroLetra.php");
require_once(u_src()."bo/bo_fin_facturas.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();

$bo_general       = new bo_general();

$bo_caja              = new bo_fin_facturas();

if(isset($_REQUEST["id"])){
	$id=$_REQUEST["id"];

}

  

$data_cabecera = $bo_caja->imprimirReciboCabecera($id);
foreach($data_cabecera as $cab){
		  $obs=$cab["observacion"];
		  $c_colegiado=$cab["c_colegiado"];
		  $colegiado=$cab["nombre"];
		  $fecha=$cab["fecha"];
		  $usuario=$cab["c_usuario"];
		   $flag=$cab["flag"];
		
		 $cod_documento=$cab["cod_documento"];
		$num_documento=$cab["num_documento"];
}
$data_detalle = $bo_caja->imprimirReciboDetalle($id);
//echo $tip_doc;
//echo $numero;
  $data_cabecera = $bo_general->listarRegionesID('01');
foreach($data_cabecera as $cab){
$cabnombre =$cab["nombre"];
$cablocal_tel=$cab["local"];
$cablocal_mail=$cab["local_mail"];
$cablocal_dir=$cab["local_direc"];
$cablocal_ruc=$cab["ruc"];
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="iso-8859-1">
    
    <title>COLEGIO DE ENFERMEROS DEL PERU</title>
<link rel="stylesheet" type="text/css" href="../css/print.css">
  <style type="text/css">
<!--
#anulado1 {
	position:absolute;
	left:20%;
	top:15%;
	z-index:1;
}
#anulado2 {
	position:absolute;
	left:20%;
	top:60%;
	z-index:1;
}
-->
  </style>
</head>
<body bgcolor="#FFFFFF" >
<?php if($flag=="A"){?>
  <div id="anulado1"><img src="../imag/anulado.png" width="382" height="187"></div>
  <div id="anulado2"><img src="../imag/anulado.png" width="382" height="187"></div>
  <?php }?>
<table class="page">
<tr>
<td>
  <table width="595" height="842" boder_tdr="0" align="center">
    <tr>
	
      <td valign="top" height="470">

	  <table width="595" boder_tdr="0" align="center" cellpadding="1" cellspacing="0">
        <tr>
          <td colspan="4"><table width="590" boder_tdr="0" cellpadding="0" cellspacing="0">
              <tr>
                <td ><a href="javascript:window.print()"><img src="../imag/logo_corladlima.jpg" alt="Clic para imprimir" width="100" boder_tdr="0" /></a></td>
                <td ><table width="470" boder_tdr="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="322" align="center" ><h3><?php echo $cabnombre ?></h3> </td>
                    <td width="148" align="center">RUC: <strong><?php echo $cablocal_ruc	 ?></strong></td>
                  </tr>
                  <tr>
                    <td align="center" class="titulo14"><span class="titulo11"><?php echo $cablocal_dir ?></span></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" >&nbsp;</td>
                    <td align="center" class="boder_tdtext"><strong><?php echo $cod_documento ?> # <?php echo $num_documento	 ?> </strong></td>
                  </tr>
                  <tr>
                    <td align="center" class="txt_11" ><?php echo $tel ?><?php echo $correo ?></td>
                    <td align="center" ><?php echo $usuario ?></td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="137">(C) : <span class="txt_11"><strong><?php echo $c_colegiado."-".$colegiado ?></strong></span></td>
          <td width="100">Fecha:<span class="txt_11"><?php echo $fecha ?></span></td>
        </tr>
        <tr>
          <td colspan="4">
          <table width="590" boder_tdr="0" align="center">
              <tr>
                <td><?php echo $forma_pago ?> </td>
                <td><?php echo $p_nombre?></td>
                <td><?php echo $p_cta ?></td>
                <td><?php echo $p_ref?></td>
                <td><?php echo $p_fecha ?></td>
              </tr>
          </table></td>
        </tr>

        <tr>
          <td colspan="4"><hr size="1"></td>
        </tr>
        <tr>
          <td colspan="4"><table width="572" boder_tdr="0" align="center" class="cabecera">
              <tr>
                <td width="31" class="boder_td">ITEM</td>
                <td width="31" class="boder_td">Cant.</td>
                <td width="67" class="boder_td">CODIGO</td>
                <td width="280" class="boder_td">CONCEPTO</td>
                <td width="69" class="boder_td">P.UNIT.</td>
                <td width="88" class="boder_td">SUB-TOTAL</td>
              </tr>
			  <?php 
			  
			  $i=1;
			  $subtotal=0.00;
			  $totalfinal=0;
			  foreach($data_detalle as $det){
			  $subtotal=$det["cantidad"]*$det["precio"];
			  $totalfinal+=$subtotal;
			  $dat=trim($det["c_articulo"]);
			  if($dat=="70501"){$x=$det["ano"]."-".$det["detalle"];}else{$x="";}
			  
			  ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo number_format($det["cantidad"],0) ?></td>
                <td><?php echo $det["c_articulo"]?></td>
                <td><?php echo $det["nombre_pr"]." ".$x ?></td>
                <td align="right"><?php echo number_format($det["precio"],2) ?></td>
                <td class="boder_tdlados" align="right"><?php echo number_format($subtotal,2) ?></td>
              </tr>
			  <?php $i++;}?>
              <tr>
                <td colspan="5">&nbsp;</td>
                <td class="boder_tdlados">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5">Obs:<?php echo $obs ?></td>
                <td class="boder_tdlados">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4">Son: <?php echo num2letras($totalfinal, $fem = false, $dec = true)." soles" ?></td>
                <td class="boder_td">TOTAL</td>
                <td class="boder_td" align="right"><strong><?php echo number_format($totalfinal,2) ?></strong></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
	  </td>
    </tr>
    <tr>
      <td valign="top" height="380"><hr size="1">
	  <br>
	  <table width="595" boder_tdr="0" align="center" cellpadding="1" cellspacing="0">
	    <tr>
	      <td colspan="4"><table width="590" boder_tdr="0" cellpadding="0" cellspacing="0">
	        <tr>
	          <td ><a href="javascript:window.print()"><img src="../imag/logo_corladlima.jpg" alt="Clic para imprimir" width="100" boder_tdr="0" /></a></td>
	          <td ><table width="470" boder_tdr="0" align="center" cellpadding="0" cellspacing="0">
	            <tr>
	              <td width="322" align="center" ><h3><?php echo $cabnombre ?></h3></td>
	              <td width="148" align="center">RUC: <strong><?php echo $cablocal_ruc	 ?></strong></td>
	              </tr>
	            <tr>
	              <td align="center" class="titulo14"><span class="titulo11"><?php echo $cablocal_dir ?></span></td>
	              <td>&nbsp;</td>
	              </tr>
	            <tr>
	              <td align="center" >&nbsp;</td>
	              <td align="center" class="boder_tdtext"><strong><?php echo $cod_documento ?> # <?php echo $num_documento	 ?></strong></td>
	              </tr>
	            <tr>
	              <td align="center" class="txt_11" ><?php echo $tel ?><?php echo $correo ?></td>
	              <td align="center" ><?php echo $usuario ?></td>
	              </tr>
	            </table></td>
	          </tr>
	        </table></td>
	      </tr>
	    <tr>
	      <td width="137">(C) : <span class="txt_11"><strong><?php echo $c_colegiado."-".$colegiado ?></strong></span></td>
	      <td width="100">Fecha:<span class="txt_11"><?php echo $fecha ?></span></td>
	      </tr>
	    <tr>
	      <td colspan="4"><table width="590" boder_tdr="0" align="center">
	        <tr>
	          <td><?php echo $forma_pago ?></td>
	          <td><?php echo $p_nombre?></td>
	          <td><?php echo $p_cta ?></td>
	          <td><?php echo $p_ref?></td>
	          <td><?php echo $p_fecha ?></td>
	          </tr>
	        </table></td>
	      </tr>
	    <tr>
	      <td colspan="4"><hr size="1"></td>
	      </tr>
	    <tr>
	      <td colspan="4"><table width="572" boder_tdr="0" align="center" class="cabecera">
	        <tr>
	          <td width="31" class="boder_td">ITEM</td>
	          <td width="31" class="boder_td">Cant.</td>
	          <td width="67" class="boder_td">CODIGO</td>
	          <td width="280" class="boder_td">CONCEPTO</td>
	          <td width="69" class="boder_td">P.UNIT.</td>
	          <td width="88" class="boder_td">SUB-TOTAL</td>
	          </tr>
	        <?php 
			  
			  $i=1;
			  $subtotal=0.00;
			  $totalfinal=0;
			  foreach($data_detalle as $det){
			  $subtotal=$det["cantidad"]*$det["precio"];
			  $totalfinal+=$subtotal;
			  $dat=trim($det["c_articulo"]);
			  if($dat=="70501"){$x=$det["ano"]."-".$det["detalle"];}else{$x="";}
			  
			  ?>
	        <tr>
	          <td><?php echo $i ?></td>
	          <td><?php echo number_format($det["cantidad"],0) ?></td>
	          <td><?php echo $det["c_articulo"]?></td>
	          <td><?php echo $det["nombre_pr"]." ".$x ?></td>
	          <td align="right"><?php echo number_format($det["precio"],2) ?></td>
	          <td class="boder_tdlados" align="right"><?php echo number_format($subtotal,2) ?></td>
	          </tr>
	        <?php $i++;}?>
	        <tr>
	          <td colspan="5">&nbsp;</td>
	          <td class="boder_tdlados">&nbsp;</td>
	          </tr>
	        <tr>
	          <td colspan="5">Obs:<?php echo $obs ?></td>
	          <td class="boder_tdlados">&nbsp;</td>
	          </tr>
	        <tr>
	          <td colspan="4">Son: <?php echo num2letras($totalfinal, $fem = false, $dec = true)." soles" ?></td>
	          <td class="boder_td">TOTAL</td>
	          <td class="boder_td" align="right"><strong><?php echo number_format($totalfinal,2) ?></strong></td>
	          </tr>
	        </table></td>
	      </tr>
	    <tr>
	      <td colspan="4">&nbsp;</td>
	      </tr>
	    </table></td>
    </tr>
  </table>
  </td>
  </tr>
  </table>
  </body>
</html>
