<?php

    require("../../setup.php");
	
	$nomeNacionalidade      = $_POST["nomeNacionalidade"];
	$descricaoNacionalidade = $_POST["descricaoNacionalidade"];
	
	if (empty($nomeNacionalidade)) {
		echo "Informe o Nome";
	}else {
		
		$query = mysql_query("INSERT INTO tb_nacionalidade (NO_NACIONALIDADE, DS_NACIONALIDADE) VALUES ('".$nomeNacionalidade."', '".$descricaoNacionalidade."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Nacionalidade no momento.";
		}
		
	}
	
?>