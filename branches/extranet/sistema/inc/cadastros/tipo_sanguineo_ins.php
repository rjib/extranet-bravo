<?php

    require("../../setup.php");
	
	$nomeTipoSanguineo      = $_POST["nomeTipoSanguineo"];
	$descricaoTipoSanguineo = $_POST["descricaoTipoSanguineo"];
	
	if (empty($nomeTipoSanguineo)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoSanguineo) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_tipo_sanguineo (NO_TIPO_SANGUINEO
							      , DS_TIPO_SANGUINEO) 
							  VALUES ('".$nomeTipoSanguineo."' 
								  ,'".$descricaoTipoSanguineo."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o tipo sanguineo no momento.";
		}
		
	}
	
?>