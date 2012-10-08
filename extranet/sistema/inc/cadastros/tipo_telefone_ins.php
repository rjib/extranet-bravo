<?php

    require("../../setup.php");
	
	$nomeTipoTelefone      = $_POST["nomeTipoTelefone"];
	$descricaoTipoTelefone = $_POST["descricaoTipoTelefone"];
	
	if (empty($nomeTipoTelefone)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoTelefone) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_tipo_telefone (NO_TIPO_TELEFONE
							      , DS_TIPO_TELEFONE) 
							  VALUES ('".$nomeTipoTelefone."' 
								  ,'".$descricaoTipoTelefone."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o tipo telefone no momento.";
		}
		
	}
	
?>