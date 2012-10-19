<?php
	
	require('ordem_producao_pi_grid_paging.php');
	$paging = new Paging();
	
	
	$searchfor	 = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	if(isset($_GET['dataInicial']) and isset($_GET['dataFinal']) and isset($_GET['cor']) and isset($_GET['espessura']) and isset($_GET['flag'])){
	//substr($_GET['dataInicial'] ,7,2).substr($_GET['dataInicial'] ,5,2).substr($_GET['dataInicial'],1,4);
			$dataInicial 	 = substr($_GET['dataInicial'] ,1,4).substr($_GET['dataInicial'] ,5,2).substr($_GET['dataInicial'],7,2);
			$dataFinal	 	 = substr($_GET['dataFinal'] ,1,4).substr($_GET['dataFinal'] ,5,2).substr($_GET['dataFinal'],7,2);
			$co_cor 	 	 = $_GET['cor'];
			$espessura 	 	 = $_GET['espessura'];			
			$flag  			 = $_GET['flag'];
	}else{
			$dataInicial = date('Ymd');			
			$dataFinal	 = date('Ymd');
			$co_cor 	 = 001000;
			$espessura 	 = 0;
			$flag  = '';	
			
	}
	$paging->table('');
	$paging->where('(PCP_PRODUTO.CO_INT_PRODUTO LIKE "%'.$searchfor.'%" OR PCP_PRODUTO.DS_PRODUTO LIKE "%'.$searchfor.'%")
					AND PCP_OP.DT_EMISSAO BETWEEN "'.$dataInicial.'" AND "'.$dataFinal.'"
					AND PCP_PRODUTO.CO_COR ="'.$co_cor.'" 
					AND PCP_PRODUTO.NU_ESPESSURA ="'.$espessura.'"
					AND PCP_OP.FL_SELECIONADO LIKE "%'.$flag.'%"');
	$paging->labels('Código,Código Int.,Produto, Comprimento, Largura, Qtd. Produzida, Dt. Emissão');
	$paging->fields('PCP_OP.CO_PCP_OP, PCP_PRODUTO.CO_COR,PCP_PRODUTO.DS_PRODUTO,PCP_PRODUTO.NU_COMPRIMENTO,PCP_PRODUTO.NU_LARGURA,PCP_OP.QTD_PRODUZIDA,PCP_OP.DT_EMISSAO');
	$paging->cols_width('30,50,250,60,50,68,68,60');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);	
	
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
