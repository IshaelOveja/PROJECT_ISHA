<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/seg_modulo.php");
class dao_seg_modulo { 
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
	public function insertar(seg_modulo $obj){
         $sql="INSERT INTO seg_modulo(
                cc_modulo,
                ct_modulo,
                nn_nivel,
                cc_padre,
                ct_carpeta,
                ct_url,
                ct_img,
                ct_js,
                nn_orden,
                cfl_acceso,
                cfl_vigencia
              )VALUES(
                  fc_correlativo('seg_modulo','',''),
                 '".$obj->getCt_modulo()."',
                 '".$obj->getNn_nivel()."',
                 '".$obj->getCc_padre()."',
                 '".$obj->getCt_carpeta()."',
                 '".$obj->getCt_url()."',
                 '".$obj->getCt_img()."',
                 '".$obj->getCt_js()."',
                 '".$obj->getNn_orden()."',
                 '".$obj->getCfl_acceso()."',
                 '".$obj->getCfl_vigencia()."'
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(seg_modulo $obj){
         $sql="UPDATE seg_modulo set 
               ct_modulo='".$obj->getCt_modulo()."',
               nn_nivel='".$obj->getNn_nivel()."',
               cc_padre='".$obj->getCc_padre()."',
               ct_carpeta='".$obj->getCt_carpeta()."',
               ct_url='".$obj->getCt_url()."',
               ct_img='".$obj->getCt_img()."',
               ct_js='".$obj->getCt_js()."',
               nn_orden='".$obj->getNn_orden()."',
               cfl_acceso='".$obj->getCfl_acceso()."',
               cfl_vigencia='".$obj->getCfl_vigencia()."',
	     WHERE cc_modulo='".$obj->getCc_modulo()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_modulo){
         $sql="DELETE FROM  seg_modulo
	     WHERE cc_modulo='".$cc_modulo."'";
          return $this->conecta->sql_query($sql);
	}
	
	
	
	public function listar_tablas(){
		return $this->conecta->sql_lista_tablas();
	}
	public function listar_campo($tabla){
		return $this->conecta->sql_lista_campo($tabla);
	}
	
	
	
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>