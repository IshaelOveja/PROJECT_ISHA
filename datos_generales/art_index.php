<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_gen_empresa.php"); 
s_validar_pagina();
$bo_general= new bo_general();
$bo_empresa   = new bo_gen_empresa();
$ent_empresa  = new gen_empresa();

$data_grupo=$bo_general->grupos();
$ent_empresa->setEmp_razon_social($emp_razon_social);
$data_empresa= $bo_empresa->buscarEmpresa($ent_empresa);
?>
<div class="row">
<?php
echo u_cabecera_form("Listado de productos");?>
<form class="form-horizontal" action="javascript:fn_buscarRegistro();" role="form" id="frmBuscarRegistro">
   <div class="form-group">
   <div class="col-sm-1">
   </div>
    <div class="col-sm-2">
   <select name="emp_id" id="emp_id" class="form-control" onChange="submit()">
                      <option value=""></option>
                      <?php foreach($data_empresa as $rw){?>
                      <option value="<?php echo $rw["emp_id"]?>"><?php echo $rw["emp_nom_comercial"]?> </option>
                      <?php } ?>
            </select>
   </div>
   <div class="col-sm-2">
   <select class="form-control" name="ct_grupo" id="ct_grupo" onChange="submit()" >
            <option valua=""></option>  
            <?php 
             foreach($data_grupo as $row){
             ?>
            <option value="<?php echo $row["cc_grupo"] ?>"><?php echo $row["ct_nombre"] ?></option>
             <?php
             }
             ?>
            </select>
   </div>
    <div class="col-sm-2">
      <input type="text" placeholder="Nombre articulo" class="form-control input-sm" name="ct_nombre" id="ct_nombre"/>
    </div>
    <div class="col-sm-1">
    <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit">
        <strong>Buscar</strong>
    </button>
    </div>
    <div class="col-sm-2 ">
        </div>
        <div class="col-sm-2 text-right">
        <div class="btn-group ">
  			<a href="javascript:fn_enviarFormulario('I','');" class="btn btn-primary btn-sm active" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&nbsp;
            <a href="javascript:fn_actualizar();" class="btn btn-primary btn-sm active" role="button"><span class="glyphicon glyphicon-refresh"></span> Actualizar</a>&nbsp;
		</div>
        </div>
  </div>
  
    <div class="form-group hide" >
          <div class="col-sm-6">
            <input type="text" placeholder="paginas" class="input-sm" name="pagPagina" id="pagPagina"/>
          </div>
          <div class="col-sm-6">
            <input type="text" placeholder="mostrar" class="rm-control input-sm" name="pagMostrar" id="pagMostrar"/>
            </div>

    </div>
</form>

<div class="table-responsive">
    <div id="divListarRegistro"></div>
</div>
<?php echo u_pie_form();?> 
</div>
<div class="modal fade bs-example-modal-sm" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
