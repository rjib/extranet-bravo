<?php
	
	session_start();
	
    require("../../setup.php");
	
	$nomeMotivo = $_GET["nomeMotivo"];
	
	$sqlMotivoParada = mysql_query("SELECT MOTIVO_PARADA.CO_PCP_MOTIVO_PARADA
									    , MOTIVO_PARADA.NO_MOTIVO_PARADA
									    , MOTIVO_PARADA.DS_MOTIVO_PARADA
									FROM tb_pcp_motivo_parada MOTIVO_PARADA
						   	        WHERE NO_MOTIVO_PARADA = '".$nomeMotivo."'")
	or die(mysql_error());
	
	if(mysql_num_rows($sqlMotivoParada) != 0){
	    $rowMotivoParada=mysql_fetch_array($sqlMotivoParada);
		$resposta = array(
			'codigoPcpMotivoParada' => $rowMotivoParada['CO_PCP_MOTIVO_PARADA'],
			'nomeMotivoParada' => $rowMotivoParada['NO_MOTIVO_PARADA'],
			'descricaoMotivoParada' => $rowMotivoParada['DS_MOTIVO_PARADA']
		);
		echo json_encode($resposta);
	}
		
?>