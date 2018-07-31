<?php
class SYQ_Paginacion{
	private $page;
	private $_total_pages;
	private $_records;
	private $_records_per_page;
	private $_selectable_pages;
	private $_padding;
        private $_ordenar;
    function __construct(){
      
        $this->selectable_pages(11);
        $this->records_per_page(10);
        $this->padding();
	$this->pagina_actual(1);
        $this->_ordenar="";
    }
    public function pagina_actual($page){
        $this->page = (int)$page;
    }
    public function calcular_pagina($page){
        $this->page = (int)$page;
        if ($this->page < 1) $this->page = 1;
		$this->_total_pages = ceil($this->_records / $this->_records_per_page);
        if ($this->_total_pages > 0) {
            if ($this->page > $this->_total_pages) $this->page = $this->_total_pages;
            elseif ($this->page < 1) $this->page = 1;
        }
        return $this->page;
    }
    public function setOrdenar($orden){
         $this->_ordenar = $orden;
    }
    public function getOrdenar(){
         return $this->_ordenar;
    }
    public function padding($enabled = true){
        $this->_padding = $enabled;
    }
    public function records($records){
        $this->_records = (int)$records;
    }
    public function records_per_page($records_per_page){
       
        $this->_records_per_page = (int)$records_per_page;
    }
    public function selectable_pages($selectable_pages){
        $this->_selectable_pages = (int)$selectable_pages;
    }
	
    public function getRecords(){
       	return  $this->_records; 
    }
    public function getRecords_per_page(){
        return  $this->_records_per_page ;
    }
    public function getSelectable_pages(){
        return $this->_selectable_pages;
    }
    public function getPagina(){
		return $this->page;
    }
    public function render(){
	$pagina = "";
	$mostrar ="'".$this->_records_per_page."'";
     
        if ($this->_total_pages <= 1) return ;
        //$output = '<div class="pagination">';
        $output = '<nav> <ul class="pagination pagination-sm">';
        if ($this->_total_pages > $this->_selectable_pages) {
			$pagina=($this->page - 1);
			$pagina= "'".$pagina."'";
            $output .= '<li'. ($this->page == 1 ? ' class="disabled" ' : '').'><a href="' .($this->page == 1 ? 'javascript:void(0)' : 'javascript:fn_paginacion('.$pagina.','.$mostrar.')') .' aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        if ($this->_total_pages <= $this->_selectable_pages) {
            for ($i = 1; $i <= $this->_total_pages; $i++) {
				$pagina= "'".$i."'";
                $output .= '<li' .($this->page == $i ? ' class="active"' : '') . '><a href="javascript:fn_paginacion('.$pagina.','.$mostrar .')">' .($this->_padding ? str_pad($i, strlen($this->_total_pages), '0', STR_PAD_LEFT) : $i) .'</a></li>';
            }
        } else {
            $output .= '<li' .($this->page == 1 ? ' class="active"' : '') . '><a href="javascript:fn_paginacion(1,'.$mostrar.')">' .($this->_padding ? str_pad('1', strlen($this->_total_pages), '0', STR_PAD_LEFT) : '1') .'</a></li>';
            $adjacent = floor(($this->_selectable_pages - 3) / 2);
            $adjacent = ($adjacent == 0 ? 1 : $adjacent);
            $scroll_from = $this->_selectable_pages - $adjacent;
            $starting_page = 2;
            if ($this->page >= $scroll_from) {
                $starting_page = $this->page - $adjacent;
                if ($this->_total_pages - $starting_page < ($this->_selectable_pages - 2)) {
                    $starting_page -= ($this->_selectable_pages - 2) - ($this->_total_pages - $starting_page);
                }
                $output .= '<li><span>&hellip;</span></li>';
            }
            $ending_page = $starting_page + $this->_selectable_pages - 3;
            if ($ending_page > $this->_total_pages - 1) $ending_page = $this->_total_pages - 1;
            for ($i = $starting_page; $i <= $ending_page; $i++) {
				$pagina= "'".$i."'";
                $output .= '<li '. ($this->page == $i ? ' class="active" ' : '').'><a href="javascript:fn_paginacion('.$pagina.','.$mostrar.')">' .($this->_padding ? str_pad($i, strlen($this->_total_pages), '0', STR_PAD_LEFT) : $i) .'</a></li>';
            }
            if ($this->_total_pages - $ending_page > 1) $output .= '<li><span>&hellip;</span></li>';
			$pagina= "'".$this->_total_pages."'";
            $output .= '<li '. ($this->page == $this->_total_pages ? ' class="active" ' : '').'><a href="javascript:fn_paginacion('.$pagina.','.$mostrar.')">' .$this->_total_pages .'</a></li>';
            if ($this->_total_pages > $this->_selectable_pages) {
				$pagina=($this->page + 1);
				$pagina="'".$pagina."'";
                $output .= '<li'. ($this->page == $this->_total_pages ? ' class="disabled" ' : '').'><a href="' .($this->page == $this->_total_pages ? 'javascript:void(0)' : 'javascript:fn_paginacion('.$pagina.','.$mostrar.')') .'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
		$output .= '</ul></nav>';
        return $output;
    }
}
?>
