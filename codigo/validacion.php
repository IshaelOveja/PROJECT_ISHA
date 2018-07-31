<?php 
fecha_de_nacimiento: {
group: '.group',
    validators: {
       notEmpty: {
      message: 'Ingrese'
       },
       date: {
      message: 'Formato',
      format: 'DD/MM/YYYY'
       }
    }
},
c_pais:{
group: '.group',
    message:"Obligatorio",
    validators:{
        notEmpty:{
            message:"Obligatorio"
        }
    }
},
prof_duracion:{
group: '.group',
    message:"Tiempo meses",
    validators:{
        notEmpty:{
            message:"Tiempo meses"
        },
        regexp: {
         regexp: /^[0-9]+$/,
         message: 'Solo numeros'
        },
        stringLength: {
            min: 1,
            max: 2,
            message: 'max 2'
        }
    }
},	
celular:{
group: '.group',
    message:"Ingrese # Celular",
    validators:{
        notEmpty:{
            message:"Ingrese # Celular"
        },
        regexp: {
         regexp: /^[0-9]+$/,
         message: 'solo numeros'
        },
        stringLength: {
            min: 9,
            max: 9,
            message: '9 numeros'
        }
    }
}
			
?>