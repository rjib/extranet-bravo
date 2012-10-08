<?php
	
	require('uf_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_uf');
	$paging->where('CO_UF = "'.$searchfor.'" OR SG_UF LIKE "%'.$searchfor.'%" OR DS_UF LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Sigla,Descrição');
	$paging->fields('CO_UF,SG_UF,DS_UF');
	$paging->cols_width('80,100');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
