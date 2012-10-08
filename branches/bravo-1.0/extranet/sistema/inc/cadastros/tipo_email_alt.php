<?php

    require("../../setup.php");
	
	$codigoTipoEmail           = $_POST["codigoTipoEmail"];
	$nomeTipoEmailAlterar      = $_POST["nomeTipoEmailAlterar"];
	$descricaoTipoEmailAlterar = $_POST["descricaoTipoEmailAlterar"];
	
	if (empty($nomeTipoEmailAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoEmailAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_tipo_email SET
							      NO_TIPO_EMAIL   = '".$nomeTipoEmailAlterar."'
							      , DS_TIPO_EMAIL = '".$descricaoTipoEmailAlterar."'
							  WHERE CO_TIPO_EMAIL = '".$codigoTipoEmail."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o tipo email no momento.";
		}
		
	}
	
?>