<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php"); 
require_once(u_src()."bo/bo_general.php"); 
$bo_fin_ec_reporte       = new bo_fin_ec_reporte();


$cc_banco     = $_REQUEST["cc_banco"];
$numero     = $_REQUEST["numero"];
$bo_general   = new bo_general();
$data_banco=$bo_general->banco_cuentas($cc_banco);
$data_caja=$bo_fin_ec_reporte->buscar_voucher($cc_banco, $numero);
foreach($data_banco as $b){ $banco=$b["nombre"];}

?>

   <table class="table table-striped table-bordered table-hover dataTables-example" id="TablaExportar" >
     <tr  class="active">
         
          <td>#</td>
         
          <td>Fecha</td>
          <td align="center">DOC</td>
          
          <td>CTE DEPOSITO</td>
          <td>VOUCHER</td>
          <td>FECHA VOUCHER</td>
          <td align="right">MONTO</td>
         
        </tr>
        <?php	$i=1;        $k=0;	foreach($data_caja as $row){	?>
        <tr class="active">
          
          <td align="right"><?php echo $i ?></td>
      
          <td align="left"><?php echo $row["fecha"]?></td>
          <td align="center"> <a href="../caja/facturas_print.php?id=<?php echo $row["cc_factura"] ?>" target="_blank"><?php echo $row["cod_documento"]."-".$row["num_documento"]; ?></a></td>
          <td align="left"><?php echo $banco?></td>
          <td align="left"><?php echo $row["c_operacion"]?></td>
          <td align="left"><?php echo $row["fecha_referencia"]?></td>     <td align="right"><?php echo $row["monto"]?></td>
          
        </tr>
                <?php $i++;	} ?>
      
  </table>
  



