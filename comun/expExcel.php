<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=".$_REQUEST['expFile'].".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_REQUEST['expTabla'];
?>