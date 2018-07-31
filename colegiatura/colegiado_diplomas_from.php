<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_diplomas.php"); 
require_once(u_src()."bo/bo_gen_parametro_det.php");
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_diplomas    = $_REQUEST["cc_diplomas"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_diplomas        = new bo_gen_personas_diplomas();
$bo_general         = new bo_general();

$ent_diplomas            = new gen_personas_diplomas();

$dat_universidad= $bo_general->listarUniversidad();
$nivel    = $bo_parametro_detalle->listarParametroDet("gen_personas_diplomas","nivel");
$opcion="Nuevo Diplomas";

if($opc=="U"){
    $data_diplomas=$bo_diplomas->listarId($cc_diplomas);
    foreach($data_diplomas as $row){
        $ent_diplomas->setCc_persona($row["cc_persona"]);
        $ent_diplomas->setCc_universidad($row["cc_universidad"]);
        $ent_diplomas->setDenominacion($row["denominacion"]);
		$ent_diplomas->setEspecialidad($row["especialidad"]);
        $ent_diplomas->setFecha($row["fecha"]);
		 $ent_diplomas->setNivel($row["nivel"]);
		$ent_diplomas->setNro_reg($row["nro_reg"]);
		$ent_diplomas->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de diplomas";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarDiplomas();" role="form" id="frmGrabarDiplomas">
         <div class="form-group">
        <label for="parentesco" class="col-sm-3 control-label">Nivel <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
             <select name="nivel" id="nivel" class="form-control">
                <option></option>
                <?php
                	foreach($nivel as $row){
                ?>
                <option value="<?php echo $row["cc_codigo"]?>" <?php if($ent_diplomas->getNivel()==$row["cc_codigo"]){ echo "selected";} ?>><?php echo $row["detalle"]?></option>
              <?php }?>
    	</select>
        </div>
      </div>
        <div class="form-group">
        <label for="cc_giros" class="col-sm-3 control-label">Universidad <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<select name="cc_universidad" id="cc_universidad" class="form-control">
                <option></option>
                <?php
                	foreach($dat_universidad as $row){
                ?>
                 <option value="<?php echo $row["cc_universidad"]?>"<?php if($ent_diplomas->getCc_universidad()==$row["cc_universidad"]){ echo "selected";} ?>><?php echo $row["descripcion"]?></option>
              <?php }?>
    	</select>
        </div>
        </div>
        <div class="form-group">
        <label for="denominacion" class="col-sm-3 control-label">Denominaci&oacute;n <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
              <input type="text" placeholder="Denominaci&oacute;n" class="form-control " value="<?php echo $ent_diplomas->getDenominacion(); ?>"  name="denominacion" id="denominacion"/>
        </div>
      </div>
      <div class="form-group">
        <label for="especialidad" class="col-sm-3 control-label">Especialidad <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
              <input type="text" placeholder="especialidad" class="form-control " value="<?php echo $ent_diplomas->getEspecialidad(); ?>"  name="especialidad" id="especialidad"/>
        </div>
      </div>
      <div class="form-group">
       <label for="fecha" class="col-sm-3 control-label">Fecha. <span style="color:#F00">*</span> :</label>
      <div class="col-sm-7 " id="fecha">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo $ent_diplomas->getFecha(); ?>"  placeholder="dd/mm/yyyy"/>
            </div>
      </div>
      </div>
       <div class="form-group">
        <label for="nro_reg" class="col-sm-3 control-label">Registro <span style="color:#F00">*</span> :</label>
        <div class="col-sm-6">
              <input type="text" placeholder="N° 00" class="form-control " value="<?php echo $ent_diplomas->getNro_reg(); ?>"  name="nro_reg" id="nro_reg"/>
        </div>
      </div>
      
      
        <div class="form-group">
        <label for="estado" class="col-sm-3 control-label"></label>
        <div class="col-sm-9 material-switch">
            <?php
            $clase=' class="disabled" ' ;
            $cheked = "";
            if($opc=="U"){
                $clase="";
            }
            if($ent_diplomas->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_diplomas ?>"  name="cc_diplomas" id="cc_diplomas"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_persona ?>"  name="cc_persona" id="cc_persona"/>
        </div>
     <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Guardar</button>
                <button type="button" class="btn btn-warning waves-effect text-left" data-dismiss="modal"><i class="fa fa-power-off"></i> Cerrar</button>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer" id="divGuardarPerError">
    <h5>*Datos Obligatorios</h5>
</div>
                            

<script type="text/javascript">
$(document).ready(function(){
   $('#fecha .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			language: 'es'
		});
  
	
    $('#frmGrabarDiplomas').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            cc_universidad:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			nivel:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			
			fecha: {
				validators: {
				   notEmpty: {
				  message: 'Obligatorio'
				   },
				   date: {
				  message: 'Formato',
				  format: 'DD/MM/YYYY'
				   }
				}
			},
			nro_reg:{
				message:"Obligatorio",
				validators:{
					notEmpty:{
						message:"Obligatorio"
					},
					stringLength: {
						min: 1,
						max: 10,
						message: 'Max 10'
					}
				}
			},	
			denominacion:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            }
            
        }
    });
 });

</script>


