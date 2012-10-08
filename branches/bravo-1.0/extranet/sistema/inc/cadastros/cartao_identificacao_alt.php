<?php

    require("../../setup.php");
	
	$codigoCartaoIdentificacao           = $_POST["codigoCartaoIdentificacao"];
	$numeroCartaoIdentificacaoAlterar    = $_POST["numeroCartaoIdentificacaoAlterar"];
	$descricaoCartaoIdentificacaoAlterar = $_POST["descricaoCartaoIdentificacaoAlterar"];
	
	if (empty($numeroCartaoIdentificacaoAlterar)) {
		echo "Informe o Número do Cartão de Identificação";
	}elseif (strlen($descricaoCartaoIdentificacaoAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_cartao_identificacao SET
							      NU_CARTAO_IDENTIFICACAO   = '".$numeroCartaoIdentificacaoAlterar."'
							      , DS_CARTAO_IDENTIFICACAO = '".$descricaoCartaoIdentificacaoAlterar."'
							  WHERE CO_CARTAO_IDENTIFICACAO = '".$codigoCartaoIdentificacao."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o Cartão de Identificação no momento.";
		}
		
	}
	
?>