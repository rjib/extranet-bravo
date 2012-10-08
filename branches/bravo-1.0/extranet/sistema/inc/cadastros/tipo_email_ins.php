<?php

    require("../../setup.php");
	
	$nomeTipoEmail      = $_POST["nomeTipoEmail"];
	$descricaoTipoEmail = $_POST["descricaoTipoEmail"];
	
	if (empty($nomeTipoEmail)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoEmail) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_tipo_email (NO_TIPO_EMAIL
							      , DS_TIPO_EMAIL) 
							  VALUES ('".$nomeTipoEmail."' 
								  ,'".$descricaoTipoEmail."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o tipo email no momento.";
		}
		
	}
	
?>