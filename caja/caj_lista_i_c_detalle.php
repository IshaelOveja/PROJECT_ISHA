<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Content-Type: text/html; charset=iso-8859-1");
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once("../util/numeroLetra.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_general       = new bo_general();
$bo_caja = new bo_fin_ec_reporte();



$cod=$_REQUEST["cod"];
$desde=$_REQUEST["desde"];
$hasta=$_REQUEST["hasta"];

$det=$_REQUEST["det"];

$data_cabecera = $bo_general->listarRegionesID('01');
$data = $bo_caja->i_c_detalle( $desde,$hasta,$cod);

?>
<!DOCTYPE html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PEGASO | COLEGIO DE ENFERMEROS DEL PERU</title>
    <link rel="shortcut icon" href="<?php echo u_img() ?>favicon.ico" />
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    
   
    <link href="../Bootstrap/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/imprimir.css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<!--<body class="fixed-sidebar no-skin-config full-height-layout">-->
<body class="fixed-sidebar">
	<script src="../Bootstrap/js/jquery-2.1.1.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
     
    <script src="../js/print.js"></script>
    <div class="text-right">
    <label>
        <form action="index.php" method="post" name="frmColExportar" id="frmColExportar" target="_blank">
            <button type="button" class="btn btn-default" id="btnExcel" onClick="fn_excel()"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar</button>
            <input type="hidden" name="expTabla" id="expTabla" value=""/>
            <input type="hidden" name="expFile" id="expFile" value="Reporte"/>
            <input type="hidden" name="expPapel" id="expPapel" value="landscape"/>
            <input type="hidden" name="expOrientacion" id="expOrientacion" value="a4"/>
            </form>
            </label>
          <label>
          <button type="button" id="printer" name="printer" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
        </label>
          
   </div>
	    <div id="imprimir">
 		<div id="TablaExportar">
  <div style="font-size: 11px; color:#000">
<table  width="100%" align="center">
<?php foreach($data_cabecera as $cab){
		  
		  ?>
                  <tr>
                    <td rowspan="4" align="center" ><img src="../imag/logo_print.jpg"  width="50" border="0" /></td>
                    <td align="center" ><h2><?php echo $cab["nombre"] ?> </br>DETALLE DE INGRESOS POR CONCEPTOS</h2> </td>
                    </tr>
                 
                 
                  <tr>
                    <td align="center"><strong><?php echo date("d/m/Y h:m:s") ?>&nbsp;&nbsp;<?php echo s_usuario() ?></strong></td>
                    </tr>
               
                  
                 
                       <?php } ?>

                </table>
                

                <table width="100%"  align="center">
                <tr>
                    <td colspan="7" class="txt_12"><strong>CONCEPTO :<?php echo $cod?> (<?php echo $det?>)&nbsp;&nbsp;DESDE=&gt;<?php echo $desde?>&nbsp;HASTA=&gt;<?php echo $hasta?></td>
                  </tr>
		    <?php $i=1; 
			$total=0; $V=0; $E=0; 
			foreach($data as $dettt){ 
			$total+=$dettt["monto"];
			 
			?>
            <tr>
              <td> <?php echo $i ?></td>
			  <td ><a href="../caja/facuras_print.php?id=<?php echo $dettt["cc_factura"] ?>" target="_blank"><?php echo $dettt["cod_documento"]." - ". $dettt["num_documento"] ?></a></td>
              <td ><?php echo $dettt["fecha"] ?></td
              ><td ><?php echo $dettt["c_colegiado"] ?></td>
              <td ><?php echo $dettt["ruc"] ?></td>
              <td > <?php echo $dettt["nombre"] ?></td>
			
              <td ><div align="right"><?php echo decimal($dettt["monto"],2) ?></div></td>
            </tr>
						  <?php $i++;}?>
						 
	 
	  <tr>
	  <td colspan="5" align="right">&nbsp;</td>
	
	  <td align="right"><strong>TOTAL=></strong> </td>
	  <td ><div align="right"><strong><span class="Estilo1"><?php echo decimal($total,2)?></span></strong></div></td>
	  </tr>
          </table>
</div>
</div>
</div>
</body>
</html>