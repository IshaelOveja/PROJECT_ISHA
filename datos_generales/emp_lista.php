<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_empresa.php"); 
s_validar_pagina();
$bo_empresa     = new bo_gen_empresa();
$ent_empresa    = new gen_empresa();

$pag=1;
if(isset($_REQUEST["pagPagina"])){
	$pag=$_REQUEST["pagPagina"];
}
$mostrar=15;
if(isset($_REQUEST["pagMostrar"])){
	$mostrar=$_REQUEST["pagMostrar"];
}
$emp_ruc="";
if(isset($_REQUEST["emp_ruc"])){
	$emp_ruc=$_REQUEST["emp_ruc"];
}

$emp_razon_social="";
if(isset($_REQUEST["emp_razon_social"])){
	$emp_razon_social=$_REQUEST["emp_razon_social"];
}

$bo_empresa->selectable_pages($mostrar);
$bo_empresa->records_per_page($mostrar);
$bo_empresa->pagina_actual($pag);

$ent_empresa->setEmp_ruc($emp_ruc);
$ent_empresa->setEmp_razon_social($emp_razon_social);


$data_empresa   = $bo_empresa->listar($ent_empresa);
$i=1;

?>
<table class="table table-bordered">
              <!--<caption class="text-right">
                  <a href="javascript:fn_enviarFormulario('I','');" class="btn btn-primary btn-sm active" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>
              
              </caption>-->
              <thead>
                <tr class="activo">
                    <th>#</th>
                    <th>Ruc</th>
                    <th>Razon Social</th>
                    <th>Nombre Comercial</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Vigencia</th>
				</tr>
                </thead>
                <tbody  id="divListarEmpresa">
                <?php foreach($data_empresa as $row){?>
                   <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["emp_ruc"] ?></td>
                        <td>
                         <a href="javascript:fn_enviarFormulario('U','<?php echo $row["emp_ruc"]?>');" class="tooltip-show" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                   <?php echo $row["emp_razon_social"] ?>
                                    </a>
                        </td>
                        <td><?php echo $row["emp_nom_comercial"] ?></td>
                        
                        <td><?php echo $row["emp_direccion"] ?></td>
                         <td><?php echo $row["emp_celular"] ?></td>
                        <td><?php echo u_vigencia($row["emp_estado"]);?></td>
                        
                    </tr>
                            
                     <?php $i++;}?>
                </tbody>
                <tr>
            <td class="text-center" colspan="10">       
            <?php echo $bo_empresa->render(); ?> 
            </td>
        </tr>

            </table>


