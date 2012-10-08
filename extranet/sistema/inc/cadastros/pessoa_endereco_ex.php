<?php

    require("../../setup.php");
	
	$codigoEndereco = $_GET["codigoEndereco"];
	
	$query = mysql_query("DELETE FROM tb_endereco WHERE CO_ENDERECO = '".$codigoEndereco."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o endereco no momento.";
	}
	
?>