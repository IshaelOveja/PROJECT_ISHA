$(document).ready(function(){
  $("#BuscarCliente").click(function() {
        $('#modalRegistro .modal-content').load('../comun/per_buscar.php', function (result) {
            $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
        });
   });
});

function fn_asignar_cliente(cc_persona,ct_nombres,ct_nro_doc){/******************ok*/
    $("#cc_persona").val(cc_persona);
    $("#nomCliente").val(ct_nombres);
    $("#ct_nro_doc").val(ct_nro_doc);
    $("#modalRegistro").modal("hide");
}

function fn_buscarRegistro(){
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html('<tr><td class="text-center" colspan="9"><img src="../img/loading.gif" /></td></tr>');
    $.ajax({
		url: '../datos_generales/deu_lista.php',
		type: 'post',
		data: str,
		
		success: function(data){
			$("#divListarRegistro").html(data);
		}
    });
}
function fn_verRecibo(cc_caja){
	$('#modalRegistro .modal-content').load('../caja/ver_recibo.php?cc_caja='+cc_caja, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
function fn_controlRegistro(cc_persona, cc_estcta,opc){
     $('#modalRegistro .modal-content').load('../datos_generales/deu_form.php?cc_persona='+cc_persona+'&cc_estcta='+cc_estcta+'&opc='+opc, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 

function fn_grabarRegistro(){
    var str = $("#frmGrabarRegistro").serialize();
    $('#divGuardarSerError').html('<img src="../img/loading.gif" />');
    $.ajax({
		url: '../datos_generales/deu_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			if(jQuery.trim(data)=="0"){
               $('#divGuardarSerError').html('<div class="alert alert-succes alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Se ha grabado correctamente</div>');
               fn_buscarRegistro();
                $("#modalRegistro").modal("hide");
                 }else{
                $('#divGuardarSerError').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" arial-hidden="true">&times;</button>Error: '+mensaje+'</div>');
						
                        }
		}
    });
}
