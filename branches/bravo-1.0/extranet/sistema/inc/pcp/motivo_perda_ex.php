<?php

    require("../../setup.php");
	
	$codigoMotivoPerda = $_GET["codigoMotivoPerda"];
	
	$query = mysql_query("DELETE FROM tb_pcp_motivo_perda WHERE CO_PCP_MOTIVO_PERDA = '".$codigoMotivoPerda."'");
	if($query){
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o Motivo de Perda no momento.";
	}
	
?>