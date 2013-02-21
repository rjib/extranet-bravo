<?php

	session_start();
	$codigo_usuario = $_SESSION['codigoUsuario'];
	require('apontamento_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_apontamento PCP_APONTAMENTO');
	$paging->where('(CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA) IS NULL OR CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA) LIKE "'.$searchfor.'%") ');
	$paging->labels('C&oacute;digo,Data,Recurso,Hora Inicio,Hora Fim,Tipo,Numero OP, C&oacute;d. Int.');
	$paging->fields('PCP_APONTAMENTO.CO_PCP_APONTAMENTO,DT_APONTAMENTO,NO_RECURSO,HR_INICIO,HR_FIM,FL_APONTAMENTO,NU_OP,PCP_PRODUTO.CO_INT_PRODUTO');
	$paging->cols_width('50,60,200,70,70,120,90');
	$paging->rowsperpage(10);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
