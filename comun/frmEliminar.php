<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
$cc_id1=$_REQUEST["cc_id1"];
$cc_id2=$_REQUEST["cc_id2"];
$opc=$_REQUEST["opc"];
?>
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> 
  <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminación </h4> 
</div> 
<div class="modal-body" id="divAvisoEliminar">
  <div class="alert alert-success text-center"> 

      <p id="divAvisoEliminar"><strong>AVISO!</strong> &iquest;Esta seguro de eliminar?</p>
        
  </div>
     
</div> 
<div class="modal-footer"> 
    <input type="text" class="hide" name="cc_id1" id="cc_id1" value="<?php echo $cc_id1?>"/>
    <input type="text" class="hide" name="cc_id2" id="cc_id2" value="<?php echo $cc_id2?>"/> 
    <input type="text" class="hide" name="opc_del" id="opc_del" value="<?php echo $opc?>"/>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  <a href="javascript:fn_eliminar();" class="btn btn-primary">Eliminar</a>
 
</div>
