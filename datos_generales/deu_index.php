<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");

s_validar_pagina();
?>
<div class="row">
<?php echo u_cabecera_form("Estado de cuenta Cr&eacute;ditos"); ?>

<div class="row">
    <div class="col-sm-12"><br/>
  <form class="form-horizontal" action="javascript:fn_buscarRegistro();" role="form" id="frmBuscarRegistro">
   <div class="form-group">
   <label for="opfecha" class="col-md-2 control-label">DNI : </label>
    <div class="col-md-2">
        <input name="ct_nro_doc" type="text" id="ct_nro_doc" placeholder="DNI" class="form-control" />
        <input name="cc_persona" type="hidden" id="cc_persona" class="form-control" />
    </div>
     <label for="opfecha" class="col-md-1 control-label">Cliente : </label>
                <div class="col-md-5">
                <div class="group">
                <div class="input-group">
                <input name="nomCliente" placeholder="Nombre cliente" type="text" id="nomCliente" class="form-control" required  value="<?php echo $nomCliente ?>" />
                 <span class="input-group-btn"> <button type="button" id="BuscarCliente" class="btn btn-primary">
                  <span class="glyphicon glyphicon-search"></span>
                  </button></span></div>
                  </div>
                </div>
   </div>
  <div class="form-group">
        <div class="col-sm-12 text-center">
            <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit">
                <strong>BUSCAR</strong>
            </button>
            <button class="btn btn-sm btn-primary  m-t-n-xs" type="reset">
                <strong>CANCELAR</strong>
            </button>
    </div>
</div>
<div class="form-group hide" >
          <div class="col-sm-6">
            <input type="text" placeholder="paginas" class="input-sm" name="pagPagina" id="pagPagina"/>
          </div>
          <div class="col-sm-6">
            <input type="text" placeholder="mostrar" class="rm-control input-sm" name="pagMostrar" id="pagMostrar"/>
            </div>

    </div>
    
</form>
</div>
<?php echo u_pie_form();?>
    </div>
</div>
<div class="row">
    <div class="lpanel panel-primary">
    <div class="table-responsive">
    	<div id="divListarRegistro"></div>
    </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
