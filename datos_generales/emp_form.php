<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_empresa.php"); 

s_validar_pagina();
$bo_empresa   = new bo_gen_empresa();
$ent_empresa  = new gen_empresa();
$opc          = $_REQUEST["opc"];
$emp_ruc       = $_REQUEST["emp_ruc"];
$readonly="";

$mensaje="Ingresar datos de proveedor";
if($opc=="U"){
	
	$data_empresa = $bo_empresa->listarId($emp_ruc);
	foreach($data_empresa as $row){
				$ent_empresa->setEmp_ruc($row["emp_ruc"]);
				$ent_empresa->setEmp_celular($row["emp_celular"]);
				$ent_empresa->setEmp_email($row["emp_email"]);
                $ent_empresa->setEmp_estado($row["emp_estado"]);
                $ent_empresa->setEmp_nom_comercial($row["emp_nom_comercial"]);
                $ent_empresa->setEmp_razon_social($row["emp_razon_social"]);
                $ent_empresa->setEmp_telefono($row["emp_telefono"]);
                $ent_empresa->setEmp_web($row["emp_web"]);
				$ent_empresa->setEmp_direccion($row["emp_direccion"]);
		$readonly="readonly";
	}
	$mensaje="Modificar datos de proveedor";
}?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?php echo $mensaje?></h4>
</div>
<div class="modal-body">

    <div class="row">
    
        <div class="col-sm-12">
    <form class="form-horizontal" action="javascript:fn_grabarEmpresa();" role="form" id="frmEmpresa">
       <div class="form-group">
        <label for="ct_ape_pat" class="col-sm-3 control-label">Ruc:</label>
        <div class="col-sm-6">
            <input type="text" placeholder="Ruc" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_ruc();?>" <?php echo $readonly ?> name="emp_ruc" id="emp_ruc"/>
        </div>
      </div>
      
      
      <div class="form-group">
        <label for="emp_razon_social" class="col-sm-3 control-label">Razon Social:</label>
        <div class="col-sm-6">
            <input type="text" placeholder="Razon social" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_razon_social();?>" name="emp_razon_social" id="emp_razon_social"/>
        </div>
        
      </div>

      <div class="form-group">
        <label for="ct_email_u" class="col-sm-3 control-label">Nombre comercial:</label>
        <div class="col-sm-8">
            <input type="text" placeholder="Nombre comercial" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_nom_comercial();?>" name="emp_nom_comercial" id="emp_nom_comercial"/>
        </div>
      </div>
      <div class="form-group">
        <label for="ct_email_u" class="col-sm-3 control-label">Direcci&oacute;n :</label>
        <div class="col-sm-8">
            <input type="text" placeholder="Direccion" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_direccion();?>" name="emp_direccion" id="emp_direccion"/>
        </div>
      </div>
      
      <div class="form-group">
        <label for="ct_email_u" class="col-sm-3 control-label">Telefono :</label>
        <div class="col-sm-3">
            <input type="text" placeholder="Telefono" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_telefono();?>" name="emp_telefono" id="emp_telefono"/>
        </div>
       </div>
       
      <div class="form-group">
        <label for="emp_celular" class="col-sm-3 control-label">Celular :</label>
        <div class="col-sm-3">
            <input type="text" placeholder="Celular" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_celular();?>" name="emp_celular" id="emp_celular"/>
        </div>
       </div>

        <div class="form-group">
        <label for="emp_email" class="col-sm-3 control-label">Correo :</label>
        <div class="col-sm-6">
            <input type="text" placeholder="Correo" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_email();?>" name="emp_email" id="emp_email"/>
        </div>
       </div>
        <div class="form-group">
        <label for="emp_web" class="col-sm-3 control-label">Web :</label>
        <div class="col-sm-6">
            <input type="text" placeholder="Web" class="form-control input-sm" value="<?php echo $ent_empresa->getEmp_web();?>" name="emp_web" id="emp_web"/>
        </div>
       </div>
       
       
       
        <div class="form-group">
          <label for="cfl_vigencia" class="col-sm-3 control-label">Vigencia:</label>
        <div class="col-sm-8">
            <?php
            $clase=" disabled";
            $cheked = "";
            if($opc=="U"){
                $clase="";
            }
            if($ent_empresa->getEmp_estado()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
            
             <input type="checkbox"  class="<?php echo $clase; ?>" <?php echo $cheked; ?> name="emp_estado" value="" />
            
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
    $('#frmEmpresa').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
			 emp_ruc:{
                message:"Ingrese RUC",
                validators:{
                    notEmpty:{
                        message:"Ingrese RUC"
                    },
					regexp: {
					 regexp: /^[0-9]+$/,
					 message: 'solo n&uacute;meros'
				 	},
					stringLength: {
					 	min: 11,
                        max: 11,
                        message: '11 n&uacute;meros'
                    }
                }
            },
			emp_razon_social:{
                message:"Razon social",
                validators:{
                    notEmpty:{
                        message:"Razon social"
                    }
                }
            },
            
        }
    });
    
    
});
</script>

