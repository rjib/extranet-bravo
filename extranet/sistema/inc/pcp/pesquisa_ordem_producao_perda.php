<?php
	
	session_start();
	
    require("../../setup.php");
	
	$ordemProducao = $_GET["ordemProducao"];
	
	$sqlOrdemProducao = mysql_query("SELECT PCP_OP.CO_PCP_OP
									     , CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) AS NU_OP
									     , PCP_OP.CO_PRODUTO
									     , TRIM(PCP_PRODUTO.DS_PRODUTO) AS DS_PRODUTO
										 , PCP_PRODUTO.CO_PRODUTO
                     				     , PCP_PRODUTO.CO_INT_PRODUTO
										 , PCP_COR.NO_COR
									     , PCP_OP.NU_LOTE
										 , DATE_FORMAT(PCP_OP.DT_EMISSAO, '%d/%m/%Y') AS DT_EMISSAO
										 , PCP_OP.QTD_PRODUTO AS OP_QTD_PRODUTO
									 FROM tb_pcp_op PCP_OP
									     INNER JOIN tb_pcp_produto PCP_PRODUTO
									         ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
									     INNER JOIN tb_pcp_cor PCP_COR
										     ON PCP_PRODUTO.CO_COR = PCP_COR.CO_COR
						   	         WHERE CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) = '".$ordemProducao."'")
	or die(mysql_error());
	
	if(mysql_num_rows($sqlOrdemProducao) > 0){
	    
		$_SESSION['ordemProducao'] = $ordemProducao;		
		$count = 0;
		
		while($rowOrdemProducao=mysql_fetch_array($sqlOrdemProducao)){ 
		
		    $perdaOrdemProducaoImporta[$count]['CO_PCP_OP']      = $rowOrdemProducao['CO_PCP_OP'];
			$perdaOrdemProducaoImporta[$count]['NU_OP']          = $rowOrdemProducao['NU_OP'];
			$perdaOrdemProducaoImporta[$count]['DS_PRODUTO']     = $rowOrdemProducao['DS_PRODUTO'];
			$perdaOrdemProducaoImporta[$count]['NU_LOTE']        = $rowOrdemProducao['NU_LOTE'];
			$perdaOrdemProducaoImporta[$count]['DT_EMISSAO']     = $rowOrdemProducao['DT_EMISSAO'];
			$perdaOrdemProducaoImporta[$count]['OP_QTD_PRODUTO'] = $rowOrdemProducao['OP_QTD_PRODUTO'];
			$perdaOrdemProducaoImporta[$count]['CO_PRODUTO']     = $rowOrdemProducao['CO_PRODUTO'];
			$perdaOrdemProducaoImporta[$count]['CO_INT_PRODUTO'] = $rowOrdemProducao['CO_INT_PRODUTO'];
			$perdaOrdemProducaoImporta[$count]['NO_COR']         = $rowOrdemProducao['NO_COR'];
						
			$count++;
			$_SESSION['perdaOrdemProducaoImporta'] = $perdaOrdemProducaoImporta;
		
		}
		
		echo json_encode($perdaOrdemProducaoImporta);
		
	}
		
?>