<?php
require_once("../dompdf/dompdf_config.inc.php");
$tabla = $_REQUEST['expTabla'];
$papel = $_REQUEST['expPapel'];
$orientacion = $_REQUEST['expOrientacion'];
$file = $_REQUEST['expFile'];

$cuerpo =$tabla;



$cuerpo = stripslashes($cuerpo);
  
$old_limit = ini_set("memory_limit", "500M");
  
$dompdf = new DOMPDF();
$dompdf->load_html($cuerpo);
$dompdf->set_paper($papel, $orientacion);
$dompdf->render();

$dompdf->stream($file.".pdf");
?>