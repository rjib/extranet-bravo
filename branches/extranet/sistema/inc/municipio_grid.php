<?php
	
	require('municipio_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_municipio MUNICIPIO');
	$paging->where('MUNICIPIO.CO_MUNICIPIO = "'.$searchfor.'" OR UF.DS_UF LIKE "%'.$searchfor.'%" OR MUNICIPIO.NO_MUNICIPIO LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Estado,Cidade');
	$paging->fields('MUNICIPIO.CO_MUNICIPIO,UF.DS_UF,MUNICIPIO.NO_MUNICIPIO');
	$paging->cols_width('80,100');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
