<?php

    require("../../setup.php");
	
	$codigoNivelFormacao = $_GET["codigonivelFormacao"];
	
	$query = mysql_query("DELETE FROM tb_nivel_formacao WHERE CO_NIVEL_FORMACAO = '".$codigoNivelFormacao."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o nivel formação no momento.";
	}
	
?>