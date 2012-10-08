<?php
	
	require('nivel_formacao_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_nivel_formacao');
	$paging->where('CO_NIVEL_FORMACAO = "'.$searchfor.'" OR NO_NIVEL_FORMACAO LIKE "%'.$searchfor.'%" OR DS_NIVEL_FORMACAO LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_NIVEL_FORMACAO,DT_CADAS,NO_NIVEL_FORMACAO,DS_NIVEL_FORMACAO');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
