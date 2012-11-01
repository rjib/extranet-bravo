<?php
	
	require('ordem_producao_pi_grid_paging.php');
	require('../helper.class.php');
	$_helper = new helper();
	$paging = new Paging();
	
	
	$searchfor	 = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	if(isset($_GET['dataInicial']) and isset($_GET['dataFinal']) and isset($_GET['cor']) and isset($_GET['espessura']) and isset($_GET['flag'])){
	//substr($_GET['dataInicial'] ,7,2).substr($_GET['dataInicial'] ,5,2).substr($_GET['dataInicial'],1,4);
			$dataInicial 	 = $_helper->ajustarDataYYYYmmdd($_GET['dataInicial']);
			$dataFinal	 	 = $_helper->ajustarDataYYYYmmdd($_GET['dataFinal']);
			$co_cor 	 	 = $_GET['cor'];
			$espessura 	 	 = $_GET['espessura'];			
			$flag  			 = $_GET['flag'];
			$flag =='S'? $flag='':$flag=$_GET['flag'];
	}else{
			$dataInicial = date('Ymd');			
			$dataFinal	 = date('Ymd');
			$co_cor 	 = 001000;
			$espessura 	 = 0;
			$flag  = 'N';	
			
	}
		
	$paging->table('');
	if($flag=='N'){
	$paging->where('PCP_PRODUTO.CO_INT_PRODUTO LIKE "%'.$searchfor.'%"
					AND PCP_OP.DT_EMISSAO BETWEEN "'.$dataInicial.'" AND "'.$dataFinal.'"
					AND PCP_PRODUTO.CO_COR ="'.$co_cor.'" 
					AND PCP_PRODUTO.NU_ESPESSURA ="'.$espessura.'"
					AND PCP_OP.CO_PCP_AD is null ');
	}else{
	$paging->where('PCP_PRODUTO.CO_INT_PRODUTO LIKE "%'.$searchfor.'%"
					AND PCP_OP.DT_EMISSAO BETWEEN "'.$dataInicial.'" AND "'.$dataFinal.'"
					AND PCP_PRODUTO.CO_COR ="'.$co_cor.'"
					AND PCP_PRODUTO.NU_ESPESSURA ="'.$espessura.'"');
		
	}
	$paging->labels('Status,C&oacute;digo,C&oacuted. Int.,Produto, Comp., Larg., Quant., Dt. Emiss&atilde;o');
	$paging->fields('PCP_OP.CO_PCP_AD,PCP_OP.CO_PCP_OP, PCP_PRODUTO.CO_INT_PRODUTO,PCP_PRODUTO.DS_PRODUTO,PCP_PRODUTO.NU_COMPRIMENTO,PCP_PRODUTO.NU_LARGURA,PCP_OP.QTD_PRODUTO,PCP_OP.DT_EMISSAO');
	$paging->cols_width('5,10,40,250,30,30,30,30,40');
	$paging->rowsperpage(30);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);	
	
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
