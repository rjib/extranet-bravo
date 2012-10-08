<?php

    require("../../setup.php");
	
	$codigoContato = $_GET["codigoContato"];
	
	$query = mysql_query("DELETE FROM tb_contato WHERE CO_CONTATO = '".$codigoContato."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o contato no momento.";
	}
	
?>