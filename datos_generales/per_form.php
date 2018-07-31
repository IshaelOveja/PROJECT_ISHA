<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_parametro_det.php"); 
require_once(u_src()."bo/bo_gen_personas.php"); 
require_once(u_src()."bo/bo_general.php"); 


s_validar_pagina();
$opc             = $_REQUEST["opc"];
$cc_persona     = $_REQUEST["cc_persona"];

$bo_personas    = new bo_gen_personas();
$ent_personas        = new gen_personas();
$bo_general		= new bo_general();

$bo_parametro_det = new bo_gen_parametro_det();



$data_sexo          = $bo_parametro_det->listarParametroDet("gen_personas", 'cp_sexo');
$data_civil     = $bo_parametro_det->listarParametroDet("gen_personas", 'ct_est_civil');

//$data_facultad=$bo_general->ListarFacultad();

$opcion="NUEVOS DATOS DE PERSONAL";
$cc_uniorg="";
if($opc=="U"){
    $data_personas=$bo_personas->listarId($cc_persona);
    foreach($data_personas as $row){
        $ent_personas->setCfl_vigencia($row["cfl_vigencia"]);

        $ent_personas->setCp_sexo($row["cp_sexo"]);
		$ent_personas->setCt_email($row["ct_email"]);
        $ent_personas->setCt_nombres($row["ct_nombres"]);
		$ent_personas->setCt_nombresc($row["ct_nombresc"]);
        $ent_personas->setCt_nro_doc($row["ct_nro_doc"]);
        $ent_personas->setCt_fech_nac($row["ct_fech_nac"]);
		$ent_personas->setCt_celular($row["ct_celular"]);
		$ent_personas->setCt_celularc($row["ct_celularc"]);
		$ent_personas->setCt_email($row["ct_email"]);
		$ent_personas->setCt_emailc($row["ct_emailc"]);
		$ent_personas->setCt_est_civil($row["ct_est_civil"]);
		$ent_personas->setCt_direccion($row["ct_direccion"]);
		$ent_personas->setCt_obs($row["ct_obs"]);
        
    }
    $opcion="MODIFICAR DATOS DE PERSONAL";
}
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">

    <div class="row">
    
        <div class="col-sm-12">
    <form class="form-horizontal" action="javascript:fn_grabarEmpleado();" role="form" id="frmEmpleado">
       <div class="form-group">
        <label for="ct_ape_pat" class="col-sm-2 control-label">Cliente:</label>
        <div class="col-sm-9">
            <input type="text" placeholder="Apellidos y nombres" class="form-control input-sm" value="<?php echo $ent_personas->getCt_nombres();?>" name="ct_nombres" id="ct_nombres"/>
        </div>
      </div>
      <div class="form-group">
        <label for="cp_sexo" class="col-sm-2 control-label">Sexo:</label>
        <div class="col-sm-3">
            <select class="form-control" name="cp_sexo">
            <option valua=""></option>  
            <?php 
             foreach($data_sexo as $row){
             ?>
            <option value="<?php echo $row["cc_codigo"] ?>"  <?php if($row["cc_codigo"]==$ent_personas->getCp_sexo()){echo "selected"; }else{ echo "";}  ?>><?php echo $row["ct_par_det"] ?></option>
             <?php
             }
             ?>
            </select>
        </div>
         <label for="ct_est_civil" class="col-sm-2 control-label">Est. Civil:</label>
         <div class="col-sm-3">
            <select class="form-control" name="ct_est_civil" id="ct_est_civil">
            <option valua=""></option>  
            <?php 
             foreach($data_civil as $row){
             ?>
            <option value="<?php echo $row["cc_codigo"] ?>"  <?php if($row["cc_codigo"]==$ent_personas->getCt_est_civil()){echo "selected"; }else{ echo "";}  ?>><?php echo $row["ct_par_det"] ?></option>
             <?php
             }
             ?>
            </select>
        </div>
      </div>
      
      <div class="form-group">
        <label for="ct_ciclo" class="col-sm-2 control-label">Nro:</label>
        <div class="col-sm-3">
            <input type="text" placeholder="Nro Documento" class="form-control input-sm" value="<?php echo $ent_personas->getCt_nro_doc();?>" name="ct_nro_doc" id="ct_nro_doc"/>
        </div>
        <label for="" class="col-sm-2 control-label">Fec. Nac.:</label>
        <div class="col-md-4 date">
              <div class="input-group input-append date" id="ct_fech_nacCT">
           <input type="text" class="form-control" name="ct_fech_nac" value="<?php echo $ent_personas->getCt_fech_nac(); ?>" placeholder="dd/mm/yyyy"/>
           <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
          
	    </div>
      </div>
      <div class="form-group">
        <label for="ct_email_u" class="col-sm-2 control-label">E-mail:</label>
        <div class="col-sm-6">
            <input type="email" placeholder="Correo electronico" class="form-control input-sm" value="<?php echo $ent_personas->getCt_email();?>" name="ct_email" id="ct_email"/>
        </div>
      </div>
      <div class="form-group">
        <label for="ct_email_u" class="col-sm-2 control-label">Direccion :</label>
        <div class="col-sm-9">
            <input type="text" placeholder="Direccion" class="form-control input-sm" value="<?php echo $ent_personas->getCt_direccion();?>" name="ct_direccion" id="ct_direccion"/>
        </div>
      </div>
      <div class="form-group">
        <label for="ct_email_u" class="col-sm-2 control-label">Celular :</label>
        <div class="col-sm-4">
            <input type="text" placeholder="Celular" class="form-control input-sm" value="<?php echo $ent_personas->getCt_celular();?>" name="ct_celular" id="ct_celular"/>
        </div>
      </div>

        
        <div class="form-group">
        <label for="" class="col-sm-2 control-label">Contacto:</label>
        <div class="col-sm-9">
        <input type="text" placeholder="Apellidos y nombres" class="form-control input-sm" value="<?php echo $ent_personas->getCt_nombresc();?>" name="ct_nombresc" id="ct_nombresc"/>
        </div>
        </div>
        <div class="form-group">
        <label for="ct_email_u" class="col-sm-2 control-label">Celular :</label>
        <div class="col-sm-4">
            <input type="text" placeholder="Celularc" class="form-control input-sm" value="<?php echo $ent_personas->getCt_celularc();?>" name="ct_celularc" id="ct_celularc"/>
        </div>
      </div>
      <div class="form-group">
        <label for="ct_email_u" class="col-sm-2 control-label">E-mail:</label>
        <div class="col-sm-6">
            <input type="text" placeholder="Correo electronico" class="form-control input-sm" value="<?php echo $ent_personas->getCt_emailc();?>" name="ct_emailc" id="ct_emailc"/>
        </div>
      </div>
        <div class="form-group">
        <label for="ct_email_u" class="col-sm-2 control-label">Obs :</label>
        <div class="col-sm-8">
          <textarea name="ct_obs" class="form-control input-sm" id="ct_obs" placeholder="Observaciones"><?php echo $ent_personas->getCt_obs();?></textarea>
        </div>
       </div>
        
        <div class="form-group">
          <label for="cfl_vigencia" class="col-sm-2 control-label">Vigencia:</label>
        <div class="col-sm-8">
            <?php
            $clase=" disabled";
            $cheked = "";
            if($opc=="U"){
                $clase="";
            }
            if($ent_personas->getCfl_vigencia()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
            
             <input type="checkbox"  class="<?php echo $clase; ?>" <?php echo $cheked; ?> name="cfl_vigencia" value="" />
            
        </div>
        
      </div>
 
      <div class="form-group">
            <div class="col-sm-12 text-center">
                <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit">
                   <strong> <?php if($opc=="I"){ echo "Registrar";}else{echo "Actualizar datos";}?>    </strong>
                </button>
            </div>

        </div>
        <div class="form-group hide">
              <div class="col-sm-6">
                <input type="text" placeholder="paginas" class="input-sm" name="opc" value="<?php echo $opc ?>" id="opc"/>
              </div>
              <div class="col-sm-6">
                <input type="text" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_persona ?>"  name="cc_persona" id="cc_persona"/>
                </div>

        </div>
    </form>
        </div>
    </div>
</div>
<div class="modal-footer" id="divGuardarEmpError">
	
    <h5>*Datos Obligatorios</h5>
</div>
<script type="text/javascript">
$(document).ready(function(){
		
		$('#ct_fech_nacCT').datepicker({
			 format: 'dd/mm/yyyy',
			 autoclose: true
			})
			.on('changeDate', function(e) {
			   $('#frmEmpleado').bootstrapValidator('revalidateField', 'ct_fech_nac');
			});
			
    $('#frmEmpleado').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            ct_nombres:{
                message:"Ingrese Nombre",
                validators:{
                    notEmpty:{
                        message:"Ingrese Nombre"
                    }
                }
            },
			 ct_celular:{
                message:"Ingrese # Celular",
                validators:{
                    notEmpty:{
                        message:"Ingrese # Celular"
                    },
					regexp: {
					 regexp: /^[0-9]+$/,
					 message: 'solo n&uacute;meros'
				 	},
					stringLength: {
					 	min: 9,
                        max: 9,
                        message: '9 n&uacute;meros'
                    }
                }
            },
			ct_nro_doc:{
                message:"DNI",
                validators:{
                    notEmpty:{
                        message:"Ingrese #"
                    },
					regexp: {
					 regexp: /^[0-9]+$/,
					 message: 'solo n&uacute;meros'
				 	},
					stringLength: {
					 	min: 8,
                        max: 8,
                        message: '8 n&uacute;meros'
                    }
                }
            },

			ct_direccion:{
                message:"Ingrese direccion",
                validators:{
                    notEmpty:{
                        message:"Ingrese direccion"
                    }
                }
            },
            cp_sexo:{
                message:"Seleccione sexo",
                validators:{
                    notEmpty:{
                        message:"Seleccione sexo"
                    }
                }
            },
            ct_email: {
                    validators: {
						message:"Correo electr&oacute;nico",
                        notEmpty:{
                        message:"Correo electr&oacute;nico"
                    	},
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                           message: 'Correo electr&oacute;nico'
                        }
                    }
                }
        }
    });
    
    
});
</script>

