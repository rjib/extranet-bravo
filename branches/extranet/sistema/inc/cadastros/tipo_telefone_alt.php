<?php

    require("../../setup.php");
	
	$codigoTipoTelefone           = $_POST["codigoTipoTelefone"];
	$nomeTipoTelefoneAlterar      = $_POST["nomeTipoTelefoneAlterar"];
	$descricaoTipoTelefoneAlterar = $_POST["descricaoTipoTelefoneAlterar"];
	
	if (empty($nomeTipoTelefoneAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoTelefoneAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_tipo_telefone SET
							      NO_TIPO_TELEFONE   = '".$nomeTipoTelefoneAlterar."'
							      , DS_TIPO_TELEFONE = '".$descricaoTipoTelefoneAlterar."'
							  WHERE CO_TIPO_TELEFONE = '".$codigoTipoTelefone."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o tipo telefone no momento.";
		}
		
	}
	
?>