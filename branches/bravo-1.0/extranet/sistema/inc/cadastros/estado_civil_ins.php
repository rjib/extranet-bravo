<?php

    require("../../setup.php");
	
	$nomeEstadoCivil      = $_POST["nomeEstadoCivil"];
	$descricaoEstadoCivil = $_POST["descricaoEstadoCivil"];
	
	if (empty($nomeEstadoCivil)) {
		echo "Informe o Nome";
	}else {
		
		$query = mysql_query("INSERT INTO tb_estado_civil (NO_ESTADO_CIVIL, DS_ESTADO_CIVIL) VALUES ('".$nomeEstadoCivil."', '".$descricaoEstadoCivil."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o estado civil no momento.";
		}
		
	}
	
?>