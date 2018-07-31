$(document).ready(function () {

    $("#nombres").typeahead({
        dynamic: 300,
        maxItem: 20,
        hint: true,
        minLength: 6,
        highlight: true,
        source: function (query, process)
        {
            $.ajax({
                url: "../comun/json_personas.php",
                method: "POST",
                data: {query: query},
                dataType: "json",
                success: function (data)
                {
                    objects = [];
                    map = {};
                    $.each(data, function (i, object) {
                        map[object.nombre] = object;
                        objects.push(object.nombre);
                    });
                    process(objects);
                }

            })
        }, updater: function (item) {
            $("#cc_persona").val(map[item].cc_persona);
            // alert(map[item].cc_persona);
            return item;
        }
    });

fn_listarDetalle();
});

function fn_listarDetalle(){
    var str = $("#frmFormulario").serialize();
    $('#divDetalle').html(cargador());
    $.ajax({
            url: '../caja/factura_detalle_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divDetalle").html(data);
            }
    });
}

function fn_numCorrelativo(tp_doc) {
    $.ajax({
        url: '../comun/documento_correlativo.php',
        data: 'tp_doc=' + tp_doc,
        type: 'post',
        success: function (data) {
            $("#numero").val(data);
        }
    });
}

function fn_nuevo_detalle(){
	/*var nomCliente=$("#cc_persona").val();
    if(nomCliente==""){
	  		swal("Seleccionar cliente!")
        return;
    }

    var tp_documento=$("#cod_documento").val();
    if(tp_documento==""){
		swal("Seleccionar documento!")
        return;
    }
	 var tp_pago=$("#tipo_pago").val();
    if(tp_pago==""){
		swal("Seleccionar forma de pago!")
        return;
    }*/
	

    $('#modalRegistro .modal-content').load('../caja/factura_detalle_from.php', function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
}




function cargador() {
    var car = '<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div></div>';
    return car;
}