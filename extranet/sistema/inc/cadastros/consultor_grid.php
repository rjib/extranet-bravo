<?php
	
	require('consultor_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_consultor CONSULTOR');
	$paging->where('CONSULTOR.CO_PRESTADOR = "'.$searchfor.'" OR PESSOA_FISICA.CPF_PESSOA_FISICA LIKE "%'.$searchfor.'%" OR PESSOA.NO_PESSOA LIKE "%'.$searchfor.'%"');
	$paging->labels('C�digo,Data Cadastro,CPF,Nome');
	$paging->fields('CONSULTOR.CO_PRESTADOR,DT_CADAS,CPF_PESSOA_FISICA,PESSOA.NO_PESSOA');
	$paging->cols_width('60,120,120');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
