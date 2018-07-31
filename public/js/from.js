$(function () {
    $('#frmRegisterCollege').bootstrapValidator({
        message: 'No valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            frc_type_doc: {
                message: "Ingrese tipo de documento",
                validators: {
                    notEmpty: {
                        message: "Ingrese tipo de documento"
                    }
                }
            },
            frc_num_doc: {
                message: "Ingrese número de documento",
                validators: {
                    notEmpty: {
                        message: "Ingrese número de documento"
                    }
                }
            },
            frc_country: {
                message: "Ingrese Pais",
                validators: {
                    notEmpty: {
                        message: "Ingrese Pais"
                    }
                }
            },
            frc_surname_f: {
                message: "Ingrese apellido paterno",
                validators: {
                    notEmpty: {
                        message: "Ingrese apellido paterno"
                    }
                }
            },
            frc_surname_m: {
                message: "Ingrese apellido materno",
                validators: {
                    notEmpty: {
                        message: "Ingrese apellido materno"
                    }
                }
            },
            frc_name_o: {
                message: "Ingrese primer nombre",
                validators: {
                    notEmpty: {
                        message: "Ingrese primer nombre"
                    }
                }
            },
            frc_name_t: {
                message: "Ingrese segundo nombre",
                validators: {
                    notEmpty: {
                        message: "Ingrese segundo nombre"
                    }
                }
            },
            frc_email: {
                message: "Ingrese su correo",
                validators: {
                    notEmpty: {
                        message: "Ingrese su correo"
                    }
                }
            },
            frc_mobile: {
                message: "Ingrese su celular",
                validators: {
                    notEmpty: {
                        message: "Ingrese su celular"
                    }
                }
            }
        }
    });

});
