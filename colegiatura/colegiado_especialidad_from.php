<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_especialidad.php"); 
require_once(u_src()."bo/bo_gen_parametro_det.php");
s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_especialidad    = $_REQUEST["cc_especialidad"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_especialidad         = new bo_gen_personas_especialidad();

$ent_especialidad            = new gen_personas_especialidad();
$sector    = $bo_parametro_detalle->listarParametroDet("gen_personas_especialidad","sector");
$opcion="Nuevo Especialidad";

if($opc=="U"){
    $data_trabajo=$bo_especialidad->listarId($cc_especialidad);
    foreach($data_trabajo as $row){
        $ent_especialidad->setCc_persona($row["cc_persona"]);
        $ent_especialidad->setDenominacion($row["denominacion"]);
        $ent_especialidad->setAnios($row["anios"]);
		$ent_especialidad->setSector($row["sector"]);
		$ent_especialidad->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de especialidad";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarEspecialidad();" role="form" id="frmGrabarEspecialidad">
        <div class="form-group">
        <label for="denominacion" class="col-sm-3 control-label">Denominaci&oacute;n <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
              <input type="text" placeholder="Denominaci&oacute;n" class="form-control " value="<?php echo $ent_especialidad->getDenominacion(); ?>"  name="denominacion" id="denominacion"/>
        </div>
      </div>
      <div class="form-group">
        <label for="cargo" class="col-sm-3 control-label">A&ntilde;os <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
              <input type="text" placeholder="Anios" class="form-control " value="<?php echo $ent_especialidad->getAnios(); ?>"  name="anios" id="anios"/>
        </div>
      </div>
      <div class="form-group">
     <label for="sector" class="col-sm-3 control-label">Sector <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<select name="sector" id="sector" class="form-control">
                <option></option>
                <?php
                	foreach($sector as $row){
                ?>
                <option value="<?php echo $row["cc_codigo"]?>" <?php if($ent_especialidad->getSector()==$row["cc_codigo"]){ echo "selected";} ?>><?php echo $row["detalle"]?></option>
              <?php }?>
    	</select>
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
            if($ent_especialidad->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_especialidad ?>"  name="cc_especialidad" id="cc_especialidad"/>
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
	
    $('#frmGrabarEspecialidad').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            denominacion:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			
			anios:{
				message:"Obligatorio",
				validators:{
					notEmpty:{
						message:"Obligatorio"
					},
					stringLength: {
						min: 1,
						max: 2,
						message: 'Max 2'
					}
				}
			},	
			sector:{
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


