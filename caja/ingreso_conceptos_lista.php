<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_general       = new bo_general();
$bo_caja       = new bo_fin_ec_reporte();


$fec_desde ="";
if(isset($_REQUEST["fec_desde"])){
	$fec_desde= $_REQUEST["fec_desde"];
}
$fec_hasta="";
if(isset($_REQUEST["fec_hasta"])){
	$fec_hasta= $_REQUEST["fec_hasta"];

}

$data=$bo_caja->listarCajadetalle_codigo($fec_desde,$fec_hasta);

  $data_cabecera = $bo_general->listarRegionesID('01');
foreach($data_cabecera as $cab){
$cabnombre =$cab["nombre"];
$cablocal_tel=$cab["local"];
$cablocal_mail=$cab["local_mail"];
$cablocal_dir=$cab["local_direc"];
$cablocal_ruc=$cab["ruc"];
}?>
<div id="imprimir">
 <div id="TablaExportar">
<div style="font-size: 12px; color:#000">
<table width="100%" >

 <tr class="active">
	    <th  class="text-center" colspan="04" ><h2> <strong>INGRESOS POR CONCEPTOS</strong><br />
	      <?php echo $cabnombre ?></h2>
	      <p> <strong>DESDE=&gt;<?php echo $fec_desde?> HASTA=&gt;<?php echo $fec_hasta?></strong></p>
         </th>
	    
  </tr>
  <tr class="active">
      <td colspan="4" class="left">&nbsp;</td>
</tr>
   
    <tr class="active">
      <th class="text-right">#</th>
      <th class="text-right">COD</th>
      <th class="text-left">DETALLE</th>
         <!-- <th class="text-right">MONTO</th>
      <th class="text-right">IGV</th>-->
      <th class="text-right">TOTAL</th>
      
     
    </tr>
    
	
	
<?php $i=1; $total=0; 	foreach($data as $row){ 	
$total+=$row["monto"]; 	?>
	<tr>
		
<td class="text-right" ><?php echo $i ?></td>
<th class="text-right"><a href="../caja/caj_lista_i_c_detalle.php?cod=<?php echo $row["c_articulo"]?>&desde=<?php echo $fec_desde?>&hasta=<?php echo $fec_hasta?>&det=<?php echo $row["nombre"] ?>" target="_blank"> 
<?php echo $row["c_articulo"]?></a></th>
<td class="text-left"><?php echo $row["nombre"].$row["pla"]  ?></td>
<td class="text-right" align="right"><?php echo decimal($row["monto"],2) ?></td>



  </tr>
<?php	$i++;	} ?>


<tr>
<th  colspan="3"class="text-right">TOTAL=&gt;</td>
<th  class="text-right" align="right"><?php echo decimal($total,2)?></th>
</tr>


</table>

</div>
</div>
</div>


