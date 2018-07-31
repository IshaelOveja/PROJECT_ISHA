<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_seg_perfil.php");
s_validar_pagina();
$bo_general         = new bo_general();
$bo_perfil   = new bo_seg_perfil();
$perfil      = new seg_perfil();
$data_perfil = $bo_perfil->listar($perfil);
$dat_url=$bo_general->url($codigo);
foreach($dat_url as $url){
	$urlc=$url["ruta"];
}
$data_perfil = $bo_perfil->listarContar();
echo tituloLik($urlc);
$nomNombre = "";
?>
<div class="row">
    <div class="col-12">
  			<div class="panel-body"><h2><strong>Informaci&oacute;n del Colegiado</strong></h2></div>

            <form class="form-horizontal" action="javascript:fn_buscarColegiado();" role="form" id="frmBuscarColegiado">
            <div class="form-group">
             <div class="col-sm-2"></div>
               <div class="col-sm-2">
               <input name="c_colegiado" id="c_colegiado" placeholder="000000" type="text" class="form-control" />
               </div>
                <div class="col-sm-4">
                <div class="input-group">
                <input name="nomNombre" placeholder="Apellidos del Colegiado" type="text" id="nomNombre" disabled class="form-control" value="<?php echo $nomNombre ?>" />
                 <span class="input-group-btn">
                	<button type="button" id="BuscarColegiado" class="btn btn-info">
                              <i class="fa fa-search"></i>
                              </button></span>
                </div>
                
                    
                    
                    
                </div>
                <div class="col-sm-2"><button type="submit" class="btn btn-info" id="example"><i class="fa fa-search"></i> Buscar</button></div>
             </div>
            
        	</form>
                <div class="table-responsive">
                    <div id="divListarRegistro"></div>
                </div>
        </div>
</div>


<div class="modal fade bs-example-modal-lg" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>
