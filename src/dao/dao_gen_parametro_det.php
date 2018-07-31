<?php 
require_once(u_src()."dao/Conecta.php");
require_once(u_src()."entidad/gen_parametro_det.php");
class dao_gen_parametro_det { 
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
	public function insertar(gen_parametro_det $obj){
         $sql="INSERT INTO gen_parametro_det(
                cc_par_det,
                cc_parametro,
                cc_codigo,
                ct_par_det,
                ct_par_det_corto,
                nn_orden,
                cfl_vigencia,
                cc_usuario_audit,
                df_log,
                ct_ip,
              )VALUES(
                  fc_correlativo('gen_parametro_det','',''),
                 '".$obj->getCc_parametro()."',
                 '".$obj->getCc_codigo()."',
                 '".$obj->getCt_par_det()."',
                 '".$obj->getCt_par_det_corto()."',
                 '".$obj->getNn_orden()."',
                 '".$obj->getCfl_vigencia()."',
                 '".$obj->getCc_usuario_audit()."',
                  current_timestamp,
                 '".$obj->getCt_ip()."',
              )";
          return $this->conecta->sql_query($sql);
	}
	public function modificar(gen_parametro_det $obj){
         $sql="UPDATE gen_parametro_det set 
               cc_parametro='".$obj->getCc_parametro()."',
               cc_codigo='".$obj->getCc_codigo()."',
               ct_par_det='".$obj->getCt_par_det()."',
               ct_par_det_corto='".$obj->getCt_par_det_corto()."',
               nn_orden='".$obj->getNn_orden()."',
               cfl_vigencia='".$obj->getCfl_vigencia()."',
               cc_usuario_audit='".$obj->getCc_usuario_audit()."',
               df_log=current_timestamp,
               ct_ip='".$obj->getCt_ip()."',
	     WHERE cc_par_det='".$obj->getCc_par_det()."'";
          return $this->conecta->sql_query($sql);
	}
	public function eliminar($cc_par_det){
         $sql="DELETE FROM  gen_parametro_det
	     WHERE cc_par_det='".$cc_par_det."'";
          return $this->conecta->sql_query($sql);
	}
	public function __destruct(){
         $this->conecta->cerrarCN();
          unset($this->conecta);
	}
}
?>