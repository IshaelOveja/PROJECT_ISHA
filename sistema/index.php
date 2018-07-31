<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_modulo_perfil.php");
require_once(u_src()."bo/bo_seg_modulo.php");
require_once(u_src()."bo/bo_seg_modulo_pagina.php");
s_validar_pagina();
$bo_modulo_pagina = new bo_seg_modulo_pagina();
$bo_modulo        = new bo_seg_modulo();
$bo_mod_perfil    = new bo_seg_modulo_perfil();

$cc_usuario = s_usuario_id();
$url_js     = "../js/siga.js";
$pagina     = "bienvenido.php";
$gs_carpeta = "";
$codigo     = 0;
if (isset($_REQUEST["codigo"])) {
    $codigo = $_REQUEST["codigo"];
} else {
    $codigo = $_SESSION["SES_MOD_ID"];
}
if (isset($_REQUEST["codigo"])) {
    unset($_SESSION["SES_MOD_ID1"]);
    unset($_SESSION["SES_MOD_ID2"]);
    unset($_SESSION["SES_MOD_ID3"]);
    unset($_SESSION["SES_MOD_ID"]);
}
$sec = "0";
if ($sec != "0") {
    $data_seccion = $bo_modulo_pagina->asignado_pagina($id, $sec, $cc_usuario,
        $padre);
    if (count($data_seccion) == 0) {
        $pagina = "error.php";
    } else {
        foreach ($data_seccion as $row) {
            $pagina          = $row["url"];
            $url_js          = $row["js"];
            $gs_carpeta      = $row["ct_carpeta"];
            $ct_clase_cuerpo = $row["ct_clase_cuerpo"];
        }
    }
} else {
    if ($codigo != "0") {

        $data_modulo = $bo_mod_perfil->asignado_modulo($codigo);
        if (count($data_modulo) == 0) {
            $pagina = "error.php";
        } else {
            foreach ($data_modulo as $row) {
                $pagina                  = $row["url"];
                $url_js                  = $row["js"];
                $_SESSION["SES_MOD_ID1"] = $row["mod_id1"];
                $_SESSION["SES_MOD_ID2"] = $row["mod_id2"];
                $_SESSION["SES_MOD_ID3"] = $row["mod_id3"];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>CORDELIMA | Sistema de Gesti&oacute;n</title>
        <link rel="shortcut icon" href="<?php echo u_img() ?>favicon.ico" />
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Bootstrap/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="../css/imprimir.css">
        <!-- alerta-->
        <link rel="stylesheet" type="text/css" href="../css/alert.css">

        <link href="../Bootstrap/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../Bootstrap/css/bootstrap-toggle.min.css">
        <link href="../bootstrap/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

        <link href="../Bootstrap/css/bootstrapValidator.min.css" rel="stylesheet"/>

        <link href="../Bootstrap/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../Bootstrap/css/animate.css" rel="stylesheet">
        <link href="../Bootstrap/css/style.css" rel="stylesheet">

    </head>

    <!--<body class="md-skin fixed-sidebar">-->
    <body class="md-skin fixed-sidebar">
        <div id="wrapper ">
            <script src="../Bootstrap/js/jquery-3.1.1.min.js"></script>
            <script src="../Bootstrap/js/bootstrap.min.js"></script>
            <script src="../Bootstrap/js/plugins/metisMenu/jquery.metisMenu.js"></script>
            <script src="../Bootstrap/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



            <script src="../Bootstrap/js/bootstrapValidator.min.js"></script>

            <script src="../Bootstrap/js/inspinia.js"></script>
            <script src="../Bootstrap/js/plugins/pace/pace.min.js"></script>
            <script src="../Bootstrap/js/plugins/sweetalert/sweetalert.min.js"></script>



            <script src="../Bootstrap/js/plugins/datapicker/bootstrap-datepicker.js"></script>

            <script src="../Bootstrap/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

            <script src="../js/print.js"></script>
            <script src="<?php echo $url_js ?>"></script>

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                    <img alt="image" class="img-circle" src="../img/profile_small.jpg" />
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                                        </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="contacts.html">Contacts</a></li>
                                    <li><a href="mailbox.html">Mailbox</a></li>
                                    <li class="divider"></li>
                                    <li><a href="login.html">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                IN+
                            </div>
                        </li>
<?php include"menu.php"; ?>


                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" action="search_results.html">
                                <div class="form-group">
                                    <input type="text" placeholder="Buscar..." class="form-control" name="top-search" id="top-search">
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Usuario: </span>
                            </li>

                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                    <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                                </a>
                                <ul class="dropdown-menu dropdown-alerts">
                                    <li>
                                        <a href="profile.html">
                                            <div>
                                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                                <span class="pull-right text-muted small">12 minutes ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>

                                </ul>
                            </li>
                            <li>
                                <a href="salir.php">
                                    <i class="fa fa-sign-out"></i> Salir
                                </a>
                            </li>

                        </ul>

                    </nav>
                </div>
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div>
<?php require_once($pagina); ?>
                                    </div>

                                    <div>
                                        <canvas id="lineChart" height="30"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="footer">
                    <div class="pull-right">
                        <strong>Copyright</strong> Cordelima &copy;2018
                    </div>
                    <div>
<?php
echo "pagi: ".$pagina."<br>";
echo "JS: ".$url_js."<br>";
//echo "id: ".$_SESSION["S_PERSONA_CERT"];
?> 
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>


</body>
</html>