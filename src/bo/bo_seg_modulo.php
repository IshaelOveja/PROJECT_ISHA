<?php 
require_once(u_src()."dao/dao_seg_modulo.php");
class bo_seg_modulo { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_seg_modulo();
    }
    public function control(seg_modulo $obj,$opc){
       if($opc=="I"){
           return $this->dao->insertar($obj);
        }else{
          return $this->dao->modificar($obj);
        }
    }
    public function eliminar($cc_modulo){
       return $this->dao->eliminar($cc_modulo);
    }
     public function listarId($cc_modulo){
         $sql="SELECT 
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
		cfl_vigencia,
           FROM seg_modulo
          WHERE cc_modulo='".$cc_modulo."'";
         return $this->dao->consulta($sql);
       }
     public function listarPadre(){
         $sql="select mod_id1, mod_id2,mod_id3, mod_nombre
				from seg_modulo
				where mod_id2='00' 
				and mod_id3='00'
				and mod_nivel='1'
				and mod_estado='1'
				order by mod_orden";
         return $this->dao->consulta($sql);
       }
	   public function listarHijo($padre){
         $sql="select mod_id1,mod_id2,mod_id3, mod_nombre
				from seg_modulo
				where mod_id1='".$padre."' 
				and mod_nivel='2'
				and mod_estado='1'
				order by mod_orden";
				//echo $sql;
         return $this->dao->consulta($sql);
       }
      public function listarNieto($mod_id1, $mod_id2, $cc_perfil){
         $sql="SELECT concat(a.mod_id1,'',a.mod_id2,'',a.mod_id3) as cc_modulo, 
					a.mod_nombre, 
					a.mod_nivel, 
					a.mod_carpeta, 
					a.mod_url, 
					a.mod_img, 
					a.mod_js, 
					a.mod_estado, 
					a.mod_orden, 
					a.mod_ico, 
					a.mod_tipo, 
					a.mod_tipo_user,
					(SELECT COUNT(b.cc_modulo) FROM seg_modulo_perfil b WHERE concat(a.mod_id1,a.mod_id2, a.mod_id3)=b.cc_modulo AND b.cc_perfil='".$cc_perfil."') AS n
				
					FROM seg_modulo a 
					WHERE a.mod_id1='".$mod_id1."'  
					and a.mod_id2='".$mod_id2."'  
					AND a.mod_nivel='3'
					and a.mod_estado = '1'
					ORDER by a.mod_orden ";
				//echo $sql;
         return $this->dao->consulta($sql);
       }
	  
       public function listarModuloDefecto(){/*ok*/
           $sql="select concat(A.mod_id1,A.mod_id2,A.MOD_ID3) as cc_modulo,
				(SELECT C.MOD_NOMBRE FROM seg_modulo C WHERE C.mod_id1=A.mod_id1  AND C.mod_nivel='1') AS mod_nombre1
				,(SELECT B.MOD_NOMBRE FROM seg_modulo B WHERE B.mod_id1=A.mod_id1 AND B.mod_id2=A.mod_id2 AND B.mod_nivel='2') AS mod_nombre2,
				A.mod_nombre
				from seg_modulo A 
				WHERE A.mod_nivel='3'
				ORDER BY A.mod_id1,A.mod_id2,A.mod_id3";
           return $this->dao->consulta($sql);
       }
	   
	  public function listar_tablas(){
		return $this->dao->listar_tablas();
	}
	public function listar_campo($tabla){
		return $this->dao->listar_campo($tabla);
	}
	
	public function __destruct(){
          unset($this->dao);
	}
}
?>