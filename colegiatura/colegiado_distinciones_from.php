<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_distinciones.php"); 

s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_distinciones    = $_REQUEST["cc_distinciones"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_distinciones         = new bo_gen_personas_distinciones();
$ent_distinciones            = new gen_personas_distinciones();


$opcion="Nuevo Distinciones";

if($opc=="U"){
    $data_familia=$bo_distinciones->listarId($cc_distinciones);
    foreach($data_familia as $row){
        $ent_distinciones->setCc_persona($row["cc_persona"]);
        $ent_distinciones->setDistincion($row["distincion"]);
        $ent_distinciones->setDenominacion($row["denominacion"]);
        $ent_distinciones->setFecha($row["fecha"]);
		$ent_distinciones->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de distinciones";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarDistinciones();" role="form" id="frmGrabarDistinciones">
        <div class="form-group">
        <label for="distincion" class="col-sm-3 control-label">Distinci&oacute;n<span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<input type="text" placeholder="Nombre" class="form-control" value="<?php echo $ent_distinciones->getDistincion();?>" name="distincion" id="distincion"/>
        </div>
        </div>
        <div class="form-group">
        <label for="denominacion" class="col-sm-3 control-label">Denominaci&oacute;n <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
             <input type="text" placeholder="Nombre" class="form-control" value="<?php echo $ent_distinciones->getDenominacion();?>" name="denominacion" id="denominacion"/>
        </div>
      </div>
      <div class="form-group">
       <label for="fecha" class="col-sm-3 control-label">Fecha <span style="color:#F00">*</span> :</label>
      <div class="col-sm-9 " id="fecha">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" class="form-control" name="fecha" value="<?php echo $ent_distinciones->getFecha(); ?>"  placeholder="dd/mm/yyyy"/>
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
            if($ent_distinciones->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_distinciones ?>"  name="cc_distinciones" id="cc_distinciones"/>
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
	
    $('#frmGrabarDistinciones').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            distincion:{
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
            
        }
    });
 });

</script>


