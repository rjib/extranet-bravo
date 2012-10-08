<?php

    require("../../setup.php");
	
	$codigoEmail = $_GET["codigoEmail"];
	
	$query = mysql_query("DELETE FROM tb_email WHERE CO_EMAIL = '".$codigoEmail."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o e-mail no momento.";
	}
	
?>