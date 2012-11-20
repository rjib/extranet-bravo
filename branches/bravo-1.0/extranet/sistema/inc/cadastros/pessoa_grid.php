<?php
	
	require('pessoa_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pessoa PESSOA');
	$paging->where('PESSOA.CO_PESSOA = "'.$searchfor.'" OR PESSOA.NO_PESSOA LIKE "%'.$searchfor.'%"');
	$paging->labels('C&oacute;digo,Data Cadastro,Nome,Tipo,CPF/CNPJ');
	$paging->fields('CO_PESSOA,DT_CADAS,NO_PESSOA,TP_PESSOA,CPF_CNPJ_PESSOA');
	$paging->cols_width('60,120,600,70,150');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
