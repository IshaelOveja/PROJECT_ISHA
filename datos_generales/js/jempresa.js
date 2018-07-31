$(document).ready(function(){
    fn_buscarEmpresa();
    
});

function fn_buscarEmpresa(){
    $("#pagPagina").val("1");
    $("#pagMostrar").val("20");
    var str = $("#frmBuscarEmpresa").serialize();
    $('#divListarEmpleado').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/emp_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarEmpresa").html(data);
		}
    });
}
function fn_paginacion(pagina,mostrar){
    $("#pagPagina").val(pagina);
    $("#pagMostrar").val(mostrar);
    var str = $("#frmBuscarEmpleado").serialize();
    $('#divListarEmpleado').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/emp_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarEmpresa").html(data);
		}
    });
}
function fn_enviarFormulario(opc, emp_ruc){
     $('#modalEmpresa .modal-content').load('../datos_generales/emp_form.php?opc='+opc+'&emp_ruc='+emp_ruc, function (result) {
        $('#modalEmpresa').modal({ show: true,backdrop: "static" });                    
    });
 }
 

 function fn_grabarEmpresa(){
    
    var str = $("#frmEmpresa").serialize();
    $('#divGuardarEmpError').html('<img src="../img/loading.gif" />');
    $.ajax({
		url: '../datos_generales/emp_update.php',
		type: 'post',
		data: str,
		success: function(data){
                        var mensaje="";
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarEmpError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                            fn_buscarEmpresa();
							//alert(data);
                            $("#modalEmpresa").modal("hide");
                        }else{
                            mensaje = data;
                            if (data=="D"){
                                mensaje="RUC ya existe";
                            }
                            $('#divGuardarEmpError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
 }