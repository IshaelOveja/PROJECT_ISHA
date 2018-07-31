<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
s_validar_pagina();
$bo_caja       = new bo_fin_ec_reporte();


$pag=14;
$pag=1;
if(isset($_REQUEST["pagPagina"])){
	$pag=$_REQUEST["pagPagina"];
}
$mostrar=40;
if(isset($_REQUEST["pagMostrar"])){
	$mostrar=$_REQUEST["pagMostrar"];
}
$fec_desde ="";
if(isset($_REQUEST["fec_desde"])){
	$fec_desde= $_REQUEST["fec_desde"];
}
$fec_hasta="";
if(isset($_REQUEST["fec_hasta"])){
	$fec_hasta= $_REQUEST["fec_hasta"];

}

$bo_caja->selectable_pages($mostrar);
$bo_caja->records_per_page($mostrar);
$bo_caja->pagina_actual($pag);
//$ent_caja->setFecha($fec_desde);
//$ent_caja->setFecha1($fec_hasta);
//$ent_caja->setC_local($c_local);


$data_caja   = $bo_caja->listarCaja($fec_desde,$fec_hasta);
$data_caja_sus   = $bo_caja->listarCaja_sustento($fec_desde,$fec_hasta);

	$total=0;
	$i=1;
	
	?>
   
<div id="imprimir">
 <div id="TablaExportar">
  <div style="font-size: <?php echo $texto  ?>px; color:#000">  
  
<table width="100%" >

 <tr class="active">
	    <th  class="text-center" colspan="8" ><h2><strong>LISTADO DE DOCUMENTOS</strong><br />
	      <?php echo $cabnombre ?></h2>
	      <p> <strong>DESDE=&gt;<?php echo $fec_desde?> HASTA=&gt;<?php echo $fec_hasta?></strong></p>
         </th>
	    
  </tr>

            <tr class="active">
                <td ><strong>#</strong></td>
                <td ><strong>FECHA</strong></td>
                     <td align="center" ><strong>DOCUMENTO</strong></td>
                <td ><strong>A NOMBRE DE</strong></td>
                <td ><strong>USUARIO</strong></td>
                <td ><strong>OBS</strong></td>
                
                <td  align="right"><strong>MONTO</strong></td>
                <td  align="right"><strong>ESTADO</strong></td>

            </tr>
          
            <?php foreach($data_caja as $row){
		$total+=$row["total"];?>
            <tr >
              <td ><?php echo $i ?></td>
              <td ><?php echo $row["fecha"] ?></td>
                
              <td align="center"> <a href="../caja/facturas_print.php?id=<?php echo $row["cc_factura"] ?>" target="_blank"><?php echo $row["cod_documento"]."-".$row["num_documento"]; ?></a></td>
              <td ><?php echo ' ('.$row["c_colegiado"].') '.$row["nombre"].$row["ruc"] ?></td>
              <td ><?php echo $row["user_crea"].' '.$row["nombreu"] ?></td>
          
              <td class="text-left"><?php echo $row["obs"] ?></td>
               <td class="text-right"><div align="right"><?php echo ' '.decimal($row["total"],2 )?></div></td>
              <td  align="right"><?php if($row["flag"]=="A"){echo "<strong>**ANULADO**</strong>";}else{ echo "OK";} ?></td>
            </tr>
                 <?php  $i++;} ?>
 <?php foreach($data_caja_sus as $s){
		?>
     <tr class="active">
           <td colspan="5" >&nbsp;</td>
           <td class="text-right"><strong><strong> <?php echo $s["cod_forma"] ?> =&gt;</strong></strong></td>
           <td class="text-right"><div align="right"><strong><?php echo decimal($s["monto"],2); ?></strong></div></td>
           <td >&nbsp;</td>
      </tr>
       
      <?php }?>
        <tr class="active">
          <td colspan="5" >&nbsp;</td>
          <td class="text-right"><strong>TOTAL==&gt;</strong></td>
             <td class="text-right"><div align="right"><strong><?php echo decimal($total,2) ?></strong></div></td>
          <td >&nbsp;</td>
        </tr>
    
	
	



</table>
		</div>
	</div>
 </div>
         
 
 
 
 