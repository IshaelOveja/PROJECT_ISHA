<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_articulo.php"); 
s_validar_pagina();
$bo_articulo     = new bo_gen_articulo();
$ent_articulo    = new gen_articulo();

$pag=1;
if(isset($_REQUEST["pagPagina"])){
	$pag=$_REQUEST["pagPagina"];
}
$mostrar=15;
if(isset($_REQUEST["pagMostrar"])){
	$mostrar=$_REQUEST["pagMostrar"];
}
$ct_grupo="";
if(isset($_REQUEST["ct_grupo"])){
	$ct_grupo=$_REQUEST["ct_grupo"];
}
$emp_id="";
if(isset($_REQUEST["emp_id"])){
	$emp_id=$_REQUEST["emp_id"];
}
$ct_nombre="";
if(isset($_REQUEST["ct_nombre"])){
	$ct_nombre=$_REQUEST["ct_nombre"];
}

$bo_articulo->selectable_pages($mostrar);
$bo_articulo->records_per_page($mostrar);
$bo_articulo->pagina_actual($pag);

$ent_articulo->setCt_grupo($ct_grupo);
$ent_articulo->setCt_nombre($ct_nombre);
$ent_articulo->setEmp_id($emp_id);


$data_articulo   = $bo_articulo->listar($ent_articulo);
$i=1;

?>
<table class="table table-bordered">
              <thead>
                <tr class="activo">
                    <th>#</th>
                    <th>C&oacute;digo</th>
                    <th>Nombre</th>
                    <th>Mol&eacute;cula</th>
                    <th>Medida</th>
                    <th>Prec. Compra</th>
                    <th>Rentab.</th>
                  <th>Prec. Venta</th>
                  <th>igv</th>
                    <th>Stock</th>
                    <th>Stock min.</th>
                    <th>Vigencia</th>
				</tr>
                </thead>
                <tbody  id="divListarEmpresa">
                <?php foreach($data_articulo as $row){
					if($row["ct_stockmin"]>=$row["ct_stock"]){
					$col='style="background:#F90"';
					}else{$col="";}
					?>
                   <tr <?php echo $col ?>>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["ct_codigo"] ?></td>
                        <td>
                         <a href="javascript:fn_enviarFormulario('U','<?php echo $row["cc_articulo"]?>');" class="tooltip-show" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                   <?php echo $row["ct_nombre"] ?>
                                    </a>
                        </td>
                        <td><?php echo $row["ct_molecula"] ?></td>
                        <td><?php echo $row["ct_umedida"] ?></td>
                        <td align="right"><?php echo "S/. ".$row["ct_compra"] ?></td>
                        <td align="center"><?php echo $row["ct_rentabilidad"]."%" ?></td>
                     	<td align="right"><?php echo "S/. ".$row["ct_venta"] ?></td>
                     	<td ><?php echo $row["ct_igv"] ?></td>
                        <td><?php echo $row["ct_stock"] ?></td>
                         <td><?php echo $row["ct_stockmin"] ?></td>
                        <td align="center"><?php echo u_vigencia($row["ct_vigencia"]);?></td>
                        
                    </tr>
                            
                     <?php $i++;}?>
                </tbody>
                <tr>
            <td class="text-center" colspan="12">       
            <?php echo $bo_articulo->render(); ?> 
            </td>
        </tr>

            </table>


