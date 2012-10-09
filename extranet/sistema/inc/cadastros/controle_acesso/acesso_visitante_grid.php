<?php
	
	require('acesso_visitante_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_acesso_visitante ACESSO_VISITANTE');
	$paging->where('ACESSO_VISITANTE.CO_PESSOA = "'.$searchfor.'" OR PESSOA_FISICA.CPF_PESSOA_FISICA LIKE "%'.$searchfor.'%" OR PESSOA_JURIDICA.CNPJ_PESSOA_JURIDICA LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,Data Acesso,Hora Entrada,Hora Saída,Cartão,Visitante');
	$paging->fields('ACESSO_VISITANTE.CO_ACESSO_VISITANTE,DT_CADAS,DT_ACESSO_VISITANTE,HR_ENTRADA,HR_SAIDA,NU_CARTAO_IDENTIFICACAO,NOME_PESSOA');
	$paging->cols_width('60,110,90,85,70,60');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
