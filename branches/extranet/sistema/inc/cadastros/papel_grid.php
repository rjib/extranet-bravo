<?php
	
	require('papel_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_papel');
	$paging->where('CO_PAPEL= "'.$searchfor.'" OR NO_PAPEL LIKE "%'.$searchfor.'%" OR DS_PAPEL LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_PAPEL,DT_CADAS,NO_PAPEL,DS_PAPEL');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
