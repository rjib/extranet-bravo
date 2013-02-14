<?php
	
	session_start();
	
    require("../../setup.php");
	
	$nomeMotivoPerda = $_GET["nomeMotivoPerda"];
	
	$sqlMotivoPerda = mysql_query("SELECT MOTIVO_PERDA.CO_PCP_MOTIVO_PERDA
								       , MOTIVO_PERDA.NO_MOTIVO_PERDA
									   , MOTIVO_PERDA.DS_MOTIVO_PERDA
								   FROM tb_pcp_motivo_perda MOTIVO_PERDA
						   	       WHERE NO_MOTIVO_PERDA = '".$nomeMotivoPerda."'
								   AND ST_MOTIVO_PERDA = '1'")
	or die(mysql_error());
	
	if(mysql_num_rows($sqlMotivoPerda) != 0){
	    $rowMotivoPerda=mysql_fetch_array($sqlMotivoPerda);
		$resposta = array(
			'codigoMotivoPerda' => $rowMotivoPerda['CO_PCP_MOTIVO_PERDA'],
			'nomeMotivoPerda' => $rowMotivoPerda['NO_MOTIVO_PERDA'],
			'descricaoMotivoPerda' => $rowMotivoPerda['DS_MOTIVO_PERDA']
		);
		echo json_encode($resposta);
	}
		
?>