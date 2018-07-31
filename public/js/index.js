$(function () {
    $("#frmRegisterCollege").submit(function (e) {
        e.preventDefault();
        swal({
            title: "Mensaje", text: "Estás seguro de guardar los cambios",
            type: "info", showCancelButton: true, closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, () => {
            var data = $(this).serialize();
            $.ajax({
                url: "register_new_college.php", method: "POST", data: data,
                beforeSend: () => {
                    console.log("Conectando...");
                },
                success: (res) => {
                    if (res === 1) {
                        swal({title: "Proceso Exitoso",
                            text: "Felicidades, se guardó con exito sus datos",
                            type: "success"}, () => {
                            $(location).attr('href', "http://localhost/admin/public/");
                        });
                    } else {
                        swal({title: "Error", text: res, type: "error"});
                    }
                }
            });
        });
        return false;
    });
    $("#frmSessionAccount").submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        alert(data);
        $.ajax({url: "validate_account.php", method: "POST", data: data,
            success: (res) => {
                alert(res);
            }});
        return false;
    });
});


