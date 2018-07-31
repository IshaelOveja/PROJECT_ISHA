<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_perfil.php"); 
require_once(u_src()."bo/bo_seg_modulo.php"); 
s_validar_pagina();

$opc         = $_REQUEST["opc"];
$cc_perfil    = $_REQUEST["cc_perfil"];

$bo_perfil    = new bo_seg_perfil();
$bo_modulo    = new bo_seg_modulo();
$perfil       = new seg_perfil();

$data_modulo = $bo_modulo->listarModuloDefecto();


$opcion="Nuevo Perfil";

if($opc=="U"){
    $data_perfil=$bo_perfil->listarId($cc_perfil);
    foreach($data_perfil as $row){
        $perfil->setCc_perfil($row["cc_perfil"]);
        $perfil->setCt_perfil($row["ct_perfil"]);
        $perfil->setCc_modulo_defecto($row["cc_modulo_defecto"]);
        $perfil->setCfl_vigencia($row["cfl_vigencia"]);
        
    }
    $opcion="Modificar Perfil";
   
}
$disa="";
if($opc=="U"){
   $disa=' readonly="readonly" '; 
}
$desactiva="";
if($opc=="I"){
   $desactiva=' disabled '; 
}
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left"><?php echo $opcion; ?></h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarPerfil();" role="form" id="frmGrabarPerfil">
        <div class="form-group">
        <label for="ct_perfil" class="col-sm-3 control-label">*Nombre:</label>
        <div class="col-sm-9">
        	<input type="text" placeholder="Nombre" class="form-control" value="<?php echo $perfil->getCt_perfil();?>" name="ct_perfil" id="ct_perfil"/>
        </div>
        </div>
        <div class="form-group">
        <label for="cc_categoria" class="col-sm-3 control-label">Módulo por defecto:</label>
        <div class="col-sm-9">
            <select class="form-control" name="cc_modulo_defecto" id="cc_modulo_defecto">
             <option valua=""></option>
             <?php 
           
             foreach($data_modulo as $row){
            
             ?>
             <option value="<?php echo $row["cc_modulo"] ?>"  <?php if($row["cc_modulo"]==$perfil->getCc_modulo_defecto()){echo "selected"; }else{ echo "";}  ?>><?php echo $row["mod_nombre1"].">>".$row["mod_nombre2"].">>".$row["mod_nombre"] ?></option>
           
             <?php
             }
             ?>
            </select>
        </div>
      </div>
        <div class="form-group">
        <label for="cfl_vigencia" class="col-sm-3 control-label"></label>
        <div class="col-sm-9 material-switch">
            <?php
            $clase=' class="disabled" ' ;
            $cheked = "";
            if($opc=="U"){
                $clase="";
            }
            if($perfil->getCfl_vigencia()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
           
             <input type="checkbox" name="cfl_vigencia" id="cfl_vigencia" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
              <label for="cfl_vigencia" class="label-info"></label> Vigencia
            
        </div>
        
      </div>
        <div class="row hide">
                <input type="text" placeholder="paginas" class="input-sm" name="opc" value="<?php echo $opc ?>" id="opc"/>
                <input type="text" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_perfil ?>"  name="cc_perfil" id="cc_perfil"/>
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
    
    $('#frmGrabarPerfil').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            ct_perfil:{
                message:"Ingrese Nombre",
                validators:{
                    notEmpty:{
                        message:"Ingrese Nombre"
                    }
                }
            },
			cc_modulo_defecto:{
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


