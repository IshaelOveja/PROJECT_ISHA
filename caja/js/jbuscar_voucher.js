$(document).ready(function(){
fn_listar_banco();
  //fn_buscarRegistro();
});
function fn_buscarRegistro(){
	
    var str = $("#frmBuscarRegistro").serialize();
    $('#divListarRegistro').html('<img src="../imag/loading.gif" />');
    $.ajax({
            url: '../caja/buscar_voucher_lista.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarRegistro").html(data);
            }
    });
}
function fn_listar_banco(){
       $.ajax({
           url: '../comun/lista_banco.php',
            data: str,
            type: 'post',
            success: function(data){
              $("#cc_banco").html(data); 
            }
        });
}

/* function fn_listar_banco(c_local,div){
       $.ajax({
            url: '../comun/lista_banco.php',
            data: 'cc_cr='+c_local,
            type: 'post',
            success: function(data){
              $("#"+div).html(data); 
            }
        });
}*/
