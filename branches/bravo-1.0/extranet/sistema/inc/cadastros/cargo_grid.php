<?php
	
	require('cargo_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_cargo');
	$paging->where('CO_CARGO = "'.$searchfor.'" OR NO_CARGO LIKE "%'.$searchfor.'%" OR DS_CARGO LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_CARGO,DT_CADAS,NO_CARGO,DS_CARGO');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
