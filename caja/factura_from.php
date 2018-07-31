<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_parametro_det.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_fin_documento.php"); 
s_validar_pagina();

$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_general           = new bo_general();
$bo_documento          = new bo_fin_documento();
$data_documento = $bo_documento->ListarCajasUser(s_usuario_id());
$opc = "I";
if($codigo=="2112"){
	$_SESSION["SES_COD_UNICO"] = date('Ymdhisitis');
}
$dat_url=$bo_general->url($codigo);
foreach($dat_url as $url){
	$urlc=$url["ruta"];
}
echo tituloLik($urlc);
?>
<hr />

<div class="row">
    <div class="col-sm-12">
    <form id="frmFormulario" class="form-horizontal"  action="javascript:fn_IngresarCaja();"  name="frmFormularioCaja" method="post">
    <div class="row">
    <div class="col-sm-10">
    <div class="form-group">
            <label class="col-md-2 control-label">Cliente : </label>
            <div class="col-md-6">
            <input type="hidden" name="cc_persona" id="cc_persona" class="form-control" />
            <input type="text" name="nombres" id="nombres" class="form-control" autocomplete="off" placeholder="Cliente" />
         </div>
    </div>
    
    <div class="form-group">
       <label for="tp_documento" class="col-sm-2 control-label">Documento:</label>
        <div class="col-sm-2">
            <select name="cod_documento" id="cod_documento"  onChange="fn_numCorrelativo(this.value)" class="form-control">
                    <option ></option>
                    <?php
                        foreach($data_documento as $row){
                    ?>
                    <option value="<?php echo $row["nombre_corto"]?>" ><?php echo $row["nombre"]?></option>
                  <?php }?>
            </select>
            </div>
            <label for="numero" class="col-sm-1 control-label">Numero :</label>
                <div class="col-md-2">
                  <input name="numero" type="text" id="numero" class="form-control"/>
              </div>
           <label for="fecha" class="col-sm-1 control-label">Fecha :</label>
                <div class="col-md-2">
                  <input name="fecha" type="text" id="fecha" value="<?php echo date("d/m/Y") ?>"  class="form-control" disabled />
              </div>
        </div>
  
<div class="form-group">
          <label for="cc_uniorgb" class="col-sm-2 control-label">Observaci&oacute;n:</label>
                <div class="col-sm-7">
                  <input name="obs" type="text" class="form-control" id="obs" value="" size="35" />
                </div>
        </div>
        <div class="form-group">
                <div class="col-sm-12">
                 <div  id="divDetalle"></div>
                </div>
        </div>
        
    </div>
    <div class="col-sm-2">
    pago
    </div>
    
    </div>
    <div class="row">

    <div class="col-sm-12 text-center">
  		<button class="btn  btn-primary  " id="btngarbarcaja"  type="submit">
                        <strong> <span class="glyphicon glyphicon-cog"></span> PROCESAR</strong>
                    </button>
                    <button class="btn  btn-primary  " id="btnNuevo" style="display:none"  type="button">
                        <strong><span class="glyphicon glyphicon-file"></span> NUEVO DOCUMENTO</strong>
                    </button>
                    <button class="btn  btn-primary  " id="btnImprimir" style="display:none"  type="button">
                        <strong><span class="glyphicon glyphicon-print"></span> IMPRIMIR</strong>
                    </button>
                    <button class="btn  btn-primary" id="btnCancelar"   type="button">
                        <strong><span class="glyphicon glyphicon-remove"></span> CANCELAR</strong>
                    </button>
    </div>
    </div>
    </form>
     
</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg"><!--modal-lg-->
        <div class="modal-content animated fadeIn"></div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
     $('#frmFormularioCaja').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
			nop:{
                message:"Numero de Operacion",
                validators:{
                    notEmpty:{
                        message:"Numero de Operacion"
                    }
                }
            },
			caj_total:{
                message:"Detalle del Documento",
                validators:{
                    notEmpty:{
                        message:"Detalle del Documento"
                    }
                }
            },
			/*nomCliente:{
                message:"Ingrese nombre del cliente",
                validators:{
                    notEmpty:{
                        message:"Ingrese nombre del cliente"
                    }
                }
            },*/
			tp_documento:{
                message:"Selecciona tipo de Documento",
                validators:{
                    notEmpty:{
                        message:"Selecciona tipo de Documento"
                    }

                }
            },
            tipo_pago:{
                message:"Selecciona tipo de pago",
                validators:{
                    notEmpty:{
                        message:"Selecciona tipo de pago"
                    }
                    /*stringLength:{
                        min:3,
                        max:50,
                        message:"Debe ser mayor a 5 caracteres "
                    }*/
                }
            },
            banco:{
                message:"Selecciona el Banco",
                validators:{
                    notEmpty:{
                        message:"Selecciona el Banco"
                    }
                }
            }
			/*,
            nopz:{
                message:"numero de Operacion",
                validators:{
                    notEmpty:{
                        message:"numero de Operacion"
                    },
					stringLength:{
						min:2,
                        max:8,
                        message:"Obviar los ceros de la izquierda"
                    }
                }
            }*/
        }
    });

});
</script>
