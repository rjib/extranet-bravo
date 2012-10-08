<?php

    require("../../setup.php");
	
	$numeroCartaoIdentificacao      = $_POST["numeroCartaoIdentificacao"];
	$descricaoCartaoIdentificacao   = $_POST["descricaoCartaoIdentificacao"];
	
	if (empty($numeroCartaoIdentificacao)) {
		echo "Informe o Número do Cartão de Identificação";
	}elseif (strlen($descricaoCartaoIdentificacao) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_cartao_identificacao (NU_CARTAO_IDENTIFICACAO, DS_CARTAO_IDENTIFICACAO) VALUES ('".$numeroCartaoIdentificacao."' ,'".$descricaoCartaoIdentificacao."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Cartão de Identificação no momento.";
		}
		
	}
	
?>