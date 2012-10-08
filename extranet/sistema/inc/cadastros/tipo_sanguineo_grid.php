<?php
	
	require('tipo_sanguineo_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_tipo_sanguineo');
	$paging->where('CO_TIPO_SANGUINEO = "'.$searchfor.'" OR NO_TIPO_SANGUINEO LIKE "%'.$searchfor.'%" OR DS_TIPO_SANGUINEO LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_TIPO_SANGUINEO,DT_CADAS,NO_TIPO_SANGUINEO,DS_TIPO_SANGUINEO');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
