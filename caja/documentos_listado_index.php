<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");

s_validar_pagina();


$fecha=date("d/m/Y");
?>
<div class="row">

<div class="panel-body">
  <h2><strong>Listado de Documentos (Fac, Bol, Rec</strong>)</h2></div>
<div class="row">
    <div class="col-sm-12">
  <form class="form-horizontal" action="javascript:fn_buscarRegistro();" role="form" id="frmBuscarRegistro">
    <div class="form-group">

   
      <label for="fec_desde" class="col-sm-1 control-label">Desde:</label>
    <div class="col-sm-2" id="fec_desde">
    <div class="input-group date">
         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
             <input type="text" id="fec_desde"  class="form-control" name="fec_desde" value="<?php echo $fecha ?>">
           </div>

    </div>
   <label for="fec_hasta" class="col-sm-1 control-label">Hasta:</label>
    <div class="col-sm-2" id="fec_hasta">
    <div class="input-group date">
         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
             <input type="text" id="fec_hasta"  class="form-control" name="fec_hasta" value="<?php echo $fecha ?>">
           </div>

    </div>
    <div class="col-sm-1"></div>
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

    </div>
</div>

<div class="row">
    <div class="lpanel panel-primary">
    <div class="table-responsive">
    <div class="input-group pull-right">
    	<?php echo bt_imprimir(1,1) ?>
	 	</div>
    		<div id="divListarRegistro"></div>
        </div>
    </div>
 </div>
 
   
<div class="modal fade bs-example-modal-sm" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="modalNewRegistro" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
