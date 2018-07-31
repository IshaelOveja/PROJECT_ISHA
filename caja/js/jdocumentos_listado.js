$(document).ready(function(){
  //  fn_buscarRegistro();
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
    $("#pagPagina").val("1");
    $("#pagMostrar").val("40");
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html(cargador());
    $.ajax({
            url: '../caja/documentos_listado_lista.php',
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
    $('#divListarRegistro').html(cargador());
    $.ajax({
            url: '../caja/documentos_listado_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarRegistro").html(data);
            }
    });
}

function cargador(){
	var car='<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div></div>';
	return car;
	}