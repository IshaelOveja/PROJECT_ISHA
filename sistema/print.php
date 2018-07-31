<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Content-Type: text/html; charset=iso-8859-1");
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once("../util/numeroLetra.php");

require_once(u_src()."bo/bo_fin_caja.php"); 
require_once(u_src()."bo/bo_gen_personas.php");
require_once(u_src()."bo/bo_fin_caja_detalle.php");

s_validar_pagina();

$bo_caja              = new bo_fin_caja();
$bo_caja_det             = new bo_fin_caja_detalle();

$bo_personas             = new bo_gen_personas();


if(isset($_REQUEST["codigo"])){
	$cc_caja=$_REQUEST["codigo"];
	}else{
	$cc_caja=s_cod_unico();	
}
$data_cab=$bo_caja->ListarRecibosId($cc_caja);
foreach($data_cab as $cab){
	$cc_persona=$cab["cc_persona"];
	$fecha=$cab["reg_fecha"];
	$numero=$cab["ct_serie"]."-".$cab["ct_numero"];
	$pag_tipo="Forma de pago: ".$cab["pag_tipotext"];
	
	$obs=$cab["caj_obs"];
	$cc_usuario=$cab["cc_usuario"];
	}
$data_perso=$bo_personas->listarId($cc_persona);
foreach($data_perso as $per){
	$cliente=$per["ct_nombres"];
	$dni=$per["ct_nro_doc"];
	}
$data_deta	=	$bo_caja_det->ListaId($cc_caja);
$data_totalesafecto=$bo_caja_det->total($cc_caja, "Si");
$data_totalesinafecto=$bo_caja_det->total($cc_caja, "No");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="iso-8859-1">
    
    <title>ASOCIACIOON FORTALEZA</title>
   <link rel="stylesheet" type="text/css" href="../css/imprimir.css">
</head>
<body bgcolor="#FFFFFF" >

  <table width="595" height="842" bordetextr="0" align="center">
    <tr>
	
      <td valign="top" height="470">
	  <table width="595" bordetextr="0" align="center" cellpadding="1" cellspacing="0">
        <tr>
          <td colspan="4"><table width="590" bordetextr="0" cellpadding="0" cellspacing="0">
              <tr>
                <td ><a href="javascript:window.print()"><img src="../img/logo.png" alt="Clic para imprimir" width="65" height="76" bordetextr="0" /></a></td>
                <td ><table width="470" bordetextr="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="322" align="center" ><h2>DOCUMENTO</h2> </td>
                    <td width="148" align="center">RUC: 20551010199 </td>
                  </tr>
                  <tr>
                    <td align="center" class="titulo14">EMPRESA</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" >SAUSAL</td>
                    <td align="center" class="bordetexttext"><strong>N&deg; <?php echo $numero ?> </strong></td>
                  </tr>
                  <tr>
                    <td align="center" class="txt_11" >Cel: 9997 / RPM: 999</td>
                    <td align="center" ><?php echo $cc_usuario ?></td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="107">DNI : <strong><?php echo $dni ?></strong></td>
          <td width="332">Nombre : <strong><?php echo $cliente ?></strong></td>
          <td width="148" colspan="2">Fecha:<?php echo $fecha ?></td>
        </tr>
        <tr>
          <td colspan="4">
          <table width="590" bordetextr="0" align="center">
              <tr>
                <td><?php echo $pag_tipo ?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="4"><hr size="1"></td>
        </tr>
        <tr>
          <td colspan="4">
          <table width="572" bordetextr="0" align="center" class="cabecera">
              <tr>
                <td width="31" class="bordetext">ITEM</td>
                <td width="31" class="bordetext">Cant.</td>
                <td width="67" class="bordetext">CODIGO</td>
                <td width="280" class="bordetext">PRODUCTO</td>
                <td width="69" class="bordetext">P.UNIT.</td>
                <td width="88" class="bordetext">SUB-TOTAL</td>
              </tr>
              <?php
			  $total=0;
			  $i=1;
			 foreach($data_deta as $det){
				$ct_igv=1+$det["ct_igv"];
			  ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $det["ct_cantidad"]; ?></td>
                <td><?php echo $det["ct_codigo"]; ?></td>
                <td><?php echo $det["ct_nombre"]; ?></td>
                <td><?php echo $det["ct_importe"]; ?></td>
                <td class="bordetextlados" align="right"><?php echo $det["ct_total"]; ?></td>
              </tr>
			  <?php $i++;}?>
              <?php
			 $total_igv=0;
			$total=0;
				foreach($data_totalesafecto  as $row){
				if($row["total"]>0){
					$totalafecto+=$row["total"];
				}
			}
			foreach($data_totalesinafecto  as $row){
				if($row["total"]>0){
					$totalainafecto+=$row["total"];
				}
			}
			$neto=$totalafecto/$ct_igv;
			$igv=$totalafecto-$neto;
			$total=$totalainafecto+$totalafecto+$total_igv;
				?>
              <tr>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <th align="right">Inafecto:</th>
          <th align="right" class="bordetext"><?php echo decimal($totalainafecto,2) ?></th>
          <td></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <th  align="right">Afectos:</th>
          <th align="right" class="bordetext"><?php echo decimal($neto,2) ?></th>
          <td></td>
        </tr>
        <tr>
          <td colspan="4" >Obs:<?php echo $obs ?></td>
          <th align="right" >IGV:</th>
          <th align="right" class="bordetext"><?php echo decimal($igv,2)?></th>
          <td></td>
        </tr>
              <tr>
                <td colspan="4">Son: <?php echo num2letras($total, $fem = false, $dec = true)." soles" ?></td>
                <th align="right" >Total: </th>
                <th class="bordetext" align="right"><?php echo decimal($total,2) ?></th>
              </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
	  </td>
    </tr>
    <tr>
      <td valign="baseline" height="380"><hr size="1">
	  <table width="595" bordetextr="0" align="center" cellpadding="1" cellspacing="0">
        <tr>
          <td colspan="4"><table width="590" bordetextr="0" cellpadding="0" cellspacing="0">
              <tr>
                <td ><a href="javascript:window.print()"><img src="../img/logo.png" alt="Clic para imprimir" width="65" height="76" bordetextr="0" /></a></td>
                <td ><table width="470" bordetextr="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="322" align="center" ><h2>DOCUMENTO</h2> </td>
                    <td width="148" align="center">RUC: 20551010199 </td>
                  </tr>
                  <tr>
                    <td align="center" class="titulo14">EMPRESA</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" >SAUSAL</td>
                    <td align="center" class="bordetexttext"><strong>N&deg; <?php echo $numero ?> </strong></td>
                  </tr>
                  <tr>
                    <td align="center" class="txt_11" >Cel: 999 / RPM: 999</td>
                    <td align="center" ><?php echo $cc_usuario ?></td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="107">DNI : <strong><?php echo $dni ?></strong></td>
          <td width="332">Nombre : <strong><?php echo $cliente ?></strong></td>
          <td width="148" colspan="2">Fecha:<?php echo $fecha ?></td>
        </tr>
        <tr>
          <td colspan="4">
          <table width="590" bordetextr="0" align="center">
              <tr>
 					<td><?php echo $pag_tipo ?></td>                
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="4"><hr size="1"></td>
        </tr>
        <tr>
          <td colspan="4">
          <table width="572" bordetextr="0" align="center" class="cabecera">
              <tr>
                <td width="31" class="bordetext">ITEM</td>
                <td width="31" class="bordetext">Cant.</td>
                <td width="67" class="bordetext">CODIGO</td>
                <td width="280" class="bordetext">PRODUCTO</td>
                <td width="69" class="bordetext">P.UNIT.</td>
                <td width="88" class="bordetext">SUB-TOTAL</td>
              </tr>
              <?php
			  $total=0;
			  $i=1;
			 foreach($data_deta as $det){
				$ct_igv=1+$det["ct_igv"];
			  ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $det["ct_cantidad"]; ?></td>
                <td><?php echo $det["ct_codigo"]; ?></td>
                <td><?php echo $det["ct_nombre"]; ?></td>
                <td><?php echo $det["ct_importe"]; ?></td>
                <td class="bordetextlados" align="right"><?php echo $det["ct_total"]; ?></td>
              </tr>
			  <?php $i++;}?>
              <?php
			 $total_igv=0;
			$total=0;
				foreach($data_totalesafecto  as $row){
				if($row["total"]>0){
					$totalafecto+=$row["total"];
				}
			}
			foreach($data_totalesinafecto  as $row){
				if($row["total"]>0){
					$totalainafecto+=$row["total"];
				}
			}
			$neto=$totalafecto/$ct_igv;
			$igv=$totalafecto-$neto;
			$total=$totalainafecto+$totalafecto+$total_igv;
				?>
              <tr>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <th  align="right">Inafecto:</th>
          <th align="right" class="bordetext"><?php echo decimal($totalainafecto,2) ?></th>
          <td></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <th align="right">Afectos:</th>
          <th align="right" class="bordetext"><?php echo decimal($neto,2) ?></th>
          <td></td>
        </tr>
        <tr>
          <td colspan="4" >Obs:<?php echo $obs ?></td>
          <th align="right" >IGV:</th>
          <th align="right" class="bordetext"><?php echo decimal($igv,2)?></th>
          <td></td>
        </tr>
              <tr>
                <td colspan="4">Son: <?php echo num2letras($total, $fem = false, $dec = true)." soles" ?></td>
                <th align="right" >Total: </th>
                <th class="bordetext" align="right"><?php echo decimal($total,2) ?></th>
              </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>

  </body>
</html>
