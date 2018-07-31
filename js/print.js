$(document).ready(function(){
    $(document).on('click', '#printer', function (event) {
        event.preventDefault();
        var $print = $("#imprimir");
        $(document.body).wrapInner('<div  style="display:none; font-size:10px" ></div>');
		
        var $div = $('<div />').append($print.clone().contents()).appendTo(document.body);
        window.print();
        $div.remove();
        $(document.body).children().contents().unwrap();
    });
});

function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}


function fn_excel(){
    $("#expTabla").val($("<div>").append( $("#TablaExportar").eq(0).clone()).html());
    $("#frmColExportar").attr("action","../comun/expExcel.php");
    $("#frmColExportar").submit();

}