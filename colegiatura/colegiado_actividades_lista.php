<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas_actividades.php");
require_once(u_src()."bo/bo_gen_personas.php");
require_once(u_src()."bo/bo_gen_actividades.php");
s_validar_pagina();
$cc_persona = $_REQUEST["cc_persona"];

$bo_personas    = new bo_gen_personas();
$bo_actividades = new bo_gen_personas_actividades();
$bo_actividades = new bo_gen_actividades();

$ent_actividades = new gen_personas_actividades();

$data_actividades = $bo_actividades->listarPersona($cc_persona);



$data_persona = $bo_personas->listarId($cc_persona);
foreach ($data_persona as $per) {
    $nombre_completo = $per["nombre"];
    $codigo          = $per["c_colegiado"];
}
$des = "";
?>


<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <span class="pull-right text-right">
                <small><?php echo bt_imprimir(1, 0) ?></small>
            </span>
           <!-- <h1 class="m-b-xs"><a href="javascript:fn_controlFamilia('','<?php //echo $cc_persona ?>','I');" class="btn btn-info" role="button"> <i class="fa fa-plus"></i> Nuevo</a></h1>-->

            <div id="imprimir">
                <div id="TablaExportar">
                    <div class="text-center"><h3><strong>DATOS DE ACTIVIDADES FAVORITAS </strong></h3></div>
                    <div>C&oacute;digo (<?php echo $codigo ?>) <i class="fa fa-angle-double-right"></i> <?php echo $nombre_completo ?></div>
                    <form action="javascript:fn_grabarActividades();" role="form" id="frmGrabarActividades">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="active">
                                    <th width="2%" ></th>
                                    <th>Actividades</th>
                                </tr>
                            </thead>

                            <tbody >
                                <?php
                                $i   = 1;
                                foreach ($data_actividades as $row) {
                                    $check = "";
                                    if ($row["n"] > 0) {
                                        $check = ' checked="checked" ';
                                    }
                                    ?>
                                    <tr>
                                        <td ><?php //echo $i  ?></td>
                                        <td class="material-switch">
                                            <input type="checkbox" name="cc_actividad[]" id="cc_actividad<?php echo $row["cc_actividad"] ?>" value="<?php echo $row["cc_actividad"] ?>"  <?php echo $check ?> <?php echo $des ?>/>
                                            <label for="cc_actividad<?php echo $row["cc_actividad"] ?>" class="label-info"></label>&nbsp; <?php echo $row["nombre"] ?>

                                        </td>

                                    </tr>
    <?php $i++;
} ?>


                                <tr>
                                    <td colspan="2" id="divGuardarSerError"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="hidden" class="input-sm" name="cc_persona" value="<?php echo $cc_persona ?>" id="cc_persona"/>
                                        <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Guardar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

        </div>


    </div>
</div>

