<?php
	
	require('cartao_identificacao_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_cartao_identificacao');
	$paging->where('CO_CARTAO_IDENTIFICACAO = "'.$searchfor.'" OR NU_CARTAO_IDENTIFICACAO LIKE "%'.$searchfor.'%" OR DS_CARTAO_IDENTIFICACAO LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Número,Descrição');
	$paging->fields('CO_CARTAO_IDENTIFICACAO,DT_CADAS,NU_CARTAO_IDENTIFICACAO,DS_CARTAO_IDENTIFICACAO');
	$paging->cols_width('60,120,70');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
