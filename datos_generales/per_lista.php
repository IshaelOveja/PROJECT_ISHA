<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php"); 

s_validar_pagina();
$bo_personas           = new bo_gen_personas();
$ent_personas              = new gen_personas();

$pag=1;
if(isset($_REQUEST["pagPagina"])){
	$pag=$_REQUEST["pagPagina"];
}
$mostrar=20;
if(isset($_REQUEST["pagMostrar"])){
	$mostrar=$_REQUEST["pagMostrar"];
}
$ct_nombres="";
if(isset($_REQUEST["ct_nombres"])){
	$ct_nombres = $_REQUEST["ct_nombres"];
}
$ct_nro_doc="";
if(isset($_REQUEST["ct_nro_doc"])){
	$ct_nro_doc = $_REQUEST["ct_nro_doc"];
}


$ent_personas->setCt_nombres($ct_nombres);
$ent_personas->setCt_nro_doc($ct_nro_doc);


$bo_personas->selectable_pages($mostrar);
$bo_personas->records_per_page($mostrar);
$bo_personas->pagina_actual($pag);

$data_personas   = $bo_personas->listar($ent_personas);

$i=1;

?>
<table class="table table-bordered table-hover">
              <thead>
                    <tr class="active">
                    <th>#</th>
                    <th>DNI</th>
                     <th>Cliente</th>
                     <th>Direcci&oacute;n</th>
                     <th>Cont&aacute;cto</th>
                    <th>Vigencia</th>
                    </tr>
                </thead>
                <tbody  >
                <?php foreach($data_personas as $row){?>
                  <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["ct_nro_doc"] ?></td>
                        <td>
                           <label><a href="javascript:fn_enviarFormulario('U','<?php echo $row["cc_persona"]?>');" class="tooltip-show" data-toggle="tooltip" data-placement="bottom" title="Editar">
                            <?php echo $row["ct_nombres"] ?> 
                            </a></label><br />
                        <i class="fa fa-mobile fa-lg"></i> <?php echo $row["ct_celular"] ?>&nbsp;&nbsp;
                        <i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $row["ct_email"] ?>
                        </td>
                        <td><?php echo $row["ct_direccion"] ?> </td>
                        <td><i class="fa fa-user" aria-hidden="true"></i><?php echo $row["ct_nombresc"] ?><br />
                         <i class="fa fa-mobile fa-lg"></i> <?php echo $row["ct_celularc"] ?>&nbsp;&nbsp;
                        <i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $row["ct_emailc"] ?></td>
                        <td align="center"><?php echo u_vigencia($row["cfl_vigencia"]);?></td>
                        
                    </tr>
                    <?php $i++;}?>
                    <tr>
                        <td class="text-center" colspan="10">       
                        <?php echo $bo_personas->render(); ?> 
                        </td>
                    </tr>
                </tbody>
            </table>



