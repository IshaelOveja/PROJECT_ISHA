$(document).ready(function(){
	fn_buscarUsuario();

});

function fn_buscarUsuario(){
    var str = $("#frmBuscarUsuario").serialize();
    $('#divListarUsuario').html(cargador());
    $.ajax({
		   
            url: '../seguridad/usu_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarUsuario").html(data);
            }
    });
}

function fn_paginacion(pagina,mostrar){
    $("#pagPagina").val(pagina);
    $("#pagMostrar").val(mostrar);
    var str = $("#frmBuscarUsuario").serialize();
    $('#divListarUsuario').html(cargador());
    $.ajax({
            url: '../seguridad/usu_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarUsuario").html(data);
            }
    });
}



function fn_controlUsuario(cc_usuario,opc){
     $('#modalUsuario .modal-content').load('../seguridad/usu_form.php?cc_usuario='+cc_usuario+'&opc='+opc, function (result) {
        $('#modalUsuario').modal({ show: true,backdrop: "static" });                    
    });
 }
 
function fn_nuevoUsuario(){
     $('#modalNewUsuario .modal-content').load('../seguridad/usu_buscar_emp.php', function (result) {
        $('#modalNewUsuario').modal({ show: true,backdrop: "static" });                    
    });
 }
 
function fn_grabarUsuario(){
    var str = $("#frmGrabarUsuario").serialize();
    $('#divGuardarUsuError').html(cargador());
    $.ajax({
		url: '../seguridad/usu_update.php',
		type: 'post',
		data: str,
		success: function(data){
             var mensaje=data;
			if(jQuery.trim(data)=="0"){
                  $('#divGuardarUsuError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                      fn_buscarUsuario();
                         $("#modalUsuario").modal("hide");
                        }else{
                      $('#divGuardarUsuError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
}

function fn_confirmarEliminar(cc_id1,cc_id2){
     $('#modalUsuario .modal-content').load('../comun/frmEliminar.php?cc_id1='+cc_id1+'&cc_id2='+cc_id2, function (result) {
        $('#modalUsuario').modal({ show: true,backdrop: "static" });                    
    });
}
function fn_eliminar(cc_usuario){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../seguridad/usu_update.php',
            data: 'cc_usuario=' + cc_usuario+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_buscarUsuario();
                }else{
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}

function fn_asignarUsuario(num){
  var cc_empleado;
  cc_empleado=$("#cc_emplevarev"+num).prop('title');
  $("#modalNewUsuario").modal("hide");
  fn_controlUsuario(cc_empleado,'I');
}

function fn_buscarNuevoUsuario(){
    var str = $("#frmBuscarNewUsuario").serialize();
    $('#divListaUsuario').html(cargador());
    $.ajax({
		url: '../seguridad/usu_lista_usu.php',
		type: 'post',
		data: str,
		success: function(data){
			$("#divListaUsuario").html(data);
		}
    });
}

function cargador(){
	var car='<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div>';
	return car;
	}
