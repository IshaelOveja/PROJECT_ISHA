<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_trabajos.php"); 
require_once(u_src()."bo/bo_general.php"); 
s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_trabajos    = $_REQUEST["cc_trabajos"];
$cc_persona    = $_REQUEST["cc_persona"];

$bo_trabajos         = new bo_gen_personas_trabajos();
$bo_general         = new bo_general();

$ent_trabajos            = new gen_personas_trabajos();

$data_giros=$bo_general->listarGiros();
$opcion="Nuevo Trabajo";

if($opc=="U"){
    $data_trabajo=$bo_trabajos->listarId($cc_trabajos);
    foreach($data_trabajo as $row){
        $ent_trabajos->setCc_persona($row["cc_persona"]);
        $ent_trabajos->setCc_giros($row["cc_giros"]);
        $ent_trabajos->setRaz_soc($row["raz_soc"]);
		$ent_trabajos->setCargo($row["cargo"]);
        $ent_trabajos->setfch_ini($row["fch_ini"]);
		$ent_trabajos->setfch_fin($row["fch_fin"]);
		$ent_trabajos->setEstado($row["estado"]);
        
    }
    $opcion="Modificar datos de trabajos";
   
}

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarTrabajos();" role="form" id="frmGrabarTrabajos">
        <div class="form-group">
        <label for="cc_giros" class="col-sm-3 control-label">Giros <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
        	<select name="cc_giros" id="cc_giros" class="form-control">
                <option></option>
                <?php
                	foreach($data_giros as $gi){
                ?>
                 <option value="<?php echo $gi["cc_giros"]?>"<?php if($ent_trabajos->getCc_giros()==$gi["cc_giros"]){ echo "selected";} ?>><?php echo $gi["descripcion"]?></option>
              <?php }?>
    	</select>
        </div>
        </div>
        <div class="form-group">
        <label for="parentesco" class="col-sm-3 control-label">Raz&oacute;n social <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
              <input type="text" placeholder="Raz&oacute;n social" class="form-control " value="<?php echo $ent_trabajos->getRaz_soc(); ?>"  name="raz_soc" id="raz_soc"/>
        </div>
      </div>
      <div class="form-group">
        <label for="cargo" class="col-sm-3 control-label">Cargo <span style="color:#F00">*</span> :</label>
        <div class="col-sm-9">
              <input type="text" placeholder="Cargo" class="form-control " value="<?php echo $ent_trabajos->getCargo(); ?>"  name="cargo" id="cargo"/>
        </div>
      </div>
      <div class="form-group">
       <label for="fch_ini" class="col-sm-3 control-label">Fecha de inicio. <span style="color:#F00">*</span> :</label>
      <div class="col-sm-9 " id="fch_ini">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" class="form-control" name="fch_ini" value="<?php echo $ent_trabajos->getFch_ini(); ?>"  placeholder="dd/mm/yyyy"/>
            </div>
      </div>
      </div>
      <div class="form-group">
       <label for="fch_fin" class="col-sm-3 control-label">Fecha de fin. <span style="color:#F00">*</span> :</label>
      <div class="col-sm-9 " id="fch_fin">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <input type="text" class="form-control" name="fch_fin" value="<?php echo $ent_trabajos->getFch_fin(); ?>"  placeholder="dd/mm/yyyy"/>
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
            if($ent_trabajos->getEstado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="estado" id="estado" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="estado" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control " value="<?php echo $cc_trabajos ?>"  name="cc_trabajos" id="cc_trabajos"/>
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
   $('#fch_ini .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			language: 'es'
		});
   $('#fch_fin .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			language: 'es'
		});
	
    $('#frmGrabarTrabajos').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            cc_giros:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			
			fch_ini: {
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
			fch_fin: {
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
			cargo:{
                message:"Obligatorio",
                validators:{
                    notEmpty:{
                        message:"Obligatorio"
                    }
                }
            },
			raz_soc:{
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


