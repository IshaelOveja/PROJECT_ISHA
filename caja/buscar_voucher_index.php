<?php 
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_caja.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();
$bo_general  = new bo_general();
$bo_caja  = new bo_caja();

$data_banco=$bo_general->banco_cuentas('%');
?>

<div class="row">


<div class="row">
    <div class="col-sm-12">
  <form  class="form-horizontal" action="javascript:fn_buscarRegistro();" role="form" id="frmBuscarRegistro" >
    

   <div class="form-group">
   <label for="digitos" class="col-sm-3 control-label">CUENTA BANCARIA :</label>
    <div class="col-sm-2">
	<select class="form-control" name="cc_banco" id="cc_banco" >
            <option ></option>
        <?php foreach($data_banco as $c){ ?>
           <option value="<?php echo $c["id"]?>"><?php echo "(".$c["id"].")".$c["nombre"] ?></option>
         <?php }?>
    	</select>
       </select>
    </div>
	<label for="desde" class="col-sm-1 control-label">NUMERO:</label>
    <div class="col-sm-2">
      <input name="numero" type="text" id="numero" placeholder="numero" class="form-control"  minlength="2" maxlength="9" />
    </div>
	
    <div class="col-sm-2"></div>
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
