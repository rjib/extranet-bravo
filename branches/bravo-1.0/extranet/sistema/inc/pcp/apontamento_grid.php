<?php
	
	require('apontamento_grid_paging.php');
	$paging = new Paging();
	
	$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';
	
	$paging->table('tb_pcp_apontamento PCP_APONTAMENTO');
	$paging->where('PCP_RECURSO.NO_RECURSO = "'.$searchfor.'" OR FL_APONTAMENTO LIKE "%'.$searchfor.'%" AND PCP_RECURSO.FL_DELET IS NULL');
	$paging->labels('C&oacute;digo,Data Apontamento,Recurso,Hora Inicio,Hora Fim,Tipo Apontamento,Numero. OP');
	$paging->fields('PCP_APONTAMENTO.CO_PCP_APONTAMENTO,DT_APONTAMENTO,NO_RECURSO,HR_INICIO,HR_FIM,FL_APONTAMENTO,NU_OP');
	$paging->cols_width('60,110,200,70,70,200,100');
	$paging->rowsperpage(15);
	$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);
	
	if($_GET['load'] == 'controls'){
		$paging->show_controls();
	}else{
		$paging->show_table();
	}

?>
