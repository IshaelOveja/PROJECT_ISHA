<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_gen_parametro_det.php"); 
s_validar_pagina();

$bo_parametro_det = new bo_gen_parametro_det();
$bo_general= new bo_general();

$data_tipo_doc = $bo_parametro_det->listarParametroDet("gen_personas", 'cp_tipo_doc');

?>
<div class="row">
<?php
echo u_cabecera_form("Buscar clientes");
include_once("../comun/frmBuscarEmpleado.php");?>
<div class="table-responsive">
    <div id="divListarEmpleado"></div>
</div>
<?php echo u_pie_form();?> 
</div>


<div class="modal fade bs-example-modal-sm" id="modalEmpleado" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>