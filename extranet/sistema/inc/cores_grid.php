<?php
	
	require('cores_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_cor COR');
	$paging->where('COR.CO_COR = "'.$searchfor.'" OR COR.DS_COR LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Descrição,Recno');
	$paging->fields('COR.CO_COR,COR.DS_COR,COR.CO_RECNO');
	$paging->cols_width('80,300');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
