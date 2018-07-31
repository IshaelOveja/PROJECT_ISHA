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
    $('#divListarRegistro').html(cargador());
    $.ajax({
            url: '../colegiatura/colegiado_taps.php',
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarRegistro").html(data);
            }
    });
}
function fn_ListarPerfil(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_perfil_from.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}

function fn_lista_provincia(coddpto,div,divlim){

	$.ajax({
		url: '../comun/ubi_provincia_lista.php',
		type: 'get',
		data: 'coddpto='+coddpto,
		success: function(data){
			$("#"+div).html(data);
		}
	});
        $("#"+divlim).html('');
}

function fn_lista_distrito(codprov,div,divlim){
        var coddpto = $("#"+divlim).val();
	$.ajax({
		url: '../comun/ubi_distrito_lista.php',
		type: 'get',
		data: 'coddpto='+coddpto+'&codprov='+codprov,
		success: function(data){
			$("#"+div).html(data);
		}
	});
}
 //-----------------------------------
function fn_lista_provincia1(coddpto1,div,divlim){

	$.ajax({
		url: '../comun/ubi_provincia_lista1.php',
		type: 'get',
		data: 'coddpto1='+coddpto1,
		success: function(data){
			$("#"+div).html(data);
		}
	});
        $("#"+divlim).html('');
}

function fn_lista_distrito1(codprov1,div,divlim){
        var coddpto1 = $("#"+divlim).val();
	$.ajax({
		url: '../comun/ubi_distrito_lista1.php',
		type: 'get',
		data: 'coddpto1='+coddpto1+'&codprov1='+codprov1,
		success: function(data){
			$("#"+div).html(data);
		}
	});
} 

function fn_grabarPersonas(){
	var str = $("#frmGrabarPersonas").serialize();
	
	swal({
	  title: "Atención!",
	  text: "Desea procesar este documento",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  showLoaderOnConfirm: true,
	},
	function(isConfirm){
		if (isConfirm) {
			 $.ajax({
          url: '../colegiatura/colegiado_perfil_update.php',
            data: str,
            type: 'post',
            success: function(data){
                    if(jQuery.trim(data) != "X"){
                            $('#divGuardarSerError').html('<div class="alert alert-success">  Documento procesado correctamente</div>');
							//$('#divGuardarSerError').html('<div class="alert alert-success">  '+data+'</div>');
                           /* $('#btngarbarcaja').hide();
                            $('#btnNuevo').show();
                            $('#btnImprimir').show();
                            $("#btnCancelar").hide();*/
                            //$("#caj_id").val(jQuery.trim(data));
                    }else{
                            alert("Error: no se podido grabar");
                    }

				}
		});
		setTimeout(function(){
			swal("Felicitaciones!");
  		}, 500);
	  	
		
		} else {
			swal("Cancelar", "Your imaginary file is safe :)", "error");
		  }
	});
   
}

/*********FAMILIA**************/
function fn_ListarFamiliares(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_familiares_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlFamilia(cc_familiares,cc_persona,opc){
     $('#modalRegistro .modal-content').load('../colegiatura/colegiado_familiares_from.php?cc_familiares='+cc_familiares+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarFamiliares(){
   	var str = $("#frmGrabarFamiliares").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_familiares_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarFamiliares(cc_persona);
				 $("#modalRegistro").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarFamilia(cc_familiares, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_familiares_update.php',
            data: 'cc_familiares=' + cc_familiares+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarFamiliares(cc_persona);
                }else{
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN FAMILIA******/

/*********TRABAJOS**************/
function fn_ListarTrabajos(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_trabajos_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlTrabajos(cc_trabajos,cc_persona,opc){
     $('#modalRegistro .modal-content').load('../colegiatura/colegiado_trabajos_from.php?cc_trabajos='+cc_trabajos+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarTrabajos(){
   	var str = $("#frmGrabarTrabajos").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_trabajos_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarTrabajos(cc_persona);
				 $("#modalRegistro").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarTrabajos(cc_trabajos, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_trabajos_update.php',
            data: 'cc_trabajos='+cc_trabajos+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarTrabajos(cc_persona);
                }else{
					
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN TRABAJO******/

/*********DIPLOMAS**************/
function fn_ListarDiplomas(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_diplomas_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlDiplomas(cc_diplomas,cc_persona,opc){
     $('#modalRegistrolg .modal-content').load('../colegiatura/colegiado_diplomas_from.php?cc_diplomas='+cc_diplomas+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistrolg').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarDiplomas(){
   	var str = $("#frmGrabarDiplomas").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_diplomas_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarDiplomas(cc_persona);
				 $("#modalRegistrolg").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarDiplomas(cc_diplomas, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_diplomas_update.php',
            data: 'cc_diplomas='+cc_diplomas+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarDiplomas(cc_persona);
                }else{
					
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}

/***********FIN DIPLOMAS******/


/*********DISTINCIONES**************/
function fn_ListarDistinciones(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_distinciones_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlDistinciones(cc_distinciones,cc_persona,opc){
     $('#modalRegistrolg .modal-content').load('../colegiatura/colegiado_distinciones_from.php?cc_distinciones='+cc_distinciones+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistrolg').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarDistinciones(){
   	var str = $("#frmGrabarDistinciones").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_distinciones_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarDistinciones(cc_persona);
				 $("#modalRegistrolg").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarDistinciones(cc_distinciones, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_distinciones_update.php',
            data: 'cc_distinciones='+cc_distinciones+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarDistinciones(cc_persona);
						//alert(date);
                }else{
					//alert(date);
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN DISTIONCIONES******/


/*********ESPECIALIDAD**************/
function fn_ListarEspecialidad(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_especialidad_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlEspecialidad(cc_especialidad,cc_persona,opc){
     $('#modalRegistro .modal-content').load('../colegiatura/colegiado_especialidad_from.php?cc_especialidad='+cc_especialidad+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarEspecialidad(){
   	var str = $("#frmGrabarEspecialidad").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_especialidad_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarEspecialidad(cc_persona);
				 $("#modalRegistro").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarEspecialidad(cc_especialidad, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_especialidad_update.php',
            data: 'cc_especialidad='+cc_especialidad+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarEspecialidad(cc_persona);
						//alert(date);
                }else{
					//alert(date);
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN ESPECIALIDAD******/

/**************COLEGIOS*/
function fn_ListarColegios(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_colegios_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlColegios(cc_colegios,cc_persona,opc){
     $('#modalRegistro .modal-content').load('../colegiatura/colegiado_colegios_from.php?cc_colegios='+cc_colegios+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarColegios(){
   	var str = $("#frmGrabarColegios").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_colegios_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarColegios(cc_persona);
				 $("#modalRegistro").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarColegios(cc_colegios, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_colegios_update.php',
            data: 'cc_colegios='+cc_colegios+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarColegios(cc_persona);
						//alert(date);
                }else{
					//alert(date);
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN COLEGIOS******/



/**************ORGANIZACIONES**************/
function fn_ListarOrganizaciones(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_organizaciones_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlOrganizaciones(cc_organizaciones,cc_persona,opc){
     $('#modalRegistro .modal-content').load('../colegiatura/colegiado_organizaciones_from.php?cc_organizaciones='+cc_organizaciones+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistro').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarOrganizaciones(){
   	var str = $("#frmGrabarOrganizaciones").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_organizaciones_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			  //$('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarOrganizaciones(cc_persona);
				 $("#modalRegistro").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarOrganizaciones(cc_organizaciones, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_organizaciones_update.php',
            data: 'cc_organizaciones='+cc_organizaciones+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarOrganizaciones(cc_persona);
						//alert(date);
                }else{
					//alert(date);
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN ORGANIZACIONES******/

/**************ESTUDIOS**************/
function fn_ListarEstudios(cc_persona){
   var str ="";
    $.ajax({
            url: '../colegiatura/colegiado_estudios_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
function fn_controlEstudios(cc_estudios,cc_persona,opc){
     $('#modalRegistrolg .modal-content').load('../colegiatura/colegiado_estudios_from.php?cc_estudios='+cc_estudios+'&cc_persona='+cc_persona+'&opc='+opc, function (result) {
        $('#modalRegistrolg').modal({ show: true,backdrop: "static" });                    
    });
 }
 
 
 function fn_grabarEstudios(){
   	var str = $("#frmGrabarEstudios").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_estudios_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			 // $('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				fn_ListarEstudios(cc_persona);
				 $("#modalRegistrolg").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

 function fn_eliminarEstudios(cc_estudios, cc_persona){
	swal({
	  title: "Desea eliminar?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        closeOnConfirm: false
	},function(){
	  $.ajax({
            url: '../colegiatura/colegiado_estudios_update.php',
            data: 'cc_estudios='+cc_estudios+'&opc=D',
            type: 'post',
            success: function(data){
                if(jQuery.trim(data) == "0"){
                        swal({
						  title: "Correcto...",
						  text: "Cierre automatico...",
						  timer: 300,
						  showConfirmButton: false
						});
                        fn_ListarEstudios(cc_persona);
						//alert(date);
                }else{
					//alert(date);
                        alert("Error al anular");
                }
            }
        });
	 
	});
	
}
/***********FIN ESTUDIOS******/

/**************ACTIVIDADES**************/
function fn_ListarActividades(cc_persona){
   var str ="";
   $('#divListarSubMenu').html(cargador());
    $.ajax({
            url: '../colegiatura/colegiado_actividades_lista.php?cc_persona='+cc_persona,
            type: 'post',
            data: str,
            success: function(data){
                    $("#divListarSubMenu").html(data);
            }
    });
}
 
 function fn_grabarActividades(){
   	var str = $("#frmGrabarActividades").serialize();
	var cc_persona=$("#cc_persona").val();
   
    $('#divGuardarSerError').html(cargador());
    $.ajax({
		 url: '../colegiatura/colegiado_actividades_update.php',
		type: 'post',
		data: str,
		success: function(data){
           var mensaje=data;
			//if(jQuery.trim(data)=="X"){
			if(jQuery.trim(data) != "X"){
             $('#divGuardarSerError').html('<div class="alert alert-success">Documento procesado correctamente</div>');
			//* $('#divGuardarPerError').html('<div class="alert alert-success">'+data+'</div>');
				swal({
				  title: "Correcto...",
				  text: "Cierre automatico...",
				  timer: 1000,
				  showConfirmButton: false
				});
				//fn_ListarEstudios(cc_persona);
				 //$("#modalRegistrolg").modal("hide");
				 //alert(data);
             }else{
             $('#divGuardarPerError').html('<div class="alert alert-danger">Error: '+mensaje+'</div>');
      		}
		}
    });
}

/***********FIN ACTIVIDADES******/

function cargador(){
	var car='<div class="ibox-content"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div>';
	return car;
	}
