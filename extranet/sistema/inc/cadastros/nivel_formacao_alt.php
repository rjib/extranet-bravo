<?php

    require("../../setup.php");
	
	$codigoNivelFormacao           = $_POST["codigoNivelFormacao"];
	$nomeNivelFormacaoAlterar      = $_POST["nomeNivelFormacaoAlterar"];
	$descricaoNivelFormacaoAlterar = $_POST["descricaoNivelFormacaoAlterar"];
	
	if (empty($nomeNivelFormacaoAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoNivelFormacaoAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_nivel_formacao SET
							      NO_NIVEL_FORMACAO   = '".$nomeNivelFormacaoAlterar."'
							      , DS_NIVEL_FORMACAO = '".$descricaoNivelFormacaoAlterar."'
							  WHERE CO_NIVEL_FORMACAO = '".$codigoNivelFormacao."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o nível formação no momento.";
		}
		
	}
	
?>