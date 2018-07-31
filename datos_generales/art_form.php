<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_parametro_det.php"); 
require_once(u_src()."bo/bo_gen_articulo.php"); 
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_gen_empresa.php"); 
require_once(u_src()."bo/bo_fin_compras_detalle.php");
s_validar_pagina();
$bo_articulo   = new bo_gen_articulo();
$bo_general   = new bo_general();
$bo_empresa   = new bo_gen_empresa();
$bo_compras_de   = new bo_fin_compras_detalle();

$ent_articulo  = new gen_articulo();
$ent_empresa  = new gen_empresa();
$bo_parametro_det = new bo_gen_parametro_det();

$opc          = $_REQUEST["opc"];
$cc_articulo       = $_REQUEST["cc_articulo"];
$readonly="";
$ent_empresa->setEmp_razon_social($emp_razon_social);
$data_empresa= $bo_empresa->buscarEmpresa($ent_empresa);
$dat_grupo=$bo_general->grupos();

$data_unid          = $bo_parametro_det->listarParametroDet("gen_articulo", 'ct_umedida');

$mensaje="Ingresar datos de articulo";
if($opc=="U"){
	
	$data_articulo = $bo_articulo->listarId($cc_articulo);
	foreach($data_articulo as $row){
				$ent_articulo->setCc_articulo($row["cc_articulo"]);
				$ent_articulo->setCt_codigo($row["ct_codigo"]);
				$ent_articulo->setEmp_id($row["emp_id"]);
                $ent_articulo->setCt_grupo($row["ct_grupo"]);
                $ent_articulo->setCt_nombre($row["ct_nombre"]);
                $ent_articulo->setCt_molecula($row["ct_molecula"]);
                $ent_articulo->setCt_umedida($row["ct_umedida"]);
				$ent_articulo->setCt_compra($row["ct_compra"]);
				$ent_articulo->setCt_rentabilidad($row["ct_rentabilidad"]);
				$ent_articulo->setCt_venta($row["ct_venta"]);
				$ent_articulo->setCt_stock($row["ct_stock"]);
				$ent_articulo->setCt_igv($row["ct_igv"]);
				$ent_articulo->setCt_stockmin($row["ct_stockmin"]);
                $ent_articulo->setCt_vigencia($row["ct_vigencia"]);
		$readonly="readonly";
	}
 $data_costo=$bo_compras_de->ultimoRegistro($ent_articulo->getCc_articulo());
 foreach($data_costo as $comp){
	  $compra=$comp["ct_importe"];
	 }
	$mensaje="Modificar datos de articulo";
}?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?php echo $mensaje?></h4>
</div>
<div class="modal-body">
    <div class="row">
      <div class="col-sm-12">
    <form class="form-horizontal" action="javascript:fn_grabarRegistro();" role="form" id="frmRegistro">
       <div class="form-group">
        <label for="ct_ape_pat" class="col-sm-3 control-label">C&oacute;dido:</label>
        <div class="col-sm-6">
            <input type="text" placeholder="Codigo" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_codigo();?>" <?php echo $readonly ?> name="ct_codigo" id="ct_codigo"/>
        </div>
      </div>
      
      
      <div class="form-group">
        <label for="emp_razon_social" class="col-sm-3 control-label">Proveedor:</label>
        <div class="col-sm-6">
        <select name="emp_id" id="emp_id" class="form-control">
                      <option value=""></option>
                      <?php foreach($data_empresa as $rw){?>
                      <option value="<?php echo $rw["emp_id"]?>" <?php if($rw["emp_id"]==$ent_articulo->getEmp_id()){echo "selected"; }else{ echo "";}  ?>><?php echo $rw["emp_nom_comercial"]?> </option>
                      <?php } ?>
            </select>
        </div>
        
      </div>

      <div class="form-group">
        <label for="ct_email_u" class="col-sm-3 control-label">Grupo:</label>
        <div class="col-sm-8">
        <select name="ct_grupo" id="ct_grupo" class="form-control">
                      <option value=""></option>
                      <?php foreach($dat_grupo as $rw){?>
                      <option value="<?php echo $rw["cc_grupo"]?>" <?php if($rw["cc_grupo"]==$ent_articulo->getCt_grupo()){echo "selected"; }else{ echo "";}  ?>><?php echo $rw["ct_nombre"]?> </option>
                      <?php } ?>
            </select>
            
        </div>
      </div>
      <div class="form-group">
        <label for="ct_nombre" class="col-sm-3 control-label">Nombre:</label>
        <div class="col-sm-8">
            <input type="text" placeholder="Nombre" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_nombre();?>" name="ct_nombre" id="ct_nombre"/>
        </div>
      </div>
      
      <div class="form-group">
        <label for="ct_molecula" class="col-sm-3 control-label">Molecula:</label>
        <div class="col-sm-5">
            <input type="text" placeholder="Molecula" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_molecula();?>" name="ct_molecula" id="ct_molecula"/>
        </div>
       </div>
       
      <div class="form-group">
        <label for="emp_celular" class="col-sm-3 control-label">Und. medida:</label>
        <div class="col-sm-3">
         <select class="form-control" name="ct_umedida" id="ct_umedida">
            <option valua=""></option>  
            <?php 
             foreach($data_unid as $row){
             ?>
            <option value="<?php echo $row["cc_codigo"] ?>"  <?php if($row["cc_codigo"]==$ent_articulo->getCt_umedida()){echo "selected"; }else{ echo "";}  ?>><?php echo $row["ct_par_det"] ?></option>
             <?php
             }
             ?>
            </select>
        </div>
        <label for="emp_celular" class="col-sm-2 control-label">Igv:</label>
        <div class="col-sm-3">
            <?php
            //$clase=" disabled";
            $cheked = "";
            if($ent_articulo->getCt_igv()=="Si"){
                $cheked = ' checked="checked" ';
            }
            ?>
            
             <input type="checkbox"  class="<?php echo $clase; ?>" <?php echo $cheked; ?> name="ct_igv" value="" />

        </div>
       </div>
       <div class="form-group">
        <label for="ct_compra" class="col-sm-3 control-label">Precios:</label>
        <div class="col-sm-3">
          <input type="text" placeholder="0.00" class="form-control input-sm" value="<?php if($compra==""){echo $ent_articulo->getCt_compra();}else{ echo $compra;} ?>" name="ct_compra" id="ct_compra"  /><!--readonly-->
        </div>
        <div class="col-sm-2">
          <input type="text" placeholder="0.00" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_rentabilidad();?>" name="ct_rentabilidad" id="ct_rentabilidad" onchange="fn_importes()" step="any"/>
        </div>
        <div class="col-sm-3">
          <input type="text" placeholder="0.00" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_venta();?>" name="ct_venta" readonly id="ct_venta"/>
        </div>
       </div>
       <div class="form-group">
        <label for="ct_stock" class="col-sm-3 control-label">Stock:</label>
        <div class="col-sm-3">
          <input type="text" placeholder="0" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_stock();?>" name="ct_stock" id="ct_stock"/>
        </div>
        <label for="ct_stockmin" class="col-sm-2 control-label">Stock m&iacute;n.:</label>
        <div class="col-sm-2">
          <input type="text" placeholder="0" class="form-control input-sm" value="<?php echo $ent_articulo->getCt_stockmin();?>" name="ct_stockmin" id="ct_stockmin"/>
        </div>
       </div>
       
       
        <div class="form-group">
          <label for="ct_vigencia" class="col-sm-3 control-label">Vigencia:</label>
        <div class="col-sm-8">
            <?php
            $clase=" disabled";
            $cheked = "";
            if($opc=="U"){
                $clase="";
            }
            if($ent_articulo->getCt_vigencia()=="1"){
                $cheked = ' checked="checked" ';
            }
            ?>
            
             <input type="checkbox"  class="<?php echo $clase; ?>" <?php echo $cheked; ?> name="ct_vigencia" value="" />

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
                <input type="text" placeholder="paginas" class="input-sm" name="cc_articulo" value="<?php echo $cc_articulo ?>" id="cc_articulo"/>
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
			
    $('#frmRegistro').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            emp_id:{
                message:"Proveedor",
                validators:{
                    notEmpty:{
                        message:"Proveedor"
                    }
                }
            },
			ct_nombre:{
                message:"Nombre",
                validators:{
                    notEmpty:{
                        message:"Nombre"
                    }
                }
            },
			ct_grupo:{
                message:"Grupo",
                validators:{
                    notEmpty:{
                        message:"Grupo"
                    }
                }
            },
			 ct_codigo:{
                message:"Codigo",
                validators:{
                    notEmpty:{
                        message:"Codigo"
                    },
					/*regexp: {
					 regexp: /^[0-9]+$/,
					 message: 'solo n&uacute;meros'
				 	},*/
					stringLength: {
					 	min: 6,
                        max: 6,
                        message: '6 digitos'
                    }
                }
            },
			ct_costo:{
                message:"# costo",
                validators:{
                    notEmpty:{
                        message:"# costo"
                    }
                }
            },
			ct_precio:{
                message:"# precio",
                validators:{
                    notEmpty:{
                        message:"# precio"
                    }
                }
            },
			ct_stock:{
                message:"# precio",
                validators:{
                    notEmpty:{
                        message:"# precio"
                    }
                }
            }
			<!------------------->

        }
    });
    
});
function fn_importes(){
            var compra     = 0;
            var venta = 0;
			var procentaje = 0;

            var ct_compra   = $("#ct_compra").val();
            var ct_rentabilidad  = $("#ct_rentabilidad").val();

            
            if(compra.length==0){
                compra="0";
            }
            
            if(ct_rentabilidad.length==0){
                ct_rentabilidad="0";
            }else{
				var procentaje= ct_compra*ct_rentabilidad /100;
			}
            var venta = parseFloat(ct_compra) + parseFloat(procentaje);
            var tot = parseFloat(venta);
            $("#ct_venta").val(tot.toFixed(2));
        } 
</script>

