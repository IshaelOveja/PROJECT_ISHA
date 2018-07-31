<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/seg_usuario.php");
class dao_seg_usuario { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
     public function total_pagina(){
		return $this->conecta->total_pagina();
   }
	public function insertar(seg_usuario $obj){
         $sql="INSERT INTO seg_usuario(
                cc_usuario,
                cc_user,
                cc_perfil,
                nn_tiempo_sesion,
                cp_nivel,
                cfl_acceso,
                cfl_clave_cambia,
                ct_clave,
                df_caduca,
                cc_usuario_audit,
                df_log,
                ct_ip
              )VALUES(
                  '".$obj->getCc_usuario()."',
                 '".$obj->getCc_user()."',
                 '".$obj->getCc_perfil()."',
                 '".$obj->getNn_tiempo_sesion()."',
                 '".$obj->getCp_nivel()."',
                 '".$obj->getCfl_acceso()."',";
               if(strlen($obj->getCt_clave())>0){      
                 $sql.="'0',
                 '".sha1($obj->getCt_clave())."',
                 DATE_ADD(current_timestamp,INTERVAL 1 year),";
               }else{
                  $sql.="'0',
                  null,
                  null,";
               }
               
                $sql.=" '".$obj->getCc_usuario_audit()."',
                  current_timestamp,
                 '".$obj->getCt_ip()."'
              )";
		 //echo $sql;
          return $this->conecta->sql_query($sql);
	}
	public function modificar(seg_usuario $obj){
         $sql="UPDATE seg_usuario set 
               cc_user='".$obj->getCc_user()."',
               cc_perfil='".$obj->getCc_perfil()."',
               nn_tiempo_sesion='".$obj->getNn_tiempo_sesion()."',
               cp_nivel='".$obj->getCp_nivel()."',
               cfl_acceso='".$obj->getCfl_acceso()."',
               cc_usuario_audit='".$obj->getCc_usuario_audit()."',
               df_log=current_timestamp,
               ct_ip='".$obj->getCt_ip()."' ";
          if(strlen($obj->getCt_clave())>0){
                $sql.=",ct_clave='".sha1($obj->getCt_clave())."',
                df_caduca=DATE_ADD(current_timestamp,INTERVAL 1 year)" ;
          }
	  $sql.="WHERE cc_usuario='".$obj->getCc_usuario()."'";
          return $this->conecta->sql_query($sql);
	}
         public function cambiarClavePrimero(seg_usuario $obj){

		$sql="UPDATE seg_usuario  SET 
                            ct_clave='".sha1($obj->getCt_clave())."',
                            df_caduca=DATE_ADD(current_timestamp,INTERVAL 1 year),
                            cfl_clave_cambia='1',
                            cc_usuario_audit='".$obj->getCc_usuario_audit()."',
                            df_log=current_timestamp,
                            cfl_clave_cambia='1',
                            ct_ip='".$obj->getCt_ip()."' 
                     WHERE cc_usuario='".$obj->getCc_usuario()."'";
                
                
		$rs=$this->conecta->sql_query($sql);
		
		return $rs;
	}
        public function cambiarClave(seg_usuario $obj){

		$sql="UPDATE seg_usuario  SET 
                            ct_clave='".sha1($obj->getCt_clave())."',
                            df_caduca=DATE_ADD(current_timestamp,INTERVAL 1 year),
                            cfl_clave_cambia='1',
                            cc_usuario_audit='".$obj->getCc_usuario_audit()."',
                            df_log=current_timestamp,
                            ct_ip='".$obj->getCt_ip()."' 
                     WHERE cc_usuario='".$obj->getCc_usuario()."'";
                
                
		$rs=$this->conecta->sql_query($sql);
		
		return $rs;
	}
	public function eliminar($cc_usuario){
         $sql="DELETE FROM  seg_usuario
	     WHERE cc_usuario='".$cc_usuario."'";
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>