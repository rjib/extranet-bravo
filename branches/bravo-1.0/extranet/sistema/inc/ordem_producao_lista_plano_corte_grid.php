<?php
require_once '../setup.php';
require_once APP_PATH.'sistema/inc/ordem_producao_lista_plano_corte_grid_paging.php';

$paging = new Paging();

$searchfor = isset($_GET['searchfor']) ? $_GET['searchfor'] : '';

$paging->table('tb_pcp_ad PCP_AD');
$paging->where('PCP_AD.no_pcp_ad LIKE "%'.$searchfor.'%" OR PCP_OP.nu_lote LIKE "%'.$searchfor.'%"');
$paging->labels('Arquivo,Criado em, Unidade Complementar, Lote');
$paging->fields('PCP_AD.arquivo, PCP_AD.data_criacao_arquivo,PCP_AD.un_complementar,PCP_OP.nu_lote');
$paging->cols_width('5,50,60,70,30,70');
$paging->rowsperpage(30);
$paging->page(isset($_GET['p']) ? $_GET['p'] : 1);

if($_GET['load'] == 'controls'){
	$paging->show_controls();
}else{
	$paging->show_table();
}

?>
