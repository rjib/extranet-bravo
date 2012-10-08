<?php
	
	require('cep_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_cep CEP');
	$paging->where('CO_CEP= "'.$searchfor.'" OR CEP.NU_CEP LIKE "%'.$searchfor.'%" OR CEP.NO_LOGRADOURO LIKE "%'.$searchfor.'%"');
	$paging->labels('Codigo,Estado,Cidade,Bairro,CEP,Logradouro');
	$paging->fields('CO_CEP,UF.DS_UF,MUNICIPIO.NO_MUNICIPIO,BAIRRO.NO_BAIRRO,CEP.NU_CEP,CEP.NO_LOGRADOURO');
	$paging->cols_width('60,120,150,250,70');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
