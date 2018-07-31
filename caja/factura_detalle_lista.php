<?php
/*require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_web_caja_temp.php"); 
s_validar_pagina();
$bo_caja_temp = new bo_web_caja_temp();

$data_caja_temp = $bo_caja_temp->listar(s_cod_unico());
$data_totales=$bo_caja_temp->total(s_cod_unico());*/
$total = "";
?>

<table width="100%">
<tr>
 <td align="right">
  <button class="btn btn-sm btn-primary" id="btnDetalle" onclick="fn_nuevo_detalle()" type="button">
                <strong><span class="glyphicon glyphicon-plus"></span>INSERTAR DETALLE</strong>
  </button>
 </td>

<tr>
	<td >
	<table class="table table-striped table-hover">
     <thead>
	<tr class="active">
		<th>#</th>
        <th>C&oacute;digo</th>
        <th>Concepto</th>
        <th>Cantidad</th>
        <th>IGV</th>
        <th>Subtotal</th>
        <th>Acci&oacute;n</th>
	</tr>
	</thead>
	
        <tr>
		<td colspan="8" align="right">Total</td>
                <td >
                 
                 <input type="hidden" align="right" name="caj_total" id="caj_total" value="<?php //echo $total ?>" size="10" />
                <?php echo $total ?> </td>
                <td></td>
	</tr>
    </thead>
        <?php
       // }
        ?>
	</table>
	</td>
</tr>

</table>
