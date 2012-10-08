<?php

    require("../../setup.php");
	
	$codigoCartaoIdentificacao = $_GET["codigoCartaoIdentificacao"];
	
	$query = mysql_query("DELETE FROM tb_cartao_identificacao WHERE CO_CARTAO_IDENTIFICACAO = '".$codigoCartaoIdentificacao."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o Cartão Identificação no momento.";
	}
	
?>