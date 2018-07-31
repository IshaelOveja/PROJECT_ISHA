$(document).ready(function(){
    fn_buscarRegistro();
    
});

function fn_buscarRegistro(){
    $("#pagPagina").val("1");
    $("#pagMostrar").val("20");
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/art_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarRegistro").html(data);
		}
    });
}
function fn_paginacion(pagina,mostrar){
    $("#pagPagina").val(pagina);
    $("#pagMostrar").val(mostrar);
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/art_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarRegistro").html(data);
		}
    });
}
function fn_enviarFormulario(opc, cc_articulo){
     $('#modalRegistro .modal-content').load('../datos_generales/art_form.php?opc='+opc+'&cc_articulo='+cc_articulo, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 function fn_actualizar(){
     $('#modalRegistro .modal-content').load('../datos_generales/art_actualizar.php', function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
function fn_grabarRegistro(){
    
    var str = $("#frmRegistro").serialize();
    $('#divGuardarEmpError').html('<img src="../img/loading.gif" />');
    $.ajax({
		url: '../datos_generales/art_update.php',
		type: 'post',
		data: str,
		success: function(data){
              var mensaje="";
			if(jQuery.trim(data)=="0"){
                            $('#divGuardarEmpError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
                            fn_buscarRegistro();
							//alert(data);
                            $("#modalRegistro").modal("hide");
                        }else{
							//alert(data);
                            $('#divGuardarEmpError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
                        }
		}
    });
 }
function fn_actualizar(){
	swal({
	  title: "Actualizar precios?",
	  //text: "Anular este recibo!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Si!",
	  closeOnConfirm: false
	},
	function(){
	  $.ajax({
           url: '../datos_generales/art_actualizar_update.php',
            data: 'opc=U',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data)!= "X"){
                        //alert(data);
						 swal("Actualizado!", "Correctamente .", "success");
                        fn_buscarRegistro();
                }else{
                        alert("Error al anular");
                }
            }
        });
	 
	});
}