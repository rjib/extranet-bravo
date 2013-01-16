<?php
	
	require('recurso_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_recurso');
	$paging->where('CO_PCP_RECURSO = "'.$searchfor.'" OR NO_RECURSO LIKE "%'.$searchfor.'%" AND FL_DELET IS NULL');
	$paging->labels('C�digo,Nome,Descri��o');
	$paging->fields('CO_PCP_RECURSO,CO_RECURSO,NO_RECURSO');
	$paging->cols_width('60,120');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
