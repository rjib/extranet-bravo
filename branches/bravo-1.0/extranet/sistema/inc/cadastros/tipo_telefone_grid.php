<?php
	
	require('tipo_telefone_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_tipo_telefone');
	$paging->where('CO_TIPO_TELEFONE = "'.$searchfor.'" OR NO_TIPO_TELEFONE LIKE "%'.$searchfor.'%" OR DS_TIPO_TELEFONE LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_TIPO_TELEFONE,DT_CADAS,NO_TIPO_TELEFONE,DS_TIPO_TELEFONE');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
