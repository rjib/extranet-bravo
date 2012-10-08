<?php

    require("../../setup.php");
	
	$nomeSetor      = $_POST["nomeSetor"];
	$descricaoSetor = $_POST["descricaoSetor"];
	
	if (empty($nomeSetor)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoSetor) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_setor (NO_SETOR, DS_SETOR) VALUES ('".$nomeSetor."' ,'".$descricaoSetor."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Setor no momento.";
		}
		
	}
	
?>