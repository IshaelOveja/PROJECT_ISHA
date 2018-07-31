<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORDLIMA | Usuario</title>
	<link rel="shortcut icon" href="../img/favicon.ico" />
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Bootstrap/css/bootstrapValidator.min.css" rel="stylesheet"/>
    <link href="../Bootstrap/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../Bootstrap/css/animate.css" rel="stylesheet">
    <link href="../Bootstrap/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
	<script src="../Bootstrap/js/jquery-3.1.1.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../Bootstrap/js/bootstrapValidator.min.js"></script>
    
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
				
                <h1 class="logo-name"><img src="../img/logo_corladlima.jpg" width="120"></h1>

          </div>
            <h3>Bienvendios</h3>
            <p>Sistema de gestión Insticuional</p>
            <p>Usuario y contraseña.</p>
           <form id="frmValidar" class="form-horizontal"  action="validar.php"  name="frmValidar" method="post">
           <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="cc_user" id="cc_user" value="admin"  placeholder="Usuario"/>
                    </div>
                </div>
            </div>
                
             <div class="form-group">
                <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                    <input type="password" class="form-control" name="ct_clave" id="ct_clave" value="123"  placeholder="Clave"/>
                </div>
     </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Iniciar sesión</button>

                <a href="#"><small>¿Olvidaste tu cuenta?</small></a>
               <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>-->
                <a class="btn btn-sm btn-white btn-block" href="register.html">Crea tu cuenta</a>
            </form>
            <!--<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>-->
        </div>
    </div>

    <!-- Mainly scripts -->
    


  <script type="text/javascript">
$(document).ready(function() {
     $('#frmValidar').bootstrapValidator({
       message:'No valido',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            cc_user:{
                message:"Ingrese usuario",
                validators:{
                    notEmpty:{
                        message:"Ingrese Usuario"
                    },
                    stringLength:{
                        min:3,
                        max:50,
                        message:"Debe ser mayor a 5 caracteres "
                    }
                }
            },
            ct_clave:{
                message:"Ingrese Clave",
                validators:{
                    notEmpty:{
                        message:"Ingrese Clave"
                    }
                }
            }
        }
    });


});
</script>

</body>

</html>