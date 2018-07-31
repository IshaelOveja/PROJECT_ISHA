<?php 
require_once(u_src()."dao/dao_seg_usuario.php");
require_once(u_src()."dao/SYQ_Paginacion.php");
class bo_seg_usuario  extends SYQ_Paginacion { 
    private $dao; 
    function __construct(){
       $this->dao = new dao_seg_usuario();
    }
    public function control(seg_usuario $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_usuario){
       return $this->dao->eliminar($cc_usuario);
    }
     public function listarId($cc_usuario){
         $sql="SELECT 
		cc_usuario,
		cc_user,
		cc_perfil,
		ct_clave,
		nn_tiempo_sesion,
		cp_nivel,
		cfl_acceso,
		df_caduca,
		cfl_clave_cambia,
		cc_usuario_audit,
		df_log,
		ct_ip
           FROM seg_usuario
          WHERE cc_usuario='".$cc_usuario."'";
		  //echo $sql;
         return $this->dao->consulta($sql);
       }
	   
     public function listar(seg_usuario $obj){
		 $pagina = $this->getPagina();
         $por_pagina= $this->getSelectable_pages();
         $sql="SELECT 
                SQL_CALC_FOUND_ROWS
                nombre,
				cc_usuario,
				cc_user,
				cc_perfil,
				ct_clave,
				nn_tiempo_sesion,
				cp_nivel,
				cfl_acceso,
				df_caduca,
				cfl_clave_cambia,
                (select x.ct_perfil from seg_perfil x where x.cc_perfil=vt_persona_usuario.cc_perfil) as ct_perfil
			   FROM vt_persona_usuario
			  WHERE lower(nombre) like lower('%".u_ascui($obj->getNombre())."%')";
		  //echo $sql;
         if(strlen($obj->getCc_perfil())>0){
             $sql.=" and cc_perfil='".$obj->getCc_perfil()."' "; 
         }
         $sql.=" order by nombre ";
		 
        $sql.=" LIMIT ". $por_pagina. " offset " . (($pagina - 1) * $por_pagina) ;
		 //echo $sql;
         $data = $this->dao->consulta($sql);
         $total = $this->dao->total_pagina();
         $this->records($total);
         $this->calcular_pagina($pagina);
         
         return $data;
		 //echo $sql;
       }
	   
       public function cambiarClave(seg_usuario $obj){
		return $this->dao->cambiarClave($obj);
		}
         public function cambiarClavePrimero(seg_usuario $obj){
             return $this->dao->cambiarClavePrimero($obj);
         }
        public function mostrarUsuario($ct_user){
            $sql="SELECT cc_usuario,
				 nombre,
				 cc_user,
				 nn_tiempo_sesion
					 FROM vt_persona_usuario
                WHERE LOWER(cc_user) LIKE LOWER('%".u_ascui($cc_user)."%')
                ORDER BY cc_user ";
				//echo $sql;
		
		return $this->dao->consulta($sql);
        }
        public function validarUsuario($cc_user){
            $sql="SELECT cc_usuario,
				  nombre,
				  cc_user,
				  nn_tiempo_sesion
				FROM vt_persona_usuario
                where LOWER(cc_user) = LOWER('".u_ascui($cc_user)."')
                ORDER BY cc_user ";
            
		
		return $this->dao->consulta($sql);
        }
        public function validarClaveAnte(seg_usuario $obj){
            $sql="SELECT cc_usuario,
					nombre,
					cc_user,
					nn_tiempo_sesion
				FROM vt_persona_usuario
                where LOWER(cc_user) = LOWER('".u_ascui($obj->getCc_user())."')
                AND ct_clave='".sha1($obj->getCt_clave())."'
                ORDER BY cc_user ";
            
            
		
		return $this->dao->consulta($sql);
        }
        public function validar($cc_user,$ct_clave){
		$data=array();
		$returna=array();
		$sql="SELECT DISTINCT
				   a.cc_usuario,
				   a.nombre,
				   a.cc_user,
				   a.nn_tiempo_sesion,
				   a.ct_clave,
				   a.cc_perfil,
				   a.cfl_clave_cambia
				   FROM vt_persona_usuario a  
					WHERE a.cfl_acceso='1'
					AND a.cc_user='".$cc_user."'
					AND a.flag='1'";
		
		$data=$this->dao->consulta($sql);
		if(count($data)==1){
			foreach($data as $row){
                                
				if($row["ct_clave"]===$ct_clave){
					$returna[]="S";
					$returna[]=$row["cc_usuario"];
					$returna[]=$row["nombre"];
					$returna[]=$row["cc_user"];
					$returna[]=$row["nn_tiempo_sesion"];
					$returna[]=$row["cc_perfil"];
					$returna[]=$row["cfl_clave_cambia"];
                                        
				}else{
					$returna[]="N";
				}
			}
		}else{
			$returna[]="N";
		}
		//echo $sql;
		return $returna;
	}
	public function __destruct(){
          unset($this->dao);
	}
}
?>