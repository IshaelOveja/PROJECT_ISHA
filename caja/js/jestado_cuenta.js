$(document).ready(function(){
  $("#BuscarColegiado").click(function() {
        $('#modalRegistro .modal-content').load('../comun/persona_buscar.php', function (result) {
            $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
        });
   });
  
});
function fn_asignar_persona(cc_persona,nombre,c_colegiado){
    $("#cc_persona").val(cc_persona);
    $("#nomNombre").val(nombre);
    $("#c_colegiado").val(c_colegiado);
    $("#modalRegistro").modal("hide");
}

function fn_buscarColegiado(){
    var str = $("#frmBuscarColegiado").serialize();
    $('#divListarRegistro').html('<img src="../img/loading.gif" />');
    $.ajax({
		   
           url: '../caja/estado_cuenta_lista.php',
            type: 'post',
            data: str,
            success: function(data){
				
                    $("#divListarRegistro").html(data);
					$('#tableID').DataTable({
					dom: 'Bfrtip',
					
					retrieve: true,
					paging: true,
					buttons: [
						'csv', 'excel', 'pdf', 'print'
					]
				});
            }
    });
}