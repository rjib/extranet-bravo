<?php
	
	session_start();
	
    require("../../setup.php");
	
	$ordemProducaoPerda = $_GET["ordemProducaoPerda"];
	
	$sqlOrdemProducao = mysql_query("SELECT PCP_OP.CO_PCP_OP
									     , CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) AS NU_OP
									     , PCP_OP.CO_PRODUTO
									     , TRIM(PCP_PRODUTO.DS_PRODUTO) AS DS_PRODUTO
										 , PCP_PRODUTO.CO_PRODUTO
                     				     , PCP_PRODUTO.CO_INT_PRODUTO
										 , PCP_COR.NO_COR
									     , PCP_OP.NU_LOTE
										 , DATE_FORMAT(PCP_OP.DT_EMISSAO, '%d/%m/%Y') AS DT_EMISSAO
									 FROM tb_pcp_op PCP_OP
									     INNER JOIN tb_pcp_produto PCP_PRODUTO
									         ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
									     INNER JOIN tb_pcp_cor PCP_COR
										     ON PCP_PRODUTO.CO_COR = PCP_COR.CO_COR
						   	         WHERE CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) = '".$ordemProducaoPerda."'")
	or die(mysql_error());
	
	if(mysql_num_rows($sqlOrdemProducao) != 0){
	    $rowOrdemProducao=mysql_fetch_array($sqlOrdemProducao);
		$resposta = array(
			'codigoPcpOp' => $rowOrdemProducao['CO_PCP_OP'],
			'ordemProducao' => $rowOrdemProducao['NU_OP'],
			'descricaoProduto' => $rowOrdemProducao['DS_PRODUTO'],
			'loteOp' => $rowOrdemProducao['NU_LOTE'],
			'dataEmissaoOP' => $rowOrdemProducao['DT_EMISSAO'], 
			'codigoProduto'=>$rowOrdemProducao['CO_PRODUTO'], 
			'codigoInterno'=>$rowOrdemProducao['CO_INT_PRODUTO'],
			'corProduto'=>$rowOrdemProducao['NO_COR']
		);
		echo json_encode($resposta);
	}
		
?>