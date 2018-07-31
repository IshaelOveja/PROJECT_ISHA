$(document).ready(function(){
    
	
});
function fn_ejecutar(){
	var str = $("#frm_entidad").serialize();
	 $('#divGuardarModPerError').html(cargador());
	swal({
	  title: "Desea procesar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
           url: '../seguridad/ent_update.php',
            type: 'post',
			data: str,
            success: function(data){
                if(jQuery.trim(data) != "X"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
						//alert(data);
                        //fn_buscarUsuario();
                }else{
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
function cargador(){
	var car='<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div>';
	return car;
	}
