$(document).ready(function(){
 

});

function fn_asignaModulo(cc_perfil){
    $("#cc_perfilb").val(cc_perfil);
    var str = $("#frmAsigPerfil").serialize();
    $('#asigPerfil').html(cargador());
    $.ajax({
		url: '../seguridad/acc_lista.php',
		type: 'post',
		data: str,
		success: function(data){
			$("#asigPerfil").html(data);
		}
    });
      
  
}
 
function fn_grabarAsigModulo(){
    var str = $("#frmAsigModuloPerfil").serialize();
    $('#divGuardarModPerError').html(cargador());
    $.ajax({
		url: '../seguridad/acc_update.php',
		type: 'post',
		data: str,
		success: function(data){
                        var mensaje=data;
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
                            swal({
							  title: "Correcto...",
							  text: "Cierre automatico...",
							  timer: 1000,
							  showConfirmButton: false
							});
                            /*var cc_perfil=$("#cc_perfil").val();
                            fn_asignaModulo(cc_perfil);*/
                           
                        }else{
                           
                            $('#divGuardarModPerError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
}

function cargador(){
	var car='<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div>';
	return car;
	}


