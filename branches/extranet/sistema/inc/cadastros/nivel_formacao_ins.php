<?php

    require("../../setup.php");
	
	$nomeNivelFormacao      = $_POST["nomeNivelFormacao"];
	$descricaoNivelFormacao = $_POST["descricaoNivelFormacao"];
	
	if (empty($nomeNivelFormacao)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoNivelFormacao) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_nivel_formacao (NO_NIVEL_FORMACAO, DS_NIVEL_FORMACAO) VALUES ('".$nomeNivelFormacao."' ,'".$descricaoNivelFormacao."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Nível Formação no momento.";
		}
		
	}
	
?>