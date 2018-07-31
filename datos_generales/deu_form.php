<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_estado_cuenta.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 

s_validar_pagina();
$opc             = $_REQUEST["opc"];
$cc_persona     = $_REQUEST["cc_persona"];
$cc_estcta     = $_REQUEST["cc_estcta"];


$bo_cuenta= new bo_fin_estado_cuenta();
$bo_personas= new bo_gen_personas();

$ent_cuenta= new fin_estado_cuenta();

$opcion="Agregar amortizaci&oacute;n de deuda";
if($opc=="U"){
    $data_con=$bo_cuenta->listarId($cc_estcta);
    foreach($data_con as $row){
		$ent_cuenta->setCc_descripcion($row["cc_descripcion"]);
		$ent_cuenta->setCt_monto($row["ct_monto"]);
        
    }
    $opcion="Modificar amortizaci&oacute;n de deuda";
}
//$data_concepto=$bo_concepto->Selectlistar("I");
$dat_personas=$bo_personas->listarPersonas();
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
    
    <form class="form-horizontal" action="javascript:fn_grabarRegistro();" role="form" id="frmGrabarRegistro">
       <div class="form-group">
        <label for="cc_descripcion" class="col-sm-3 control-label">Descripci&oacute;n:</label>
        <div class="col-sm-8">
            <input type="text" placeholder="Descripcion" class="form-control input-sm" value="<?php echo $ent_cuenta->getCc_descripcion();?>" name="cc_descripcion" id="cc_descripcion"/>
      </div>
      </div>
      <div class="form-group">
        <label for="ct_monto" class="col-sm-3 control-label">Monto:</label>
        <div class="col-sm-4">
            <input type="number" step="0.1" placeholder="Monto" class="form-control input-sm" value="<?php echo $ent_cuenta->getCt_monto();?>" name="ct_monto" id="ct_monto"/>
      </div>
      </div>
      

        <div class="form-group">
            <div class="col-sm-12 text-center">
                <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit">
                    <strong>GUARDAR</strong>
                </button>
            </div>

        </div>
        <div class="form-group hide">
              <div class="col-sm-6">
                <input type="text" placeholder="paginas" class="input-sm" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="paginas" class="input-sm" name="cc_persona" value="<?php echo $cc_persona ?>" id="opc"/>
              </div>
              <div class="col-sm-6">
                <input type="text" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_estcta ?>"  name="cc_estcta" id="cc_estcta"/>
          </div>

        </div>
    </form>

</div>
<div class="modal-footer" id="divGuardarSerError">
	
    <h5>*Datos Obligatorios</h5>
</div>
<script type="text/javascript">
$(document).ready(function(){
			
    $('#frmGrabarRegistro').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            cc_persona:{
                message:"Seleccionar",
                validators:{
                    notEmpty:{
                        message:"Seleccionar"
                    }
                }
            },
			cc_descripcion:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			ct_monto:{
                message:"Monto",
                validators:{
                    notEmpty:{
                        message:"Monto"
                    },
					 notEmpty:{
                        message:"Monto"
                    }
					
                }
            }
           
        }
    });
    
    
});
</script>


