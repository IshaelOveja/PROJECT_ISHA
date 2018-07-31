$(document).ready(function(){
    
    fn_buscarEmpleado();
   
    
});

function fn_buscarEmpleado(){
    $("#pagPagina").val("1");
    $("#pagMostrar").val("20");
    var str = $("#frmBuscarEmpleado").serialize();
    $('#divListarEmpleado').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/per_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarEmpleado").html(data);
		}
    });
}
function fn_paginacion(pagina,mostrar){
    $("#pagPagina").val(pagina);
    $("#pagMostrar").val(mostrar);
    var str = $("#frmBuscarEmpleado").serialize();
    $('#divListarEmpleado').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/per_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarEmpleado").html(data);
		}
    });
}
function fn_enviarFormulario(opc, cc_persona){
     $('#modalEmpleado .modal-content').load('../datos_generales/per_form.php?opc='+opc+'&cc_persona='+cc_persona, function (result) {
        $('#modalEmpleado').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 function fn_enviarHijo(opc, cc_persona, cc_hijos){
     $('#modalHijo .modal-content').load('../datos_generales/hij_form.php?opc='+opc+'&cc_persona='+cc_persona+'&cc_hijos='+cc_hijos, function (result) {
        $('#modalHijo').modal({ show: true,backdrop: "static" });                    
    });
 }
 function fn_grabarEmpleado(){
    
    var str = $("#frmEmpleado").serialize();
    $('#divGuardarEmpError').html('<img src="../img/loading.gif" />');
    $.ajax({
		url: '../datos_generales/per_update.php',
		type: 'post',
		data: str,
		success: function(data){
                        var mensaje="";
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarEmpError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                            fn_buscarEmpleado();
							//alert(data);
                            $("#modalEmpleado").modal("hide");
                        }else{
                            mensaje = data;
                            if (data=="D"){
                                mensaje="Número de documento ya existe";
                            }
                            $('#divGuardarEmpError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
 }

function fn_grabarHijo(){
    
    var str = $("#frmHijo").serialize();
    $('#divGuardarEmpError').html('<img src="../img/loading.gif" />');
    $.ajax({
		url: '../datos_generales/hij_update.php',
		type: 'post',
		data: str,
		success: function(data){
            var mensaje="";
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarEmpError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                            fn_buscarEmpleado();
							//alert(data);
                            $("#modalHijo").modal("hide");
                        }else{
							//alert(data);
                            $('#divGuardarEmpError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
 }
 
 
function fn_confirmarEliminar(cc_id1,cc_id2){

     $('#modalRegistro .modal-content').load('../comun/frmEliminar.php?cc_id1='+cc_id1+'&cc_id2='+cc_id2, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
  

}

function fn_eliminar(){
        var cc_hijos=$("#cc_id1").val();
        $.ajax({
            url: '../datos_generales/hij_update.php',
            data: 'cc_hijos=' + cc_hijos+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                         fn_buscarEmpleado();
                        $("#modalRegistro").modal("hide");
                }else{
                       $("#divAvisoEliminar").val(data);
                }
            }
        });
    
}