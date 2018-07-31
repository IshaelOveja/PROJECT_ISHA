<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
s_validar_pagina();
?>
<div class="row">
<?php
echo u_cabecera_form("Listado de proveedores");
include_once("../comun/frmBuscarEmpresa.php");?>
<div class="table-responsive">
    <div id="divListarEmpresa"></div>
</div>
<?php echo u_pie_form();?> 
</div>
<div class="modal fade bs-example-modal-sm" id="modalEmpresa" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>


