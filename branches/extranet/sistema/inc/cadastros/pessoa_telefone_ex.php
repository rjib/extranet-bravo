<?php

    require("../../setup.php");
	
	$codigoTelefone = $_GET["codigoTelefone"];
	
	$query = mysql_query("DELETE FROM tb_telefone WHERE CO_TELEFONE = '".$codigoTelefone."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o telefone no momento.";
	}
	
?>