<?php

session_start();
include_once '../../../setup.php';
require_once '../../../models/tb_pcp_etiqueta.php';

if(isset($_GET["numeroOrdemProducaoStep1"])){
	$ordemProducao = $_GET["numeroOrdemProducaoStep1"];

	$query = "select sum(APONTAMENTO.qtd_produto) QTD_PRODUTO, PRODUTO.DS_PRODUTO, ORDEM_PRODUCAO.NU_LOTE from tb_pcp_apontamento APONTAMENTO
				inner join tb_pcp_op ORDEM_PRODUCAO on APONTAMENTO.co_pcp_op = ORDEM_PRODUCAO.co_pcp_op
				inner join tb_pcp_produto PRODUTO on ORDEM_PRODUCAO.co_produto = PRODUTO.co_produto
			where CONCAT(ORDEM_PRODUCAO.CO_NUM,ORDEM_PRODUCAO.CO_ITEM,ORDEM_PRODUCAO.CO_SEQUENCIA) = '".$ordemProducao."'
			group by CONCAT(ORDEM_PRODUCAO.CO_NUM,ORDEM_PRODUCAO.CO_ITEM,ORDEM_PRODUCAO.CO_SEQUENCIA)";
	
	$sqlOrdemProducao = mysql_query($query, CONEXAOERP);

	if(mysql_num_rows($sqlOrdemProducao) != 0){
		$rowOrdemProducao=mysql_fetch_array($sqlOrdemProducao);
		$resposta = array(
				'qtd_produto' => $rowOrdemProducao['QTD_PRODUTO'],
				'ds_produto' => $rowOrdemProducao['DS_PRODUTO'],
				'nu_lote' => $rowOrdemProducao['NU_LOTE'],
				'erro'=>false);
		echo json_encode($resposta);
	}
}elseif(isset($_GET["numeroOrdemProducaoStep3"])){
	$ordemProducao = $_GET["numeroOrdemProducaoStep3"];
	$query = "select sum(ORDEM_PRODUCAO.qtd_produto) QTD_PRODUTO, PRODUTO.DS_PRODUTO, ORDEM_PRODUCAO.NU_LOTE from tb_pcp_op ORDEM_PRODUCAO
				inner join tb_pcp_produto PRODUTO on ORDEM_PRODUCAO.co_produto = PRODUTO.co_produto
			where CONCAT(ORDEM_PRODUCAO.CO_NUM,ORDEM_PRODUCAO.CO_ITEM,ORDEM_PRODUCAO.CO_SEQUENCIA) = '".$ordemProducao."'
			group by CONCAT(ORDEM_PRODUCAO.CO_NUM,ORDEM_PRODUCAO.CO_ITEM,ORDEM_PRODUCAO.CO_SEQUENCIA)";
	
	$sqlOrdemProducao = mysql_query($query, CONEXAOERP);
	
	if(mysql_num_rows($sqlOrdemProducao) != 0){
		$rowOrdemProducao=mysql_fetch_array($sqlOrdemProducao);
		$resposta = array(
				'qtd_produto' => $rowOrdemProducao['QTD_PRODUTO'],
				'ds_produto' => $rowOrdemProducao['DS_PRODUTO'],
				'nu_lote' => $rowOrdemProducao['NU_LOTE'],
				'erro'=>false);
		echo json_encode($resposta);
	}
}else{
	$resposta = array('erro'=>true);
	echo json_encode($resposta);

}
