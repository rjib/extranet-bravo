<?php
	
	require('ordem_producao_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_op OP');
	$paging->where('OP.CO_NUM LIKE "%'.$searchfor.'%" OR OP.CO_ITEM ="'.$searchfor.'" OR OP.CO_SEQUENCIA ="'.$searchfor.'"');
	$paging->labels('Código,Cód. Item,Cód. Seq., Cód. Prod., Qtd. Prod., Qtd. Produzida, Dt. Emissão, Cód. Recno');
	$paging->fields('OP.CO_NUM, OP.CO_ITEM, OP.CO_SEQUENCIA,OP.CO_PRODUTO,OP.QTD_PRODUTO, OP.QTD_PRODUZIDA, OP.DT_EMISSAO, OP.CO_RECNO');
	$paging->cols_width('80,100');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
