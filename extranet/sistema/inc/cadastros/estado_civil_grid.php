<?php
	
	require('estado_civil_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_estado_civil');
	$paging->where('CO_ESTADO_CIVIL = "'.$searchfor.'" OR NO_ESTADO_CIVIL LIKE "%'.$searchfor.'%" OR DS_ESTADO_CIVIL LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_ESTADO_CIVIL,DT_CADAS,NO_ESTADO_CIVIL,DS_ESTADO_CIVIL');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
