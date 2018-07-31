<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_seg_perfil.php"); 
s_validar_pagina();
$bo_general         = new bo_general();
$bo_perfil         = new bo_seg_perfil();
$perfil            = new seg_perfil();
$dat_url=$bo_general->url($codigo);
foreach($dat_url as $url){
	$urlc=$url["ruta"];
}
$data_perfil  = $bo_perfil->listar($perfil);
echo tituloLik($urlc);
?>
<div class="row">
    <div class="col-12">
                <div class="table-responsive">
                
                <span class="pull-right text-right">
                <small><?php echo bt_imprimir(1,1) ?></small>
                </span>
                <h1 class="m-b-xs"><a href="javascript:fn_controlRegistro('','I');" class="btn btn-info" role="button"> <i class="fa fa-plus"></i> Nuevo</a></h1>
           	 
             <div id="imprimir">
                 <div id="TablaExportar">
                 <table class="table table-striped table-hover">
                    <thead>
                        <tr class="active">
                            <th >#</th>
                            <th>Pefil</th>
                            <th>Modulo defecto</th>
                            <th>Estado</th>
                            <th>OP</th>
                        </tr>
                    </thead>
                    
                    <tbody id="divListarPerfil" >
                    	</tbody>
					</table>
                 </div>
                 </div>
                    
                </div>
        
        
    </div>
  </div>



<div class="modal inmodal" id="modalPerfil" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
        
        </div>
    </div>
</div>

