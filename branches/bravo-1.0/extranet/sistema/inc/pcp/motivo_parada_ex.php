<?php

    require("../../setup.php");
	
	$codigoMotivoParada = $_GET["codigoMotivoParada"];
	
	$query = mysql_query("DELETE FROM tb_pcp_motivo_parada WHERE CO_PCP_MOTIVO_PARADA = '".$codigoMotivoParada."'");
	if($query){
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o Motivo de Parada no momento.";
	}
	
?>