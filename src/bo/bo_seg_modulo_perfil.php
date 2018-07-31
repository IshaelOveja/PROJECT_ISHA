<?php 
require_once(u_src()."dao/dao_seg_modulo_perfil.php");
class bo_seg_modulo_perfil { 
	private $dao; 
    function __construct(){
       $this->dao = new dao_seg_modulo_perfil();
    }
    public function control(seg_modulo_perfil $obj){
      
        return $this->dao->control($obj);
        
    }
    public function eliminar($cc_modulo){
       return $this->dao->eliminar($cc_modulo);
    }
	
	public function listar_modulo1_perfil($cc_perfil){
		$sql="select m.mod_orden,
		SUBSTRING(p.cc_modulo,1,2) AS mod_id1,
		m.mod_nivel,
		m.mod_nombre, 
		m.mod_ico
		from seg_modulo m inner join seg_modulo_perfil p
		ON rtrim(m.mod_id1)=SUBSTRING(p.cc_modulo,1,2)
		WHERE p.cc_perfil='".$cc_perfil."' 
		AND m.mod_nivel='1'
		and m.mod_estado='1' 
		and m.mod_tipo='priv'
		GROUP BY m.mod_orden,m.mod_nivel,m.mod_nombre, m.mod_ico
		ORDER BY m.mod_orden ASC, m.mod_nombre";
		//echo $sql;
		 return $this->dao->consulta($sql);
		}
	public function listar_modulo2_usuario($cc_perfil, $mod_id1){ /**ok adm*/
		
		$sql="select 
			rtrim(m.mod_id1) AS mod_id1,
			rtrim(m.mod_id2) AS mod_id2,
			m.mod_nivel,
			m.mod_nombre,
			m.MOD_ORDEN
			from seg_modulo_perfil p INNER JOIN seg_modulo m
			on SUBSTRING(p.cc_modulo,1,4)=concat(m.mod_id1,'',m.mod_id2)
			where p.cc_perfil='".$cc_perfil."' 
			and m.mod_estado='1'
			AND m.mod_nivel='2'
			AND m.mod_id1='".$mod_id1."'
			GROUP BY m.mod_orden,m.mod_nivel,m.mod_nombre
			ORDER BY m.mod_orden ASC";
	//echo $sql;
		return $this->dao->consulta($sql);
	}
	public function listar_modulo3_usuario($cc_perfil, $mod_id1, $mod_id2){
		
		$sql="select concat(rtrim(m.mod_id1),'',rtrim(m.mod_id2),'',rtrim(m.mod_id3)) AS cc_codigo,
		m.mod_nivel,	
		rtrim(m.mod_id3) as mod_id3,
		m.mod_nombre,
		m.mod_orden
		from seg_modulo_perfil p INNER JOIN seg_modulo m
		on p.cc_modulo=concat(m.mod_id1,'',m.mod_id2,'',m.mod_id3)
		where p.cc_perfil='".$cc_perfil."' 
		and m.mod_estado='1'
		AND m.mod_nivel='3'
		AND m.mod_id1='".$mod_id1."'
		AND m.mod_id2='".$mod_id2."'
		ORDER BY m.mod_orden ASC, m.mod_nombre";
		//echo $sql;
		return $this->dao->consulta($sql);
	}
	
	
	public function asignado_modulo($codigo){/**ok admin*/
		$sql="select mod_id1, 
				mod_id2, 
				mod_id3, 
				mod_nombre, 
				mod_nivel, 
				mod_carpeta, 
				concat(mod_carpeta,'js/',mod_js) as js,
				concat(mod_carpeta,'',mod_url) as url,
				mod_url, 
				mod_img, 
				mod_js, 
				mod_estado, 
				mod_orden,
				mod_ico,
				mod_tipo
				from seg_modulo
				where concat(mod_id1,'',mod_id2,'',mod_id3)='".$codigo."'";
				//echo $sql;
		return $this->dao->consulta($sql);
	}
	
	
     public function listarId($cc_modulo){
         $sql="SELECT 
		cc_modulo,
		cc_perfil,
		cc_usuario_audit,
		df_log,
		ct_ip
           FROM seg_modulo_perfil
          WHERE cc_modulo='".$cc_modulo."'";
         return $this->dao->consulta($sql);
       }
     public function listar(seg_modulo_perfil $obj){
         $sql="SELECT 
		cc_modulo,
		cc_perfil,
		cc_usuario_audit,
		df_log,
		ct_ip
           FROM seg_modulo_perfil
          WHERE cc_modulo='".$obj->getCc_modulo()."'";
         return $this->dao->consulta($sql);
       }
	  public function listarIdPerfil($cc_perfil){
         $sql="SELECT 
		cc_modulo,
		SUBSTRING(cc_modulo, 1,2) as mod_id1,
		SUBSTRING(cc_modulo, 3,2) as mod_id2,
		SUBSTRING(cc_modulo, 5,2) as mod_id3,
		cc_perfil,
		cc_usuario_audit,
		df_log,
		ct_ip
           FROM seg_modulo_perfil
          WHERE cc_perfil='".$cc_perfil."'";
         //echo $sql;
		 return $this->dao->consulta($sql);
		 
       }
	public function __destruct(){
          unset($this->dao);
	}
}
?>