<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_familiares.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
s_validar_pagina();
$cc_persona=$_REQUEST["cc_persona"];

$bo_personas = new bo_gen_personas();
$bo_familiares         = new bo_gen_personas_familiares();
$ent_familiares            = new gen_personas_familiares();


$data_familia  = $bo_familiares->listar($cc_persona);


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
                <h1 class="m-b-xs"><a href="javascript:fn_controlFamilia('','<?php echo $cc_persona?>','I');" class="btn btn-info" role="button"> <i class="fa fa-plus"></i> Nuevo</a></h1>
           	 
             <div id="imprimir">
                 <div id="TablaExportar">
                 <div class="text-center"><h3><strong>DATOS DE FAMILIARES</strong></h3></div>
                 <div>C&oacute;digo (<?php echo $codigo ?>) <i class="fa fa-angle-double-right"></i> <?php echo $nombre_completo ?></div>
                 <table class="table table-striped table-hover">
                    <thead>
                        <tr class="active">
                            <th >#</th>
                            <th>Fec. Nacimiento</th>
                            <th>Nombre</th>
                            <th>Parentesco</th>
                            <th>Estado</th>
                            <th>OP</th>
                        </tr>
                    </thead>
                    
                    <tbody >
                    <?php $i=1;
						foreach($data_familia as $row){?>
                    <tr>
                            <td ><?php echo $i ?></td>
                            <td><?php echo $row["fecha_nacimiento"] ?></td>
                            <td><?php echo $row["nombres"];?></td>
                            <td><?php echo $row["parentesco"];?></td>
                            <td><?php echo u_vigencia($row["estado"]);?></td>
                            <td ><a href="javascript:fn_controlFamilia('<?php echo $row["cc_familiares"]?>','<?php echo $row["cc_persona"]?>','U');" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                <a href="javascript:fn_eliminarFamilia('<?php echo $row["cc_familiares"]?>','<?php echo $row["cc_persona"]?>');" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a></td>
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

	
