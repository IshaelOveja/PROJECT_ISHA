$(document).ready(function(){
   // fn_buscarRegistro();
	$('#fec_desde .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
				format: "dd/mm/yyyy"
            });
			$('#fec_hasta .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
				format: "dd/mm/yyyy"
            });


	
});


function fn_buscarRegistro(){
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html('<img src="../imag/loading.gif" />');
    $.ajax({
            url: '../caja/ingreso_conceptos_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarRegistro").html(data);
            }
    });
}

 
