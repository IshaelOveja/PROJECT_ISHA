<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_seg_modulo.php"); 
require_once(u_src()."bo/bo_seg_perfil.php"); 
s_validar_pagina();
$bo_modulo      = new bo_seg_modulo();
$bo_perfil      = new bo_seg_perfil();

$cc_perfil      = $_REQUEST["cc_perfilb"];

$date_padre=$bo_modulo->listarPadre();


?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Modulos detallado</div>
  <div class="panel-body">
    <p><form action="javascript:fn_grabarAsigModulo();" role="form" id="frmAsigModuloPerfil">
       <table width="100%">
       <?php foreach($date_padre as $pa){?>
      	<tr>
        	<td><strong><i class="fa fa-angle-double-right"></i> <?php echo $pa["mod_nombre"] ?></strong></td>
        </tr>
       <?php 
	   	   $date_hijo=$bo_modulo->listarHijo($pa["mod_id1"]);
		   foreach($date_hijo as $hijo){
			  
				
		   ?>
         <tr>
         	<td><strong>&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i> <?php echo $hijo["mod_nombre"] ?></strong></td>
         </tr>
         <?php $date_nieto=$bo_modulo->listarNieto($hijo["mod_id1"], $hijo["mod_id2"], $cc_perfil);
		 
     	 foreach($date_nieto as $nie){
			  $check="";
				if($nie["n"]>0){
					 $check=' checked="checked" ';
				}
			 ?>
         <tr>
         	<td class="material-switch" height="30">&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="cc_modulo[]" id="cc_modulo<?php echo $nie["cc_modulo"] ?>" value="<?php echo $nie["cc_modulo"] ?>"  <?php echo $check ?> <?php echo $des ?>/>
                            <label for="cc_modulo<?php echo $nie["cc_modulo"] ?>" class="label-info"></label>&nbsp; <?php echo $nie["mod_nombre"] ?>
                            
                             
                    </td>
         </tr>
         
        <?php } } }?>
        <tr>
        	<td id="divGuardarPerError"></td>
        </tr>
        <tr>
        	<td>
            <input type="hidden" class="input-sm" name="cc_perfil" value="<?php echo $cc_perfil ?>" id="cc_perfil"/>
            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Procesar</button>
                
                </td>
        </tr>
       </table>

    </form></p>
  </div>

</div>



