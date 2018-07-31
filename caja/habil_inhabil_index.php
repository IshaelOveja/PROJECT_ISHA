<?php 
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_ec_reporte.php");
 
s_validar_pagina();

$bo_caja  = new bo_caja();
$data_periodos= $bo_caja->periodos_habilitacion();
?>

<div class="row">
      <div class="panel-body"><h2><strong>HABILES-INHABILES POR PERIODO</strong></h2></div>


<div class="row">
    <div class="col-sm-12">
  <form class="form-horizontal" action="javascript:fn_buscarRegistro();" role="form" id="frmBuscarRegistro">
   <div class="form-group">
      <label for="X" class="col-sm-2 control-label">PERIODO:</label>
      <div class="col-sm-2">
     <select name="periodo" id="periodo" class="form-control" required>
     <option ></option>
    	<?php foreach($data_periodos as $ro){ ?>
		<option value="<?php echo $ro["anho"].$ro["mes"]?>"  ><?php echo $ro["data"] ?></option>
         <?php }?>
        </select>
     </div>  
      <label for="tipo" class="col-sm-1 control-label">TIPO:</label>
      <div class="col-sm-2">
     <select name="tipo" id="tipo" class="form-control" >
      <option value="R">RESUMEN</option>
      <option value="D">DETALLE</option>
    	</select>
            


     
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
