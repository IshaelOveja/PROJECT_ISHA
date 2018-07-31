$(document).ready(function(){
   // fn_buscarRegistro();

});


function fn_buscarRegistro(){
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html('<img src="../imag/loading.gif" />');
    $.ajax({
            url: '../caja/habil_inhabil_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarRegistro").html(data);
            }
    });
}

 
