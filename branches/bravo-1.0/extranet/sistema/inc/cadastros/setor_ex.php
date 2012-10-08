<?php

    require("../../setup.php");
	
	$codigoSetor = $_GET["codigoSetor"];
	
	$query = mysql_query("DELETE FROM tb_setor WHERE CO_SETOR = '".$codigoSetor."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o setor no momento.";
	}
	
?>