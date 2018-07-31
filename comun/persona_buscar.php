<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_parametro_det.php"); 

$bo_parametro_detalle   = new bo_gen_parametro_det();
$data_parametro_detalle = $bo_parametro_detalle->listarParametroDet("gen_persona","per_tipo_doc");
?>
<div class="modal-header"> 
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> 
  <h4 class="modal-title" id="myModalLabel">BUSCAR COLEGIADO </h4> 
</div> 
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
                <form action="javascript:fn_buscar();" id="frmBuscarPersona" class="form-horizontal"  name="frmBuscarPersona">
                    <div class="form-group row">
                        <label for="ct_nombres" class="col-sm-4 control-label text-right">Colegiatura: </label>
                        <div class="col-sm-4">
                            <input name="c_colegiado" placeholder="000000" type="number" id="c_colegiado" class="form-control" />
                      </div>
                        <div class="col-sm-7"></div>
                    </div>
                    
                   <div class="form-group row">
                      <label for="ct_nombres" class="col-sm-4 control-label text-right">Apellidos y nombres : </label>
                        <div class="col-sm-6">
                            <input name="nombre" type="text" class="form-control" id="nombre" value="prete" />
                      </div>
                    </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
                        <button type="button" class="btn btn-warning waves-effect text-left" data-dismiss="modal"><i class="fa fa-power-off"></i> Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
            <div class="col-sm-12">
                <div id="divListPersona"></div>
			</div>
    </div>
</div>



<script language="javascript" type="text/javascript">
	$(document).ready(function(){
            
	});
	
	function fn_buscar(){
            var str = $("#frmBuscarPersona").serialize();
            $.ajax({
			url: '../comun/persona_lista.php',
			data: str,
			type: 'post',
			success: function(data){
			  $("#divListPersona").html(data);
			 }
       });
	}

	
</script>