
$(document).ready(function(){
   $("#salir_link").click(function() { 
     location.href = this.href; 
    });
    
    
    
});

function fn_verSemaforo(cc_indicador){

     $('#modalCambiarClave .modal-content').load('../comun/frmSemaforo.php?cc_indicador='+cc_indicador, function (result) {
        $('#modalCambiarClave').modal({ show: true,backdrop: "static" });                    
    });
  

}
function fn_cambiarClave(){
    
     $('#modalCambiarClave .modal-content').load('clave.php', function (result) {
        $('#modalCambiarClave').modal({show: true,backdrop: "static"});                    
    });
 }

 function fn_guardarClave(){
    
    var str = $("#frmCambiarClaveEdit").serialize();
    $('#divGuardarClaveError').html('<img src="../img/loading.gif" />');
    
    $.ajax({
		url: 'clave_update.php',
		type: 'post',
		data: str,
		success: function(data){
                        var mensaje=data;
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarClaveError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                           
                            fn_salirClave();
                           
                        }else{
                           
                            $('#divGuardarClaveError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
}

function  fn_salirClave(){
    $("#modalCambiarClave").modal("hide");
    $("#salir_link").click();
}


