<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_familiares.php"); 
require_once(u_src()."bo/bo_gen_parametro_det.php");

s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_familiares    = $_REQUEST["cc_familiares"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_familiares         = new bo_gen_personas_familiares();
$ent_familiares            = new gen_personas_familiares();

$parentesco    = $bo_parametro_detalle->listarParametroDet("gen_personas_familiares","parentesco");

$opcion="Nuevo Familiar";

if($opc=="U"){
    $data_familia=$bo_familiares->listarId($cc_familiares);
    foreach($data_familia as $row){
        $ent_familiares->setCc_persona($row["cc_persona"]);
        $ent_familiares->setNombres($row["nombres"]);
        $ent_familiares->setFec_nac($row["fecha_nacimiento"]);
        $ent_familiares->setParentesco($row["parentesco"]);
		$ent_familiares->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de familiar";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarFamiliares();" role="form" id="frmGrabarFamiliares">
        <div class="form-group">
        <label for="nombres" class="col-sm-3 control-label">Nombre <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<input type="text" placeholder="Nombre" class="form-control" value="<?php echo $ent_familiares->getNombres();?>" name="nombres" id="nombres"/>
        </div>
        </div>
        <div class="form-group">
        <label for="parentesco" class="col-sm-3 control-label">Parentesco <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
             <select name="parentesco" id="parentesco" class="form-control">
                <option></option>
                <?php
                	foreach($parentesco as $row){
                ?>
                <option value="<?php echo $row["cc_codigo"]?>" <?php if($ent_familiares->getParentesco()==$row["cc_codigo"]){ echo "selected";} ?>><?php echo $row["detalle"]?></option>
              <?php }?>
    	</select>
        </div>
      </div>
      <div class="form-group">
       <label for="parentesco" class="col-sm-3 control-label">Fecha Nac. <span style="color:#F00">*</span> :</label>
      <div class="col-sm-9 " id="fec_nac">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" class="form-control" name="fec_nac" value="<?php echo $ent_familiares->getFec_nac(); ?>"  placeholder="dd/mm/yyyy"/>
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
            if($ent_familiares->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_familiares ?>"  name="cc_familiares" id="cc_familiares"/>
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
    $('#fec_nac .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			language: 'es'
		});
	
    $('#frmGrabarFamiliares').bootstrapValidator({
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


