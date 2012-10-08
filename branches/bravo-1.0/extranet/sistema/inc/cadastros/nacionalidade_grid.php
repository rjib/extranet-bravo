<?php
	
	require('nacionalidade_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_nacionalidade');
	$paging->where('CO_NACIONALIDADE= "'.$searchfor.'" OR NO_NACIONALIDADE LIKE "%'.$searchfor.'%" OR DS_NACIONALIDADE LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_NACIONALIDADE,DT_CADAS,NO_NACIONALIDADE,DS_NACIONALIDADE');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
