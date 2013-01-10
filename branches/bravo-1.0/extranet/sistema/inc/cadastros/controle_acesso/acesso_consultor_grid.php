<?php
	
	require('acesso_consultor_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_acesso_prestador ACESSO_CONSULTOR');
	$paging->where('ACESSO_CONSULTOR.CO_PRESTADOR = "'.$searchfor.'" OR PESSOA_FISICA.CPF_PESSOA_FISICA LIKE "%'.$searchfor.'%"');
	$paging->labels('C&oacute;digo,Data Cadastro,Hora Entrada,Hora Sa&iacute;da,Cart&atilde;o,Prestador de Servi&ccedil;o');
	$paging->fields('ACESSO_CONSULTOR.CO_ACESSO_PRESTADOR,DT_CADAS,HR_ENTRADA,HR_SAIDA,NU_CARTAO_IDENTIFICACAO,NOME_PESSOA');
	$paging->cols_width('60');
	$paging->rowsperpage(15);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
