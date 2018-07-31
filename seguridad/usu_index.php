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
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <!-- <h4 class="list-group-item active">Usuarios</h4>-->
                        <form class="form-horizontal" action="javascript:fn_buscarUsuario();" role="form" id="frmBuscarUsuario">
                        <div class="form-group row">
                        	<div class="col-sm-4"></div>
                            <div class="col-sm-4">
                              <select class="form-control"  name="cc_perfilb" id="cc_perfilb">
                             <option value="" >Perfil</option> 
                              <?php 
                             foreach($data_perfil as $row){
                             ?>
                                <option value="<?php echo $row["cc_perfil"] ?>"><?php echo $row["ct_perfil"] ?></option>
                             <?php
                             }
                             ?>
                            </select>
                            </div>
                            <div class="col-sm-4"></div>
                          </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-info" id="example"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                
                        </div>
                      <div class="form-group hide" >
                          <div class="col-sm-6">
                        <input type="hidden" name="pagPagina" id="pagPagina" value="1">
                        <input type="hidden" name="pagMostrar" id="pagMostrar" value="10">
                          </div>
                          
            
                    </div>
                    </form>
                    <div class="table-responsive">
                    <span class="pull-right text-right">
                        <small><?php echo bt_imprimir(1,1) ?></small>
                        </span>
                         <h1 class="m-b-xs"><a href="javascript:fn_controlRegistro('','I');" class="btn btn-info" role="button"> <i class="fa fa-plus"></i> Nuevo</a></h1>
                     
                     		<div id="imprimir">
                        	 <div id="TablaExportar">
                             <table id="tableID" class="display nowrap table table-hover table-striped table-bordered"><!--table-sm-->
                              <thead>
                                <tr class="active">
                                    <th >ID</th>
                                    <th >Usuario</th>
                                    <th >Apellidos y Nombres</th>
                                    <th >Perfil</th>
                                     <th >Celular</th>
                                    <th >Acceso</th>
                                    <th >OP</th>
                                   
                                </tr>
                            </thead>
                                <tbody id="divListarUsuario">
                                </tbody>
							</table>
                      
    		</div>
		</div>
	</div>
</div>


<div class="modal fade bs-example-modal-lg" id="modalUsuario" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modalNewUsuario" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>



