<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
//require_once(u_src()."bo/bo_gen_categoria.php"); 
s_validar_pagina();
//$bo_categoria   = new bo_gen_categoria();
//$categoria       = new gen_categoria();
//$data_categoria  = $bo_categoria->listarCombo($categoria);
$opcion = "BUSCAR PERSONAL";
?>
<div class="modal-header">
<h4 class="modal-title"><?php echo $opcion; ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    
</div>
<div class="modal-body">

        <form class='form-horizontal' action='javascript:fn_buscarNuevoUsuario();' role='form' id='frmBuscarNewUsuario'>
         <div class="form-group row">
            <label for='ct_nombreser' class='col-sm-3 control-label'>Apellidos y Nombres:</label>
                <div class='col-sm-9'>
                    <input type='text' placeholder='' class='form-control input-sm' name='ct_nombreper' id='ct_nombreper'/>
                </div>
            </div>
            <div class="form-group m-b-0">
                 <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
            </div>
            </div>
           <div class="form-group">
                <div class='col-sm-12'>
                    <div class='table-responsive' id='divListaUsuario'></div>
                </div>
                
            </div>
        </form>
        
</div>
<div class="modal-footer" id="divGuardarPerError">
	
    <h5>*Datos Obligatorios</h5>
</div>
