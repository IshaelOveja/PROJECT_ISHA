<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_general.php"); 
require_once(u_src()."bo/bo_seg_perfil.php"); 
s_validar_pagina();
$bo_general         = new bo_general();
$bo_perfil   = new bo_seg_perfil();

$data_perfil = $bo_perfil->listarContar();
$dat_url=$bo_general->url($codigo);
foreach($dat_url as $url){
	$urlc=$url["ruta"];
}
$data_perfil = $bo_perfil->listarContar();
echo tituloLik($urlc);

?>
<div class="row">
    <div class="col-12">
    
            <div class="row">
                    <div class="col-md-3">
                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Perfil</div>
                      <ul class="list-group">
                       <?php

                       $n=1;
                       foreach($data_perfil as $row){
                           
                        ?>
                       <li class="list-group-item panel panel-default">
                                                     
                               <div class="dropdown">
                                    <a href="javascript:fn_asignaModulo('<?php echo $row["cc_perfil"] ?>');">
                                    
                                       <?php echo $row["ct_perfil"] ?> 
                                       <span class="label label-info pull-right"><?php echo $row["cantidad"] ?></span>
                                       
                                    </a>
                                    
                                </div> 
                       </li>
                       <?php
                            $n++;
                       }
                       ?>
                       
                      </ul>
                    </div>
                </div>
                    <div class="col-md-9" id="asigPerfil"></div>
               </div>
            </div>
        </div>

        

<div class="row hide">
      <form id="frmAsigPerfil" action="index.php"  name="frmAsigPerfil" method="post">
        <input type="text"  class="input-sm" name="cc_perfilb" id="cc_perfilb"/>
      </form>

</div>
