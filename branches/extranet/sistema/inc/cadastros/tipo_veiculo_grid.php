<?php
	
	require('tipo_veiculo_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_tipo_veiculo');
	$paging->where('CO_TIPO_VEICULO = "'.$searchfor.'" OR NO_TIPO_VEICULO LIKE "%'.$searchfor.'%" OR DS_TIPO_VEICULO LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_TIPO_VEICULO,DT_CADAS,NO_TIPO_VEICULO,DS_TIPO_VEICULO');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
