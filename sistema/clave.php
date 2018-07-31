<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_usuario.php"); 
s_validar_pagina();
$bo_usuario    = new bo_seg_usuario();
$cc_usuario    = s_usuario_id();



$opcion="CAMBIAR CLAVE";


?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
    
    <form class="form-horizontal" method="post" action="javascript:fn_guardarClave();" role="form" id="frmCambiarClaveEdit">
      <div class="form-group">
        <label for="cc_usuario" class="col-sm-4 control-label">Apellidos y Nombres:</label>
        <div class="col-sm-8">
            <p class="form-control-static"><?php echo s_usu_nombre(); ?></p>        
        </div>
        </div>
        
        <div class="form-group">
        <label for="cc_user" class="col-sm-4 control-label">Usuario:</label>
        <div class="col-sm-8">
            <p class="form-control-static"><?php echo s_usuario(); ?></p> 
            <input type="text" placeholder="Clave" class="hide" value="<?php echo s_usuario(); ?>" name="cc_user" id="cc_user"/>
        </div>
      </div>
      <div class="form-group">
        <label for="ct_clavea" class="col-sm-4 control-label">*Clave Anterior:</label>
        <div class="col-sm-8">
            <input type="password" placeholder="Clave" class="form-control input-sm" value="" name="ct_clavea" id="ct_clavea"/>
        </div>
      </div>
        <div class="form-group">
        <label for="ct_clave" class="col-sm-4 control-label">*Clave:</label>
        <div class="col-sm-8">
            <input type="password" placeholder="Clave" class="form-control input-sm" value="" name="ct_clave" id="ct_clave"/>
        </div>
      </div>
        <div class="form-group">
        <label for="ct_claver" class="col-sm-4 control-label">*Repite Clave:</label>
        <div class="col-sm-8">
            <input type="password" placeholder="Repite Clave" class="form-control input-sm" value="" name="ct_claver" id="ct_claver"/>
        </div>
      </div>
       
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <button class="btn btn-sm btn-primary  m-t-n-xs" id="btnGrabarUsuario" type="submit">
                    <strong>Grabar</strong>
                </button>
            </div>

        </div>

    </form>

</div>
<div class="modal-footer" id="divGuardarClaveError">
	
    <h5>*Datos Obligatorios</h5>
</div>
<script type="text/javascript">
$(document).ready(function(){
       
    $('#frmCambiarClaveEdit').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            ct_clavea: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese Clave Anterior'
                    },
                   remote: {
                        type: 'POST',
                        url: '../seguridad/usu_clave_ant.php',
                        message: 'Clave anterior incorrecto'
                    }
                    
                }
            },
            ct_clave: {
                validators: {
                     notEmpty: {
                        message: 'Ingrese Clave'
                    },                   
                    different: {
                        field: 'ct_clavea',
                        message: 'Debe ser diferente a usuario'
                    }
                        
                }
            },
            ct_claver: {
                validators: {
                     notEmpty: {
                        message: 'Ingrese Clave Repiter'
                    },
                    identical: {
                        field: 'ct_clave',
                        message: 'Debe ser igual a clave'
                    }
                }
            }
            
        }
    });

    
});

</script>
