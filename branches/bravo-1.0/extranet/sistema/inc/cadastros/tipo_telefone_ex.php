<?php

    require("../../setup.php");
	
	$codigoTipoTelefone = $_GET["codigoTipoTelefone"];
	
	$query = mysql_query("DELETE FROM tb_tipo_telefone WHERE CO_TIPO_TELEFONE = '".$codigoTipoTelefone."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o tipo telefone no momento.";
	}
	
?>