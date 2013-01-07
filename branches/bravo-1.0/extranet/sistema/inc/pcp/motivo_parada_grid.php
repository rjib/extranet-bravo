<?php
	
	require('motivo_parada_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_motivo_parada');
	$paging->where('CO_PCP_MOTIVO_PARADA = "'.$searchfor.'" OR NO_MOTIVO_PARADA LIKE "%'.$searchfor.'%" OR DS_MOTIVO_PARADA LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Nome,Descrição');
	$paging->fields('CO_PCP_MOTIVO_PARADA,DT_CADAS,NO_MOTIVO_PARADA,DS_MOTIVO_PARADA');
	$paging->cols_width('60,120,250');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
