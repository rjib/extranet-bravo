<?php
	
	require('ordem_producao_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_op OP');
	$paging->where('OP.CO_NUM LIKE "%'.$searchfor.'%" OR OP.CO_ITEM ="'.$searchfor.'" OR OP.DT_EMISSAO LIKE "%'.$searchfor.'%" AND OP.FL_DELET IS NULL');
	$paging->labels('Numero OP,C&oacute;d. Int., C&oacute;d. Produto,Desc. Produto, Qtd. Prod., Qtd. Produzida, Dt. Emiss&atilde;o, Lote');
	$paging->fields('NUM_OP, PRODUTO.CO_INT_PRODUTO, OP.CO_PRODUTO,PRODUTO.DS_PRODUTO,OP.QTD_PRODUTO, OP.QTD_PRODUZIDA, OP.DT_EMISSAO, OP.NU_LOTE');
	$paging->cols_width('10%,7%,10%,39%,8%,11%,10%,10%');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
