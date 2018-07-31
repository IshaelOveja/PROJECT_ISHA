$(document).ready(function(){
   $("#BuscarColegiado").click(function() {
        $('#modalRegistro .modal-content').load('../comun/persona_buscar.php', function (result) {
            $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
        });
   });
	
  });
  
  function fn_asignar_cliente(c_persona,nombre_completo,c_cmp){
    $("#c_persona").val(c_persona);
    $("#nomCliente").val(nombre_completo);
    $("#c_cmp").val(c_cmp);
    $("#modalRegistro").modal("hide");
}


function fn_buscarColegiado(){
    var str = $("#frmBuscarColegiado").serialize();
   $('#divListarRegistro').html('<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div></div>');
    $.ajax({
              url: '../caja/estado_cuenta_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarRegistro").html(data);
            }
    });
}

   function fn_ProcesarRegistro(cc_persona,opc){
	
var str = $("#frmBuscarColegiado").serialize();
	swal({
	  title: "ALERTA!",
	  text:  "Deseas  "+cc_persona+"/"+opc+"?",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  showLoaderOnConfirm: true,
	},
	function(isConfirm){
		if (isConfirm) {
			 $.ajax({
			url: '../caja/pago_anual_update.php?c='+cc_persona+'opc='+opc,
            data:  'c='+cc_persona+'&opc='+opc,
            type: 'post',
            success: function(data){
                    if(jQuery.trim(data) != "X"){
                            $('#divGuardarSerError').html('<div class="alert alert-success">  Documento procesado correctamente</div>');
                           
                    }else{
                            alert("Error: no se podido Procesar!!! "+cc_persona+"/"+opc);
                    }

				}
		});
		setTimeout(function(){
			swal("Felicitaciones!");
			fn_buscarColegiado();
  		}, 2000);
	  	
		} else {
			swal("Cancelar", "Your imaginary file is safe :)", "error");
		  }
	});
  
}