<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_caja.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_caja       = new bo_caja();
$bo_general       = new bo_general();

$periodo= $_REQUEST["periodo"];
$cr     = $_REQUEST["cr"];
$tipo     = $_REQUEST["tipo"];

if(s_local()=="28" and $tipo=="R") {$cr="%";}
$fecha_user=date("d/m/Y h:m:s"). "&nbsp;&nbsp;". s_usuario();
?>

<div id="imprimir">
 <div id="TablaExportar"> 

<?php if($tipo=="R"){  
$val=$bo_caja->listar_detalle_proc_habil($periodo,$cr);
$data  = $bo_caja->listar_detalle_habil($periodo,$cr);

$data_totalCole  = $bo_caja->TotalColegiados();
foreach($data_totalCole as $t){
	$totalColegiados=$t["total"];
	}

?>
<table class="table table-striped table-bordered table-hover dataTables-example" id="TablaExportar" >
<thead>
 <tr class="active">
	    <th  class="text-center" colspan="9" ><h2><strong>REPORTE DE HABILES E INHABILES</strong><br /> 
	        <strong>RESUMEN PERIDO=&gt;<?php echo $periodo?></strong></h2></th>
	    
  </tr>
                                                                                 <tr class="active">
      <td colspan="9"  class="text-center"><?php echo $fecha_user ?></td>
</tr>
 <tr class="active">
      <th class="text-right">#</th>
      <th class="text-right">PERIODO</th>
      <th class="text-left">CR</th>
      <th class="text-left">NOMBRE</th>
      <th class="text-right">HABIL</th>
      <th class="text-right">%HABIL</th>
      <th class="text-right">INHABIL</th>
      <th class="text-right">%INHABIL</th>
      <th class="text-right">TOTAL</th>
    </tr>
                                                                    
</thead>
 
	<?php $i=1; $total=0; 	$habil_por=0; 	$inhabil_por=0; $th=0;$ti=0;$t=0;	foreach($data as $row){ 	
	$total=$row["habil"]+$row["inhabil"]; 	
	$habil_por=($row["habil"]*100)/$total; 	
	$inhabil_por=($row["inhabil"]*100)/$total; 	
	$th+=$row["habil"];$ti+=$row["inhabil"];$t+=$total;
	?>
	<tr>
		
<td align="right"><?php echo $i ?></td>
	  <td align="right"><?php echo $periodo?></td>
	  <td align="right"><?php echo $row["c_local"]?></td>
	  <td align="left"><!--<a href="../caja/habil_inhabil_detalle.php?periodo=<?php echo $periodo?>&cr=<?php echo $row["c_local"] ?>" target="_blank"> --><?php echo $row["nombre1"]?><!--</a> --></td>
	  <td align="right"><?php echo decimal($row["habil"],0)?></td>
	  <td align="right"><?php echo decimal($habil_por,2)."%"?></td>
      	  <td align="right"><?php echo decimal($row["inhabil"],0)?></td>
      <td align="right"><?php echo decimal($inhabil_por,2)."%"?></td>
      <td align="right"><?php echo decimal($total,0)?></td>

      

  </tr>
<?php	$i++;	}	?>
	

<tr>
<th  colspan="4" class="text-right">TOTAL=&gt;</td>
<th  class="text-right"><?php echo decimal($th,0)?></th>
<th  class="text-right"><?php  if($th>0) {echo decimal((($th*100)/$t),2)."%";} else {echo "0%";}?></th>
<th  class="text-right"><?php echo decimal($ti,0)?></th>
<th  class="text-right"><?php   if($th>0) {echo decimal((($ti*100)/$t),2)."%";} else {echo "0%";}?></th>
<th  class="text-right"><?php echo decimal($t,0)?></th>
</tr>
<tr>
<th colspan="8" class="text-right">Total de colegiaciones : </th>
<th  class="text-right"><?php echo decimal($totalColegiados,0) ?> </th>
</tr>         

<tr>
<td colspan="9" ><?php echo vesion_web() ?> </td>
</tr> 

</table>

  <?php }else { 
  $data_det_cab = $bo_caja->padron($cr);
$data_cabecera = $bo_general->listarRegionesID($cr);
foreach($data_cabecera as $cab){$nombrecr=$cab["nombre"];}	 
  ?>
  
  
  <table  id="TablaExportar2" width="100%" >
    <thead>
      <tr class="active">
        <th  class="text-center" colspan="9" ><h2><strong>REPORTE DE HABILES E INHABILES</strong><br />
        </h2></th>
      </tr>
      <tr class="active">
        <td colspan="9"  align="center"><strong><?php echo $nombrecr ?></strong></td>
      </tr>
      <tr class="active">
        <td colspan="9"  align="center"><?php echo $fecha_user ?></td>
      </tr>
      <tr class="active">
        <th width="53" class="text-right">#</th>
        <th width="72" class="text-center">CEP</th>
        <th width="72" class="text-center">DOC</th>
        <th width="507" class="text-left">NOMBRE</th>
        <th width="507" class="text-left">ENTIDAD PAGADORA</th>

        <th width="103" class="text-right">DEUDA</th>
        <th width="58" class="text-left">&nbsp;HABIL?</th>
    
      </tr>
    </thead>
    <div style="font-size: 11px; color:#000">
     <?php $i=1 ;				  				  $th=0;$ti=0;
			foreach($data_det_cab as $cabx){	
			
		 if($cabx["flag_habil"]=="H") {   $th=$th+1;    }
		 else {    $ti=$ti+1; }
			 ?>
    <tr >
      <td align="right"><?php echo $i ?></td>
      <td align="center"><?php echo $cabx["c_cmp"]?></td>
        <td align="center"><?php echo $cabx["num_documento"]?></td>      <td align="left"><?php echo $cabx["nombre"]?></td>
        <td align="left"><?php echo $cabx["entidad_nombre"]?></td>
      <td align="right"><?php echo decimal($cabx["abono_favor"],2) ?> </td>
      <td align="left"><strong>&nbsp;<?php echo $cabx["flag_habil"] ?></strong></td>
    </tr>
    <?php	$i++;	}	?>
    </div>
    <tr>
      <th  colspan="6" class="text-right">HABIL=&gt;
        </td>
      (<?php echo decimal(($th*100)/($th+$ti),2);?>%)</th>
      <th  class="text-center"><?php echo decimal($th,0);?></th>
      
    </tr>
    <tr>
      <th  colspan="6" class="text-right">INHABIL=&gt;
        </td>
      (<?php echo decimal(($ti*100)/($th+$ti),2);?>%)</th>
      <th  class="text-center"><?php echo decimal($ti,0)?></th>
      
    </tr>
    <tr>
      <th  colspan="6" class="text-right">TOTAL=&gt;
        </td>
      (100.00%)</th>
      <th  class="text-center"><?php echo decimal($th+$ti,0);?></th>
      
    </tr>
    <tr>
      <td colspan="9" ><?php echo vesion_web() ?></td>
    </tr>
  </table>
 
  


<?php }?>

</div>
</div>

