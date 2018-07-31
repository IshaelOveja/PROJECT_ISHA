<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_estudios.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_gen_parametro_det.php");

s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_estudios    = $_REQUEST["cc_estudios"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_general         = new bo_general();
$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_estudios         = new bo_gen_personas_estudios();
$ent_estudios        = new gen_personas_estudios();

$grado    = $bo_parametro_detalle->listarParametroDet("gen_personas_estudios","grado");

$opcion="Nuevo estudios";
$dat_universidad= $bo_general->listarUniversidad();
if($opc=="U"){
    $data_familia=$bo_estudios->listarId($cc_estudios);
    foreach($data_familia as $row){
        $ent_estudios->setCc_persona($row["cc_persona"]);
        $ent_estudios->setCc_universidad($row["cc_universidad"]);
        $ent_estudios->setFacultad($row["facultad"]);
        $ent_estudios->setGrado($row["grado"]);
		 $ent_estudios->setFecha($row["fecha"]);
		$ent_estudios->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de estudios";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarEstudios();" role="form" id="frmGrabarEstudios">
        <div class="form-group">
        <label for="nombres" class="col-sm-3 control-label">Universidad <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<select name="cc_universidad" id="cc_universidad" class="form-control">
                <option></option>
                <?php
                	foreach($dat_universidad as $row){
                ?>
                 <option value="<?php echo $row["cc_universidad"]?>"<?php if($ent_estudios->getCc_universidad()==$row["cc_universidad"]){ echo "selected";} ?>><?php echo $row["descripcion"]?></option>
              <?php }?>
    	</select>
        </div>
        </div>
        <div class="form-group">
        <label for="facultad" class="col-sm-3 control-label">Facultad <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
             <input type="text" placeholder="Facultad" class="form-control" value="<?php echo $ent_estudios->getFacultad();?>" name="facultad" id="facultad"/>
        </div>
      </div>
        <div class="form-group">
        <label for="parentesco" class="col-sm-3 control-label">Grado <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
             <select name="grado" id="grado" class="form-control">
                <option></option>
                <?php
                	foreach($grado as $row){
                ?>
                <option value="<?php echo $row["cc_codigo"]?>" <?php if($ent_estudios->getGrado()==$row["cc_codigo"]){ echo "selected";} ?>><?php echo $row["detalle"]?></option>
              <?php }?>
    	</select>
        </div>
      </div>
      <div class="form-group">
       <label for="parentesco" class="col-sm-3 control-label">Fecha <span style="color:#F00">*</span> :</label>
      <div class="col-sm-9 " id="fecha">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" class="form-control" name="fecha" value="<?php echo $ent_estudios->getFecha(); ?>"  placeholder="dd/mm/yyyy"/>
            </div>
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
            if($ent_estudios->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_estudios ?>"  name="cc_estudios" id="cc_estudios"/>
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
	
    $('#frmGrabarEstudios').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            nombres:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			parentesco:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			fec_nac: {
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
            
        }
    });
 });

</script>


