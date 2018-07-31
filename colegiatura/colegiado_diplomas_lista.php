<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_diplomas.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
s_validar_pagina();
$cc_persona=$_REQUEST["cc_persona"];

$bo_personas = new bo_gen_personas();
$bo_diplomas        = new bo_gen_personas_diplomas();
$ent_diplomas           = new gen_personas_diplomas();


$data_diplomas  = $bo_diplomas->listar($cc_persona);


$data_persona=$bo_personas->listarId($cc_persona);
	foreach($data_persona as $per){
		$nombre_completo=$per["nombre"];
		$codigo=$per["c_colegiado"];
	}
?>


<div class="row">
    <div class="col-12">
   
                <div class="table-responsive">
                
                <span class="pull-right text-right">
                <small><?php echo bt_imprimir(1,0) ?></small>
                </span>
                <h1 class="m-b-xs"><a href="javascript:fn_controlDiplomas('','<?php echo $cc_persona?>','I');" class="btn btn-info" role="button"> <i class="fa fa-plus"></i> Nuevo</a></h1>
           	 
             <div id="imprimir">
                 <div id="TablaExportar">
                 <div class="text-center">
                   <h3><strong>DATOS DE DIPLOMAS</strong></h3></div>
                 <div>C&oacute;digo (<?php echo $codigo ?>) <i class="fa fa-angle-double-right"></i> <?php echo $nombre_completo ?></div>
                 <table class="table table-striped table-hover">
                    <thead>
                        <tr class="active">
                            <th >#</th>
                            <th>Fecha</th>
                            <th>Nivel</th>
                            <th>Universiad</th>
                            <th>Denominaci&oacute;n</th>
                            <th>Especialidad</th>
                            <th>Registro</th>
                            <th>Estado</th>
                            <th>OP</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                    <?php $i=1;
						foreach($data_diplomas as $row){?>
                    <tr>
                            <td ><?php echo $i ?></td>
                            <td><?php echo $row["fecha"] ?></td>
                            <td><?php echo $row["nivel"] ?></td>
                            <td><?php echo $row["universidad"] ?></td>
                            <td><?php echo $row["denominacion"];?></td>
                            <td><?php echo $row["especialidad"];?></td>
                            <td><?php echo $row["nro_reg"];?></td>
                            <td><?php echo u_vigencia($row["estado"]);?></td>
                            <td ><a href="javascript:fn_controlDiplomas('<?php echo $row["cc_diplomas"]?>','<?php echo $row["cc_persona"]?>','U');" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                <a href="javascript:fn_eliminarDiplomas('<?php echo $row["cc_diplomas"]?>','<?php echo $row["cc_persona"]?>');" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a></td>
                        </tr>
                    <?php $i++;}?>
                    	</tbody>
					</table>
                 </div>
                 </div>
                    
                </div>
        
        
    </div>
  </div>



<div class="modal inmodal" id="modalRegistro" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
        
        </div>
    </div>
</div>

<div class="modal inmodal" id="modalRegistrolg" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
        
        </div>
    </div>
</div>

	
