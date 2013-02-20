<?php
	session_start();
	$codigo_usuario = $_SESSION['codigoUsuario'];
	require('apontamento_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_apontamento PCP_APONTAMENTO');
	$paging->where('(CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA) IS NULL OR CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA) LIKE "'.$searchfor.'%") ');
	$paging->labels('Desc. Prod.,Data Apontamento,Recurso,Hora Inicio,Hora Fim,Tipo Apontamento,Numero. OP, C&oacute;d. Int.');
	$paging->fields('PCP_PRODUTO.DS_PRODUTO,DT_APONTAMENTO,NO_RECURSO,HR_INICIO,HR_FIM,FL_APONTAMENTO,NU_OP,PCP_PRODUTO.CO_INT_PRODUTO');
	$paging->cols_width('200,120,200,70,70,10,80,60');
	$paging->rowsperpage(10);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
