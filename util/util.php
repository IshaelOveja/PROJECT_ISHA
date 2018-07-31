<?php


function u_vigencia($estado) {
    if($estado=="1"){
        echo "<img src='".u_img()."si.png' class='img-circle'  alt='Activo' border='0'/>";
    }else{
       echo "<img src='".u_img()."close.png' class='img-circle'  alt='Activo' border='1'/>";
    }
}


function u_meses(){
	$data=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
	return $data;
}
function u_ano(){
	$data=array('2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020');
	return $data;
}


function u_foto($foto){
    $ret="";
    if (strlen($foto)>0){
        $ret="<img src=\"../foto/".$foto."\" border=\"1\" height=\"70\">";
    }
    return $ret;
}
function u_img(){
	return '../img/';
}
function u_src(){
	return "../src/";
}
function tituloLik($modulo){
	$ret='<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        	<ol class="breadcrumb">
				<li class="breadcrumb-item active">'.$modulo.'</li>
       	 	</ol>
		</div>
	</div>';
	return $ret;
	}



function u_ascui($String){
    $String = str_replace(array('á','?','â','?','?','ä'),"a",$String);
    $String = str_replace(array('Á','?','Â','?','Ä'),"A",$String);
    $String = str_replace(array('Í','?','Î','?'),"I",$String);
    $String = str_replace(array('í','?','î','?'),"i",$String);
    $String = str_replace(array('é','?','?','ë'),"e",$String);
    $String = str_replace(array('É','?','?','Ë'),"E",$String);
    $String = str_replace(array('ó','?','ô','?','ö','?'),"o",$String);
    $String = str_replace(array('Ó','?','Ô','?','Ö'),"O",$String);
    $String = str_replace(array('ú','?','?','ü'),"u",$String);
    $String = str_replace(array('Ú','?','?','Ü'),"U",$String);
    $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
    $String = str_replace("ç","c",$String);
    $String = str_replace("Ç","C",$String);
    $String = str_replace("?","n",$String);
    $String = str_replace("?","N",$String);
    $String = str_replace("Ý","Y",$String);
    $String = str_replace("ý","y",$String);
    return utf8_decode($String);
}
function u_validarFecha($input,$format=""){
    $separator_type= array(
        "/",
        "-",
        "."
    );
    foreach ($separator_type as $separator) {
        $find= stripos($input,$separator);
        if($find<>false){
            $separator_used= $separator;
        }
    }
    $input_array= explode($separator_used,$input);
    if ($format=="mdy") {
        return checkdate($input_array[0],$input_array[1],$input_array[2]);
    } elseif ($format=="ymd") {
        return checkdate($input_array[1],$input_array[2],$input_array[0]);
    } else {
        return checkdate($input_array[1],$input_array[0],$input_array[2]);
    }
    $input_array=array();
}
function u_fecha($fecha){
    if (strlen($fecha)>0){
        if(u_validarFecha($fecha)){
            $nueva=str_replace("/", "-",$fecha);
            $fecha       = date_create($nueva);
            $fechaformat = "'".$fecha->format("Y-m-d")."'";
        }else{
            $fechaformat = "null";
        }
    }else{
       $fechaformat = "null"; 
    }
    return $fechaformat;
}
function decimal($total,$digito){
    return number_format($total, $digito, '.', ',');
}
function digitos($number,$n) {/*completar 6 digitos cep*/
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
     }

function u_ip() {
    if (isset($_SERVER['HTTP_CLIENT_IP']))
    return $_SERVER['HTTP_CLIENT_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];

}
function u_upload_uno($destino,$tamano=7000000){
    $archivo="X";
    $i=0;
    if(isset($_FILES['archivo'])){
    $nombre_archivo = $_FILES['archivo']['name'];
    $tipo_archivo = $_FILES['archivo']['type'];
    $tamano_archivo = $_FILES['archivo']['size'];
    $temp=$_FILES['archivo']['tmp_name'];
            if($tamano_archivo!=0){
            if($tamano_archivo >$tamano) {
                    $archivo="X";
            }else{
            if (move_uploaded_file($temp, $destino.$nombre_archivo)){
                    $archivo=$nombre_archivo;
            }else{
                    $archivo="X";
            }
            }
            }else{
                    $archivo="X";
            }
    }
    return $archivo;
}


function fecha_hora(){
$mes[0]="-";
$mes[1]="enero";
$mes[2]="febrero";
$mes[3]="marzo";
$mes[4]="abril";
$mes[5]="mayo";
$mes[6]="junio";
$mes[7]="julio";
$mes[8]="agosto";
$mes[9]="septiembre";
$mes[10]="octubre";
$mes[11]="noviembre";
$mes[12]="diciembre";

/* Definición de los días de la semana */

$dia[0]="Domingo";
$dia[1]="Lunes";
$dia[2]="Martes";
$dia[3]="Miércoles";
$dia[4]="Jueves";
$dia[5]="Viernes";
$dia[6]="Sábado";

/* Implementación de las variables que calculan la fecha */

$gisett=(int)date("w");
$mesnum=(int)date("m");

/* Variable que calcula la hora
*/

$hora = date(" H:i",time());

/* Presentación de los resultados en una forma similar a la siguiente:
Miércoles, 23 de junio de 2004 | 17:20
*/
echo $dia[$gisett]." ".date("d")." de ".$mes[$mesnum]." del ".date("Y")." | ".$hora;

}
function crearClave(){
		$pass = '';
		$chars = array(
			"1","2","3","4","5","6","7","8","9","0");
	
		$count = count($chars) - 1;
	
		srand((double)microtime()*1000000);
	
		for($i = 0; $i < 6; $i++){
			$pass.= $chars[rand(0, $count)];
		}
		return($pass);
	}
function bt_imprimir($imprimir, $exportar){
	 
     if($exportar=="1"){
    echo '<label>
   <form action="index.php" method="post" name="frmColExportar" id="frmColExportar" target="_blank">
	<button type="button" class="btn btn-outline btn-primary" id="btnExcel" onClick="fn_excel()"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar</button>
	<input type="hidden" name="expTabla" id="expTabla" value=""/>
	<input type="hidden" name="expFile" id="expFile" value="Reporte"/>
	<input type="hidden" name="expPapel" id="expPapel" value="landscape"/>
	<input type="hidden" name="expOrientacion" id="expOrientacion" value="a4"/>
	</form>
	</label>';
		}
	if($imprimir=="1"){
	echo '<label>
      <button type="button" id="printer" name="printer" class="btn btn-outline btn-primary"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
    </label>';
	 }
	 
	}


function estado_habilidad($deuda,$año){
    if(decimal($deuda,2)>0.00){$habil='INHABIL';} else {$habil='HABIL';}
    return $habil;
}



function foto_colegiado($num_documento,$cep){
      $fichero_dni = "../fotos/".$num_documento.".jpg";
      $fichero_cep = "../fotos/".$cep.".jpg";
      $cep = (int) $cep;
      $fichero_cep_no_0 = "../fotos/".$cep.".jpg";
      
        if (file_exists($fichero_dni)) {
            $foto=$fichero_dni;
        }elseif(file_exists($fichero_cep)) {
            $foto=$fichero_cep;
        } elseif(file_exists($fichero_cep_no_0)){
            $foto=$fichero_cep_no_0;
        }else {
            $foto="../fotos/sinfoto.jpg";
        }
        $data=$foto;
    return $data;
 }
 

 ?>