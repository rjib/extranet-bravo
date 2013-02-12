<?php
	
	session_start();
	
    require("../../setup.php");
	
	$numeroJob = $_GET["numeroJob"];
	
	$sqlJobOrdemProducao = mysql_query("SELECT PCP_AD.NO_PCP_AD
											, PCP_AD_PECA.CO_PCP_OP
											, CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) AS NUM_OP
											, PCP_PRODUTO.CO_INT_PRODUTO
											, PCP_OP.CO_PRODUTO
											, PCP_PRODUTO.DS_PRODUTO
											, DATE_FORMAT(PCP_OP.DT_EMISSAO, '%d/%m/%Y') AS DT_EMISSAO
											, PCP_OP.NU_LOTE
										FROM tb_pcp_ad PCP_AD
											INNER JOIN tb_pcp_ad_peca PCP_AD_PECA
												ON PCP_AD_PECA.CO_PCP_AD = PCP_AD.CO_PCP_AD
											INNER JOIN tb_pcp_op PCP_OP
												ON PCP_OP.CO_PCP_OP = PCP_AD_PECA.CO_PCP_OP
											INNER JOIN tb_pcp_produto PCP_PRODUTO
												ON PCP_PRODUTO.CO_PRODUTO = PCP_OP.CO_PRODUTO
									    WHERE PCP_AD.NO_PCP_AD = '".$numeroJob."'")
	or die(mysql_error());
	
	if(mysql_num_rows($sqlJobOrdemProducao) > 0){
	    
		$_SESSION['numeroJob'] = $numeroJob;		
		$count = 0;
		
		while($rowJobOrdemProducao=mysql_fetch_array($sqlJobOrdemProducao)){ 
		
		    $jobOrdemProducaoImporta[$count]['NO_PCP_AD']      = $rowJobOrdemProducao['NO_PCP_AD'];
			$jobOrdemProducaoImporta[$count]['CO_PCP_OP']      = $rowJobOrdemProducao['CO_PCP_OP'];
			$jobOrdemProducaoImporta[$count]['NUM_OP']         = $rowJobOrdemProducao['NUM_OP'];
			$jobOrdemProducaoImporta[$count]['CO_INT_PRODUTO'] = $rowJobOrdemProducao['CO_INT_PRODUTO'];
			$jobOrdemProducaoImporta[$count]['CO_PRODUTO']     = $rowJobOrdemProducao['CO_PRODUTO'];
			$jobOrdemProducaoImporta[$count]['DS_PRODUTO']     = $rowJobOrdemProducao['DS_PRODUTO'];
			$jobOrdemProducaoImporta[$count]['DT_EMISSAO']     = $rowJobOrdemProducao['DT_EMISSAO'];
			$jobOrdemProducaoImporta[$count]['NU_LOTE']        = $rowJobOrdemProducao['NU_LOTE'];
						
			$count++;
			$_SESSION['jobOrdemProducaoImporta'] = $jobOrdemProducaoImporta;
		
		}
		
		echo json_encode($jobOrdemProducaoImporta);
	}
		
?>