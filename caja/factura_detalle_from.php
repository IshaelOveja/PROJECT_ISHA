<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_conceptos.php"); 
require_once(u_src()."bo/bo_general.php");

s_validar_pagina();
$bo_general           = new bo_general();
$bo_conceptos = new bo_fin_conceptos();

$ent_conceptos = new fin_conceptos();
$ent_conceptos->getTipo("C");
$data_conceptos= $bo_conceptos->listar($ent_conceptos);

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;<span class="sr-only">Close</span></button>
     <h4 align="left">Conceptos de caja</h4>
</div>
<div class="modal-body">
		<form class="form-horizontal" method="post" action="javascript:fn_grabarConcepto();" role="form" id="frmGrabarConcepto">
        <div class="form-group">
        <label for="ct_perfil" class="col-sm-2 control-label">Concepto:</label>
        <div class="col-sm-9">
        	<select name="cc_articulo" id="cc_articulo" class="form-control"  required>
					<option value=""></option>
                         <?php foreach($data_conceptos as $row){ ?>
                     <option value="<?php echo $row["cc_articulo"]?>" ><?php echo $row["nombre"]?></option>
                     <?php }?>
					</select>
        </div>
        </div>
       <div class="form-group">
                <label for="total" class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-2">
                  <input name="cantidad" type="text" class="form-control" id="cantidad" value="1"/>
                </div>
                <label for="total" class="col-sm-2 control-label">Importe</label>
                <div class="col-sm-2">
                   <input name="importe" type="text" class="form-control" id="importe" value="0" onchange="fn_importes()" step="any"/>
                </div>
                <label for="total" class="col-sm-2 control-label">Total</label>
                <div class="col-sm-2">
                   <input name="total" type="text" class="form-control" id="total" step="any" value="0"/>
                </div>
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


 
<script language="javascript" type="text/javascript">

$(document).ready(function(){
            
            $('#importe').change(function() {
                fn_importes();
            });
            $('#cantidad').change(function() {
                fn_importes();
            });
            //fn_listar_deuda();
            
	});


function fn_agregarDetalle(){
               
		var str = $("#frmFormDetalle").serialize();
		$.ajax({
			url: '../caja/caj_det_update_temp.php',
			data: str,
			type: 'post',
			success: function(data){
				if(jQuery.trim(data) == "1"){
					//alert("SE HA GUARDADO CORRECTAMENTE");
					$("#modalEmpleado").modal("hide");
					//$("#modalRegistro").modal("hide");
					fn_listar_det();
				}else{
					alert(data);
				}
				
			}
		});
	}
        
        
function fn_importes(){
            var total     = 0;
            var importe_total = 0;

            var importe   = $("#importe").val();
            var cantidad  = $("#cantidad").val();

            
            if(importe.length==0){
                importe="0";
            }
            
            if(cantidad.length==0){
                cantidad="0";
            }
            var importe_total = parseFloat(importe) * parseFloat(cantidad);
            var tot = parseFloat(importe_total);
            $("#total").val(tot.toFixed(2));
        }
		
    
	
		
	
	
</script>



