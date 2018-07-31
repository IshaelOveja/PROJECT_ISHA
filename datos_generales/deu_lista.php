<?php
require_once("../util/seguridad.php");
require_once("../util/util.php");
require_once(u_src()."bo/bo_fin_estado_cuenta.php"); 
s_validar_pagina();

$bo_cuenta= new bo_fin_estado_cuenta();

$ent_cuenta= new fin_estado_cuenta();

$cc_persona    = $_REQUEST["cc_persona"];

$ent_cuenta->setCc_persona($cc_persona);
//$ent_cuenta->setCt_tipo("D");

$dat_cuenta=$bo_cuenta->EstadoCuenta($cc_persona);
?>
<table class="table table-bordered">
      <caption class="text-right">
          <a href="javascript:fn_controlRegistro('<?php echo $cc_persona ?>','','I');" class="btn btn-primary btn-sm active" role="button"><span class="glyphicon glyphicon-plus-sign"></span> NUEVO</a>

      </caption>
      <thead>
            <tr class="active">
                <th >#</th>
                <th >Fecha</th>
                <th >Documento</th>
                <th >Glosa</th>
                <th >Deber</th>
				<th >Haber</th>
                <th >OP</th>
            </tr>
        </thead>
        <tbody  >
		<?php $i=1;
        $sal=0;
        foreach($dat_cuenta as $row){
            $sal+=$row["egreso"]+$row["ingreso"];
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row["ct_fecha"] ?></td>
                 <td>
                 <a href="javascript:fn_verRecibo('<?php echo $row["cc_caja"] ?>');" role="button"><?php echo $row["recibo"]?></a>
                 
                   </td>
                <td ><?php echo $row["cc_descripcion"];?></td>
                <td class="text-right"><?php echo $row["egreso"] ?></td>
                <td class="text-right"><?php echo $row["ingreso"];?></td>
                <td class="text-center" >
                <?php if($row["tipo"]=="P"){ ?>
                <a href="javascript:fn_controlRegistro('','<?php echo $row["cc_estadocuenta"] ?>','U');" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                <?php }?>
</td>
                
            </tr>
             <?php
                $i++;
             }
             ?>
             <tr>
             <th colspan="4" class="text-right">Saldo :</th>
             <th colspan="2" class="text-center"><?php echo decimal($sal,2) ?></th>
             </tr>
        </tbody>
     </table>
        

