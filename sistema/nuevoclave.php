<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_modulo_usuario.php"); 
require_once(u_src()."bo/bo_seg_modulo.php"); 
require_once(u_src()."bo/bo_eval_periodo.php"); 
require_once(u_src()."bo/bo_seg_modulo_pagina.php"); 


s_validar_pagina();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="iso-8859-1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>SIGA</title>
        <link rel="shortcut icon" href="<?php echo u_img() ?>favicon.ico" />
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../bootstrap/css/bootstrapValidator.min.css" rel="stylesheet"/>
        
    </head>
<body>
     <script src="../js/jquery-1.11.3.min.js"></script>
     <script src="../bootstrap/js/bootstrap.min.js"></script> 
     <script src="../bootstrap/js/bootstrapValidator.min.js"></script>
     <div class="container-fluid">
         <div class="row">
             <div class="col-sm-12 bg-primary text-center">
                 <H3> BIENVENIDOS A SIGA</h3>
             </div>
             
         </div> 
         <div class="row">
             <br/>
         </div>   
        <div class="row">
            <div class="container">
            <div class="col-sm-12">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 thumbnail">
                    <div class="row">
                   
                    <div class="col-sm-12">

                        <h5 class="m-t-none m-b">USUARIOS NUEVO - CAMBIO DE CLAVE</h5>

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
                                        <strong>Cambiar</strong>
                                    </button>
                                </div>

                            </div>
                             <div class="form-group">
                                <div class="col-sm-12 text-center" id="divGuardarClaveError">
                                    <h5>*Datos Obligatorios</h5>
                                </div>

                            </div>

                        </form>
                    </div>
                        </div>
                </div>   
                <div class="col-sm-3"><a href="salir.php" class="hide" id="salir_link">Salir</a></div>
            </div>
           
        </div>
    </div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
    
   
   $("#salir_link").click(function() { 
     location.href = this.href; 
    });
    

       
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
                        message: 'Debe ser diferente a clve anterior'
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

function fn_guardarClave(){
    
    var str = $("#frmCambiarClaveEdit").serialize();
    $('#divGuardarClaveError').html('<img src="../img/loading.gif" />');
    
    $.ajax({
		url: 'clave_update_nuevo.php',
		type: 'post',
		data: str,
		success: function(data){
                        var mensaje=data;
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarClaveError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha cambiado correctamente</div>');
                         
                            fn_salirClave();
                           
                        }else{
                           
                            $('#divGuardarClaveError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
}

function  fn_salirClave(){
 
    $("#salir_link").click();
}

</script>
</body>
</html>
