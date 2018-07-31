<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_organizaciones.php"); 
require_once(u_src()."bo/bo_gen_parametro_det.php");

s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_organizaciones    = $_REQUEST["cc_organizaciones"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_organizaciones         = new bo_gen_personas_organizaciones();
$ent_organizaciones            = new gen_personas_organizaciones();

$tipos_eve    = $bo_parametro_detalle->listarParametroDet("gen_personas_organizaciones","tip_ins");

$opcion="Nuevo Organizaciones";

if($opc=="U"){
    $data_familia=$bo_organizaciones->listarId($cc_organizaciones);
    foreach($data_familia as $row){
        $ent_organizaciones->setCc_persona($row["cc_persona"]);
        $ent_organizaciones->setRaz_social($row["raz_social"]);
        $ent_organizaciones->setTip_ins($row["tip_ins"]);
        $ent_organizaciones->setCargo($row["cargo"]);
		$ent_organizaciones->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de organizaciones";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarOrganizaciones();" role="form" id="frmGrabarOrganizaciones">
        <div class="form-group">
        <label for="raz_social" class="col-sm-3 control-label">Raz&oacute;n Social <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<input type="text" placeholder="Raz&oacute;n Social" class="form-control" value="<?php echo $ent_organizaciones->getRaz_social();?>" name="raz_social" id="raz_social"/>
        </div>
        </div>
        <div class="form-group">
        <label for="tip_ins" class="col-sm-3 control-label">Tipo <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
             <select name="tip_ins" id="tip_ins" class="form-control">
                <option></option>
                <?php
                	foreach($tipos_eve as $row){
                ?>
                <option value="<?php echo $row["cc_codigo"]?>" <?php if($ent_organizaciones->getTip_ins()==$row["cc_codigo"]){ echo "selected";} ?>><?php echo $row["detalle"]?></option>
              <?php }?>
    	</select>
        </div>
      </div>
      <div class="form-group">
        <label for="cargo" class="col-sm-3 control-label">Cargo <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<input type="text" placeholder="Cargo" class="form-control" value="<?php echo $ent_organizaciones->getCargo();?>" name="cargo" id="cargo"/>
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
            if($ent_organizaciones->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_organizaciones ?>"  name="cc_organizaciones" id="cc_organizaciones"/>
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
	
    $('#frmGrabarOrganizaciones').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            raz_social:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			tip_ins:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			cargo:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			
            
        }
    });
 });

</script>


