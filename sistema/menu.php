<?php
$cc_perfil            = s_perfil();//s_usu_id();

//$padre             = s_mod_padre();
$data_m1           = $bo_mod_perfil->listar_modulo1_perfil($cc_perfil);

$i=0;
$active1="";
foreach($data_m1 as $row){
	if($row["mod_id1"]==s_mod_id1()){
		$active1=' class="active" ';
	}
	$mod_id1=$row["mod_id1"];
	//echo $active1;
?>
 <li <?php echo $active1; ?>>
    <a href="#"><i class="fa <?php echo $row["mod_ico"] ?>"></i> <span class="nav-label"><?php echo $row["mod_nombre"]?></span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
            <?php
				$data_lista=$bo_mod_perfil->listar_modulo2_usuario($cc_perfil, $row["mod_id1"]);
				$active2="";
				$ii=0;
				foreach($data_lista as $row1){
					if($row1["mod_id2"]==s_mod_id2()){
						$active2=' class="active" ';
						}
					$mod_id2=$row1["mod_id2"];
				?>
                <li <?php echo $active2; ?>><a href="#"><?php echo $row1["mod_nombre"]?><span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                    <?php
						$data_tres=$bo_mod_perfil->listar_modulo3_usuario($cc_perfil, $row["mod_id1"], $row1["mod_id2"]);
						$active3="";
						$iii=0;
						foreach($data_tres as $row2){
							if($row2["mod_id3"]==s_mod_id3()){
								$active3=' class="active" ';
							}
						?>
                        
                        <li <?php echo $active3; ?> ><a href="?codigo=<?php echo $row2["cc_codigo"]?>" ><?php echo $row2["mod_nombre"]?></a></li>
                        
						<?php 
						$active3="";
   						$iii++;
						} ?>
                    </ul>
                </li>
                <?php $active2="";
   					$ii++;
					} ?>
            </ul>
        </li> 
   <?php 
   $active1="";
   $i++;
   } ?>
   
   <!-- <li class="active">
            <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li class="active"><a href="#">Third Level <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li class="active"><a href="index.php">Third Level Item</a></li>
                    </ul>
                </li>
               
            </ul>
        </li> -->