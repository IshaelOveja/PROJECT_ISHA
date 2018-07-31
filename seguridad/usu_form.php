<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php"); 
require_once(u_src()."bo/bo_seg_usuario.php"); 
require_once(u_src()."bo/bo_seg_perfil.php");
s_validar_pagina();
$opc           = $_REQUEST["opc"];
$cc_usuario    = $_REQUEST["cc_usuario"];

$bo_empleado   = new bo_gen_personas();
$bo_usuario    = new bo_seg_usuario();
$usuario       = new seg_usuario();

$bo_perfil     = new bo_seg_perfil();
$perfil        = new seg_perfil();


$data_empleado = $bo_empleado->listarId($cc_usuario);
$ct_ct_nombres="";
foreach($data_empleado as $row){
    $nombre=$row["nombre"];
}

$opcion="Nuevo Usuario";

if(($opc=="U") or ($opc=="T")){
    $data_usuario=$bo_usuario->listarId($cc_usuario);
    foreach($data_usuario as $row){
        $usuario->setCc_usuario($row["cc_usuario"]);
        $usuario->setCc_user($row["cc_user"]);
        $usuario->setCc_perfil($row["cc_perfil"]);
        $usuario->setCfl_acceso($row["cfl_acceso"]);
        
    }
    $opcion="Modificar Usuario";
   
}
$data_perfil   = $bo_perfil->listar($perfil);
$disa="";
if($opc=="U"){
   $disa=' readonly="readonly" '; 
}




?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>

<div class="modal-body">
    
    <form class="form-horizontal" method="post" action="javascript:fn_grabarUsuario();" role="form" id="frmGrabarUsuario">
    <?php if($opc=="I"){?>
      <div class="form-group row">
        <label for="cc_usuario" class="col-sm-3 control-label text-right">Nombres: </label>
        <div class="col-sm-8">
            <p class="form-control-static"><?php echo $cc_usuario; ?>-<?php echo $nombre;?></p>        
        </div>
        </div>
       <div class="form-group row">
      
        <label for="cc_perfil" class="col-sm-3 control-label text-right">Perfil <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <select class="form-control" name="cc_perfil" required data-validation-required-message="Obligatorio">
             <option valua=""></option> 
              <?php 
             foreach($data_perfil as $row){
             ?>
                <option value="<?php echo $row["cc_perfil"] ?>" <?php if($row["cc_perfil"]==$usuario->getCc_perfil()){echo "selected"; }else{ echo "";}  ?>><?php echo $row["ct_perfil"] ?></option>
             <?php
             }
             ?>
            </select>
        </div>
        </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Usuario <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <input type="text" placeholder="Usuario" class="form-control" value="<?php echo $usuario->getCc_user();?>" name="cc_user" id="cc_user" <?php echo $disa ?>required data-validation-required-message="Obligatorio"/>
        </div>
      </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Clave <span class="text-danger">*</span></label>
        <div class="col-sm-8 controls">
            <input type="password" placeholder="Clave" class="form-control" value="" name="ct_clave" id="ct_clave" required data-validation-required-message="Obligatorio"/>
        </div>
      </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Repite clave <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <input type="password" placeholder="Repite Clave" class="form-control" value="" name="ct_claver" id="ct_claver"  data-validation-match-match="ct_clave" required/>
        </div>
      </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right"></label>
         <div class="col-sm-9 material-switch">
                    <?php
					$clase=' class="disabled" ' ;
					$cheked = "";
					if($opc=="U"){
						$clase="";
					}
					 if($usuario->getCfl_acceso()=="1"){
						$cheked = ' checked="checked" ';
					}
					?>
            
                <input type="checkbox" name="cfl_acceso" id="cfl_acceso" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="cfl_acceso" class="label-info"></label> Acceso
                </div>
        
      </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                 <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Guardar</button>
                <button type="button" class="btn btn-warning waves-effect text-left" data-dismiss="modal"><i class="fa fa-power-off"></i> Cerrar</button>
            </div>

        </div>
        <div class="form-group hide">
              <div class="col-sm-6">
                <input type="text" placeholder="paginas" class="input-sm" name="opc" value="<?php echo $opc ?>" id="opc"/>
              </div>
              <div class="col-sm-6">
                <input type="text" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_usuario ?>"  name="cc_usuario" id="cc_usuario"/>
                </div>

        </div>
       <?php }elseif($opc=="U"){?>
       <div class="form-group row">
        <label for="cc_usuario" class="col-sm-3 control-label text-right">Nombres: </label>
        <div class="col-sm-8">
            <p class="form-control-static"><?php echo $cc_usuario; ?>-<?php echo $nombre;?></p>        
        </div>
        </div>
       <div class="form-group row">
        <label for="cc_perfil" class="col-sm-3 control-label text-right">Perfil <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <select class="form-control" name="cc_perfil" required data-validation-required-message="Obligatorio">
             <option valua=""></option> 
              <?php 
             foreach($data_perfil as $row){
             ?>
                <option value="<?php echo $row["cc_perfil"] ?>" <?php if($row["cc_perfil"]==$usuario->getCc_perfil()){echo "selected"; }else{ echo "";}  ?>><?php echo $row["ct_perfil"] ?></option>
             <?php
             }
             ?>
            </select>
        </div>
        </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Usuario <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <input type="text" placeholder="Usuario" class="form-control" value="<?php echo $usuario->getCc_user();?>" name="cc_user" id="cc_user" <?php echo $disa ?>required data-validation-required-message="Obligatorio"/>
        </div>
      </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right"></label>
          <div class="col-sm-9 material-switch">
                    <?php
					$clase=' class="disabled" ' ;
					$cheked = "";
					if($opc=="U"){
						$clase="";
					}
					 if($usuario->getCfl_acceso()=="1"){
						$cheked = ' checked="checked" ';
					}
					?>
            
                <input type="checkbox" name="cfl_acceso" id="cfl_acceso" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="cfl_acceso" class="label-info"></label> Acceso
                </div>
        
      </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                 <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Guardar</button>
                <button type="button" class="btn btn-warning waves-effect text-left" data-dismiss="modal"><i class="fa fa-power-off"></i> Cerrar</button>
            </div>

        </div>
        <div class="form-group hide">
              <div class="col-sm-6">
                <input type="text" placeholder="paginas" class="input-sm" name="opc" value="<?php echo $opc ?>" id="opc"/>
              </div>
              <div class="col-sm-6">
                <input type="text" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_usuario ?>"  name="cc_usuario" id="cc_usuario"/>
                </div>

        </div>
        <?php }else{?>
        <div class="form-group row">
        <label for="cc_usuario" class="col-sm-3 control-label text-right">Nombres: </label>
        <div class="col-sm-8">
            <p class="form-control-static"><?php echo $cc_usuario; ?>-<?php echo $nombre;?></p>        
        </div>
        </div>
       <div class="form-group row hide">
        <label for="cc_perfil" class="col-sm-3 control-label text-right">Perfil <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <select class="form-control" name="cc_perfil" required data-validation-required-message="Obligatorio">
             <option valua=""></option> 
              <?php 
             foreach($data_perfil as $row){
             ?>
                <option value="<?php echo $row["cc_perfil"] ?>" <?php if($row["cc_perfil"]==$usuario->getCc_perfil()){echo "selected"; } ?>><?php echo $row["ct_perfil"] ?></option>
             <?php
             }
             ?>
            </select>
        </div>
        </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Usuario <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <input type="text" placeholder="Usuario" class="form-control" value="<?php echo $usuario->getCc_user();?>" name="cc_user" id="cc_user" readonly required data-validation-required-message="Obligatorio"/>
        </div>
      </div>
       <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Clave <span class="text-danger">*</span></label>
        <div class="col-sm-8 controls">
            <input type="password" placeholder="Clave" class="form-control" value="" name="ct_clave" id="ct_clave" required data-validation-required-message="Obligatorio"/>
        </div>
      </div>
        <div class="form-group row">
         <label for="cc_perfil" class="col-sm-3 control-label text-right">Repite clave <span class="text-danger">*</span></label>
        <div class="controls col-sm-8">
            <input type="password" placeholder="Repite Clave" class="form-control" value="" name="ct_claver" id="ct_claver"  data-validation-match-match="ct_clave" required/>
        </div>
      </div>
      <div class="form-group row hide">
          <div class="checkbox material-switch">
                    <?php
					$clase=' class="disabled" ' ;
					$cheked = "";
					if($opc=="U"){
						$clase="";
					}
					 if($usuario->getCfl_acceso()=="1"){
						$cheked = ' checked="checked" ';
					}
					?>
            	<input type="checkbox" name="cfl_acceso" id="cfl_acceso" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="cfl_acceso" class="label-info"></label> Acceso
              
                </div>
        
      </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                 <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Guardar</button>
                <button type="button" class="btn btn-warning waves-effect text-left" data-dismiss="modal"><i class="fa fa-power-off"></i> Cerrar</button>
            </div>

        </div>
        <div class="form-group hide">
              <div class="col-sm-6">
                <input type="text" placeholder="paginas" class="input-sm" name="opc" value="U" id="opc"/>
              </div>
              <div class="col-sm-6">
                <input type="text" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_usuario ?>"  name="cc_usuario" id="cc_usuario"/>
                </div>

        </div>
        <?php } ?>
    </form>

</div>
<div class="modal-footer" id="divGuardarUsuError">
	
    <h5>*Datos Obligatorios</h5>
</div>
<script type="text/javascript">
$(document).ready(function(){
   
    
    $('#frmGrabarUsuario').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            cc_perfil:{
                message:"Seleccione Perfil",
                validators:{
                    notEmpty:{
                        message:"Seleccione Perfil"
                    }
                }
            },
            cc_user:{
                message:"Ingrese Usuario",
                validators:{
                    notEmpty: {
                        message: 'Ingrese usuario'
                    },
                    stringLength: {
                        min: 5,
                        max: 30,
                        message: 'Debe  entre 5 a 30 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Debe ser letras, o alfanumérico'
                    },
                    
                    different: {
                        field: 'ct_clave,ct_claver',
                        message: 'No debe ser igual que clave'
                    }
                }
            },
            ct_clave: {
                validators: {
                    identical: {
                        field: 'ct_claver',
                        message: 'Debe ser igual clave repite'
                    },
                    different: {
                        field: 'cc_user',
                        message: 'Debe ser diferente a usuario'
                    }
                }
            },
            ct_claver: {
                validators: {
                    identical: {
                        field: 'ct_clave',
                        message: 'Debe ser igual a clave'
                    },
                    different: {
                        field: 'cc_user',
                        message: 'Debe ser diferente a usuario'
                    }
                }
            }
            
        }
    });

    
});

</script>