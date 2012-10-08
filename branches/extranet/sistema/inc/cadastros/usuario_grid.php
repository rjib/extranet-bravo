<?php
	
	require('usuario_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_usuario USUARIO');
	$paging->where('USUARIO.CO_USUARIO = "'.$searchfor.'" OR PESSOA_FISICA.CPF_PESSOA_FISICA LIKE "%'.$searchfor.'%" OR PESSOA.NO_PESSOA LIKE "%'.$searchfor.'%" OR PAPEL.NO_PAPEL LIKE "%'.$searchfor.'%"');
	$paging->labels('Código,Data Cadastro,CPF,Nome,Papel');
	$paging->fields('USUARIO.CO_USUARIO,DT_CADAS,CPF_PESSOA_FISICA,PESSOA.NO_PESSOA,PAPEL.NO_PAPEL');
	$paging->cols_width('60,120,120');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
