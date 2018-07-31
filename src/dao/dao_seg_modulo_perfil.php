<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/seg_modulo_perfil.php");
class dao_seg_modulo_perfil { 
   private $conecta;
    function __construct(){
       $this->conecta = new Conecta();
    }
   public function consulta($sql){
       return $this->conecta->ArrayLista($sql);
    }
    public function totalPagina($sql){
       return $this->conecta->sql_total($sql);
    }
    public function control(seg_modulo_perfil $obj){
		$sql="INSERT INTO seg_modulo_perfil(
				cc_modulo,
				cc_perfil,
				cc_usuario_audit,
				df_log,
				ct_ip
              )VALUES(
			  	 '".$obj->getCc_modulo()."',
				  '".$obj->getCc_perfil()."',
				  '".$obj->getCc_usuario_audit()."',
				  NOW(),
				  '".$obj->getCt_ip()."'
				  
              )";
		//echo $sql;
		return $this->conecta->sql_query($sql);
	}
    
	public function eliminar($cc_perfil){
         $sql="DELETE FROM  seg_modulo_perfil
	     WHERE cc_perfil='".$cc_perfil."'";
          return $this->conecta->sql_query($sql);
	}
        
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>