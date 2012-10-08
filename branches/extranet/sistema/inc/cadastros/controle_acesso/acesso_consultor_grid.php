<?php
	
	require('acesso_consultor_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_acesso_consultor ACESSO_CONSULTOR');
	$paging->where('ACESSO_CONSULTOR.CO_CONSULTOR = "'.$searchfor.'" OR PESSOA_FISICA.CPF_PESSOA_FISICA LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Data Acesso,Hora Entrada,Hora Saída,Cartão,Consultor');
	$paging->fields('ACESSO_CONSULTOR.CO_ACESSO_CONSULTOR,DT_CADAS,DT_ACESSO_CONSULTOR,HR_ENTRADA,HR_SAIDA,NU_CARTAO_IDENTIFICACAO,NOME_PESSOA');
	$paging->cols_width('60,110,90,85,70,60');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
