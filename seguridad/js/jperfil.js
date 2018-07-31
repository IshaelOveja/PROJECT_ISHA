$(document).ready(function(){
    fn_buscarPerfil();

});

function fn_buscarPerfil(){
    var str = $("#frmBuscarPerfil").serialize();
    $('#divListarPerfil').html(cargador());
    $.ajax({
            url: '../seguridad/per_lista.php',
            type: 'post',
            data: str,
            success: function(data){
				//alert(data);
                    $("#divListarPerfil").html(data);
				
            }
    });
}

function fn_controlRegistro(cc_perfil,opc){
     $('#modalPerfil .modal-content').load('../seguridad/per_form.php?cc_perfil='+cc_perfil+'&opc='+opc, function (result) {
        $('#modalPerfil').modal({ show: true,backdrop: "static" });                    
    });
 }
 
function fn_grabarPerfil(){
    var str = $("#frmGrabarPerfil").serialize();
    $('#divGuardarPerError').html(cargador());
    $.ajax({
		url: '../seguridad/per_update.php',
		type: 'post',
		data: str,
		success: function(data){
                        var mensaje=data;
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarPerError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                           
                            fn_buscarPerfil();
                            $("#modalPerfil").modal("hide");
                           
                        }else{
                           
                            $('#divGuardarPerError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
}
function fn_confirmarEliminar(cc_id1,cc_id2){

     $('#modalPerfil .modal-content').load('../comun/frmEliminar.php?cc_id1='+cc_id1+'&cc_id2='+cc_id2, function (result) {
        $('#modalPerfil').modal({ show: true,backdrop: "static" });                    
    });
  

}

function fn_confirmarEliminar(cc_perfil){
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
            url: '../seguridad/per_update.php',
            data: 'cc_perfil=' + cc_perfil+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_buscarPerfil();
                }else{
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}

function cargador(){
	var car='<td colspan="4"><div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div></td>';
	return car;
	}

