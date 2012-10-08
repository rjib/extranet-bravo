<?php
	
	require('bairro_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_bairro BAIRRO');
	$paging->where('CO_BAIRRO= "'.$searchfor.'" OR BAIRRO.NO_BAIRRO = "'.$searchfor.'" OR BAIRRO.NO_BAIRRO LIKE "%'.$searchfor.'%"');
	$paging->labels('Codigo,Estado,Cidade,Bairro');
	$paging->fields('CO_BAIRRO,UF.DS_UF,MUNICIPIO.NO_MUNICIPIO,BAIRRO.NO_BAIRRO');
	$paging->cols_width('60,120,150');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
