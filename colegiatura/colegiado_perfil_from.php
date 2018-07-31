<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_gen_personas.php");
require_once(u_src()."bo/bo_gen_entidad_pagadora.php");
require_once(u_src()."bo/bo_gen_parametro_det.php");
require_once(u_src()."bo/bo_general.php");
s_validar_pagina();
$opc        = "U"; //$_REQUEST["opc"];
$cc_persona = $_REQUEST["cc_persona"];

$bo_general           = new bo_general();
$bo_persona           = new bo_gen_personas();
$bo_parametro_detalle = new bo_gen_parametro_det();
$bo_ent_pagadora      = new bo_gen_entidad_pagadora();

$ent_persona = new gen_personas();

$cod_tipo                  = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "cod_tipo");
$cod_tpdocucumento         = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "cod_documento");
$data_civil                = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "e_civil");
$afp_onp                   = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "afp_onp");
$tipo_direc                = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "tipo_direc");
$factor_sanguineo          = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "factor_sanguineo");
$c_sector_entidad_pagadora = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "c_sector_entidad_pagadora");
$flag_activo               = $bo_parametro_detalle->listarParametroDet("gen_personas",
    "flag_activo");


$data_pais             = $bo_general->listarPais();
$data_entidad_pagadora = $bo_ent_pagadora->listarSelect();

$data_departamento  = $bo_general->listarDepartamento();
$data_provincia     = array();
$data_distrito      = array();
$ubigeo             = "0";
$coddpto            = "";
$codprov            = "";
$data_departamento1 = $bo_general->listarDepartamento();
$data_provincia1    = array();
$data_distrito1     = array();
$ubigeo1            = "0";
$coddpto1           = "";
$codprov1           = "";
if ($opc == "U") {
    $data_persona = $bo_persona->listarId($cc_persona);
    //print_r($data_persona);
    foreach ($data_persona as $row) {
        $ent_persona->setCc_persona($row["cc_persona"]);
        $ent_persona->setCod_tipo($row["cod_tipo"]);
        $ent_persona->setCod_tipo($row["cod_tipo"]);
        $ent_persona->setC_colegiado($row["c_colegiado"]);
        $ent_persona->setFecha_de_colegiacion($row["fecha_de_colegiacion"]);
        $ent_persona->setFlag_activo($row["flag_activo"]);
        $ent_persona->setCod_sexo($row["cod_sexo"]);
        $ent_persona->setApellido_Materno($row["apellido_Materno"]);
        $ent_persona->setApellido_Paterno($row["apellido_Paterno"]);
        $ent_persona->setNombre1($row["Nombre1"]);
        $ent_persona->setNombre2($row["Nombre2"]);
        $ent_persona->setNombre($row["nombre"]);
        $ent_persona->setPais_nacimiento($row["pais_nacimiento"]);
        $ent_persona->setFecha_nacimiento($row["fecha_nacimiento"]);
        $ent_persona->setUbigeonac($row["ubigeonac"]);
        $ent_persona->setCod_documento($row["cod_documento"]);
        $ent_persona->setNum_documento($row["num_documento"]);
        $ent_persona->setE_civil($row["e_civil"]);
        $ent_persona->setRuc($row["ruc"]);
        $ent_persona->setAfp_onp($row["afp_onp"]);
        $ent_persona->setCelular1($row["celular1"]);
        $ent_persona->setCelular2($row["celular2"]);
        $ent_persona->setEmail1($row["email1"]);
        $ent_persona->setEmail2($row["email2"]);
        $ent_persona->setC_local($row["c_local"]);
        $ent_persona->setTipo_direc($row["tipo_direc"]);
        $ent_persona->setDireccion($row["direccion"]);
        $ent_persona->setUbigeodirec($row["ubigeodirec"]);
        $ent_persona->setFactor_sanguineo($row["factor_sanguineo"]);
        $ent_persona->setFecha_de_cese($row["fecha_de_cese"]);
        $ent_persona->setFecha_fallecido($row["fecha_fallecido"]);
        $ent_persona->setC_entidad_pagadora($row["c_entidad_pagadora"]);
        $ent_persona->setC_sector_entidad_pagadora($row["c_sector_entidad_pagadora"]);
        $ent_persona->setN_folio_cole($row["n_folio_cole"]);
        $ent_persona->setN_libro_cole($row["n_libro_cole"]);
        $ent_persona->setN_resolucion_cole($row["n_resolucion_cole"]);
        $ent_persona->setFlag($row["flag"]);
    }
}
$che1 = "";
if ($ent_persona->getCod_sexo() == 'F') {
    $che1 = ' checked="checked"';
} else {
    $che = ' checked="checked"';
}
$data_ubigeo = $bo_general->ubigeoId($ent_persona->getUbigeonac());
foreach ($data_ubigeo as $row) {
    $coddpto = $row["coddpto"];
    $codprov = $row["codprov"];
}

$data_provincia = $bo_general->listarProvincia($coddpto);
$data_distrito  = $bo_general->listarDistrito($coddpto, $codprov);

/* ---------------------------------- */
$data_ubigeo1 = $bo_general->ubigeoId($ent_persona->getUbigeodirec());
foreach ($data_ubigeo1 as $row) {
    $coddpto1 = $row["coddpto"];
    $codprov1 = $row["codprov"];
}

$data_provincia1 = $bo_general->listarProvincia($coddpto1);
$data_distrito1  = $bo_general->listarDistrito($coddpto1, $codprov1);

$data_paisId = $bo_general->listarIdPais($ent_persona->getPais_nacimiento());
if ($ent_persona->getPais_nacimiento() == '192') {
    $ocultar  = " show";
    $ocultar1 = ' hide';
} else {
    $ocultar  = ' hide';
    $ocultar1 = ' show';
}
?>
<div class="col-md-12">
    <strong>DATOS GENERALES</strong>
    <hr width="100%" />
    <div class="ibox-content">
        <form class="form-horizontal" action="javascript:fn_grabarPersonas();" role="form" id="frmGrabarPersonas">
            <div class="form-group">
                <div class="group">
                    <label for="cod_tipo" class="col-sm-2 control-label">Tipo User <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-3">
                        <select name="cod_tipo" id="cod_tipo" class="form-control">
                            <option></option>
<?php
foreach ($cod_tipo as $row) {
    ?>
                                <option value="<?php echo $row["cc_codigo"] ?>" <?php if ($ent_persona->getCod_tipo()
        == $row["cc_codigo"]) {
        echo "selected";
    } ?>><?php echo $row["detalle"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="group">
                    <label for="cod_documento" class="col-sm-1 control-label">Tipo doc.<span style="color:#F00">*</span> :</label>
                    <div class="col-sm-3">
                        <select name="cod_documento" id="cod_documento" class="form-control">
                            <option></option>
<?php
foreach ($cod_tpdocucumento as $ro) {
    ?>
                                <option value="<?php echo $ro["cc_codigo"] ?>" <?php if ($ent_persona->getCod_documento()
        == $ro["cc_codigo"]) {
        echo "selected";
    } ?>><?php echo $ro["detalle"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <div class="col-sm-2">

                        <input class="form-control" type="text" placeholder="" name="num_documento" id="num_documento" value="<?php echo $ent_persona->getNum_documento(); ?>" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="group">
                    <label for="apellido_Paterno" class="col-sm-2 control-label">Apellido Paterno <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Paterno" class="form-control  text-uppercase" value="<?php echo $ent_persona->getApellido_Paterno(); ?>"  name="apellido_Paterno" id="apellido_Paterno" required/>
                    </div>
                </div>
                <div class="group">
                    <label for="apellido_Materno" class="col-sm-2 control-label">Apellido Materno <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Materno" class="form-control  text-uppercase" value="<?php echo $ent_persona->getApellido_Materno(); ?>"  name="apellido_Materno" id="apellido_Materno"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="group">
                    <label for="Nombre1" class="col-sm-2 control-label">Nombres <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Primero" class="form-control  text-uppercase" value="<?php echo $ent_persona->getNombre1(); ?>"  name="Nombre1" id="Nombre1"/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <input type="text" placeholder="Segundo" class="form-control  text-uppercase" value="<?php echo $ent_persona->getNombre2(); ?>"  name="Nombre2" id="Nombre2"/>
                </div>
            </div>
            <div class="form-group">
                <div class="group">
                    <label for="cod_sexo" class="col-sm-2 control-label">G&eacute;nero <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">

                        <input name="cod_sexo" id="cod_sexo" type="radio" value="M" <?php echo $che ?> />&nbsp;Masculino
                        &nbsp;&nbsp;&nbsp;<input name="cod_sexo" id="cod_sexo" type="radio" value="F" <?php echo $che1 ?> required/>&nbsp;Femenino
                    </div>
                </div>
                <label for="c_colegiado" class="col-sm-1 control-label">C&oacute;digo col.:</label>
                <div class="col-sm-2">
                    <input type="text" placeholder="000000" class="form-control " value="<?php echo $ent_persona->getC_colegiado(); ?>"  name="c_colegiado" id="c_colegiado"/>
                </div>
                <label for="fecha_de_colegiacion" class="col-sm-1 control-label">Fecha col.:</label>
                <div class="col-sm-2 " id="fecha_de_colegiacion">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="fecha_de_colegiacion" value="<?php echo $ent_persona->getFecha_de_colegiacion(); ?>"  placeholder="dd/mm/yyyy"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="group">
                    <label for="email1" class="col-sm-2 control-label">Correo <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-4">
                        <input  type="text" placeholder="Correo 1" class="form-control " value="<?php echo $ent_persona->getEmail1(); ?>"  name="email1" id="email1"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <input  type="text" placeholder="Correo 2" class="form-control " value="<?php echo $ent_persona->getEmail2(); ?>"  name="email2" id="email2"/>
                </div>

            </div>
            <div class="form-group">
                <div class="group">
                    <label for="celular1" class="col-sm-2 control-label">N� Celular <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Numero 1" class="form-control " value="<?php echo $ent_persona->getCelular1(); ?>"  name="celular1" id="celular1"/>
                    </div>
                </div>
                <div class="col-sm-2">
                    <input type="text" placeholder="Numero 2" class="form-control " value="<?php echo $ent_persona->getcelular2(); ?>"  name="celular2" id="celular2"/>
                </div>
                <div class="group">
                    <label for="estado_civil" class="col-sm-1 control-label">Estado Civil*:</label>

                    <div class="col-sm-3">
                        <select name="e_civil" id="e_civil" class="form-control">
                            <option></option>
<?php
foreach ($data_civil as $row) {
    ?>
                                <option value="<?php echo $row["cc_codigo"] ?>" <?php if ($ent_persona->getE_civil()
                                == $row["cc_codigo"]) {
                                echo "selected";
                            } ?>><?php echo $row["detalle"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="group">
                    <label for="pais_nacimiento" class="col-sm-2 control-label">Pa&iacute;s de nacimiento <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="pais_nacimiento" id="pais_nacimiento" class="form-control" >
                            <option></option>
<?php foreach ($data_pais as $re) { ?>
                                <option value="<?php echo $re["cc_pais"] ?>"<?php if ($ent_persona->getPais_nacimiento()
        == $re["cc_pais"]) {
        echo "selected";
    } ?>><?php echo $re["nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="fecha_nacimiento" class="col-sm-1 control-label">Fecha Nac.<span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2 " id="fecha_nacimiento">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" name="fecha_nacimiento" value="<?php echo $ent_persona->getFecha_nacimiento(); ?>"  />
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="factor_sanguineo" class="col-sm-1 control-label">Sangre <span style="color:#F00">*</span>:</label>
                    <div class="col-sm-2">
                        <select name="factor_sanguineo" id="factor_sanguineo" class="form-control">
                            <option></option>
<?php
foreach ($factor_sanguineo as $ro) {
    ?>
                                <option value="<?php echo $ro["cc_codigo"] ?>" <?php if ($ent_persona->getFactor_sanguineo()
        == $ro["cc_codigo"]) {
        echo "selected";
    } ?>><?php echo $ro["detalle"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group <?php echo $ocultar ?>">
                <div class="group">
                    <label for="coddpto" class="col-sm-2 control-label">Lugar de Nacimiento <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="coddpto" id="coddpto" onchange="fn_lista_provincia(this.value, 'codprov', 'ubigeo')" class="form-control ">
                            <option value=""></option>
                            <?php foreach ($data_departamento as $row) { ?>
                                <option value="<?php echo $row["coddpto"] ?>" <?php if ($coddpto
                                == $row["coddpto"]) {
                                echo "selected";
                            } ?>><?php echo $row["nombre"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="codprov" class="col-sm-1 control-label">Provincia <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="codprov" id="codprov" onchange="fn_lista_distrito(this.value, 'ubigeonac', 'coddpto')" class="form-control ">
                            <option value=""></option>
<?php foreach ($data_provincia as $row) { ?>
                                <option value="<?php echo $row["codprov"] ?>" <?php if ($codprov
        == $row["codprov"]) {
        echo "selected";
    } ?>><?php echo $row["nombre"] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="ubigeonac" class="col-sm-1 control-label">Distrito <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="ubigeonac" id="ubigeonac" class="form-control ">
                            <option value=""></option>
                            <?php foreach ($data_distrito as $rowx) { ?>
                                <option value="<?php echo $rowx["ubigeo"] ?>" <?php if ($ent_persona->getUbigeonac()
                                == $rowx["ubigeo"]) {
                                echo "selected";
                            } ?>><?php echo $rowx["nombre"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="ruc" class="col-sm-2 control-label">Ruc :</label>
                <div class="col-sm-2 ">
                    <input type="text" class="form-control" name="ruc" id="ruc" value="<?php echo $ent_persona->getRuc(); ?>"  placeholder="000000000000"/>
                </div>
                <label for="c_pais" class="col-sm-2 control-label">AFP:</label>
                <div class="col-sm-2">
                    <select name="afp_onp" id="afp_onp" class="form-control" >
                        <option></option>
                            <?php foreach ($afp_onp as $row) { ?>
                            <option value="<?php echo $row["cc_codigo"] ?>" <?php if ($ent_persona->getAfp_onp()
                                == $row["cc_codigo"]) {
                                echo "selected";
                            } ?>><?php echo $row["detalle"] ?></option>
<?php } ?>
                    </select>
                </div>
            </div>
            <hr />
            <div class="form-group">
                <div class="group">
                    <label for="tipo_direc" class="col-sm-2 control-label">Tipo de Direccion <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2 ">
                        <select name="tipo_direc" id="tipo_direc" class="form-control" >
<?php foreach ($tipo_direc as $row) { ?>
                                <option value="<?php echo $row["cc_codigo"] ?>" <?php if ($ent_persona->getTipo_direc()
        == $row["cc_codigo"]) {
        echo "selected";
    } ?>><?php echo $row["detalle"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $ent_persona->getDireccion(); ?>"  placeholder="Direccion"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="group">
                    <label for="coddpto1" class="col-sm-2 control-label">Departamento <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="coddpto1" id="coddpto1" onchange="fn_lista_provincia1(this.value, 'codprov1', 'ubigeo1')" class="form-control ">
                            <option value=""></option>
                        <?php foreach ($data_departamento1 as $row) { ?>
                                <option value="<?php echo $row["coddpto"] ?>" <?php if ($coddpto1
                            == $row["coddpto"]) {
                            echo "selected";
                        } ?>><?php echo $row["nombre"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="codprov1" class="col-sm-1 control-label">Provincia <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="codprov1" id="codprov1" onchange="fn_lista_distrito1(this.value, 'ubigeodirec', 'coddpto1')" class="form-control ">
                            <option value=""></option>
<?php foreach ($data_provincia1 as $row) { ?>
                                <option value="<?php echo $row["codprov"] ?>" <?php if ($codprov1
        == $row["codprov"]) {
        echo "selected";
    } ?>><?php echo $row["nombre"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="group">
                    <label for="ubigeodirec" class="col-sm-1 control-label">Distrito <span style="color:#F00">*</span> :</label>
                    <div class="col-sm-2">
                        <select name="ubigeodirec" id="ubigeodirec" class="form-control ">
                            <option value=""></option>
<?php foreach ($data_distrito1 as $row) { ?>
                                <option value="<?php echo $row["ubigeo"] ?>" <?php if ($ent_persona->getUbigeodirec()
        == $row["ubigeo"]) {
        echo "selected";
    } ?>><?php echo $row["nombre"] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="cod_documento" class="col-sm-2 control-label">Sector ent pagadora :</label>
                <div class="col-sm-3">
                    <select name="c_sector_entidad_pagadora" id="c_sector_entidad_pagadora" class="form-control">
                        <option></option>
<?php
foreach ($c_sector_entidad_pagadora as $row) {
    ?>
                            <option value="<?php echo $row["cc_codigo"] ?>" <?php if ($ent_persona->getC_sector_entidad_pagadora()
        == $row["cc_codigo"]) {
        echo "selected";
    } ?>><?php echo $row["detalle"] ?></option>
<?php } ?>
                    </select>
                </div>
                <label for="c_entidad_pagadora" class="col-sm-2 control-label">Entidad pagadora:</label>

                <div class="col-sm-3">
                    <select name="c_entidad_pagadora" id="c_entidad_pagadora" class="form-control" >
                        <option></option>
<?php foreach ($data_entidad_pagadora as $pe) { ?>
                            <option value="<?php echo $pe["cc_entidad"] ?>"<?php if ($ent_persona->getC_entidad_pagadora()
        == $pe["cc_entidad"]) {
        echo "selected";
    } ?>><?php echo $pe["nombre"] ?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="cod_documento" class="col-sm-2 control-label">Estado :</label>
                <div class="col-sm-2">
                    <select name="flag_activo" id="flag_activo" class="form-control">
                        <option></option>
<?php
foreach ($flag_activo as $row) {
    ?>
                            <option value="<?php echo $row["cc_codigo"] ?>" <?php if ($ent_persona->getFlag_activo()
        == $row["cc_codigo"]) {
        echo "selected";
    } ?>><?php echo $row["detalle"] ?></option>
<?php } ?>
                    </select>
                </div>
                <label for="fecha_de_cese" class="col-sm-2 control-label">Fecha de Sece:</label>
                <div class="col-sm-2 " id="fecha_de_cese">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="fecha_de_cese" value="<?php echo $ent_persona->getFecha_de_cese(); ?>"  placeholder="dd/mm/yyyy"/>
                    </div>
                </div>
                <label for="fecha_fallecido" class="col-sm-1 control-label">Fecha de fallecido:</label>
                <div class="col-sm-2 " id="fecha_fallecido">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" name="fecha_fallecido" value="<?php echo $ent_persona->getFecha_fallecido(); ?>"  placeholder="dd/mm/yyyy"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="n_folio_cole" class="col-sm-2 control-label">Folio :</label>
                <div class="col-sm-2">
                    <input class="form-control" type="text" placeholder="" name="n_folio_cole" id="n_folio_cole" value="<?php echo $ent_persona->getN_folio_cole(); ?>" >
                </div>
                <label for="n_libro_cole" class="col-sm-2 control-label">Libro :</label>
                <div class="col-sm-2 ">
                    <input class="form-control" type="text" placeholder="" name="n_libro_cole" id="n_libro_cole" value="<?php echo $ent_persona->getn_libro_cole(); ?>" >
                </div>
                <label for="n_resolucion_cole" class="col-sm-2 control-label">Resoluci&oacute;n :</label>
                <div class="col-sm-2 ">
                    <input class="form-control" type="text" placeholder="" name="n_resolucion_cole" id="n_resolucion_cole" value="<?php echo $ent_persona->getN_resolucion_cole(); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="cfl_vigencia" class="col-sm-3 control-label"></label>
                <div class="col-sm-9 material-switch">
<?php
$clase  = ' class="disabled" ';
$cheked = "";
if ($opc == "U") {
    $clase = "";
}
if ($ent_persona->getFlag() == "1") {
    $cheked = ' checked="checked" ';
}
?>

                    <input type="checkbox" name="flag" id="flag" value="1" <?php echo $clase; ?> <?php echo $cheked; ?>/>
                    <label for="flag" class="label-info"></label> Vigencia

                </div>

            </div>
            <div class="row">
                <div class="text-center" id="divGuardarSerError">
                    <h5>*Datos Obligatorios</h5>
                </div>
                <div class="col-sm-12 text-center">
                    <input type="hidden" placeholder="paginas" class="input-sm" name="opc" value="<?php echo $opc ?>" id="opc"/>
                    <input type="hidden" placeholder="mostrar" class="rm-control input-sm" value="<?php echo $cc_persona ?>"  name="cc_persona" id="cc_persona"/>
                    <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Guardar</button>
                    <button type="button" class="btn btn-warning waves-effect text-left" data-dismiss="modal"><i class="fa fa-power-off"></i> Cerrar</button>
                </div>
            </div>

        </form>
    </div>
</div>



<script type="text/javascript">

    $(document).ready(function () {
        $('#fecha_nacimiento .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            language: 'es'
        });
        $('#fecha_de_colegiacion .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            language: 'es'
        });
        $('#fecha_de_cese .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            language: 'es'
        });
        $('#fecha_fallecido .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            language: 'es'
        });

        $('#frmGrabarPersonas').bootstrapValidator({
            message: 'No valido',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                cod_tipo: {
                    group: '.group',
                    message: "Selecciona",
                    validators: {
                        notEmpty: {
                            message: "Selecciona"
                        }
                    }
                },
                cod_documento: {
                    group: '.group',
                    message: "Selecciona",
                    validators: {
                        notEmpty: {
                            message: "Selecciona"
                        }
                    }
                },
                num_documento: {
                    group: '.group',
                    message: "Numeros",
                    validators: {
                        notEmpty: {
                            message: "Numeros"
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'
                        },
                        stringLength: {
                            min: 8,
                            max: 11,
                            message: '8-11'
                        }
                    }
                },
                apellido_Paterno: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                apellido_Materno: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                Nombre1: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                cod_sexo: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                email1: {
                    group: '.group',
                    validators: {
                        message: "Correo electr&oacute;nico",
                        notEmpty: {
                            message: "Correo electr&oacute;nico"
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Correo electr&oacute;nico'
                        }
                    }
                },
                celular1: {
                    group: '.group',
                    message: "Numero",
                    validators: {
                        notEmpty: {
                            message: "Celular"
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'
                        },
                        stringLength: {
                            min: 9,
                            max: 9,
                            message: 'max 9'
                        }
                    }
                },
                e_civil: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                pais_nacimiento: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                fecha_nacimiento: {
                    group: '.group',
                    validators: {
                        notEmpty: {
                            message: 'Ingrese'
                        },
                        date: {
                            message: 'Formato',
                            format: 'DD/MM/YYYY'
                        }
                    }
                },
                factor_sanguineo: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                coddpto: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                codprov: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                ubigeonac: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                tipo_direc: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                direccion: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                coddpto1: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                codprov1: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },
                ubigeodirec: {
                    group: '.group',
                    message: "Obligatorio",
                    validators: {
                        notEmpty: {
                            message: "Obligatorio"
                        }
                    }
                },

            }
        });
    });
</script>